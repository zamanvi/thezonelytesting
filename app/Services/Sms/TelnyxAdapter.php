<?php

namespace App\Services\Sms;

use App\Models\Setting;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TelnyxAdapter implements SmsProviderInterface
{
    public function send(string $to, string $body): bool
    {
        $apiKey = Setting::get('telnyx_api_key') ?: config('services.telnyx.api_key');
        $from   = Setting::get('telnyx_from')    ?: config('services.telnyx.from');

        if (!$apiKey || !$from) return false;

        try {
            $response = Http::withToken($apiKey)
                ->post('https://api.telnyx.com/v2/messages', [
                    'from' => $from,
                    'to'   => $to,
                    'text' => $body,
                ]);
            return $response->successful();
        } catch (\Exception $e) {
            Log::error('Telnyx SMS failed: ' . $e->getMessage());
            return false;
        }
    }
}
