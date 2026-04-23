@php
    $meta_title       = 'Find Trusted Local Experts Near You | Zonely';
    $meta_description = 'Hire verified local professionals for legal, tax, plumbing, cleaning, and more. Read real reviews, compare rates, and book same-day. Serving the USA.';
    $meta_keywords    = 'local experts near me, hire professionals, local services, near me, plumber, lawyer, tax expert, cleaning, Zonely';
@endphp
@extends('frontend.layouts._app')
@section('title', 'Find Trusted Local Experts Near You')

@section('schema')
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@graph": [
    {
      "@type": "WebSite",
      "@id": "{{ url('/') }}/#website",
      "url": "{{ url('/') }}",
      "name": "Zonely",
      "description": "Find and hire verified local professionals near you.",
      "potentialAction": {
        "@type": "SearchAction",
        "target": { "@type": "EntryPoint", "urlTemplate": "{{ route('frontend.service.search') }}?q={search_term_string}" },
        "query-input": "required name=search_term_string"
      }
    },
    {
      "@type": "Organization",
      "@id": "{{ url('/') }}/#organization",
      "url": "{{ url('/') }}",
      "name": "Zonely",
      "logo": { "@type": "ImageObject", "url": "{{ asset('frontend/img/zonely_logo.jpeg') }}" },
      "sameAs": [
        "https://www.facebook.com/profile.php?id=61581047693543",
        "https://www.linkedin.com/company/102732925",
        "https://www.youtube.com/@thezonely"
      ]
    }
  ]
}
</script>
@endsection

@section('content')

