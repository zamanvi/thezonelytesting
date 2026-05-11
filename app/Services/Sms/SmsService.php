<?php

namespace App\Services\Sms;

use App\Models\Setting;
use Illuminate\Support\Facades\Cache;

class SmsService
{
    private SmsProviderInterface $provider;

    public function __construct()
    {
        $this->provider = match (self::activeProvider()) {
            'telnyx' => new TelnyxAdapter(),
            default  => new TwilioAdapter(),
        };
    }

    public function send(string $to, string $body): bool
    {
        return $this->provider->send($to, $body);
    }

    public function isConfigured(): bool
    {
        return match (self::activeProvider()) {
            'telnyx' => (bool) (Cache::remember('sms_telnyx_key', 3600, fn() => Setting::get('telnyx_api_key')) ?: config('services.telnyx.api_key')),
            default  => (bool) (Cache::remember('sms_twilio_sid', 3600, fn() => Setting::get('twilio_sid')) ?: config('services.twilio.sid')),
        };
    }

    public static function activeProvider(): string
    {
        return Cache::remember('sms_provider', 3600, fn() => Setting::get('sms_provider', 'twilio'));
    }
}
