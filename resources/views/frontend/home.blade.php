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
    .service-btn { transition: transform .15s ease, box-shadow .15s ease; }
    .service-btn:hover { transform: translateY(-1px); }
</style>
@endsection

@section('content')

{{-- ═══ HERO — one job only ═══ --}}
<section class="pt-24 pb-14 px-5 bg-white">
    <div class="max-w-2xl mx-auto">

        <h1 class="text-3xl sm:text-5xl font-black text-slate-900 leading-tight mb-2">
            Need help right now?
        </h1>
        <p class="text-slate-500 text-base sm:text-lg mb-8">
            Find a verified local professional in minutes.
        </p>

        {{-- Search — dominant --}}
        <div class="relative">
        <div class="bg-slate-900 rounded-2xl p-1.5 mb-2 shadow-xl">
            <form action="{{ route('frontend.service.search') }}" method="GET"
                  class="flex flex-col sm:flex-row gap-1.5" id="searchForm">
                <div class="flex items-center gap-3 flex-1 bg-white rounded-xl px-4 py-4">
                    <i class="fa-solid fa-magnifying-glass text-slate-400 shrink-0"></i>
                    <input type="text" name="q" id="searchQ" autocomplete="off"
                           placeholder="What do you need? e.g. Plumber"
                           class="flex-1 text-base text-slate-900 placeholder-slate-400 bg-transparent w-full">
                </div>
                <div class="flex items-center gap-3 bg-white rounded-xl px-4 py-4 sm:w-40">
                    <i class="fa-solid fa-location-dot text-slate-400 shrink-0"></i>
                    <input type="text" name="city" id="searchCity"
                           placeholder="ZIP or City"
                           class="flex-1 text-base text-slate-900 placeholder-slate-400 bg-transparent w-full">
                </div>
                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-500 text-white font-black text-base px-8 py-4 rounded-xl transition shrink-0">
                    Find Now
                </button>
            </form>
        </div>

        {{-- Live search results --}}
        <div id="liveResults" class="hidden absolute left-0 right-0 bg-white border border-slate-200 rounded-2xl shadow-xl z-50 overflow-hidden">
            <div id="liveResultsList"></div>
            <a id="liveResultsMore" href="#"
               class="block text-center text-sm font-bold text-blue-600 py-3 border-t border-slate-100 hover:underline">
                See all results →
            </a>
        </div>
        </div>

        {{-- One-tap emergency buttons --}}
        <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-3">Common emergencies</p>
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-2">
            @foreach([
                ['q'=>'Plumber',      'icon'=>'fa-wrench',          'color'=>'blue'],
                ['q'=>'Electrician',  'icon'=>'fa-bolt',            'color'=>'amber'],
                ['q'=>'Locksmith',    'icon'=>'fa-key',             'color'=>'emerald'],
                ['q'=>'Handyman',     'icon'=>'fa-screwdriver-wrench', 'color'=>'orange'],
                ['q'=>'Tax Expert',   'icon'=>'fa-calculator',      'color'=>'blue'],
                ['q'=>'Lawyer',       'icon'=>'fa-scale-balanced',  'color'=>'purple'],
                ['q'=>'HVAC',         'icon'=>'fa-wind',            'color'=>'cyan'],
                ['q'=>'Cleaning',     'icon'=>'fa-broom',           'color'=>'slate'],
            ] as $s)
            <a href="{{ route('frontend.service.search') }}?q={{ urlencode($s['q']) }}"
               class="service-btn flex items-center gap-2.5 bg-slate-50 hover:bg-{{ $s['color'] }}-50 border border-slate-200 hover:border-{{ $s['color'] }}-300 px-4 py-3 rounded-xl transition">
                <i class="fa-solid {{ $s['icon'] }} text-{{ $s['color'] }}-600 text-sm shrink-0"></i>
                <span class="text-sm font-bold text-slate-700">{{ $s['q'] }}</span>
            </a>
            @endforeach
        </div>

    </div>
</section>

<div class="border-t border-slate-100 max-w-5xl mx-auto px-5"></div>