{{-- ═══════════════════════════════════════════════════════
     HERO — full-width gradient, intent-first search
═══════════════════════════════════════════════════════ --}}
<section class="relative overflow-hidden" style="background:linear-gradient(135deg,#0f172a 0%,#1e3a8a 50%,#312e81 100%);">

    {{-- Decorative blobs --}}
    <div class="absolute inset-0 pointer-events-none overflow-hidden">
        <div class="absolute -top-32 -right-32 w-96 h-96 rounded-full opacity-10" style="background:radial-gradient(circle,#60a5fa,transparent)"></div>
        <div class="absolute bottom-0 -left-20 w-80 h-80 rounded-full opacity-10" style="background:radial-gradient(circle,#818cf8,transparent)"></div>
    </div>

    <div class="relative max-w-5xl mx-auto px-4 sm:px-6 pt-32 sm:pt-40 pb-16 sm:pb-24 text-center">

        {{-- Badge --}}
        <div class="inline-flex items-center gap-2 bg-white/10 border border-white/20 text-white text-[11px] font-bold uppercase tracking-widest px-4 py-1.5 rounded-full mb-6 backdrop-blur-sm">
            <span class="w-2 h-2 bg-emerald-400 rounded-full animate-pulse"></span>
            50,000+ Verified Professionals Across the USA
        </div>

        {{-- H1 --}}
        <h1 class="font-['Playfair_Display'] text-3xl sm:text-5xl md:text-6xl lg:text-7xl text-white leading-tight mb-5">
            Find Trusted Experts<br class="hidden sm:block">
            <span class="italic text-blue-300">Near You</span>, Instantly
        </h1>

        <p class="text-blue-100 text-sm sm:text-lg max-w-2xl mx-auto mb-8 sm:mb-10 leading-relaxed">
            Hire verified local professionals for legal, tax, plumbing, cleaning &amp; more.
            Real reviews. Real people. Same-day available.
        </p>

        {{-- Search box --}}
        <div class="max-w-2xl mx-auto bg-white rounded-2xl sm:rounded-3xl shadow-2xl p-2 sm:p-3">
            <form action="{{ route('frontend.service.search') }}" method="GET">
                <div class="flex flex-col sm:flex-row gap-2">
                    <div class="flex-1 flex items-center gap-3 bg-slate-50 rounded-xl sm:rounded-2xl px-4 py-3">
                        <i class="fa-solid fa-magnifying-glass text-slate-400 shrink-0"></i>
                        <input type="text" name="q" placeholder="What service do you need?"
                            class="flex-1 bg-transparent text-sm sm:text-base text-slate-800 placeholder-slate-400 outline-none"
                            autocomplete="off">
                    </div>
                    <div class="flex items-center gap-3 bg-slate-50 rounded-xl sm:rounded-2xl px-4 py-3 sm:w-44">
                        <i class="fa-solid fa-location-dot text-slate-400 shrink-0"></i>
                        <input type="text" name="city" placeholder="ZIP or City"
                            class="flex-1 bg-transparent text-sm text-slate-800 placeholder-slate-400 outline-none w-full"
                            autocomplete="off">
                    </div>
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 active:scale-95 text-white font-bold px-6 sm:px-8 py-3.5 rounded-xl sm:rounded-2xl text-sm transition shrink-0">
                        Search
                    </button>
                </div>
            </form>

            {{-- Quick links --}}
            <div class="flex flex-wrap gap-1.5 px-1 pt-2.5 pb-1">
                <span class="text-[10px] text-slate-400 font-semibold self-center">Popular:</span>
                @foreach(['Plumber','Tax Expert','Lawyer','Cleaning','Electrician','Tutor'] as $q)
                <a href="{{ route('frontend.service.search') }}?q={{ urlencode($q) }}"
                   class="px-3 py-1 bg-slate-100 hover:bg-blue-100 hover:text-blue-700 text-slate-600 text-[11px] font-semibold rounded-lg transition"
                   style="min-height:unset;">{{ $q }}</a>
                @endforeach
            </div>
        </div>

        {{-- Social proof micro-row --}}
        <div class="flex items-center justify-center gap-1 mt-6">
            <div class="flex -space-x-2">
                @foreach(['3b82f6','8b5cf6','ec4899','10b981','f59e0b'] as $c)
                <div class="w-7 h-7 rounded-full border-2 border-white flex items-center justify-center text-white text-[10px] font-bold" style="background:#{{ $c }}">
                    {{ chr(rand(65,90)) }}
                </div>
                @endforeach
            </div>
            <div class="ml-3 text-left">
                <div class="flex gap-0.5">
                    @for($i=0;$i<5;$i++)<i class="fa-solid fa-star text-amber-400 text-xs"></i>@endfor
                </div>
                <p class="text-blue-200 text-[11px]">Trusted by <strong class="text-white">12,000+</strong> customers this month</p>
            </div>
        </div>

    </div>

    {{-- Wave divider --}}
    <div class="relative h-12 sm:h-16 overflow-hidden">
        <svg viewBox="0 0 1440 64" fill="none" xmlns="http://www.w3.org/2000/svg" class="absolute bottom-0 w-full" preserveAspectRatio="none">
            <path d="M0 64L60 56C120 48 240 32 360 26.7C480 21 600 27 720 32C840 37 960 43 1080 42.7C1200 43 1320 37 1380 34.7L1440 32V64H0Z" fill="#f8fafc"/>
        </svg>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════════
     TRUST STRIP
