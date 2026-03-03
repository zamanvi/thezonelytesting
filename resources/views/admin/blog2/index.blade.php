@extends('layouts.admin2')

@section('title')
    Blog Panel
@endsection

@section('content')
<div class="mt-5 pt-4">
    <div class="row g-4">

        <!-- LEFT: Blog List -->
        @include('admin.blog2.component')

        <!-- RIGHT: Create Blog -->
        <div class="col-lg-6">
            <div class="section-card">

                <div class="card-header bg-primary text-white p-4">
                    <h5 class="mb-0">
                        <i class="fas fa-pen-nib me-2"></i>
                        Create New Blog
                    </h5>
                </div>

                <div class="card-body p-4">
                    <form method="POST" action="{{ route('admin.blogs.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Blog Name</label>
                            <input required type="text" name="name" class="form-control"
                                   placeholder="Blog Name">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Blog URL (Slug)</label>
                            <input type="text" name="slug" class="form-control"
                                   placeholder="blog-url-slug">
                        </div>

                        <!-- Tabs -->
                        <ul class="nav nav-tabs mb-3">
                            <li class="nav-item">
                                <button type="button"
                                        class="nav-link active"
                                        data-bs-toggle="tab"
                                        data-bs-target="#short_desc">
                                    Short Description
                                </button>
                            </li>

                            <li class="nav-item">
                                <button type="button"
                                        class="nav-link"
                                        data-bs-toggle="tab"
                                        data-bs-target="#keyword_tab">
                                    Keyword
                                </button>
                            </li>
                        </ul>

                        <div class="tab-content mb-3">
                            <div class="tab-pane fade show active" id="short_desc">
                                <input type="text" name="short_description"
                                       class="form-control"
                                       placeholder="Post Short Details">
                            </div>

                            <div class="tab-pane fade" id="keyword_tab">
                                <input type="text" name="keyword"
                                       class="form-control"
                                       placeholder="Keyword">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Blog Description</label>
                            <textarea class="form-control"
                                      name="description"
                                      id="editor1"
                                      rows="5"></textarea>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Feature Image</label>
                            <input name="image_path" type="file"
                                   class="form-control">
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-save me-1"></i> Submit
                            </button>
                            <button type="reset" class="btn btn-secondary">
                                Cancel
                            </button>
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