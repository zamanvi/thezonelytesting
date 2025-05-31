@extends('frontend.layouts._app')
@section('title', $blog->name)
@php
    $meta_title = $blog->name;
    $meta_description = $blog->short_description;
@endphp
@section('content')
    <div class="container-fluid mt-2">
        <div class="text-center mb-2">
            <h1 style="color: #{{ get_color('page_title_text') }}; font-weight: bold">
                {{ $blog->name }}
            </h1>
        </div>

        @if ($blog->image_path)
            <div class="text-center mb-2">
                <img src="{{ get_file($blog->image_path) }}" class="img-fluid rounded" alt="{{ $blog->name }}" style="max-height: 400px; object-fit: cover;">
            </div>
        @endif

        <div class="mb-1">
            <p>{!! $blog->description !!}</p>
        </div>

        <div class="text-muted">
            <small>Views: {{ $blog->pageview }}</small>
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