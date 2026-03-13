@extends('layouts.admin2')
@section('title', 'Edit Category')
@section('content')
    <div class="mt-5 pt-4">
        <div class="row g-4">

            {{-- LEFT: Category List --}}
            @include('admin.categories2.component')

            {{-- RIGHT: Edit Category Form --}}
            <div class="col-lg-6">
                <div class="section-card">

                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center p-4">
                        <h5 class="mb-0">
                            <i class="fas fa-edit me-2"></i> Edit Category
                        </h5>
                        <a href="{{ route('admin.categories.create') }}" class="btn btn-light btn-sm">
                            <i class="fas fa-plus me-1"></i> Create
                        </a>
                    </div>

                    <div class="card-body p-4">
                        <form method="POST" action="{{ route('admin.categories.update', $category->id) }}">
                            @csrf
                            @method('PUT')

                            {{-- Title --}}
                            <div class="mb-3">
                                <label class="form-label" for="title">Category Title</label>
                                <input type="text" name="title" id="title" class="form-control"
                                    value="{{ old('title', $category->title) }}">
                                @error('title')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            {{-- Slug --}}
                            <div class="mb-3">
                                <label class="form-label" for="slug">Category Slug</label>
                                <input type="text" name="slug" id="slug" class="form-control"
                                    value="{{ old('slug', $category->slug) }}">
                                @error('slug')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Parent Category</label>
                                <select name="parent_id" class="form-select">
                                    <option value="">-- No Parent (Top Level) --</option>
                                    @foreach ($allCategories as $parent)
                                        @if ($parent->id != $category->id)
                                            <option value="{{ $parent->id }}"
                                                {{ old('parent_id', $category->parent_id) == $parent->id ? 'selected' : '' }}>
                                                {{ str_repeat('— ', $parent->level) }} {{ $parent->title }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                            {{-- Status --}}
                            <div class="form-check mb-4">
                                <input type="hidden" name="is_active" value="0">
                                <input type="checkbox" name="is_active" value="1" class="form-check-input"
                                    id="is_active" {{ old('is_active', $category->is_active) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_active">Active</label>
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
