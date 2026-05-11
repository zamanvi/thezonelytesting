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
<section class="pt-28 pb-14 px-4 sm:px-6 bg-gradient-to-b from-teal-50/60 via-white to-white">
    <div class="max-w-3xl mx-auto text-center">

        <div class="inline-flex items-center gap-2 bg-teal-100 text-teal-800 text-xs font-bold px-4 py-1.5 rounded-full mb-6 tracking-wide">
            <i class="fa-solid fa-shield-halved text-teal-600 text-xs"></i> Verified local professionals near you
        </div>

        <h1 class="font-serif text-5xl sm:text-6xl lg:text-7xl text-slate-900 leading-[1.05] tracking-tight mb-5">
            Discover &amp; Hire<br>
            <em class="text-teal-700" style="font-style:italic;">Local Experts</em> Near Me
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
                            class="shrink-0 bg-teal-700 hover:bg-teal-800 text-white text-sm font-bold px-6 py-2.5 rounded-full transition" style="min-height:unset;">
                        Search
                    </button>
                </div>
            </form>

            {{-- Live results --}}
            <div id="liveResults" class="hidden absolute left-0 right-0 bg-white border border-slate-200 rounded-2xl shadow-2xl z-50 overflow-hidden mt-2">
                <div id="liveResultsList"></div>
                <a id="liveResultsMore" href="#"
                   class="block text-center text-xs font-bold text-teal-700 py-3 border-t border-slate-100 hover:bg-slate-50 transition">
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
               class="flex items-center gap-1.5 bg-slate-50 border border-slate-200 hover:border-teal-300 hover:bg-teal-50 hover:text-teal-800 px-4 py-2 rounded-full text-sm font-medium text-slate-600 transition" style="min-height:unset;">
                <i class="fa-solid {{ $s['icon'] }} text-teal-600 text-xs"></i>
                {{ $s['q'] }}
            </a>
            @endforeach
        </div>

        <p class="mt-6 text-sm text-slate-400">
            Are you a professional?
            <a href="{{ route('user.register', 'seller') }}" class="text-teal-700 font-semibold hover:underline">List your business free →</a>
        </p>

    </div>
</section>

{{-- ═══ TRUST STRIP ═══ --}}
<div class="bg-slate-900 py-3.5 px-4">
    <div class="max-w-3xl mx-auto flex items-center justify-center gap-6 sm:gap-10 flex-wrap">
        @foreach([
            ['icon'=>'fa-star','color'=>'text-amber-400','text'=>'4.9 avg rating'],
            ['icon'=>'fa-circle-check','color'=>'text-emerald-400','text'=>'All pros verified'],
            ['icon'=>'fa-lock','color'=>'text-teal-400','text'=>'Secure booking'],
            ['icon'=>'fa-tag','color'=>'text-violet-400','text'=>'No subscription fees'],
        ] as $t)
        <span class="flex items-center gap-2 text-xs font-semibold text-slate-300">
            <i class="fa-solid {{ $t['icon'] }} {{ $t['color'] }} text-xs"></i> {{ $t['text'] }}
        </span>
        @endforeach
    </div>
</div>

