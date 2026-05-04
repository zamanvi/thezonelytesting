@php
    $meta_title       = 'Discover & Hire Local Experts Near Me | Zonely';
    $meta_description = 'Find verified local plumbers, lawyers, tax experts, electricians and more. Real reviews, same-day available. Serving the USA.';
    $meta_keywords    = 'local experts near me, plumber, lawyer, tax expert, electrician, locksmith, Zonely';
@endphp
@extends('frontend.layouts._app')
@section('title', 'Discover & Hire Local Experts Near Me')

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
    .pro-card { transition: box-shadow .2s ease, transform .2s ease; }
    .pro-card:hover { transform: translateY(-2px); box-shadow: 0 16px 40px -12px rgba(0,0,0,0.12); }
    .search-pill:focus-within { box-shadow: 0 0 0 3px rgba(37,99,235,0.15); }
</style>
@endsection

@section('content')

{{-- ═══ HERO ═══ --}}
<section class="pt-28 pb-14 px-4 sm:px-6 bg-white">
    <div class="max-w-3xl mx-auto text-center">

        <h1 class="font-serif text-5xl sm:text-6xl lg:text-7xl text-slate-900 leading-[1.05] tracking-tight mb-5">
            Discover &amp; Hire<br>
            <em class="italic text-blue-600 not-italic" style="font-style:italic;">Local Experts</em> Near Me
        </h1>
        <p class="text-slate-500 text-base sm:text-lg mb-10 max-w-lg mx-auto leading-relaxed">
            Access the top 1% of verified professionals in your area. Fast, secure, and expert-led.
        </p>

        {{-- Single search pill --}}
        <div class="relative max-w-xl mx-auto">
            <form action="{{ route('frontend.service.search') }}" method="GET" id="searchForm">
                <div class="search-pill flex items-center bg-white border border-slate-200 rounded-full shadow-md px-5 py-1 gap-3 transition">
                    <i class="fa-solid fa-magnifying-glass text-slate-400 text-sm shrink-0"></i>
                    <input type="text" name="q" id="searchQ" autocomplete="off"
                           placeholder="Who are you looking for?"
                           class="flex-1 text-sm text-slate-800 placeholder-slate-400 bg-transparent py-3 font-medium focus:outline-none">
                    <button type="submit"
                            class="shrink-0 bg-blue-600 hover:bg-blue-700 text-white text-sm font-bold px-6 py-2.5 rounded-full transition" style="min-height:unset;">
                        Search
                    </button>
                </div>
            </form>

            {{-- Live results --}}
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
                ['q'=>'Plumber','icon'=>'fa-wrench'],
                ['q'=>'Electrician','icon'=>'fa-bolt'],
                ['q'=>'Locksmith','icon'=>'fa-key'],
                ['q'=>'Tax Expert','icon'=>'fa-calculator'],
                ['q'=>'Lawyer','icon'=>'fa-scale-balanced'],
                ['q'=>'HVAC','icon'=>'fa-wind'],
                ['q'=>'Handyman','icon'=>'fa-screwdriver-wrench'],
                ['q'=>'Cleaning','icon'=>'fa-broom'],
            ] as $s)
            <a href="{{ route('frontend.service.search') }}?q={{ urlencode($s['q']) }}"
               class="flex items-center gap-1.5 bg-slate-50 border border-slate-200 hover:border-blue-300 hover:bg-blue-50 hover:text-blue-700 px-4 py-2 rounded-full text-sm font-medium text-slate-600 transition" style="min-height:unset;">
                <i class="fa-solid {{ $s['icon'] }} text-blue-500 text-xs"></i>
                {{ $s['q'] }}
            </a>
            @endforeach
        </div>

    </div>
</section>

{{-- ═══ STATS BAR ═══ --}}
<div class="border-y border-slate-100 bg-slate-50">
    <div class="max-w-3xl mx-auto px-4 py-5 grid grid-cols-3 divide-x divide-slate-200 text-center">
        <div class="px-4">
            <div class="text-xl sm:text-2xl font-black text-slate-900">10,000+</div>
            <div class="text-xs text-slate-500 font-medium mt-0.5">Verified Pros</div>
        </div>
        <div class="px-4">
            <div class="text-xl sm:text-2xl font-black text-slate-900">50,000+</div>
            <div class="text-xs text-slate-500 font-medium mt-0.5">Happy Clients</div>
        </div>
        <div class="px-4">
            <div class="text-xl sm:text-2xl font-black text-slate-900">500+</div>
            <div class="text-xs text-slate-500 font-medium mt-0.5">Cities Covered</div>
        </div>
    </div>
</div>

