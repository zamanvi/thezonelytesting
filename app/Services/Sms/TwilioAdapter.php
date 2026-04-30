<?php

namespace App\Services\Sms;

use App\Models\Setting;
use Twilio\Rest\Client;
use Illuminate\Support\Facades\Log;

class TwilioAdapter implements SmsProviderInterface
{
    public function send(string $to, string $body): bool
    {
        $sid   = Setting::get('twilio_sid')   ?: config('services.twilio.sid');
        $token = Setting::get('twilio_token') ?: config('services.twilio.token');
        $from  = Setting::get('twilio_from')  ?: config('services.twilio.from');

        if (!$sid || !$token || !$from) return false;

        try {
            (new Client($sid, $token))->messages->create($to, ['from' => $from, 'body' => $body]);
            return true;
        } catch (\Exception $e) {
            Log::error('Twilio SMS failed: ' . $e->getMessage());
            return false;
        }
    }
}
