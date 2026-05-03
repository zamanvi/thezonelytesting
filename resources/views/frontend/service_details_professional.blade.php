@php
    $meta_title       = 'Trusted ' . ($user->category?->title ?? 'Professional') . ' in ' . ($user->city ?? 'Your City') . ($user->state ? ', '.$user->state : '') . ' | ' . $user->name;
    $meta_description = $user->name . ' — verified ' . ($user->category?->title ?? 'professional') . ($user->city ? ' in '.$user->city : '') . '. ' . Str::limit(strip_tags($user->about ?? $user->bio ?? ''), 120);
    $avgRating        = $user->reviews->count() ? round($user->reviews->avg('rating'), 1) : 4.9;
    $reviewCount      = $user->reviews->count();
    $schedule         = is_array($user->schedule) ? $user->schedule : (json_decode($user->schedule, true) ?? []);
    $workingDays      = $schedule['working_days'] ?? [];
    $allDays          = ['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'];
    $phone            = $user->contacts->where('type','phone')->first();
    $wa               = $user->contacts->where('type','whatsapp')->first();
    $trackingNumber   = $user->twilioNumber?->number;
    $callNumber       = $trackingNumber ?? $phone?->value ?? $user->phone;
    $waNumber         = $wa?->value ?? $user->whatsapp;
    $activeServices   = $user->services->where('is_active', true);
    $tags             = array_filter(array_map('trim', explode(',', $user->tags ?? '')));
    $yearsExp         = $user->experience ?? (date('Y') - date('Y', strtotime($user->created_at)));
@endphp
@extends('frontend.layouts._app')
@section('title', $meta_title)
@section('og_title',       $user->name . ' — ' . ($user->title ?? $user->category?->title))
@section('og_description', Str::limit(strip_tags($user->bio ?? ''), 200))
@section('og_image',       $user->profile_photo)

@section('schema')
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "LocalBusiness",
  "name": "{{ addslashes($user->name) }}",
  "description": "{{ addslashes(Str::limit(strip_tags($user->about ?? $user->bio ?? ''), 200)) }}",
  "url": "{{ url()->current() }}",
  "image": "{{ $user->profile_photo }}",
  "@id": "{{ url()->current() }}",
  "address": {
    "@type": "PostalAddress",
    "streetAddress": "{{ addslashes($user->work_address ?? '') }}",
    "addressLocality": "{{ $user->city ?? '' }}",
    "addressRegion": "{{ $user->state ?? '' }}",
    "addressCountry": "US"
  }
  @if($callNumber),"telephone": "{{ $callNumber }}"@endif
}
</script>
@endsection

