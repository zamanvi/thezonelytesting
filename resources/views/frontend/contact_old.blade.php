@extends('frontend.layouts._app')
@section('title', 'Contact Us')
@section('content')
    <div class="container py-5 text-center" style="min-height: 80vh;">
        <h1 class="mb-4">Contact Us</h1>

        <div class="contact-info">
            <div class="row">
                <p class="col-lg-12"><strong>Email:</strong> <a href="mailto:norozzaman996@gmail.com">norozzaman996@gmail.com</a></p>
                <p class="col-lg-12"><strong>Local (United States) Phone:</strong> 
                    <a href="tel:+15615557689">
                        561-555-7689
                    </a>
                </p>
                <p class="col-lg-12"><strong>International (United States) Phone:</strong> 
                    <a href="tel:+15615557689">
                        +1 561-555-7689
                    </a>
                </p>
            </div>
        </div>

        <div class="mt-4">
            <a href="https://wa.me/+8801826192179" target="_blank" class="btn btn-success btn-lg">
                <i class="fab fa-whatsapp"></i> Contact Us on WhatsApp
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