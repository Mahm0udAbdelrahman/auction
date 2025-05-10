@extends('web.layouts.app')
@section('contact')
<section class="insurance-section py-5">
    <div class="container">
        <div class="inurance-details-header text-right">
            <span class="fs-5">{{ __('Auction') }}</span>
        </div>
        <hr />
        <div class="row mt-5">



            <div class="col-12 mx-auto">
                <div class="insurance-body ">
                    <div
                        class="insurance-img received-money mx-auto d-flex justify-content-center align-items-center">
                        <img src="{{ asset('web/assets/Images/purple hammer for auction.png') }}" alt="wallet image" />
                    </div>
                    <p class="text-center mt-3 mb-3">{{ __('Confirm sale at current price') }}</p>
                    <div class="insurance-price received-money mx-auto ">
                        <p class="mb-0 fw-light d-flex align-items-center gap-1"> <span
                                class="d-flex gap-1 align-items-center"> <strong
                                    class="fs-3 mx-1">{{ $commit }}</strong> </span> {{ __('Pound') }} </p>
                    </div>
                    <div class="insurance-footer d-flex justify-content-center confirm-sell-btns gap-4">
                        <form method="post" action="{{ route('web.commit_update_status', $auction->id) }}">
                            @csrf
                            <div class="d-flex gap-3 mt-5">
                                <button type="submit" class="btn btn-primary border-0 py-2 px-4 fs-6 fw-light" style="border-radius: 8px;">
                                    {{ __('Yes sure') }}
                                </button>

                                <a href="{{ route('web.aution_details', $auction->id) }}"
                                    class="btn text-danger py-2 px-4 fs-6 fw-light"
                                    style="border-radius: 8px; background-color: #FFE5E5;">
                                    {{ __('Cancel') }}
                                </a>
                            </div>
                        </form>




                    </div>
                </div>
            </div>











        </div>

    </div>

</section>

@endsection
