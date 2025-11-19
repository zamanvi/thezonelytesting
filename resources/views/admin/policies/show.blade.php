@extends('layouts.admin')

@section('title')
    Show Policy
@endsection

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.vehicles.index') }}">Vehicles</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.vehicles.show', $policy->vehicle->id) }}">Show Vehicle</a></li>
            <li class="breadcrumb-item active" aria-current="page">Show Policy</li>
        </ul>
    </nav>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="iq-card">
                <div class="iq-card-header d-flex justify-content-between">
                    <h4 class="card-title">Policy Details</h4>
                    <div>
                        <a href="{{ route('admin.vehicles.show', $policy->vehicle->id) }}" class="btn btn-secondary btn-sm">
                            Back to Vehicle
                        </a>
                        <a href="{{ route('admin.policies.edit', [$policy->vehicle->id, $policy->id]) }}" class="btn btn-primary btn-sm">
                            Edit Policy
                        </a>
                    </div>
                </div>

                <div class="iq-card-body">
                    {{-- Policy Information --}}
                    <table class="table table-bordered">
                        <tr>
                            <th>Policy Number</th>
                            <td>{{ $policy->policy_number }}</td>
                        </tr>
                        <tr>
                            <th>Insurance Company</th>
                            <td>{{ $policy->insurance_company }}</td>
                        </tr>
                        <tr>
                            <th>Policy Type</th>
                            <td>{{ $policy->policy_type }}</td>
                        </tr>
                        <tr>
                            <th>Start Date</th>
                            <td>{{ $policy->start_date }}</td>
                        </tr>
                        <tr>
                            <th>End Date</th>
                            <td>{{ $policy->end_date }}</td>
                        </tr>
                        <tr>
                            <th>Premium Amount</th>
                            <td>{{ $policy->premium_amount }}</td>
                        </tr>
                        <tr>
                            <th>Coverage Amount</th>
                            <td>{{ $policy->coverage_amount }}</td>
                        </tr>
                        <tr>
                            <th>Deductible</th>
                            <td>{{ $policy->deductible ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                @if($policy->status == 'Active')
                                    <span class="badge badge-success">Active</span>
                                @elseif($policy->status == 'Expired')
                                    <span class="badge badge-danger">Expired</span>
                                @else
                                    <span class="badge badge-warning">Cancelled</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Notes</th>
                            <td>{{ $policy->notes ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Created At</th>
                            <td>{{ $policy->created_at->format('d M, Y h:i A') }}</td>
                        </tr>
                        <tr>
                            <th>Updated At</th>
                            <td>{{ $policy->updated_at->format('d M, Y h:i A') }}</td>
                        </tr>
                    </table>

                    {{-- Payments Section --}}
                    <h5 class="mt-4">Payments</h5>
                    <a href="{{ route('admin.payments.create', [$policy->vehicle->id, $policy->id]) }}" class="btn btn-primary btn-sm mb-2">
                        <i class="ri-add-line"></i> Add Payment
                    </a>
                    @if($policy->payments->count())
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Payment Date</th>
                                    <th>Amount</th>
                                    <th>Method</th>
                                    <th>Reference Number</th>
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
                                        @if($payment->status == 'completed')
                                            <span class="badge badge-success">Completed</span>
                                        @elseif($payment->status == 'pending')
                                            <span class="badge badge-warning">Pending</span>
                                        @elseif($payment->status == 'failed')
                                            <span class="badge badge-danger">Failed</span>
                                        @else
                                            <span class="badge badge-info">Refunded</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.payments.edit', [$policy->vehicle->id, $policy->id, $payment->id]) }}" 
                                           class="btn btn-warning btn-sm" title="Edit"><i class="ri-edit-line"></i></a>
                                        <form action="{{ route('admin.payments.destroy', [$policy->vehicle->id, $policy->id, $payment->id]) }}"
                                              method="POST" class="d-inline-block"
                                              onsubmit="return confirm('Are you sure?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" title="Delete">
                                                <i class="ri-delete-bin-line"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p>No payments recorded for this policy yet.</p>
                    @endif

                </div>
            </div>

        </div>
    </div>
</div>
@endsection
