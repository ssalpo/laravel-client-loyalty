<?php

namespace App\Services;

use App\Jobs\RecalculateClientTotalPoints;
use App\Models\Client;
use App\Models\PointTransaction;
use Illuminate\Validation\ValidationException;

class PointTransactionService
{
    public function store(array $data): PointTransaction
    {
        $this->validateTransaction($data);

        $pointTransaction = PointTransaction::create($data);

        RecalculateClientTotalPoints::dispatch($data['client_id']);

        return $pointTransaction;
    }

    public function update(int $id, array $data): PointTransaction
    {
        $pointTransaction = PointTransaction::whereClientId($data['client_id'])->findOrFail($id);

        $this->validateTransaction($data);

        $pointTransaction->update($data);

        return $pointTransaction;
    }

    public function destroy(int $id): bool
    {
        return PointTransaction::findOrFail($id)->delete();
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
