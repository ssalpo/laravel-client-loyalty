<?php

namespace App\Jobs;

use App\Models\Client;
use App\Models\Point;
use App\Models\PointTransaction;
use App\Notifications\PointAdd;
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
        public Point $point,
        public bool  $shouldNotifyToClient = false
    )
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $client = Client::find($this->point->client_id);

        if (!$client) {
            return;
        }

        $totalPoints = Point::whereClientId($this->point->client_id)->sum('amount');
        $totalPointTransactions = PointTransaction::whereClientId($this->point->client_id)->sum('amount');

        $client->update(['total_points' => $totalPoints - $totalPointTransactions]);

        if ($this->shouldNotifyToClient) {
            $client->notify(new PointAdd($this->point, $client->total_points));
        }
    }
}
