@extends('frontend.layouts._app')
@section('title', 'About Us')
@section('content')

<!-- HERO -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 py-20 md:py-28 text-center">
    <h1 class="font-serif text-4xl md:text-6xl mb-6 leading-tight">
        About <span class="italic text-blue-600">Zonely</span>
    </h1>
    <p class="text-slate-500 text-lg max-w-3xl mx-auto">
        <strong>Build Your Brand. Grow Your Sales.</strong><br>
        Helping service-based businesses become visible, trusted, and profitable online.
    </p>
</section>

<!-- MISSION -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 py-16 md:py-24">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
        <div>
            <h2 class="text-blue-600 text-xs font-black uppercase tracking-[0.2em] mb-4">
                Our Mission
            </h2>

            <h3 class="font-serif text-3xl md:text-5xl mb-8 leading-tight">
                Empowering <span class="italic text-blue-600 font-normal">SMBs</span><br>
                to go <span class="italic">Digital.</span>
            </h3>

            <p class="text-slate-500 text-lg leading-relaxed mb-6">
                At Zonely, we believe every small and medium-sized business deserves the opportunity
                to shine online. Millions of service-based businesses remain invisible simply because
                they lack a digital presence.
            </p>

            <p class="text-slate-500 text-lg leading-relaxed">
                Zonely removes complexity by helping businesses create branded pages with booking,
                messaging, and lead tracking — no coding, no expensive developers, just results.
            </p>

            <div class="grid grid-cols-2 gap-8 mt-12">
                <div>
                    <p class="text-3xl font-bold text-slate-900">50+</p>
                    <p class="text-sm text-slate-400 font-bold uppercase tracking-widest">
                        SMBs Trusted
                    </p>
                </div>
                <div>
                    <p class="text-3xl font-bold text-slate-900">90%+</p>
                    <p class="text-sm text-slate-400 font-bold uppercase tracking-widest">
                        Satisfaction
                    </p>
                </div>
            </div>
        </div>

        <div class="relative">
            <div class="absolute -inset-4 bg-blue-100 rounded-[3rem] -z-10 transform rotate-3"></div>
            <img
                src="https://images.unsplash.com/photo-1556761175-4b46a572b786?auto=format&fit=crop&q=80&w=900"
                class="rounded-[2.5rem] shadow-2xl object-cover h-[500px] w-full"
                alt="Team working"
            >
        </div>
    </div>
</section>

<!-- WHAT WE OFFER -->
<section class="bg-slate-50 py-20">
    <div class="max-w-6xl mx-auto px-4 sm:px-6">
        <h2 class="font-serif text-3xl md:text-5xl text-center mb-12">
            What We <span class="italic text-blue-600">Offer</span>
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="bg-white rounded-3xl p-8 shadow-sm">
                <h3 class="font-semibold text-xl mb-2">Customizable Landing Pages</h3>
                <p class="text-slate-500">
                    Build a professional online presence in minutes with a branded profile.
                </p>
            </div>

            <div class="bg-white rounded-3xl p-8 shadow-sm">
                <h3 class="font-semibold text-xl mb-2">Booking & Messaging</h3>
                <p class="text-slate-500">
                    Manage appointments and communicate with clients effortlessly.
                </p>
            </div>

            <div class="bg-white rounded-3xl p-8 shadow-sm">
                <h3 class="font-semibold text-xl mb-2">Lead Tracking & Call Verification</h3>
                <p class="text-slate-500">
                    Track ROI and filter genuine leads that matter to your business.
                </p>
            </div>

            <div class="bg-white rounded-3xl p-8 shadow-sm">
                <h3 class="font-semibold text-xl mb-2">Affordable Plans</h3>
                <p class="text-slate-500">
                    Pricing designed for businesses in emerging and developed markets.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- VISION -->
<section class="max-w-5xl mx-auto px-4 sm:px-6 py-20 text-center">
    <h2 class="font-serif text-3xl md:text-5xl mb-6">
        Our <span class="italic text-blue-600">Vision</span>
    </h2>
    <p class="text-slate-500 text-lg leading-relaxed">
        We’re building the <strong>Shopify for service-based SMBs</strong> — a platform where local
        businesses can digitize, grow, and thrive globally. From reputation building to real-time
        leads, Zonely is the growth partner every service business needs.
    </p>
</section>

<!-- FOUNDER -->
<section class="bg-blue-600 text-white py-20">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 text-center">
        <h2 class="font-serif text-3xl md:text-5xl mb-6">
            Meet the <span class="italic">Founder</span>
        </h2>
        <p class="text-lg opacity-90">
            <strong>Norozzaman</strong> — Founder of Zonely, passionate about solving the digital
            divide for small businesses and helping them grow with simple, scalable tools.
        </p>
    </div>
</section>

<!-- CONTACT -->
<section class="max-w-4xl mx-auto px-4 sm:px-6 py-20 text-center">
    <h2 class="font-serif text-3xl md:text-5xl mb-6">
        Get in <span class="italic text-blue-600">Touch</span>
    </h2>
    <p class="text-slate-500 text-lg">
        📧 <a href="mailto:norozzaman996@gmail.com" class="text-blue-600 font-semibold">norozzaman996@gmail.com</a><br>
        📱 <a href="https://wa.me/8801826192179" target="_blank" class="text-blue-600 font-semibold">+8801826192179</a><br>
        📍 Dhaka, Bangladesh
    </p>
</section>

@endsection
