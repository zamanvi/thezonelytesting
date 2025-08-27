@extends('admin.index')
@section('title')
    Category Panel
@endsection
@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Show Category</li>
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
                        <div class="d-flex">
                            <h4 class="card-title">Category: 
                                <span class="text text-primary">{{ $category->title }}</span>
                            </h4>
                        </div>
                        <div class="d-flex">
                            <h4 class="card-title mr-2">
                                <a href="{{ route('admin.categories.create') }}">Create</a>
                            </h4>
                            <h4 class="card-title">
                                <a href="{{ route('admin.categories.edit', $category->id) }}">Edit</a>
                            </h4>
                        </div>
                    </div>
                    <div class="iq-card-body">
                        <h5 class="card-title mt-2">
                            Category Title: <span class="text text-primary">{{ $category->title }}</span>
                        </h5>
                        <h5 class="card-title mt-2">
                            Category Slug: <span class="text text-primary">{{ $category->slug }}</span>
                        </h5>
                        <h5 class="card-title mt-2">
                            Status: 
                            @if($category->is_active)
                                <span class="badge badge-success">Active</span>
                            @else
                                <span class="badge badge-danger">Inactive</span>
                            @endif
                        </h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
