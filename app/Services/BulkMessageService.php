<?php

namespace App\Services;

use App\Models\BulkMessage;

class BulkMessageService
{
    public function store(array $data): BulkMessage
    {
        return BulkMessage::create($data);
    }

    public function update(int $id, array $data): BulkMessage
    {
        $bulkMessage = BulkMessage::findOrFail($id);

        $bulkMessage->update($data);

        return $bulkMessage;
    }

    public function delete(int $id): BulkMessage
    {
        $bulkMessage = BulkMessage::findOrFail($id);

        $bulkMessage->delete();

        return $bulkMessage;
    }

    public function markAsSending(int $id): void
    {
        $bulkMessage = BulkMessage::where('status', '<>', BulkMessage::STATUS_SENDING)->findOrFail($id);

        $bulkMessage->update(['status' => BulkMessage::STATUS_SENDING]);
    }

    public function markAsCancel(int $id): void
    {
        $bulkMessage = BulkMessage::whereStatus(BulkMessage::STATUS_SENDING)->findOrFail($id);

        $bulkMessage->update(['status' => BulkMessage::STATUS_CANCELED]);
    }
}
