@extends('layouts.admin2')
@section('title', 'Vehicle Panel')

@section('content')
<div class="mt-5 pt-4">
    <div class="row g-4">

        {{-- FULL WIDTH: Vehicles List --}}
        <div class="col-lg-12">
            <div class="section-card">

                <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center p-4">
                    <h5 class="mb-0">
                        <i class="fas fa-car me-2"></i>
                        Vehicles List
                    </h5>
                    <a href="{{ route('admin.vehicles.create') }}" class="btn btn-light btn-sm">
                        <i class="fas fa-plus me-1"></i> Add Vehicle
                    </a>
                </div>

                <div class="card-body p-4">

                    @if($vehicles && $vehicles->count())
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>VIN</th>
                                        <th>Registration</th>
                                        <th>Brand</th>
                                        <th>Model</th>
                                        <th>Owner</th>
                                        <th>Phone</th>
                                        <th width="10">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($vehicles as $key => $vehicle)
                                        <tr>
                                            <td>{{ $key + $vehicles->firstItem() }}</td>
                                            <td>{{ $vehicle->vin }}</td>
                                            <td>{{ $vehicle->registration_number }}</td>
                                            <td>{{ $vehicle->brand }}</td>
                                            <td>{{ $vehicle->model }}</td>
                                            <td>{{ $vehicle->owner_name }}</td>
                                            <td>{{ $vehicle->owner_phone }}</td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-sm btn-light" type="button"
                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="fas fa-ellipsis-v"></i>
                                                    </button>

                                                    <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                                                        {{-- View --}}
                                                        <li>
                                                            <a class="dropdown-item"
                                                               href="{{ route('admin.vehicles.show', $vehicle->id) }}">
                                                               <i class="fas fa-eye me-2 text-info"></i> View
                                                            </a>
                                                        </li>

                                                        {{-- Edit --}}
                                                        <li>
                                                            <a class="dropdown-item"
                                                               href="{{ route('admin.vehicles.edit', $vehicle->id) }}">
                                                               <i class="fas fa-edit me-2 text-primary"></i> Edit
                                                            </a>
                                                        </li>

                                                        <li><hr class="dropdown-divider"></li>

                                                        {{-- Delete --}}
                                                        <li>
                                                            <form action="{{ route('admin.vehicles.destroy', $vehicle->id) }}"
                                                                  method="POST" onsubmit="return confirm('Are you sure?');">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="dropdown-item text-danger">
                                                                    <i class="fas fa-trash me-2"></i> Delete
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

                        <div class="mt-3">
                            {{ $vehicles->links() }}
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-car fa-3x text-muted mb-3"></i>
                            <p class="text-muted">No Vehicles Found</p>
                        </div>
                    @endif

                </div>
            </div>
        </div>

    </div>
</div>
@endsection