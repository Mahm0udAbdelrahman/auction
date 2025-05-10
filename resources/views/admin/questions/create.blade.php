@extends('admin.layout')
@section('title', __('Add Question'))

@section('content')
<!--start main wrapper-->
<main class="main-wrapper">
    <div class="main-content">
        <div class="row mb-5">
            <div class="col-12 col-xl-12">
                <form method="post" action="{{ route('Admin.questions.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <h6>{{ __('Add Question') }}</h6>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-6 col-xl-6 mb-3">
                                    <input type="text" name="question_ar" class="form-control" placeholder="{{ __('Enter Question Arabic') }}">
                                </div>
                                <div class="col-6 col-xl-6 mb-3">
                                    <input type="text" name="answer_ar" class="form-control" placeholder="{{ __('Enter Answer Arabic') }}">
                                </div>
                                <div class="col-6 col-xl-6 mb-3">
                                    <input type="text" name="question_en" class="form-control" placeholder="{{ __('Enter Question English') }}">
                                </div>
                                <div class="col-6 col-xl-6 mb-3">
                                    <input type="text" name="answer_en" class="form-control" placeholder="{{ __('Enter Answer English') }}">
                                </div>
                                <div class="col-6 col-xl-6 mb-3">
                                    <input type="text" name="question_ru" class="form-control" placeholder="{{ __('Enter Question Russian') }}">
                                </div>
                                <div class="col-6 col-xl-6 mb-3">
                                    <input type="text" name="answer_ru" class="form-control" placeholder="{{ __('Enter Answer Russian') }}">
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
