@extends('layouts.admin2')
@section('title', 'Vehicle Details')

@section('content')
<div class="mt-5 pt-4">
    <div class="row justify-content-center">
        <div class="col-lg-12">

            {{-- Vehicle Details --}}
            <div class="section-card mb-4">

                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center p-4">
                    <h5 class="mb-0">
                        <i class="fas fa-car me-2"></i> Vehicle Details
                        <span class="text-white ms-2">({{ $vehicle->name }})</span>
                    </h5>
                    <a href="{{ route('admin.vehicles.index') }}" class="btn btn-light btn-sm">
                        <i class="fas fa-arrow-left me-1"></i> Back
                    </a>
                </div>

                <div class="card-body p-4">
                    <div class="row g-3">

                        <div class="col-md-6">
                            <strong>Name:</strong> {{ $vehicle->name }}
                        </div>
                        <div class="col-md-6">
                            <strong>VIN:</strong> {{ $vehicle->vin }}
                        </div>
                        <div class="col-md-6">
                            <strong>Registration Number:</strong> {{ $vehicle->registration_number }}
                        </div>
                        <div class="col-md-6">
                            <strong>Brand / Model:</strong> {{ $vehicle->brand }} / {{ $vehicle->model }}
                        </div>
                        <div class="col-md-6">
                            <strong>Manufacture Year:</strong> {{ $vehicle->manufacture_year }}
                        </div>
                        <div class="col-md-6">
                            <strong>Color:</strong> {{ $vehicle->color ?? '-' }}
                        </div>
                        <div class="col-md-6">
                            <strong>Owner Name:</strong> {{ $vehicle->owner_name }}
                        </div>
                        <div class="col-md-6">
                            <strong>Owner Phone:</strong> {{ $vehicle->owner_phone }}
                        </div>
                        <div class="col-md-6">
                            <strong>Owner Email:</strong> {{ $vehicle->owner_email ?? '-' }}
                        </div>
                        <div class="col-md-6">
                            <strong>Address:</strong> {{ $vehicle->address ?? '-' }}
                        </div>
                        <div class="col-md-6">
                            <strong>Approximate Min / Max:</strong> {{ $vehicle->aproximate_min }} / {{ $vehicle->aproximate_max }}
                        </div>
                        <div class="col-md-6">
                            <strong>Created At:</strong> {{ $vehicle->created_at->format('d M, Y h:i A') }}
                        </div>
                        <div class="col-md-6">
                            <strong>Updated At:</strong> {{ $vehicle->updated_at->format('d M, Y h:i A') }}
                        </div>

                    </div>

                    <div class="mt-4 d-flex gap-2">
                        <a href="{{ route('admin.vehicles.edit', $vehicle->id) }}" class="btn btn-success">
                            <i class="fas fa-edit me-1"></i> Edit
                        </a>

                        <form action="{{ route('admin.vehicles.destroy', $vehicle->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                <i class="fas fa-trash me-1"></i> Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            {{-- Vehicle Policies --}}
            <div class="section-card">

                <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center p-4">
                    <h5 class="mb-0"><i class="fas fa-file-alt me-2"></i> Policies</h5>
                    <a href="{{ route('admin.policies.create', $vehicle->id) }}" class="btn btn-light btn-sm">
                        <i class="fas fa-plus me-1"></i> Add Policy
                    </a>
                </div>

                <div class="card-body p-4">
                    @if($vehicle->policies->count())
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Policy Number</th>
                                        <th>Type</th>
                                        <th>Status</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($vehicle->policies as $key => $policy)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $policy->policy_number }}</td>
                                            <td>{{ $policy->policy_type }}</td>
                                            <td>
                                                <span class="badge 
                                                    @if($policy->status == 'Active') bg-success
                                                    @elseif($policy->status == 'Expired') bg-warning
                                                    @else bg-danger
                                                    @endif">
                                                    {{ $policy->status }}
                                                </span>
                                            </td>
                                            <td>{{ $policy->start_date }}</td>
                                            <td>{{ $policy->end_date }}</td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                                        Actions
                                                    </button>
                                                    <ul class="dropdown-menu dropdown-menu-end">
                                                        <li>
                                                            <a class="dropdown-item" href="{{ route('admin.policies.show', [$vehicle->id, $policy->id]) }}">
                                                                <i class="fas fa-eye me-1"></i> View
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" href="{{ route('admin.policies.edit', [$vehicle->id, $policy->id]) }}">
                                                                <i class="fas fa-edit me-1"></i> Edit
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <form action="{{ route('admin.policies.destroy', [$vehicle->id, $policy->id]) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="dropdown-item text-danger">
                                                                    <i class="fas fa-trash me-1"></i> Delete
                                                                </button>
                                                            </form>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-muted">No policies found for this vehicle.</p>
                    @endif
                </div>

            </div>

        </div>
    </div>
</div>
@endsection