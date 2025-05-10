@extends('web.layouts.app')

@section('contact')
<section class="terms-section py-5">
    <div class="container">

        <div class="terms-details-header text-center mb-4">
            <h2 class="fs-3">{{ __('Return Policy') }}</h2>
        </div>

        <hr class="mb-5" />

        @foreach($return_policies as $return_policy)
            <div class="policy-item mb-5">
                <h3 class="fs-4 text-primary mb-3">
                    {{ $return_policy->country->{'name_' . app()->getLocale()} }}
                </h3>

                <div class="terms-body bg-light p-4 rounded shadow-sm">
                    <p class="mb-0">
                        {{ $return_policy->{'message_' . app()->getLocale()} }}
                    </p>
                </div>
            </div>
        @endforeach

    </div>
</section>
@endsection
