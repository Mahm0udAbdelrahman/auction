@extends('admin.layout')
@section('title', __('Add Return Policy'))

@section('content')
    <!--start main wrapper-->
    <main class="main-wrapper">
        <div class="main-content">
            <div class="row mb-5">
                <div class="col-12 col-xl-12">
                    <form method="post" action="{{ route('Admin.return_policy.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <h6>{{ __(key: 'Add Return Policy') }}</h6>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-6 col-xl-6 mb-3">
                                        <input type="text" name="message_ar" class="form-control"
                                            placeholder="{{ __('Enter Return Policy Arabic') }}">
                                    </div>

                                    <div class="col-6 col-xl-6 mb-3">
                                        <input type="text" name="message_en" class="form-control"
                                            placeholder="{{ __('Enter Return Policy English') }}">
                                    </div>

                                    <div class="col-6 col-xl-6 mb-3">
                                        <input type="text" name="message_ru" class="form-control"
                                            placeholder="{{ __('Enter Return Policy Russian') }}">
                                    </div>

                                    <div class="col-6 col-xl-6 mb-3">
                                        <select name="country_id" id="carCountry" class="form-select">
                                            <option disabled selected>{{ __('Choose Country...') }}</option>
                                            @foreach ($countries as $country)
                                                <option value="{{ $country->id }}">
                                                    {{ $country->{'name_' . app()->getLocale()} }}
                                                </option>
                                            @endforeach
                                        </select>
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
