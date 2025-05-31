@extends('frontend.layouts._app')
@section('title', 'Help - Tow Now')
@section('content')
<div class="container py-5" style="min-height: 80vh;">
    <!-- Help Page Header -->
    <div class="text-center mb-5">
        <h1 class="fw-bold">How Can We Help You?</h1>
        <p class="lead">Find answers to common questions or contact us for further assistance.</p>
    </div>

    <!-- FAQ Section -->
    <div class="row mb-5">
        <div class="col-md-12">
            <div class="accordion" id="faqAccordion">
                <!-- FAQ 1 -->
                <div class="accordion-item mb-3">
                    <h2>
                        How do I book a towing service?
                    </h2>
                    <div>
                        You can book a towing service through our website or app by providing your location and selecting the required service.
                    </div>
                </div>
                <!-- FAQ 3 -->
                <div class="accordion-item mb-3">
                    <h2>
                        What should I do if I can't find a tow truck near me?
                    </h2>
                    <div>
                        If you’re unable to find a nearby tow truck, contact us directly for assistance, and we’ll guide you through alternative options.
                    </div>
                </div>
                <!-- FAQ 4 -->
                <div class="accordion-item mb-3">
                    <h2>
                        How long will it take for a tow truck to arrive?
                    </h2>
                    <div>
                        Our tow trucks typically arrive within 30 minutes to an hour, depending on your location and traffic conditions. You can track your tow truck's arrival via our app.
                    </div>
                </div>
                <!-- FAQ 5 -->
                <div class="accordion-item mb-3">
                    <h2>
                        Can I schedule a towing service in advance?
                    </h2>
                    <div >
                        Yes, you can schedule a towing service in advance through our website or app. Choose the time and date that works best for you.
                    </div>
                </div>
                <!-- FAQ 6 -->
                <div class="accordion-item mb-3">
                    <h2>
                        Do you provide roadside assistance in addition to towing?
                    </h2>
                    <div>
                        Yes, we offer roadside assistance services such as flat tire changes, battery jump-starts, and fuel delivery. You can request these services when booking a tow.
                    </div>
                </div>
                <!-- FAQ 7 -->
                <div class="accordion-item mb-3">
                    <h2>
                        Can I cancel my towing request?
                    </h2>
                    <div>
                        Yes, you can cancel your towing request as long as the tow truck hasn’t been dispatched. Cancellations made after dispatch may incur a small fee.
                    </div>
                </div>
                <!-- FAQ 8 -->
                <div class="accordion-item mb-3">
                    <h2>
                        What areas do you serve?
                    </h2>
                    <div>
                        We serve [Insert service area], including [city names or regions]. Check our service map on the website to see if we cover your location.
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Contact Options -->
    <div class="text-center">
        <h3>Still need help?</h3>
        <a href="{{ route('frontend.contact') }}" class="btn btn-success btn-lg mt-3">
            <i class="bi bi-whatsapp"></i> Contact Us
        </a>
    </div>
</div>
@endsection
@section('css')
    <style>
        a{
            font-size: 25px;
        }
    </style>
@endsection