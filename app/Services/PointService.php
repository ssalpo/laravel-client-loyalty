<?php

namespace App\Services;

use App\Jobs\RecalculateClientTotalPoints;
use App\Models\Point;

class PointService
{
    public function store(array $data)
    {
        $point = Point::create(
            $this->calculateAmount($data)
        );

        RecalculateClientTotalPoints::dispatch($point->client_id);

        return $point;
    }

    public function update(int $id, array $data)
    {
        $point = Point::findOrFail($id);

        $data['percent'] = $point->percent;

        $point->update($this->calculateAmount($data));

        RecalculateClientTotalPoints::dispatch($point->client_id);

        return $point;
    }

    public function destroy(int $id)
    {
        return Point::findOrFail($id)->delete();
    }

    private function calculateAmount(array $data): array
    {
        $percent = ($data['percent'] ?? option('default_percent'));

        $data['amount'] = $data['sell_amount'] * ($percent / 100);

        return $data;
    }
}
