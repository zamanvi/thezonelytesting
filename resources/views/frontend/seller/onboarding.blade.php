@extends('frontend.layouts._app')
@section('title', 'Complete Your Profile — Zonely')

@section('content')
@php
    $cat = strtolower($user->category?->title ?? '');
    $isPro      = str_contains($cat, 'professional');
    $isHealth   = str_contains($cat, 'health');
    $isHome     = str_contains($cat, 'home');
    $isBeauty   = str_contains($cat, 'beauty');

    // Completion checks
    $done = [
        'basics'      => filled($user->business_name) || filled($user->title),
        'bio'         => filled($user->bio),
        'location'    => filled($user->city) || filled($user->zip_code),
        'contact'     => filled($user->whatsapp) || $user->contacts()->count() > 0,
        'services'    => $user->services->count() > 0,
        'education'   => $user->educations->count() > 0,
        'memberships' => $user->memberships->count() > 0,
        'languages'   => $user->languages->count() > 0,
    ];

    // Which sections this category shows
    $showEducation   = $isPro || $isHealth || $isHome;
    $showMemberships = $isPro || $isHealth;
    $showLanguages   = $isPro || $isHealth;

    // Calculate % complete
    $total = 5 + ($showEducation ? 1 : 0) + ($showMemberships ? 1 : 0) + ($showLanguages ? 1 : 0);
    $completed = collect($done)->only(
        array_filter([
            'basics', 'bio', 'location', 'contact', 'services',
            $showEducation   ? 'education'   : null,
            $showMemberships ? 'memberships' : null,
            $showLanguages   ? 'languages'   : null,
        ])
    )->filter()->count();
    $pct = $total > 0 ? round($completed / $total * 100) : 0;
@endphp

