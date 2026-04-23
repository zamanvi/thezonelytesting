@php
    $meta_title       = $user->name . ' - ' . $user->designation;
    $meta_description = $user->name . ' - ' . $user->designation . ' - ' . ($user->about ?? '');
@endphp
@extends('frontend.layouts._app')
@section('title', $meta_title)
@section('og_title',       $user->title)
@section('og_description', Str::limit(strip_tags($user->bio ?? ''), 200))
@section('og_image',       $user->profile_photo)

@section('schema')
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "LocalBusiness",
  "name": "{{ $user->name }}",
  "description": "{{ Str::limit(strip_tags($user->about ?? $user->bio ?? ''), 200) }}",
  "url": "{{ url()->current() }}",
  "image": "{{ $user->profile_photo }}",
  "@id": "{{ url()->current() }}",
  "priceRange": "Contact for pricing",
  "address": {
    "@type": "PostalAddress",
    "addressLocality": "{{ $user->city ?? '' }}",
    "addressRegion": "{{ $user->state ?? '' }}",
    "addressCountry": "US"
  }
  @if($user->contacts->where('type','phone')->first()),
  "telephone": "{{ $user->contacts->where('type','phone')->first()->value ?? '' }}"
  @endif
  @if($user->contacts->where('type','email')->first()),
  "email": "{{ $user->contacts->where('type','email')->first()->value ?? '' }}"
  @endif
}
</script>
@endsection

