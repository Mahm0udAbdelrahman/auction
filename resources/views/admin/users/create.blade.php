@extends('admin.layout')
@section('title', __('Add User'))

@section('content')
    <!--start main wrapper-->
    <main class="main-wrapper">
        <div class="main-content">
            <div class="row mb-5">
                <div class="col-12">
                    <form method="post" action="{{ route('Admin.users.store') }}" class="p-4 rounded shadow-lg bg-white" enctype="multipart/form-data">
                        @csrf
                        <div class="card border-0">
                            <div class="card-header bg-primary text-white rounded-top">
                                <h5 style="color:#fff;" class="mb-0">{{ __('Add a new user') }}</h5>
                            </div>
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="name" class="form-label">{{ __('Name') }}</label>
                                        <input type="text" name="name" id="name" class="form-control" placeholder="{{ __('Enter the user name') }}">
                                    </div>
                                    @error('name')
                                            <small class="text-danger">{{ $message }}</small>

                                     @enderror
                                    <div class="col-md-6">
                                        <label for="email" class="form-label">{{ __('Email') }}</label>
                                        <input type="email" name="email" id="email" class="form-control" placeholder="{{ __('Enter the user email') }}">
                                    </div>
                                    @error('email')
                                            <small class="text-danger">{{ $message }}</small>

                                     @enderror

                                     <div class="col-md-6">
                                        <label for="service" class="form-label">{{ __('Country') }}</label>
                                        <select class="form-select" name="country_id" id="service">
                                            <option  disabled selected>{{ __('Choose Country...') }}</option>
                                            @foreach ($countries as $country)
                                            <option value="{{ $country->id }}">{{ $country->{'name_'.app()->getLocale()} }}</option>
                                            @endforeach
                                        </select>
                                        @error('country_id')
                                                    <small class="text-danger">{{ $message }}</small>

                                        @enderror
                                    </div>

                                     <div class="col-md-6">
                                        <label for="image" class="form-label">{{ __('Image') }}</label>
                                        <input type="file" name="image" id="image" class="form-control" placeholder="{{ __('Enter the user image') }}">
                                    </div>
                                    @error('image')
                                            <small class="text-danger">{{ $message }}</small>

                                     @enderror


                                    <div class="col-md-6">
                                        <label for="phone" class="form-label">{{ __('Mobile Number') }}</label>
                                        <input type="number" name="phone" id="phone" class="form-control" placeholder="{{ __('Enter the user mobile number') }}">
                                    </div>
                                    @error('phone')
                                            <small class="text-danger">{{ $message }}</small>

                                     @enderror

                                    <!--<div class="col-md-6">-->
                                    <!--    <label for="national_number" class="form-label">{{ __('National Number') }}</label>-->
                                    <!--    <input type="number" name="national_number" id="national_number" class="form-control" placeholder="{{ __('Enter the user national number') }}">-->
                                    <!--</div>-->
                                    <!--@error('national_number')-->
                                    <!--        <small class="text-danger">{{ $message }}</small>-->

                                    <!-- @enderror-->

                                    <div class="col-md-6">
                                        <label for="service" class="form-label">{{ __('Service') }}</label>
                                        <select class="form-select" name="service" id="service">
                                            <option value="" selected>{{ __('Choose Service...') }}</option>
                                            <option value="vendor">{{ __('Vendor') }}</option>
                                            <option value="buyer">{{ __('Buyer') }}</option>
                                        </select>
                                        @error('service')
                                                    <small class="text-danger">{{ $message }}</small>

                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label for="category" class="form-label">{{ __('Category') }}</label>
                                        <select class="form-select" name="category" id="category">
                                            <option value="" selected>{{ __('Choose Category...') }}</option>
                                            <option value="my">{{ __('My') }}</option>
                                            <option value="dealer">{{ __('Dealer') }}</option>
                                        </select>
                                        @error('category')
                                                    <small class="text-danger">{{ $message }}</small>

                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label for="password" class="form-label">{{ __('Password') }}</label>
                                        <input type="password" name="password" id="password" class="form-control" placeholder="{{ __('Enter the user password') }}">
                                    </div>
                                    @error('password')
                                            <small class="text-danger">{{ $message }}</small>

                                     @enderror

                                    <div class="col-md-6">
                                        <label for="role_id" class="form-label">{{ __('Role') }}</label>
                                        <select class="form-select" name="role_id" id="role_id">
                                            <option value="" selected>{{ __('Choose the user role') }}</option>
                                            @foreach ($roles as $role)
                                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('role_id')
                                            <small class="text-danger">{{ $message }}</small>

                                     @enderror
                                </div>
                            </div>
                            <div class="card-footer text-end bg-light rounded-bottom">
                                <button type="submit" class="btn btn-primary px-4">{{ __('Save') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <!--end main wrapper-->
@endsection
