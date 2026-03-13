@extends('layouts.admin2')
@section('title', 'Country Details')

@section('content')
<div class="mt-5 pt-4">
    <div class="row g-4">

        {{-- LEFT: Country List --}}
        @include('admin.locations.countries.component')

        {{-- RIGHT: Category Details --}}
        <div class="col-lg-6">
            <div class="section-card">

                <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center p-4">
                    <h5 class="mb-0">
                        <i class="fas fa-folder-open me-2"></i>
                        Country: <span class="text-white">{{ $country->title }}</span>
                    </h5>
                    <div>
                        <a href="{{ route('admin.countries.create') }}" class="btn btn-light btn-sm me-2">
                            <i class="fas fa-plus me-1"></i> Create New Country
                        </a>
                    </div>
                </div>

                <div class="card-body p-4">
                    <h5 class="mb-3">
                        <strong>Country Title:</strong>
                        <span class="text-primary">{{ $country->title }}</span>
                    </h5>

                    <h5 class="mb-3">
                        <strong>Country Slug:</strong>
                        <span class="text-primary">{{ $country->slug }}</span>
                    </h5>

                    <h5 class="mb-3">
                        <strong>Status:</strong>
                        @if($country->status)
                            <span class="badge bg-success">Active</span>
                        @else
                            <span class="badge bg-danger">Inactive</span>
                        @endif
                    </h5>
                </div>

            </div>
        </div>

    </div>
</div>
@endsection