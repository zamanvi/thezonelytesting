@php
    $meta_title       = 'Trusted ' . ($user->category?->title ?? 'Professional') . ' in ' . ($user->city ?? 'Your City') . ($user->state ? ', '.$user->state : '') . ' | ' . $user->name;
    $meta_description = 'Looking for a reliable ' . ($user->category?->title ?? 'professional') . ' near me' . ($user->city ? ' in '.$user->city : '') . '? ' . $user->name . ' is a verified professional on Zonely — ' . Str::limit(strip_tags($user->about ?? $user->bio ?? ''), 120);
    $avgRating        = $user->reviews->count() ? round($user->reviews->avg('rating'), 1) : 0;
    $schedule         = is_array($user->schedule) ? $user->schedule : (json_decode($user->schedule, true) ?? []);
    $workingDays      = $schedule['working_days'] ?? [];
    $allDays          = ['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'];
@endphp

@extends('frontend.layouts._app')
@section('title', $meta_title)
@section('og_title',       $user->name . ' — ' . ($user->title ?? $user->category?->title))
@section('og_description', Str::limit(strip_tags($user->bio ?? ''), 200))
@section('og_image',       $user->profile_photo)

@section('schema')
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "LocalBusiness",
  "name": "{{ addslashes($user->name) }}",
  "description": "{{ addslashes(Str::limit(strip_tags($user->about ?? $user->bio ?? ''), 200)) }}",
  "url": "{{ url()->current() }}",
  "image": "{{ $user->profile_photo }}",
  "@id": "{{ url()->current() }}",
  "priceRange": "Contact for pricing",
  "address": {
    "@type": "PostalAddress",
    "streetAddress": "{{ addslashes($user->work_address ?? '') }}",
    "addressLocality": "{{ $user->city ?? '' }}",
    "addressRegion": "{{ $user->state ?? '' }}",
    "addressCountry": "US"
  }
  @if($user->contacts->where('type','phone')->first()),
  "telephone": "{{ $user->contacts->where('type','phone')->first()->value ?? '' }}"
  @endif
}
</script>
@endsection

@section('content')

{{-- ── HERO ─────────────────────────────────────────────────── --}}
<section class="bg-gradient-to-r from-blue-800 to-blue-600 text-white pt-28 pb-16 px-4">
    <div class="max-w-5xl mx-auto text-center">
        <div class="inline-flex items-center gap-2 bg-white/20 text-white text-xs font-bold uppercase tracking-widest px-4 py-1.5 rounded-full mb-5">
            <span class="relative flex h-2 w-2">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-white opacity-75"></span>
                <span class="relative inline-flex rounded-full h-2 w-2 bg-white"></span>
            </span>
            Verified on Zonely
        </div>
        <h1 class="font-serif text-4xl sm:text-5xl md:text-6xl font-bold leading-tight">
            Trusted {{ $user->category?->title ?? 'Professional' }}<br>
            @if($user->city) in {{ $user->city }}{{ $user->state ? ', '.$user->state : '' }} @endif
        </h1>
        <h2 class="text-yellow-300 text-2xl sm:text-3xl font-bold mt-2">{{ $user->name }}</h2>
        @if($user->bio)
        <p class="mt-4 text-blue-100 text-base max-w-2xl mx-auto">{{ Str::limit($user->bio, 160) }}</p>
        @endif

        @php
            $trackingNumber = $user->twilioNumber?->number;
            $phone = $user->contacts->where('type','phone')->first();
            $wa    = $user->contacts->where('type','whatsapp')->first();
            $callNumber = $trackingNumber ?? $phone?->value;
        @endphp
        <div class="mt-8 flex flex-col sm:flex-row gap-3 justify-center">
            @if($callNumber)
            <a href="tel:{{ $callNumber }}"
               class="flex items-center justify-center gap-2 bg-white text-blue-700 hover:bg-yellow-300 px-8 py-4 rounded-full font-bold text-base shadow-xl transition">
                <i class="fas fa-phone"></i>
                @if($trackingNumber)
                    Call Now
                @else
                    {{ $callNumber }}
                @endif
            </a>
            @endif
            @if($wa)
            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $wa->value) }}" target="_blank"
               class="flex items-center justify-center gap-2 bg-emerald-500 hover:bg-emerald-600 text-white px-8 py-4 rounded-full font-bold text-base shadow-xl transition">
                <i class="fab fa-whatsapp text-lg"></i> WhatsApp
            </a>
            @endif
        </div>

        @if($avgRating)
        <div class="mt-5 flex items-center justify-center gap-1.5">
            @for($i=1;$i<=5;$i++)
                <i class="fas fa-star text-sm {{ $i <= $avgRating ? 'text-yellow-400' : 'text-white/30' }}"></i>
            @endfor
            <span class="text-white/80 text-sm ml-1">{{ $avgRating }} ({{ $user->reviews->count() }} reviews)</span>
        </div>
        @endif
    </div>
