<?php

namespace App\Services\SMS;

use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;

class OsonSmsSenderService implements SMSSenderInterface
{
    /**
     * @throws RequestException
     */
    public function send(string $phoneNumber, string $template): bool
    {
        if (!config('services.sms.enabled')) {
            logger()?->info(implode(';', [
                $phoneNumber,
                $template
            ]));

            return true;
        }

        $params = $this->prepareSendSmsParams(
            $phoneNumber,
            $template
        );

        $response = Http::get(
            config('services.osonsms.server') . '/sendsms_v1.php',
            $params
        );

        $response->throwIfClientError();

        return $response->ok();
    }

    /**
     * @return bool
     * @throws RequestException
     */
    public function hasBalance(): bool
    {
        if (!config('services.sms.enabled')) {
            return true;
        }

        $params = $this->prepareCheckBalanceParams();

        $response = Http::get(
            config('services.osonsms.server') . '/check_balance.php',
            $params
        );

        $response->throwIfClientError();

        return $response->ok() && $response->json('balance') > 0;
    }

    private function prepareSendSmsParams(string $phoneNumber, string $msgTemplate): array
    {
        $txnID = uniqid('', true);

        $hasParams = [
            $txnID,
            config('services.osonsms.login'),
            config('services.sms.sender'),
            $phoneNumber,
            config('services.osonsms.hash')
        ];

        $strHash = hash('sha256', implode(';', $hasParams));

        return [
            'from' => config('services.sms.sender'),
            'phone_number' => $phoneNumber,
            'msg' => $msgTemplate,
            'str_hash' => $strHash,
            'txn_id' => $txnID,
            'login' => config('services.osonsms.login'),
        ];
    }

    private function prepareCheckBalanceParams(): array
    {
        $txnID = uniqid('', true);

        $hasParams = [
            $txnID,
            config('services.osonsms.login'),
            config('services.osonsms.hash')
        ];

        $strHash = hash('sha256', implode(';', $hasParams));

        return [
            'str_hash' => $strHash,
            'txn_id' => $txnID,
            'login' => config('services.osonsms.login'),
        ];
    }
}
