@extends('layouts.admin2')
@section('title', 'Add Payment')

@section('content')
<div class="mt-5 pt-4">
    <div class="row justify-content-center">
        <div class="col-lg-12">

            <div class="section-card">

                {{-- Header --}}
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center p-4">
                    <h5 class="mb-0">
                        <i class="fas fa-money-bill-wave me-2"></i>
                        Add Payment
                        <span class="text-white ms-2">({{ $policy->policy_number }})</span>
                    </h5>

                    <a href="{{ route('admin.vehicles.show', $vehicle->id) }}" 
                       class="btn btn-light btn-sm">
                        <i class="fas fa-arrow-left me-1"></i> Back
                    </a>
                </div>

                {{-- Body --}}
                <div class="card-body p-4">
                    <form action="{{ route('admin.payments.store', [$vehicle->id, $policy->id]) }}" method="POST">
                        @csrf

                        <div class="row g-3">

                            {{-- Payment Date --}}
                            <div class="col-md-6">
                                <label for="payment_date" class="form-label">Payment Date</label>
                                <input type="date" 
                                       name="payment_date" 
                                       id="payment_date"
                                       class="form-control @error('payment_date') is-invalid @enderror"
                                       value="{{ old('payment_date') }}" required>
                                @error('payment_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Amount --}}
                            <div class="col-md-6">
                                <label for="amount" class="form-label">Amount</label>
                                <input type="number" 
                                       name="amount" 
                                       id="amount"
                                       class="form-control @error('amount') is-invalid @enderror"
                                       value="{{ old('amount') }}" required>
                                @error('amount')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Method --}}
                            <div class="col-md-6">
                                <label for="method" class="form-label">Method</label>
                                <select name="method" 
                                        id="method"
                                        class="form-select @error('method') is-invalid @enderror" required>
                                    <option value="">-- Select Method --</option>
                                    @foreach(['cash','bank','card','mobile','online'] as $method)
                                        <option value="{{ $method }}" 
                                            {{ old('method') == $method ? 'selected' : '' }}>
                                            {{ ucfirst($method) }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('method')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Reference Number --}}
                            <div class="col-md-6">
                                <label for="reference_number" class="form-label">Reference Number</label>
                                <input type="text" 
                                       name="reference_number" 
                                       id="reference_number"
                                       class="form-control @error('reference_number') is-invalid @enderror"
                                       value="{{ old('reference_number') }}" required>
                                @error('reference_number')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Status --}}
                            <div class="col-md-6">
                                <label for="status" class="form-label">Status</label>
                                <select name="status" 
                                        id="status"
                                        class="form-select @error('status') is-invalid @enderror" required>
                                    <option value="">-- Select Status --</option>
                                    @foreach(['completed','pending','failed','refunded'] as $status)
                                        <option value="{{ $status }}" 
                                            {{ old('status') == $status ? 'selected' : '' }}>
                                            {{ ucfirst($status) }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>

                        {{-- Buttons --}}
                        <div class="mt-4 d-flex gap-2">
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-save me-1"></i> Save Payment
                            </button>

                            <a href="{{ route('admin.vehicles.show', $vehicle->id) }}" 
                               class="btn btn-secondary">
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