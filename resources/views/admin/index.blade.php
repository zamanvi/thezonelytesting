@extends('layouts.admin')

@section('title')
    {{ env('APP_NAME') }}
@endsection
@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Admin</li>
        </ul>
    </nav>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 col-lg-3">
                <div class="iq-card iq-card-block iq-card-stretch iq-card-height overflow-hidden">
                    <div class="iq-card-body pb-0">
                        <div class="rounded-circle iq-card-icon iq-bg-warning"><i class="ri-bar-chart-grouped-line"></i></div>
                        <span class="float-right line-height-6"><a href="{{ route('admin.blogs.create') }}">Blogs</a></span>
                        <div class="clearfix"></div>
                        <div class="text-center">
                            <h2 class="mb-0"><span></span><span class="counter">{{ $blogCount }}</span></h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="iq-card iq-card-block iq-card-stretch iq-card-height overflow-hidden">
                    <div class="iq-card-body pb-0">
                        <div class="rounded-circle iq-card-icon iq-bg-warning"><i class="ri-bar-chart-grouped-line"></i></div>
                        <span class="float-right line-height-6"><a href="{{ route('admin.categories.create') }}">Categories</a></span>
                        <div class="clearfix"></div>
                        <div class="text-center">
                            <h2 class="mb-0"><span></span><span class="counter">{{ $categoryCount }}</span></h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="iq-card iq-card-block iq-card-stretch iq-card-height overflow-hidden">
                    <div class="iq-card-body pb-0">
                        <div class="rounded-circle iq-card-icon iq-bg-warning"><i class="ri-bar-chart-grouped-line"></i></div>
                        <span class="float-right line-height-6"><a href="{{ route('admin.categories.create') }}">Vendors</a></span>
                        <div class="clearfix"></div>
                        <div class="text-center">
                            <h2 class="mb-0"><span></span><span class="counter">{{ $categoryCount }}</span></h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
