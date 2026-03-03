@extends('layouts.admin2')

@section('title', 'Category Panel')

@section('content')
<div class="mt-5 pt-4">
    <div class="row g-4">

        {{-- LEFT: Category List --}}
        @include('admin.categories2.component')

        {{-- RIGHT: Create Category Form --}}
        <div class="col-lg-6">
            <div class="section-card">

                <div class="card-header bg-primary text-white p-4">
                    <h5 class="mb-0">
                        <i class="fas fa-plus me-2"></i>
                        Create New Category
                    </h5>
                </div>

                <div class="card-body p-4">
                    <form method="POST" action="{{ route('admin.categories.store') }}">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Category Title</label>
                            <input required type="text" name="title" class="form-control"
                                   placeholder="Enter category title" value="{{ old('title') }}">
                            @error('title')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Category Slug</label>
                            <input type="text" name="slug" class="form-control"
                                   placeholder="category-slug" value="{{ old('slug') }}">
                            @error('slug')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="text-end mt-4">
                            <button type="reset" class="btn btn-secondary">
                                Cancel
                            </button>
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-save me-1"></i> Save Category
                            </button>
                        </div>

                    </form>
                </div>

            </div>
        </div>

    </div>
</div>
@endsection