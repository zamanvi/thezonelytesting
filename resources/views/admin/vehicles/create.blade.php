@extends('layouts.admin')

@section('title')
    Add New Vehicle
@endsection

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.vehicles.index') }}">Vehicles</a></li>
            <li class="breadcrumb-item active" aria-current="page">Create Vehicle</li>
        </ul>
    </nav>
@endsection

@section('content')
    <div class="container-fluid">

        <div class="row justify-content-center">
            <div class="col-lg-12">

                <div class="iq-card">
                    <div class="iq-card-header d-flex justify-content-between">
                        <h4 class="card-title">Create New Vehicle</h4>
                        <a href="{{ route('admin.vehicles.index') }}" class="btn btn-primary btn-sm">Back</a>
                    </div>

                    <div class="iq-card-body">

                        <form action="{{ route('admin.vehicles.store') }}" method="POST">
                            @csrf

                            <div class="row">

                                <div class="col-md-6 form-group">
                                    <label>Name *</label>
                                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                                    @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                                
                                <div class="col-md-6 form-group">
                                    <label>VIN *</label>
                                    <input type="text" name="vin" class="form-control" value="{{ old('vin') }}" required>
                                    @error('vin') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>

                                <div class="col-md-6 form-group">
                                    <label>Registration Number *</label>
                                    <input type="text" name="registration_number" class="form-control" value="{{ old('registration_number') }}" required>
                                    @error('registration_number') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>

                                <div class="col-md-6 form-group">
                                    <label>Brand *</label>
                                    <input type="text" name="brand" class="form-control" value="{{ old('brand') }}" required>
                                    @error('brand') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>

                                <div class="col-md-6 form-group">
                                    <label>Model *</label>
                                    <input type="text" name="model" class="form-control" value="{{ old('model') }}" required>
                                    @error('model') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>

                                <div class="col-md-6 form-group">
                                    <label>Manufacture Year *</label>
                                    <input type="text" name="manufacture_year" class="form-control" value="{{ old('manufacture_year') }}" required>
                                    @error('manufacture_year') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>

                                <div class="col-md-6 form-group">
                                    <label>Color</label>
                                    <input type="text" name="color" class="form-control" value="{{ old('color') }}">
                                    @error('color') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>

                                <div class="col-md-6 form-group">
                                    <label>Owner Name *</label>
                                    <input type="text" name="owner_name" class="form-control" value="{{ old('owner_name') }}" required>
                                    @error('owner_name') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>

                                <div class="col-md-6 form-group">
                                    <label>Owner Phone *</label>
                                    <input type="text" name="owner_phone" class="form-control" value="{{ old('owner_phone') }}" required>
                                    @error('owner_phone') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>

                                <div class="col-md-6 form-group">
                                    <label>Owner Email</label>
                                    <input type="email" name="owner_email" class="form-control" value="{{ old('owner_email') }}">
                                    @error('owner_email') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>

                                <div class="col-md-12 form-group">
                                    <label>Address</label>
                                    <textarea name="address" class="form-control" rows="2">{{ old('address') }}</textarea>
                                    @error('address') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>

                                <div class="col-md-6 form-group">
                                    <label>Approximate Min *</label>
                                    <input type="text" name="aproximate_min" class="form-control" value="{{ old('aproximate_min') }}" required>
                                    @error('aproximate_min') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>

                                <div class="col-md-6 form-group">
                                    <label>Approximate Max *</label>
                                    <input type="text" name="aproximate_max" class="form-control" value="{{ old('aproximate_max') }}" required>
                                    @error('aproximate_max') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>

                            </div>

                            <button type="submit" class="btn btn-primary mt-3">Submit</button>
                            <button type="reset" class="btn btn-danger mt-3">Cancel</button>

                        </form>
                    </div>

                </div>
            </div>
        </div>

    </div>
@endsection
