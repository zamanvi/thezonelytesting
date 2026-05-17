@php
    $meta_title       = 'About Zonely — Connecting Local Experts Worldwide';
    $meta_description = 'Zonely is a USA-registered platform helping service-based businesses worldwide become visible, trusted, and profitable online.';
@endphp
@extends('frontend.layouts._app')
@section('title', 'About Zonely')
@section('og_title', $meta_title)
@section('og_description', $meta_description)
@section('og_image', asset('frontend/img/ceo.webp'))

@section('schema')
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "AboutPage",
  "name": "About Zonely",
  "url": "{{ url()->current() }}",
  "publisher": {
    "@type": "Organization",
    "name": "Zonely",
    "logo": { "@type": "ImageObject", "url": "{{ asset('frontend/img/zonely_logo.png') }}" }
  }
}
</script>
@endsection

@section('content')

<!-- HERO -->
<section class="mt-16 sm:mt-20 max-w-7xl mx-auto px-4 sm:px-6 pt-14 pb-10 text-center">
    <span class="text-teal-700 text-xs font-black uppercase tracking-widest mb-4 block">Build Your Brand. Grow Your Sales.</span>
    <h1 class="font-serif text-4xl md:text-6xl mb-6 leading-tight">
        About <span class="italic text-teal-700">Zonely</span>
    </h1>
    <p class="text-slate-500 text-lg max-w-3xl mx-auto leading-relaxed">
        A global platform connecting skilled local professionals with clients who need them — operating worldwide, headquartered in the USA.
    </p>
</section>

<!-- MISSION -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 py-16 md:py-20">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
        <div>
            <h2 class="text-teal-700 text-xs font-black uppercase tracking-[0.2em] mb-4">Our Mission</h2>
            <h3 class="font-serif text-3xl md:text-5xl mb-8 leading-tight">
                Empowering <span class="italic text-teal-700 font-normal">Local Experts</span><br>
                to go <span class="italic">Global.</span>
            </h3>
            <p class="text-slate-500 text-lg leading-relaxed mb-6">
                At Zonely, we believe every skilled professional deserves the opportunity to shine online — no matter where they are in the world. Millions of service-based businesses remain invisible simply because they lack a digital presence.
            </p>
            <p class="text-slate-500 text-lg leading-relaxed">
                Zonely removes that complexity. We help professionals create branded pages with booking, messaging, and lead tracking — no coding, no expensive developers, just results.
            </p>
            <div class="grid grid-cols-3 gap-6 mt-12">
                <div>
                    <p class="text-3xl font-bold text-slate-900">50+</p>
                    <p class="text-xs text-slate-400 font-bold uppercase tracking-widest mt-1">Experts Listed</p>
                </div>
                <div>
                    <p class="text-3xl font-bold text-slate-900">90%+</p>
                    <p class="text-xs text-slate-400 font-bold uppercase tracking-widest mt-1">Satisfaction</p>
                </div>
                <div>
                    <p class="text-3xl font-bold text-slate-900">🌍</p>
                    <p class="text-xs text-slate-400 font-bold uppercase tracking-widest mt-1">Worldwide</p>
                </div>
            </div>
        </div>
        <div class="relative">
            <div class="absolute -inset-4 bg-teal-100 rounded-[3rem] -z-10 transform rotate-3"></div>
            <img src="https://images.unsplash.com/photo-1556761175-4b46a572b786?auto=format&fit=crop&q=80&w=900"
                class="rounded-[2.5rem] shadow-2xl object-cover h-[500px] w-full" alt="Team working">
        </div>
    </div>
</section>

