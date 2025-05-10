@extends('admin.layout')
@section('title', __('Edit Country'))

@section('content')
<!--start main wrapper-->
<main class="main-wrapper">
    <div class="main-content">
        <div class="row mb-5">
            <div class="col-12 col-xl-12">
                <form method="post" action="{{ route('Admin.countries.update', $country->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <h6>{{ __('Edit Country') }}</h6>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-6 col-xl-6 mb-3">
                                    <input type="text" name="name_ar" value="{{ $country->name_ar }}" class="form-control" placeholder="{{ __('Enter Country Arabic') }}">
                                </div>

                                <div class="col-6 col-xl-6 mb-3">
                                    <input type="text" name="name_en" value="{{ $country->name_en }}" class="form-control" placeholder="{{ __('Enter Country English') }}">
                                </div>

                                <div class="col-6 col-xl-6 mb-3">
                                    <input type="text" name="name_ru" value="{{ $country->name_ru }}" class="form-control" placeholder="{{ __('Enter Country Russian') }}">
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
