@extends('layouts.admin')
@section('title')
    Vehicle Panel
@endsection

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Vehicles</li>
        </ul>
    </nav>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">

            <div class="col-lg-12">
                <div class="iq-card">

                    <div class="iq-card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title">Vehicles List</h4>
                        <a href="{{ route('admin.vehicles.create') }}" class="btn btn-primary btn-sm">Add Vehicle</a>
                    </div>

                    <div class="iq-card-body">

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>VIN</th>
                                        <th>Registration</th>
                                        <th>Brand</th>
                                        <th>Model</th>
                                        <th>Owner</th>
                                        <th>Phone</th>
                                        <th width="120">Actions</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @forelse ($vehicles as $key => $vehicle)
                                        <tr>
                                            <td>{{ $key + $vehicles->firstItem() }}</td>
                                            <td>{{ $vehicle->vin }}</td>
                                            <td>{{ $vehicle->registration_number }}</td>
                                            <td>{{ $vehicle->brand }}</td>
                                            <td>{{ $vehicle->model }}</td>
                                            <td>{{ $vehicle->owner_name }}</td>
                                            <td>{{ $vehicle->owner_phone }}</td>

                                            <td>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-primary btn-sm dropdown-toggle"
                                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        Options
                                                    </button>

                                                    <div class="dropdown-menu">

                                                        {{-- View --}}
                                                        <a class="dropdown-item"
                                                            href="{{ route('admin.vehicles.show', $vehicle->id) }}">
                                                            <i class="ri-eye-line"></i> View
                                                        </a>

                                                        {{-- Edit --}}
                                                        <a class="dropdown-item"
                                                            href="{{ route('admin.vehicles.edit', $vehicle->id) }}">
                                                            <i class="ri-edit-line"></i> Edit
                                                        </a>

                                                        {{-- Delete --}}
                                                        <form action="{{ route('admin.vehicles.destroy', $vehicle->id) }}"
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

                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center">No Vehicles Found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-3">
                            {{ $vehicles->links() }}
                        </div>

                    </div>

                </div>
            </div>

        </div>
    </div>
@endsection