{{-- ═══ PROFESSIONALS LIST ═══ --}}
<section class="py-14 px-5 bg-white">
    <div class="max-w-2xl mx-auto">

        <div class="flex items-center justify-between mb-6">
            <h2 class="text-lg font-black text-slate-900">Available near you</h2>
            <span class="text-xs text-slate-400 font-semibold">Responds within 1 hour</span>
        </div>

        <div class="space-y-3">
            @forelse(($users ?? collect())->take(2) as $user)
            <div class="flex items-center gap-4 p-4 border border-slate-200 rounded-2xl hover:border-blue-300 hover:shadow-sm transition">
                @if($user->profile_photo)
                <img src="{{ asset($user->profile_photo) }}"
                     onerror="this.style.display='none';this.nextElementSibling.style.display='flex';"
                     class="w-12 h-12 rounded-2xl object-cover shrink-0">
                <div class="w-12 h-12 bg-blue-600 rounded-2xl hidden items-center justify-center text-white font-black text-base shrink-0">
                    {{ strtoupper(substr($user->name, 0, 2)) }}
                </div>
                @else
                <div class="w-12 h-12 bg-blue-600 rounded-2xl flex items-center justify-center text-white font-black text-base shrink-0">
                    {{ strtoupper(substr($user->name, 0, 2)) }}
                </div>
                @endif

                <div class="flex-1 min-w-0">
                    <div class="flex items-center gap-2 flex-wrap">
                        <p class="font-bold text-slate-900">{{ $user->name }}</p>
                        @if($user->status)
                        <span class="text-[10px] bg-emerald-100 text-emerald-700 font-bold px-2 py-0.5 rounded-md">Verified</span>
                        @endif
                    </div>
                    <p class="text-sm text-slate-500 mt-0.5">
                        {{ $user->title ?? $user->designation ?? 'Professional' }}
                        @if($user->city) · {{ $user->city }}@endif
                    </p>
                    <div class="flex items-center gap-1 mt-1">
                        <i class="fa-solid fa-star text-amber-400 text-[10px]"></i>
                        <span class="text-xs font-bold text-slate-700">4.9</span>
                        <span class="text-[10px] text-slate-400">({{ rand(12,180) }} reviews)</span>
                    </div>
                </div>

                <a href="{{ route('frontend.service.show', $user->slug ?? $user->id) }}"
                   class="shrink-0 bg-slate-900 hover:bg-blue-600 text-white text-xs font-bold px-4 py-2.5 rounded-xl transition">
                    Contact
                </a>
            </div>
            @empty
            <p class="text-center text-slate-400 py-10 text-sm">No professionals found yet.</p>
            @endforelse
        </div>

        <a href="{{ route('frontend.service.all') }}"
           class="mt-5 w-full block text-center text-sm font-bold text-blue-600 hover:underline py-3">
            See all professionals →
        </a>

    </div>
</section>

<div class="border-t border-slate-100 max-w-5xl mx-auto px-5"></div>

{{-- ═══ FOR PROS ═══ --}}
<section class="py-14 px-5 bg-slate-50">
    <div class="max-w-2xl mx-auto flex flex-col sm:flex-row items-center gap-8">
        <div class="flex-1">
            <p class="text-xs font-black text-slate-400 uppercase tracking-wider mb-3">For Professionals</p>
            <h2 class="text-2xl font-black text-slate-900 mb-3">
                Get qualified leads.<br>Pay only per call.
            </h2>
            <p class="text-slate-500 text-sm leading-relaxed mb-6">
                Customers in your area are searching right now. Your verified profile shows up first.
                No subscription. No ads. Just real leads.
            </p>
            <a href="{{ route('user.register', 'seller') }}"
               class="inline-flex items-center gap-2 bg-slate-900 hover:bg-slate-700 text-white font-bold px-6 py-3.5 rounded-xl text-sm transition">
                Create free profile →
            </a>
        </div>
        <div class="shrink-0 w-full sm:w-64 space-y-2">
            @foreach([
                'Free to join',
                'Pay per verified lead only',
                'Real-time call forwarding',
                'Avg. $2,400/month in leads',
            ] as $f)
            <div class="flex items-center gap-3 bg-white border border-slate-200 rounded-xl px-4 py-3.5">
                <i class="fa-solid fa-circle-check text-emerald-500 text-lg shrink-0"></i>
                <span class="text-sm font-semibold text-slate-700">{{ $f }}</span>
            </div>
            @endforeach
        </div>
    </div>
</section>

@section('scripts')
<script>
(function() {
    const allUsers = @json(($users ?? collect())->map(fn($u) => [
        'id'    => $u->id,
        'name'  => $u->name,
        'slug'  => $u->slug ?? $u->id,
        'title' => $u->title ?? $u->designation ?? null,
        'city'  => $u->city ?? null,
        'status'=> $u->status ?? false,
        'photo' => $u->profile_photo ?? null,
    ]));

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
                ${u.status ? '<span class="text-[10px] bg-emerald-100 text-emerald-700 font-bold px-2 py-0.5 rounded-md shrink-0">Verified</span>' : ''}
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
