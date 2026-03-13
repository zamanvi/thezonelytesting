@extends('layouts.admin2')
@section('title', 'Edit State')
@section('content')
    <div class="mt-5 pt-4">
        <div class="row g-4">

            {{-- LEFT: state List --}}
        @include('admin.locations.states.component')

            {{-- RIGHT: Edit state Form --}}
            <div class="col-lg-6">
                <div class="section-card">

                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center p-4">
                        <h5 class="mb-0">
                            <i class="fas fa-edit me-2"></i> Edit State
                        </h5>
                        <a href="{{ route('admin.countries.states.create', $country) }}" class="btn btn-light btn-sm">
                            <i class="fas fa-plus me-1"></i> Create New State
                        </a>
                    </div>

                    <div class="card-body p-4">
                        <form method="POST" action="{{ route('admin.countries.states.update', [$country, $state]) }}">
                            @csrf
                            @method('PUT')

                            <h4>Country: {{ $country->title }}</h4>

                            {{-- Title --}}
                            <div class="mb-3">
                                <label class="form-label" for="title">State Title</label>
                                <input type="text" name="title" id="title" class="form-control"
                                    value="{{ old('title', $state->title) }}">
                                @error('title')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            {{-- Slug --}}
                            <div class="mb-3">
                                <label class="form-label" for="slug">State Slug</label>
                                <input type="text" name="slug" id="slug" class="form-control"
                                    value="{{ old('slug', $state->slug) }}">
                                @error('slug')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            {{-- Status --}}
                            <div class="form-check mb-4">
                                <input type="hidden" name="status" value="0">
                                <input type="checkbox" name="status" value="1" class="form-check-input"
                                    id="status" {{ old('status', $state->status) ? 'checked' : '' }}>
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
