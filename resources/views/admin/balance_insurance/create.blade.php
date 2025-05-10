@extends('admin.layout')
@section('title', __('Add Country'))

@section('content')
<!--start main wrapper-->
<main class="main-wrapper">
    <div class="main-content">
        <div class="row mb-5">
            <div class="col-12 col-xl-12">
                <form method="post" action="{{ route('Admin.balance_insurances.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <h6>{{ __('Add Balance Insurance') }}</h6>
                            </div>
                            <hr>
                            <div class="row">

                                <div class="col-md-6">
                                    <label for="service" class="form-label">{{ __('Service') }}</label>
                                    <select class="form-select" name="service" id="service">
                                        <option disabled selected>{{ __('Choose Service...') }}</option>
                                        <option value="vendor">{{ __('Vendor') }}</option>
                                        <option value="buyer">{{ __('Buyer') }}</option>
                                    </select>
                                    @error('service')
                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="category" class="form-label">{{ __('Category') }}</label>
                                    <select class="form-select" name="category" id="category">
                                        <option disabled selected>{{ __('Choose Category...') }}</option>
                                        <option value="my">{{ __('My') }}</option>
                                        <option value="dealer">{{ __('Dealer') }}</option>
                                    </select>
                                    @error('category')
                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-6 col-lg-4 mb-3">
                                <label class="form-label">{{ __('Country') }}</label>
                                <select name="country_id" id="carCountry" class="form-select">
                                    <option disabled selected>{{ __('Choose Country...') }}</option>
                                    @foreach ($countries as $country)
                                        <option value="{{ $country->id }}">{{ $country->{'name_' . app()->getLocale()} }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                                 <div class="col-6 col-xl-6 mt-3">
                                    <input type="text" name="currency" class="form-control" placeholder="{{ __('Enter Currency') }}">
                                </div>

                                <div class="col-6 col-xl-6 mt-3">
                                    <input type="text" name="min_balance" class="form-control" placeholder="{{ __('Enter Balance') }}">
                                </div>



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
