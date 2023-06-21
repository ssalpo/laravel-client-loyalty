<?php

namespace App\Services;

use App\Models\Client;
use App\Models\PointTransaction;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use App\Notifications\PointTransaction as PointTransactionNotification;

class PointTransactionService
{
    public function store(array $data): PointTransaction
    {
        $this->validateTransaction($data);

        return DB::transaction(function () use ($data) {
            $pointTransaction = PointTransaction::create($data);

            $client = (new ClientService)->recalculateTotalPoints($pointTransaction->client_id);

            $client->notify(
                new PointTransactionNotification($pointTransaction, $client->total_points)
            );

            return $pointTransaction;
        });
    }

    public function update(int $id, array $data): PointTransaction
    {
        $pointTransaction = PointTransaction::whereClientId($data['client_id'])->findOrFail($id);

        $this->validateTransaction($data);

        return DB::transaction(function () use ($pointTransaction, $data) {
            $pointTransaction->update($data);

            (new ClientService)->recalculateTotalPoints($pointTransaction->client_id);

            return $pointTransaction;
        });
    }

    public function destroy(int $id): bool
    {
        return DB::transaction(function () use ($id) {
            $pointTransaction = PointTransaction::findOrFail($id)->delete();

            (new ClientService)->recalculateTotalPoints($pointTransaction->client_id);

            return $pointTransaction;
        });
    }

    private function validateTransaction(array $data): void
    {
        $client = Client::findOrFail($data['client_id']);

        if ($data['amount'] <= 0) {
            throw ValidationException::withMessages([
                'amount' => 'Кол-во бонусов для использования должно быть больше 0.'
            ]);
        }

        if ($data['amount'] > $client->total_points) {
            throw ValidationException::withMessages([
                'amount' => sprintf('Максимум можно использовать %s бонусов.', number_format($client->total_points, 2))
            ]);
        }
    }
}
