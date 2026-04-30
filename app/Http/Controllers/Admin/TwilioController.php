<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\User;
use App\Services\Sms\SmsService;
use Illuminate\Http\Request;

class TwilioController extends Controller
{
    public function settings()
    {
        $configured = (new SmsService())->isConfigured();
        $provider   = SmsService::activeProvider();
        return view('admin.twilio.settings', compact('configured', 'provider'));
    }

    public function settingsUpdate(Request $request)
    {
        $provider = $request->input('sms_provider', 'twilio');
        Setting::set('sms_provider', $provider);

        if ($provider === 'telnyx') {
            $request->validate([
                'telnyx_api_key' => 'required|string|max:255',
                'telnyx_from'    => 'required|string|max:20',
            ]);
            Setting::set('telnyx_api_key', $request->telnyx_api_key);
            Setting::set('telnyx_from',    $request->telnyx_from);
        } else {
            $request->validate([
                'twilio_sid'   => 'required|string|max:255',
                'twilio_token' => 'required|string|max:255',
                'twilio_from'  => 'required|string|max:20',
            ]);
            Setting::set('twilio_sid',   $request->twilio_sid);
            Setting::set('twilio_token', $request->twilio_token);
            Setting::set('twilio_from',  $request->twilio_from);
        }

        return back()->with('success', ucfirst($provider) . ' credentials saved.');
    }

    public function sellers()
    {
        $sellers    = User::where('type', 'seller')->orderBy('name')->get();
        $configured = (new SmsService())->isConfigured();
        $provider   = SmsService::activeProvider();
        return view('admin.twilio.sellers', compact('sellers', 'configured', 'provider'));
    }

    public function toggle($id)
    {
        $user = User::where('type', 'seller')->findOrFail($id);
        $user->update(['twilio_enabled' => !$user->twilio_enabled]);
        $state = $user->twilio_enabled ? 'enabled' : 'disabled';
        return back()->with('success', "SMS notifications {$state} for {$user->name}.");
    }

    public function testSms($id)
    {
        $user = User::where('type', 'seller')->findOrFail($id);

        if (!$user->phone) {
            return back()->with('error', "No phone number set for {$user->name}.");
        }

        $provider = SmsService::activeProvider();
        $sent     = (new SmsService())->send(
            $user->phone,
            "Zonely test: SMS connected via " . ucfirst($provider) . " for {$user->name}! You'll receive lead notifications here."
        );

        return back()->with(
            $sent ? 'success' : 'error',
            $sent ? "Test SMS sent to {$user->phone}." : 'SMS failed — check credentials or phone format (+1XXXXXXXXXX).'
        );
    }
}
