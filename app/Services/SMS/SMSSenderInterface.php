<?php

namespace App\Services\SMS;

use Illuminate\Http\Client\RequestException;

interface SMSSenderInterface
{
    /**
     * @param string $phoneNumber
     * @param string $template
     * @return bool
     * @throws RequestException
     */
    public function send(string $phoneNumber, string $template): bool;

    /**
     * @return bool
     * @throws RequestException
     */
    public function hasBalance(): bool;
}
