<?php

namespace App\Services;

use App\Models\Client;
use App\Models\Point;
use App\Models\PointTransaction;
use App\Notifications\SendBirthdayGift;

class ClientService
{
    public function store(array $data): Client
    {
        return Client::create($data);
    }

    public function update(int $id, array $data): Client
    {
        $client = Client::findOrFail($id);

        $client->update($data);

        return $client;
    }

    public function delete(int $id): Client
    {
        $client = Client::findOrFail($id);

        $client->delete();

        return $client;
    }

    public function sendBirthdayGift(): void
    {
        $clients = Client::hasTodayBirthday()->get();

        $template = option('birthday_template');

        foreach ($clients as $client) {
            $template = TemplateService::replaceAttributes(
                $client->only(['name']),
                $template
            );

            $client->notify(new SendBirthdayGift($template));
        }
    }

    public function recalculateTotalPoints(int $id): Client
    {
        $client = Client::findOrFail($id);
        $totalPoints = Point::whereClientId($id)->sum('amount');
        $totalPointTransactions = PointTransaction::whereClientId($id)->sum('amount');

        $client->update(['total_points' => $totalPoints - $totalPointTransactions]);

        return $client;
    }
}
