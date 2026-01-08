@extends('frontend.layouts._app')
@section('title', 'Zonely')
@php
    $meta_title = $meta_title;
    $meta_description = $meta_description;
    $meta_keywords = $meta_keywords;
@endphp
@section('content')
    <div class="container-fluid p-0 mt-2">
        <div class="row">
            @forelse ($blogs as $blog)
                <div class="col-md-4 mb-2">
                    <div class="card h-100 shadow-sm">
                        @if ($blog->image_path)
                            <img src="{{ get_file($blog->image_path) }}" class="card-img-top" alt="{{ $blog->name }}" style="height: 250px; object-fit: cover;">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $blog->name }}</h5>
                            <a href="{{ route('blog.show', $blog->slug) }}" class="btn btn-primary">Read More</a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center">
                    <p>No blog posts found.</p>
                </div>
            @endforelse
        </div>
        <div class="mt-2">
            {{ $blogs->links() }}
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