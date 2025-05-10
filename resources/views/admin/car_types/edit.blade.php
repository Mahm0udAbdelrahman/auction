@extends('admin.layout')
@section('title', __('Edit Car Type'))

@section('content')
<!--start main wrapper-->
<main class="main-wrapper">
    <div class="main-content">
        <div class="row mb-5">
            <div class="col-12 col-xl-12">
                <form method="post" action="{{ route('Admin.car_types.update', $car_type->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <h6>{{ __('Edit Car Type') }}</h6>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-6 col-xl-6 mb-3">
                                    <input type="text" name="name_ar" value="{{ $car_type->name_ar }}" class="form-control" placeholder="{{ __('Enter Car Types Arabic') }}">
                                </div>

                                <div class="col-6 col-xl-6 mb-3">
                                    <input type="text" name="name_en" value="{{ $car_type->name_en }}" class="form-control" placeholder="{{ __('Enter Car Types English') }}">
                                </div>

                                <div class="col-6 col-xl-6 mb-3">
                                    <input type="text" name="name_ru" value="{{ $car_type->name_ru }}" class="form-control" placeholder="{{ __('Enter Car Types Russian') }}">
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
