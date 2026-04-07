@extends('frontend.layouts._app')
@section('title', 'Contact Us')
@section('content')

<main class="mt-20 max-w-5xl mx-auto px-6 pb-10 space-y-6">

    <!-- Page Header -->
    <div>
        <h1 class="text-2xl font-bold mb-2">Contact Us</h1>
        <p class="text-slate-600 leading-relaxed">
            We’re here to help. Reach out to us using any of the methods below.
        </p>
    </div>

    <!-- Contact Information -->
    <section class="bg-white rounded-[2rem] p-10 border border-slate-100 shadow-sm space-y-6">
        <div>
            <h2 class="text-xl font-bold mb-2">Email</h2>
            <p class="text-slate-600 leading-relaxed">
                <a href="mailto:norozzaman996@gmail.com" class="text-blue-600 hover:underline">
                    norozzaman996@gmail.com
                </a>
            </p>
        </div>

        <div>
            <h2 class="text-xl font-bold mb-2">Phone (United States)</h2>
            <p class="text-slate-600 leading-relaxed">
                <a href="tel:+15615557689" class="text-blue-600 hover:underline">
                    561-555-7689
                </a>
            </p>
        </div>

        <div>
            <h2 class="text-xl font-bold mb-2">International Phone</h2>
            <p class="text-slate-600 leading-relaxed">
                <a href="tel:+15615557689" class="text-blue-600 hover:underline">
                    +1 561-555-7689
                </a>
            </p>
        </div>
    </section>

    <!-- WhatsApp CTA -->
    <section class="bg-white rounded-[2rem] p-10 border border-slate-100 shadow-sm text-center">
        <h2 class="text-2xl font-bold mb-3">Chat with Us on WhatsApp</h2>
        <p class="text-slate-600 mb-6">
            Get fast support directly through WhatsApp.
        </p>

        <a href="https://wa.me/8801826192179"
           target="_blank"
           rel="noopener"
           class="inline-flex items-center gap-3 px-8 py-4 bg-green-600 text-white font-semibold rounded-xl hover:bg-green-700 transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 0C5.373 0 0 5.373 0 12c0 2.116.553 4.164 1.6 5.97L0 24l6.262-1.64A11.95 11.95 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0z"/>
            </svg>
            Contact on WhatsApp
        </a>
    </section>

</main>

@endsection
