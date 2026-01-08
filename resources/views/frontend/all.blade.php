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
    <main class="max-w-7xl mx-auto px-4 sm:px-6 grid grid-cols-1 lg:grid-cols-2 gap-6">

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
                            <!-- <p class="text-blue-600 text-xs font-bold uppercase mb-2">Corporate Law • Atlanta, GA</p>
                            <p class="text-slate-500 text-sm italic">
                                "Leading expert in corporate equity and high-scale business litigation."
                            </p> -->
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

        <!-- Duplicate cards below -->
        {{-- <div class="group bg-white rounded-3xl p-6 border hover:shadow-2xl transition">
            <div class="flex flex-col sm:flex-row gap-6">
                <div class="w-full sm:w-44 h-52 rounded-2xl overflow-hidden relative">
                    <img src="https://rajulaw.com/wp-content/uploads/2024/03/Junwoo-Bae-hb2.a.png"
                        class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition duration-700">
                    <span
                        class="absolute top-3 left-3 bg-white px-3 py-1 text-[10px] font-bold text-blue-600 rounded">TOP
                        PRO</span>
                </div>

                <div class="flex flex-col justify-between">
                    <div>
                        <h3 class="font-['Playfair_Display'] text-xl">Junwoo Bae, Esq. | Associate Attorney Washington, DC</h3>
                        <!-- <p class="text-blue-600 text-xs font-bold uppercase mb-2">Litigation Specialist • NY</p>
                        <p class="text-slate-500 text-sm italic">
                            "Over 15 years of experience in complex legal disputes."
                        </p> -->
                    </div>

                    <div class="mt-5 flex gap-4">
                        <button
                            class="bg-slate-900 text-white px-5 py-2 rounded-xl text-xs font-bold hover:scale-105 transition">
                            Hire Expert
                        </button>
                        <button class="text-xs font-bold text-slate-400 hover:text-slate-900">
                            View Details →
                        </button>
                    </div>
                </div>
            </div>
        </div> --}}
        <!-- CARD -->
        {{-- <div class="group bg-white rounded-3xl p-6 border hover:shadow-2xl transition">
            <div class="flex flex-col sm:flex-row gap-6">
                <div class="w-full sm:w-44 h-52 rounded-2xl overflow-hidden relative">
                    <img src="https://rajulaw.com/wp-content/uploads/2018/01/Akudo-Amadi.png"
                        class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition duration-700">
                    <span
                        class="absolute top-3 left-3 bg-white px-3 py-1 text-[10px] font-bold text-blue-600 rounded">VERIFIED</span>
                </div>

                <div class="flex flex-col justify-between">
                    <div>
                        <h3 class="font-['Playfair_Display'] text-xl">Akudo Amadi, Esq. Associate Attorney US</h3>
                        <!-- <p class="text-blue-600 text-xs font-bold uppercase mb-2">Corporate Law • Atlanta, GA</p>
                        <p class="text-slate-500 text-sm italic">
                            "Leading expert in corporate equity and high-scale business litigation."
                        </p> -->
                    </div>

                    <div class="mt-5 flex gap-4">
                        <button
                            class="bg-slate-900 text-white px-5 py-2 rounded-xl text-xs font-bold hover:scale-105 transition">
                            Hire Expert
                        </button>
                        <button class="text-xs font-bold text-slate-400 hover:text-slate-900">
                            View Details →
                        </button>
                    </div>
                </div>
            </div>
        </div> --}}

        <!-- Duplicate cards below -->
        {{-- <div class="group bg-white rounded-3xl p-6 border hover:shadow-2xl transition">
            <div class="flex flex-col sm:flex-row gap-6">
                <div class="w-full sm:w-44 h-52 rounded-2xl overflow-hidden relative">
                    <img src="https://ktslaw.com/-/media/Feature/Bio/G/GanzJoshuaS.png"
                        class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition duration-700">
                    <span
                        class="absolute top-3 left-3 bg-white px-3 py-1 text-[10px] font-bold text-blue-600 rounded">TOP
                        PRO</span>
                </div>

                <div class="flex flex-col justify-between">
                    <div>
                        <h3 class="font-['Playfair_Display'] text-xl">Joshua Josh Ganz | Kilpatrick Townsend Lawyer Atlanta, GA</h3>
                        <!-- <p class="text-blue-600 text-xs font-bold uppercase mb-2">Litigation Specialist • NY</p>
                        <p class="text-slate-500 text-sm italic">
                            "Over 15 years of experience in complex legal disputes."
                        </p> -->
                    </div>

                    <div class="mt-5 flex gap-4">
                        <button
                            class="bg-slate-900 text-white px-5 py-2 rounded-xl text-xs font-bold hover:scale-105 transition">
                            Hire Expert
                        </button>
                        <button class="text-xs font-bold text-slate-400 hover:text-slate-900">
                            View Details →
                        </button>
                    </div>
                </div>
            </div>
        </div> --}}

    </main>
@endsection

