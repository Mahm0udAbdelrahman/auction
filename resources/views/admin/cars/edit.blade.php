@extends('admin.layout')
@section('title', __('Edit Car'))
@section('content')
    <!--start main wrapper-->
    <main class="main-wrapper">
        <div class="main-content">
            <div class="row mb-5">
                <div class="col-12">
                    <form method="post" action="{{ route('Admin.cars.update', $car->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card shadow-sm rounded-4">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">{{ __('Edit Car') }}</h5>
                            </div>
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label">{{ __('Name Owner') }}</label>
                                        <span class="form-control"> {{ $car->user->name }} </span>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">{{ __('Phone Owner') }}</label>
                                        <span class="form-control"> {{ $car->user->phone }} </span>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">{{ __('Name') }}</label>
                                        <input type="text" name="name" value="{{ $car->name }}"
                                            class="form-control" placeholder="{{ __('Enter car name') }}">
                                        @error('name')
                                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    {{-- <div class="col-md-6">
                                    <label class="form-label">{{ __('Country') }}</label>
                                    <input type="text" name="country_id" value="{{ $car->country->{'name_' . app()->getLocale()} }}" class="form-control" placeholder="{{ __('Enter car name') }}">
                                    @error('country_id')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                                </div> --}}
                                    <div class="col-md-6">
                                        <label class="form-label">{{ __('Country') }}</label>
                                        <select class="form-select" name="country_id">
                                            <option disabled>{{ __('Choose Country...') }}</option>
                                            @foreach ($countries as $country)
                                                <option value="{{ $country->id }}" @selected($car->country_id == $country->id)>
                                                    {{ $country->{'name_' . app()->getLocale()} }}</option>
                                            @endforeach

                                        </select>
                                        @error('country_id')
                                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">{{ __('Type') }}</label>
                                        <select class="form-select" name="car_type_id">
                                            <option disabled>{{ __('Choose Type...') }}</option>
                                            @foreach ($types as $type)
                                                <option value="{{ $type->id }}"
                                                    {{ $car->car_type_id == $type->id ? 'selected' : '' }}>
                                                    {{ $type->{'name_' . app()->getLocale()} }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('car_type_id')
                                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">{{ __('Model') }}</label>
                                        <input type="text" name="model" value="{{ $car->model }}"
                                            class="form-control" placeholder="{{ __('Enter model') }}">
                                        @error('model')
                                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">{{ __('Color') }}</label>
                                        <input type="text" name="color" value="{{ $car->color }}"
                                            class="form-control" placeholder="{{ __('Enter color') }}">
                                        @error('color')
                                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">{{ __('Kilometer') }}</label>
                                        <input type="text" name="kilometer" value="{{ $car->kilometer }}"
                                            class="form-control" placeholder="{{ __('Enter kilometers') }}">
                                        @error('kilometer')
                                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">{{ __('Price') }}</label>
                                        <input type="number" name="price" value="{{ $car->price }}"
                                            class="form-control" placeholder="{{ __('Enter price') }}">
                                        @error('price')
                                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">{{ __('License Year') }}</label>
                                        <input type="text" name="license_year" value="{{ $car->license_year }}"
                                            class="form-control" placeholder="{{ __('Enter license year') }}">
                                        @error('license_year')
                                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">{{ __('Description') }}</label>
                                        <textarea class="form-control" name="description" rows="3" placeholder="{{ __('Enter description') }}">{{ $car->description }}</textarea>
                                        @error('description')
                                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">{{ __('Image License') }}</label>
                                        <input type="file" name="image_license" class="form-control">
                                       
                                        @if (!empty($car->image_license))
                                            <div class="d-flex flex-wrap">
                                                @foreach (json_decode($car->image_license, true) as $image_license)
                                                    <div class="me-3 text-center">
                                                        <a href="{{ asset($image_license) }}" target="_blank">
                                                            <img src="{{ asset($image_license) }}" alt="License Image"
                                                                class="img-thumbnail mt-2 rounded"
                                                                style="max-height: 120px;">
                                                        </a>
                                                        <br>
                                                        <a href="{{ asset($image_license) }}" download
                                                            class="btn btn-sm btn-primary mt-1">
                                                            <i class="fas fa-download"></i> {{ __('Download') }}
                                                        </a>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endif


                                        @error('image_license')
                                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>

                                 
                                    <div class="col-md-6">
                                        <label class="form-label">{{ __('Report') }}</label>
                                        <input type="file" name="report" class="form-control">

                                        @if ($car->report)
                                            <div class="mt-2">
                                                <a href="{{ asset($car->report) }}" target="_blank" class="btn btn-link">{{ __('View Report') }}</a>

                                                <a href="{{ asset($car->report) }}" download class="btn btn-primary btn-sm">
                                                    <i class="fas fa-download"></i> {{ __('Download Report') }}
                                                </a>
                                            </div>
                                        @endif

                                        @error('report')
                                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>


                                   

                                    <div class="col-md-6">
                                        <label class="form-label">{{ __('Car Images') }}</label>
                                        <input type="file" name="images[]" class="form-control" multiple>

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

                                        @error('images')
                                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>


                                    <div class="col-md-6">
                                        <label class="form-label">{{ __('Status') }}</label>
                                        <select class="form-select" name="status">
                                            <option disabled>{{ __('Choose status...') }}</option>
                                            <option value="pending" {{ $car->status == 'pending' ? 'selected' : '' }}>
                                                {{ __('Pending') }}</option>
                                            <option value="approved" {{ $car->status == 'approved' ? 'selected' : '' }}>
                                                {{ __('Approved') }}</option>
                                            <option value="rejected" {{ $car->status == 'rejected' ? 'selected' : '' }}>
                                                {{ __('Rejected') }}</option>
                                        </select>
                                        @error('status')
                                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>

                                </div>
                            </div>
                            <div class="card-footer text-end">
                                <button type="submit"
                                    class="btn btn-primary rounded-3 px-4">{{ __('Save') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <!--end main wrapper-->
@endsection