@section('content')
<main class="max-w-7xl mx-auto px-4 sm:px-6 pt-28 sm:pt-32 pb-12">

    {{-- ── Hero ────────────────────────────────────── --}}
    <div class="mb-10 sm:mb-14">
        <div class="flex flex-col sm:flex-row gap-8 sm:gap-12 items-start sm:items-end">

            {{-- Photo --}}
            <div class="relative group shrink-0 mx-auto sm:mx-0">
                <div class="absolute -inset-1 bg-gradient-to-r from-blue-600 to-violet-600 rounded-[2.5rem] blur opacity-25 group-hover:opacity-50 transition duration-1000"></div>
                <div class="relative w-56 h-72 sm:w-64 sm:h-80 md:w-72 md:h-[380px] rounded-[2.2rem] overflow-hidden border-4 border-white shadow-2xl">
                    <img src="{{ $user->profile_photo }}" class="w-full h-full object-cover" alt="{{ $user->name }}">
                </div>
            </div>

            {{-- Info --}}
            <div class="flex-1 text-center sm:text-left pb-4">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-50 text-blue-600 text-[10px] font-bold uppercase tracking-widest mb-4">
                    <span class="relative flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-blue-600"></span>
                    </span>
                    Verified Professional
                </div>

                <h1 class="font-serif text-2xl sm:text-3xl md:text-5xl text-slate-900 mb-4 leading-tight">
                    {{ $user->title ?? $user->name }}
                </h1>

                <blockquote class="border-l-4 border-blue-600 pl-4 sm:pl-6 italic text-slate-700 font-medium bg-slate-50 py-3 sm:py-4 rounded-r-2xl text-sm sm:text-base">
                    "{{ $user->bio ?? 'Dedicated professional committed to excellence.' }}"
                </blockquote>

                @if(!empty($user->tags))
                @php $tags = array_filter(array_map('trim', explode(',', $user->tags))); @endphp
                @if(count($tags))
                <div class="mt-6">
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-3">Services Offered</p>
                    <div class="flex flex-wrap justify-center sm:justify-start gap-2">
                        @foreach($tags as $tag)
                        <span class="px-3 py-1.5 rounded-full border border-slate-200 text-xs text-slate-700 bg-white hover:bg-blue-50 hover:border-blue-200 hover:text-blue-700 transition cursor-default">
                            {{ ucfirst($tag) }}
                        </span>
                        @endforeach
                    </div>
                </div>
                @endif
                @endif
            </div>
        </div>
    </div>

    {{-- ── Main grid: content left, sidebar right ── --}}
    {{-- On mobile: stacked. Sidebar-contact shown first on mobile via order utilities --}}
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12">

        {{-- ── Sidebar — ORDER-FIRST on mobile ──── --}}
        <div class="lg:col-span-4 order-first lg:order-last lg:sticky lg:top-28 h-fit space-y-5">

            {{-- Contact card --}}
            <div class="bg-white rounded-3xl border border-slate-200 p-6 sm:p-8 shadow-xl shadow-blue-500/5 relative overflow-hidden">
                <div class="absolute top-0 left-0 w-full h-1.5 animate-gradient rounded-t-3xl"></div>

                <h3 class="text-lg sm:text-xl font-bold text-slate-900 mb-1">Work with {{ $user->name }}</h3>
                <p class="text-slate-500 text-sm mb-6">Get in touch directly below.</p>

                <div class="space-y-3">
                    @forelse($user->contacts as $contact)
                    @php
                        $icon  = match($contact->type) { 'email'=>'fas fa-envelope','phone'=>'fas fa-phone','address'=>'fas fa-map-marker-alt','whatsapp'=>'fab fa-whatsapp',default=>'fas fa-info-circle' };
                        $href  = match($contact->type) { 'email'=>'mailto:'.$contact->value,'phone'=>'tel:'.$contact->value,'whatsapp'=>'https://wa.me/'.preg_replace('/[^0-9]/','', $contact->value),default=>'#' };
                        $color = match($contact->type) { 'whatsapp'=>'bg-emerald-500 hover:bg-emerald-600','phone'=>'bg-blue-600 hover:bg-blue-700',default=>'bg-slate-800 hover:bg-slate-700' };
                    @endphp
                    <a href="{{ $href }}"
                       class="flex items-center gap-3 w-full {{ $color }} text-white font-bold py-3.5 px-5 rounded-2xl transition text-sm">
                        <i class="{{ $icon }} w-4 text-center"></i>
                        <span class="truncate">{{ $contact->value }}</span>
                    </a>
                    @empty
                    <p class="text-sm text-slate-400 text-center py-2">No contact info available.</p>
                    @endforelse
                </div>

                @auth
                @if(auth()->user()->type === 'user')
                <a href="{{ route('buyer.book', $user->slug ?? $user->id) ?? '#' }}"
                   class="mt-4 flex items-center justify-center gap-2 w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3.5 rounded-2xl transition text-sm">
                    <i class="fa-solid fa-calendar-plus"></i> Book Appointment
                </a>
                @endif
                @else
                <a href="{{ route('user.login') }}"
                   class="mt-4 flex items-center justify-center gap-2 w-full border-2 border-blue-600 text-blue-600 hover:bg-blue-50 font-bold py-3.5 rounded-2xl transition text-sm">
                    <i class="fa-solid fa-calendar-plus"></i> Book Appointment
                </a>
                @endauth

                <p class="mt-5 text-[10px] text-center text-slate-400 uppercase tracking-widest">Secured by Zonely</p>
            </div>

            {{-- Languages --}}
            @if($user->languages->count())
            <div class="bg-slate-900 p-6 sm:p-8 rounded-3xl text-white">
                <h3 class="text-xs font-bold uppercase tracking-widest text-blue-400 mb-4">Languages</h3>
                <div class="space-y-2">
                    @foreach($user->languages as $lang)
                    <div class="flex items-center gap-3 p-2.5 rounded-xl bg-white/5 border border-white/10">
                        <div class="w-2 h-2 rounded-full bg-emerald-400 shrink-0"></div>
                        <span class="text-sm font-semibold">{{ $lang->name }}</span>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>

        {{-- ── Main content ──────────────────────── --}}
        <div class="lg:col-span-8 space-y-8 order-last lg:order-first">

            {{-- Stats strip --}}
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
                <div class="bento-card bg-white p-5 rounded-3xl border border-slate-100 text-center">
                    <p class="text-[10px] font-bold text-slate-400 uppercase mb-1">Experience</p>
                    <p class="text-xl sm:text-2xl font-black text-slate-900">{{ $user->experience ?? '5+' }} Yrs</p>
                </div>
                <div class="bento-card bg-blue-600 p-5 rounded-3xl text-center">
                    <p class="text-[10px] font-bold text-blue-200 uppercase mb-1">Success Rate</p>
                    <p class="text-xl sm:text-2xl font-black text-white">98%</p>
                </div>
                <div class="bento-card bg-white p-5 rounded-3xl border border-slate-100 text-center">
                    <p class="text-[10px] font-bold text-slate-400 uppercase mb-1">Cases Won</p>
                    <p class="text-xl sm:text-2xl font-black text-slate-900">450+</p>
                </div>
                <div class="bento-card bg-slate-800 p-5 rounded-3xl text-center">
                    <p class="text-[10px] font-bold text-slate-400 uppercase mb-1">Response</p>
                    <p class="text-xl sm:text-2xl font-black text-white">&lt;2h</p>
                </div>
            </div>

            {{-- About --}}
            <section class="bg-white rounded-3xl p-7 sm:p-10 border border-slate-100 shadow-sm relative overflow-hidden">
                <div class="absolute top-0 right-0 p-6 opacity-[0.04]">
                    <svg class="w-24 h-24" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M14.017 21v-3c0-1.105.895-2 2-2h3v-2c0-2.761-2.238-5-5-5V7c3.866 0 7 3.134 7 7v7h-7zm-11 0v-3c0-1.105.895-2 2-2h3v-2c0-2.761-2.238-5-5-5V7c3.866 0 7 3.134 7 7v7H3.017z"/>
                    </svg>
                </div>
                <h2 class="text-xl font-bold text-slate-900 mb-5">About</h2>
                <p class="text-slate-600 leading-relaxed text-sm sm:text-base">
                    <strong>{{ $user->name }}</strong>{{ $user->title ? ', '.$user->title : '' }} —
                    {{ $user->about ?? 'No about information available.' }}
                </p>
            </section>

            {{-- Education + Working Zone --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">

                <div class="bg-white p-6 sm:p-8 rounded-3xl border border-slate-100 shadow-sm">
                    <h3 class="text-xs font-bold uppercase tracking-widest text-blue-600 mb-5">Education</h3>
                    <div class="space-y-5">
                        @forelse($user->educations as $edu)
                        <div class="flex items-start gap-3">
                            <div class="px-3 py-1.5 rounded-xl bg-blue-50 text-blue-700 text-xs font-bold shrink-0">
                                {{ $edu->degree }}
                            </div>
                            <p class="text-sm font-semibold text-slate-800 leading-snug">
                                {{ $edu->institution ? 'from '.$edu->institution : '—' }}
                            </p>
                        </div>
                        @empty
                        <p class="text-sm text-slate-400 italic">No education records.</p>
                        @endforelse
                    </div>
                </div>

                <div class="bg-slate-900 p-6 sm:p-8 rounded-3xl text-white">
                    <h3 class="text-xs font-bold uppercase tracking-widest text-blue-400 mb-5">Working Zone</h3>
                    <div class="space-y-3">
                        @forelse($user->memberships as $m)
                        <div class="border-b border-white/10 pb-3 last:border-0 last:pb-0">
                            <p class="text-sm font-semibold text-white">{{ $m->name }}</p>
                            @if($m->start || $m->end)
                            <p class="text-xs text-slate-400 mt-0.5">{{ $m->start ?? '' }}{{ ($m->start && $m->end) ? ' – ' : '' }}{{ $m->end ?? 'Present' }}</p>
                            @endif
                            @if(!empty($m->address))
                            <p class="text-xs text-slate-400">{{ $m->address }}</p>
                            @endif
                        </div>
                        @empty
                        <p class="text-sm text-slate-400 italic">No zone records.</p>
                        @endforelse
                    </div>
                </div>
            </div>

            {{-- Services list --}}
            @if($user->services->count())
            <section class="bg-white rounded-3xl p-7 sm:p-10 border border-slate-100 shadow-sm">
                <h2 class="text-xl font-bold text-slate-900 mb-5">Services</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    @foreach($user->services as $svc)
                    <div class="flex items-center gap-3 p-4 rounded-2xl border border-slate-100 bg-slate-50">
                        <div class="w-8 h-8 bg-blue-100 rounded-xl flex items-center justify-center shrink-0">
                            <i class="fa-solid fa-check text-blue-600 text-xs"></i>
                        </div>
                        <div>
                            <p class="text-sm font-bold text-slate-900">{{ $svc->title }}</p>
                            @if($svc->description)
                            <p class="text-xs text-slate-500 mt-0.5 line-clamp-1">{{ $svc->description }}</p>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            </section>
            @endif

        </div>
    </div>
</main>
@endsection
