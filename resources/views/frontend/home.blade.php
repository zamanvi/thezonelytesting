@php
    $meta_title = $data['sub_title'];
    $meta_description = $data['que'] . ' ' . $data['answer'];
@endphp
@extends('frontend.layouts._app')
@section('title', $data['sub_title'])
@section('content')
    <div class="container py-4">
        <div class="row">
            @foreach ($users as $user)
                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                    <div class="team-card text-center p-3 shadow-sm rounded-3">
                        <h5 class="team-name">{{ $user->name }}</h5>
                        <p class="team-title">{{ $user->designation }}</p>
                        <div class="team-photo mb-3">
                            <img src="{{ $user->profile_photo }}" onerror="this.onerror=null;this.src='{{ asset('images/user.png') }}';" class="img-fluid rounded-circle p-2">
                        </div>
                        {{-- <a href="{{ route('attorney.show', $attorney->slug) }}" class="btn btn-details">+ Details</a> --}}
                        <a href="#" class="btn btn-details">Details</a>
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
        .team-card {
            background: #fff;
            border-radius: 20px;
            border: 1px solid #ddd;
            height: 100%;
        }

        .team-card:hover {
            background: transparent;
        }

        .team-name {
            font-size: 1.1rem;
            font-weight: 600;
            color: #002147;
            margin-bottom: 0.3rem;
        }

        .team-card:hover .team-name {
            color: #00ae3d;
        }

        .team-title {
            font-size: 0.9rem;
            color: #555;
            margin-bottom: 1rem;
        }

        .team-card:hover .team-title {
            color: #00ae3d;
        }

        .team-photo img {
            width: 160px;
            height: 160px;
            object-fit: cover;
            background: white;
        }
        .team-photo img:hover {
            cursor: pointer;
        }

        .btn-details {
            background-color: #d62828;
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
