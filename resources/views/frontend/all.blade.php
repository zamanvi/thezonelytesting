@php
    $meta_title = $meta_title;
    $meta_description = $meta_description;
    $meta_keywords = $meta_keywords;
@endphp
@extends('frontend.layouts._app')
@section('title', 'Home')
@section('content')
<!-- HEADER -->
    <header class="mt-20 max-w-7xl mx-auto px-4 sm:px-6 pt-10 pb-10">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
            <div>
                <h1 class="font-['Playfair_Display'] text-3xl sm:text-4xl md:text-5xl mb-2">
                    Top Professionals
                </h1>
                <p class="text-slate-500 text-sm sm:text-base italic">
                    Showing verified “near me” experts in <span class="text-blue-600 font-bold">Atlanta, GA</span>
                </p>
            </div>

            @if ($isSearch)
                <div class="flex gap-2 overflow-x-auto no-scrollbar bg-white md:bg-transparent p-1 rounded-xl">
                    <button class="px-5 py-2 bg-slate-900 text-white rounded-xl text-xs font-bold">All</button>
                    <button class="px-5 py-2 rounded-xl text-slate-500 hover:bg-slate-100 text-xs font-bold">Lawyers</button>
                    <button class="px-5 py-2 rounded-xl text-slate-500 hover:bg-slate-100 text-xs font-bold">Designers</button>
                </div>
            @endif
        </div>
    </header>

    <!-- LIST -->
    <main class="max-w-7xl mx-auto px-2 sm:px-4 grid grid-cols-1 lg:grid-cols-2 gap-6">

        <!-- CARD -->
        @foreach ($users as $user)
            <div class="group bg-white rounded-3xl p-6 border hover:shadow-2xl transition">
                <div class="flex flex-col sm:flex-row gap-6">
                    <div class="w-full sm:w-44 h-52 rounded-2xl overflow-hidden relative">
                        <img src="{{ $user->profile_photo }}"
                            class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition duration-700">
                        <span
                            class="absolute top-3 left-3 bg-white px-3 py-1 text-[10px] font-bold text-blue-600 rounded">VERIFIED</span>
                    </div>

                    <div class="flex flex-col justify-between">
                        <div>
                            <h4 class="font-['Playfair_Display'] text-xl">{{ $user->title }}</h4>
                        </div>

                        <div class="mt-5 flex gap-4">
                            <button
                                class="bg-slate-900 text-white px-5 py-2 rounded-xl text-xs font-bold hover:scale-105 transition">
                                Hire Expert
                            </button>
                            <a href="{{ route('frontend.attorney.show', $user->slug) }}" class="text-xs font-bold text-slate-400 hover:text-slate-900">
                                View Details →
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </main>
    @if ($users->hasPages())
        <div class="mt-14 flex justify-center">
            <nav class="flex items-center gap-2">

                {{-- Previous --}}
                @if ($users->onFirstPage())
                    <span class="px-4 py-2 text-sm rounded-xl bg-gray-100 text-gray-400 cursor-not-allowed">
                        ← Prev
                    </span>
                @else
                    <a href="{{ $users->previousPageUrl() }}"
                    class="px-4 py-2 text-sm rounded-xl bg-white border hover:bg-slate-900 hover:text-white transition">
                        ← Prev
                    </a>
                @endif

                {{-- Pages --}}
                @foreach ($users->getUrlRange(1, $users->lastPage()) as $page => $url)
                    @if ($page == $users->currentPage())
                        <span class="px-4 py-2 text-sm rounded-xl bg-slate-900 text-white font-bold">
                            {{ $page }}
                        </span>
                    @else
                        <a href="{{ $url }}"
                        class="px-4 py-2 text-sm rounded-xl bg-white border hover:bg-slate-900 hover:text-white transition">
                            {{ $page }}
                        </a>
                    @endif
                @endforeach

                {{-- Next --}}
                @if ($users->hasMorePages())
                    <a href="{{ $users->nextPageUrl() }}"
                    class="px-4 py-2 text-sm rounded-xl bg-white border hover:bg-slate-900 hover:text-white transition">
                        Next →
                    </a>
                @else
                    <span class="px-4 py-2 text-sm rounded-xl bg-gray-100 text-gray-400 cursor-not-allowed">
                        Next →
                    </span>
                @endif

            </nav>
        </div>
    @endif

@endsection

