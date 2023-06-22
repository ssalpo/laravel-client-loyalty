<?php

namespace App\Http\Controllers;

use App\Http\Requests\BulkMessageRequest;
use App\Models\BulkMessage;
use App\Services\BulkMessageService;
use App\Services\Toast;

class BulkMessageController extends Controller
{
    public function index()
    {
        $bulkMessages = BulkMessage::orderBy('created_at', 'DESC')->paginate();

        $statusLabels = BulkMessage::STATUS_LABELS;
        $statusBadgeColors = BulkMessage::STATUS_BADGE_COLORS;

        $hasAnySendingProcess = BulkMessage::hasAnySendingProcess();

        return inertia('BulkMessages/Index', compact('bulkMessages', 'statusLabels', 'statusBadgeColors', 'hasAnySendingProcess'));
    }

    public function create()
    {
        return inertia('BulkMessages/Edit');
    }

    public function store(BulkMessageRequest $request, BulkMessageService $bulkMessageService)
    {
        $bulkMessageService->store($request->validated());

        Toast::success('Новый рассылка успешно создана.');

        return to_route('bulk-messages.index');
    }

    public function edit(BulkMessage $bulkMessage)
    {
        return inertia('BulkMessages/Edit', compact('bulkMessage'));
    }

    public function update(BulkMessageRequest $request, int $id, BulkMessageService $bulkMessageService)
    {
        $bulkMessageService->update($id, $request->validated());

        Toast::success('Успешно обновлено.');

        return to_route('bulk-messages.index');
    }

    public function destroy(int $id, BulkMessageService $bulkMessageService)
    {
        $bulkMessageService->delete($id);

        Toast::success('Успешно удалено.');

        return to_route('bulk-messages.index');
    }

    public function markAsSending(int $id, BulkMessageService $bulkMessageService)
    {
        $this->validateAlreadySendingProcess(
            $id,
            fn() => $bulkMessageService->markAsSending($id)
        );

        return back();
    }

    public function markAsCancel(int $id, BulkMessageService $bulkMessageService)
    {
        $this->validateAlreadySendingProcess(
            $id,
            fn() => $bulkMessageService->markAsCancel($id)
        );

        return back();
    }

    public function repeatSending(int $id, BulkMessageService $bulkMessageService)
    {
        $this->validateAlreadySendingProcess(
            $id,
            fn($id) => $bulkMessageService->repeatSending($id)
        );

        return back();
    }

    private function validateAlreadySendingProcess(?int $id, callable $callback): void
    {
        $hasProcess = BulkMessage::hasAnySendingProcess($id);

        if (!$hasProcess) {
            $callback();
            return;
        }

        Toast::error('У вас уже имеется запущенный процесс отправки СМС.');
    }
}
