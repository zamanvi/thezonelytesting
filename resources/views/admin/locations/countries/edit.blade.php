@extends('layouts.admin2')
@section('title', 'Edit Country')
@section('content')
    <div class="mt-5 pt-4">
        <div class="row g-4">

            {{-- LEFT: Country List --}}
        @include('admin.locations.countries.component')

            {{-- RIGHT: Edit Country Form --}}
            <div class="col-lg-6">
                <div class="section-card">

                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center p-4">
                        <h5 class="mb-0">
                            <i class="fas fa-edit me-2"></i> Edit Country
                        </h5>
                        <a href="{{ route('admin.countries.create') }}" class="btn btn-light btn-sm">
                            <i class="fas fa-plus me-1"></i> Create New Country
                        </a>
                    </div>

                    <div class="card-body p-4">
                        <form method="POST" action="{{ route('admin.countries.update', $country->id) }}">
                            @csrf
                            @method('PUT')

                            {{-- Title --}}
                            <div class="mb-3">
                                <label class="form-label" for="title">Country Title</label>
                                <input type="text" name="title" id="title" class="form-control"
                                    value="{{ old('title', $country->title) }}">
                                @error('title')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            {{-- Slug --}}
                            <div class="mb-3">
                                <label class="form-label" for="slug">Country Slug</label>
                                <input type="text" name="slug" id="slug" class="form-control"
                                    value="{{ old('slug', $country->slug) }}">
                                @error('slug')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            {{-- Status --}}
                            <div class="form-check mb-4">
                                <input type="hidden" name="status" value="0">
                                <input type="checkbox" name="status" value="1" class="form-check-input"
                                    id="status" {{ old('status', $country->status) ? 'checked' : '' }}>
                                <label class="form-check-label" for="status">Active</label>
                            </div>

                            <div class="text-end">
                                <button type="reset" class="btn btn-secondary me-2">Cancel</button>
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-save me-1"></i> Update
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
