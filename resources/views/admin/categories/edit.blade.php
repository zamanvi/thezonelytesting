@extends('admin.index')
@section('title')
    Category Panel
@endsection
@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Category</li>
        </ul>
    </nav>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            @include('admin.categories.component')
            <div class="col-sm-12 col-lg-6">
                <div class="iq-card">
                    <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                            <h4 class="card-title">Edit Category</h4>
                        </div>
                        <div class="iq-header-title">
                            <h4 class="card-title"> <a href="{{ route('admin.categories.create') }}">Create</a></h4>
                        </div>
                    </div>
                    <div class="iq-card-body">
                        <form method="POST" action="{{ route('admin.categories.update', $category->id) }}">
                            @csrf
                            @method('PUT')

                            {{-- Title --}}
                            <div class="form-group">
                                <label for="title">Category Title</label>
                                <input type="text" name="title" class="form-control" id="title"
                                       value="{{ old('title', $category->title) }}">
                            </div>

                            {{-- Slug --}}
                            <div class="form-group">
                                <label for="slug">Category Slug</label>
                                <input type="text" name="slug" class="form-control" id="slug"
                                       value="{{ old('slug', $category->slug) }}">
                            </div>

                            {{-- Status --}}
                            <input type="hidden" name="is_active" value="0">
                            <div class="form-group form-check">
                                <input type="checkbox" name="is_active" value="1" class="form-check-input" id="is_active"
                                    {{ old('is_active', $category->is_active) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_active">Active</label>
                            </div>

                            <input type="submit" class="btn btn-primary" value="Update" />
                            <input type="reset" class="btn iq-bg-danger" value="Cancel" />
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
