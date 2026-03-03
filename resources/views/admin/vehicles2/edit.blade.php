@extends('layouts.admin2')
@section('title', 'Edit Vehicle')

@section('content')
<div class="mt-5 pt-4">
    <div class="row justify-content-center">
        <div class="col-lg-12">

            <div class="section-card">

                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center p-4">
                    <h5 class="mb-0">
                        <i class="fas fa-edit me-2"></i> Edit Vehicle
                        <span class="text-white ms-2">({{ $vehicle->name }})</span>
                    </h5>
                    <a href="{{ route('admin.vehicles.index') }}" class="btn btn-light btn-sm">
                        <i class="fas fa-arrow-left me-1"></i> Back
                    </a>
                </div>

                <div class="card-body p-4">
                    <form action="{{ route('admin.vehicles.update', $vehicle->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row g-3">

                            <div class="col-md-6">
                                <label class="form-label">VIN *</label>
                                <input type="text" name="vin" class="form-control"
                                       value="{{ old('vin', $vehicle->vin) }}" required>
                                @error('vin') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Registration Number *</label>
                                <input type="text" name="registration_number" class="form-control"
                                       value="{{ old('registration_number', $vehicle->registration_number) }}" required>
                                @error('registration_number') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Brand *</label>
                                <input type="text" name="brand" class="form-control"
                                       value="{{ old('brand', $vehicle->brand) }}" required>
                                @error('brand') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Model *</label>
                                <input type="text" name="model" class="form-control"
                                       value="{{ old('model', $vehicle->model) }}" required>
                                @error('model') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Manufacture Year *</label>
                                <input type="text" name="manufacture_year" class="form-control"
                                       value="{{ old('manufacture_year', $vehicle->manufacture_year) }}" required>
                                @error('manufacture_year') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Color</label>
                                <input type="text" name="color" class="form-control"
                                       value="{{ old('color', $vehicle->color) }}">
                                @error('color') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Owner Name *</label>
                                <input type="text" name="owner_name" class="form-control"
                                       value="{{ old('owner_name', $vehicle->owner_name) }}" required>
                                @error('owner_name') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Owner Phone *</label>
                                <input type="text" name="owner_phone" class="form-control"
                                       value="{{ old('owner_phone', $vehicle->owner_phone) }}" required>
                                @error('owner_phone') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Owner Email</label>
                                <input type="email" name="owner_email" class="form-control"
                                       value="{{ old('owner_email', $vehicle->owner_email) }}">
                                @error('owner_email') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <div class="col-md-12">
                                <label class="form-label">Address</label>
                                <textarea name="address" class="form-control" rows="2">{{ old('address', $vehicle->address) }}</textarea>
                                @error('address') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Approximate Min *</label>
                                <input type="text" name="aproximate_min" class="form-control"
                                       value="{{ old('aproximate_min', $vehicle->aproximate_min) }}" required>
                                @error('aproximate_min') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Approximate Max *</label>
                                <input type="text" name="aproximate_max" class="form-control"
                                       value="{{ old('aproximate_max', $vehicle->aproximate_max) }}" required>
                                @error('aproximate_max') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                        </div>

                        <div class="text-end mt-4">
                            <a href="{{ route('admin.vehicles.index') }}" class="btn btn-secondary me-2">Cancel</a>
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