@extends('layouts.admin2')
@section('title', 'Category Details')

@section('content')
<div class="mt-5 pt-4">
    <div class="row g-4">

        {{-- LEFT: Category List --}}
        @include('admin.categories2.component')

        {{-- RIGHT: Category Details --}}
        <div class="col-lg-6">
            <div class="section-card">

                <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center p-4">
                    <h5 class="mb-0">
                        <i class="fas fa-folder-open me-2"></i>
                        Category: <span class="text-white">{{ $category->title }}</span>
                    </h5>
                    <div>
                        <a href="{{ route('admin.categories.create') }}" class="btn btn-light btn-sm me-2">
                            <i class="fas fa-plus me-1"></i> Create
                        </a>
                        <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-light btn-sm">
                            <i class="fas fa-edit me-1"></i> Edit
                        </a>
                    </div>
                </div>

                <div class="card-body p-4">
                    <h5 class="mb-3">
                        <strong>Category Title:</strong>
                        <span class="text-primary">{{ $category->title }}</span>
                    </h5>

                    <h5 class="mb-3">
                        <strong>Category Slug:</strong>
                        <span class="text-primary">{{ $category->slug }}</span>
                    </h5>

                    <h5 class="mb-3">
                        <strong>Status:</strong>
                        @if($category->is_active)
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