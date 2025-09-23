@extends('layouts.admin')

@section('title', 'Edit Profile')

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.profiles.index', ['type' => 'unverified']) }}">Profiles</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Profile</li>
        </ul>
    </nav>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <div class="iq-card">
                    <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                            <h4 class="card-title">Edit / Verify User Profile</h4>
                        </div>
                    </div>
                    <div class="iq-card-body">
                        <form method="POST" action="{{ route('admin.profiles.update', $user->id) }}">
                            @csrf
                            @method('PUT')

                            <!-- Show-only fields -->
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" value="{{ $user->name }}" readonly>
                            </div>

                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" value="{{ $user->email }}" readonly>
                            </div>

                            <div class="form-group">
                                <label>Phone</label>
                                <input type="text" class="form-control" value="{{ $user->phone ?? '-' }}" readonly>
                            </div>

                            <div class="form-group">
                                <label>Work Address</label>
                                <input type="text" class="form-control" value="{{ $user->work_address ?? '-' }}" readonly>
                            </div>

                            <div class="form-group">
                                <label>Contact Address</label>
                                @php
                                    $address = $user->contacts()->address()->first();
                                @endphp
                                <input type="text" class="form-control" value="{{ $address ? $address->value : '-' }}" readonly>
                            </div>

                            <div class="form-group">
                                <label>Designation</label>
                                <input type="text" class="form-control" value="{{ $user->designation ?? '-' }}" readonly>
                            </div>

                            <div class="form-group">
                                <label>About</label>
                                <textarea class="form-control" rows="3" readonly>{{ $user->about ?? '-' }}</textarea>
                            </div>

                            <!-- Editable fields -->
                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" name="title" class="form-control" value="{{ $user->title ?? '-' }}">
                            </div>
                            <div class="form-group">
                                <label for="remark">Remark</label>
                                <textarea name="remark" required id="remark" rows="3" class="form-control">{{ old('remark', $user->remark) }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="status">Status</label>
                                <select name="status" required id="status" class="form-control">
                                    <option value="0" {{ old('status', $user->status) == 0 ? 'selected' : '' }}>Unverified</option>
                                    <option value="1" {{ old('status', $user->status) == 1 ? 'selected' : '' }}>Verified</option>
                                </select>
                            </div>

                            <!-- Submit -->
                            <div class="form-group text-right">
                                <button type="submit" class="btn btn-primary">Update</button>
                                <a href="{{ route('admin.profiles.index', ['type' => $user->status ? 'verified' : 'unverified']) }}" class="btn btn-secondary">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