<div class="min-h-screen bg-slate-50 pt-20 pb-16 px-4">
<div class="max-w-4xl mx-auto">
    @include('frontend.seller._nav')
    {{-- Flash --}}
    @if(session('success'))
        <div class="bg-green-50 border border-green-200 rounded-2xl px-5 py-3 mb-6 flex items-center gap-3">
            <i class="fa-solid fa-circle-check text-green-500"></i>
            <p class="text-sm text-green-700 font-semibold">{{ session('success') }}</p>
        </div>
    @endif

    {{-- Header --}}
    <div class="bg-white rounded-3xl border border-slate-100 shadow-sm p-6 sm:p-8 mb-6">
        <div class="flex items-center gap-4">
            <div class="w-14 h-14 rounded-2xl bg-blue-600 flex items-center justify-center shrink-0 overflow-hidden shadow">
                @if($user->profile_photo)
                    <img src="{{ asset($user->profile_photo) }}" class="w-full h-full object-cover">
                @else
                    <span class="text-white font-black text-xl">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                @endif
            </div>
            <div>
                <h1 class="text-2xl font-bold text-slate-900">{{ $user->name }}</h1>
                <p class="text-sm text-slate-500 mt-0.5">
                    {{ $user->category?->title ?? 'No category selected' }}
                    @if(!$user->category)
                        · <a href="{{ route('user.register.category') }}" class="text-blue-600 hover:underline">Select category</a>
                    @endif
                </p>
            </div>
        </div>

        {{-- Progress bar --}}
        <div class="mt-5">
            <div class="flex justify-between items-center mb-1.5">
                <span class="text-sm font-bold text-slate-700">Profile Completion</span>
                <span class="text-sm font-black {{ $pct >= 80 ? 'text-green-600' : 'text-blue-600' }}">{{ $pct }}%</span>
            </div>
            <div class="w-full bg-slate-100 rounded-full h-3">
                <div class="h-3 rounded-full transition-all duration-500 {{ $pct >= 80 ? 'bg-green-500' : 'bg-blue-600' }}"
                     style="width: {{ $pct }}%"></div>
            </div>
            <p class="text-sm text-slate-400 mt-1.5">{{ $completed }} of {{ $total }} sections complete · {{ $pct >= 80 ? 'Great job! Your profile is ready.' : 'Complete all sections to start receiving leads.' }}</p>
        </div>
    </div>

    {{-- Step 3 indicator --}}
    <div class="flex items-center justify-center gap-2 mb-6">
        <div class="flex items-center gap-1.5">
            <div class="w-6 h-6 bg-green-500 rounded-full flex items-center justify-center"><i class="fa-solid fa-check text-white text-xs"></i></div>
            <span class="text-xs font-bold text-green-600 hidden sm:inline">Account</span>
        </div>
        <div class="w-6 h-px bg-green-300"></div>
        <div class="flex items-center gap-1.5">
            <div class="w-6 h-6 bg-green-500 rounded-full flex items-center justify-center"><i class="fa-solid fa-check text-white text-xs"></i></div>
            <span class="text-xs font-bold text-green-600 hidden sm:inline">Business Type</span>
        </div>
        <div class="w-6 h-px bg-blue-300"></div>
        <div class="flex items-center gap-1.5">
            <div class="w-6 h-6 bg-blue-600 rounded-full flex items-center justify-center text-white text-xs font-black">3</div>
            <span class="text-xs font-bold text-blue-600 hidden sm:inline">Profile Setup</span>
        </div>
    </div>

    {{-- Sections grid --}}
    <div class="grid sm:grid-cols-2 gap-4">

        {{-- 1. Business Basics --}}
        <x-onboarding-card
            title="Business Basics"
            desc="Business name, owner name, phone number"
            icon="fa-building"
            :done="$done['basics']"
            :href="route('type.profile', ['seller', 'account'])"
            required="true"
        />

        {{-- 2. Profile & Bio --}}
        <x-onboarding-card
            title="Profile & Bio"
            desc="Photo, professional title, years of experience, about you"
            icon="fa-user-circle"
            :done="$done['bio']"
            :href="route('type.profile', ['seller', 'profile'])"
            required="true"
        />

        {{-- 3. Service Location --}}
        <x-onboarding-card
            title="Service Location"
            desc="City, state, zip code, service area radius"
            icon="fa-location-dot"
            :done="$done['location']"
            :href="route('type.profile', ['seller', 'service_location'])"
            required="true"
        />

        {{-- 4. Contact Info --}}
        <x-onboarding-card
            title="Contact Info"
            desc="WhatsApp, website, social media links"
            icon="fa-address-card"
            :done="$done['contact']"
            :href="route('type.profile', ['seller', 'contact'])"
            required="true"
        />

        {{-- 5. Services & Pricing --}}
        <x-onboarding-card
            title="Services & Pricing"
            desc="List the services you offer with pricing details"
            icon="fa-list-check"
            :done="$done['services']"
            :href="route('user.services.index')"
            required="true"
        />

        {{-- 6. Education & Certifications (Pro + Health + Home) --}}
        @if($showEducation)
        <x-onboarding-card
            title="{{ $isHome ? 'Licenses & Certifications' : 'Education & Certifications' }}"
            desc="{{ $isHome ? 'Trade licenses, insurance, bonding certificates' : 'Degrees, certifications, professional qualifications' }}"
            icon="fa-graduation-cap"
            :done="$done['education']"
            :href="route('user.educations.index')"
        />
        @endif

        {{-- 7. Memberships & Associations (Pro + Health) --}}
        @if($showMemberships)
        <x-onboarding-card
            title="Memberships & Associations"
            desc="Bar associations, medical boards, professional organizations"
            icon="fa-id-badge"
            :done="$done['memberships']"
            :href="route('user.memberships.index')"
        />
        @endif

        {{-- 8. Languages (Pro + Health) --}}
        @if($showLanguages)
        <x-onboarding-card
            title="Languages Spoken"
            desc="Languages you can serve clients in"
            icon="fa-language"
            :done="$done['languages']"
            :href="route('user.languages.index')"
        />
        @endif

    </div>

    {{-- Bottom CTA --}}
    <div class="mt-8 flex flex-col sm:flex-row items-center justify-between gap-4 bg-white rounded-3xl border border-slate-100 shadow-sm p-6">
        <div>
            @if($pct >= 80)
                <p class="font-black text-slate-900">Your profile looks great!</p>
                <p class="text-sm text-slate-500 mt-0.5">You're ready to start receiving verified leads.</p>
            @else
                <p class="font-black text-slate-900">Keep going — {{ 100 - $pct }}% left</p>
                <p class="text-sm text-slate-500 mt-0.5">Complete sellers get 3× more leads on average.</p>
            @endif
        </div>
        <div class="flex gap-3">
            <a href="{{ route('frontend.service.show', $user->slug) }}"
               target="_blank"
               class="px-6 py-3 rounded-2xl bg-blue-600 hover:bg-blue-700 text-white text-base font-bold flex items-center gap-2 transition">
                <i class="fa-solid fa-eye"></i> Preview My Page
            </a>
        </div>
    </div>

</div>
</div>
@endsection
