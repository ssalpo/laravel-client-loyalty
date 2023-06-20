<?php

namespace App\Jobs;

use App\Models\Client;
use App\Models\Point;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class RecalculateClientTotalPoints implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public int $clientId
    )
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $client = Client::find($this->clientId);

        if (!$client) {
            return;
        }

        $totalPoints = Point::whereClientId($this->clientId)->sum('amount');

        $client->update(['total_points' => $totalPoints]);
    }
}
