@php
    $meta_title = $meta_title;
    $meta_description = $meta_description;
    $meta_keywords = $meta_keywords;
@endphp
@extends('frontend.layouts._app')
@section('title', 'Home')
@section('content')
    <header class="mt-20 max-w-5xl mx-auto pt-14 pb-14 px-4 text-center">
        <h1 class="font-['Playfair_Display'] text-4xl sm:text-6xl md:text-7xl leading-tight mb-6">
            Discover & Hire <br class="hidden sm:block" />
            <span class="text-blue-600 italic font-normal">Local Experts</span> Near Me
        </h1>

        <p class="text-slate-500 text-base sm:text-lg max-w-xl mx-auto mb-10">
            Access the top 1% of verified professionals in your area. Fast, secure, and expert-led.
        </p>

        <div class="relative max-w-2xl mx-auto bg-white rounded-full shadow-xl p-2 flex flex-col sm:flex-row gap-2">
            <form action="{{ route('frontend.attorney.search') }}" method="GET" class="flex flex-1">
                <input type="text" name="q" placeholder="Who are you looking for?"
                    class="flex-1 px-5 py-4 rounded-full border outline-none focus:border-blue-500 text-sm sm:text-lg" />
                <button class="bg-blue-600 text-white px-8 py-4 rounded-full font-bold hover:bg-blue-700 transition">
                        Search
                </button>
            </form>
        </div>
    </header>
    <main class="max-w-7xl mx-auto px-4 pb-10">

        <div class="flex justify-between items-center mb-10 border-b pb-4">
            <h2 class="text-xs sm:text-sm font-black tracking-widest text-slate-400 uppercase">
                Featured Experts Nearby
            </h2>

            <div class="flex gap-2">
                <a href="{{ route('frontend.attorney.all') }}" class="px-4 py-2 rounded-full border hover:bg-slate-100">See All</a>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

            @foreach ($users as $user)
                <!-- Card 1 -->
                <div class="group bg-white rounded-3xl p-6 border hover:shadow-2xl transition">
                    <div class="flex flex-col sm:flex-row gap-6">
                        <div class="w-full sm:w-44 h-52 rounded-2xl overflow-hidden relative">
                            <img src="{{ $user->profile_photo }}"
                                class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition duration-700" />
                            <span
                                class="absolute top-3 left-3 bg-white px-2 py-1 text-[10px] font-bold text-blue-600 rounded">
                                {{ $user->status ? 'VERIFIED' : 'UNVERIFIED' }}
                            </span>
                        </div>

                        <div class="flex flex-col justify-between">
                            <div>
                                <h3 class="font-['Playfair_Display'] text-2xl mb-1">
                                    {{ $user->name }}
                                </h3>
                            </div>

                            <div class="mt-5 flex gap-4">
                                <button
                                    class="bg-slate-900 text-white px-5 py-2 rounded-xl text-xs font-bold hover:scale-105 transition">
                                    Hire Expert
                                </button>
                                <a href="{{ route('frontend.attorney.show', $user->slug) }}" class="text-xs font-bold text-slate-400 hover:text-slate-900">
                                    View Portfolio
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </main>
@endsection

