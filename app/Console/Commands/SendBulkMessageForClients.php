<?php

namespace App\Console\Commands;

use App\Models\BulkMessage;
use App\Models\Client;
use App\Services\SMS\OsonSmsSenderService;
use App\Services\TemplateService;
use Illuminate\Console\Command;

class SendBulkMessageForClients extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'loyalty:send-bulk-message-for-clients';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send bulk message for clients';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $bulkMessage = BulkMessage::whereStatus(BulkMessage::STATUS_SENDING)->first();

        if (!$bulkMessage) {
            return;
        }

        $totalSmsReceived = $bulkMessage->total_received;

        try {
            $senderService = new OsonSmsSenderService;
            $clients = Client::where('is_sms_receive', '<>', true)->take(500)->get();

            foreach ($clients as $client) {
                $attributes = $client->only('name');

                $template = TemplateService::replaceAttributes($attributes, $bulkMessage->content);

                $senderService->send($client->phone, $template);

                $client->markAsSmsReceive();

                $totalSmsReceived++;
            }

            $bulkMessage->update([
                'total_received' => $totalSmsReceived,
                'status' => BulkMessage::STATUS_SUCCESS_SEND
            ]);
        } catch (\Exception $e) {
            $bulkMessage->update([
                'total_received' => $totalSmsReceived,
                'status' => BulkMessage::STATUS_SEND_ERROR,
                'send_error_message' => $e->getMessage()
            ]);

            // Send message to telegram
        }
    }
}
