@php
    $meta_title = $meta_title;
    $meta_description = $meta_description;
    $meta_keywords = $meta_keywords;
@endphp
@extends('frontend.layouts._app')
@section('title', $meta_title ?? 'Zonely')
@section('content')
    <div class="container py-2">
        <div class="row">
            <form class="col-md-12 p-0 m-0" action="{{ route('frontend.search') }}" method="GET">
                <div class="input-group w-100">
                    <input class="form-control" type="search" name="q" placeholder="Search..." aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-success" type="submit">Search</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="row mt-1">
            @foreach ($users as $user)
                <div class="col-lg-3 col-md-4 col-sm-6 p-1">
                    <div class="team-card shadow-sm rounded-3">
                        <a href="{{ route('frontend.attorney.show', $user->slug) }}">
                            <h4 class="text-center team-name">{{ $user->title }}</h4>
                        </a>
                        <div class="team-photo">
                            <img src="{{ $user->profile_photo }}"
                                onerror="this.onerror=null;this.src='{{ asset('images/user.png') }}';"
                                class="img-fluid rounded-circle">
                        </div>
                        <div class="button-details">
                            <a href="{{ route('frontend.attorney.show', $user->slug) }}">Details</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-4">
            {{ $users->links() }}
        </div>
    </div>
@endsection

@section('css')
<style>
    .col-lg-3,
    .col-md-4,
    .col-sm-6 {
        display: flex;
        flex-direction: column;
    }

    /* Team card container */
    .team-card {
        background: #fff;
        border-top-left-radius: 50px;
        border-bottom-right-radius: 50px;
        border: 1px solid #ddd;
        padding: 1rem 0rem 0rem 0rem;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        height: 100%;
        transition: all 0.3s ease;
    }

    .team-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        border-color: #00ae3d;
    }

    /* Title */
    .team-name {
        font-weight: 600;
        color: #002147;
        margin-bottom: 0.5rem;
        text-align: center;
        font-size: 1.1rem;
        padding: 0rem .5rem;
        transition: color 0.3s ease;
        min-height: 4.2rem;
        display: flex;
        align-items: center;
        justify-content: center;
        line-height: 1.3;
        overflow: hidden;
    }

    .team-card:hover .team-name {
        color: #00ae3d;
    }

    /* Image */
    .team-photo {
        margin: 0 auto 0.8rem auto;
        width: 180px;
        height: 180px;
        overflow: hidden;
        border-radius: 50%;
        border: 3px solid #f0f0f0;
        background: #fff;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .team-photo img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .team-photo img:hover {
        transform: scale(1.08);
        cursor: pointer;
    }

    /* Details button */
    .button-details {
        width: 50%;
        transform: translateX(100%);
        background-color: #ff0000;
        text-align: center;
        border-bottom-right-radius: 50px;
        transition: all 0.3s ease;
    }

    .button-details a {
        display: block;
        color: #fff;
        font-weight: 600;
        padding: 0.6rem 0;
        font-size: 0.95rem;
        text-transform: uppercase;
    }

    .button-details:hover {
        background-color: #00ae3d;
    }

    /* Search bar */
    input[type="search"] {
        border-radius: 50px 0 0 50px;
        border: 1px solid #ccc;
        padding: 0.6rem 1rem;
        transition: all 0.3s ease;
    }

    input[type="search"]:focus {
        border-color: #00ae3d;
        box-shadow: 0 0 8px rgba(0, 174, 61, 0.2);
        outline: none;
    }

    .input-group-append .btn {
        border-radius: 0 50px 50px 0;
        background-color: #00ae3d;
        border: none;
        color: #fff;
        transition: all 0.3s ease;
    }

    .input-group-append .btn:hover {
        background-color: #002147;
    }

    /* Remove underline globally */
    a {
        text-decoration: none !important;
    }
</style>
@endsection