<!-- WHAT WE OFFER -->
<section class="bg-slate-50 py-20">
    <div class="max-w-6xl mx-auto px-4 sm:px-6">
        <h2 class="font-serif text-3xl md:text-5xl text-center mb-12">
            What We <span class="italic text-teal-700">Offer</span>
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-white rounded-3xl p-8 shadow-sm flex gap-5 items-start">
                <div class="w-12 h-12 shrink-0 bg-teal-50 rounded-2xl flex items-center justify-center">
                    <i class="fa-solid fa-id-card text-teal-700 text-lg"></i>
                </div>
                <div>
                    <h3 class="font-semibold text-xl mb-2">Branded Profile Pages</h3>
                    <p class="text-slate-500 text-sm leading-relaxed">Build a professional online presence in minutes. Your profile, your brand — found by clients worldwide.</p>
                </div>
            </div>
            <div class="bg-white rounded-3xl p-8 shadow-sm flex gap-5 items-start">
                <div class="w-12 h-12 shrink-0 bg-teal-50 rounded-2xl flex items-center justify-center">
                    <i class="fa-solid fa-calendar-check text-teal-700 text-lg"></i>
                </div>
                <div>
                    <h3 class="font-semibold text-xl mb-2">Booking & Messaging</h3>
                    <p class="text-slate-500 text-sm leading-relaxed">Manage appointments and communicate with clients effortlessly from one dashboard.</p>
                </div>
            </div>
            <div class="bg-white rounded-3xl p-8 shadow-sm flex gap-5 items-start">
                <div class="w-12 h-12 shrink-0 bg-teal-50 rounded-2xl flex items-center justify-center">
                    <i class="fa-solid fa-chart-line text-teal-700 text-lg"></i>
                </div>
                <div>
                    <h3 class="font-semibold text-xl mb-2">Lead Tracking & Call Verification</h3>
                    <p class="text-slate-500 text-sm leading-relaxed">Track ROI and filter genuine leads. Every call and inquiry logged and verified automatically.</p>
                </div>
            </div>
            <div class="bg-white rounded-3xl p-8 shadow-sm flex gap-5 items-start">
                <div class="w-12 h-12 shrink-0 bg-teal-50 rounded-2xl flex items-center justify-center">
                    <i class="fa-solid fa-tags text-teal-700 text-lg"></i>
                </div>
                <div>
                    <h3 class="font-semibold text-xl mb-2">Affordable Global Plans</h3>
                    <p class="text-slate-500 text-sm leading-relaxed">Pricing designed for professionals in every market — whether you're in New York or Nairobi.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- VISION -->
<section class="max-w-5xl mx-auto px-4 sm:px-6 py-20 text-center">
    <h2 class="font-serif text-3xl md:text-5xl mb-6">
        Our <span class="italic text-teal-700">Vision</span>
    </h2>
    <p class="text-slate-500 text-lg leading-relaxed max-w-3xl mx-auto">
        We're building the <strong class="text-slate-700">Shopify for service-based professionals</strong> — a global platform where local experts can digitize, grow, and thrive. From reputation building to real-time leads, Zonely is the growth partner every skilled professional needs.
    </p>
</section>

