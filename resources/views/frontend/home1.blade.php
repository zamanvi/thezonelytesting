@php
    $meta_title = $data['sub_title'];
    $meta_description = $data['que'] . ' ' . $data['answer'];
@endphp
@extends('frontend.layouts._app')
@section('title', $data['sub_title'])
@section('content')
    <div class="container-fluid" style="position: relative;">
        <div class="content text-center">

            <div class="row">
                @if ($data['is_img'])
                    <img class="video-background" src="{{ $data['link'] }}" alt="">
                @else
                    <video class="video-background" src="{{ $data['link'] }}" autoplay muted loop></video>
                @endif
            </div>
            
            <div class="row align-items-center justify-content-center position-relative">
                <div class="col-lg-12 col-md-8 col-sm-10 text-center"
                    style="margin: 10px 0; padding: 10px; background-color: #{{ get_color('page_title_bg')}}">
                    <h1 style="color: #{{ get_color('page_title_text')}}; font-weight: bold">{{ $data['sub_title'] }}</h1>
                    <a href="{{ route('frontend.contact') }}" style="background-color: #{{ get_color('page_title_button_bg')}}" class="btn btn-lg text-white">
                        <span style="font-size: 30px; font-weight: bold;">Contact Us</span>
                    </a>
                </div>
            </div>
        </div>
        <div style="margin-top: 70px; background-color: #{{ get_color('marquee_bg')}}; color: #{{ get_color('marquee_text')}}" class="row mb-4">
            <marquee behavior="" direction="rtl"><span
                    style="font-size: 40px; padding: 20px; font-weight: bold">{{ $data['marque'] }}</span></marquee>
        </div>

        <div class="row mb-4" style="margin-top: 70px;">
            <div class="">
                <h2 style="text-align:center; color: #{{ get_color('question_text')}};">{{ $data['que'] }}</h2>
                <a href="{{ $data['img2_link'] }}">
                    <img src="{{ $data['img2_link'] }}" class="center" alt="">
                </a>
            </div>
            <div style="text-align: center; max-width: 80%; margin: 0 auto; display: block;">
                <b style="font-size: 25px;"> <br>{{ $data['answer'] }}</b>
            </div>
        </div>
        @isset($data['description'])
            @include('frontend.pages.' . $data['page'])
        @endisset
    </div>
@endsection

@section('css')
    <style>
        .center {
            width: 50%;
            display: block;
            margin-left: auto;
            margin-right: auto;
            text-align: center;
            border-radius: 20px;
        }
        li{
            font-size: 25px;
        }
        a{
            font-size: 25px;
        }
    </style>
@endsection