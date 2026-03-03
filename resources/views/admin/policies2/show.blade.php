@extends('layouts.admin2')
@section('title', 'Policy Details')

@section('content')
<div class="mt-5 pt-4">
    <div class="row justify-content-center">
        <div class="col-lg-12">

            {{-- Policy Details --}}
            <div class="section-card mb-4">

                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center p-4">
                    <h5 class="mb-0">
                        <i class="fas fa-file-alt me-2"></i> Policy Details
                        <span class="text-white ms-2">({{ $policy->policy_number }})</span>
                    </h5>
                    <div class="d-flex gap-2">
                        <a href="{{ route('admin.vehicles.show', $policy->vehicle->id) }}" 
                           class="btn btn-light btn-sm">
                            <i class="fas fa-arrow-left me-1"></i> Back
                        </a>
                        <a href="{{ route('admin.policies.edit', [$policy->vehicle->id, $policy->id]) }}" 
                           class="btn btn-success btn-sm">
                            <i class="fas fa-edit me-1"></i> Edit
                        </a>
                    </div>
                </div>

                <div class="card-body p-4">
                    <div class="row g-3">

                        <div class="col-md-6">
                            <strong>Policy Number:</strong> {{ $policy->policy_number }}
                        </div>

                        <div class="col-md-6">
                            <strong>Insurance Company:</strong> {{ $policy->insurance_company }}
                        </div>

                        <div class="col-md-6">
                            <strong>Policy Type:</strong> {{ $policy->policy_type }}
                        </div>

                        <div class="col-md-6">
                            <strong>Status:</strong>
                            <span class="badge
                                @if($policy->status == 'Active') bg-success
                                @elseif($policy->status == 'Expired') bg-warning
                                @else bg-danger
                                @endif">
                                {{ $policy->status }}
                            </span>
                        </div>

                        <div class="col-md-6">
                            <strong>Start Date:</strong> {{ $policy->start_date }}
                        </div>

                        <div class="col-md-6">
                            <strong>End Date:</strong> {{ $policy->end_date }}
                        </div>

                        <div class="col-md-6">
                            <strong>Premium Amount:</strong> {{ $policy->premium_amount }}
                        </div>

                        <div class="col-md-6">
                            <strong>Coverage Amount:</strong> {{ $policy->coverage_amount }}
                        </div>

                        <div class="col-md-6">
                            <strong>Deductible:</strong> {{ $policy->deductible ?? '-' }}
                        </div>

                        <div class="col-md-6">
                            <strong>Notes:</strong> {{ $policy->notes ?? '-' }}
                        </div>

                        <div class="col-md-6">
                            <strong>Created At:</strong> {{ $policy->created_at->format('d M, Y h:i A') }}
                        </div>

                        <div class="col-md-6">
                            <strong>Updated At:</strong> {{ $policy->updated_at->format('d M, Y h:i A') }}
                        </div>

                    </div>
                </div>
            </div>

            {{-- Payments Section --}}
            <div class="section-card">

                <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center p-4">
                    <h5 class="mb-0">
                        <i class="fas fa-money-bill-wave me-2"></i> Payments
                    </h5>
                    <a href="{{ route('admin.payments.create', [$policy->vehicle->id, $policy->id]) }}" 
                       class="btn btn-light btn-sm">
                        <i class="fas fa-plus me-1"></i> Add Payment
                    </a>
                </div>

                <div class="card-body p-4">

                    @if($policy->payments->count())
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Payment Date</th>
                                        <th>Amount</th>
                                        <th>Method</th>
                                        <th>Reference</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($policy->payments as $payment)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $payment->payment_date }}</td>
                                        <td>{{ $payment->amount }}</td>
                                        <td>{{ ucfirst($payment->method) }}</td>
                                        <td>{{ $payment->reference_number }}</td>
                                        <td>
                                            <span class="badge
                                                @if($payment->status == 'completed') bg-success
                                                @elseif($payment->status == 'pending') bg-warning
                                                @elseif($payment->status == 'failed') bg-danger
                                                @else bg-info
                                                @endif">
                                                {{ ucfirst($payment->status) }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="d-flex gap-1">
                                                <a href="{{ route('admin.payments.edit', [$policy->vehicle->id, $policy->id, $payment->id]) }}"
                                                   class="btn btn-sm btn-warning">
                                                    <i class="fas fa-edit"></i>
                                                </a>

                                                <form action="{{ route('admin.payments.destroy', [$policy->vehicle->id, $policy->id, $payment->id]) }}"
                                                      method="POST"
                                                      onsubmit="return confirm('Are you sure?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-muted">No payments recorded for this policy yet.</p>
                    @endif

                </div>
            </div>

        </div>
    </div>
</div>
@endsection