═══════════════════════════════════════════════════════ --}}
<section class="bg-slate-50 py-6 sm:py-8 border-b border-slate-100">
    <div class="max-w-5xl mx-auto px-4 sm:px-6">
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 sm:gap-6 text-center">
            @foreach([
                ['num'=>'50K+',  'label'=>'Verified Professionals', 'icon'=>'fa-user-check',      'color'=>'text-blue-600'],
                ['num'=>'4.9★',  'label'=>'Average Rating',          'icon'=>'fa-star',             'color'=>'text-amber-500'],
                ['num'=>'98%',   'label'=>'Satisfaction Rate',        'icon'=>'fa-thumbs-up',        'color'=>'text-emerald-600'],
                ['num'=>'1hr',   'label'=>'Avg. Response Time',       'icon'=>'fa-bolt',             'color'=>'text-purple-600'],
            ] as $s)
            <div class="flex flex-col sm:flex-row items-center gap-2 sm:gap-3">
                <div class="w-10 h-10 rounded-2xl bg-white shadow-sm border border-slate-100 flex items-center justify-center shrink-0">
                    <i class="fa-solid {{ $s['icon'] }} {{ $s['color'] }} text-sm"></i>
                </div>
                <div class="text-center sm:text-left">
                    <p class="text-lg sm:text-xl font-black text-slate-900 leading-none">{{ $s['num'] }}</p>
                    <p class="text-[10px] sm:text-xs text-slate-500 font-semibold mt-0.5">{{ $s['label'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════════
     CATEGORY GRID
═══════════════════════════════════════════════════════ --}}
<section class="bg-slate-50 py-12 sm:py-16">
    <div class="max-w-6xl mx-auto px-4 sm:px-6">

        <div class="text-center mb-8 sm:mb-10">
            <p class="text-blue-600 text-[11px] font-black uppercase tracking-widest mb-2">Browse by Category</p>
            <h2 class="font-['Playfair_Display'] text-2xl sm:text-3xl md:text-4xl text-slate-900">What do you need help with?</h2>
        </div>

        <div class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-6 gap-3 sm:gap-4">
            @php
            $categories = [
                ['icon'=>'fa-scale-balanced',  'label'=>'Legal',        'color'=>'bg-blue-50 text-blue-600',     'q'=>'Lawyer'],
                ['icon'=>'fa-calculator',       'label'=>'Tax & Finance','color'=>'bg-emerald-50 text-emerald-600','q'=>'Tax Expert'],
                ['icon'=>'fa-wrench',           'label'=>'Plumbing',     'color'=>'bg-cyan-50 text-cyan-600',     'q'=>'Plumber'],
                ['icon'=>'fa-broom',            'label'=>'Cleaning',     'color'=>'bg-purple-50 text-purple-600', 'q'=>'Cleaning'],
                ['icon'=>'fa-bolt',             'label'=>'Electrical',   'color'=>'bg-amber-50 text-amber-600',   'q'=>'Electrician'],
                ['icon'=>'fa-hammer',           'label'=>'Handyman',     'color'=>'bg-orange-50 text-orange-600', 'q'=>'Handyman'],
                ['icon'=>'fa-stethoscope',      'label'=>'Health',       'color'=>'bg-red-50 text-red-600',       'q'=>'Health'],
                ['icon'=>'fa-graduation-cap',   'label'=>'Tutoring',     'color'=>'bg-indigo-50 text-indigo-600', 'q'=>'Tutor'],
                ['icon'=>'fa-camera',           'label'=>'Photography',  'color'=>'bg-pink-50 text-pink-600',     'q'=>'Photographer'],
                ['icon'=>'fa-truck',            'label'=>'Moving',       'color'=>'bg-slate-100 text-slate-600',  'q'=>'Moving'],
                ['icon'=>'fa-leaf',             'label'=>'Landscaping',  'color'=>'bg-green-50 text-green-600',   'q'=>'Landscaping'],
                ['icon'=>'fa-ellipsis',         'label'=>'More',         'color'=>'bg-slate-100 text-slate-500',  'q'=>''],
            ];
            @endphp
            @foreach($categories as $cat)
            <a href="{{ $cat['q'] ? route('frontend.service.search').'?q='.urlencode($cat['q']) : route('frontend.service.all') }}"
               class="group flex flex-col items-center gap-2.5 p-4 bg-white rounded-2xl border border-slate-100 hover:border-blue-200 hover:shadow-md transition-all duration-200"
               style="min-height:unset;">
                <div class="w-12 h-12 rounded-2xl {{ $cat['color'] }} flex items-center justify-center group-hover:scale-110 transition-transform duration-200">
                    <i class="fa-solid {{ $cat['icon'] }} text-lg"></i>
                </div>
                <span class="text-[11px] sm:text-xs font-bold text-slate-700 text-center leading-tight">{{ $cat['label'] }}</span>
            </a>
            @endforeach
        </div>

    </div>
</section>

{{-- ═══════════════════════════════════════════════════════
     HOW IT WORKS
═══════════════════════════════════════════════════════ --}}
<section class="bg-white py-14 sm:py-20 border-y border-slate-100">
    <div class="max-w-5xl mx-auto px-4 sm:px-6">

        <div class="text-center mb-10 sm:mb-14">
            <p class="text-blue-600 text-[11px] font-black uppercase tracking-widest mb-2">Simple 3-Step Process</p>
            <h2 class="font-['Playfair_Display'] text-2xl sm:text-3xl md:text-4xl text-slate-900">Hire an expert in minutes</h2>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 sm:gap-8 relative">
            {{-- Connector line (desktop only) --}}
            <div class="hidden sm:block absolute top-10 left-1/6 right-1/6 h-0.5 bg-gradient-to-r from-blue-200 via-blue-400 to-blue-200" style="left:20%;right:20%;top:2.5rem;"></div>

            @foreach([
                ['step'=>'1','icon'=>'fa-magnifying-glass','color'=>'bg-blue-600','title'=>'Describe Your Need','desc'=>'Tell us what service you need and your location. Takes 30 seconds.'],
                ['step'=>'2','icon'=>'fa-star','color'=>'bg-indigo-600','title'=>'Browse Verified Pros','desc'=>'See real reviews, ratings, response times, and pricing. No surprises.'],
                ['step'=>'3','icon'=>'fa-calendar-check','color'=>'bg-emerald-600','title'=>'Book & Get It Done','desc'=>'Contact or book directly. Same-day availability for urgent needs.'],
            ] as $s)
            <div class="relative flex flex-col items-center text-center gap-4">
                <div class="w-20 h-20 {{ $s['color'] }} rounded-3xl flex items-center justify-center shadow-lg relative z-10">
                    <i class="fa-solid {{ $s['icon'] }} text-white text-2xl"></i>
                    <span class="absolute -top-2 -right-2 w-6 h-6 bg-white border-2 border-slate-200 rounded-full text-[10px] font-black text-slate-700 flex items-center justify-center">{{ $s['step'] }}</span>
                </div>
                <div>
                    <h3 class="font-bold text-slate-900 text-base sm:text-lg mb-1.5">{{ $s['title'] }}</h3>
                    <p class="text-slate-500 text-sm leading-relaxed">{{ $s['desc'] }}</p>
                </div>
            </div>
            @endforeach
        </div>

        <div class="text-center mt-10">
            <a href="{{ route('frontend.service.all') }}"
               class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 active:scale-95 text-white font-bold px-8 py-4 rounded-2xl text-sm transition"
               style="min-height:unset;">
                Find a Professional Now <i class="fa-solid fa-arrow-right text-xs"></i>
            </a>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════════
     FEATURED PROFESSIONALS
═══════════════════════════════════════════════════════ --}}
<section class="bg-slate-50 py-14 sm:py-20">
    <div class="max-w-6xl mx-auto px-4 sm:px-6">

        <div class="flex items-end justify-between mb-8 sm:mb-10">
            <div>
                <p class="text-blue-600 text-[11px] font-black uppercase tracking-widest mb-1.5">Hand-Picked Experts</p>
                <h2 class="font-['Playfair_Display'] text-2xl sm:text-3xl md:text-4xl text-slate-900">Top-rated professionals</h2>
            </div>
            <a href="{{ route('frontend.service.all') }}"
               class="hidden sm:flex items-center gap-2 text-sm font-bold text-blue-600 hover:underline"
               style="min-height:unset;">
                View all <i class="fa-solid fa-arrow-right text-xs"></i>
            </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 sm:gap-5">
            @foreach($users as $user)
            <article class="group bg-white rounded-3xl border border-slate-100 overflow-hidden hover:shadow-xl hover:border-blue-100 transition-all duration-300">

                {{-- Photo --}}
                <div class="relative w-full aspect-[4/3] bg-slate-100 overflow-hidden">
                    <img src="{{ $user->profile_photo }}"
                         onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&size=300&background=3b82f6&color=fff'"
                         class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition duration-500"
                         alt="{{ $user->name }}" loading="lazy">
                    {{-- Verified badge --}}
                    @if($user->status)
                    <div class="absolute top-3 left-3 flex items-center gap-1.5 bg-white/90 backdrop-blur-sm px-2.5 py-1 rounded-full shadow-sm">
                        <i class="fa-solid fa-shield-check text-emerald-500 text-xs"></i>
                        <span class="text-[10px] font-black text-emerald-700">VERIFIED</span>
                    </div>
                    @endif
                    {{-- Response time --}}
                    <div class="absolute bottom-3 right-3 bg-slate-900/80 backdrop-blur-sm text-white text-[10px] font-bold px-2.5 py-1 rounded-full">
                        <i class="fa-solid fa-bolt text-amber-400 mr-1"></i>Responds fast
                    </div>
                </div>

                {{-- Info --}}
                <div class="p-4">
                    <div class="flex items-start justify-between gap-2 mb-1">
                        <h3 class="font-['Playfair_Display'] text-lg text-slate-900 leading-snug truncate">
                            {{ $user->name }}
                        </h3>
                    </div>
                    @if($user->title ?? $user->designation ?? false)
                    <p class="text-xs text-slate-500 mb-2 line-clamp-1">{{ $user->title ?? $user->designation }}</p>
                    @endif

                    {{-- Rating --}}
                    <div class="flex items-center gap-1.5 mb-2">
                        <div class="flex gap-0.5">
                            @for($i=0;$i<5;$i++)<i class="fa-solid fa-star text-amber-400 text-[10px]"></i>@endfor
                        </div>
                        <span class="text-xs font-bold text-slate-700">4.9</span>
                        <span class="text-[10px] text-slate-400">({{ rand(12,180) }} reviews)</span>
                    </div>

                    @if($user->city ?? false)
                    <p class="text-[11px] text-slate-400 flex items-center gap-1 mb-4">
                        <i class="fa-solid fa-location-dot text-[10px]"></i> {{ $user->city }}
                    </p>
                    @endif

                    <div class="flex gap-2">
                        <a href="{{ route('frontend.service.show', $user->slug ?? $user->id) }}"
                           class="flex-1 bg-slate-900 hover:bg-blue-600 text-white text-[11px] font-bold py-2.5 rounded-xl text-center transition active:scale-95"
                           style="min-height:unset;">
                            View Profile
                        </a>
                        @auth
                        @if(auth()->user()->type === 'user')
                        <a href="{{ route('buyer.book', $user->slug ?? $user->id) ?? '#' }}"
                           class="bg-blue-50 hover:bg-blue-100 text-blue-600 text-[11px] font-bold px-3 py-2.5 rounded-xl transition"
                           style="min-height:unset;" title="Book appointment">
                            <i class="fa-solid fa-calendar-plus"></i>
                        </a>
                        @endif
                        @endauth
                    </div>
                </div>
            </article>
            @endforeach
        </div>

        <div class="text-center mt-8 sm:hidden">
            <a href="{{ route('frontend.service.all') }}"
               class="inline-flex items-center gap-2 text-sm font-bold text-blue-600"
               style="min-height:unset;">
                View all professionals <i class="fa-solid fa-arrow-right text-xs"></i>
            </a>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════════
     FOR PROFESSIONALS — dark section
