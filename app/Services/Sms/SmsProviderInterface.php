<?php

namespace App\Services\Sms;

interface SmsProviderInterface
{
    public function send(string $to, string $body): bool;
}