{{-- ═══ STATS BAR ═══ --}}
<div class="bg-white border-b border-slate-100">
    <div class="max-w-3xl mx-auto px-4 py-8 grid grid-cols-3 gap-4 text-center">
        <div>
            <div class="text-3xl sm:text-4xl font-black text-teal-700">{{ $stats['pros'] > 0 ? $stats['pros'].'+' : 'Growing' }}</div>
            <div class="text-xs text-slate-500 font-semibold mt-1 uppercase tracking-wide">Verified Pros</div>
        </div>
        <div class="border-x border-slate-100">
            <div class="text-3xl sm:text-4xl font-black text-teal-700">{{ $stats['reviews'] > 0 ? $stats['reviews'].'+' : '5★' }}</div>
            <div class="text-xs text-slate-500 font-semibold mt-1 uppercase tracking-wide">Client Reviews</div>
        </div>
        <div>
            <div class="text-3xl sm:text-4xl font-black text-teal-700">{{ $stats['cities'] > 0 ? $stats['cities'].'+' : 'USA' }}</div>
            <div class="text-xs text-slate-500 font-semibold mt-1 uppercase tracking-wide">Cities Covered</div>
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
               class="text-sm font-semibold text-slate-600 hover:text-teal-700 border border-slate-200 hover:border-teal-300 px-4 py-2 rounded-full transition" style="min-height:unset;">
                See All
            </a>
        </div>

        <div class="grid sm:grid-cols-2 gap-4">
            @forelse(($users ?? collect())->take(8) as $user)
            @php $initials = strtoupper(substr($user->name, 0, 2)); @endphp
            <div class="pro-card bg-white border border-slate-100 rounded-2xl overflow-hidden flex shadow-sm">

                {{-- Photo --}}
                <div class="relative w-36 sm:w-40 shrink-0">
                    @if($user->profile_photo)
                    <img src="{{ asset($user->profile_photo) }}"
                         onerror="this.src='';this.classList.add('hidden');this.nextElementSibling.classList.remove('hidden');"
                         class="w-full h-full object-cover min-h-[160px]">
                    <div class="hidden w-full min-h-[160px] bg-teal-700 items-center justify-center text-white font-black text-2xl">
                        {{ $initials }}
                    </div>
                    @else
                    <div class="w-full min-h-[160px] bg-teal-700 flex items-center justify-center text-white font-black text-2xl">
                        {{ $initials }}
                    </div>
                    @endif
                    @if($user->status)
                    <span class="absolute bottom-3 left-3 bg-emerald-500 text-white text-[9px] font-black px-2.5 py-1 rounded-full tracking-widest uppercase flex items-center gap-1">
                        <i class="fa-solid fa-circle-check text-[8px]"></i> Verified
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
                        @php $rCount = $user->reviews->count(); $rAvg = $rCount ? round($user->reviews->avg('rating'),1) : null; @endphp
                        @if($rAvg)
                        <div class="flex items-center gap-1 mt-2">
                            @for($i=1;$i<=5;$i++)<i class="fa-solid fa-star text-amber-400 text-[9px]{{ $i > $rAvg ? ' opacity-30' : '' }}"></i>@endfor
                            <span class="text-xs font-semibold text-slate-600 ml-1">{{ $rAvg }} ({{ $rCount }})</span>
                        </div>
                        @endif
                    </div>
                    <div class="flex items-center gap-3 mt-4">
                        <a href="{{ route('frontend.service.show', $user->slug ?? $user->id) }}"
                           class="bg-teal-700 hover:bg-teal-800 text-white text-xs font-bold px-5 py-2 rounded-full transition shadow-sm shadow-teal-200" style="min-height:unset;">
                            Hire Expert
                        </a>
                        <a href="{{ route('frontend.service.show', $user->slug ?? $user->id) }}"
                           class="text-sm text-slate-400 hover:text-teal-700 font-semibold transition" style="min-height:unset;">
                            View Profile →
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
<div class="h-20 bg-gradient-to-b from-white to-slate-950"></div>
<section class="pb-0 px-4 sm:px-6 bg-slate-950">
    <div class="max-w-4xl mx-auto">
        <div class="bg-gradient-to-r from-teal-800 to-indigo-700 rounded-3xl overflow-hidden relative shadow-2xl">
            <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_top_right,rgba(255,255,255,0.08),transparent_60%)] pointer-events-none"></div>
            <div class="relative px-8 sm:px-14 py-12 flex flex-col sm:flex-row items-center gap-10">
                <div class="flex-1">
                    <span class="inline-block text-[11px] font-black text-teal-200 uppercase tracking-widest mb-4">For Professionals</span>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-white mb-3 leading-snug">
                        Get qualified leads.<br>Pay only per call.
                    </h2>
                    <p class="text-teal-100 text-sm leading-relaxed mb-8 max-w-sm opacity-85">
                        Customers in your area are searching right now. Your verified profile shows up first. No subscription. No ads.
                    </p>
                    <a href="{{ route('user.register', 'seller') }}"
                       class="inline-flex items-center gap-2 bg-white text-teal-800 hover:bg-yellow-300 font-bold px-7 py-3.5 rounded-xl text-sm transition shadow-lg" style="min-height:unset;">
                        Create free profile →
                    </a>
                </div>
                <div class="shrink-0 grid grid-cols-1 gap-3 w-full sm:w-56">
                    @foreach([
                        ['icon'=>'fa-circle-check','text'=>'Free to join'],
                        ['icon'=>'fa-circle-check','text'=>'Pay per verified lead only'],
                        ['icon'=>'fa-circle-check','text'=>'Real-time call forwarding'],
                        ['icon'=>'fa-circle-check','text'=>'Dashboard to track all leads'],
                    ] as $f)
                    <div class="flex items-center gap-3">
                        <i class="fa-solid {{ $f['icon'] }} text-emerald-300 shrink-0"></i>
                        <span class="text-sm font-semibold text-white">{{ $f['text'] }}</span>
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
{{-- ═══ FOOTER ═══ --}}
<footer class="bg-slate-950 border-t border-slate-800 pt-12 pb-8 px-4 sm:px-6">
    <div class="max-w-5xl mx-auto">
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-8 mb-10">
            <div class="col-span-2 sm:col-span-1">
                <span class="text-white font-extrabold text-xl tracking-tight">Zonely<span class="text-teal-600">.</span></span>
                <p class="text-slate-400 text-xs mt-3 leading-relaxed max-w-xs">Find verified local professionals near you. Fast, trusted, and transparent.</p>
            </div>
            <div>
                <p class="text-slate-300 font-bold text-xs uppercase tracking-widest mb-4">Explore</p>
                <ul class="space-y-2 text-sm text-slate-400">
                    <li><a href="{{ route('frontend.service.all') }}" class="hover:text-white transition">All Professionals</a></li>
                    <li><a href="{{ route('frontend.service.search') }}?q=Lawyer" class="hover:text-white transition">Lawyers</a></li>
                    <li><a href="{{ route('frontend.service.search') }}?q=Plumber" class="hover:text-white transition">Plumbers</a></li>
                    <li><a href="{{ route('frontend.service.search') }}?q=Tax+Expert" class="hover:text-white transition">Tax Experts</a></li>
                </ul>
            </div>
            <div>
                <p class="text-slate-300 font-bold text-xs uppercase tracking-widest mb-4">For Pros</p>
                <ul class="space-y-2 text-sm text-slate-400">
                    <li><a href="{{ route('user.register', 'seller') }}" class="hover:text-white transition">Join Free</a></li>
                    <li><a href="{{ route('user.login') }}" class="hover:text-white transition">Sign In</a></li>
                </ul>
            </div>
            <div>
                <p class="text-slate-300 font-bold text-xs uppercase tracking-widest mb-4">Company</p>
                <ul class="space-y-2 text-sm text-slate-400">
                    <li><a href="{{ route('frontend.about-us') }}" class="hover:text-white transition">About Us</a></li>
                    <li><a href="{{ route('frontend.contact') }}" class="hover:text-white transition">Contact</a></li>
                    <li><a href="{{ route('frontend.privacy-policy') }}" class="hover:text-white transition">Privacy Policy</a></li>
                    <li><a href="{{ route('frontend.terms-and-condition') }}" class="hover:text-white transition">Terms of Service</a></li>
                </ul>
            </div>
        </div>
        <div class="border-t border-slate-800 pt-6 flex flex-col sm:flex-row items-center justify-between gap-3">
            <p class="text-xs text-slate-500">&copy; {{ date('Y') }} Zonely. All rights reserved.</p>
            <p class="text-xs text-slate-600">Connecting clients with verified local professionals across the USA.</p>
        </div>
    </div>
</footer>

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
        const src = u.photo ? (u.photo.startsWith('storage/') || u.photo.startsWith('/storage/') ? '/'+u.photo.replace(/^\//,'') : '/storage/'+u.photo) : null;
        return src
            ? `<img src="${src}" onerror="this.style.display='none'" class="w-10 h-10 rounded-xl object-cover shrink-0">`
            : `<div class="w-10 h-10 bg-teal-700 rounded-xl flex items-center justify-center text-white font-black text-sm shrink-0">${i}</div>`;
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
