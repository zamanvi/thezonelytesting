@php
    // Resolve city/state/country to names if stored as numeric IDs (legacy data)
    $cityName    = $user->city    ? (is_numeric($user->city)    ? (\App\Models\City::find($user->city)?->title    ?? $user->city)    : $user->city)    : null;
    $stateName   = $user->state   ? (is_numeric($user->state)   ? (\App\Models\State::find($user->state)?->title   ?? $user->state)   : $user->state)   : null;
    $countryName = $user->country ? (is_numeric($user->country) ? (\App\Models\Country::find($user->country)?->title ?? $user->country) : $user->country) : null;

    $meta_title       = 'Trusted ' . ($user->category?->title ?? 'Professional') . ' in ' . ($cityName ?? 'Your City') . ($stateName ? ', '.$stateName : '') . ' | ' . $user->name;
    $meta_description = $user->name . ' — verified ' . ($user->category?->title ?? 'professional') . ($cityName ? ' in '.$cityName : '') . '. ' . Str::limit(strip_tags($user->about ?? $user->bio ?? ''), 120);
    $reviewCount      = $user->reviews->count();
    $avgRating        = $reviewCount ? round($user->reviews->avg('rating'), 1) : null;
    $schedule         = is_array($user->schedule) ? $user->schedule : (json_decode($user->schedule, true) ?? []);
    $workingDays      = $schedule['working_days'] ?? [];
    $allDays          = ['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'];
    $phone            = $user->contacts->where('type','phone')->first();
    $wa               = $user->contacts->where('type','whatsapp')->first();
    $trackingNumber   = $user->twilioNumber?->number;
    $rawPhone         = $phone?->value ?? $user->phone;
    $callNumber       = $trackingNumber ?? ($user->show_phone ? $rawPhone : null);
    $waNumber         = $wa?->value ?? $user->whatsapp;
    $activeServices   = $user->services->where('is_active', true);
    $tags             = array_filter(array_map('trim', explode(',', $user->tags ?? '')));
    $yearsExp         = $user->experience ? (int)$user->experience : null;
@endphp
@extends('frontend.layouts._app')
@section('title', $meta_title)
@php
    $ogSvcs = $activeServices->take(2)->pluck('title')->filter();
    $ogDesc = $user->name . ' — ' . ($user->category?->title ?? 'Professional') . ($cityName ? ' in ' . $cityName : '') . '.';
    if ($ogSvcs->count()) {
        $ogDesc .= ' Services: ' . $ogSvcs->map(fn($s) => '✓ ' . $s)->implode('  ');
    } else {
        $ogDesc .= ' ' . Str::limit(strip_tags($user->about ?? $user->bio ?? 'Verified professional on Zonely. Book a consultation today.'), 100);
    }
    $ogDesc = Str::limit($ogDesc, 200);
@endphp
@section('og_title',       $user->name . ' | ' . ($user->title ?? $user->category?->title ?? 'Professional') . ' — Zonely')
@section('og_description', $ogDesc)
@section('og_image',       route('frontend.og.image', $user->slug))
@section('og_extra')
<meta property="og:image:width"  content="1200">
<meta property="og:image:height" content="630">
<meta property="og:image:type"   content="image/png">
@endsection

@section('schema')
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "LocalBusiness",
  "name": "{{ addslashes($user->name) }}",
  "description": "{{ addslashes(Str::limit(strip_tags($user->about ?? $user->bio ?? ''), 200)) }}",
  "url": "{{ url()->current() }}",
  "image": "{{ $user->profile_photo ? asset($user->profile_photo) : '' }}",
  "@id": "{{ url()->current() }}",
  "address": {
    "@type": "PostalAddress",
    "streetAddress": "{{ addslashes($user->work_address ?? '') }}",
    "addressLocality": "{{ $cityName ?? '' }}",
    "addressRegion": "{{ $stateName ?? '' }}",
    "addressCountry": "US"
  }
  @if($callNumber),"telephone": "{{ $callNumber }}"@endif
}
</script>
@endsection

@section('hideLayoutFooter', true)

