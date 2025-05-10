@extends('web.layouts.app')
@section('contact')
    <section class="insurance-section py-5">
        <div class="container">
            <div class="inurance-details-header text-right">
                <span class="fs-5">{{ __('Withdraw Money') }}</span>
            </div>
            <hr />
            <div class="row mt-5">

                @if($WithdrawMoney)

                    <!------------take this col ----في حاله  ارسال  الطلب -------------------->


                    <div class="col-12 mx-auto ">
                        <div class="insurance-body ">
                            <div
                                class="insurance-img received-money mx-auto d-flex justify-content-center align-items-center">
                                <img src="{{ asset('web/assets/Images/black wallet with credit card.png') }}" alt="wallet image" />
                            </div>

                            <div class="insurance-footer my-4">
                                <h1 class="text-center fs-5 mb-3">{{ __('Your Request Has Been Successfully Sent') }}</h1>
                                <p class="mb-0 text-black text-center fw-light">
                                    {{ __('Your Information Will Be Reviewed, And The Amount Will Be Sent To You As Soon As Possible. We Are Glad To Deal With You And Look Forward To Working With You Again Soon.') }}
                                </p>


                            </div>

                        </div>


                    </div>
                @else
                    {{-- <!---------------use this col  في حاله سحب المبلغ------ --}}


                    <div class="col-12 mx-auto">
                        <div class="insurance-body ">
                            <div
                                class="insurance-img received-money mx-auto d-flex justify-content-center align-items-center">
                                <img src="{{ asset('web/assets/Images/black wallet with credit card.png') }}"
                                    alt="wallet image" />
                            </div>
                            <div class="insurance-price mx-auto mt-3">
                                <p class="mb-0 fw-light d-flex align-items-center gap-1"> <span
                                        class="d-flex gap-1 align-items-center"><span class="insurance-salary"></span>
                                        <strong class="fs-3 mx-1">{{ $insurance ?? 0 }}</strong> </span> جنية </p>
                            </div>
                            <div class="insurance-footer">
                                <form method="post" action="{{ route('web.withdraw_money_store') }}" class="w-100 mt-4">
                                    @csrf
                                    <div class="form-group mb-3">

                                        <input name="phone" type="number" placeholder="{{ __('Enter The Number Here') }}"
                                            class="py-2 w-100 form-control" />
                                    </div>
                                    <div class="form-group ">

                                        <input name="money" type="number" placeholder="{{ __('Enter The Amount Here') }}"                                        ... "
                                            class="py-2 w-100 form-control" />
                                    </div>
                                    <button type="sumbit" class="w-100 mt-5 btn-primary border-0 py-2 fs-6  fw-light"
                                        style="border-radius: 8px">
                                        {{ __('Withdraw The Amount') }}

                                    </button>
                                </form>

                            </div>
                        </div>
                    </div>
                @endif









                <!--------------في حاله مراجعه الطلب ------------------>



                <!--------------  <div class="col-12 mx-auto">
                    <div class="insurance-body ">
                        <div
                            class="insurance-img received-money mx-auto d-flex justify-content-center align-items-center">
                            <img src="assets/Images/black wallet with credit card.png" alt="wallet image" />
                        </div>
                        <div class="insurance-price received-money mx-auto mt-3">
                            <p class="mb-0 fw-light d-flex align-items-center gap-1"> <span
                                    class="d-flex gap-1 align-items-center"><span class="insurance-salary">5,000+</span>
                                    <strong class="fs-3 mx-1">00.0</strong> </span> جنية </p>
                        </div>
                        <div class="insurance-footer">
                            <p class=" mt-5 mb-0 text-black text-center fw-light">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none">
                                    <path
                                        d="M12 17C12.2833 17 12.521 16.904 12.713 16.712C12.905 16.52 13.0007 16.2827 13 16V12C13 11.7167 12.904 11.4793 12.712 11.288C12.52 11.0967 12.2827 11.0007 12 11C11.7173 10.9993 11.48 11.0953 11.288 11.288C11.096 11.4807 11 11.718 11 12V16C11 16.2833 11.096 16.521 11.288 16.713C11.48 16.905 11.7173 17.0007 12 17ZM12 9C12.2833 9 12.521 8.904 12.713 8.712C12.905 8.52 13.0007 8.28267 13 8C12.9993 7.71733 12.9033 7.48 12.712 7.288C12.5207 7.096 12.2833 7 12 7C11.7167 7 11.4793 7.096 11.288 7.288C11.0967 7.48 11.0007 7.71733 11 8C10.9993 8.28267 11.0953 8.52033 11.288 8.713C11.4807 8.90567 11.718 9.00133 12 9ZM12 22C10.6167 22 9.31667 21.7373 8.1 21.212C6.88334 20.6867 5.825 19.9743 4.925 19.075C4.025 18.1757 3.31267 17.1173 2.788 15.9C2.26333 14.6827 2.00067 13.3827 2 12C1.99933 10.6173 2.262 9.31733 2.788 8.1C3.314 6.88267 4.02633 5.82433 4.925 4.925C5.82367 4.02567 6.882 3.31333 8.1 2.788C9.318 2.26267 10.618 2 12 2C13.382 2 14.682 2.26267 15.9 2.788C17.118 3.31333 18.1763 4.02567 19.075 4.925C19.9737 5.82433 20.6863 6.88267 21.213 8.1C21.7397 9.31733 22.002 10.6173 22 12C21.998 13.3827 21.7353 14.6827 21.212 15.9C20.6887 17.1173 19.9763 18.1757 19.075 19.075C18.1737 19.9743 17.1153 20.687 15.9 21.213C14.6847 21.739 13.3847 22.0013 12 22ZM12 20C14.2333 20 16.125 19.225 17.675 17.675C19.225 16.125 20 14.2333 20 12C20 9.76667 19.225 7.875 17.675 6.325C16.125 4.775 14.2333 4 12 4C9.76667 4 7.875 4.775 6.325 6.325C4.775 7.875 4 9.76667 4 12C4 14.2333 4.775 16.125 6.325 17.675C7.875 19.225 9.76667 20 12 20Z"
                                        fill="#FF2D55" />
                                </svg>
                                جارى مراجعة بيانات الحساب الخاص بي instapay الخاص بك وسيتم إرسال المبلغ لك قريباً
                            </p>
                            <button class="w-100 mt-5 btn-primary border-0 py-2 fs-6  fw-light"
                                style="border-radius: 8px"> <svg xmlns="http://www.w3.org/2000/svg" width="21"
                                    height="20" viewBox="0 0 21 20" fill="none">
                                    <path
                                        d="M11.8883 8.77998L10.5458 7.54998C10.1787 7.21301 9.92072 6.77402 9.8049 6.28937C9.68908 5.80472 9.72074 5.29651 9.89581 4.82998L10.4683 3.30123C10.6822 2.7305 11.1056 2.26279 11.6523 1.99338C12.1991 1.72397 12.8279 1.67314 13.4108 1.85123C15.5558 2.50748 17.2046 4.50123 16.6971 6.86873C16.3633 8.42623 15.7246 10.3812 14.5146 12.4612C13.3021 14.5462 11.9171 16.0862 10.7296 17.1687C8.93706 18.8 6.37456 18.3925 4.72581 16.855C4.28411 16.4427 4.01613 15.8777 3.97642 15.2748C3.93671 14.6719 4.12825 14.0766 4.51206 13.61L5.56206 12.335C5.87874 11.9494 6.30355 11.6674 6.78183 11.5253C7.2601 11.3832 7.76996 11.3874 8.24581 11.5375L9.98081 12.0837C10.4291 11.6216 10.8218 11.1085 11.1508 10.555C11.4683 9.99525 11.716 9.39872 11.8883 8.77873"
                                        fill="white" />
                                </svg> اتصل بنا

                            </button>
                        </div>
                    </div>
                </div>
                -------->

            </div>

        </div>


    </section>
@endsection
