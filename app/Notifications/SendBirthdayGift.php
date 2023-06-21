<?php

namespace App\Notifications;

use App\Notifications\Channels\OsonSms\OsonSmsChannel;
use App\Notifications\Channels\OsonSms\OsonSmsMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SendBirthdayGift extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(
        public string $template
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
        return (new OsonSmsMessage)
            ->content('Test message')
            ->to($notifiable->phone);
    }
}
