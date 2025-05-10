@extends('admin.layout')
@section('title', __('Edit Terms and Conditions Policy'))

@section('content')
    <!--start main wrapper-->
    <main class="main-wrapper">
        <div class="main-content">
            <div class="row mb-5">
                <div class="col-12 col-xl-12">
                    <form method="post" action="{{ route('Admin.terms_condition.update', $terms_condition->id) }}"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <h6>{{ __('Edit Terms and Conditions Policy') }}</h6>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-6 col-xl-6 mb-3">
                                        <input type="text" name="message_ar" value="{{ $terms_condition->message_ar }}"
                                            class="form-control"
                                            placeholder="{{ __('Enter Terms and Conditions Policy Arabic') }}">
                                    </div>

                                    <div class="col-6 col-xl-6 mb-3">
                                        <input type="text" name="message_en" value="{{ $terms_condition->message_en }}"
                                            class="form-control"
                                            placeholder="{{ __('Enter Terms and Conditions Policy English') }}">
                                    </div>

                                    <div class="col-6 col-xl-6 mb-3">
                                        <input type="text" name="message_ru" value="{{ $terms_condition->message_ru }}"
                                            class="form-control"
                                            placeholder="{{ __('Enter Terms and Conditions Policy Russian') }}">
                                    </div>

                                    <div class="col-6 col-xl-6 mb-3">
                                        <select name="country_id" id="carCountry" class="form-select">
                                            @foreach ($countries as $country)
                                                <option @selected($terms_condition->country_id == $country->id) value="{{ $country->id }}">
                                                    {{ $country->{'name_' . app()->getLocale()} }}
                                                </option>
                                            @endforeach
                                        </select>
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
