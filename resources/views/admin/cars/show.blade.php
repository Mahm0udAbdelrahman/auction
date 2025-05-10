@extends('admin.layout')
@section('title', __('Show Car'))
@section('content')
<main class="main-wrapper">
    <div class="main-content">
        <div class="row mb-5">
            <div class="col-12">
                <div class="card shadow-lg rounded-4">
                    <div class="card-header d-flex justify-content-between align-items-center bg-primary text-white rounded-top-4">
                        <h5 class="mb-0">{{ __('Car Details') }}</h5>
                        <a href="{{ route('Admin.cars.edit', $car->id) }}" class="btn btn-warning btn-sm">
                            <i class="bi bi-pencil-square"></i> {{ __('Edit') }}
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="row g-4">
                            <div class="col-md-6">
                                <label class="fw-semibold">{{ __('Name Owner') }}</label>
                                <div class="border rounded-3 p-2 bg-light">{{ $car->user->name }}</div>
                            </div>
                             <div class="col-md-6">
                                <label class="fw-semibold">{{ __('Phone Owner') }}</label>
                                <div class="border rounded-3 p-2 bg-light">{{ $car->user->phone }}</div>
                            </div>
                            <div class="col-md-6">
                                <label class="fw-semibold">{{ __('Name') }}</label>
                                <div class="border rounded-3 p-2 bg-light">{{ $car->name }}</div>
                            </div>
                            <div class="col-md-6">
                                <label class="fw-semibold">{{ __('Country') }}</label>
                                <div class="border rounded-3 p-2 bg-light">{{ $car->country->{'name_' . app()->getLocale()} }}</div>
                            </div>
                            <div class="col-md-6">
                                <label class="fw-semibold">{{ __('Type') }}</label>
                                <div class="border rounded-3 p-2 bg-light">{{ $car->carType->name ?? '-' }}</div>
                            </div>
                            <div class="col-md-6">
                                <label class="fw-semibold">{{ __('Model') }}</label>
                                <div class="border rounded-3 p-2 bg-light">{{ $car->model }}</div>
                            </div>
                            <div class="col-md-6">
                                <label class="fw-semibold">{{ __('Color') }}</label>
                                <div class="border rounded-3 p-2 bg-light">{{ $car->color }}</div>
                            </div>
                            <div class="col-md-6">
                                <label class="fw-semibold">{{ __('Kilometer') }}</label>
                                <div class="border rounded-3 p-2 bg-light">{{ $car->kilometer }}</div>
                            </div>
                            <div class="col-md-6">
                                <label class="fw-semibold">{{ __('Price') }}</label>
                                <div class="border rounded-3 p-2 bg-light">{{ $car->price }}</div>
                            </div>
                            <div class="col-md-6">
                                <label class="fw-semibold">{{ __('License Year') }}</label>
                                <div class="border rounded-3 p-2 bg-light">{{ $car->license_year }}</div>
                            </div>
                            <div class="col-md-6">
                                <label class="fw-semibold">{{ __('Status') }}</label>
                                <div class="border rounded-3 p-2 bg-light">{{ ucfirst($car->status) ?? '-' }}</div>
                            </div>
                            <div class="col-12">
                                <label class="fw-semibold">{{ __('Description') }}</label>
                                <div class="border rounded-3 p-3 bg-light">{{ $car->description }}</div>
                            </div>

                            <div class="col-md-6 text-center">
                                <label class="fw-semibold">{{ __('Image License') }}</label>
                                @if (!empty($car->image_license))
                                <div class="d-flex flex-wrap">
                                    @foreach (json_decode($car->image_license, true) as $image_license)
                                        <div class="me-3 text-center">
                                            <a href="{{ asset($image_license) }}" target="_blank">
                                                <img src="{{ asset($image_license) }}" alt="License Image" class="img-thumbnail mt-2 rounded" style="max-height: 120px;">
                                            </a>
                                            <br>
                                            <a href="{{ asset($image_license) }}" download class="btn btn-sm btn-primary mt-1">
                                                <i class="fas fa-download"></i> {{ __('Download') }}
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                            </div>

                            <div class="col-md-6 text-center">
                                <label class="fw-semibold">{{ __('Report') }}</label><br>
                                @if ($car->report)
                                            <div class="mt-2">
                                                <a href="{{ asset($car->report) }}" target="_blank" class="btn btn-link">{{ __('View Report') }}</a>

                                                <a href="{{ asset($car->report) }}" download class="btn btn-primary btn-sm">
                                                    <i class="fas fa-download"></i> {{ __('Download Report') }}
                                                </a>
                                            </div>
                                        @endif
                            </div>

                            <div class="col-12">
                                <label class="fw-semibold">{{ __('Car Images') }}</label>
                                @if ($car->carImages && count($car->carImages))
                                <div class="d-flex flex-wrap gap-3">
                                    @foreach ($car->carImages as $image)
                                        <div class="border rounded-3 p-1 shadow-sm text-center">
                                            <a href="{{ asset($image->image) }}" target="_blank">
                                                <img src="{{ asset($image->image) }}" alt="Car Image"
                                                    class="img-thumbnail" style="width: 120px; height: 100px;">
                                            </a>
                                            <div class="mt-1">
                                                <a href="{{ asset($image->image) }}" download class="btn btn-sm btn-primary">
                                                    <i class="fas fa-download"></i> {{ __('Download') }}
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-muted">-</p>
                            @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-4">
                    <a href="{{ route('Admin.cars.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left-circle"></i> {{ __('Back') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
