@extends('frontend.layouts._app')
@section('title', 'Help & Support')
@section('content')

    <main class="mt-20 max-w-5xl mx-auto pt-6 px-6 pb-10 space-y-6">
        <!-- Page Header -->
        <div>
            <h1 class="text-2xl font-bold mb-2">Help & Support</h1>
            <p class="text-slate-600 leading-relaxed">
                Find answers to common questions or get in touch with our support team.
            </p>
        </div>

        <!-- FAQ 1 -->
        <section class="bg-white rounded-[2rem] p-10 border border-slate-100 shadow-sm">
            <h2 class="text-xl font-bold mb-3">How does Zonely help my local business grow in 2026?</h2>
            <p class="text-slate-600 leading-relaxed">
                Zonely is a specialized SaaS platform that takes your offline local business and gives it a high-performance
                digital presence in under 1 minute, focusing on capturing "near-me" search intent to drive more calls and
                bookings.
            </p>
        </section>

        <!-- FAQ 2 -->
        <section class="bg-white rounded-[2rem] p-10 border border-slate-100 shadow-sm">
            <h2 class="text-xl font-bold mb-3">Why do I need a Zonely page if I already have a Google Business Profile?</h2>
            <p class="text-slate-600 leading-relaxed">
                While Google shows where you are, a Zonely page shows who you are; it acts as a dedicated landing page that
                Google’s AI uses to verify your services, which can significantly improve your ranking in the local map
                pack.
            </p>
        </section>

        <!-- FAQ 3 -->
        <section class="bg-white rounded-[2rem] p-10 border border-slate-100 shadow-sm">
            <h2 class="text-xl font-bold mb-3">Is the initial website really free to use?</h2>
            <p class="text-slate-600 leading-relaxed">
                Yes, we build a professional demo page using your existing public data at no cost to you, allowing you to
                activate a branded website link on your Google profile immediately without any upfront investment.
            </p>
        </section>

        <!-- FAQ 4 -->
        <section class="bg-white rounded-[2rem] p-10 border border-slate-100 shadow-sm">
            <h2 class="text-xl font-bold mb-3">How does the "Pay-Per-Lead" model work for my business?</h2>
            <p class="text-slate-600 leading-relaxed">
                Our Phase 1 strategy is designed to be risk-free: you only pay when we deliver a verified, high-quality lead
                (a real person asking for your service), ensuring you never waste money on empty clicks or bot traffic.
            </p>
        </section>

        <!-- FAQ 5 -->
        <section class="bg-white rounded-[2rem] p-10 border border-slate-100 shadow-sm">
            <h2 class="text-xl font-bold mb-3">What exactly is the "Premium Dashboard" mentioned in the outreach?</h2>
            <p class="text-slate-600 leading-relaxed">
                The Premium Dashboard is an advanced management tool that tracks your visitors, records direct inquiries,
                and provides real-time analytics so you can respond to potential customers faster than your competitors.
            </p>
        </section>

        <!-- FAQ 6 -->
        <section class="bg-white rounded-[2rem] p-10 border border-slate-100 shadow-sm">
            <h2 class="text-xl font-bold mb-3">Can I manage and update my services and photos myself?</h2>
            <p class="text-slate-600 leading-relaxed">
                Absolutely; once you activate your account with your email, you have full control to update your business
                hours, add new service photos, or change your contact information at any time.
            </p>
        </section>

        <!-- FAQ 7 -->
        <section class="bg-white rounded-[2rem] p-10 border border-slate-100 shadow-sm">
            <h2 class="text-xl font-bold mb-3">How does Zonely ensure the leads I receive are high-quality?</h2>
            <p class="text-slate-600 leading-relaxed">
                We use lead verification and call tracking to filter out spam, ensuring that the notifications you receive
                on your dashboard represent genuine customers ready to hire a local expert.
            </p>
        </section>

        <!-- FAQ 8 -->
        <section class="bg-white rounded-[2rem] p-10 border border-slate-100 shadow-sm">
            <h2 class="text-xl font-bold mb-3">What happens after I activate a paid growth campaign?</h2>
            <p class="text-slate-600 leading-relaxed">
                When you switch to a paid campaign, we use targeted digital marketing to push your business to the top of
                local searches, which typically increases order volume by up to 10× for service providers like lawyers or
                tow trucks.
            </p>
        </section>

        <!-- FAQ 9 -->
        <section class="bg-white rounded-[2rem] p-10 border border-slate-100 shadow-sm">
            <h2 class="text-xl font-bold mb-3">Does using Zonely require any technical knowledge?</h2>
            <p class="text-slate-600 leading-relaxed">
                None at all; Zonely is built for "non-tech" owners—we handle the hosting, SEO, and technical updates so you
                can focus entirely on serving your clients.
            </p>
        </section>

        <!-- FAQ 10 -->
        <section class="bg-white rounded-[2rem] p-10 border border-slate-100 shadow-sm">
            <h2 class="text-xl font-bold mb-3">What is the long-term vision for businesses on the Zonely platform?</h2>
            <p class="text-slate-600 leading-relaxed">
                Beyond 2026, Zonely will evolve into a full ecosystem offering automated workflow tools and
                industry-specific widgets, moving from a simple lead-gen tool to a complete "Shopify-style" management
                system for your local service business.
            </p>
        </section>

        <!-- Contact CTA -->
        <section class="bg-white rounded-[2rem] p-10 border border-slate-100 shadow-sm text-center">
            <h2 class="text-2xl font-bold mb-3">Still need help?</h2>
            <p class="text-slate-600 mb-6">
                Our support team is ready to assist you anytime.
            </p>
            <a href="{{ route('frontend.contact') }}"
                class="inline-flex items-center gap-2 px-6 py-3 bg-green-600 text-white font-semibold rounded-xl hover:bg-green-700 transition">
                Contact Us
            </a>
        </section>
    </main>

@endsection
