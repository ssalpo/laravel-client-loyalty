<?php

namespace App\Services;

use App\Models\Point;
use App\Notifications\PointAdd;
use Illuminate\Support\Facades\DB;

class PointService
{
    public function store(array $data)
    {
        return DB::transaction(function () use ($data) {
            $point = Point::create(
                $this->calculateAmount($data)
            );

            $client = (new ClientService)->recalculateTotalPoints($point->client_id);

            $client->notify(new PointAdd($point, $client->total_points));

            return $point;
        });
    }

    public function update(int $id, array $data)
    {
        return DB::transaction(function () use ($id, $data) {
            $point = Point::findOrFail($id);

            $data['percent'] = $point->percent;

            $point->update($this->calculateAmount($data));

            (new ClientService)->recalculateTotalPoints($point->client_id);

            return $point;
        });
    }

    public function destroy(int $id)
    {
        return DB::transaction(function () use ($id) {
            $point = Point::findOrFail($id);

            $point->delete();

            (new ClientService)->recalculateTotalPoints($point->client_id);

            return $point;
        });
    }

    private function calculateAmount(array $data): array
    {
        $percent = ($data['percent'] ?? option('default_percent'));

        $data['amount'] = round($data['sell_amount'] * ($percent / 100), 2);

        return $data;
    }
}
