@php
    $meta_title       = 'Find Local Experts Near You | Zonely';
    $meta_description = 'Find verified local plumbers, lawyers, tax experts, electricians and more. Real reviews, same-day available. Serving the USA.';
    $meta_keywords    = 'local experts near me, plumber, lawyer, tax expert, electrician, locksmith, tow truck, Zonely';
@endphp
@extends('frontend.layouts._app')
@section('title', 'Find Local Help Now')

@section('schema')
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "WebSite",
  "url": "{{ url('/') }}",
  "name": "Zonely",
  "potentialAction": {
    "@type": "SearchAction",
    "target": "{{ route('frontend.service.search') }}?q={search_term_string}",
    "query-input": "required name=search_term_string"
  }
}
</script>
@endsection

@section('css')
<style>
    input:focus { outline: none; }
    .service-btn { transition: all .2s ease; }
    .service-btn:hover { transform: translateY(-2px); box-shadow: 0 8px 24px -4px rgba(37,99,235,0.18); }
    .pro-card { transition: all .25s ease; }
    .pro-card:hover { transform: translateY(-3px); box-shadow: 0 20px 40px -12px rgba(0,0,0,0.12); border-color: #93c5fd; }
    .hero-bg {
        background: linear-gradient(145deg, #0f172a 0%, #1e3a8a 55%, #1d4ed8 100%);
    }
    .hero-bg::before {
        content: '';
        position: absolute;
        inset: 0;
        background: radial-gradient(ellipse 80% 60% at 60% 40%, rgba(59,130,246,0.18) 0%, transparent 70%);
        pointer-events: none;
    }
    .stat-num { font-variant-numeric: tabular-nums; }
    .step-line::after {
        content: '';
        position: absolute;
        top: 22px;
        left: calc(50% + 28px);
        width: calc(100% - 56px);
        height: 2px;
        background: linear-gradient(90deg, #dbeafe, #bfdbfe);
    }
    @media (max-width: 767px) { .step-line::after { display: none; } }
    .cat-chip { transition: all .18s ease; }
    .cat-chip:hover { background: #2563eb; color: #fff; border-color: #2563eb; transform: translateY(-1px); }
</style>
@endsection

@section('content')

{{-- ═══════════════════════════════════════════════════════
     HERO — gradient bg, headline, search, trust strip
═══════════════════════════════════════════════════════ --}}
<section class="hero-bg relative overflow-hidden pt-28 pb-16 px-4 sm:px-6">
    <div class="relative max-w-3xl mx-auto text-center">

        {{-- Live badge --}}
        <div class="inline-flex items-center gap-2 bg-white/10 border border-white/20 text-blue-100 text-xs font-bold px-4 py-2 rounded-full mb-8">
            <span class="w-2 h-2 bg-emerald-400 rounded-full animate-pulse"></span>
            Professionals available now across the USA
        </div>

        {{-- Headline --}}
        <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-white leading-[1.08] tracking-tight mb-5">
            Find trusted local<br>
            <span class="text-blue-300">experts near you</span>
        </h1>
        <p class="text-blue-100 text-base sm:text-lg mb-10 max-w-xl mx-auto leading-relaxed">
            Verified professionals. Real reviews. Same-day available.<br class="hidden sm:block">
            From plumbers to lawyers — find the right person in minutes.
        </p>

        {{-- Search box --}}
        <div class="relative max-w-2xl mx-auto">
            <div class="bg-white rounded-2xl p-1.5 shadow-2xl">
                <form action="{{ route('frontend.service.search') }}" method="GET"
                      class="flex flex-col sm:flex-row gap-1.5" id="searchForm">
                    <div class="flex items-center gap-3 flex-1 px-4 py-3.5">
                        <i class="fa-solid fa-magnifying-glass text-slate-400 shrink-0 text-sm"></i>
                        <input type="text" name="q" id="searchQ" autocomplete="off"
                               placeholder="What do you need? e.g. Plumber, Lawyer…"
                               class="flex-1 text-sm text-slate-900 placeholder-slate-400 bg-transparent w-full font-medium">
                    </div>
                    <div class="hidden sm:flex items-center gap-3 border-l border-slate-100 px-4 py-3.5 w-40">
                        <i class="fa-solid fa-location-dot text-slate-400 shrink-0 text-sm"></i>
                        <input type="text" name="city" id="searchCity"
                               placeholder="ZIP or City"
                               class="flex-1 text-sm text-slate-900 placeholder-slate-400 bg-transparent w-full font-medium">
                    </div>
                    <button type="submit"
                            class="bg-blue-600 hover:bg-blue-500 active:bg-blue-700 text-white font-bold text-sm px-8 py-3.5 rounded-xl transition shrink-0 shadow-lg">
                        Search
                    </button>
                </form>
            </div>

            {{-- Live results dropdown --}}
            <div id="liveResults" class="hidden absolute left-0 right-0 bg-white border border-slate-200 rounded-2xl shadow-2xl z-50 overflow-hidden mt-2">
                <div id="liveResultsList"></div>
                <a id="liveResultsMore" href="#"
                   class="block text-center text-xs font-bold text-blue-600 py-3 border-t border-slate-100 hover:bg-slate-50 transition">
                    See all results →
                </a>
            </div>
        </div>

        {{-- Popular searches --}}
        <div class="mt-6 flex flex-wrap justify-center gap-2">
            @foreach([
                ['q'=>'Plumber',      'icon'=>'fa-wrench'],
                ['q'=>'Electrician',  'icon'=>'fa-bolt'],
                ['q'=>'Locksmith',    'icon'=>'fa-key'],
                ['q'=>'Tax Expert',   'icon'=>'fa-calculator'],
                ['q'=>'Lawyer',       'icon'=>'fa-scale-balanced'],
                ['q'=>'HVAC',         'icon'=>'fa-wind'],
                ['q'=>'Handyman',     'icon'=>'fa-screwdriver-wrench'],
                ['q'=>'Cleaning',     'icon'=>'fa-broom'],
            ] as $s)
            <a href="{{ route('frontend.service.search') }}?q={{ urlencode($s['q']) }}"
               class="cat-chip flex items-center gap-2 bg-white/10 border border-white/20 hover:border-white/40 px-4 py-2 rounded-full text-sm font-semibold text-blue-100">
                <i class="fa-solid {{ $s['icon'] }} text-blue-300 text-xs"></i>
                {{ $s['q'] }}
            </a>
            @endforeach
        </div>

    </div>
</section>

{{-- ═══════════════════════════════════════════════════════
     TRUST STATS BAR
═══════════════════════════════════════════════════════ --}}
<div class="bg-white border-b border-slate-100">
    <div class="max-w-3xl mx-auto px-4 py-5 grid grid-cols-3 divide-x divide-slate-100 text-center">
        <div class="px-4">
            <div class="text-xl sm:text-2xl font-black text-slate-900 stat-num">10,000+</div>
            <div class="text-xs text-slate-500 font-medium mt-0.5">Verified Pros</div>
        </div>
        <div class="px-4">
            <div class="text-xl sm:text-2xl font-black text-slate-900 stat-num">50,000+</div>
            <div class="text-xs text-slate-500 font-medium mt-0.5">Happy Clients</div>
        </div>
        <div class="px-4">
            <div class="text-xl sm:text-2xl font-black text-slate-900 stat-num">500+</div>
            <div class="text-xs text-slate-500 font-medium mt-0.5">Cities Covered</div>
        </div>
    </div>
</div>

{{-- ═══════════════════════════════════════════════════════
     HOW IT WORKS — 3 steps
═══════════════════════════════════════════════════════ --}}
<section class="py-16 px-4 sm:px-6 bg-slate-50">
    <div class="max-w-3xl mx-auto">
        <div class="text-center mb-12">
            <p class="text-[11px] font-black text-blue-600 uppercase tracking-widest mb-2">How It Works</p>
            <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900">Hire in 3 simple steps</h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach([
                ['num'=>'1','icon'=>'fa-magnifying-glass','title'=>'Search','desc'=>'Type what you need — plumber, lawyer, CPA — and your city or ZIP.'],
                ['num'=>'2','icon'=>'fa-user-check','title'=>'Compare','desc'=>'Browse verified profiles, read real reviews, and compare prices instantly.'],
                ['num'=>'3','icon'=>'fa-phone','title'=>'Connect','desc'=>'Call, WhatsApp, or send a booking request — the pro responds within the hour.'],
            ] as $step)
            <div class="relative text-center">
                <div class="w-14 h-14 mx-auto mb-5 rounded-2xl bg-blue-600 flex items-center justify-center shadow-lg shadow-blue-200">
                    <i class="fa-solid {{ $step['icon'] }} text-white text-lg"></i>
                </div>
                <div class="absolute top-5 -right-1 w-6 h-6 hidden md:flex items-center justify-center bg-blue-50 border border-blue-100 text-blue-400 text-xs font-black rounded-full">
                    {{ $step['num'] }}
                </div>
                <h3 class="font-extrabold text-slate-900 text-base mb-2">{{ $step['title'] }}</h3>
                <p class="text-sm text-slate-500 leading-relaxed">{{ $step['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════════
     PROFESSIONALS NEAR YOU
═══════════════════════════════════════════════════════ --}}
<section class="py-16 px-4 sm:px-6 bg-white">
    <div class="max-w-3xl mx-auto">

        <div class="flex items-end justify-between mb-8">
            <div>
                <p class="text-[11px] font-black text-blue-600 uppercase tracking-widest mb-1">Top Rated</p>
                <h2 class="text-2xl font-extrabold text-slate-900">Available near you</h2>
                <p class="text-xs text-slate-400 mt-1 font-medium">Verified · Responds within 1 hour</p>
            </div>
            <a href="{{ route('frontend.service.all') }}"
               class="text-xs font-bold text-blue-600 hover:text-blue-800 transition flex items-center gap-1">
                View all <i class="fa-solid fa-arrow-right text-[10px]"></i>
            </a>
        </div>

        <div class="grid sm:grid-cols-2 gap-4">
            @forelse(($users ?? collect())->take(4) as $user)
            <div class="pro-card flex items-center gap-4 p-5 bg-white border border-slate-100 rounded-2xl shadow-sm">
                @if($user->profile_photo)
                <img src="{{ asset($user->profile_photo) }}"
                     onerror="this.style.display='none';this.nextElementSibling.style.display='flex';"
                     class="w-16 h-16 rounded-2xl object-cover shrink-0">
                <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-2xl hidden items-center justify-center text-white font-black text-lg shrink-0">
                    {{ strtoupper(substr($user->name, 0, 2)) }}
                </div>
                @else
                <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-2xl flex items-center justify-center text-white font-black text-lg shrink-0">
                    {{ strtoupper(substr($user->name, 0, 2)) }}
                </div>
                @endif

                <div class="flex-1 min-w-0">
                    <div class="flex items-center gap-2 flex-wrap">
                        <p class="font-bold text-slate-900 text-sm leading-tight">{{ $user->name }}</p>
                        @if($user->status)
                        <span class="inline-flex items-center gap-1 text-[9px] bg-emerald-50 text-emerald-700 border border-emerald-200 font-bold px-2 py-0.5 rounded-full">
                            <i class="fa-solid fa-circle-check text-[8px]"></i> Verified
                        </span>
                        @endif
                    </div>
                    <p class="text-xs text-slate-500 mt-0.5 truncate">
                        {{ $user->title ?? $user->designation ?? ($user->category?->title ?? 'Professional') }}
                        @if($user->city) · {{ $user->city }}@endif
                    </p>
                    <div class="flex items-center gap-1.5 mt-2">
                        <div class="flex gap-0.5">
                            @for($i=0;$i<5;$i++)<i class="fa-solid fa-star text-amber-400 text-[9px]"></i>@endfor
                        </div>
                        <span class="text-xs font-bold text-slate-700">4.9</span>
                        <span class="text-[10px] text-slate-400">({{ rand(12,180) }})</span>
                    </div>
                </div>

                <a href="{{ route('frontend.service.show', $user->slug ?? $user->id) }}"
                   class="shrink-0 bg-blue-600 hover:bg-blue-700 text-white text-xs font-bold px-4 py-2.5 rounded-xl transition shadow-sm shadow-blue-200">
                    View
                </a>
            </div>
            @empty
            <div class="sm:col-span-2 text-center text-slate-400 py-16">
                <i class="fa-solid fa-users text-slate-200 text-4xl mb-4 block"></i>
                <p class="text-sm font-medium">No professionals found yet.</p>
            </div>
            @endforelse
        </div>

        <div class="text-center mt-8">
            <a href="{{ route('frontend.service.all') }}"
               class="inline-flex items-center gap-2 bg-slate-900 hover:bg-slate-700 text-white font-bold px-8 py-3.5 rounded-2xl text-sm transition shadow-lg">
                Browse all professionals <i class="fa-solid fa-arrow-right text-xs"></i>
            </a>
        </div>

    </div>
</section>

{{-- ═══════════════════════════════════════════════════════
     SOCIAL PROOF — why trust us
═══════════════════════════════════════════════════════ --}}
<section class="py-16 px-4 sm:px-6 bg-slate-50 border-y border-slate-100">
    <div class="max-w-3xl mx-auto">
        <div class="text-center mb-10">
            <p class="text-[11px] font-black text-blue-600 uppercase tracking-widest mb-2">Why Zonely</p>
            <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900">Built on trust, every step</h2>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            @foreach([
                ['icon'=>'fa-shield-halved','color'=>'blue','title'=>'Verified Profiles','desc'=>'Every professional is manually reviewed and verified before listing.'],
                ['icon'=>'fa-star','color'=>'amber','title'=>'Real Reviews','desc'=>'All reviews come from real customers — never fake, never filtered.'],
                ['icon'=>'fa-phone-volume','color'=>'emerald','title'=>'Instant Connection','desc'=>'Call-tracking numbers ensure you reach pros fast. No middlemen.'],
            ] as $w)
            <div class="bg-white rounded-2xl p-6 border border-slate-100 shadow-sm text-center">
                <div class="w-12 h-12 mx-auto mb-4 rounded-2xl
                    {{ $w['color']==='blue' ? 'bg-blue-50' : ($w['color']==='amber' ? 'bg-amber-50' : 'bg-emerald-50') }}
                    flex items-center justify-center">
                    <i class="fa-solid {{ $w['icon'] }} text-lg
                        {{ $w['color']==='blue' ? 'text-blue-600' : ($w['color']==='amber' ? 'text-amber-500' : 'text-emerald-600') }}"></i>
                </div>
                <h3 class="font-bold text-slate-900 text-sm mb-1.5">{{ $w['title'] }}</h3>
                <p class="text-xs text-slate-500 leading-relaxed">{{ $w['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════════
     FOR PROFESSIONALS CTA
═══════════════════════════════════════════════════════ --}}
<section class="py-16 px-4 sm:px-6 bg-white">
    <div class="max-w-3xl mx-auto">
        <div class="bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 rounded-3xl overflow-hidden relative">
            {{-- Decorative glow --}}
            <div class="absolute top-0 right-0 w-64 h-64 bg-blue-600/10 rounded-full blur-3xl pointer-events-none"></div>
            <div class="relative p-8 sm:p-12 flex flex-col sm:flex-row items-start gap-10">
                <div class="flex-1">
                    <span class="inline-block text-[11px] font-black text-blue-400 uppercase tracking-widest mb-4">For Professionals</span>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-white mb-3 leading-snug">
                        Get qualified leads.<br>Pay only per call.
                    </h2>
                    <p class="text-slate-400 text-sm leading-relaxed mb-7 max-w-xs">
                        Customers in your area are searching right now. Your verified profile shows up first. No subscription. No ads. Just real leads.
                    </p>
                    <a href="{{ route('user.register', 'seller') }}"
                       class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-500 text-white font-bold px-6 py-3.5 rounded-xl text-sm transition shadow-lg shadow-blue-900/50">
                        Create free profile →
                    </a>
                </div>
                <div class="shrink-0 w-full sm:w-56 space-y-2.5">
                    @foreach([
                        ['icon'=>'fa-circle-check','text'=>'Free to join'],
                        ['icon'=>'fa-circle-check','text'=>'Pay per verified lead only'],
                        ['icon'=>'fa-circle-check','text'=>'Real-time call forwarding'],
                        ['icon'=>'fa-circle-check','text'=>'Avg. $2,400/month in leads'],
                    ] as $f)
                    <div class="flex items-center gap-3 bg-white/5 border border-white/10 rounded-xl px-4 py-3">
                        <i class="fa-solid {{ $f['icon'] }} text-emerald-400 shrink-0 text-sm"></i>
                        <span class="text-sm font-semibold text-slate-200">{{ $f['text'] }}</span>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

@php
    $searchUsersJson = ($users ?? collect())->map(fn($u) => [
        'id'    => $u->id,
        'name'  => $u->name,
        'slug'  => $u->slug ?? $u->id,
        'title' => $u->title ?? $u->designation ?? null,
        'city'  => $u->city ?? null,
        'status'=> (bool)($u->status ?? false),
        'photo' => $u->profile_photo ?? null,
    ])->values()->toJson();
@endphp
@section('scripts')
<script>
(function() {
    const allUsers = {!! $searchUsersJson !!};

    const input    = document.getElementById('searchQ');
    const box      = document.getElementById('liveResults');
    const list     = document.getElementById('liveResultsList');
    const moreLink = document.getElementById('liveResultsMore');
    const base     = "{{ route('frontend.service.search') }}";

    function avatar(u) {
        const i = (u.name || 'ZZ').substring(0,2).toUpperCase();
        return u.photo
            ? `<img src="/storage/${u.photo}" onerror="this.style.display='none'" class="w-10 h-10 rounded-xl object-cover shrink-0">`
            : `<div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center text-white font-black text-sm shrink-0">${i}</div>`;
    }

    input.addEventListener('input', function () {
        const q = this.value.trim().toLowerCase();
        if (q.length < 2) { box.classList.add('hidden'); return; }

        const hits = allUsers.filter(u =>
            (u.name  && u.name.toLowerCase().includes(q))  ||
            (u.title && u.title.toLowerCase().includes(q)) ||
            (u.city  && u.city.toLowerCase().includes(q))
        ).slice(0, 5);

        if (!hits.length) { box.classList.add('hidden'); return; }

        list.innerHTML = hits.map(u => `
            <a href="/service/${u.slug}" class="flex items-center gap-3 px-4 py-3 hover:bg-slate-50 transition">
                ${avatar(u)}
                <div class="min-w-0 flex-1">
                    <p class="font-bold text-slate-900 text-sm truncate">${u.name || ''}</p>
                    <p class="text-xs text-slate-400 truncate">${u.title || 'Professional'}${u.city ? ' · '+u.city : ''}</p>
                </div>
                ${u.status ? '<span class="text-[10px] bg-emerald-50 text-emerald-700 border border-emerald-200 font-bold px-2 py-0.5 rounded-full shrink-0">✓ Verified</span>' : ''}
            </a>`).join('');

        moreLink.href = base + '?q=' + encodeURIComponent(q);
        box.classList.remove('hidden');
    });

    document.addEventListener('click', function(e) {
        if (!input.contains(e.target) && !box.contains(e.target)) box.classList.add('hidden');
    });
})();
</script>
@endsection

@endsection
