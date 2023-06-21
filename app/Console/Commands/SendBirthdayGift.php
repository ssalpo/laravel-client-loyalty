<?php

namespace App\Console\Commands;

use App\Services\ClientService;
use Illuminate\Console\Command;

class SendBirthdayGift extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'loyalty:send-birthday-gift';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check all clients birthday and send gift for them';

    /**
     * Execute the console command.
     */
    public function handle(ClientService $clientService)
    {
         $clientService->sendBirthdayGift();

        logger('send gift from cron');
    }
}