<!-- FOUNDER -->
<section class="bg-slate-900 text-white py-20 md:py-28 overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="flex flex-col lg:flex-row items-center gap-16">

            <div class="w-full lg:w-1/3">
                <div class="relative group mx-auto max-w-sm">
                    <div class="absolute -inset-1 bg-gradient-to-r from-teal-700 to-violet-600 rounded-[2.5rem] blur opacity-30"></div>
                    <div class="relative aspect-[4/5] overflow-hidden rounded-[2.5rem] border-4 border-slate-800">
                        <img src="{{ asset('frontend/img/ceo.webp') }}"
                            class="w-full h-full object-cover grayscale hover:grayscale-0 transition-all duration-700"
                            alt="Md. Norozzaman — Founder & CEO of Zonely"
                            onerror="this.src='https://ui-avatars.com/api/?name=Md+Norozzaman&background=1e293b&color=fff&size=400'">
                    </div>
                </div>
            </div>

            <div class="flex-1 text-center lg:text-left">
                <h2 class="text-teal-400 text-xs font-black uppercase tracking-[0.2em] mb-4">Message from the Founder</h2>
                <h3 class="font-serif text-2xl md:text-4xl mb-6 leading-tight">
                    "Connecting skilled professionals with the people who need them most — anywhere in the world. That's the mission behind Zonely."
                </h3>
                <div class="space-y-6 text-slate-400 text-lg leading-relaxed max-w-2xl mx-auto lg:mx-0">
                    <p>
                        Hi, I'm <span class="text-white font-bold">Md. Norozzaman</span>,
                        Founder &amp; CEO of <span class="text-white font-semibold">Zonely</span>.
                        Born in Bangladesh, I built Zonely with a simple belief — skilled professionals everywhere deserve to be found.
                        Zonely is registered in the USA and operates globally, making it effortless for experts worldwide to connect with clients who need them most.
                    </p>
                </div>
                <div class="mt-8">
                    <p class="font-serif text-2xl text-white">Md. Norozzaman</p>
                    <p class="text-teal-400 text-sm font-bold uppercase tracking-widest mt-1">Founder &amp; CEO — Zonely</p>
                </div>
                <div class="mt-8 flex justify-center lg:justify-start gap-4">
                    <a href="https://www.linkedin.com/in/md-norozzaman-207418169/" target="_blank" rel="noopener" aria-label="LinkedIn"
                        class="group p-3 rounded-full bg-slate-800 hover:bg-teal-700 transition">
                        <svg class="w-5 h-5 text-slate-400 group-hover:text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M4.98 3.5C4.98 4.88 3.86 6 2.5 6S0 4.88 0 3.5 1.12 1 2.5 1 4.98 2.12 4.98 3.5zM.22 24h4.56V7.98H.22V24zM7.91 7.98H12.3v2.19h.06c.61-1.15 2.1-2.36 4.33-2.36 4.63 0 5.48 3.05 5.48 7.01V24h-4.56v-7.59c0-1.81-.03-4.14-2.52-4.14-2.53 0-2.92 1.97-2.92 4v7.73H7.91V7.98z"/>
                        </svg>
                    </a>
                    <a href="https://www.facebook.com/md.norozzaman.334957/" target="_blank" rel="noopener" aria-label="Facebook"
                        class="group p-3 rounded-full bg-slate-800 hover:bg-blue-600 transition">
                        <svg class="w-5 h-5 text-slate-400 group-hover:text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M22.675 0H1.325C.593 0 0 .593 0 1.325v21.351C0 23.407.593 24 1.325 24h11.495v-9.294H9.691V11.01h3.129V8.309c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.795.143v3.24l-1.918.001c-1.504 0-1.796.715-1.796 1.763v2.313h3.587l-.467 3.696h-3.12V24h6.116C23.407 24 24 23.407 24 22.676V1.325C24 .593 23.407 0 22.675 0z"/>
                        </svg>
                    </a>
                    <a href="https://wa.me/8801826192179" target="_blank" rel="noopener" aria-label="WhatsApp"
                        class="group p-3 rounded-full bg-slate-800 hover:bg-green-500 transition">
                        <svg class="w-5 h-5 text-slate-400 group-hover:text-white" fill="currentColor" viewBox="0 0 32 32">
                            <path d="M16.003 3C9.373 3 4 8.373 4 15.003c0 2.646.861 5.083 2.318 7.057L4 29l7.11-2.262a11.92 11.92 0 0 0 4.893 1.044h.001c6.63 0 12.003-5.373 12.003-12.003C28.007 8.373 22.634 3 16.003 3zm6.728 17.348c-.282.79-1.65 1.52-2.28 1.61-.604.088-1.37.125-2.21-.14-.51-.16-1.165-.378-2.01-.73-3.536-1.52-5.844-5.1-6.02-5.336-.175-.235-1.44-1.92-1.44-3.662 0-1.74.9-2.597 1.22-2.953.32-.355.7-.445.94-.445.235 0 .47 0 .676.01.218.01.51-.084.8.61.282.678.96 2.35 1.04 2.52.08.17.14.38.03.61-.11.235-.165.38-.33.58-.165.2-.347.45-.495.605-.165.165-.338.345-.145.68.195.335.87 1.435 1.87 2.32 1.29 1.14 2.38 1.49 2.71 1.66.33.165.52.14.72-.085.2-.23.82-.96 1.04-1.29.22-.33.44-.275.75-.165.31.11 1.95.92 2.28 1.085.33.165.55.25.63.39.085.14.085.79-.2 1.58z"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CONTACT -->
<section class="max-w-4xl mx-auto px-4 sm:px-6 py-20 text-center">
    <h2 class="font-serif text-3xl md:text-5xl mb-10">
        Get in <span class="italic text-teal-700">Touch</span>
    </h2>
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
        <a href="mailto:contact@zonelyleads.com"
            class="flex flex-col items-center gap-3 p-6 bg-slate-50 rounded-3xl hover:bg-teal-50 transition group">
            <div class="w-12 h-12 bg-teal-100 rounded-2xl flex items-center justify-center group-hover:bg-teal-200 transition">
                <i class="fa-solid fa-envelope text-teal-700 text-lg"></i>
            </div>
            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Email</p>
            <p class="text-sm font-semibold text-teal-700">contact@zonelyleads.com</p>
        </a>
        <a href="https://wa.me/8801826192179" target="_blank" rel="noopener"
            class="flex flex-col items-center gap-3 p-6 bg-slate-50 rounded-3xl hover:bg-green-50 transition group">
            <div class="w-12 h-12 bg-green-100 rounded-2xl flex items-center justify-center group-hover:bg-green-200 transition">
                <i class="fab fa-whatsapp text-green-600 text-lg"></i>
            </div>
            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">WhatsApp</p>
            <p class="text-sm font-semibold text-slate-700">+880 1826 192179</p>
        </a>
        <div class="flex flex-col items-center gap-3 p-6 bg-slate-50 rounded-3xl">
            <div class="w-12 h-12 bg-slate-100 rounded-2xl flex items-center justify-center">
                <i class="fa-solid fa-location-dot text-slate-500 text-lg"></i>
            </div>
            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Location</p>
            <p class="text-sm font-semibold text-slate-700">Global Operations</p>
        </div>
    </div>
</section>

@endsection
