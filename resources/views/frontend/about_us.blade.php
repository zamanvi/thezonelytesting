@extends('frontend.layouts._app')
@section('title', 'About Us')
@section('content')

<!-- HERO -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 py-10 md:py-16 text-center">
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
<section class="text-black py-20">
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
        📧 <a href="mailto:support@thezonely.com" class="text-blue-600 font-semibold">support@thezonely.com</a><br>
        📱 <a href="https://wa.me/8801826192179" target="_blank" class="text-blue-600 font-semibold">+8801826192179</a><br>
        📍 Dhaka, Bangladesh
    </p>
</section>
    <section class="bg-slate-900 text-white py-20 md:py-32 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6">
            <div class="flex flex-col lg:flex-row items-center gap-16">

                <!-- IMAGE -->
                <div class="w-full lg:w-1/3">
                    <div class="relative group mx-auto max-w-sm">
                        <div
                            class="absolute -inset-1 bg-gradient-to-r from-blue-600 to-violet-600 rounded-[2.5rem] blur opacity-30">
                        </div>

                        <div class="relative aspect-[4/5] overflow-hidden rounded-[2.5rem] border-4 border-slate-800">
                            <img src="{{ asset('frontend/img/ceo.webp') }}"
                                class="w-full h-full object-cover grayscale hover:grayscale-0 transition-all duration-700"
                                alt="Md. Norozzaman">
                        </div>
                    </div>
                </div>

                <!-- CONTENT -->
                <div class="flex-1 text-center lg:text-left">
                    <h2 class="text-blue-400 text-xs font-black uppercase tracking-[0.2em] mb-4">
                        Message from the Founder
                    </h2>

                    <h3 class="font-serif text-3xl md:text-5xl mb-6 leading-tight">
                        “Building brands through strategy, creativity, and digital excellence.”
                    </h3>

                    {{-- <div class="space-y-6 text-slate-400 text-lg leading-relaxed max-w-2xl mx-auto lg:mx-0">
                        <p>
                            Hi, I'm <span class="text-white font-bold">Md. Norozzaman</span>,
                            Founder and CEO of
                            <span class="text-white font-semibold">
                                Tansai Consultancy & Language Center
                            </span>.
                            A graduate of <span class="text-white font-semibold">HEZHOU University, China</span>,
                            I'm professional businessman with 3 (three) years of e-commerce business experience.
                        </p>
                    </div>

                    <!-- SIGNATURE -->
                    <div class="mt-5">
                        <p class="font-serif text-2xl text-white">Md. Norozzaman</p>
                        <p class="text-blue-400 text-sm font-bold uppercase tracking-widest">
                            Founder & CEO
                        </p>
                    </div> --}}

                    <div class="max-w-3xl mx-auto lg:mx-0 space-y-8">

                        <!-- ABOUT TEXT -->
                        <div class="space-y-6 text-gray-300 leading-relaxed text-lg lg:text-xl tracking-wide">
                            <p class="text-white font-serif text-lg lg:text-2xl">
                                Hello, I’m <span class="font-bold">Md. Norozzaman</span>,
                                the Founder and CEO of
                                <span class="font-semibold">Tansai Consultancy &amp; Language Center</span>.
                                A graduate of <span class="font-semibold">Hezhou University, China</span>,
                                I am a dedicated entrepreneur with over
                                <span class="font-semibold">three years of hands-on experience</span>
                                in e-commerce, combining global insight with practical business leadership.
                            </p>
                        </div>

                        <!-- SIGNATURE -->
                        <div class="mt-12">
                            <p class="font-serif text-3xl lg:text-4xl text-white tracking-wide">Md. Norozzaman</p>
                            <p class="text-blue-400 text-sm lg:text-base font-bold uppercase tracking-widest mt-1">
                                Founder &amp; CEO
                            </p>
                        </div>
                    </div>

                    <!-- SOCIAL LINKS -->
                    <div class="mt-8 flex justify-center lg:justify-start gap-5">

                        <!-- LinkedIn -->
                        <a href="https://www.linkedin.com/in/md-norozzaman-207418169" target="_blank" aria-label="LinkedIn"
                            class="group p-3 rounded-full bg-slate-800 hover:bg-blue-600 transition">
                            <svg class="w-5 h-5 text-slate-400 group-hover:text-white" fill="currentColor"
                                viewBox="0 0 24 24">
                                <path
                                    d="M4.98 3.5C4.98 4.88 3.86 6 2.5 6S0 4.88 0 3.5 1.12 1 2.5 1 4.98 2.12 4.98 3.5zM.22 24h4.56V7.98H.22V24zM7.91 7.98H12.3v2.19h.06c.61-1.15 2.1-2.36 4.33-2.36 4.63 0 5.48 3.05 5.48 7.01V24h-4.56v-7.59c0-1.81-.03-4.14-2.52-4.14-2.53 0-2.92 1.97-2.92 4v7.73H7.91V7.98z" />
                            </svg>
                        </a>

                        <!-- Facebook -->
                        <a href="https://www.facebook.com/md.norozzaman.334957" target="_blank" aria-label="Facebook"
                            class="group p-3 rounded-full bg-slate-800 hover:bg-blue-500 transition">
                            <svg class="w-5 h-5 text-slate-400 group-hover:text-white" fill="currentColor"
                                viewBox="0 0 24 24">
                                <path
                                    d="M22.675 0H1.325C.593 0 0 .593 0 1.325v21.351C0 23.407.593 24 1.325 24h11.495v-9.294H9.691V11.01h3.129V8.309c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.795.143v3.24l-1.918.001c-1.504 0-1.796.715-1.796 1.763v2.313h3.587l-.467 3.696h-3.12V24h6.116C23.407 24 24 23.407 24 22.676V1.325C24 .593 23.407 0 22.675 0z" />
                            </svg>
                        </a>

                        <!-- WhatsApp -->
                        <a href="https://wa.me/8801826192179" target="_blank" aria-label="WhatsApp"
                            class="group p-3 rounded-full bg-slate-800 hover:bg-green-500 transition">
                            <svg class="w-5 h-5 text-slate-400 group-hover:text-white" fill="currentColor"
                                viewBox="0 0 32 32">
                                <path
                                    d="M16.003 3C9.373 3 4 8.373 4 15.003c0 2.646.861 5.083 2.318 7.057L4 29l7.11-2.262a11.92 11.92 0 0 0 4.893 1.044h.001c6.63 0 12.003-5.373 12.003-12.003C28.007 8.373 22.634 3 16.003 3zm6.728 17.348c-.282.79-1.65 1.52-2.28 1.61-.604.088-1.37.125-2.21-.14-.51-.16-1.165-.378-2.01-.73-3.536-1.52-5.844-5.1-6.02-5.336-.175-.235-1.44-1.92-1.44-3.662 0-1.74.9-2.597 1.22-2.953.32-.355.7-.445.94-.445.235 0 .47 0 .676.01.218.01.51-.084.8.61.282.678.96 2.35 1.04 2.52.08.17.14.38.03.61-.11.235-.165.38-.33.58-.165.2-.347.45-.495.605-.165.165-.338.345-.145.68.195.335.87 1.435 1.87 2.32 1.29 1.14 2.38 1.49 2.71 1.66.33.165.52.14.72-.085.2-.23.82-.96 1.04-1.29.22-.33.44-.275.75-.165.31.11 1.95.92 2.28 1.085.33.165.55.25.63.39.085.14.085.79-.2 1.58z" />
                            </svg>
                        </a>

                    </div>


                </div>
            </div>
        </div>
    </section>

@endsection
