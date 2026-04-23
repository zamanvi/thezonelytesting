@php
    $meta_title       = 'Blog – Local Trends & Expert Guides | Zonely';
    $meta_description = 'Tips, guides, and news for finding and hiring the best local professionals near you.';
    $meta_keywords    = $meta_keywords ?? '';
@endphp
@extends('frontend.layouts._app')
@section('title', 'Blog')

@section('schema')
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Blog",
  "name": "Zonely Blog",
  "url": "{{ route('frontend.blog') }}",
  "publisher": { "@type": "Organization", "name": "Zonely", "logo": { "@type": "ImageObject", "url": "{{ asset('frontend/img/zonely_logo.jpeg') }}" } }
}
</script>
@endsection

@section('content')
<main class="mt-16 sm:mt-20 max-w-7xl mx-auto px-4 sm:px-6 pb-12">

    {{-- Header --}}
    <header class="pt-10 pb-10 sm:pt-14 sm:pb-14">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 border-b border-slate-100 pb-8 sm:pb-12">
            <div class="max-w-2xl">
                <span class="text-blue-600 text-[11px] font-black uppercase tracking-widest mb-3 block">Neighborhood Pulse</span>
                <h1 class="font-serif text-3xl sm:text-5xl md:text-6xl leading-tight text-slate-900">
                    Local <span class="italic text-slate-400">Trends</span> &amp; Expert Guides.
                </h1>
            </div>
            <div class="flex flex-wrap gap-2">
                <span class="text-xs font-bold text-slate-400 self-center mr-1">Browse by:</span>
                <button class="px-4 py-2 rounded-full border border-slate-200 text-xs font-bold hover:bg-blue-600 hover:text-white transition">City Guides</button>
                <button class="px-4 py-2 rounded-full border border-slate-200 text-xs font-bold hover:bg-blue-600 hover:text-white transition">State Laws</button>
                <button class="px-4 py-2 rounded-full border border-slate-200 text-xs font-bold hover:bg-blue-600 hover:text-white transition">Market News</button>
            </div>
        </div>
    </header>

    {{-- Featured + sidebar --}}
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 mb-14">

        {{-- Featured --}}
        @if(isset($featuredBlog))
        <article class="lg:col-span-8 group cursor-pointer">
            <a href="{{ route('frontend.blog') }}/{{ $featuredBlog->slug ?? '' }}" class="block" style="min-height:unset;">
                <div class="rounded-3xl overflow-hidden aspect-video mb-6 bg-slate-100 relative">
                    <img src="{{ asset($featuredBlog->image_path ?? '') }}"
                         onerror="this.style.display='none'"
                         class="w-full h-full object-cover group-hover:scale-105 transition duration-700"
                         alt="{{ $featuredBlog->name }}" loading="eager">
                    <div class="absolute bottom-5 left-5 bg-white/90 backdrop-blur px-4 py-2 rounded-xl shadow-lg">
                        <p class="text-[10px] font-black text-blue-600 uppercase tracking-widest">Top Rated Guide</p>
                    </div>
                </div>
                <div class="text-[11px] font-bold text-slate-400 uppercase tracking-widest mb-3">
                    {{ $featuredBlog->created_at?->format('M Y') }}
                </div>
                <h2 class="font-serif text-2xl sm:text-3xl md:text-4xl mb-3 group-hover:text-blue-600 transition leading-snug">
                    {{ $featuredBlog->name }}
                </h2>
                <p class="text-slate-500 text-sm sm:text-base leading-relaxed line-clamp-3">
                    {{ $featuredBlog->short_description ?? Str::limit(strip_tags($featuredBlog->description ?? ''), 200) }}
                </p>
            </a>
        </article>
        @endif

        {{-- Sidebar list --}}
        <div class="lg:col-span-4 space-y-5">
            <h4 class="text-xs font-black uppercase tracking-widest text-slate-400 border-b border-slate-100 pb-3">More Articles</h4>
            @foreach($blogs as $blog)
            <article class="group flex gap-4 items-start">
                <div class="w-20 h-20 shrink-0 rounded-2xl overflow-hidden bg-slate-100">
                    <img src="{{ asset($blog->image_path ?? '') }}"
                         onerror="this.style.display='none'"
                         class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition duration-500"
                         alt="{{ $blog->name }}" loading="lazy">
                </div>
                <div class="min-w-0">
                    <a href="{{ route('frontend.blog') }}/{{ $blog->slug ?? '' }}"
                       class="font-serif text-base leading-snug group-hover:text-blue-600 transition line-clamp-3 block"
                       style="min-height:unset;">
                        {{ $blog->name }}
                    </a>
                    @if($blog->created_at ?? false)
                    <p class="text-[10px] text-slate-400 mt-1">{{ $blog->created_at->format('M d, Y') }}</p>
                    @endif
                </div>
            </article>
            @endforeach
        </div>
    </div>

    {{-- CTA --}}
    <section class="bg-blue-600 rounded-3xl p-8 sm:p-12 md:p-14 flex flex-col md:flex-row items-center justify-between gap-8">
        <div class="max-w-xl text-white text-center md:text-left">
            <h2 class="font-serif text-2xl sm:text-3xl md:text-4xl mb-3 leading-tight">
                Find a trusted <span class="italic text-blue-200">Local Expert</span> today.
            </h2>
            <p class="text-blue-100 text-sm sm:text-base opacity-90">
                Stop searching globally for local problems. Connect with verified professionals in your zip code.
            </p>
        </div>
        <a href="{{ route('frontend.home') }}"
           class="shrink-0 bg-white text-blue-700 font-black px-6 py-3.5 rounded-2xl hover:shadow-2xl hover:-translate-y-1 transition-all text-sm whitespace-nowrap"
           style="min-height:unset;">
            Search Experts Near Me →
        </a>
    </section>

</main>
@endsection
