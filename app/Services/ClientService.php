<?php

namespace App\Services;

use App\Models\Client;
use App\Notifications\SendBirthdayGift;

class ClientService
{
    public function store(array $data)
    {
        return Client::create($data);
    }

    public function update(int $id, array $data): Client
    {
        $client = Client::findOrFail($id);

        $client->update($data);

        return $client;
    }

    public function delete(int $id)
    {
        $client = Client::findOrFail($id);

        $client->delete();

        return $client;
    }

    public function sendBirthdayGift()
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
}
