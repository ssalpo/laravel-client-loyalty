<?php

namespace App\Notifications\Channels\OsonSms;

use App\Services\SMS\OsonSmsSenderService;
use Illuminate\Notifications\Notification;

class OsonSmsChannel
{
    /**
     * Send the given notification.
     */
    public function send(object $notifiable, Notification $notification): void
    {
        $message = $notification->toOsonSms($notifiable);

        if (is_string($message)) {
            $message = new OsonSmsMessage($message);
        }

        (new OsonSmsSenderService)->send($message->to, $message->content);
    }
}
