@extends('admin.layout')
@section('title', __('Edit Insurance'))
@section('content')
<!--start main wrapper-->
<main class="main-wrapper">
    <div class="main-content">
        <div class="row mb-5">
            <div class="col-12">
                <form method="post" action="{{ route('Admin.insurances.update', $insurance->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card shadow-sm rounded-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">{{ __('Edit Insurance') }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">



                                <div class="col-md-6">
                                    <label class="form-label">{{ __('User') }}</label>
                                    <select class="form-select" name="user_id">
                                        <option disabled>{{ __('Choose User...') }}</option>
                                        @foreach ($users as $user)
                                        <option value="{{ $user->id }}" @selected($insurance->user_id == $user->id) >{{ $user->name }}</option>
                                        @endforeach

                                    </select>
                                    @error('user_id')
                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">{{ __('Balance') }}</label>
                                    <input type="number" name="balance" value="{{ $insurance->balance }}" class="form-control" placeholder="{{ __('Enter Balance') }}">
                                    @error('balance')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">{{ __('Status') }}</label>
                                    <select class="form-select" name="payment_status">
                                        <option disabled>{{ __('Choose status...') }}</option>
                                        <option value="pending" {{ $insurance->payment_status == 'pending' ? 'selected' : '' }}>{{ __('Pending') }}</option>
                                        <option value="faild" {{ $insurance->payment_status == 'faild' ? 'selected' : '' }}>{{ __('Faild') }}</option>
                                        <option value="paid" {{ $insurance->payment_status == 'paid' ? 'selected' : '' }}>{{ __('Paid') }}</option>
                                    </select>
                                    @error('payment_status')
                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <button type="submit" class="btn btn-primary rounded-3 px-4">{{ __('Save') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
<!--end main wrapper-->
@endsection
