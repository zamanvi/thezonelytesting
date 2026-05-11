@extends('frontend.layouts.__prof_app')
@section('title', 'Build Your Page — Zonely')

@section('content')
@php
    $cat = strtolower($user->category?->title ?? '');
    $isPro    = str_contains($cat, 'professional');
    $isHealth = str_contains($cat, 'health');
    $isHome   = str_contains($cat, 'home');
    $isBeauty = str_contains($cat, 'beauty');

    $done = [
        'basics'      => filled($user->business_name) || filled($user->title),
        'bio'         => filled($user->bio),
        'location'    => filled($user->city) || filled($user->zip_code),
        'contact'     => filled($user->whatsapp) || $user->contacts()->count() > 0,
        'services'    => $user->services->count() > 0,
        'education'   => $user->educations->count() > 0,
        'memberships' => $user->memberships->count() > 0,
        'languages'   => $user->languages->count() > 0,
        'faqs'        => $user->faqs->count() > 0,
    ];

    $showEducation   = $isPro || $isHealth || $isHome;
    $showMemberships = $isPro || $isHealth;
    $showLanguages   = $isPro || $isHealth;

    $total = 6 + ($showEducation ? 1 : 0) + ($showMemberships ? 1 : 0) + ($showLanguages ? 1 : 0);
    $completed = collect($done)->only(
        array_filter([
            'basics', 'bio', 'location', 'contact', 'services', 'faqs',
            $showEducation   ? 'education'   : null,
            $showMemberships ? 'memberships' : null,
            $showLanguages   ? 'languages'   : null,
        ])
    )->filter()->count();
    $pct = $total > 0 ? round($completed / $total * 100) : 0;
@endphp

<div class="pb-12 max-w-4xl mx-auto">

    {{-- Flash --}}
    @if(session('success'))
    <div class="bg-emerald-50 border border-emerald-200 rounded-2xl px-5 py-3 mb-5 flex items-center gap-3">
        <i class="fa-solid fa-circle-check text-emerald-500"></i>
        <p class="text-sm text-emerald-700 font-semibold">{{ session('success') }}</p>
    </div>
    @endif

    {{-- Page URL Banner --}}
    <div class="bg-slate-900 rounded-2xl px-5 py-3.5 mb-6 flex items-center justify-between gap-4">
        <div class="flex items-center gap-2 min-w-0">
            <span class="w-2 h-2 bg-emerald-400 rounded-full shrink-0 animate-pulse"></span>
            <span class="text-xs text-slate-400 font-medium shrink-0">Your live page:</span>
            <span class="text-sm text-white font-mono truncate">thezonely.com/{{ $user->slug }}</span>
        </div>
        <a href="{{ route('frontend.service.show', $user->slug) }}" target="_blank"
           class="shrink-0 flex items-center gap-1.5 text-xs font-bold text-teal-400 hover:text-teal-300 transition">
            <i class="fa-solid fa-arrow-up-right-from-square text-[11px]"></i> Preview
        </a>
    </div>

    {{-- Progress Header --}}
    <div class="bg-white rounded-3xl border border-slate-100 shadow-sm p-6 mb-6">
        <div class="flex items-center gap-4 mb-5">
            <div class="w-14 h-14 rounded-2xl bg-teal-700 flex items-center justify-center shrink-0 overflow-hidden shadow">
                @if($user->profile_photo)
                    <img src="{{ asset($user->profile_photo) }}" class="w-full h-full object-cover">
                @else
                    <span class="text-white font-black text-xl">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                @endif
            </div>
            <div class="flex-1 min-w-0">
                <h1 class="text-xl font-bold text-slate-900 truncate">{{ $user->name }}</h1>
                <p class="text-sm text-slate-500 mt-0.5 flex items-center gap-2">
                    <span>{{ $user->category?->title ?? 'No category' }}</span>
                    @if(!$user->category)
                        · <a href="{{ route('user.register.category') }}" class="text-teal-700 hover:underline">Select category</a>
                    @endif
                </p>
            </div>
            @if($pct >= 80)
            <span class="shrink-0 px-3 py-1.5 bg-emerald-100 text-emerald-700 text-xs font-bold rounded-xl flex items-center gap-1">
                <i class="fa-solid fa-circle-check"></i> Page Ready
            </span>
            @endif
        </div>

        <div class="flex justify-between items-center mb-2">
            <span class="text-sm font-bold text-slate-700">Page Completion</span>
            <span class="text-sm font-black {{ $pct >= 80 ? 'text-emerald-600' : 'text-teal-700' }}">{{ $pct }}%</span>
        </div>
        <div class="w-full bg-slate-100 rounded-full h-2.5 mb-2">
            <div class="h-2.5 rounded-full transition-all duration-500 {{ $pct >= 80 ? 'bg-emerald-500' : 'bg-teal-700' }}"
                 style="width: {{ $pct }}%"></div>
        </div>
        <p class="text-xs text-slate-400">{{ $completed }} of {{ $total }} sections complete
            · {{ $pct >= 80 ? 'Your page is live and ready to receive leads.' : 'Complete all sections to maximise lead conversions.' }}
        </p>
    </div>

    {{-- Section Cards --}}
    <div class="grid sm:grid-cols-2 gap-4">

        {{-- 1. Business Basics --}}
        @php $isDone = $done['basics']; @endphp
        <a href="{{ route('type.profile', ['seller', 'account']) }}"
           class="group block bg-white rounded-2xl border-2 {{ $isDone ? 'border-emerald-200' : 'border-dashed border-slate-200 hover:border-teal-300' }} shadow-sm p-5 transition-all hover:shadow-md">
            <div class="flex items-start justify-between gap-3 mb-3">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 {{ $isDone ? 'bg-emerald-100' : 'bg-teal-50' }} rounded-xl flex items-center justify-center shrink-0">
                        <i class="fa-solid fa-building {{ $isDone ? 'text-emerald-600' : 'text-teal-600' }} text-sm"></i>
                    </div>
                    <div>
                        <p class="font-bold text-slate-900 text-sm">Business Basics</p>
                        <p class="text-[10px] text-slate-400 font-medium uppercase tracking-wide">→ Your name, business & phone number</p>
                    </div>
                </div>
                @if($isDone)
                    <span class="shrink-0 text-[10px] font-bold px-2 py-1 bg-emerald-100 text-emerald-700 rounded-lg">Complete</span>
                @else
                    <span class="shrink-0 text-[10px] font-bold px-2 py-1 bg-red-50 text-red-500 rounded-lg">Required</span>
                @endif
            </div>
            @if($isDone)
                <div class="bg-slate-50 rounded-xl px-3 py-2.5 text-xs text-slate-600 space-y-0.5">
                    @if($user->business_name)<p><span class="font-semibold">Business:</span> {{ $user->business_name }}</p>@endif
                    @if($user->title)<p><span class="font-semibold">Title:</span> {{ $user->title }}</p>@endif
                    @if($user->phone)<p><span class="font-semibold">Phone:</span> {{ $user->phone }}</p>@endif
                </div>
            @else
                <p class="text-xs text-slate-400">Business name, owner name, phone number</p>
            @endif
            <div class="mt-3 flex items-center justify-end">
                <span class="text-xs font-bold {{ $isDone ? 'text-slate-400 group-hover:text-teal-700' : 'text-teal-700' }} flex items-center gap-1 transition">
                    <i class="fa-solid {{ $isDone ? 'fa-pen' : 'fa-plus' }} text-[10px]"></i>
                    {{ $isDone ? 'Edit' : 'Add Now' }}
                </span>
            </div>
        </a>

        {{-- 2. Profile & Bio --}}
        @php $isDone = $done['bio']; @endphp
        <a href="{{ route('type.profile', ['seller', 'profile']) }}"
           class="group block bg-white rounded-2xl border-2 {{ $isDone ? 'border-emerald-200' : 'border-dashed border-slate-200 hover:border-teal-300' }} shadow-sm p-5 transition-all hover:shadow-md">
            <div class="flex items-start justify-between gap-3 mb-3">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 {{ $isDone ? 'bg-emerald-100' : 'bg-teal-50' }} rounded-xl flex items-center justify-center shrink-0">
                        <i class="fa-solid fa-user-circle {{ $isDone ? 'text-emerald-600' : 'text-teal-600' }} text-sm"></i>
                    </div>
                    <div>
                        <p class="font-bold text-slate-900 text-sm">Profile & Bio</p>
                        <p class="text-[10px] text-slate-400 font-medium uppercase tracking-wide">→ Photo, title, bio & about description</p>
                    </div>
                </div>
                @if($isDone)
                    <span class="shrink-0 text-[10px] font-bold px-2 py-1 bg-emerald-100 text-emerald-700 rounded-lg">Complete</span>
                @else
                    <span class="shrink-0 text-[10px] font-bold px-2 py-1 bg-red-50 text-red-500 rounded-lg">Required</span>
                @endif
            </div>
            @if($isDone)
                <div class="bg-slate-50 rounded-xl px-3 py-2.5 text-xs text-slate-600">
                    <p class="line-clamp-2 leading-relaxed">{{ $user->bio }}</p>
                </div>
            @else
                <p class="text-xs text-slate-400">Photo, professional title, years of experience, about you</p>
            @endif
            <div class="mt-3 flex items-center justify-end">
                <span class="text-xs font-bold {{ $isDone ? 'text-slate-400 group-hover:text-teal-700' : 'text-teal-700' }} flex items-center gap-1 transition">
                    <i class="fa-solid {{ $isDone ? 'fa-pen' : 'fa-plus' }} text-[10px]"></i>
                    {{ $isDone ? 'Edit' : 'Add Now' }}
                </span>
            </div>
        </a>

        {{-- 3. Service Location --}}
        @php $isDone = $done['location']; @endphp
        <a href="{{ route('type.profile', ['seller', 'service_location']) }}"
           class="group block bg-white rounded-2xl border-2 {{ $isDone ? 'border-emerald-200' : 'border-dashed border-slate-200 hover:border-teal-300' }} shadow-sm p-5 transition-all hover:shadow-md">
            <div class="flex items-start justify-between gap-3 mb-3">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 {{ $isDone ? 'bg-emerald-100' : 'bg-teal-50' }} rounded-xl flex items-center justify-center shrink-0">
                        <i class="fa-solid fa-location-dot {{ $isDone ? 'text-emerald-600' : 'text-teal-600' }} text-sm"></i>
                    </div>
                    <div>
                        <p class="font-bold text-slate-900 text-sm">Service Location</p>
                        <p class="text-[10px] text-slate-400 font-medium uppercase tracking-wide">→ Your city, state & service area</p>
                    </div>
                </div>
                @if($isDone)
                    <span class="shrink-0 text-[10px] font-bold px-2 py-1 bg-emerald-100 text-emerald-700 rounded-lg">Complete</span>
                @else
                    <span class="shrink-0 text-[10px] font-bold px-2 py-1 bg-red-50 text-red-500 rounded-lg">Required</span>
                @endif
            </div>
            @if($isDone)
                <div class="bg-slate-50 rounded-xl px-3 py-2.5 text-xs text-slate-600 space-y-0.5">
                    @php
                        $oc = $user->city    ? (is_numeric($user->city)  ? (\App\Models\City::find($user->city)?->title  ?? $user->city)  : $user->city)  : null;
                        $os = $user->state   ? (is_numeric($user->state) ? (\App\Models\State::find($user->state)?->title ?? $user->state) : $user->state) : null;
                    @endphp
                    @if($oc || $os)<p><span class="font-semibold">Area:</span> {{ collect([$oc, $os])->filter()->implode(', ') }}</p>@endif
                    @if($user->zip_code)<p><span class="font-semibold">ZIP:</span> {{ $user->zip_code }}</p>@endif
                    @if($user->service_radius)<p><span class="font-semibold">Radius:</span> {{ $user->service_radius }} miles</p>@endif
                </div>
            @else
                <p class="text-xs text-slate-400">City, state, zip code, service area radius</p>
            @endif
            <div class="mt-3 flex items-center justify-end">
                <span class="text-xs font-bold {{ $isDone ? 'text-slate-400 group-hover:text-teal-700' : 'text-teal-700' }} flex items-center gap-1 transition">
                    <i class="fa-solid {{ $isDone ? 'fa-pen' : 'fa-plus' }} text-[10px]"></i>
                    {{ $isDone ? 'Edit' : 'Add Now' }}
                </span>
            </div>
        </a>

        {{-- 4. Contact Info --}}
        @php $isDone = $done['contact']; @endphp
        <a href="{{ route('type.profile', ['seller', 'contact']) }}"
           class="group block bg-white rounded-2xl border-2 {{ $isDone ? 'border-emerald-200' : 'border-dashed border-slate-200 hover:border-teal-300' }} shadow-sm p-5 transition-all hover:shadow-md">
            <div class="flex items-start justify-between gap-3 mb-3">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 {{ $isDone ? 'bg-emerald-100' : 'bg-teal-50' }} rounded-xl flex items-center justify-center shrink-0">
                        <i class="fa-solid fa-address-card {{ $isDone ? 'text-emerald-600' : 'text-teal-600' }} text-sm"></i>
                    </div>
                    <div>
                        <p class="font-bold text-slate-900 text-sm">Contact Info</p>
                        <p class="text-[10px] text-slate-400 font-medium uppercase tracking-wide">→ Phone, WhatsApp & contact details</p>
                    </div>
                </div>
                @if($isDone)
                    <span class="shrink-0 text-[10px] font-bold px-2 py-1 bg-emerald-100 text-emerald-700 rounded-lg">Complete</span>
                @else
                    <span class="shrink-0 text-[10px] font-bold px-2 py-1 bg-red-50 text-red-500 rounded-lg">Required</span>
                @endif
            </div>
            @if($isDone)
                <div class="bg-slate-50 rounded-xl px-3 py-2.5 text-xs text-slate-600 space-y-0.5">
                    @if($user->whatsapp)<p><i class="fab fa-whatsapp text-emerald-500 mr-1"></i>{{ $user->whatsapp }}</p>@endif
                    @if($user->website)<p><i class="fa-solid fa-globe text-teal-600 mr-1"></i>{{ $user->website }}</p>@endif
                </div>
            @else
                <p class="text-xs text-slate-400">WhatsApp, website, social media links</p>
            @endif
            <div class="mt-3 flex items-center justify-end">
                <span class="text-xs font-bold {{ $isDone ? 'text-slate-400 group-hover:text-teal-700' : 'text-teal-700' }} flex items-center gap-1 transition">
                    <i class="fa-solid {{ $isDone ? 'fa-pen' : 'fa-plus' }} text-[10px]"></i>
                    {{ $isDone ? 'Edit' : 'Add Now' }}
                </span>
            </div>
        </a>

        {{-- 5. Services & Pricing --}}
        @php $isDone = $done['services']; @endphp
        <a href="{{ route('user.services.index') }}"
           class="group block bg-white rounded-2xl border-2 {{ $isDone ? 'border-emerald-200' : 'border-dashed border-slate-200 hover:border-teal-300' }} shadow-sm p-5 transition-all hover:shadow-md">
            <div class="flex items-start justify-between gap-3 mb-3">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 {{ $isDone ? 'bg-emerald-100' : 'bg-teal-50' }} rounded-xl flex items-center justify-center shrink-0">
                        <i class="fa-solid fa-list-check {{ $isDone ? 'text-emerald-600' : 'text-teal-600' }} text-sm"></i>
                    </div>
                    <div>
                        <p class="font-bold text-slate-900 text-sm">Services & Pricing</p>
                        <p class="text-[10px] text-slate-400 font-medium uppercase tracking-wide">→ List your services & set prices</p>
                    </div>
                </div>
                @if($isDone)
                    <span class="shrink-0 text-[10px] font-bold px-2 py-1 bg-emerald-100 text-emerald-700 rounded-lg">Complete</span>
                @else
                    <span class="shrink-0 text-[10px] font-bold px-2 py-1 bg-red-50 text-red-500 rounded-lg">Required</span>
                @endif
            </div>
            @if($isDone)
                <div class="bg-slate-50 rounded-xl px-3 py-2.5 text-xs text-slate-600">
                    <p class="font-semibold mb-1">{{ $user->services->count() }} service{{ $user->services->count() > 1 ? 's' : '' }} listed</p>
                    <div class="flex flex-wrap gap-1">
                        @foreach($user->services->take(3) as $svc)
                            <span class="px-2 py-0.5 bg-white border border-slate-200 rounded-lg text-slate-500">{{ $svc->title }}</span>
                        @endforeach
                        @if($user->services->count() > 3)
                            <span class="px-2 py-0.5 text-slate-400">+{{ $user->services->count() - 3 }} more</span>
                        @endif
                    </div>
                </div>
            @else
                <p class="text-xs text-slate-400">List the services you offer with pricing details</p>
            @endif
            <div class="mt-3 flex items-center justify-end">
                <span class="text-xs font-bold {{ $isDone ? 'text-slate-400 group-hover:text-teal-700' : 'text-teal-700' }} flex items-center gap-1 transition">
                    <i class="fa-solid {{ $isDone ? 'fa-pen' : 'fa-plus' }} text-[10px]"></i>
                    {{ $isDone ? 'Manage' : 'Add Now' }}
                </span>
            </div>
        </a>

        {{-- 6. Education & Certifications --}}
        @if($showEducation)
        @php $isDone = $done['education']; $eduTitle = $isHome ? 'Licenses & Certifications' : 'Education & Certifications'; @endphp
        <a href="{{ route('user.educations.index') }}"
           class="group block bg-white rounded-2xl border-2 {{ $isDone ? 'border-emerald-200' : 'border-dashed border-slate-200 hover:border-teal-300' }} shadow-sm p-5 transition-all hover:shadow-md">
            <div class="flex items-start justify-between gap-3 mb-3">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 {{ $isDone ? 'bg-emerald-100' : 'bg-teal-50' }} rounded-xl flex items-center justify-center shrink-0">
                        <i class="fa-solid fa-graduation-cap {{ $isDone ? 'text-emerald-600' : 'text-teal-600' }} text-sm"></i>
                    </div>
                    <div>
                        <p class="font-bold text-slate-900 text-sm">{{ $eduTitle }}</p>
                        <p class="text-[10px] text-slate-400 font-medium uppercase tracking-wide">→ Professional Background</p>
                    </div>
                </div>
                @if($isDone)
                    <span class="shrink-0 text-[10px] font-bold px-2 py-1 bg-emerald-100 text-emerald-700 rounded-lg">Complete</span>
                @else
                    <span class="shrink-0 text-[10px] font-bold px-2 py-1 bg-slate-100 text-slate-500 rounded-lg">Optional</span>
                @endif
            </div>
            @if($isDone)
                <div class="bg-slate-50 rounded-xl px-3 py-2.5 text-xs text-slate-600">
                    <p class="font-semibold mb-1">{{ $user->educations->count() }} {{ $isHome ? 'license' : 'credential' }}{{ $user->educations->count() > 1 ? 's' : '' }} added</p>
                    @if($user->educations->first())
                        <p class="text-slate-500 truncate">{{ $user->educations->first()->degree ?? $user->educations->first()->institution ?? '' }}</p>
                    @endif
                </div>
            @else
                <p class="text-xs text-slate-400">{{ $isHome ? 'Trade licenses, insurance, bonding certificates' : 'Degrees, certifications, professional qualifications' }}</p>
            @endif
            <div class="mt-3 flex items-center justify-end">
                <span class="text-xs font-bold {{ $isDone ? 'text-slate-400 group-hover:text-teal-700' : 'text-teal-700' }} flex items-center gap-1 transition">
                    <i class="fa-solid {{ $isDone ? 'fa-pen' : 'fa-plus' }} text-[10px]"></i>
                    {{ $isDone ? 'Manage' : 'Add Now' }}
                </span>
            </div>
        </a>
        @endif

        {{-- 7. Memberships & Associations --}}
        @if($showMemberships)
        @php $isDone = $done['memberships']; @endphp
        <a href="{{ route('user.memberships.index') }}"
           class="group block bg-white rounded-2xl border-2 {{ $isDone ? 'border-emerald-200' : 'border-dashed border-slate-200 hover:border-teal-300' }} shadow-sm p-5 transition-all hover:shadow-md">
            <div class="flex items-start justify-between gap-3 mb-3">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 {{ $isDone ? 'bg-emerald-100' : 'bg-teal-50' }} rounded-xl flex items-center justify-center shrink-0">
                        <i class="fa-solid fa-id-badge {{ $isDone ? 'text-emerald-600' : 'text-teal-600' }} text-sm"></i>
                    </div>
                    <div>
                        <p class="font-bold text-slate-900 text-sm">Memberships & Associations</p>
                        <p class="text-[10px] text-slate-400 font-medium uppercase tracking-wide">→ Professional Background</p>
                    </div>
                </div>
                @if($isDone)
                    <span class="shrink-0 text-[10px] font-bold px-2 py-1 bg-emerald-100 text-emerald-700 rounded-lg">Complete</span>
                @else
                    <span class="shrink-0 text-[10px] font-bold px-2 py-1 bg-slate-100 text-slate-500 rounded-lg">Optional</span>
                @endif
            </div>
            @if($isDone)
                <div class="bg-slate-50 rounded-xl px-3 py-2.5 text-xs text-slate-600">
                    <p class="font-semibold mb-1">{{ $user->memberships->count() }} membership{{ $user->memberships->count() > 1 ? 's' : '' }} added</p>
                    @if($user->memberships->first())
                        <p class="text-slate-500 truncate">{{ $user->memberships->first()->name ?? $user->memberships->first()->organization ?? '' }}</p>
                    @endif
                </div>
            @else
                <p class="text-xs text-slate-400">Bar associations, medical boards, professional organizations</p>
            @endif
            <div class="mt-3 flex items-center justify-end">
                <span class="text-xs font-bold {{ $isDone ? 'text-slate-400 group-hover:text-teal-700' : 'text-teal-700' }} flex items-center gap-1 transition">
                    <i class="fa-solid {{ $isDone ? 'fa-pen' : 'fa-plus' }} text-[10px]"></i>
                    {{ $isDone ? 'Manage' : 'Add Now' }}
                </span>
            </div>
        </a>
        @endif

        {{-- 8. Languages --}}
        @if($showLanguages)
        @php $isDone = $done['languages']; @endphp
        <a href="{{ route('user.languages.index') }}"
           class="group block bg-white rounded-2xl border-2 {{ $isDone ? 'border-emerald-200' : 'border-dashed border-slate-200 hover:border-teal-300' }} shadow-sm p-5 transition-all hover:shadow-md">
            <div class="flex items-start justify-between gap-3 mb-3">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 {{ $isDone ? 'bg-emerald-100' : 'bg-teal-50' }} rounded-xl flex items-center justify-center shrink-0">
                        <i class="fa-solid fa-language {{ $isDone ? 'text-emerald-600' : 'text-teal-600' }} text-sm"></i>
                    </div>
                    <div>
                        <p class="font-bold text-slate-900 text-sm">Languages Spoken</p>
                        <p class="text-[10px] text-slate-400 font-medium uppercase tracking-wide">→ Profile Section</p>
                    </div>
                </div>
                @if($isDone)
                    <span class="shrink-0 text-[10px] font-bold px-2 py-1 bg-emerald-100 text-emerald-700 rounded-lg">Complete</span>
                @else
                    <span class="shrink-0 text-[10px] font-bold px-2 py-1 bg-slate-100 text-slate-500 rounded-lg">Optional</span>
                @endif
            </div>
            @if($isDone)
                <div class="bg-slate-50 rounded-xl px-3 py-2.5 text-xs text-slate-600">
                    <div class="flex flex-wrap gap-1">
                        @foreach($user->languages->take(4) as $lang)
                            <span class="px-2 py-0.5 bg-white border border-slate-200 rounded-lg text-slate-500">{{ $lang->language ?? $lang->name ?? $lang }}</span>
                        @endforeach
                        @if($user->languages->count() > 4)
                            <span class="text-slate-400">+{{ $user->languages->count() - 4 }} more</span>
                        @endif
                    </div>
                </div>
            @else
                <p class="text-xs text-slate-400">Languages you can serve clients in</p>
            @endif
            <div class="mt-3 flex items-center justify-end">
                <span class="text-xs font-bold {{ $isDone ? 'text-slate-400 group-hover:text-teal-700' : 'text-teal-700' }} flex items-center gap-1 transition">
                    <i class="fa-solid {{ $isDone ? 'fa-pen' : 'fa-plus' }} text-[10px]"></i>
                    {{ $isDone ? 'Manage' : 'Add Now' }}
                </span>
            </div>
        </a>
        @endif

        {{-- 9. Q & A --}}
        @php $isDone = $done['faqs']; @endphp
        <a href="{{ route('user.faqs.index') }}"
           class="group block bg-white rounded-2xl border-2 {{ $isDone ? 'border-emerald-200' : 'border-dashed border-slate-200 hover:border-teal-300' }} shadow-sm p-5 transition-all hover:shadow-md">
            <div class="flex items-start justify-between gap-3 mb-3">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 {{ $isDone ? 'bg-emerald-100' : 'bg-teal-50' }} rounded-xl flex items-center justify-center shrink-0">
                        <i class="fa-solid fa-circle-question {{ $isDone ? 'text-emerald-600' : 'text-teal-600' }} text-sm"></i>
                    </div>
                    <div>
                        <p class="font-bold text-slate-900 text-sm">Q & A</p>
                        <p class="text-[10px] text-slate-400 font-medium uppercase tracking-wide">→ Answer common questions from clients</p>
                    </div>
                </div>
                @if($isDone)
                    <span class="shrink-0 text-[10px] font-bold px-2 py-1 bg-emerald-100 text-emerald-700 rounded-lg">Complete</span>
                @else
                    <span class="shrink-0 text-[10px] font-bold px-2 py-1 bg-slate-100 text-slate-500 rounded-lg">Optional</span>
                @endif
            </div>
            @if($isDone)
                <div class="bg-slate-50 rounded-xl px-3 py-2.5 text-xs text-slate-600">
                    <p class="font-semibold mb-1">{{ $user->faqs->count() }} question{{ $user->faqs->count() > 1 ? 's' : '' }} added</p>
                    @if($user->faqs->first())
                        <p class="text-slate-500 truncate">{{ $user->faqs->first()->question }}</p>
                    @endif
                </div>
            @else
                <p class="text-xs text-slate-400">Common questions clients ask — builds trust before they contact you</p>
            @endif
            <div class="mt-3 flex items-center justify-end">
                <span class="text-xs font-bold {{ $isDone ? 'text-slate-400 group-hover:text-teal-700' : 'text-teal-700' }} flex items-center gap-1 transition">
                    <i class="fa-solid {{ $isDone ? 'fa-pen' : 'fa-plus' }} text-[10px]"></i>
                    {{ $isDone ? 'Manage' : 'Add Now' }}
                </span>
            </div>
        </a>

    </div>

    {{-- Bottom CTA --}}
    <div class="mt-6 bg-white rounded-3xl border border-slate-100 shadow-sm p-6 flex flex-col sm:flex-row items-center justify-between gap-4">
        <div>
            @if($pct >= 80)
                <p class="font-black text-slate-900">Your page looks great!</p>
                <p class="text-sm text-slate-500 mt-0.5">You're set — leads can find and contact you.</p>
            @else
                <p class="font-black text-slate-900">{{ 100 - $pct }}% left to complete</p>
                <p class="text-sm text-slate-500 mt-0.5">Complete sellers get 3× more leads on average.</p>
            @endif
        </div>
        <a href="{{ route('frontend.service.show', $user->slug) }}" target="_blank"
           class="shrink-0 px-6 py-3 rounded-2xl bg-teal-700 hover:bg-teal-800 text-white text-sm font-bold flex items-center gap-2 transition">
            <i class="fa-solid fa-eye"></i> Preview My Page
        </a>
    </div>

</div>
@endsection
