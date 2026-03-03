@extends('layouts.admin2')

@section('title')
    Edit Profile
@endsection

@section('content')
<div class="mt-5 pt-4">
    <div class="section-card">
        
        <!-- Header -->
        <div class="card-header bg-warning text-dark p-4 d-flex justify-content-between align-items-center">
            <h5 class="mb-0">
                <i class="fas fa-user-edit me-2"></i>
                Edit / Verify User Profile
            </h5>

            <a href="{{ route('admin.profiles.index', ['status' => $user->status ? 'verified' : 'unverified']) }}"
               class="btn btn-sm btn-dark">
                <i class="fas fa-arrow-left me-1"></i> Back
            </a>
        </div>

        <!-- Body -->
        <div class="card-body p-4">
            <form method="POST" action="{{ route('admin.profiles.update', $user->id) }}">
                @csrf
                @method('PUT')

                <div class="row g-4">

                    <!-- Left Column (User Info) -->
                    <div class="col-md-6">
                        <h6 class="mb-3 text-primary">
                            <i class="fas fa-user me-2"></i>Basic Information
                        </h6>

                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control" value="{{ $user->name }}" readonly>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" value="{{ $user->email }}" readonly>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Phone</label>
                            <input type="text" class="form-control" value="{{ $user->phone ?? '-' }}" readonly>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Designation</label>
                            <input type="text" class="form-control" value="{{ $user->designation ?? '-' }}" readonly>
                        </div>
                    </div>

                    <!-- Right Column (Additional Info) -->
                    <div class="col-md-6">
                        <h6 class="mb-3 text-success">
                            <i class="fas fa-address-card me-2"></i>Additional Details
                        </h6>

                        <div class="mb-3">
                            <label class="form-label">Work Address</label>
                            <input type="text" class="form-control" value="{{ $user->work_address ?? '-' }}" readonly>
                        </div>

                        @php
                            $address = $user->contacts()->address()->first();
                        @endphp

                        <div class="mb-3">
                            <label class="form-label">Contact Address</label>
                            <input type="text" class="form-control" 
                                   value="{{ $address ? $address->value : '-' }}" readonly>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">About</label>
                            <textarea class="form-control" rows="3" readonly>{{ $user->about ?? '-' }}</textarea>
                        </div>
                    </div>

                    <!-- Divider -->
                    <div class="col-12">
                        <hr>
                        <h6 class="text-warning">
                            <i class="fas fa-cogs me-2"></i>Admin Controls
                        </h6>
                    </div>

                    <!-- Editable Fields -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Title</label>
                            <input type="text" name="title" class="form-control"
                                   value="{{ old('title', $user->title) }}">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select name="status" required class="form-select">
                                <option value="0" {{ old('status', $user->status) == 0 ? 'selected' : '' }}>
                                    Unverified
                                </option>
                                <option value="1" {{ old('status', $user->status) == 1 ? 'selected' : '' }}>
                                    Verified
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="mb-3">
                            <label class="form-label">Remark</label>
                            <textarea name="remark" required rows="3"
                                      class="form-control">{{ old('remark', $user->remark) }}</textarea>
                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="col-12 text-end">
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-save me-1"></i> Update Profile
                        </button>

                        <a href="{{ route('admin.profiles.index', ['type' => $user->status ? 'verified' : 'unverified']) }}"
                           class="btn btn-secondary">
                            Cancel
                        </a>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>
@endsection