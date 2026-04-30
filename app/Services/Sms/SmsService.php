<?php

namespace App\Services\Sms;

use App\Models\Setting;

class SmsService
{
    private SmsProviderInterface $provider;

    public function __construct()
    {
        $this->provider = match (Setting::get('sms_provider', 'twilio')) {
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
        $provider = Setting::get('sms_provider', 'twilio');

        return match ($provider) {
            'telnyx' => (bool) (Setting::get('telnyx_api_key') ?: config('services.telnyx.api_key')),
            default  => (bool) (Setting::get('twilio_sid') ?: config('services.twilio.sid')),
        };
    }

    public static function activeProvider(): string
    {
        return Setting::get('sms_provider', 'twilio');
    }
}