@section('css')
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400&display=swap" rel="stylesheet">
<style>
    .pro-page { font-family: 'Playfair Display', Georgia, serif; -webkit-font-smoothing: antialiased; -moz-osx-font-smoothing: grayscale; text-rendering: optimizeLegibility; }
    .hero-bg { background: linear-gradient(135deg, #1e3a8a 0%, #1d4ed8 60%, #3b82f6 100%); }
    .sh { position: relative; display: inline-block; }
    .sh::after { content: ''; position: absolute; width: 48px; height: 3px; background: #2563eb; bottom: -8px; left: 0; border-radius: 9999px; }
    .sh-center::after { left: 50%; transform: translateX(-50%); }
    .map-container { border-radius: 16px; overflow: hidden; }
    .accordion-content { max-height: 0; overflow: hidden; transition: max-height 0.4s ease-out; }
    .accordion-content.open { max-height: 500px; }
    .faq-content { max-height: 0; overflow: hidden; transition: max-height 0.3s ease-out; }
    .faq-content.open { max-height: 200px; }
    .booking-body { max-height: 0; overflow: hidden; transition: max-height 0.45s ease-out, opacity 0.3s ease; opacity: 0; }
    .booking-body.open { max-height: 900px; opacity: 1; }
    .lift { transition: transform 0.25s ease, box-shadow 0.25s ease; }
    .lift:hover { transform: translateY(-4px); box-shadow: 0 20px 40px -10px rgba(0,0,0,0.13); }
    .pro-glass { background: rgba(255,255,255,0.12); backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.22); }
    .badge-verified { background: linear-gradient(135deg, #059669, #10b981); }
    .service-icon { width: 52px; height: 52px; background: linear-gradient(135deg, #eff6ff, #dbeafe); border-radius: 14px; display: flex; align-items: center; justify-content: center; }
    .bg-icon { width: 44px; height: 44px; background: #eff6ff; border-radius: 12px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
    .testimonial-card { background: linear-gradient(135deg, #f8faff, #ffffff); border: 1px solid #e3ecff; }
    .price-num { font-size: 2rem; font-weight: 800; color: #1e40af; line-height: 1; }
    @media (max-width: 767px) { .pro-page { padding-bottom: 80px; } }
    .marquee-track { display: flex; width: max-content; animation: marquee 30s linear infinite; }
    .marquee-track:hover { animation-play-state: paused; }
    @keyframes marquee { from { transform: translateX(0); } to { transform: translateX(-50%); } }
</style>
@endsection

@section('content')
<div class="pro-page mt-16 sm:mt-20 bg-gray-50">
<div class="max-w-7xl mx-auto bg-white min-h-screen shadow-2xl overflow-hidden">

    {{-- ── HERO ─────────────────────────────────────────────────────── --}}
    <section class="hero-bg text-white">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 py-10 sm:py-14 md:py-20">
            <div class="flex flex-col md:flex-row items-center gap-10 md:gap-14">

                {{-- Profile card — LEFT --}}
                <div class="flex-shrink-0 w-full max-w-xs mx-auto md:mx-0 md:max-w-sm">
                    <div class="pro-glass rounded-3xl p-6 text-center">
                        <div class="relative inline-block">
                            <img src="{{ $user->profile_photo }}" alt="{{ $user->name }}"
                                 class="w-48 h-60 object-cover rounded-2xl border-4 border-white/30 shadow-xl mx-auto"
                                 onerror="this.style.display='none';this.nextElementSibling.style.display='flex';">
                            <div style="display:none;" class="w-48 h-60 bg-blue-500/40 border-4 border-white/30 rounded-2xl mx-auto items-center justify-center text-white font-black text-4xl shadow-xl">
                                {{ strtoupper(substr($user->name, 0, 2)) }}
                            </div>
                            <div class="absolute -bottom-3 left-1/2 -translate-x-1/2 badge-verified text-white text-xs font-bold px-4 py-1.5 rounded-full shadow whitespace-nowrap flex items-center gap-1.5">
                                <i class="fas fa-circle-check text-xs"></i>
                                VERIFIED {{ strtoupper($user->category?->title ?? 'PRO') }}
                            </div>
                        </div>
                        <div class="mt-6">
                            <h3 class="text-xl font-bold">{{ $user->name }}</h3>
                            <p class="text-blue-200 text-base mt-0.5">
                                {{ $user->title ?? $user->designation ?? $user->category?->title }}
                                @if($cityName) · {{ $cityName }}{{ $stateName ? ', '.$stateName : '' }}@endif
                            </p>
                        </div>
                        @php $statCount = ($yearsExp ? 1 : 0) + ($reviewCount ? 1 : 0) + ($avgRating ? 1 : 0); @endphp
                        @if($statCount)
                        <div class="grid grid-cols-{{ $statCount }} gap-2 mt-5">
                            @if($yearsExp)
                            <div class="bg-white/10 rounded-xl py-3 px-2 text-center">
                                <div class="text-2xl font-bold text-yellow-300">{{ $yearsExp }}+</div>
                                <div class="text-sm text-blue-200 mt-0.5 leading-tight">Years<br>Exp.</div>
                            </div>
                            @endif
                            @if($reviewCount)
                            <div class="bg-white/10 rounded-xl py-3 px-2 text-center">
                                <div class="text-2xl font-bold text-yellow-300">{{ $reviewCount }}</div>
                                <div class="text-sm text-blue-200 mt-0.5 leading-tight">Client<br>Reviews</div>
                            </div>
                            @endif
                            @if($avgRating)
                            <div class="bg-white/10 rounded-xl py-3 px-2 text-center">
                                <div class="text-2xl font-bold text-yellow-300">{{ $avgRating }}★</div>
                                <div class="text-sm text-blue-200 mt-0.5 leading-tight">Avg.<br>Rating</div>
                            </div>
                            @endif
                        </div>
                        @endif
                        @if($user->work_address || $cityName)
                        <div class="flex items-center justify-center gap-1.5 mt-4 text-blue-200 text-sm">
                            <i class="fas fa-map-marker-alt text-emerald-400 text-xs"></i>
                            {{ $user->work_address ?? $cityName.($stateName ? ', '.$stateName : '') }}
                        </div>
                        @endif
                        @if($user->languages->count())
                        <div class="mt-4 pt-4 border-t border-white/10">
                            <p class="text-sm text-blue-300 mb-2 font-semibold uppercase tracking-wide">Speaks</p>
                            <div class="flex flex-wrap justify-center gap-1.5">
                                @foreach($user->languages as $lang)
                                <span class="bg-white/10 border border-white/20 text-white text-sm font-medium px-3 py-1.5 rounded-full">
                                    {{ $lang->name }}
                                </span>
                                @endforeach
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                {{-- Text + CTAs — RIGHT --}}
                <div class="flex-1 text-center md:text-left">
                    <div class="inline-flex items-center gap-2 bg-white/10 border border-white/20 text-blue-100 text-xs font-semibold px-4 py-2 rounded-full mb-6">
                        <i class="fas fa-shield-halved text-emerald-400"></i>
                        Verified {{ $user->category?->title ?? 'Professional' }}
                        @if($cityName) &nbsp;·&nbsp; {{ $cityName }}{{ $stateName ? ', '.$stateName : '' }}@endif
                    </div>
                    <h1 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-extrabold leading-tight tracking-tight">
                        Trusted {{ $user->category?->title ?? 'Professional' }}
                        @if($cityName) in {{ $cityName }}{{ $stateName ? ', '.$stateName : '' }}@endif
                    </h1>
                    @if($user->bio || $user->about)
                    <p class="mt-6 text-blue-100 text-base md:text-lg leading-relaxed">
                        {{ Str::limit($user->bio ?? $user->about, 160) }}
                    </p>
                    @endif
                    <div class="mt-8 flex flex-col sm:flex-row gap-3 justify-center md:justify-start flex-wrap">
                        @if($callNumber)
                        <a href="tel:{{ $callNumber }}"
                           class="flex items-center justify-center gap-3 bg-white text-blue-700 hover:bg-yellow-300 px-8 py-4 rounded-full font-bold text-base shadow-xl transition">
                            <i class="fas fa-phone"></i>
                            @if($trackingNumber) Call Now @else {{ $callNumber }} @endif
                        </a>
                        @endif
                        @if($waNumber)
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/','', $waNumber) }}" target="_blank"
                           class="flex items-center justify-center gap-3 bg-green-500 hover:bg-green-400 text-white px-8 py-4 rounded-full font-bold text-base shadow-xl transition">
                            <i class="fab fa-whatsapp text-xl"></i> WhatsApp
                        </a>
                        @endif
                        <a href="#contact"
                           class="flex items-center justify-center gap-3 bg-white/15 hover:bg-white/25 border border-white/30 text-white px-8 py-4 rounded-full font-bold text-base transition">
                            <i class="fas fa-calendar-check"></i> Book Now
                        </a>
                    </div>
                    @if($reviewCount && $avgRating)
                    <a href="#testimonials"
                       class="mt-4 inline-flex items-center gap-2.5 justify-center md:justify-start text-white/80 hover:text-white text-sm font-semibold transition group">
                        <span class="flex items-center gap-0.5 text-yellow-300">
                            @for($i=1;$i<=5;$i++)<i class="fas fa-star text-xs"></i>@endfor
                        </span>
                        {{ $avgRating }} · Read client reviews
                        <i class="fas fa-arrow-down text-xs group-hover:translate-y-0.5 transition-transform"></i>
                    </a>
                    @endif
                </div>

            </div>
        </div>
    </section>

    {{-- ── TRUST BAR ────────────────────────────────────────────────── --}}
    @php
        $trustItems = collect();
        foreach($user->memberships as $m) $trustItems->push(['icon'=>'fas fa-certificate text-yellow-400', 'text'=>$m->name]);
        foreach($user->educations as $edu) $trustItems->push(['icon'=>'fas fa-graduation-cap text-blue-400', 'text'=>$edu->degree.($edu->institution ? ' — '.$edu->institution : '')]);
        if($trustItems->isEmpty()) $trustItems->push(['icon'=>'fas fa-shield-alt text-emerald-400','text'=>'Verified on Zonely']);
    @endphp
    <div class="bg-slate-800 overflow-hidden py-3.5">
        <div class="marquee-track">
            @foreach([0,1] as $_)
            <div class="flex items-center gap-12 text-sm font-semibold text-white px-8" @if($_) aria-hidden="true" @endif>
                @foreach($trustItems as $t)
                <span class="flex items-center gap-2 shrink-0"><i class="{{ $t['icon'] }}"></i> {{ $t['text'] }}</span>
                <span class="text-slate-500 shrink-0 px-4">|</span>
                @endforeach
            </div>
            @endforeach
        </div>
    </div>

    <div class="max-w-6xl mx-auto px-4 sm:px-6 md:px-8 py-8 md:py-12 space-y-10 md:space-y-12">

        {{-- ── ROW 1: Pricing (left) + Memberships (right) ────────────── --}}
        @php
            $ptMap = ['starting_at'=>'Starting at','per_month'=>'Per month','per_hour'=>'Per hour','flat_rate'=>'Flat rate','free'=>'Free','contact'=>'Contact us'];
            $hasPricing     = $activeServices->count() || count($tags);
            $hasMemberships = $user->memberships->count();
            $hasEducation   = $user->educations->count();
            $hasBio         = $user->about || $user->bio;
        @endphp
        @if($hasPricing || $hasMemberships)
        <section id="pricing" class="grid grid-cols-1 md:grid-cols-2 gap-6 items-start">

            {{-- LEFT: Pricing --}}
            @if($activeServices->count())
            <div>
                <div class="mb-6">
                    <h3 class="font-bold text-3xl sm:text-4xl sh">Services &amp; Pricing</h3>
                    <p class="text-slate-500 mt-4 text-sm font-medium">No hidden fees · Click to see details</p>
                </div>
                <div class="space-y-4">
                    @foreach($activeServices as $svc)
                    @php
                        $ptLabel  = $ptMap[$svc->pricing_type ?? 'starting_at'] ?? 'Starting at';
                        $features = array_filter(array_map('trim', explode("\n", $svc->features ?? '')));
                        $hasPrice = $svc->price && !in_array($svc->pricing_type, ['free','contact']);
                    @endphp
                    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden group hover:shadow-md hover:border-blue-100 transition-all duration-200">
                        <div class="h-1 bg-gradient-to-r from-blue-500 to-indigo-500"></div>
                        <button onclick="toggleAccordion(this)"
                            class="w-full flex items-center justify-between px-5 py-4 text-left hover:bg-blue-50/30 transition-colors">
                            <div class="flex items-center gap-4 min-w-0">
                                <div class="w-11 h-11 bg-blue-50 rounded-xl flex items-center justify-center flex-shrink-0 group-hover:bg-blue-100 transition-colors">
                                    <i class="fas fa-briefcase text-blue-600 text-base"></i>
                                </div>
                                <div class="min-w-0">
                                    <p class="font-bold text-base text-slate-900 leading-snug truncate">{{ $svc->title }}</p>
                                    @if($features)
                                    <p class="text-xs text-slate-400 mt-0.5">{{ count($features) }} {{ Str::plural('item', count($features)) }} included</p>
                                    @elseif($svc->description)
                                    <p class="text-xs text-slate-400 mt-0.5 truncate">{{ Str::limit($svc->description, 55) }}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="flex items-center gap-3 flex-shrink-0 ml-3">
                                <div class="text-right">
                                    @if($hasPrice)
                                        <div class="text-2xl font-black text-blue-700 leading-none">${{ number_format($svc->price, 0) }}</div>
                                        <div class="text-xs text-blue-400 font-semibold mt-0.5">{{ $ptLabel }}</div>
                                    @elseif($svc->pricing_type === 'free')
                                        <div class="text-xl font-black text-emerald-600">Free</div>
                                    @else
                                        <div class="text-sm font-bold text-slate-400">Contact us</div>
                                    @endif
                                </div>
                                <div class="w-8 h-8 rounded-full bg-slate-100 group-hover:bg-blue-100 flex items-center justify-center transition-colors flex-shrink-0">
                                    <i class="fas fa-chevron-down text-slate-400 text-xs accordion-icon transition-transform duration-300"></i>
                                </div>
                            </div>
                        </button>
                        <div class="accordion-content border-t border-slate-100">
                            @if($features)
                            <div class="px-5 pt-4 pb-3 space-y-2">
                                @foreach($features as $feature)
                                <div class="flex items-start gap-2.5">
                                    <span class="mt-0.5 w-4 h-4 rounded-full bg-emerald-100 flex items-center justify-center flex-shrink-0">
                                        <i class="fas fa-check text-emerald-600" style="font-size:9px"></i>
                                    </span>
                                    <span class="text-sm text-slate-700">{{ $feature }}</span>
                                </div>
                                @endforeach
                            </div>
                            @endif
                            @if($svc->description)
                            <p class="px-5 pt-2 pb-3 text-sm text-slate-500 leading-relaxed">{{ $svc->description }}</p>
                            @endif
                            <div class="px-5 pb-4 pt-3 flex items-center gap-3 border-t border-slate-100 bg-slate-50/50">
                                <a href="#contact"
                                   class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-bold px-5 py-2.5 rounded-xl text-sm transition shadow-sm">
                                    <i class="fas fa-paper-plane text-xs"></i> Get a Quote
                                </a>
                                @if($callNumber)
                                <a href="tel:{{ $callNumber }}"
                                   class="inline-flex items-center gap-2 text-blue-600 hover:text-blue-800 font-semibold text-sm transition">
                                    <i class="fas fa-phone text-xs"></i> Call Now
                                </a>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @elseif(count($tags))
            <div>
                <div class="mb-6">
                    <h3 class="font-bold text-3xl sm:text-4xl sh">Services Offered</h3>
                </div>
                <div class="flex flex-wrap gap-3">
                    @foreach($tags as $tag)
                    <span class="flex items-center gap-2 bg-blue-50 border border-blue-100 text-blue-700 font-semibold px-5 py-3 rounded-2xl text-sm">
                        <i class="fas fa-circle-check text-blue-400 text-xs"></i> {{ ucfirst($tag) }}
                    </span>
                    @endforeach
                </div>
            </div>
            @endif

            {{-- RIGHT: Memberships --}}
            @if($hasMemberships)
            <div>
                <div class="mb-6">
                    <h3 class="font-bold text-3xl sm:text-4xl sh">Professional Background</h3>
                    <p class="text-slate-500 mt-4 text-sm font-medium">Credentials and expertise</p>
                </div>
                <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
                    <div class="bg-gradient-to-r from-blue-600 to-indigo-600 px-6 py-4 flex items-center gap-3">
                        <div class="w-9 h-9 bg-white/20 rounded-xl flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-id-badge text-white text-base"></i>
                        </div>
                        <h4 class="font-bold text-lg text-white">Memberships & Associations</h4>
                    </div>
                    <div class="p-6 space-y-4">
                        @foreach($user->memberships as $m)
                        <div class="flex gap-4 items-start">
                            <div class="flex flex-col items-center pt-1.5">
                                <div class="w-3 h-3 {{ $loop->first ? 'bg-blue-600 ring-4 ring-blue-100' : 'bg-slate-300' }} rounded-full flex-shrink-0"></div>
                                @if(!$loop->last)<div class="w-px flex-1 bg-slate-200 mt-2 min-h-[36px]"></div>@endif
                            </div>
                            <div class="pb-4 min-w-0">
                                <p class="font-semibold text-base text-slate-800">{{ $m->name }}</p>
                                @if($m->start || $m->end)
                                <p class="text-sm text-blue-600 font-medium mt-0.5">{{ $m->start ?? '' }}{{ ($m->start && $m->end) ? ' – ' : '' }}{{ $m->end ?? 'Present' }}</p>
                                @endif
                                @if($m->address)<p class="text-sm text-slate-500 mt-1">{{ $m->address }}</p>@endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif

        </section>
        @endif

        {{-- ── REVIEWS / TESTIMONIALS ───────────────────────────────── --}}
        @if($user->reviews->count())
        <section id="testimonials">
            <div class="mb-6">
                <h3 class="font-bold text-3xl sm:text-4xl sh">Client Reviews</h3>
                <p class="text-slate-500 mt-5 text-sm font-medium">{{ $reviewCount }} verified reviews &nbsp;·&nbsp; Avg. {{ $avgRating }} / 5 stars</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                @foreach($user->reviews->take(3) as $review)
                <div class="testimonial-card rounded-2xl p-6 lift">
                    <div class="flex gap-1 mb-3">
                        @for($i=1;$i<=5;$i++)
                        <i class="fas fa-star text-base {{ $i <= ($review->rating ?? 5) ? 'text-yellow-400' : 'text-slate-200' }}"></i>
                        @endfor
                    </div>
                    <p class="text-base text-slate-600 leading-relaxed">"{{ Str::limit($review->review ?? '', 120) }}"</p>
                    <div class="mt-5 flex items-center gap-3">
                        <div class="w-9 h-9 bg-blue-100 rounded-full flex items-center justify-center text-blue-700 font-bold text-sm flex-shrink-0">
                            {{ strtoupper(substr($review->reviewer?->name ?? 'C', 0, 1)) }}
                        </div>
                        <div>
                            <p class="text-base font-semibold">{{ $review->reviewer?->name ?? 'Verified Client' }}</p>
                            <p class="text-sm text-slate-500">{{ $review->created_at?->format('M Y') }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </section>
        @endif

        {{-- ── ROW 2: Education (left) + About/Bio (right) ─────────── --}}
        @if($hasEducation || $hasBio)
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-start">

            {{-- LEFT: Education --}}
            @if($hasEducation)
            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
                <div class="bg-gradient-to-r from-emerald-600 to-teal-600 px-6 py-4 flex items-center gap-3">
                    <div class="w-9 h-9 bg-white/20 rounded-xl flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-graduation-cap text-white text-base"></i>
                    </div>
                    <h4 class="font-bold text-lg text-white">Education</h4>
                </div>
                <div class="p-6 space-y-4">
                    @foreach($user->educations as $edu)
                    <div class="flex gap-4 items-start">
                        <div class="flex flex-col items-center pt-1.5">
                            <div class="w-3 h-3 {{ $loop->first ? 'bg-emerald-600 ring-4 ring-emerald-100' : 'bg-slate-300' }} rounded-full flex-shrink-0"></div>
                            @if(!$loop->last)<div class="w-px flex-1 bg-slate-200 mt-2 min-h-[36px]"></div>@endif
                        </div>
                        <div class="pb-4 min-w-0">
                            <p class="font-semibold text-base text-slate-800">{{ $edu->degree }}</p>
                            @if($edu->institution)<p class="text-sm text-emerald-600 font-medium mt-0.5">{{ $edu->institution }}</p>@endif
                            @if($edu->passing_year)<p class="text-sm text-slate-500 mt-1">{{ $edu->passing_year }}</p>@endif
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            {{-- RIGHT: About / Bio --}}
            @if($hasBio)
            <div class="bg-white border border-slate-100 rounded-2xl shadow-sm overflow-hidden h-full">
                <div class="border-l-4 border-blue-500 p-6 h-full">
                    <div class="flex items-center gap-2 mb-3">
                        <i class="fas fa-quote-left text-blue-300 text-lg"></i>
                        <span class="text-xs font-bold text-blue-500 uppercase tracking-wider">About</span>
                    </div>
                    <p class="text-base text-slate-700 leading-relaxed">
                        <strong class="font-bold text-slate-900">{{ $user->name }}</strong>{{ $user->title ? ', '.$user->title : '' }} —
                        {{ $user->about ?? $user->bio }}
                    </p>
                </div>
            </div>
            @endif

        </div>
        @endif

        {{-- ── FAQ ───────────────────────────────────────────────────── --}}
        @if($user->faqs->count())
        <section>
            <div class="mb-6">
                <h3 class="font-bold text-3xl sm:text-4xl sh">Frequently Asked Questions</h3>
            </div>
            <div class="space-y-3">
                @foreach($user->faqs as $faq)
                <div class="bg-white border border-slate-100 rounded-2xl overflow-hidden shadow-sm hover:border-blue-100 hover:shadow-md transition-all duration-200 group">
                    <button onclick="toggleFaq(this)" class="w-full flex items-center justify-between px-6 py-4 text-left hover:bg-blue-50/20 transition">
                        <span class="font-semibold text-base pr-4 text-slate-800">{{ $faq->question }}</span>
                        <div class="w-8 h-8 rounded-full bg-slate-100 group-hover:bg-blue-100 flex items-center justify-center flex-shrink-0 transition-colors">
                            <i class="fas fa-chevron-down text-slate-400 text-xs faq-icon transition-transform duration-300"></i>
                        </div>
                    </button>
                    <div class="faq-content border-t border-slate-100">
                        <p class="px-6 py-4 text-sm text-slate-600 leading-relaxed">{{ $faq->answer }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </section>
        @endif

    </div>

    {{-- ── CONTACT / BOOKING ────────────────────────────────────────── --}}
    <div id="contact" class="bg-gradient-to-br from-blue-700 via-blue-700 to-indigo-700 text-white py-12 md:py-16">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 text-center">
            <div class="inline-flex items-center gap-2 bg-white/10 border border-white/20 text-blue-100 text-sm font-semibold px-4 py-2 rounded-full mb-6">
                <i class="fas fa-calendar-check text-yellow-300"></i> Free Initial Consultation
            </div>
            <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold">Book Your Free Consultation</h2>
            <p class="text-blue-100 mt-3 text-lg">Fill in your details — {{ $user->name }} will respond within 24 hours</p>

            @if(session('inquiry_success'))
            <div class="mt-6 bg-green-500 text-white rounded-2xl px-6 py-4 font-bold">
                <i class="fa-solid fa-circle-check mr-2"></i>{{ session('inquiry_success') }}
            </div>
            @endif

            <button id="bookingToggleBtn" onclick="toggleBooking()"
                    class="flex items-center justify-center gap-3 mx-auto mt-8 bg-white/15 hover:bg-white/25 border border-white/30 text-white px-8 py-3.5 rounded-2xl font-semibold text-base transition">
                <i class="fas fa-plus-circle" id="bookingIcon"></i>
                <span id="bookingBtnText">Open Booking Form</span>
            </button>

            <div id="bookingBody" class="booking-body mt-6">
                <div class="bg-white/10 backdrop-blur-lg rounded-3xl border border-white/20 text-left overflow-hidden">
                    <div class="px-5 md:px-8 pt-6 pb-4 border-b border-white/10">
                        <h4 class="font-semibold text-lg">Booking Request — {{ $user->name }}</h4>
                    </div>
                    <form action="{{ route('service.inquiry', $user->slug) }}" method="POST"
                          class="px-5 md:px-8 pb-6 md:pb-8 pt-5">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-5">
                            <div>
                                <label class="block text-base mb-2 font-medium">Full Name *</label>
                                <input type="text" name="name" required value="{{ old('name') }}" placeholder="John Smith"
                                       class="w-full px-5 py-3.5 bg-white/20 border border-white/30 rounded-2xl text-white placeholder:text-blue-200 focus:outline-none focus:border-white focus:bg-white/25 transition">
                            </div>
                            <div>
                                <label class="block text-base mb-2 font-medium">Phone Number *</label>
                                <input type="tel" name="phone" required value="{{ old('phone') }}" placeholder="(917) 000-0000"
                                       class="w-full px-5 py-3.5 bg-white/20 border border-white/30 rounded-2xl text-white placeholder:text-blue-200 focus:outline-none focus:border-white focus:bg-white/25 transition">
                            </div>
                        </div>
                        <div class="mt-5">
                            <label class="block text-sm mb-2 font-medium">Email Address *</label>
                            <input type="email" name="email" required value="{{ old('email') }}" placeholder="john@email.com"
                                   class="w-full px-5 py-3.5 bg-white/20 border border-white/30 rounded-2xl text-white placeholder:text-blue-200 focus:outline-none focus:border-white focus:bg-white/25 transition">
                        </div>
                        @if($activeServices->count())
                        <div class="mt-5">
                            <label class="block text-sm mb-2 font-medium">Service Needed</label>
                            <select name="service" class="w-full px-5 py-3.5 bg-white/20 border border-white/30 rounded-2xl text-white focus:outline-none focus:border-white focus:bg-white/25 transition">
                                <option value="" class="text-slate-800">Select a service...</option>
                                @foreach($activeServices as $svc)
                                <option class="text-slate-800" value="{{ $svc->title }}" {{ old('service')==$svc->title?'selected':'' }}>
                                    {{ $svc->title }}{{ $svc->price ? ' — $'.$svc->price : '' }}
                                </option>
                                @endforeach
                                <option class="text-slate-800" value="Other">Other / General Inquiry</option>
                            </select>
                        </div>
                        @endif
                        <div class="mt-5">
                            <label class="block text-sm mb-2 font-medium">Message / Details</label>
                            <textarea name="message" rows="4" placeholder="Tell us about your needs..."
                                      class="w-full px-5 py-3.5 bg-white/20 border border-white/30 rounded-2xl text-white placeholder:text-blue-200 focus:outline-none focus:border-white focus:bg-white/25 transition resize-none">{{ old('message') }}</textarea>
                        </div>
                        <button type="submit"
                                class="w-full mt-6 bg-white text-blue-700 hover:bg-yellow-300 py-4 rounded-3xl font-semibold text-xl flex items-center justify-center gap-2 transition shadow-xl">
                            <i class="fas fa-paper-plane"></i> Send Booking Request
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

    {{-- ── CUSTOM FOOTER ───────────────────────────────────────────── --}}
    <footer class="bg-slate-900 text-slate-400 py-8">
        <div class="max-w-5xl mx-auto px-6">
            <div class="flex flex-col sm:flex-row items-center justify-between gap-4 pb-6 border-b border-slate-700">
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 bg-blue-600 rounded-xl flex items-center justify-center text-white font-bold text-sm">Z</div>
                    <span class="text-white font-bold text-lg">Zonely</span>
                </div>
                <div class="flex items-center gap-5 text-sm">
                    @if($callNumber)
                    <a href="tel:{{ $callNumber }}" class="flex items-center gap-1.5 hover:text-white transition">
                        <i class="fas fa-phone text-blue-400 text-xs"></i> {{ $callNumber }}
                    </a>
                    @endif
                    @if($waNumber)
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/','', $waNumber) }}" class="flex items-center gap-1.5 hover:text-white transition">
                        <i class="fab fa-whatsapp text-emerald-400 text-xs"></i> WhatsApp
                    </a>
                    @endif
                </div>
            </div>
            <div class="pt-5 text-center text-xs opacity-50">&copy; {{ date('Y') }} Zonely &bull; All Rights Reserved</div>
        </div>
    </footer>

{{-- ── MOBILE STICKY CTA ────────────────────────────────────────── --}}
<div class="md:hidden fixed bottom-0 left-0 right-0 z-50 bg-white border-t border-slate-200 shadow-2xl px-4 py-3 flex gap-3">
    @if($callNumber)
    <a href="tel:{{ $callNumber }}"
       class="flex-1 flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-2xl font-semibold text-base transition">
        <i class="fas fa-phone"></i> Call Now
    </a>
    @endif
    @if($waNumber)
    <a href="https://wa.me/{{ preg_replace('/[^0-9]/','', $waNumber) }}" target="_blank"
       class="flex-1 flex items-center justify-center gap-2 bg-green-500 hover:bg-green-600 text-white py-3 rounded-2xl font-semibold text-base transition">
        <i class="fab fa-whatsapp"></i> WhatsApp
    </a>
    @endif
    @if(!$callNumber && !$waNumber)
    <a href="#contact"
       class="flex-1 flex items-center justify-center gap-2 bg-blue-600 text-white py-3 rounded-2xl font-semibold text-base">
        <i class="fas fa-envelope"></i> Contact
    </a>
    @endif
</div>

</div>
@endsection

@section('scripts')
<script>
    function toggleAccordion(btn) {
        const content = btn.nextElementSibling;
        const chevron = btn.querySelector('.accordion-icon');
        content.classList.toggle('open');
        if (chevron) chevron.style.transform = content.classList.contains('open') ? 'rotate(180deg)' : '';
    }

    function toggleFaq(btn) {
        const content = btn.nextElementSibling;
        const icon    = btn.querySelector('.faq-icon');
        document.querySelectorAll('.faq-content').forEach(c => { if (c !== content) c.classList.remove('open'); });
        document.querySelectorAll('.faq-icon').forEach(ic => { if (ic !== icon) ic.style.transform = ''; });
        content.classList.toggle('open');
        icon.style.transform = content.classList.contains('open') ? 'rotate(180deg)' : '';
    }

    function toggleBooking() {
        const body    = document.getElementById('bookingBody');
        const icon    = document.getElementById('bookingIcon');
        const btnText = document.getElementById('bookingBtnText');
        const isOpen  = body.classList.toggle('open');
        icon.className      = isOpen ? 'fas fa-minus-circle' : 'fas fa-plus-circle';
        btnText.textContent = isOpen ? 'Close Booking Form' : 'Open Booking Form';
        if (isOpen) setTimeout(() => body.scrollIntoView({ behavior: 'smooth', block: 'nearest' }), 50);
    }

    @if(session('inquiry_success'))
        document.getElementById('bookingBody').scrollIntoView({ behavior: 'smooth', block: 'center' });
    @endif
</script>
@endsection
