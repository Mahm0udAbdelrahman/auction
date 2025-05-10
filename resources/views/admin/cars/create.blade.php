@extends('admin.layout')
@section('title', __('Create Car'))
@section('content')
<main class="main-wrapper">
    <div class="main-content">
        <div class="row mb-5">
            <div class="col-12">
                <div class="card shadow-lg rounded-4">
                    <div class="card-header d-flex justify-content-between align-items-center bg-success text-white rounded-top-4">
                        <h5 class="mb-0">{{ __('Create New Car') }}</h5>
                        <a href="{{ route('Admin.cars.index') }}" class="btn btn-secondary btn-sm">
                            <i class="bi bi-arrow-left-circle"></i> {{ __('Back') }}
                        </a>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('Admin.cars.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <label class="fw-semibold">{{ __('Name') }}</label>
                                    <input type="text" name="name" class="form-control" required placeholder="{{ __('Enter Car Name') }}">
                                </div>

                                <div class="col-md-6">
                                    <label class="fw-semibold">{{ __('Type') }}</label>
                                    <select name="car_type_id" class="form-select" required>
                                        <option value="">{{ __('Select Type') }}</option>
                                        @foreach($carTypes as $type)
                                            <option value="{{ $type->id }}">{{ $type->{'name_' . app()->getLocale()} }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label class="fw-semibold">{{ __('Model') }}</label>
                                    <input type="text" name="model" class="form-control" required placeholder="{{ __('Enter Model') }}">
                                </div>

                                <div class="col-md-6">
                                    <label class="fw-semibold">{{ __('Color') }}</label>
                                    <input type="text" name="color" class="form-control" required placeholder="{{ __('Enter Color') }}">
                                </div>

                                <div class="col-md-6">
                                    <label class="fw-semibold">{{ __('Kilometer') }}</label>
                                    <input type="number" name="kilometer" class="form-control" required placeholder="{{ __('Enter Kilometer') }}">
                                </div>

                                <div class="col-md-6">
                                    <label class="fw-semibold">{{ __('Price') }}</label>
                                    <input type="number" name="price" class="form-control" required placeholder="{{ __('Enter Price') }}">
                                </div>

                                <div class="col-md-6">
                                    <label class="fw-semibold">{{ __('License Year') }}</label>
                                    <input type="number" name="license_year" class="form-control" required placeholder="{{ __('Enter License Year') }}">
                                </div>

                                <div class="col-md-6">
                                    <label class="fw-semibold">{{ __('Status') }}</label>
                                    <select name="status" class="form-select" required>
                                        <option value="available">{{ __('Available') }}</option>
                                        <option value="sold">{{ __('Sold') }}</option>
                                        <option value="maintenance">{{ __('Maintenance') }}</option>
                                    </select>
                                </div>

                                <div class="col-12">
                                    <label class="fw-semibold">{{ __('Description') }}</label>
                                    <textarea name="description" class="form-control" rows="4" placeholder="{{ __('Enter Description') }}"></textarea>
                                </div>

                                <div class="col-md-6">
                                    <label class="fw-semibold">{{ __('Image License') }}</label>
                                    <input type="file" name="image_license" class="form-control">
                                </div>

                                <div class="col-md-6">
                                    <label class="fw-semibold">{{ __('Report') }}</label>
                                    <input type="file" name="report" class="form-control">
                                </div>

                                <div class="col-12">
                                    <label class="fw-semibold">{{ __('Car Images') }}</label>
                                    <input type="file" name="car_images[]" class="form-control" multiple>
                                </div>

                                <div class="col-12 text-end">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-save"></i> {{ __('Save') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
