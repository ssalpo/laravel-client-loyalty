<?php

namespace App\Services;

use App\Models\BulkMessage;
use App\Models\Client;
use Illuminate\Support\Facades\DB;

class BulkMessageService
{
    public function store(array $data): BulkMessage
    {
        return BulkMessage::create($data);
    }

    public function update(int $id, array $data): BulkMessage
    {
        $bulkMessage = BulkMessage::notSending()->findOrFail($id);

        $bulkMessage->update($data);

        return $bulkMessage;
    }

    public function delete(int $id): BulkMessage
    {
        $bulkMessage = BulkMessage::notSending()->findOrFail($id);

        $bulkMessage->delete();

        return $bulkMessage;
    }

    public function markAsSending(int $id): void
    {
        DB::transaction(static function () use ($id) {
            $bulkMessage = BulkMessage::notSending()->findOrFail($id);

            $bulkMessage->update([
                'status' => BulkMessage::STATUS_SENDING,
                'total_received' => 0,
                'send_error_message' => null
            ]);

            Client::query()->update(['is_sms_receive' => false]);
        });
    }

    public function markAsCancel(int $id): void
    {
        $bulkMessage = BulkMessage::sending()->findOrFail($id);

        $bulkMessage->update(['status' => BulkMessage::STATUS_CANCELED]);
    }

    public function repeatSending(int $id): void
    {
        $bulkMessage = BulkMessage::sendingError()->findOrFail($id);

        $bulkMessage->update(['status' => BulkMessage::STATUS_SENDING]);
    }
}