</section>

{{-- ── MAIN GRID ─────────────────────────────────────────────── --}}
<main class="max-w-7xl mx-auto px-4 sm:px-6 py-10">
<div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

    {{-- ── SIDEBAR ──────────────────────────────────────────── --}}
    <div class="lg:col-span-4 order-first lg:order-last space-y-5 lg:sticky lg:top-24 h-fit">

        {{-- Profile card --}}
        <div class="bg-white rounded-3xl border border-slate-200 shadow-xl shadow-blue-500/5 overflow-hidden relative">
            <div class="absolute top-0 left-0 w-full h-1.5 animate-gradient rounded-t-3xl"></div>
            <div class="p-6 sm:p-8 text-center">
                <div class="relative inline-block mb-4">
                    <div class="absolute -inset-1 bg-gradient-to-r from-blue-600 to-violet-600 rounded-[2rem] blur opacity-25"></div>
                    <img src="{{ $user->profile_photo }}" alt="{{ $user->name }}"
                         class="relative w-32 h-32 rounded-[1.8rem] object-cover border-4 border-white shadow-lg mx-auto"
                         onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=2563eb&color=fff&size=128'">
                </div>
                <div class="inline-flex items-center gap-2 bg-emerald-500 text-white text-xs font-bold px-4 py-1.5 rounded-full shadow mb-3">
                    <i class="fas fa-circle-check text-xs"></i> VERIFIED PROFESSIONAL
                </div>
                <h3 class="font-bold text-lg text-slate-900">{{ $user->name }}</h3>
                @if($user->title)<p class="text-slate-500 text-sm mt-0.5">{{ $user->title }}</p>@endif
                @if($user->city)<p class="text-slate-400 text-xs mt-1 flex items-center justify-center gap-1"><i class="fas fa-map-marker-alt text-blue-500 text-xs"></i>{{ $user->city }}{{ $user->state ? ', '.$user->state : '' }}</p>@endif
            </div>

            {{-- Contact buttons --}}
            <div class="px-6 pb-6 space-y-2.5">
                <h4 class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-3">Get in Touch</h4>
                @forelse($user->contacts as $contact)
                @php
                    $icon  = match($contact->type) { 'email'=>'fas fa-envelope','phone'=>'fas fa-phone','address'=>'fas fa-map-marker-alt','whatsapp'=>'fab fa-whatsapp',default=>'fas fa-link' };
                    $href  = match($contact->type) { 'email'=>'mailto:'.$contact->value,'phone'=>'tel:'.$contact->value,'whatsapp'=>'https://wa.me/'.preg_replace('/[^0-9]/','', $contact->value),'address'=>'#',default=>'#' };
                    $color = match($contact->type) { 'whatsapp'=>'bg-emerald-500 hover:bg-emerald-600','phone'=>'bg-blue-600 hover:bg-blue-700',default=>'bg-slate-800 hover:bg-slate-700' };
                @endphp
                <a href="{{ $href }}" class="flex items-center gap-3 w-full {{ $color }} text-white font-bold py-3.5 px-5 rounded-2xl transition text-sm">
                    <i class="{{ $icon }} w-4 text-center"></i>
                    <span class="truncate">{{ $contact->value }}</span>
                </a>
                @empty
                <p class="text-sm text-slate-400 text-center py-2">No contact info available.</p>
                @endforelse

                @auth
                @if(auth()->user()->type === 'user')
                <a href="#booking" class="mt-1 flex items-center justify-center gap-2 w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3.5 rounded-2xl transition text-sm">
                    <i class="fa-solid fa-calendar-plus"></i> Book Appointment
                </a>
                @endif
                @else
                <a href="#booking" class="mt-1 flex items-center justify-center gap-2 w-full border-2 border-blue-600 text-blue-600 hover:bg-blue-50 font-bold py-3.5 rounded-2xl transition text-sm">
                    <i class="fa-solid fa-calendar-plus"></i> Book Appointment
                </a>
                @endauth

                <p class="mt-3 text-[10px] text-center text-slate-400 uppercase tracking-widest">Secured by Zonely</p>
            </div>
        </div>

        {{-- Google Map --}}
        @if($user->work_address || $user->city)
        <div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden">
            <iframe
                src="https://maps.google.com/maps?q={{ urlencode(($user->work_address ?? '').' '.($user->city ?? '').' '.($user->state ?? '')) }}&output=embed"
                width="100%" height="180" style="border:0;" allowfullscreen="" loading="lazy">
            </iframe>
            @if($user->work_address)
            <div class="px-5 py-3 flex items-center gap-2 text-sm text-slate-600">
                <i class="fas fa-map-marker-alt text-blue-600 text-xs shrink-0"></i>
                <span>{{ $user->work_address }}</span>
            </div>
            @endif
        </div>
        @endif

        {{-- Reviews snippet --}}
        @if($user->reviews->count())
        <div class="bg-white rounded-3xl border border-slate-100 shadow-sm p-5">
            <div class="flex items-center gap-2 mb-3">
                @for($i=1;$i<=5;$i++)<i class="fas fa-star text-sm {{ $i <= $avgRating ? 'text-yellow-400' : 'text-slate-200' }}"></i>@endfor
                <span class="text-sm font-bold text-slate-700">{{ $avgRating }} <span class="font-normal text-slate-400">({{ $user->reviews->count() }} reviews)</span></span>
            </div>
            @php $latest = $user->reviews->first(); @endphp
            @if($latest)
            <p class="text-xs text-slate-500 italic">"{{ Str::limit($latest->review ?? '', 100) }}"</p>
            <p class="text-xs text-emerald-600 font-semibold mt-1">— {{ $latest->reviewer?->name ?? 'Verified Client' }}</p>
            @endif
        </div>
        @endif

        {{-- Office Hours --}}
        @if(count($workingDays))
        <div class="bg-white rounded-3xl border border-slate-100 shadow-sm p-5">
            <h4 class="font-bold text-slate-700 mb-3 flex items-center gap-2 text-sm">
                <i class="fas fa-clock text-blue-600"></i> Office Hours
            </h4>
            <div class="space-y-1.5 text-xs text-slate-600">
                @foreach($allDays as $day)
                <div class="flex justify-between">
                    <span>{{ $day }}</span>
                    @if(in_array($day, $workingDays))
                        <span class="font-bold text-slate-800">Open</span>
                    @else
                        <span class="text-slate-400">Closed</span>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
        @endif

        {{-- Languages --}}
        @if($user->languages->count())
        <div class="bg-slate-900 p-6 rounded-3xl text-white">
            <h4 class="text-xs font-bold uppercase tracking-widest text-blue-400 mb-4">Languages</h4>
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

    {{-- ── MAIN CONTENT ─────────────────────────────────────── --}}
    <div class="lg:col-span-8 order-last lg:order-first space-y-8">

        {{-- Stats strip --}}
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
            <div class="bg-white p-5 rounded-3xl border border-slate-100 text-center shadow-sm">
                <p class="text-[10px] font-bold text-slate-400 uppercase mb-1">Experience</p>
                <p class="text-2xl font-black text-slate-900">{{ $user->experience ?? '5+' }} <span class="text-base font-bold">Yrs</span></p>
            </div>
            <div class="bg-blue-600 p-5 rounded-3xl text-center shadow-sm">
                <p class="text-[10px] font-bold text-blue-200 uppercase mb-1">Success Rate</p>
                <p class="text-2xl font-black text-white">98%</p>
            </div>
            <div class="bg-white p-5 rounded-3xl border border-slate-100 text-center shadow-sm">
                <p class="text-[10px] font-bold text-slate-400 uppercase mb-1">Reviews</p>
                <p class="text-2xl font-black text-slate-900">{{ $user->reviews->count() ?: '—' }}</p>
            </div>
            <div class="bg-slate-800 p-5 rounded-3xl text-center shadow-sm">
                <p class="text-[10px] font-bold text-slate-400 uppercase mb-1">Response</p>
                <p class="text-2xl font-black text-white">&lt;2h</p>
            </div>
        </div>

        {{-- Hero profile block --}}
        <div class="flex flex-col sm:flex-row gap-8 items-start">
            <div class="relative group shrink-0 mx-auto sm:mx-0">
                <div class="absolute -inset-1 bg-gradient-to-r from-blue-600 to-violet-600 rounded-[2.5rem] blur opacity-25 group-hover:opacity-50 transition duration-1000"></div>
                <div class="relative w-52 h-64 sm:w-60 sm:h-72 rounded-[2.2rem] overflow-hidden border-4 border-white shadow-2xl">
                    <img src="{{ $user->profile_photo }}" class="w-full h-full object-cover" alt="{{ $user->name }}"
                         onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=2563eb&color=fff&size=300'">
                </div>
            </div>
            <div class="flex-1 text-center sm:text-left">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-50 text-blue-600 text-[10px] font-bold uppercase tracking-widest mb-4">
                    <span class="relative flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-blue-600"></span>
                    </span>
                    Verified Professional
                </div>
                <h2 class="font-serif text-2xl sm:text-4xl text-slate-900 mb-4 leading-tight">{{ $user->title ?? $user->name }}</h2>
                <blockquote class="border-l-4 border-blue-600 pl-4 sm:pl-6 italic text-slate-700 font-medium bg-slate-50 py-3 rounded-r-2xl text-sm sm:text-base">
                    "{{ $user->bio ?? 'Dedicated professional committed to excellence.' }}"
                </blockquote>
                @if(!empty($user->tags))
                @php $tags = array_filter(array_map('trim', explode(',', $user->tags))); @endphp
                @if(count($tags))
                <div class="mt-5">
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Services Offered</p>
                    <div class="flex flex-wrap justify-center sm:justify-start gap-2">
                        @foreach($tags as $tag)
                        <span class="px-3 py-1.5 rounded-full border border-slate-200 text-xs text-slate-700 bg-white hover:bg-blue-50 hover:border-blue-200 transition cursor-default">
                            {{ ucfirst($tag) }}
                        </span>
                        @endforeach
                    </div>
                </div>
                @endif
                @endif
            </div>
        </div>

        {{-- About --}}
        <section class="bg-white rounded-3xl p-7 sm:p-10 border border-slate-100 shadow-sm relative overflow-hidden">
            <div class="absolute top-0 right-0 p-6 opacity-[0.04]">
                <svg class="w-24 h-24" fill="currentColor" viewBox="0 0 24 24"><path d="M14.017 21v-3c0-1.105.895-2 2-2h3v-2c0-2.761-2.238-5-5-5V7c3.866 0 7 3.134 7 7v7h-7zm-11 0v-3c0-1.105.895-2 2-2h3v-2c0-2.761-2.238-5-5-5V7c3.866 0 7 3.134 7 7v7H3.017z"/></svg>
            </div>
            <h3 class="text-xl font-bold text-slate-900 mb-5">About</h3>
            <p class="text-slate-600 leading-relaxed text-sm sm:text-base">
                <strong>{{ $user->name }}</strong>{{ $user->title ? ', '.$user->title : '' }} —
                {{ $user->about ?? 'No about information available.' }}
            </p>
        </section>

        {{-- Professional services quick list --}}
        @if(!empty($user->tags) && count($tags ?? []))
        <section>
            <h3 class="text-xl font-bold text-slate-900 mb-4 relative inline-block after:content-[''] after:absolute after:w-12 after:h-0.5 after:bg-blue-600 after:-bottom-1.5 after:left-0 after:rounded-full">Professional Services</h3>
            <div class="grid sm:grid-cols-2 gap-3 mt-6">
                @foreach($tags as $tag)
                <div class="flex items-center gap-3 bg-white p-5 rounded-2xl shadow-sm border border-slate-100 hover:-translate-y-1 transition-all duration-200">
                    <i class="fas fa-circle-check text-emerald-500 text-xl shrink-0"></i>
                    <span class="text-sm font-semibold text-slate-800">{{ ucfirst($tag) }}</span>
                </div>
                @endforeach
            </div>
        </section>
        @endif

        {{-- Education + Working Zone --}}
        @if($user->educations->count() || $user->memberships->count())
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            @if($user->educations->count())
            <div class="bg-white p-6 sm:p-8 rounded-3xl border border-slate-100 shadow-sm">
                <h3 class="text-xs font-bold uppercase tracking-widest text-blue-600 mb-5">Education</h3>
                <div class="space-y-4">
                    @foreach($user->educations as $edu)
                    <div class="flex gap-3 items-start">
                        <div class="w-2 h-2 bg-blue-600 rounded-full mt-2 shrink-0"></div>
                        <div>
                            <p class="text-sm font-bold text-slate-800">{{ $edu->degree }}</p>
                            @if($edu->institution)<p class="text-xs text-slate-500 mt-0.5">{{ $edu->institution }}</p>@endif
                            @if($edu->passing_year)<p class="text-xs text-slate-400">{{ $edu->passing_year }}</p>@endif
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            @if($user->memberships->count())
            <div class="bg-slate-900 p-6 sm:p-8 rounded-3xl text-white">
                <h3 class="text-xs font-bold uppercase tracking-widest text-blue-400 mb-5">Working Zone</h3>
                <div class="space-y-4">
                    @foreach($user->memberships as $m)
                    <div class="border-b border-white/10 pb-3 last:border-0 last:pb-0">
                        <p class="text-sm font-bold text-white">{{ $m->name }}</p>
                        @if($m->start || $m->end)<p class="text-xs text-slate-400 mt-0.5">{{ $m->start ?? '' }}{{ ($m->start && $m->end) ? ' – ' : '' }}{{ $m->end ?? 'Present' }}</p>@endif
                        @if($m->address)<p class="text-xs text-slate-400">{{ $m->address }}</p>@endif
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
        @endif

        {{-- Accordion Pricing --}}
        @if($user->services->where('is_active', true)->count())
        <section class="bg-slate-50 rounded-3xl p-6 sm:p-8">
            <h3 class="text-xl font-bold text-slate-900 mb-2 text-center">Services & Pricing</h3>
            <p class="text-slate-500 text-sm text-center mb-7">Click any service to see full details</p>
            <div class="space-y-3">
                @foreach($user->services->where('is_active', true) as $svc)
                <div class="bg-white rounded-3xl overflow-hidden shadow-sm border border-slate-100">
                    <button onclick="toggleAccordion(this)"
                            class="w-full flex items-center justify-between px-6 py-5 text-left hover:bg-slate-50 transition">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 bg-blue-50 rounded-2xl flex items-center justify-center shrink-0">
                                <i class="fas fa-briefcase text-blue-600 text-sm"></i>
                            </div>
                            <div>
                                <p class="font-bold text-slate-900 text-sm sm:text-base">{{ $svc->title }}</p>
                                @if($svc->category)<p class="text-xs text-blue-600 font-semibold mt-0.5">{{ $svc->category->title }}</p>@endif
                            </div>
                        </div>
                        <div class="text-right shrink-0 ml-4">
                            @if($svc->price)
                            <p class="text-2xl font-black text-blue-700 leading-none">${{ $svc->price }}</p>
                            <p class="text-[10px] text-slate-400 mt-0.5">starting at</p>
                            @else
                            <p class="text-sm font-bold text-slate-500">Contact</p>
                            @endif
                        </div>
                    </button>
                    <div class="accordion-content px-6 pb-0 text-sm border-t border-slate-100">
                        @if($svc->description)
                        <p class="text-slate-600 leading-relaxed py-5">{{ $svc->description }}</p>
                        @endif
                        @if($svc->image_one)
                        <img src="{{ asset($svc->image_one) }}" class="w-full rounded-2xl mb-5 object-cover max-h-48" alt="{{ $svc->title }}">
                        @endif
                        <div class="pb-5">
                            <a href="#booking"
                               class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-bold px-5 py-2.5 rounded-2xl text-sm transition">
                                <i class="fas fa-phone text-xs"></i> Inquire About This Service
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </section>
        @endif

    </div>
