@php
    $meta_title       = $meta_title ?? 'All Professionals';
    $meta_description = $meta_description ?? '';
    $meta_keywords    = $meta_keywords ?? '';
@endphp
@extends('frontend.layouts._app')
@section('title', 'All Professionals')
@section('content')

{{-- ── Header ───────────────────────────────────────── --}}
<header class="mt-16 sm:mt-20 max-w-7xl mx-auto px-4 sm:px-6 pt-8 sm:pt-10 pb-6 sm:pb-8">
    <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4">
        <div>
            <h1 class="font-['Playfair_Display'] text-2xl sm:text-3xl md:text-4xl lg:text-5xl text-slate-900 mb-1">
                Top Professionals
            </h1>
            <p class="text-slate-500 text-sm sm:text-base italic">
                Showing verified experts
                @if(isset($city)) in <span class="text-blue-600 font-bold">{{ $city }}</span>@endif
            </p>
        </div>

        {{-- Search bar --}}
        <form action="{{ route('frontend.service.search') }}" method="GET"
              class="flex flex-col sm:flex-row gap-2 w-full sm:w-auto">
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Service..."
                class="px-4 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-blue-400 focus:ring-2 focus:ring-blue-50 sm:w-36">
            <input type="text" name="city" value="{{ request('city') }}" placeholder="City or ZIP"
                class="px-4 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-blue-400 focus:ring-2 focus:ring-blue-50 sm:w-32">
            <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2.5 rounded-xl text-sm font-bold transition shrink-0">
                <i class="fa-solid fa-magnifying-glass"></i>
            </button>
        </form>
    </div>

    {{-- Filter pills --}}
    @if($isSearch ?? false)
    <div class="flex gap-2 mt-4 overflow-x-auto scroll-hide pb-1">
        <button class="shrink-0 px-4 py-2 bg-slate-900 text-white rounded-xl text-xs font-bold">All</button>
        <button class="shrink-0 px-4 py-2 rounded-xl text-slate-500 hover:bg-slate-100 border border-slate-200 text-xs font-semibold transition">Lawyers</button>
        <button class="shrink-0 px-4 py-2 rounded-xl text-slate-500 hover:bg-slate-100 border border-slate-200 text-xs font-semibold transition">Designers</button>
        <button class="shrink-0 px-4 py-2 rounded-xl text-slate-500 hover:bg-slate-100 border border-slate-200 text-xs font-semibold transition">Tax Experts</button>
        <button class="shrink-0 px-4 py-2 rounded-xl text-slate-500 hover:bg-slate-100 border border-slate-200 text-xs font-semibold transition">Plumbers</button>
    </div>
    @endif
</header>

