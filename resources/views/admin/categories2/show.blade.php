@extends('layouts.admin2')
@section('title', 'Category: ' . $category->title)

@section('content')
<div class="mt-5 pt-4">
    <div class="row g-4">

        {{-- LEFT: Mother category list --}}
        @include('admin.categories2.component')

        {{-- RIGHT: Category detail + sub-categories --}}
        <div class="col-lg-6">

            {{-- Info card --}}
            <div class="section-card mb-4">
                <div class="card-header bg-dark text-white p-4 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class="fas fa-folder-open me-2"></i>
                        {{ $category->title }}
                    </h5>
                    <div class="d-flex gap-2">
                        <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-sm btn-outline-light">
                            <i class="fas fa-edit me-1"></i> Edit
                        </a>
                        <a href="{{ route('admin.categories.index') }}" class="btn btn-sm btn-light">
                            <i class="fas fa-arrow-left me-1"></i> Back
                        </a>
                    </div>
                </div>
                <div class="card-body p-4">
                    <div class="row g-3">
                        <div class="col-6">
                            <div class="p-3 bg-light rounded-3">
                                <div class="text-muted small mb-1">Slug</div>
                                <code>{{ $category->slug }}</code>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-3 bg-light rounded-3">
                                <div class="text-muted small mb-1">Status</div>
                                <span class="badge {{ $category->is_active ? 'bg-success' : 'bg-secondary' }} fs-6">
                                    {{ $category->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-3 bg-light rounded-3">
                                <div class="text-muted small mb-1">Sub-categories</div>
                                <strong class="fs-5">{{ $category->children_count ?? $category->children->count() }}</strong>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-3 bg-light rounded-3">
                                <div class="text-muted small mb-1">Created</div>
                                <span class="small">{{ $category->created_at?->format('M d, Y') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Sub-categories --}}
            <div class="section-card">
                <div class="card-header bg-primary text-white p-4 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class="fas fa-sitemap me-2"></i>
                        Sub-categories
                        <span class="badge bg-white text-primary ms-2">{{ $category->children->count() }}</span>
                    </h5>
                    {{-- Quick add sub-cat button --}}
                    <button class="btn btn-sm btn-outline-light" type="button"
                            data-bs-toggle="collapse" data-bs-target="#addSubForm">
                        <i class="fas fa-plus me-1"></i> Add Sub
                    </button>
                </div>

                {{-- Inline add sub-category form --}}
                <div class="collapse" id="addSubForm">
                    <div class="p-4 border-bottom bg-light">
                        <form method="POST" action="{{ route('admin.categories.store') }}" class="row g-2 align-items-end">
                            @csrf
                            <input type="hidden" name="parent_id" value="{{ $category->id }}">
                            <div class="col">
                                <input type="text" name="title" class="form-control form-control-sm"
                                       placeholder="Sub-category title" required>
                            </div>
                            <div class="col-auto">
                                <button type="submit" class="btn btn-primary btn-sm">
                                    <i class="fas fa-save me-1"></i> Save
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card-body p-0">
                    @if($category->children->count())
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Slug</th>
                                <th class="text-center">Status</th>
                                <th width="10"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($category->children as $i => $child)
                            <tr>
                                <td class="text-muted small">{{ $i + 1 }}</td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <i class="fas fa-folder text-info" style="font-size:13px"></i>
                                        <span class="fw-semibold">{{ $child->title }}</span>
                                    </div>
                                </td>
                                <td><code class="small text-muted">{{ $child->slug }}</code></td>
                                <td class="text-center">
                                    <span class="badge {{ $child->is_active ? 'bg-success' : 'bg-secondary' }}">
                                        {{ $child->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-light" type="button" data-bs-toggle="dropdown">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                                            <li>
                                                <a class="dropdown-item" href="{{ route('admin.categories.edit', $child->id) }}">
                                                    <i class="fas fa-edit me-2 text-primary"></i> Edit
                                                </a>
                                            </li>
                                            <li><hr class="dropdown-divider"></li>
                                            <li>
                                                <form action="{{ route('admin.categories.destroy', $child->id) }}"
                                                      method="POST"
                                                      onsubmit="return confirm('Delete ' + {{ @json($child->title) }} + '?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item text-danger">
                                                        <i class="fas fa-trash me-2"></i> Delete
                                                    </button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                    <div class="text-center py-5 text-muted">
                        <i class="fas fa-sitemap fa-2x mb-3 opacity-25"></i>
                        <p class="mb-0 small">No sub-categories yet.</p>
                        <button class="btn btn-sm btn-outline-primary mt-2"
                                data-bs-toggle="collapse" data-bs-target="#addSubForm">
                            Add first sub-category
                        </button>
                    </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