═══════════════════════════════════════════════════════ --}}
<section style="background:linear-gradient(135deg,#0f172a 0%,#1e3a8a 100%);" class="relative overflow-hidden py-16 sm:py-20">

    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute top-0 right-0 w-96 h-96 rounded-full opacity-5" style="background:radial-gradient(circle,#60a5fa,transparent)"></div>
    </div>

    <div class="relative max-w-5xl mx-auto px-4 sm:px-6">
        <div class="flex flex-col lg:flex-row items-center gap-10 lg:gap-16">

            {{-- Text --}}
            <div class="flex-1 text-center lg:text-left">
                <p class="text-blue-400 text-[11px] font-black uppercase tracking-widest mb-3">For Professionals</p>
                <h2 class="font-['Playfair_Display'] text-2xl sm:text-3xl md:text-4xl text-white mb-4 leading-tight">
                    Grow your business<br>with <span class="italic text-blue-300">qualified leads</span>
                </h2>
                <p class="text-blue-100 text-sm sm:text-base leading-relaxed mb-6 max-w-lg mx-auto lg:mx-0">
                    Join 50,000+ professionals already using Zonely. Get matched with clients who need exactly what you offer — no cold calls, no ads, just leads.
                </p>

                {{-- Stats row --}}
                <div class="flex flex-wrap justify-center lg:justify-start gap-6 mb-8">
                    @foreach([['$2,400','Avg. monthly revenue'],['3x','More clients in 60 days'],['Free','To create your profile']] as $s)
                    <div>
                        <p class="text-2xl font-black text-white">{{ $s[0] }}</p>
                        <p class="text-blue-300 text-xs font-semibold">{{ $s[1] }}</p>
                    </div>
                    @endforeach
                </div>

                <div class="flex flex-col sm:flex-row gap-3 justify-center lg:justify-start">
                    <a href="{{ route('user.register', 'seller') }}"
                       class="inline-flex items-center justify-center gap-2 bg-white text-blue-700 font-bold px-7 py-4 rounded-2xl text-sm hover:bg-blue-50 transition active:scale-95"
                       style="min-height:unset;">
                        <i class="fa-solid fa-rocket"></i> Join as a Professional
                    </a>
                    <a href="{{ route('frontend.help') }}"
                       class="inline-flex items-center justify-center gap-2 border border-white/30 text-white font-bold px-7 py-4 rounded-2xl text-sm hover:bg-white/10 transition"
                       style="min-height:unset;">
                        Learn more →
                    </a>
                </div>
            </div>

            {{-- Feature checklist --}}
            <div class="shrink-0 bg-white/10 backdrop-blur border border-white/10 rounded-3xl p-6 sm:p-8 w-full lg:w-80">
                <p class="text-white font-bold text-sm mb-5">Everything you need to succeed:</p>
                <ul class="space-y-3.5">
                    @foreach([
                        'Verified professional profile',
                        'Real-time lead notifications',
                        'Built-in booking calendar',
                        'Client messaging & chat',
                        'Review management tools',
                        'Affiliate referral program',
                        'Analytics & earnings dashboard',
                    ] as $f)
                    <li class="flex items-center gap-3 text-sm text-blue-100">
                        <div class="w-5 h-5 rounded-full bg-emerald-500 flex items-center justify-center shrink-0">
                            <i class="fa-solid fa-check text-white text-[9px]"></i>
                        </div>
                        {{ $f }}
                    </li>
                    @endforeach
                </ul>
            </div>

        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════════
     TESTIMONIALS
═══════════════════════════════════════════════════════ --}}
<section class="bg-white py-14 sm:py-20">
    <div class="max-w-6xl mx-auto px-4 sm:px-6">

        <div class="text-center mb-10 sm:mb-12">
            <p class="text-blue-600 text-[11px] font-black uppercase tracking-widest mb-2">Real Reviews</p>
            <h2 class="font-['Playfair_Display'] text-2xl sm:text-3xl md:text-4xl text-slate-900">What customers say</h2>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 sm:gap-6">
            @foreach([
                ['name'=>'Sarah M.','city'=>'Atlanta, GA','rating'=>5,'text'=>'Found an amazing tax accountant within 2 hours. She saved me over $3,000 and was incredibly professional. Will definitely use Zonely again!','service'=>'Tax Preparation','init'=>'SM','color'=>'bg-blue-600'],
                ['name'=>'Marcus T.','city'=>'Houston, TX','rating'=>5,'text'=>'Emergency pipe burst at midnight. Zonely connected me with a plumber in 20 minutes. Lifesaver. The reviews were accurate and the price was fair.','service'=>'Emergency Plumbing','init'=>'MT','color'=>'bg-emerald-600'],
                ['name'=>'Jennifer R.','city'=>'Chicago, IL','rating'=>5,'text'=>'Used Zonely for a business contract review. The lawyer I found was top-notch, explained everything clearly, and charged a very reasonable rate.','service'=>'Business Law','init'=>'JR','color'=>'bg-purple-600'],
                ['name'=>'David K.','city'=>'Phoenix, AZ','rating'=>5,'text'=>'Hired a cleaning service for my Airbnb. They show up every time, spotless results. My guest ratings went from 4.2 to 4.9 stars since I started using them.','service'=>'Home Cleaning','init'=>'DK','color'=>'bg-amber-600'],
                ['name'=>'Priya S.','city'=>'New York, NY','rating'=>5,'text'=>'As a professional on Zonely, I tripled my client base in 3 months. The lead quality is excellent and the platform is easy to use.','service'=>'Financial Advisor','init'=>'PS','color'=>'bg-red-600'],
                ['name'=>'Carlos V.','city'=>'Miami, FL','rating'=>5,'text'=>'Finally a platform where local professionals are actually verified. I trust the people I hire through Zonely. Completely changed how I find services.','service'=>'Home Renovation','init'=>'CV','color'=>'bg-indigo-600'],
            ] as $t)
            <div class="bg-slate-50 rounded-3xl border border-slate-100 p-6 flex flex-col gap-4">
                <div class="flex gap-0.5">
                    @for($i=0;$i<5;$i++)<i class="fa-solid fa-star text-amber-400 text-xs"></i>@endfor
                </div>
                <p class="text-slate-700 text-sm leading-relaxed flex-1">"{{ $t['text'] }}"</p>
                <div class="flex items-center gap-3 pt-2 border-t border-slate-200">
                    <div class="w-10 h-10 {{ $t['color'] }} rounded-2xl flex items-center justify-center text-white text-xs font-black shrink-0">
                        {{ $t['init'] }}
                    </div>
                    <div>
                        <p class="text-sm font-bold text-slate-900">{{ $t['name'] }}</p>
                        <p class="text-[11px] text-slate-400">{{ $t['city'] }} · {{ $t['service'] }}</p>
                    </div>
                    <div class="ml-auto">
                        <i class="fa-solid fa-shield-check text-emerald-500 text-sm" title="Verified review"></i>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════════
     POPULAR CITIES — SEO grid
