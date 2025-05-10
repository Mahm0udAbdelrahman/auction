@extends('admin.layout')
@section('title', __('Create Car'))
@section('content')
<main class="main-wrapper">
    <div class="main-content">
        <div class="row mb-5">
            <div class="col-12">
                <div class="card shadow-lg rounded-4">
                    <div class="card-header d-flex justify-content-between align-items-center bg-success text-white rounded-top-4">
                        <h5 class="mb-0">{{ __('Create Insurance') }}</h5>
                        <a href="{{ route('Admin.insurances.index') }}" class="btn btn-secondary btn-sm">
                            <i class="bi bi-arrow-left-circle"></i> {{ __('Back') }}
                        </a>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('Admin.insurances.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row g-4">

                                <div class="col-md-6">
                                    <label class="form-label">{{ __('User') }}</label>
                                    <select class="form-select" name="user_id">
                                        <option selected disabled>{{ __('Choose User...') }}</option>
                                        @foreach ($users as $user)
                                        <option value="{{ $user->id }}" >{{ $user->name }}</option>
                                        @endforeach

                                    </select>
                                    @error('user_id')
                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>



                                <div class="col-md-6">
                                    <label class="form-label">{{ __('Balance') }}</label>
                                    <input type="number" name="balance"  class="form-control" placeholder="{{ __('Enter Balance') }}">
                                    @error('balance')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">{{ __('Status') }}</label>
                                    <select class="form-select" name="payment_status">
                                        <option selected disabled>{{ __('Choose Status...') }}</option>
                                        <option value="pending" >{{ __('Pending') }}</option>
                                        <option value="faild" >{{ __('Faild') }}</option>
                                        <option value="paid">{{ __('Paid') }}</option>
                                    </select>
                                    @error('payment_status')
                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                    @enderror
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
