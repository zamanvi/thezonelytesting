@extends('layouts.admin2')

@section('title')
    Edit Blog
@endsection

@section('content')
<div class="mt-5 pt-4">
    <div class="row g-4">

        <!-- LEFT SIDE: Blog List -->
        @include('admin.blog2.component')

        <!-- RIGHT SIDE: Edit Blog -->
        <div class="col-lg-6">
            <div class="section-card">

                <!-- Header -->
                <div class="card-header bg-warning text-dark p-4 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class="fas fa-edit me-2"></i>
                        Edit Blog
                    </h5>

                    <a href="{{ route('admin.blogs.create') }}"
                       class="btn btn-sm btn-dark">
                        <i class="fas fa-plus me-1"></i> Create New
                    </a>
                </div>

                <!-- Body -->
                <div class="card-body p-4">
                    <form method="POST"
                          action="{{ route('admin.blogs.update', $blog->id) }}"
                          enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label">Blog Name</label>
                            <input type="text"
                                   name="name"
                                   class="form-control"
                                   value="{{ old('name', $blog->name) }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Blog URL (Slug)</label>
                            <input type="text"
                                   name="slug"
                                   class="form-control"
                                   value="{{ old('slug', $blog->slug) }}">
                        </div>

                        <!-- Tabs -->
                        <ul class="nav nav-tabs mb-3">
                            <li class="nav-item">
                                <button type="button"
                                        class="nav-link active"
                                        data-bs-toggle="tab"
                                        data-bs-target="#short_desc_edit">
                                    Short Description
                                </button>
                            </li>
                            <li class="nav-item">
                                <button type="button"
                                        class="nav-link"
                                        data-bs-toggle="tab"
                                        data-bs-target="#keyword_edit">
                                    Keyword
                                </button>
                            </li>
                        </ul>

                        <div class="tab-content mb-3">
                            <div class="tab-pane fade show active"
                                 id="short_desc_edit">
                                <input type="text"
                                       name="short_description"
                                       class="form-control"
                                       value="{{ old('short_description', $blog->short_description) }}">
                            </div>

                            <div class="tab-pane fade"
                                 id="keyword_edit">
                                <input type="text"
                                       name="keyword"
                                       class="form-control"
                                       value="{{ old('keyword', $blog->keyword) }}">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Blog Description</label>
                            <textarea class="form-control"
                                      name="description"
                                      id="editor1"
                                      rows="5">{{ old('description', $blog->description) }}</textarea>
                        </div>

                        <!-- Current Image Preview -->
                        <div class="mb-3">
                            <label class="form-label">Current Feature Image</label>
                            <div class="border rounded p-3 text-center">
                                <img src="{{ get_file($blog->image_path, 'blog') }}"
                                     class="img-fluid rounded"
                                     style="max-height:250px;">
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Change Feature Image</label>
                            <input type="file"
                                   name="image_path"
                                   class="form-control">
                        </div>

                        <!-- Buttons -->
                        <div class="text-end">
                            <button type="submit"
                                    class="btn btn-success">
                                <i class="fas fa-save me-1"></i> Update Blog
                            </button>

                            <a href="{{ route('admin.blogs.index') }}"
                               class="btn btn-secondary">
                                Cancel
                            </a>
                        </div>

                    </form>
                </div>

            </div>
        </div>

    </div>
</div>
@endsection
@section('scripts')
    <script src="{{ asset('js/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('js/ckeditor/adapters/jquery.js') }}"></script>
    <script src="{{ asset('js/ckeditor/styles.js') }}"></script>
    <script src="{{ asset('js/ckeditor/ckeditor.custom.js') }}"></script>
@endsection