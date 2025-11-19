@extends('layouts.admin')

@section('title')
    Add Policy
@endsection

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.vehicles.index') }}">Vehicles</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.vehicles.show', $vehicle->id) }}">Show Vehicle</a></li>
            <li class="breadcrumb-item active" aria-current="page">Add Policy</li>
        </ul>
    </nav>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-12">

            <div class="iq-card">
                <div class="iq-card-header d-flex justify-content-between">
                    <h4 class="card-title">Add Policy for <strong>{{ $vehicle->name }}</strong></h4>
                    <a href="{{ route('admin.vehicles.show', $vehicle->id) }}" class="btn btn-secondary btn-sm">
                        Back to Vehicle
                    </a>
                </div>

                <div class="iq-card-body">
                    <form action="{{ route('admin.policies.store', $vehicle->id) }}" method="POST">
                        @csrf
                        <input type="hidden" name="vehicle_id" value="{{ $vehicle->id }}">

                        {{-- Policy Number --}}
                        <div class="form-group">
                            <label for="policy_number">Policy Number <span class="text-danger">*</span></label>
                            <input type="text" name="policy_number" class="form-control" id="policy_number"
                                   value="{{ old('policy_number') }}" required>
                            @error('policy_number')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Insurance Company --}}
                        <div class="form-group">
                            <label for="insurance_company">Insurance Company <span class="text-danger">*</span></label>
                            <input type="text" name="insurance_company" class="form-control" id="insurance_company"
                                   value="{{ old('insurance_company') }}" required>
                            @error('insurance_company')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Policy Type --}}
                        <div class="form-group">
                            <label for="policy_type">Policy Type <span class="text-danger">*</span></label>
                            <select name="policy_type" id="policy_type" class="form-control" required>
                                <option value="">-- Select Type --</option>
                                @foreach(['Liability', 'Comprehensive', 'Full Coverage'] as $type)
                                    <option value="{{ $type }}" {{ old('policy_type') == $type ? 'selected' : '' }}>
                                        {{ $type }}
                                    </option>
                                @endforeach
                            </select>
                            @error('policy_type')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Start & End Dates --}}
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="start_date">Start Date <span class="text-danger">*</span></label>
                                <input type="date" name="start_date" class="form-control" id="start_date"
                                       value="{{ old('start_date') }}" required>
                                @error('start_date')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="end_date">End Date <span class="text-danger">*</span></label>
                                <input type="date" name="end_date" class="form-control" id="end_date"
                                       value="{{ old('end_date') }}" required>
                                @error('end_date')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        {{-- Premium & Coverage --}}
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="premium_amount">Premium Amount <span class="text-danger">*</span></label>
                                <input type="text" name="premium_amount" class="form-control" id="premium_amount"
                                       value="{{ old('premium_amount') }}" required>
                                @error('premium_amount')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="coverage_amount">Coverage Amount <span class="text-danger">*</span></label>
                                <input type="text" name="coverage_amount" class="form-control" id="coverage_amount"
                                       value="{{ old('coverage_amount') }}" required>
                                @error('coverage_amount')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        {{-- Deductible --}}
                        <div class="form-group">
                            <label for="deductible">Deductible</label>
                            <input type="text" name="deductible" class="form-control" id="deductible"
                                   value="{{ old('deductible') }}">
                            @error('deductible')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Status --}}
                        <div class="form-group">
                            <label for="status">Status <span class="text-danger">*</span></label>
                            <select name="status" id="status" class="form-control" required>
                                <option value="">-- Select Status --</option>
                                @foreach(['Active', 'Expired', 'Cancelled'] as $status)
                                    <option value="{{ $status }}" {{ old('status') == $status ? 'selected' : '' }}>
                                        {{ $status }}
                                    </option>
                                @endforeach
                            </select>
                            @error('status')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Notes --}}
                        <div class="form-group">
                            <label for="notes">Notes</label>
                            <textarea name="notes" id="notes" class="form-control" rows="3">{{ old('notes') }}</textarea>
                            @error('notes')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Submit Buttons --}}
                        <div class="mt-3">
                            <button type="submit" class="btn btn-primary">
                                <i class="ri-save-line"></i> Save Policy
                            </button>
                            <a href="{{ route('admin.vehicles.show', $vehicle->id) }}" class="btn btn-secondary">
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