</div>
</main>

{{-- ── BOOKING FORM ─────────────────────────────────────────── --}}
<section id="booking" class="bg-gradient-to-r from-blue-700 to-indigo-700 text-white py-16 px-4 mt-8">
    <div class="max-w-2xl mx-auto text-center">
        <h2 class="font-serif text-3xl sm:text-4xl font-bold">Ready to Get Started?</h2>
        <p class="text-blue-100 mt-2 text-sm">Speak with {{ $user->name }} today — free consultation available</p>

        @if(session('inquiry_success'))
        <div class="mt-6 bg-green-500 text-white rounded-2xl px-6 py-4 font-bold">
            <i class="fa-solid fa-circle-check mr-2"></i>{{ session('inquiry_success') }}
        </div>
        @endif

        <button onclick="toggleForm()" id="formToggleBtn"
                class="mt-8 bg-white text-blue-700 hover:bg-yellow-300 px-10 py-4 rounded-3xl font-bold text-lg shadow-xl transition flex items-center gap-3 mx-auto">
            <i class="fas fa-calendar-check"></i>
            <span id="btnText">Send a Message</span>
        </button>

        <div id="bookingForm" class="hidden mt-8 text-left">
            <form action="{{ route('service.inquiry', $user->slug) }}" method="POST"
                  class="bg-white/10 backdrop-blur-lg rounded-3xl p-8 border border-white/20 space-y-5">
                @csrf
                <div class="grid sm:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-bold mb-1.5">Full Name *</label>
                        <input type="text" name="name" required value="{{ old('name') }}"
                               class="w-full px-5 py-3.5 bg-white/20 border border-white/30 rounded-2xl text-white placeholder:text-blue-200 focus:outline-none focus:border-white text-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-bold mb-1.5">Phone Number *</label>
                        <input type="tel" name="phone" required value="{{ old('phone') }}"
                               class="w-full px-5 py-3.5 bg-white/20 border border-white/30 rounded-2xl text-white placeholder:text-blue-200 focus:outline-none focus:border-white text-sm">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-bold mb-1.5">Email Address *</label>
                    <input type="email" name="email" required value="{{ old('email') }}"
                           class="w-full px-5 py-3.5 bg-white/20 border border-white/30 rounded-2xl text-white placeholder:text-blue-200 focus:outline-none focus:border-white text-sm">
                </div>
                @if($user->services->where('is_active',true)->count())
                <div>
                    <label class="block text-sm font-bold mb-1.5">Service Needed</label>
                    <select name="service" class="w-full px-5 py-3.5 bg-white/20 border border-white/30 rounded-2xl text-white focus:outline-none focus:border-white text-sm">
                        <option value="">Select a service</option>
                        @foreach($user->services->where('is_active',true) as $svc)
                        <option value="{{ $svc->title }}" {{ old('service') == $svc->title ? 'selected' : '' }}>{{ $svc->title }}{{ $svc->price ? ' — $'.$svc->price : '' }}</option>
                        @endforeach
                        <option value="Other">Other / General Inquiry</option>
                    </select>
                </div>
                @endif
                <div>
                    <label class="block text-sm font-bold mb-1.5">Message</label>
                    <textarea name="message" rows="4"
                              class="w-full px-5 py-3.5 bg-white/20 border border-white/30 rounded-2xl text-white placeholder:text-blue-200 focus:outline-none focus:border-white text-sm resize-none"
                              placeholder="Tell us about your needs...">{{ old('message') }}</textarea>
                </div>
                <button type="submit"
                        class="w-full bg-white text-blue-700 hover:bg-yellow-300 py-4 rounded-3xl font-bold text-base flex items-center justify-center gap-2 transition shadow-lg">
                    <i class="fas fa-paper-plane"></i> Send Request
                </button>
            </form>
        </div>
    </div>
</section>

@endsection

@section('css')
<style>
    @keyframes gradient { 0%,100%{background-position:0% 50%} 50%{background-position:100% 50%} }
    .animate-gradient { background: linear-gradient(270deg,#2563eb,#7c3aed,#0ea5e9); background-size:300%; animation:gradient 4s ease infinite; }
    .accordion-content { max-height:0; overflow:hidden; transition:max-height 0.4s ease-out; }
    .accordion-content.open { max-height:600px; }
</style>
@endsection

@section('scripts')
<script>
    function toggleAccordion(btn) {
        const content = btn.nextElementSibling;
        document.querySelectorAll('.accordion-content.open').forEach(el => {
            if (el !== content) el.classList.remove('open');
        });
        content.classList.toggle('open');
    }

    function toggleForm() {
        const form = document.getElementById('bookingForm');
        const txt  = document.getElementById('btnText');
        form.classList.toggle('hidden');
        txt.textContent = form.classList.contains('hidden') ? 'Send a Message' : 'Close Form';
        if (!form.classList.contains('hidden')) form.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }

    @if(session('inquiry_success'))
        document.getElementById('bookingForm').classList.remove('hidden');
        document.getElementById('btnText').textContent = 'Close Form';
    @endif
</script>
@endsection
