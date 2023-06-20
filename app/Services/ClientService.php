<?php

namespace App\Services;

use App\Models\Client;

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
}
