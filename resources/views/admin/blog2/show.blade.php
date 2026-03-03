@extends('layouts.admin2')

@section('title', 'Blog Details')

@section('content')
<div class="container-fluid">
    <div class="row">
        @include('admin.blog2.component')

        <div class="col-lg-6 col-md-12">
            <div class="card shadow-sm border-0 rounded-lg">
                
                {{-- Header --}}
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="mb-0 font-weight-bold">
                            {{ $blog->name }}
                        </h4>
                        <small class="text-muted">Blog Details Overview</small>
                    </div>

                    <div>
                        <a href="{{ route('admin.blogs.create') }}" 
                           class="btn btn-sm btn-success mr-2">
                            + Create
                        </a>

                        <a href="{{ route('admin.blogs.edit', $blog->id) }}" 
                           class="btn btn-sm btn-primary">
                            Edit
                        </a>
                    </div>
                </div>

                {{-- Body --}}
                <div class="card-body">

                    <div class="row">

                        {{-- Image Section --}}
                        <div class="col-md-4 text-center">
                            <div class="border rounded p-2 shadow-sm">
                                <img src="{{ get_file($blog->image_path, 'blog') }}"
                                     class="img-fluid rounded"
                                     style="max-height:250px; object-fit:cover;">
                            </div>
                        </div>

                        {{-- Info Section --}}
                        <div class="col-md-8">

                            <div class="mb-3">
                                <label class="font-weight-bold">Slug URL</label>
                                <div class="bg-light p-2 rounded text-primary">
                                    {{ $blog->slug }}
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="font-weight-bold">Keyword</label>
                                <div>
                                    <span class="badge badge-info px-3 py-2">
                                        {{ $blog->keyword }}
                                    </span>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="font-weight-bold">Short Description</label>
                                <div class="bg-light p-3 rounded">
                                    {{ $blog->short_description }}
                                </div>
                            </div>

                        </div>

                    </div>

                    <hr>

                    {{-- Full Description --}}
                    <div class="mt-4">
                        <label class="font-weight-bold">Full Description</label>
                        <div class="border rounded p-3 bg-white">
                            {!! $blog->description !!}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection