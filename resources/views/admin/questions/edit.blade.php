@extends('admin.layout')
@section('title', __('Edit Question'))

@section('content')
<!--start main wrapper-->
<main class="main-wrapper">
    <div class="main-content">
        <div class="row mb-5">
            <div class="col-12 col-xl-12">
                <form method="post" action="{{ route('Admin.questions.update', $question->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <h6>{{ __('Edit Question') }}</h6>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-6 col-xl-6 mb-3">
                                    <input type="text" name="question_ar" value="{{ $question->question_ar }}" class="form-control" placeholder="{{ __('Enter Question Arabic') }}">
                                </div>
                                <div class="col-6 col-xl-6 mb-3">
                                    <input type="text" name="answer_ar" value="{{ $question->answer_ar }}" class="form-control" placeholder="{{ __('Enter Answer Arabic') }}">
                                </div>
                                <div class="col-6 col-xl-6 mb-3">
                                    <input type="text" name="question_en" value="{{ $question->question_en }}" class="form-control" placeholder="{{ __('Enter Question English') }}">
                                </div>
                                <div class="col-6 col-xl-6 mb-3">
                                    <input type="text" name="answer_en" value="{{ $question->answer_en }}" class="form-control" placeholder="{{ __('Enter Answer English') }}">
                                </div>
                                <div class="col-6 col-xl-6 mb-3">
                                    <input type="text" name="question_ru" value="{{ $question->question_ru }}" class="form-control" placeholder="{{ __('Enter Question Russian') }}">
                                </div>
                                <div class="col-6 col-xl-6 mb-3">
                                    <input type="text" name="answer_ru" value="{{ $question->answer_ru }}" class="form-control" placeholder="{{ __('Enter Answer Russian') }}">
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
