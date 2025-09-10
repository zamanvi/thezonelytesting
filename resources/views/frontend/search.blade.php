@php
    $meta_title = $meta_title;
    $meta_description = $meta_description;
    $meta_keywords = $meta_keywords;
@endphp
@extends('frontend.layouts._app')
@section('title', $meta_title ?? 'Search Results')
@section('content')
    <div class="container py-2">
        <div class="row mb-1">
            <div class="col-12 text-center">
                <h2 class="fw-bold text-dark">
                    Search Results 
                    @if($query)
                        for <span class="text-success">"{{ $query }}"</span>
                    @endif
                </h2>
                <p class="text-muted">{{ $users->total() }} profiles found</p>
            </div>
        </div>
        <div class="row">
            @foreach ($users as $user)
                <div class="col-lg-3 col-md-4 col-sm-6 mb-2 p-1">
                    <div class="team-card text-center shadow-sm rounded-3"> 
                        <a href="{{ route('frontend.attorney.show', $user->slug) }}"><h4 class="team-name">{{ $user->title }}</h4></a>
                        {{-- <a href="{{ route('frontend.attorney.show', $user->slug) }}"><h6 class="team-title">{{ $user->designation }}</h6></a> --}}
                        <div class="team-photo mb-3">
                            <img src="{{ $user->profile_photo }}" onerror="this.onerror=null;this.src='{{ asset('images/user.png') }}';" class="img-fluid rounded-circle p-2">
                        </div>
                        <a href="{{ route('frontend.attorney.show', $user->slug) }}" class="btn btn-details">Details</a>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-1">
            {{ $users->links() }}
        </div>
    </div>
@endsection

@section('css')
    <style>
        .team-card {
            background: #fff;
            border-top-left-radius: 50px;
            border-bottom-right-radius: 50px;
            border: 1px solid #ddd;
            padding: 1.5rem 1rem;
        }
        a {
            text-decoration: none !important;
        }

        .team-card:hover {
            background: transparent;
        }

        .team-name {
            font-weight: 600;
            color: #002147;
            margin-bottom: 0.3rem;
        }

        .team-card:hover .team-name {
            color: #00ae3d;
        }

        .team-title {
            color: #555;
            margin-bottom: 1rem;
        }

        .team-card:hover .team-title {
            color: #00ae3d;
        }

        .team-photo img {
            width: 100%;
            height: 250px;
            object-fit: fill;
            background: white;
        }
        .team-photo img:hover {
            cursor: pointer;
        }

        .btn-details {
            background-color: #ff0000;
            color: #fff;
            font-weight: 500;
            border-radius: 8px;
            padding: 6px 16px;
            text-transform: uppercase;
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }

        .btn-details:hover {
            background-color: #fff;
            color: #00ae3d;
        }
    </style>
@endsection
