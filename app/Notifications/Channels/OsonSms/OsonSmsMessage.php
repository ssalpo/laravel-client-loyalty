<?php

namespace App\Notifications\Channels\OsonSms;

class OsonSmsMessage
{
    public string $content;

    public string $to;

    public function __construct(string $content = '')
    {
        $this->content = $content;
    }

    public function content(string $text): static
    {
        $this->content = $text;

        return $this;
    }

    public function to(string $to): static
    {
        $this->to = $to;

        return $this;
    }
}