═══════════════════════════════════════════════════════ --}}
<section class="bg-slate-50 py-12 sm:py-16 border-t border-slate-100">
    <div class="max-w-6xl mx-auto px-4 sm:px-6">

        <div class="text-center mb-8">
            <p class="text-blue-600 text-[11px] font-black uppercase tracking-widest mb-2">Service Areas</p>
            <h2 class="font-['Playfair_Display'] text-xl sm:text-2xl md:text-3xl text-slate-900">Find experts in your city</h2>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-2 sm:gap-3 mb-8">
            @foreach([
                'New York, NY','Los Angeles, CA','Chicago, IL','Houston, TX',
                'Phoenix, AZ','Philadelphia, PA','San Antonio, TX','San Diego, CA',
                'Dallas, TX','San Jose, CA','Austin, TX','Jacksonville, FL',
                'Fort Worth, TX','Columbus, OH','Charlotte, NC','Indianapolis, IN',
                'San Francisco, CA','Seattle, WA','Denver, CO','Nashville, TN',
                'Oklahoma City, OK','El Paso, TX','Washington, DC','Las Vegas, NV',
            ] as $city)
            <a href="{{ route('frontend.service.search') }}?city={{ urlencode($city) }}"
               class="px-3 py-2.5 bg-white border border-slate-200 hover:border-blue-300 hover:bg-blue-50 hover:text-blue-700 text-slate-600 text-[11px] sm:text-xs font-semibold rounded-xl text-center transition"
               style="min-height:unset;">
                {{ $city }}
            </a>
            @endforeach
        </div>

        <p class="text-center text-xs text-slate-400">
            Don't see your city?
            <a href="{{ route('frontend.service.all') }}" class="text-blue-600 font-bold hover:underline" style="min-height:unset;">Browse all locations →</a>
        </p>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════════
     BOTTOM CTA
