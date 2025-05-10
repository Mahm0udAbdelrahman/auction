@extends('admin.layout')
@section('title', __('Edit Add Type Payment'))

@section('content')
<!--start main wrapper-->
<main class="main-wrapper">
    <div class="main-content">
        <div class="row mb-5">
            <div class="col-12 col-xl-12">
                <form method="post" action="{{ route('Admin.type_payment.update', $type_payment->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <h6>{{ __('Edit Type Payment') }}</h6>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-6 col-xl-6 mb-3">
                                    <input type="text" name="name" value="{{ $type_payment->name }}" class="form-control" placeholder="{{ __('Enter Name') }}">
                                </div>

                                <div class="col-6 col-xl-6 mb-3">
                                    <input type="file" name="icon" value="{{ $type_payment->icon }}" class="form-control" placeholder="{{ __('Enter Icon') }}">
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
