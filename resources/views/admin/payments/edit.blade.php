@extends('layouts.admin')

@section('title', 'Edit Payment')

@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.vehicles.index') }}">Vehicles</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.vehicles.show', $vehicle->id) }}">Show Vehicle</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit Payment</li>
    </ul>
</nav>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-12">

            <div class="iq-card">
                <div class="iq-card-header d-flex justify-content-between">
                    <h4 class="card-title">Edit Payment for Policy: {{ $policy->policy_number }}</h4>
                    <a href="{{ route('admin.vehicles.show', $vehicle->id) }}" class="btn btn-secondary btn-sm">Back</a>
                </div>
                <div class="iq-card-body">
                    <form action="{{ route('admin.payments.update', [$vehicle->id, $policy->id, $payment->id]) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="payment_date">Payment Date</label>
                            <input type="date" name="payment_date" class="form-control" id="payment_date" value="{{ old('payment_date', $payment->payment_date) }}" required>
                            @error('payment_date') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <div class="form-group">
                            <label for="amount">Amount</label>
                            <input type="number" name="amount" class="form-control" id="amount" value="{{ old('amount', $payment->amount) }}" required>
                            @error('amount') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <div class="form-group">
                            <label for="method">Method</label>
                            <select name="method" id="method" class="form-control" required>
                                @foreach(['cash','bank','card','mobile','online'] as $method)
                                    <option value="{{ $method }}" {{ old('method', $payment->method) == $method ? 'selected' : '' }}>{{ ucfirst($method) }}</option>
                                @endforeach
                            </select>
                            @error('method') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <div class="form-group">
                            <label for="reference_number">Reference Number</label>
                            <input type="text" name="reference_number" class="form-control" id="reference_number" value="{{ old('reference_number', $payment->reference_number) }}" required>
                            @error('reference_number') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control" required>
                                @foreach(['completed','pending','failed','refunded'] as $status)
                                    <option value="{{ $status }}" {{ old('status', $payment->status) == $status ? 'selected' : '' }}>{{ ucfirst($status) }}</option>
                                @endforeach
                            </select>
                            @error('status') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <button type="submit" class="btn btn-primary"><i class="ri-save-line"></i> Update Payment</button>
                        <a href="{{ route('admin.vehicles.show', $vehicle->id) }}" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