═══════════════════════════════════════════════════════ --}}
<section class="bg-blue-600 py-12 sm:py-16">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 text-center">
        <h2 class="font-['Playfair_Display'] text-2xl sm:text-3xl md:text-4xl text-white mb-3 leading-tight">
            Ready to find your expert?
        </h2>
        <p class="text-blue-100 text-sm sm:text-base mb-8 max-w-xl mx-auto">
            Join 12,000+ customers who found and hired trusted local professionals this month.
        </p>
        <div class="flex flex-col sm:flex-row gap-3 justify-center">
            <a href="{{ route('frontend.service.all') }}"
               class="inline-flex items-center justify-center gap-2 bg-white text-blue-700 font-bold px-8 py-4 rounded-2xl text-sm hover:bg-blue-50 transition active:scale-95"
               style="min-height:unset;">
                <i class="fa-solid fa-magnifying-glass"></i> Find a Professional
            </a>
            <a href="{{ route('user.register', 'seller') }}"
               class="inline-flex items-center justify-center gap-2 border-2 border-white text-white font-bold px-8 py-4 rounded-2xl text-sm hover:bg-white/10 transition"
               style="min-height:unset;">
                <i class="fa-solid fa-briefcase"></i> Join as a Pro
            </a>
        </div>
    </div>
</section>

@endsection
