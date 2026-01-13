@extends('frontend.layouts._app')
@section('title', 'Zonely')
@php
    $meta_title = $meta_title;
    $meta_description = $meta_description;
    $meta_keywords = $meta_keywords;
@endphp
@section('content')
    <main class="mt-20 max-w-7xl mx-auto px-6 pb-10">

        <header class="pt-14 pb-24">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-8 border-b border-slate-100 pb-12">
                <div class="max-w-2xl">
                    <span
                        class="text-blue-600 text-[11px] font-black uppercase tracking-[0.3em] mb-4 block">Neighborhood
                        Pulse</span>
                    <h1 class="font-serif text-5xl md:text-7xl leadingtight">Local <span
                            class="italic text-slate400">Trends</span> & Expert Guides.</h1>
                </div>
                <div class="flex flex-wrap gap-3 mb-2">
                    <span class="text-xs font-bold text-slate-400 mr-2 self-center">Browse by:</span>
                    <button class="px-5 py-2 rounded-full border border-slate-200 text-xs font-bold hover:bg-blue-600 hover:text-white transition">City
                        Guides</button>
                    <button class="px-5 py-2 rounded-full border border-slate-200 text-xs font-bold hover:bg-blue-600 hover:text-white transition">State
                        Laws</button>
                    <button class="px-5 py-2 rounded-full border border-slate-200 text-xs font-bold hover:bg-blue-600 hover:text-white transition">Market
                        News</button>
                </div>
            </div>
        </header>
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">

            <article class="lg:col-span-8 group cursor-pointer blog-card">
                <div class="rounded-[3rem] overflow-hidden aspect-[16/9] mb-8 bg-slate-100 relative">
                    <img src="{{ get_file($featuredBlog->image_path) }}"
                        class="w-full h-full object-cover group-hover:scale-105 transition duration-700"
                        alt="Cityscape">
                    <div class="absolute bottom-8 left-8 bg-white/90 backdrop-blur px-6 py-3 rounded-2xl shadow-xl">
                        <p class="text-[10px] font-black text-blue-600 uppercase tracking-widest">Top Rated Guide</p>
                    </div>
                </div>
                <div class="px-4">
                    <div
                        class="flex items-center gap-4 text-slate-400 text-[11px] font-bold uppercase tracking-widest mb-4">
                        <span>{{ $featuredBlog->created_at->format('M Y') }}</span>
                        <span class="w-1 h-1 bg-slate-300 roundedfull"></span>
                    </div>
                    <h2 class="font-serif text-4xl mb-4 group-hover:text-blue-600 transition">{{ $featuredBlog->name }}</h2>
                    <p class="text-slate-500 text-lg leading-relaxed max-w-2xl">
                        {{ $featuredBlog->short_description }}
                    </p>
                    
                    <p class="text-slate-500 text-lg leading-relaxed max-w-2xl">
                        {!! $featuredBlog->description !!}
                    </p>

                </div>
            </article>
            <div class="lg:col-span-4 space-y-6">
                <h4 class="text-xs font-black uppercase tracking-[0.2em] text-slate-400 border-b border-slate-100 pb4">
                    Nearby Resources</h4>

                @foreach ($blogs as $blog)
                    <article class="group cursor-pointer flex gap-5 itemsstart">
                        <div class="w-24 h-24 shrink-0 rounded-2xl overflow-hidden bg-slate-100">
                            <img src="{{ get_file($blog->image_path) }}"
                                class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition duration-500">
                        </div>
                            
                        <div>
                            <a href="{{ route('blog.show', $blog->slug) }}"><h3 class="font-serif text-lg leading-snug group-hover:text-blue-600 transition">{{ $blog->name }}</h3></a>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
        <section
            class="mt-16 bg-blue-600 rounded-[3rem] p-12 md:p-14 flex flex-col md:flex-row items-center justify-between gap-10">
            <div class="max-w-xl text-white">
                <h2 class="font-serif text-4xl md:text-5xl mb-6 leading-tight text-white">Find a trusted <span
                        class="italic text-blue-200">Local Expert</span>
                    today.</h2>
                <p class="text-blue-100 opacity-80">Stop
                    searching globally for local problems. Connect with
                    verified professionals in your zip code.</p>
            </div>
            <div class="shrink-0">
                <a href="{{ route('frontend.home') }}" class="bg-white text-blue-400 px-5 py-2 rounded-2xl font-black hover:shadow-2xl transition-all transform hover:-translate-y-1">Search Experts Near Me</a>
            </div>
        </section>
    </main> 
@endsection