{{-- ═══ FEATURED EXPERTS ═══ --}}
<section class="py-14 px-4 sm:px-6 bg-white">
    <div class="max-w-3xl mx-auto">

        <div class="flex items-center justify-between mb-8">
            <div>
                <p class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-1">Featured Experts Nearby</p>
                <div class="w-10 h-0.5 bg-slate-900 rounded-full"></div>
            </div>
            <a href="{{ route('frontend.service.all') }}"
               class="text-sm font-semibold text-slate-600 hover:text-blue-600 border border-slate-200 hover:border-blue-300 px-4 py-2 rounded-full transition" style="min-height:unset;">
                See All
            </a>
        </div>

        <div class="grid sm:grid-cols-2 gap-4">
            @forelse(($users ?? collect())->take(4) as $user)
            @php $initials = strtoupper(substr($user->name, 0, 2)); @endphp
            <div class="pro-card bg-white border border-slate-100 rounded-2xl overflow-hidden flex shadow-sm">

                {{-- Photo --}}
                <div class="relative w-36 sm:w-40 shrink-0">
                    @if($user->profile_photo)
                    <img src="{{ asset($user->profile_photo) }}"
                         onerror="this.src='';this.classList.add('hidden');this.nextElementSibling.classList.remove('hidden');"
                         class="w-full h-full object-cover min-h-[160px]">
                    <div class="hidden w-full min-h-[160px] bg-blue-600 items-center justify-center text-white font-black text-2xl">
                        {{ $initials }}
                    </div>
                    @else
                    <div class="w-full min-h-[160px] bg-blue-600 flex items-center justify-center text-white font-black text-2xl">
                        {{ $initials }}
                    </div>
                    @endif
                    @if($user->status)
                    <span class="absolute bottom-3 left-3 bg-slate-900 text-white text-[9px] font-black px-2.5 py-1 rounded-full tracking-widest uppercase">
                        Verified
                    </span>
                    @endif
                </div>

                {{-- Info --}}
                <div class="flex flex-col justify-between p-5 flex-1 min-w-0">
                    <div>
                        <h3 class="font-serif text-base sm:text-lg font-bold text-slate-900 leading-tight truncate">
                            {{ $user->name }}
                        </h3>
                        <p class="text-xs text-slate-500 mt-1 truncate">
                            {{ $user->title ?? $user->designation ?? ($user->category?->title ?? 'Professional') }}
                            @if($user->city) · {{ $user->city }}@endif
                        </p>
                        <div class="flex items-center gap-1 mt-2">
                            @for($i=0;$i<5;$i++)<i class="fa-solid fa-star text-amber-400 text-[9px]"></i>@endfor
                            <span class="text-xs font-semibold text-slate-600 ml-1">4.9</span>
                        </div>
                    </div>
                    <div class="flex items-center gap-3 mt-4">
                        <a href="{{ route('frontend.service.show', $user->slug ?? $user->id) }}"
                           class="bg-slate-900 hover:bg-blue-600 text-white text-xs font-bold px-4 py-2 rounded-full transition" style="min-height:unset;">
                            Hire Expert
                        </a>
                        <a href="{{ route('frontend.service.show', $user->slug ?? $user->id) }}"
                           class="text-sm text-slate-500 hover:text-blue-600 font-medium transition" style="min-height:unset;">
                            View Portfolio
                        </a>
                    </div>
                </div>

            </div>
            @empty
            <div class="sm:col-span-2 text-center text-slate-400 py-16">
                <i class="fa-solid fa-users text-slate-200 text-4xl mb-4 block"></i>
                <p class="text-sm font-medium">No professionals found yet.</p>
            </div>
            @endforelse
        </div>

    </div>
</section>

{{-- ═══ FOR PROS CTA ═══ --}}
<section class="pt-14 pb-0 px-4 sm:px-6 bg-slate-950">
    <div class="max-w-3xl mx-auto">
        <div class="bg-gradient-to-br from-slate-800 via-slate-800 to-slate-900 rounded-3xl overflow-hidden relative">
            <div class="absolute top-0 right-0 w-64 h-64 bg-blue-600/10 rounded-full blur-3xl pointer-events-none"></div>
            <div class="relative p-8 sm:p-12 flex flex-col sm:flex-row items-start gap-10">
                <div class="flex-1">
                    <span class="inline-block text-[11px] font-black text-blue-400 uppercase tracking-widest mb-4">For Professionals</span>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-white mb-3 leading-snug">
                        Get qualified leads.<br>Pay only per call.
                    </h2>
                    <p class="text-slate-400 text-sm leading-relaxed mb-7 max-w-xs">
                        Customers in your area are searching right now. Your verified profile shows up first. No subscription. No ads.
                    </p>
                    <a href="{{ route('user.register', 'seller') }}"
                       class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-500 text-white font-bold px-6 py-3.5 rounded-xl text-sm transition shadow-lg shadow-blue-900/50" style="min-height:unset;">
                        Create free profile →
                    </a>
                </div>
                <div class="shrink-0 w-full sm:w-52 space-y-2.5">
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
            : `<div class="w-10 h-10 bg-blue-600 rounded-xl flex items-center justify-center text-white font-black text-sm shrink-0">${i}</div>`;
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
                ${u.status ? '<span class="text-[10px] bg-emerald-50 text-emerald-700 font-bold px-2 py-0.5 rounded-full shrink-0">✓ Verified</span>' : ''}
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
