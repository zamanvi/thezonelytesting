@extends('layouts.admin2')
@section('title', 'Add Panel Manager')

@section('content')
<div class="mt-5 pt-4">

    <div class="d-flex align-items-center gap-3 mb-4">
        <a href="{{ route('admin.managers.index') }}" class="btn btn-sm btn-outline-secondary">
            <i class="fas fa-arrow-left"></i>
        </a>
        <div>
            <h4 class="mb-0 fw-bold">Add Panel Manager</h4>
            <p class="text-muted small mb-0">Create account + assign module access.</p>
        </div>
    </div>

    @if($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0 small">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
    </div>
    @endif

    <form method="POST" action="{{ route('admin.managers.store') }}">
        @csrf
        <div class="row g-4">

            {{-- Account Info --}}
            <div class="col-md-6">
                <div class="section-card h-100">
                    <div class="card-header bg-dark text-white p-4">
                        <h6 class="mb-0"><i class="fas fa-user me-2"></i>Account Details</h6>
                    </div>
                    <div class="card-body p-4">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Full Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Email Address <span class="text-danger">*</span></label>
                            <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Password <span class="text-danger">*</span></label>
                            <input type="password" name="password" class="form-control" required minlength="6">
                            <div class="form-text">Min 6 characters.</div>
                        </div>
                        <div class="mb-0">
                            <label class="form-label fw-semibold">Notes (internal)</label>
                            <textarea name="notes" class="form-control" rows="2" placeholder="e.g. Hired for blog management...">{{ old('notes') }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Module Access --}}
            <div class="col-md-6">
                <div class="section-card h-100">
                    <div class="card-header bg-dark text-white p-4">
                        <h6 class="mb-0"><i class="fas fa-lock-open me-2"></i>Module Access</h6>
                    </div>
                    <div class="card-body p-4">
                        <p class="text-muted small mb-3">Tick which admin sections this manager can access.</p>
                        <div class="d-flex flex-column gap-2">
                            @foreach($modules as $key => $info)
                            <label class="d-flex align-items-center gap-3 p-3 rounded-3 border cursor-pointer module-row"
                                   style="cursor:pointer" for="mod_{{ $key }}">
                                <input type="checkbox" name="modules[]" value="{{ $key }}" id="mod_{{ $key }}"
                                       class="form-check-input mt-0" style="width:18px;height:18px"
                                       {{ in_array($key, old('modules', [])) ? 'checked' : '' }}>
                                <div class="flex-1">
                                    <div class="fw-bold small d-flex align-items-center gap-2">
                                        <i class="fas {{ $info['icon'] }} text-primary" style="width:16px;text-align:center"></i>
                                        {{ $info['label'] }}
                                    </div>
                                </div>
                            </label>
                            @endforeach
                        </div>
                        @error('modules')
                        <div class="text-danger small mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

        </div>

        <div class="mt-4 d-flex gap-2">
            <button type="submit" class="btn btn-primary px-5">
                <i class="fas fa-save me-1"></i> Create Manager
            </button>
            <a href="{{ route('admin.managers.index') }}" class="btn btn-outline-secondary">Cancel</a>
        </div>
    </form>

</div>
@endsection
