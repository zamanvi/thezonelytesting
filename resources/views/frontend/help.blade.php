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
        <h2 class="text-xl font-bold mb-3">How do I book a towing service?</h2>
        <p class="text-slate-600 leading-relaxed">
            You can book a towing service through our website or mobile app by providing your location
            and selecting the required service.
        </p>
    </section>

    <!-- FAQ 2 -->
    <section class="bg-white rounded-[2rem] p-10 border border-slate-100 shadow-sm">
        <h2 class="text-xl font-bold mb-3">What if I can’t find a tow truck near me?</h2>
        <p class="text-slate-600 leading-relaxed">
            If no tow truck is available nearby, please contact our support team directly.
            We’ll assist you with alternative solutions.
        </p>
    </section>

    <!-- FAQ 3 -->
    <section class="bg-white rounded-[2rem] p-10 border border-slate-100 shadow-sm">
        <h2 class="text-xl font-bold mb-3">How long does it take for a tow truck to arrive?</h2>
        <p class="text-slate-600 leading-relaxed">
            Tow trucks typically arrive within 30 minutes to 1 hour depending on traffic
            and your location. You can track the truck in real-time via our app.
        </p>
    </section>

    <!-- FAQ 4 -->
    <section class="bg-white rounded-[2rem] p-10 border border-slate-100 shadow-sm">
        <h2 class="text-xl font-bold mb-3">Can I schedule a towing service in advance?</h2>
        <p class="text-slate-600 leading-relaxed">
            Yes, you can schedule a towing service in advance by selecting your preferred
            date and time during booking.
        </p>
    </section>

    <!-- FAQ 5 -->
    <section class="bg-white rounded-[2rem] p-10 border border-slate-100 shadow-sm">
        <h2 class="text-xl font-bold mb-3">Do you offer roadside assistance?</h2>
        <p class="text-slate-600 leading-relaxed">
            Yes, we provide roadside assistance services including tire changes,
            battery jump-starts, and fuel delivery.
        </p>
    </section>

    <!-- FAQ 6 -->
    <section class="bg-white rounded-[2rem] p-10 border border-slate-100 shadow-sm">
        <h2 class="text-xl font-bold mb-3">Can I cancel my towing request?</h2>
        <p class="text-slate-600 leading-relaxed">
            You can cancel your request before a tow truck is dispatched.
            Late cancellations may incur a small service fee.
        </p>
    </section>

    <!-- FAQ 7 -->
    <section class="bg-white rounded-[2rem] p-10 border border-slate-100 shadow-sm">
        <h2 class="text-xl font-bold mb-3">What areas do you serve?</h2>
        <p class="text-slate-600 leading-relaxed">
            We operate in selected cities and regions.
            Please check our service map or contact support to confirm availability.
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
