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
                    <a href="mailto:contact@zonelyleads.com" class="text-teal-700 hover:underline">
                        contact@zonelyleads.com
                    </a>
                </p>
            </div>
        </section>
    </main>

@endsection
