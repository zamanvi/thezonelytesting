@extends('layouts.admin')

@section('title')
    Show Vehicle
@endsection

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.vehicles.index') }}">Vehicles</a></li>
            <li class="breadcrumb-item active" aria-current="page">Show</li>
        </ul>
    </nav>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 mx-auto">

            {{-- Vehicle Details --}}
            <div class="iq-card mb-4">
                <div class="iq-card-header d-flex justify-content-between">
                    <h4 class="card-title">Vehicle Details</h4>
                    <a href="{{ route('admin.vehicles.index') }}" class="btn btn-secondary">Back to List</a>
                </div>

                <div class="iq-card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th style="width: 200px;">Vehicle Name</th>
                            <td>{{ $vehicle->name }}</td>
                        </tr>
                        <tr>
                            <th>VIN</th>
                            <td>{{ $vehicle->vin }}</td>
                        </tr>
                        <tr>
                            <th>Registration Number</th>
                            <td>{{ $vehicle->registration_number }}</td>
                        </tr>
                        <tr>
                            <th>Brand / Model</th>
                            <td>{{ $vehicle->brand }} / {{ $vehicle->model }}</td>
                        </tr>
                        <tr>
                            <th>Manufacture Year</th>
                            <td>{{ $vehicle->manufacture_year }}</td>
                        </tr>
                        <tr>
                            <th>Color</th>
                            <td>{{ $vehicle->color ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Owner</th>
                            <td>
                                {{ $vehicle->owner_name }}<br>
                                {{ $vehicle->owner_phone }}<br>
                                {{ $vehicle->owner_email ?? '-' }}<br>
                                {{ $vehicle->address ?? '-' }}
                            </td>
                        </tr>
                        <tr>
                            <th>Approximate Min / Max</th>
                            <td>{{ $vehicle->aproximate_min }} / {{ $vehicle->aproximate_max }}</td>
                        </tr>
                        <tr>
                            <th>Created At</th>
                            <td>{{ $vehicle->created_at->format('d M, Y h:i A') }}</td>
                        </tr>
                        <tr>
                            <th>Updated At</th>
                            <td>{{ $vehicle->updated_at->format('d M, Y h:i A') }}</td>
                        </tr>
                    </table>

                    <div class="mt-3 d-flex gap-2">
                        <a href="{{ route('admin.vehicles.edit', $vehicle->id) }}" class="btn btn-primary">Edit Vehicle</a>

                        <form action="{{ route('admin.vehicles.destroy', $vehicle->id) }}" method="POST"
                              onsubmit="return confirm('Are you sure?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>

            {{-- Vehicle Policies --}}
            <div class="iq-card">
                <div class="iq-card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">Policies</h4>
                    <a href="{{ route('admin.policies.create', $vehicle->id) }}" class="btn btn-primary btn-sm">
                        <i class="ri-add-line"></i> Add Policy
                    </a>
                </div>

                <div class="iq-card-body">
                    @if($vehicle->policies->count())
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
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
                                                    @if($policy->status == 'Active') badge-success
                                                    @elseif($policy->status == 'Expired') badge-warning
                                                    @else badge-danger
                                                    @endif">
                                                    {{ $policy->status }}
                                                </span>
                                            </td>
                                            <td>{{ $policy->start_date }}</td>
                                            <td>{{ $policy->end_date }}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-primary btn-sm dropdown-toggle"
                                                            data-toggle="dropdown">
                                                        Actions
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="{{ route('admin.policies.show', [$vehicle->id, $policy->id]) }}">
                                                            <i class="ri-eye-line"></i> View
                                                        </a>
                                                        <a class="dropdown-item" href="{{ route('admin.policies.edit', [$vehicle->id, $policy->id]) }}">
                                                            <i class="ri-edit-line"></i> Edit
                                                        </a>
                                                        <form action="{{ route('admin.policies.destroy', [$vehicle->id, $policy->id]) }}"
                                                              method="POST" onsubmit="return confirm('Are you sure?');">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="dropdown-item text-danger">
                                                                <i class="ri-delete-bin-line"></i> Delete
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p>No policies found for this vehicle.</p>
                    @endif
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
