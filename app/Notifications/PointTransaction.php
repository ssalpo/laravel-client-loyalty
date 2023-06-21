<?php

namespace App\Notifications;

use App\Notifications\Channels\OsonSms\OsonSmsChannel;
use App\Notifications\Channels\OsonSms\OsonSmsMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\PointTransaction as PointTransactionModel;

class PointTransaction extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(
        public PointTransactionModel $pointTransaction,
        public float $totalPoints
    )
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return [OsonSmsChannel::class];
    }

    public function toOsonSms(object $notifiable): OsonSmsMessage
    {
        $content = sprintf('Вы использовали свои %.2f бонуса. Баланс: %.2f', $this->pointTransaction->amount, $this->totalPoints);

        return (new OsonSmsMessage)
            ->content($content)
            ->to($notifiable->phone);
    }
}
