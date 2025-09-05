@php
    $meta_title = $user->name . ' - ' . $user->designation;
    $meta_description = $user->name  . ' - ' . $user->designation . ' - ' . ($user->about ?? '') ;
@endphp
@extends('frontend.layouts._app')
@section('title', $meta_title)

@section('content')
<style>
    .profile-header {
        background-color: #0B1E3D;
        color: #fff;
        padding: 3rem 1rem;
    }
    .profile-img {
        width: 350px;
        height: 450px;
        border: 4px solid #fff;
        border-radius: 5%;
        object-fit: cover;
    }
    .name-designation{
        margin-left: 50px
    }
    .card-custom {
        border: none;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
    .card-header-custom {
        background-color: #B63A55;
        color: #fff;
        font-weight: 600;
        border-top-left-radius: 12px;
        border-top-right-radius: 12px;
    }
    .sidebar {
        background-color: #0B1E3D;
        color: #fff;
        border-top-right-radius: 24px;
        border-bottom-left-radius: 24px;
        padding: 2rem;
        height: 100%;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }
    .sidebar h5 {
        font-weight: 600;
        margin-bottom: 1rem;
    }
    .connect-icon {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: #fff;
        color: #0B1E3D;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    li {
        list-style: none;
    }
</style>

<!-- Top Banner -->
<div class="profile-header">
    <div class="container d-flex flex-column flex-md-row align-items-center gap-4">
        <!-- Profile Image -->
        <img src="{{ $user->profile_photo ? asset($user->profile_photo) : asset('assets/images/user/default.png') }}"
             alt="{{ $user->name }}" 
             class="profile-img">

        <!-- Name & Designation -->
        <div class="text-center text-md-start name-designation">
            <h1 class="fw-bold">{{ $user->name }}</h1>
            <p class="fs-5">{{ $user->designation }}</p>
        </div>
    </div>
</div>

<!-- Main Content -->
<div class="container my-2 p-0">
    <div class="row g-2">
        
        <!-- Left Column -->
        <div class="col-md-8">
            <!-- About -->
            <div class="card card-custom mb-4">
                <div class="card-header card-header-custom">
                    About {{ $user->name }}
                </div>
                <div class="card-body text-secondary">
                    {{ $user->about ?? 'No about information available.' }}
                </div>
            </div>

            <!-- Education -->
            <div class="card card-custom mb-4">
                <div class="card-header card-header-custom">Education</div>
                <div class="card-body">
                    <ul class="mb-0 ps-3 text-secondary">
                        @forelse($user->educations as $edu)
                            <li>{{ $edu->name }}</li>
                        @empty
                            <li>No education records available.</li>
                        @endforelse
                    </ul>
                </div>
            </div>

            <!-- Professional Membership -->
            <div class="card card-custom mb-4">
                <div class="card-header card-header-custom">Professional Membership</div>
                <div class="card-body">
                    <ul class="mb-0 ps-3 text-secondary">
                        @forelse($user->memberships as $membership)
                            <li>{{ $membership->name }}</li>
                        @empty
                            <li>No membership records available.</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>

        <!-- Right Column (Sidebar) -->
        <div class="col-md-4">
            <div class="sidebar">
                <!-- Languages -->
                <div class="mb-4">
                    <h5>Languages</h5>
                    <ul class="mb-0 ps-3">
                        @forelse($user->languages as $language)
                            <li>{{ $language->name }}</li>
                        @empty
                            <li>No languages listed.</li>
                        @endforelse
                    </ul>
                </div>

                <!-- Connect Information -->
                <div>
                    <h5>Contact Information</h5>
                    <div class="d-flex gap-3 mt-2">
                        <ul class="mb-0 ps-3">
                            @forelse($user->contacts as $contact)
                                <li>{{ $contact->value }}</li>
                            @empty
                                <li>No contact information available.</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
