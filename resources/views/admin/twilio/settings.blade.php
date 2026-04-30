@extends('layouts.admin2')
@section('title', 'SMS Settings')

@section('content')
<div class="mt-5 pt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="mb-0 fw-bold"><i class="fas fa-phone-volume text-danger me-2"></i>SMS Settings</h4>
            <p class="text-muted small mb-0">Global SMS provider — used for all seller lead notifications</p>
        </div>
        <a href="{{ route('admin.twilio.sellers') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-users me-1"></i> Manage Sellers
        </a>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">{{ session('success') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
    @endif
    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show">{{ session('error') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
    @endif

    <div class="row g-4">
        <div class="col-lg-7">
            <div class="section-card">
                <div class="card-header bg-danger text-white p-3">
                    <h6 class="mb-0"><i class="fas fa-key me-2"></i>Provider & Credentials</h6>
                </div>
                <div class="card-body p-4">

                    @if($configured)
                    <div class="alert alert-success d-flex align-items-center gap-2 mb-4">
                        <i class="fas fa-circle-check"></i>
                        <strong>{{ ucfirst($provider) }} connected.</strong> Seller SMS notifications active.
                    </div>
                    @else
                    <div class="alert alert-warning d-flex align-items-center gap-2 mb-4">
                        <i class="fas fa-triangle-exclamation"></i>
                        <strong>Not configured.</strong> Select provider and enter credentials.
                    </div>
                    @endif

                    <form method="POST" action="{{ route('admin.twilio.settings.update') }}" id="smsForm">
                        @csrf

                        {{-- Provider selector --}}
                        <div class="mb-4">
                            <label class="form-label fw-semibold">SMS Provider</label>
                            <div class="d-flex gap-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="sms_provider"
                                           id="provTwilio" value="twilio"
                                           {{ $provider === 'twilio' ? 'checked' : '' }}
                                           onchange="switchProvider('twilio')">
                                    <label class="form-check-label fw-semibold" for="provTwilio">
                                        <i class="fas fa-phone text-danger me-1"></i> Twilio
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="sms_provider"
                                           id="provTelnyx" value="telnyx"
                                           {{ $provider === 'telnyx' ? 'checked' : '' }}
                                           onchange="switchProvider('telnyx')">
                                    <label class="form-check-label fw-semibold" for="provTelnyx">
                                        <i class="fas fa-phone text-primary me-1"></i> Telnyx
                                    </label>
                                </div>
                            </div>
                        </div>

                        {{-- Twilio fields --}}
                        <div id="twilioFields" class="{{ $provider !== 'twilio' ? 'd-none' : '' }}">
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Account SID</label>
                                <input type="text" name="twilio_sid"
                                       value="{{ \App\Models\Setting::get('twilio_sid') }}"
                                       class="form-control font-monospace"
                                       placeholder="ACxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx">
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Auth Token</label>
                                <div class="input-group">
                                    <input type="password" id="authToken" name="twilio_token"
                                           value="{{ \App\Models\Setting::get('twilio_token') }}"
                                           class="form-control font-monospace" placeholder="Your Auth Token">
                                    <button type="button" class="btn btn-outline-secondary"
                                            onclick="const f=document.getElementById('authToken');f.type=f.type==='password'?'text':'password'">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="mb-4">
                                <label class="form-label fw-semibold">From Number</label>
                                <input type="text" name="twilio_from"
                                       value="{{ \App\Models\Setting::get('twilio_from') }}"
                                       class="form-control" placeholder="+1XXXXXXXXXX">
                                <div class="form-text">E.164 format: +1XXXXXXXXXX</div>
                            </div>
                        </div>

                        {{-- Telnyx fields --}}
                        <div id="telnyxFields" class="{{ $provider !== 'telnyx' ? 'd-none' : '' }}">
                            <div class="mb-3">
                                <label class="form-label fw-semibold">API Key</label>
                                <div class="input-group">
                                    <input type="password" id="telnyxKey" name="telnyx_api_key"
                                           value="{{ \App\Models\Setting::get('telnyx_api_key') }}"
                                           class="form-control font-monospace" placeholder="KEY...">
                                    <button type="button" class="btn btn-outline-secondary"
                                            onclick="const f=document.getElementById('telnyxKey');f.type=f.type==='password'?'text':'password'">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="mb-4">
                                <label class="form-label fw-semibold">From Number</label>
                                <input type="text" name="telnyx_from"
                                       value="{{ \App\Models\Setting::get('telnyx_from') }}"
                                       class="form-control" placeholder="+1XXXXXXXXXX">
                                <div class="form-text">E.164 format: +1XXXXXXXXXX</div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-danger px-4">
                            <i class="fas fa-save me-1"></i> Save Credentials
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-5">
            <div class="section-card mb-4">
                <div class="card-header bg-dark text-white p-3">
                    <h6 class="mb-0"><i class="fas fa-arrows-rotate me-2"></i>Switching Providers</h6>
                </div>
                <div class="card-body p-4">
                    <ol class="small text-muted ps-3 mb-0" style="line-height:2.2">
                        <li>Select new provider above</li>
                        <li>Enter new credentials</li>
                        <li>Click <strong>Save Credentials</strong></li>
                        <li>All seller SMS routes through new provider instantly</li>
                    </ol>
                    <div class="alert alert-info mt-3 mb-0 small">
                        Old credentials stay saved — switching back is just selecting the provider again.
                    </div>
                </div>
            </div>

            <div class="section-card">
                <div class="card-header bg-secondary text-white p-3">
                    <h6 class="mb-0"><i class="fas fa-message me-2"></i>SMS Preview</h6>
                </div>
                <div class="card-body p-4">
                    <div class="bg-light rounded-3 p-3 font-monospace small text-muted" style="border-left:4px solid #0d6efd">
                        🔔 New Zonely Lead!<br>
                        Name: John Smith<br>
                        Phone: +1 (347) 555-1289<br>
                        Service: Tax Preparation<br>
                        Message: I need help filing...<br><br>
                        View: {{ url('seller/dashboard') }}
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
function switchProvider(p) {
    document.getElementById('twilioFields').classList.toggle('d-none', p !== 'twilio');
    document.getElementById('telnyxFields').classList.toggle('d-none', p !== 'telnyx');
}
</script>
@endsection
