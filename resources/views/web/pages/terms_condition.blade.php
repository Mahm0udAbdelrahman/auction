@extends('web.layouts.app')

@section('contact')
<section class="terms-section py-5">
    <div class="container">

        <div class="terms-details-header text-center mb-4">
            <h2 class="fs-3">{{ __('Terms and Conditions Policy') }}</h2>
        </div>

        <hr class="mb-5" />

        @foreach($terms_conditions as $terms_condition)
            <div class="policy-item mb-5">
                <h3 class="fs-4 text-primary mb-3">
                    {{ $terms_condition->country->{'name_' . app()->getLocale()} }}
                </h3>

                <div class="terms-body bg-light p-4 rounded shadow-sm">
                    <p class="mb-0">
                        {{ $terms_condition->{'message_' . app()->getLocale()} }}
                    </p>
                </div>
            </div>
        @endforeach

    </div>
</section>
@endsection