@section('css')
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400&display=swap" rel="stylesheet">
<style>
    .pro-page { font-family: 'Playfair Display', Georgia, serif; -webkit-font-smoothing: antialiased; -moz-osx-font-smoothing: grayscale; text-rendering: optimizeLegibility; }
    .hero-bg { background: linear-gradient(135deg, #1e3a8a 0%, #1d4ed8 60%, #3b82f6 100%); }
    .sh { position: relative; display: inline-block; }
    .sh::after { content: ''; position: absolute; width: 48px; height: 3px; background: #2563eb; bottom: -8px; left: 0; border-radius: 9999px; }
    .sh-center::after { left: 50%; transform: translateX(-50%); }
    .map-container { border-radius: 16px; overflow: hidden; }
    .accordion-content { max-height: 0; overflow: hidden; transition: max-height 0.35s ease-out; }
    .accordion-content.open { max-height: 320px; }
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
    footer.max-w-7xl { display: none !important; }
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
                            <h3 class="text-lg font-bold">{{ $user->name }}</h3>
                            <p class="text-blue-200 text-sm mt-0.5">
                                {{ $user->title ?? $user->designation ?? $user->category?->title }}
                                @if($user->city) · {{ $user->city }}{{ $user->state ? ', '.$user->state : '' }}@endif
                            </p>
                        </div>
                        <div class="grid grid-cols-3 gap-2 mt-5">
                            <div class="bg-white/10 rounded-xl py-3 px-2 text-center">
                                <div class="text-xl font-bold text-yellow-300">{{ $yearsExp }}+</div>
                                <div class="text-xs text-blue-200 mt-0.5 leading-tight">Years<br>Exp.</div>
                            </div>
                            <div class="bg-white/10 rounded-xl py-3 px-2 text-center">
                                <div class="text-xl font-bold text-yellow-300">{{ $reviewCount ?: '50+' }}</div>
                                <div class="text-xs text-blue-200 mt-0.5 leading-tight">Happy<br>Clients</div>
                            </div>
                            <div class="bg-white/10 rounded-xl py-3 px-2 text-center">
                                <div class="text-xl font-bold text-yellow-300">{{ $avgRating }}★</div>
                                <div class="text-xs text-blue-200 mt-0.5 leading-tight">Avg.<br>Rating</div>
                            </div>
                        </div>
                        @if($user->work_address || $user->city)
                        <div class="flex items-center justify-center gap-1.5 mt-4 text-blue-200 text-xs">
                            <i class="fas fa-map-marker-alt text-emerald-400 text-xs"></i>
                            {{ $user->work_address ?? $user->city.($user->state ? ', '.$user->state : '') }}
                        </div>
                        @endif
                    </div>
                </div>

                {{-- Text + CTAs — RIGHT --}}
                <div class="flex-1 text-center md:text-left">
                    <div class="inline-flex items-center gap-2 bg-white/10 border border-white/20 text-blue-100 text-xs font-semibold px-4 py-2 rounded-full mb-6">
                        <i class="fas fa-shield-halved text-emerald-400"></i>
                        Verified {{ $user->category?->title ?? 'Professional' }}
                        @if($user->city) &nbsp;·&nbsp; {{ $user->city }}{{ $user->state ? ', '.$user->state : '' }}@endif
                    </div>
                    <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-extrabold leading-tight tracking-tight">
                        Trusted {{ $user->category?->title ?? 'Professional' }}<br>
                        @if($user->city)in {{ $user->city }}{{ $user->state ? ', '.$user->state : '' }}@endif
                    </h1>
                    @if($user->bio || $user->about)
                    <p class="mt-6 text-blue-100 text-base md:text-lg leading-relaxed">
                        {{ Str::limit($user->bio ?? $user->about, 160) }}
                    </p>
                    @endif
                    <div class="mt-8 flex flex-col sm:flex-row gap-3 justify-center md:justify-start">
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
                    </div>
                    @if($reviewCount)
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

    <div class="max-w-6xl mx-auto px-4 sm:px-6 md:px-8 py-10 md:py-14 space-y-12 md:space-y-16">

        {{-- ── SERVICES ─────────────────────────────────────────────── --}}
        @if($activeServices->count() || count($tags))
        <section id="services">
            <div class="text-center mb-10">
                <h3 class="font-bold text-2xl sm:text-3xl sh sh-center">Professional Services</h3>
                <p class="text-slate-500 mt-7">Everything {{ $user->name }} offers</p>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 {{ $activeServices->count() >= 4 || count($tags) >= 4 ? 'lg:grid-cols-4' : '' }} gap-4 md:gap-5">
                @forelse($activeServices->take(8) as $svc)
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 lift text-center">
                    <div class="service-icon mx-auto mb-4"><i class="fas fa-briefcase text-blue-600 text-xl"></i></div>
                    <h4 class="font-semibold text-sm leading-snug">{{ $svc->title }}</h4>
                    @if($svc->description)<p class="text-xs text-slate-500 mt-2">{{ Str::limit($svc->description, 60) }}</p>@endif
                </div>
                @empty
                @foreach(array_slice($tags, 0, 8) as $tag)
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 lift text-center">
                    <div class="service-icon mx-auto mb-4"><i class="fas fa-circle-check text-blue-600 text-xl"></i></div>
                    <h4 class="font-semibold text-sm leading-snug">{{ ucfirst($tag) }}</h4>
                </div>
                @endforeach
                @endforelse
            </div>
        </section>
        @endif

        {{-- ── PRICING ──────────────────────────────────────────────── --}}
        @if($activeServices->count())
        <section id="pricing">
            <div class="text-center mb-10">
                <h3 class="font-bold text-2xl sm:text-3xl sh sh-center">Transparent Pricing</h3>
                <p class="text-slate-500 mt-7">No hidden fees · Click any service to see full details</p>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                @foreach($activeServices as $svc)
                <div class="bg-white rounded-2xl overflow-hidden shadow-sm border {{ $loop->first ? 'border-2 border-blue-500' : 'border-slate-100' }}">
                    @if($loop->first)
                    <div class="bg-blue-600 text-white text-xs font-bold px-6 py-1.5 flex items-center gap-2">
                        <i class="fas fa-star text-yellow-300"></i> MOST POPULAR
                    </div>
                    @endif
                    <button onclick="toggleAccordion(this)" class="w-full flex items-center justify-between px-6 py-5 text-left hover:bg-slate-50 transition">
                        <div class="flex items-center gap-4">
                            <div class="service-icon flex-shrink-0"><i class="fas fa-briefcase text-blue-600 text-lg"></i></div>
                            <div>
                                <p class="font-semibold text-base">{{ $svc->title }}</p>
                                @if($svc->category)<p class="text-xs text-slate-500 mt-0.5">{{ $svc->category->title }}</p>@endif
                            </div>
                        </div>
                        <div class="text-right flex-shrink-0 ml-4">
                            @if($svc->price)
                            <div class="price-num">${{ $svc->price }}</div>
                            <div class="text-xs text-slate-500">starting at</div>
                            @else
                            <div class="text-sm font-bold text-slate-500">Contact</div>
                            @endif
                        </div>
                    </button>
                    <div class="accordion-content px-6 pb-6 text-sm border-t">
                        @if($svc->description)
                        <p class="text-slate-600 leading-relaxed mt-4">{{ $svc->description }}</p>
                        @endif
                        @if($svc->image_one)
                        <img src="{{ asset($svc->image_one) }}" class="w-full rounded-2xl mt-4 object-cover max-h-48" alt="{{ $svc->title }}">
                        @endif
                        <div class="mt-4">
                            <a href="#contact" class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-bold px-5 py-2.5 rounded-2xl text-sm transition">
                                <i class="fas fa-phone text-xs"></i> Inquire About This Service
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </section>
        @endif

        {{-- ── REVIEWS / TESTIMONIALS ───────────────────────────────── --}}
        @if($user->reviews->count())
        <section id="testimonials">
            <div class="text-center mb-10">
                <h3 class="font-bold text-2xl sm:text-3xl sh sh-center">Client Reviews</h3>
                <p class="text-slate-500 mt-7">{{ $reviewCount }} verified reviews &nbsp;·&nbsp; Avg. {{ $avgRating }} / 5 stars</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                @foreach($user->reviews->take(3) as $review)
                <div class="testimonial-card rounded-2xl p-6 lift">
                    <div class="flex gap-1 mb-3">
                        @for($i=1;$i<=5;$i++)
                        <i class="fas fa-star text-sm {{ $i <= ($review->rating ?? 5) ? 'text-yellow-400' : 'text-slate-200' }}"></i>
                        @endfor
                    </div>
                    <p class="text-sm text-slate-600 leading-relaxed">"{{ Str::limit($review->review ?? '', 120) }}"</p>
                    <div class="mt-5 flex items-center gap-3">
                        <div class="w-9 h-9 bg-blue-100 rounded-full flex items-center justify-center text-blue-700 font-bold text-sm flex-shrink-0">
                            {{ strtoupper(substr($review->reviewer?->name ?? 'C', 0, 1)) }}
                        </div>
                        <div>
                            <p class="text-sm font-semibold">{{ $review->reviewer?->name ?? 'Verified Client' }}</p>
                            <p class="text-xs text-slate-500">{{ $review->created_at?->format('M Y') }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </section>
        @endif

        {{-- ── PROFESSIONAL BACKGROUND ──────────────────────────────── --}}
        @if($user->memberships->count() || $user->educations->count() || $user->about || $user->bio)
        <section id="background">
            <div class="text-center mb-10">
                <h3 class="font-bold text-2xl sm:text-3xl sh sh-center">Professional Background</h3>
                <p class="text-slate-500 mt-7">Credentials and expertise behind the work</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-6">

                @if($user->memberships->count())
                <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-7">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="bg-icon"><i class="fas fa-briefcase text-blue-600 text-base"></i></div>
                        <h4 class="font-bold text-lg text-slate-800">Experience</h4>
                    </div>
                    <div class="space-y-5">
                        @foreach($user->memberships as $m)
                        <div class="flex gap-4 items-start">
                            <div class="flex flex-col items-center pt-1">
                                <div class="w-2.5 h-2.5 {{ $loop->first ? 'bg-blue-600' : 'bg-slate-300' }} rounded-full flex-shrink-0"></div>
                                @if(!$loop->last)<div class="w-px flex-1 bg-slate-200 mt-2 min-h-[32px]"></div>@endif
                            </div>
                            <div class="pb-4">
                                <p class="font-semibold text-sm text-slate-800">{{ $m->name }}</p>
                                @if($m->start || $m->end)
                                <p class="text-xs text-blue-600 font-medium mt-0.5">{{ $m->start ?? '' }}{{ ($m->start && $m->end) ? ' – ' : '' }}{{ $m->end ?? 'Present' }}</p>
                                @endif
                                @if($m->address)<p class="text-xs text-slate-500 mt-1">{{ $m->address }}</p>@endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                @if($user->educations->count())
                <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-7">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="bg-icon"><i class="fas fa-graduation-cap text-blue-600 text-base"></i></div>
                        <h4 class="font-bold text-lg text-slate-800">Education</h4>
                    </div>
                    <div class="space-y-5">
                        @foreach($user->educations as $edu)
                        <div class="flex gap-4 items-start">
                            <div class="flex flex-col items-center pt-1">
                                <div class="w-2.5 h-2.5 {{ $loop->first ? 'bg-blue-600' : 'bg-slate-300' }} rounded-full flex-shrink-0"></div>
                                @if(!$loop->last)<div class="w-px flex-1 bg-slate-200 mt-2 min-h-[32px]"></div>@endif
                            </div>
                            <div class="pb-4">
                                <p class="font-semibold text-sm text-slate-800">{{ $edu->degree }}</p>
                                @if($edu->institution)<p class="text-xs text-blue-600 font-medium mt-0.5">{{ $edu->institution }}</p>@endif
                                @if($edu->passing_year)<p class="text-xs text-slate-500 mt-1">{{ $edu->passing_year }}</p>@endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

            </div>

            @if($user->about || $user->bio)
            <div class="mt-6 bg-slate-50 rounded-2xl p-7">
                <p class="text-slate-600 leading-relaxed">
                    <strong>{{ $user->name }}</strong>{{ $user->title ? ', '.$user->title : '' }} —
                    {{ $user->about ?? $user->bio }}
                </p>
            </div>
            @endif
        </section>
        @endif

        {{-- ── LOCATION & HOURS ─────────────────────────────────────── --}}
        @if($user->work_address || $user->city)
        <section id="location">
            <div class="text-center mb-10">
                <h3 class="font-bold text-2xl sm:text-3xl sh sh-center">Find Us</h3>
                <p class="text-slate-500 mt-7">Walk-in, call, or meet virtually — your choice</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-6 items-stretch">
                <div class="map-container shadow-md">
                    <iframe src="https://maps.google.com/maps?q={{ urlencode(($user->work_address ?? '').($user->city ? ' '.$user->city : '').($user->state ? ' '.$user->state : '')) }}&output=embed"
                            width="100%" height="100%" style="border:0; min-height:260px;" allowfullscreen="" loading="lazy"></iframe>
                </div>
                <div class="bg-slate-50 rounded-2xl p-7 flex flex-col justify-between">
                    <div>
                        <h4 class="font-bold text-lg text-slate-800 mb-4">Office &amp; Contact</h4>
                        <div class="space-y-3 text-sm">
                            @if($user->work_address)
                            <div class="flex items-center gap-3">
                                <i class="fas fa-map-marker-alt text-blue-600 w-5 text-center"></i>
                                <span class="text-slate-700">{{ $user->work_address }}{{ $user->city ? ', '.$user->city : '' }}{{ $user->state ? ', '.$user->state : '' }}</span>
                            </div>
                            @endif
                            @if($callNumber)
                            <div class="flex items-center gap-3">
                                <i class="fas fa-phone text-blue-600 w-5 text-center"></i>
                                <a href="tel:{{ $callNumber }}" class="text-blue-600 font-semibold">{{ $callNumber }}</a>
                            </div>
                            @endif
                            @if($waNumber)
                            <div class="flex items-center gap-3">
                                <i class="fab fa-whatsapp text-emerald-600 w-5 text-center"></i>
                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/','', $waNumber) }}" class="text-emerald-600 font-semibold">WhatsApp</a>
                            </div>
                            @endif
                        </div>
                    </div>
                    @if(count($workingDays))
                    <div class="mt-6 border-t border-slate-200 pt-5">
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-3">Office Hours</p>
                        <div class="text-sm space-y-1.5 text-slate-600">
                            @foreach($allDays as $day)
                            <div class="flex justify-between">
                                <span>{{ $day }}</span>
                                @if(in_array($day, $workingDays))
                                <span class="font-semibold text-slate-800">Open</span>
                                @else
                                <span class="text-slate-400">Closed</span>
                                @endif
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </section>
        @endif

        {{-- ── FAQ ───────────────────────────────────────────────────── --}}
        <section>
            <div class="text-center mb-10">
                <h3 class="font-bold text-2xl sm:text-3xl sh sh-center">Frequently Asked Questions</h3>
            </div>
            <div class="max-w-3xl mx-auto space-y-3">
                @php
                $faqs = [
                    ['q'=>'How do I get started?',             'a'=>'Simply call or send a WhatsApp message. '.$user->name.' will respond within 24 hours to discuss your needs and next steps.'],
                    ['q'=>'Do you offer virtual / remote services?', 'a'=>'Yes. Services are available both in-person and remotely. Documents can be shared securely online and consultations are available by phone or video call.'],
                    ['q'=>'How quickly can you respond?',      'a'=>'Most inquiries receive a response within 1–2 business hours during office hours. For urgent matters, please call directly.'],
                    ['q'=>'Are your services confidential?',   'a'=>'Absolutely. All client information is handled with strict confidentiality and professional ethics standards.'],
                ];
                @endphp
                @foreach($faqs as $faq)
                <div class="bg-white border border-slate-100 rounded-2xl overflow-hidden shadow-sm">
                    <button onclick="toggleFaq(this)" class="w-full flex items-center justify-between px-6 py-5 text-left hover:bg-slate-50 transition">
                        <span class="font-medium text-sm pr-4">{{ $faq['q'] }}</span>
                        <i class="fas fa-chevron-down text-slate-400 text-sm flex-shrink-0 faq-icon transition-transform duration-300"></i>
                    </button>
                    <div class="faq-content px-6 text-sm text-slate-600 border-t">
                        <p class="py-4">{{ $faq['a'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </section>

    </div>

    {{-- ── CONTACT / BOOKING ────────────────────────────────────────── --}}
    <div id="contact" class="bg-gradient-to-br from-blue-700 via-blue-700 to-indigo-700 text-white py-12 md:py-16">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 text-center">
            <div class="inline-flex items-center gap-2 bg-white/10 border border-white/20 text-blue-100 text-xs font-semibold px-4 py-2 rounded-full mb-6">
                <i class="fas fa-calendar-check text-yellow-300"></i> Free Initial Consultation
            </div>
            <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold">Book Your Free Consultation</h2>
            <p class="text-blue-100 mt-3 text-base">Fill in your details — {{ $user->name }} will respond within 24 hours</p>

            @if(session('inquiry_success'))
            <div class="mt-6 bg-green-500 text-white rounded-2xl px-6 py-4 font-bold">
                <i class="fa-solid fa-circle-check mr-2"></i>{{ session('inquiry_success') }}
            </div>
            @endif

            <button id="bookingToggleBtn" onclick="toggleBooking()"
                    class="flex items-center justify-center gap-3 mx-auto mt-8 bg-white/15 hover:bg-white/25 border border-white/30 text-white px-8 py-3.5 rounded-2xl font-semibold text-sm transition">
                <i class="fas fa-plus-circle" id="bookingIcon"></i>
                <span id="bookingBtnText">Open Booking Form</span>
            </button>

            <div id="bookingBody" class="booking-body mt-6">
                <div class="bg-white/10 backdrop-blur-lg rounded-3xl border border-white/20 text-left overflow-hidden">
                    <div class="px-5 md:px-8 pt-6 pb-4 border-b border-white/10">
                        <h4 class="font-semibold text-base">Booking Request — {{ $user->name }}</h4>
                    </div>
                    <form action="{{ route('service.inquiry', $user->slug) }}" method="POST"
                          class="px-5 md:px-8 pb-6 md:pb-8 pt-5">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-5">
                            <div>
                                <label class="block text-sm mb-2 font-medium">Full Name *</label>
                                <input type="text" name="name" required value="{{ old('name') }}" placeholder="John Smith"
                                       class="w-full px-5 py-3.5 bg-white/20 border border-white/30 rounded-2xl text-white placeholder:text-blue-200 focus:outline-none focus:border-white focus:bg-white/25 transition">
                            </div>
                            <div>
                                <label class="block text-sm mb-2 font-medium">Phone Number *</label>
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
                                class="w-full mt-6 bg-white text-blue-700 hover:bg-yellow-300 py-4 rounded-3xl font-semibold text-lg flex items-center justify-center gap-2 transition shadow-xl">
                            <i class="fas fa-paper-plane"></i> Send Booking Request
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

    {{-- ── CUSTOM FOOTER ───────────────────────────────────────────── --}}
    <footer class="bg-slate-900 text-slate-400 py-10">
        <div class="max-w-5xl mx-auto px-6">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 md:gap-8 pb-8 border-b border-slate-700">
                <div>
                    <div class="flex items-center gap-2 mb-3">
                        <div class="w-8 h-8 bg-blue-600 rounded-xl flex items-center justify-center text-white font-bold text-sm">Z</div>
                        <span class="text-white font-bold text-lg">Zonely</span>
                    </div>
                    <p class="text-xs leading-relaxed">Connecting you with trusted, verified local professionals across the USA.</p>
                </div>
                <div>
                    <h5 class="text-white font-semibold mb-3">{{ $user->name }}</h5>
                    <div class="space-y-2 text-sm">
                        @if($user->work_address || $user->city)
                        <div class="flex items-start gap-2">
                            <i class="fas fa-map-marker-alt w-4 text-blue-500 mt-0.5 flex-shrink-0"></i>
                            <span>{{ $user->work_address ?? '' }}{{ $user->city ? ', '.$user->city : '' }}{{ $user->state ? ', '.$user->state : '' }}</span>
                        </div>
                        @endif
                        @if($callNumber)
                        <div class="flex items-center gap-2">
                            <i class="fas fa-phone w-4 text-blue-500 flex-shrink-0"></i>
                            <a href="tel:{{ $callNumber }}" class="hover:text-white transition">{{ $callNumber }}</a>
                        </div>
                        @endif
                    </div>
                </div>
                @if(count($workingDays))
                <div>
                    <h5 class="text-white font-semibold mb-3">Office Hours</h5>
                    <div class="space-y-1.5 text-sm">
                        @foreach(['Mon – Fri' => ['Monday','Tuesday','Wednesday','Thursday','Friday'], 'Saturday' => ['Saturday'], 'Sunday' => ['Sunday']] as $label => $days)
                        <div class="flex justify-between">
                            <span>{{ $label }}</span>
                            @if(count(array_intersect($days, $workingDays)))
                            <span class="text-white font-medium">Open</span>
                            @else
                            <span>Closed</span>
                            @endif
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
            <div class="pt-6 text-center text-xs opacity-60">&copy; {{ date('Y') }} Zonely &bull; All Rights Reserved</div>
        </div>
    </footer>

{{-- ── MOBILE STICKY CTA ────────────────────────────────────────── --}}
<div class="md:hidden fixed bottom-0 left-0 right-0 z-50 bg-white border-t border-slate-200 shadow-2xl px-4 py-3 flex gap-3">
    @if($callNumber)
    <a href="tel:{{ $callNumber }}"
       class="flex-1 flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-2xl font-semibold text-sm transition">
        <i class="fas fa-phone"></i> Call Now
    </a>
    @endif
    @if($waNumber)
    <a href="https://wa.me/{{ preg_replace('/[^0-9]/','', $waNumber) }}" target="_blank"
       class="flex-1 flex items-center justify-center gap-2 bg-green-500 hover:bg-green-600 text-white py-3 rounded-2xl font-semibold text-sm transition">
        <i class="fab fa-whatsapp"></i> WhatsApp
    </a>
    @endif
    @if(!$callNumber && !$waNumber)
    <a href="#contact"
       class="flex-1 flex items-center justify-center gap-2 bg-blue-600 text-white py-3 rounded-2xl font-semibold text-sm">
        <i class="fas fa-envelope"></i> Contact
    </a>
    @endif
</div>

</div>
@endsection

@section('scripts')
<script>
    document.querySelectorAll('[onclick="toggleAccordion(this)"]').forEach(btn => {
        const i = document.createElement('i');
        i.className = 'acc-icon fas fa-plus text-slate-300 text-xs ml-3 shrink-0 self-center';
        i.style.transition = 'transform 0.3s ease';
        btn.appendChild(i);
    });

    function toggleAccordion(btn) {
        const content = btn.nextElementSibling;
        const icon    = btn.querySelector('.acc-icon');
        content.classList.toggle('open');
        if (icon) icon.style.transform = content.classList.contains('open') ? 'rotate(45deg)' : '';
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
        toggleBooking();
    @endif
</script>
@endsection
