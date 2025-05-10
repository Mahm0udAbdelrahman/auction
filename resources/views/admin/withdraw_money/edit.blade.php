@extends('admin.layout')
@section('title', __('Edit Withdraw Money'))
@section('content')
<!--start main wrapper-->
<main class="main-wrapper">
    <div class="main-content">
        <div class="row mb-5">
            <div class="col-12">
                <form method="post" action="{{ route('Admin.withdraw_money.update', $withdraw_money->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card shadow-sm rounded-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">{{ __('Edit Withdraw Money') }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">

                                <div class="col-md-6">
                                    <label class="form-label">{{ __('Name') }}</label>
                                    <input type="text" name="name" value="{{ $withdraw_money->user->name }}" class="form-control" placeholder="{{ __('Enter car name') }}">
                                    @error('name')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                                </div>





                                <div class="col-md-6">
                                    <label class="form-label">{{ __('phone') }}</label>
                                    <input type="text" name="phone" value="{{ $withdraw_money->phone }}" class="form-control" placeholder="{{ __('Enter phone') }}">
                                    @error('phone')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">{{ __('Money') }}</label>
                                    <input type="text" name="money" value="{{ $withdraw_money->money }}" class="form-control" placeholder="{{ __('Enter money') }}">
                                    @error('money')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                                </div>





                                <!--<div class="col-md-6">-->
                                <!--    <label class="form-label">{{ __('Image') }}</label>-->
                                <!--    <input type="file" name="image" class="form-control">-->
                                <!--    @if ($withdraw_money->image)-->
                                <!--        <img src="{{ asset( $withdraw_money->image) }}" alt="Image" class="img-fluid mt-2 rounded" style="max-height: 120px;">-->
                                <!--    @endif-->
                                <!--    @error('image')-->
                                <!--    <div class="alert alert-danger mt-2">{{ $message }}</div>-->
                                <!--@enderror-->
                                <!--</div>-->




                                <div class="col-md-6">
                                    <label class="form-label">{{ __('Status') }}</label>
                                    <select class="form-select" name="status">
                                        <option disabled>{{ __('Choose status...') }}</option>
                                        <option value="pending" {{ $withdraw_money->status == 'pending' ? 'selected' : '' }}>{{ __('Pending') }}</option>
                                        <option value="approved" {{ $withdraw_money->status == 'approved' ? 'selected' : '' }}>{{ __('Approved') }}</option>
                                        <option value="rejected" {{ $withdraw_money->status == 'rejected' ? 'selected' : '' }}>{{ __('Rejected') }}</option>
                                    </select>
                                    @error('status')
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
