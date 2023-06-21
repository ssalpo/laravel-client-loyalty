<?php

namespace App\Notifications;

use App\Models\Point;
use App\Notifications\Channels\OsonSms\OsonSmsChannel;
use App\Notifications\Channels\OsonSms\OsonSmsMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PointAdd extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(
        public Point $point,
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
        $content = sprintf('Вам начислено %.2f бонусов. Баланс: %.2f', $this->point->amount, $this->totalPoints);

        return (new OsonSmsMessage)
            ->content($content)
            ->to($notifiable->phone);
    }
}
