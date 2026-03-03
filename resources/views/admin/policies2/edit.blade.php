@extends('layouts.admin2')
@section('title', 'Edit Policy')

@section('content')
<div class="mt-5 pt-4">
    <div class="row justify-content-center">
        <div class="col-lg-12">

            <div class="section-card">

                {{-- Header --}}
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center p-4">
                    <h5 class="mb-0">
                        <i class="fas fa-edit me-2"></i> Edit Policy
                        <span class="text-white ms-2">({{ $vehicle->name }})</span>
                    </h5>
                    <a href="{{ route('admin.vehicles.show', $vehicle->id) }}" class="btn btn-light btn-sm">
                        <i class="fas fa-arrow-left me-1"></i> Back
                    </a>
                </div>

                {{-- Body --}}
                <div class="card-body p-4">
                    <form action="{{ route('admin.policies.update', [$vehicle->id, $policy->id]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="vehicle_id" value="{{ $vehicle->id }}">

                        <div class="row g-3">

                            {{-- Policy Number --}}
                            <div class="col-md-6">
                                <label class="form-label">Policy Number *</label>
                                <input type="text" name="policy_number" class="form-control"
                                       value="{{ old('policy_number', $policy->policy_number) }}" required>
                                @error('policy_number') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            {{-- Insurance Company --}}
                            <div class="col-md-6">
                                <label class="form-label">Insurance Company *</label>
                                <input type="text" name="insurance_company" class="form-control"
                                       value="{{ old('insurance_company', $policy->insurance_company) }}" required>
                                @error('insurance_company') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            {{-- Policy Type --}}
                            <div class="col-md-6">
                                <label class="form-label">Policy Type *</label>
                                <select name="policy_type" class="form-select" required>
                                    <option value="">-- Select Type --</option>
                                    @foreach(['Liability', 'Comprehensive', 'Full Coverage'] as $type)
                                        <option value="{{ $type }}" {{ old('policy_type', $policy->policy_type) == $type ? 'selected' : '' }}>
                                            {{ $type }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('policy_type') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            {{-- Start Date --}}
                            <div class="col-md-3">
                                <label class="form-label">Start Date *</label>
                                <input type="date" name="start_date" class="form-control"
                                       value="{{ old('start_date', $policy->start_date) }}" required>
                                @error('start_date') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            {{-- End Date --}}
                            <div class="col-md-3">
                                <label class="form-label">End Date *</label>
                                <input type="date" name="end_date" class="form-control"
                                       value="{{ old('end_date', $policy->end_date) }}" required>
                                @error('end_date') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            {{-- Premium Amount --}}
                            <div class="col-md-6">
                                <label class="form-label">Premium Amount *</label>
                                <input type="text" name="premium_amount" class="form-control"
                                       value="{{ old('premium_amount', $policy->premium_amount) }}" required>
                                @error('premium_amount') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            {{-- Coverage Amount --}}
                            <div class="col-md-6">
                                <label class="form-label">Coverage Amount *</label>
                                <input type="text" name="coverage_amount" class="form-control"
                                       value="{{ old('coverage_amount', $policy->coverage_amount) }}" required>
                                @error('coverage_amount') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            {{-- Deductible --}}
                            <div class="col-md-6">
                                <label class="form-label">Deductible</label>
                                <input type="text" name="deductible" class="form-control"
                                       value="{{ old('deductible', $policy->deductible) }}">
                                @error('deductible') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            {{-- Status --}}
                            <div class="col-md-6">
                                <label class="form-label">Status *</label>
                                <select name="status" class="form-select" required>
                                    <option value="">-- Select Status --</option>
                                    @foreach(['Active', 'Expired', 'Cancelled'] as $status)
                                        <option value="{{ $status }}" {{ old('status', $policy->status) == $status ? 'selected' : '' }}>
                                            {{ $status }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('status') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            {{-- Notes --}}
                            <div class="col-md-12">
                                <label class="form-label">Notes</label>
                                <textarea name="notes" rows="3" class="form-control">{{ old('notes', $policy->notes) }}</textarea>
                                @error('notes') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                        </div>

                        {{-- Buttons --}}
                        <div class="text-end mt-4">
                            <a href="{{ route('admin.vehicles.show', $vehicle->id) }}" class="btn btn-secondary me-2">
                                Cancel
                            </a>
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-save me-1"></i> Update
                            </button>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection