@extends('admin.layout')
@section('title', __('Edit Country'))

@section('content')
<!--start main wrapper-->
<main class="main-wrapper">
    <div class="main-content">
        <div class="row mb-5">
            <div class="col-12 col-xl-12">
                <form method="post" action="{{ route('Admin.balance_insurances.update', $balance_insurance->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <h6>{{ __('Edit Balance Insurance') }}</h6>
                            </div>
                            <hr>
                            <div class="row">
                                <!-- Service -->
                                <div class="col-md-6">
                                    <label for="service" class="form-label">{{ __('Service') }}</label>
                                    <select class="form-select" name="service" id="service">
                                        <option disabled>{{ __('Choose Service...') }}</option>
                                        <option value="vendor" {{ old('service', $balance_insurance->service) === 'vendor' ? 'selected' : '' }}>{{ __('Vendor') }}</option>
                                        <option value="buyer" {{ old('service', $balance_insurance->service) === 'buyer' ? 'selected' : '' }}>{{ __('Buyer') }}</option>
                                    </select>
                                    @error('service') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                                </div>

                                <!-- Category -->
                                <div class="col-md-6">
                                    <label for="category" class="form-label">{{ __('Category') }}</label>
                                    <select class="form-select" name="category" id="category">
                                        <option disabled>{{ __('Choose Category...') }}</option>
                                        <option value="my" {{ old('category', $balance_insurance->category) === 'my' ? 'selected' : '' }}>{{ __('My') }}</option>
                                        <option value="dealer" {{ old('category', $balance_insurance->category) === 'dealer' ? 'selected' : '' }}>{{ __('Dealer') }}</option>
                                    </select>
                                    @error('category') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                                </div>
                                
                               <div class="col-6 col-lg-4 mb-3">
    <label class="form-label">{{ __('Country') }}</label>
    <select name="country_id" id="carCountry" class="form-select">
        @foreach ($countries as $country)
            <option @selected($balance_insurance->country_id == $country->id) value="{{ $country->id }}">
                {{ $country->{'name_' . app()->getLocale()} }}
            </option>
        @endforeach
    </select>
</div>

                            
                            
                             <div class="col-6 col-xl-6 mt-3">
                                    <input type="text" name="currency"  value="{{ $balance_insurance->currency }}" class="form-control" placeholder="{{ __('Enter Currency') }}">
                                </div>

                                <div class="col-6 col-xl-6 mt-3">
                                    <input type="text" name="min_balance" value="{{ $balance_insurance->min_balance }}" class="form-control" placeholder="{{ __('Enter Min Balance') }}">
                                </div>

                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                </form>
            </div>
        </div>
    </div>
</main>
<!--end main wrapper-->
@endsection
