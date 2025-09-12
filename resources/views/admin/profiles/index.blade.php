@extends('layouts.admin')
@section('title')
    Unverified Profiles
@endsection

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $type }} Profiles</li>
        </ul>
    </nav>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="iq-card">
                    {{-- <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                            <h4 class="card-title">{{ $type }} User Profiles</h4>
                        </div>
                    </div> --}}
                    <div class="iq-card-header d-flex justify-content-between align-items-center">
                        <div class="iq-header-title">
                            <h4 class="card-title">{{ ucfirst($type ?? 'All') }} User Profiles</h4>
                        </div>
                        <div class="iq-header-title">
                            <!-- Type filters -->
                            <div class="btn-group" role="group">
                                <!-- Type filters -->
                                <a href="{{ route('admin.profiles.index', ['type' => 'all']) }}"
                                    class="btn btn-sm {{ (!$type && !$status) || $type == 'all' ? 'btn-primary' : 'btn-outline-primary' }}">All</a>

                                <a href="{{ route('admin.profiles.index', ['type' => 'admin']) }}"
                                    class="btn btn-sm {{ $type == 'admin' ? 'btn-primary' : 'btn-outline-primary' }}">Admin</a>

                                <a href="{{ route('admin.profiles.index', ['type' => 'profile']) }}"
                                    class="btn btn-sm {{ $type == 'profile' ? 'btn-primary' : 'btn-outline-primary' }}">Profile</a>

                                <!-- Status filters -->
                                <a href="{{ route('admin.profiles.index', ['status' => 'verified']) }}"
                                    class="btn btn-sm {{ ($status ?? '') == 'verified' ? 'btn-primary' : 'btn-outline-primary' }}">Verified</a>

                                <a href="{{ route('admin.profiles.index', ['status' => 'unverified']) }}"
                                    class="btn btn-sm {{ ($status ?? '') == 'unverified' ? 'btn-primary' : 'btn-outline-primary' }}">Unverified</a>
                            </div>
                        </div>
                    </div>
                    <div class="iq-card-body">
                        @if ($users->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Designation</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $index => $user)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->phone ?? '-' }}</td>
                                                <td>{{ $user->designation ?? '-' }}</td>
                                                <td>
                                                    <span
                                                        class="badge {{ $user->status ? 'badge-success' : 'badge-danger' }}">
                                                        {{ $user->status ? 'Verified' : 'Unverified' }}
                                                    </span>
                                                </td>
                                                {{-- <td>
                                                    <a href="{{ route('admin.profiles.edit', $user->id) }}" class="btn btn-sm btn-success">Verify</a>
                                                    <form action="{{ route('admin.profiles.destroy', $user->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger"
                                                            onclick="return confirm('Are you sure you want to delete this profile?')">
                                                            Delete
                                                        </button>
                                                    </form>
                                                </td> --}}
                                                <td>
                                                    @if ($user->type === 'admin')
                                                        {{-- No action --}}
                                                        <span class="text-muted">N/A</span>
                                                    @else
                                                        {{-- Edit / Verify button --}}
                                                        @if ($user->status)
                                                            <a href="{{ route('admin.profiles.edit', $user->id) }}"
                                                                class="btn btn-sm btn-primary">Edit</a>
                                                        @else
                                                            <a href="{{ route('admin.profiles.edit', $user->id) }}"
                                                                class="btn btn-sm btn-success">Verify</a>
                                                        @endif

                                                        {{-- Delete button --}}
                                                        <form action="{{ route('admin.profiles.destroy', $user->id) }}"
                                                            method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger"
                                                                onclick="return confirm('Are you sure you want to delete this profile?')">
                                                                Delete
                                                            </button>
                                                        </form>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <p class="text-center">No unverified profiles found.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