{{-- ── Grid ─────────────────────────────────────────── --}}
<main class="max-w-7xl mx-auto px-4 sm:px-6 pb-12">

    @if($users->count())
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 xl:grid-cols-3 gap-4 sm:gap-6">
        @foreach($users as $user)
        <div class="group bg-white rounded-3xl p-5 sm:p-6 border border-slate-100 hover:shadow-xl hover:border-blue-100 transition-all duration-300">
            <div class="flex gap-4">

                {{-- Photo --}}
                <div class="w-20 h-24 sm:w-24 sm:h-28 rounded-2xl overflow-hidden relative shrink-0">
                    <img src="{{ $user->profile_photo }}"
                         onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&size=120&background=3b82f6&color=fff'"
                         class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition duration-500"
                         alt="{{ $user->name }}" loading="lazy">
                    <span class="absolute top-2 left-2 bg-white/90 backdrop-blur-sm px-1.5 py-0.5 text-[9px] font-bold {{ $user->status ? 'text-blue-600' : 'text-slate-400' }} rounded-lg leading-none">
                        {{ $user->status ? 'VERIFIED' : 'UNVERIFIED' }}
                    </span>
                </div>

                {{-- Info --}}
                <div class="flex-1 min-w-0 flex flex-col justify-between">
                    <div>
                        <h3 class="font-['Playfair_Display'] text-lg sm:text-xl text-slate-900 leading-snug truncate">
                            {{ $user->name }}
                        </h3>
                        @if($user->title ?? $user->designation ?? false)
                        <p class="text-xs text-slate-500 mt-0.5 line-clamp-2 leading-snug">
                            {{ $user->title ?? $user->designation }}
                        </p>
                        @endif
                        @if($user->city ?? false)
                        <p class="text-xs text-slate-400 mt-1.5 flex items-center gap-1">
                            <i class="fa-solid fa-location-dot text-[10px]"></i> {{ $user->city }}
                        </p>
                        @endif
                    </div>
                    <div class="flex items-center gap-2 mt-3">
                        <a href="{{ route('frontend.service.show', $user->slug ?? $user->id) }}"
                           class="flex-1 bg-slate-900 hover:bg-blue-600 active:scale-95 text-white px-3 py-2 rounded-xl text-xs font-bold transition text-center"
                           style="min-height:unset;">
                            View Profile
                        </a>
                        @auth
                        @if(auth()->user()->type === 'user')
                        <a href="{{ route('buyer.book', $user->slug ?? $user->id) ?? '#' }}"
                           class="bg-blue-50 hover:bg-blue-100 text-blue-600 px-3 py-2 rounded-xl text-xs font-bold transition"
                           style="min-height:unset;" title="Book">
                            <i class="fa-solid fa-calendar-plus"></i>
                        </a>
                        @endif
                        @endauth
                    </div>
                </div>

            </div>
        </div>
        @endforeach
    </div>
    @else
    <div class="text-center py-20">
        <i class="fa-solid fa-user-slash text-5xl text-slate-200 mb-4"></i>
        <p class="font-bold text-slate-400 text-lg">No professionals found</p>
        <p class="text-slate-400 text-sm mt-1">Try a different search term</p>
        <a href="{{ route('frontend.service.all') }}"
           class="inline-block mt-5 bg-blue-600 text-white font-bold px-6 py-3 rounded-2xl text-sm hover:bg-blue-700 transition"
           style="min-height:unset;">
            Browse All
        </a>
    </div>
    @endif

    {{-- Pagination --}}
    @if($users->hasPages())
    <div class="mt-10 sm:mt-14">
        <nav class="flex flex-wrap items-center justify-center gap-2">

            @if($users->onFirstPage())
            <span class="px-4 py-2.5 text-sm rounded-xl bg-slate-100 text-slate-400 cursor-not-allowed font-semibold">← Prev</span>
            @else
            <a href="{{ $users->previousPageUrl() }}"
               class="px-4 py-2.5 text-sm rounded-xl bg-white border border-slate-200 hover:bg-slate-900 hover:text-white hover:border-slate-900 font-semibold transition"
               style="min-height:unset;">← Prev</a>
            @endif

            @foreach($users->getUrlRange(max(1, $users->currentPage()-2), min($users->lastPage(), $users->currentPage()+2)) as $page => $url)
            @if($page == $users->currentPage())
            <span class="px-4 py-2.5 text-sm rounded-xl bg-slate-900 text-white font-bold">{{ $page }}</span>
            @else
            <a href="{{ $url }}"
               class="px-4 py-2.5 text-sm rounded-xl bg-white border border-slate-200 hover:bg-slate-900 hover:text-white hover:border-slate-900 font-semibold transition"
               style="min-height:unset;">{{ $page }}</a>
            @endif
            @endforeach

            @if($users->hasMorePages())
            <a href="{{ $users->nextPageUrl() }}"
               class="px-4 py-2.5 text-sm rounded-xl bg-white border border-slate-200 hover:bg-slate-900 hover:text-white hover:border-slate-900 font-semibold transition"
               style="min-height:unset;">Next →</a>
            @else
            <span class="px-4 py-2.5 text-sm rounded-xl bg-slate-100 text-slate-400 cursor-not-allowed font-semibold">Next →</span>
            @endif

        </nav>
        <p class="text-center text-xs text-slate-400 mt-3">
            Showing {{ $users->firstItem() }}–{{ $users->lastItem() }} of {{ $users->total() }} professionals
        </p>
    </div>
    @endif

</main>
@endsection
