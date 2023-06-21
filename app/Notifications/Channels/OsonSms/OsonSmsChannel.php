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

        if (config('services.sms.enabled')) {
            (new OsonSmsSenderService)->send($message->to, $message->content);
        } else {
            logger()?->info(
                sprintf(
                    'Отправлено СМС: \n Отправитель: %s \n Сообщение: %s',
                    $message->to,
                    $message->content
                )
            );
        }
    }
}
