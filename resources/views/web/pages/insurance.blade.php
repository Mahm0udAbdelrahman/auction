@extends('web.layouts.app')
@section('contact')
    <section class="insurance-section py-5">
        <div class="container">
            <div class="inurance-details-header text-right">
                <span class="fs-5">{{ __('Insurance') }}</span>
            </div>
            <hr />
            <div class="row mt-5">


                <!------------take this col ----في حاله دفع المبلغ -------------------->

                @php
                    $minBalance =
                        \App\Models\BalanceInsurance::where('service', auth()->user()->service)
                            ->where('category', auth()->user()->category)
                            ->value('min_balance') ?? 0;
                @endphp
                @if ($balance)
                    <div class="col-12 mx-auto">
                        <div class="insurance-body ">
                            <div
                                class="insurance-img received-money mx-auto d-flex justify-content-center align-items-center">
                                <img src="{{ asset('web/assets/Images/black wallet with credit card.png') }}"
                                    alt="wallet image" />
                            </div>
                            <div class="insurance-price received-money mx-auto mt-3">
                                <p class="mb-0 fw-light d-flex align-items-center gap-1"> <span
                                        class="d-flex gap-1 align-items-center"><span
                                            class="insurance-salary">{{ $minBalance }}+</span> <strong
                                            class="fs-3 mx-1">{{ $balance }}</strong> </span> {{ __('Pound') }} </p>
                            </div>
                            <div class="insurance-footer">
                                <p class=" mt-5 mb-0 text-black text-center fw-light">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none">
                                        <path
                                            d="M6.69999 18.0001L1.04999 12.3501L2.47499 10.9501L6.72499 15.2001L8.12499 16.6001L6.69999 18.0001ZM12.35 18.0001L6.69999 12.3501L8.09999 10.9251L12.35 15.1751L21.55 5.9751L22.95 7.4001L12.35 18.0001ZM12.35 12.3501L10.925 10.9501L15.875 6.0001L17.3 7.4001L12.35 12.3501Z"
                                            fill="#34C759" />
                                    </svg>
                                    <!--{{ __('You must pay :amount pounds as an insurance for the application in order to be able to bid. The amount will remain in your account and you can retrieve the amount at any time.', ['amount' => $minBalance]) }}-->
                                    {{ __('An amount of :amount pounds has been paid as insurance for the application. The amount remains in your account and can be retrieved at any time.', ['amount' => $minBalance]) }}

                                </p>
                                <form method="POST" action="{{ route('web.store_insurance') }}">
                                    @csrf
                                    <input name="balance" type="hidden" value="{{ $minBalance }}">
                                    <input name="type" type="hidden" value="web">
                                    <input name="payment_method" type="hidden" value="card">


                                    <!--<button-->
                                    <!--type="submit"-->
                                    <!--      class="w-100 mt-5 btn-primary border-0 py-2 fs-6  fw-light"-->
                                    <!--      style="border-radius: 8px"-->

                                    <!--    > <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24 " viewBox="0 0 16 16" fill="none">-->
                                    <!--        <path d="M9.3406 0.759766C8.87497 0.769141 8.5406 0.859766 8.31872 1.02227L5.2781 2.65039L3.58747 4.95008C3.23122 5.50008 3.48435 6.56258 4.59685 5.88133L5.8156 4.27508C7.36247 2.94102 10.5187 3.5532 9.02185 6.23133C8.28747 7.78133 8.63122 8.53758 9.5781 8.85633L10.0093 7.40633C10.7562 5.72508 12.15 5.42195 12.0937 4.0657L15.4437 4.30633L15.4125 0.803516L9.3406 0.759766ZM7.64997 3.9907C7.10622 3.98133 6.57185 4.20633 6.18435 4.53133L4.96247 6.13758C5.29685 6.4032 5.63435 6.25945 5.96872 5.93758C6.36247 6.13758 6.66872 5.8282 6.91872 5.20945C7.02185 4.78758 7.17497 4.4907 7.64997 3.9907ZM5.16247 6.9907C5.14997 6.9907 5.13435 6.9907 5.12185 6.99383C5.01872 7.0157 4.89685 7.12508 4.8156 7.37508C4.73122 7.62508 4.71247 7.98133 4.78747 8.36258C4.86247 8.7407 5.01872 9.06258 5.19372 9.26258C5.36247 9.45945 5.51872 9.5157 5.62185 9.49383C5.7281 9.47508 5.84685 9.36258 5.9281 9.1157C6.01247 8.8657 6.03435 8.50633 5.95935 8.1282C5.88122 7.74695 5.72497 7.42508 5.5531 7.2282C5.4031 7.0532 5.2656 6.9907 5.16247 6.9907ZM7.74372 10.3282C7.49685 10.3313 7.18747 10.4095 6.88435 10.5563C6.53747 10.7282 6.2656 10.9657 6.11872 11.1845C5.97185 11.4001 5.95935 11.5626 6.00622 11.6595C6.0531 11.7532 6.1906 11.8438 6.4531 11.8563C6.7156 11.872 7.06872 11.8001 7.4156 11.6282C7.76247 11.4563 8.03435 11.222 8.18122 11.0032C8.3281 10.7876 8.3406 10.622 8.29372 10.5282C8.24685 10.4313 8.10935 10.3438 7.84685 10.3313C7.81247 10.3282 7.78122 10.3282 7.74372 10.3282ZM4.69372 13.3157C4.54685 13.3188 4.41247 13.3407 4.29372 13.3751C4.0281 13.4532 3.87497 13.5938 3.82497 13.7595C3.77185 13.9282 3.82497 14.1282 4.0031 14.3438C4.18435 14.5563 4.48747 14.7595 4.86247 14.872C5.23435 14.9845 5.59685 14.9813 5.8656 14.9001C6.13435 14.822 6.28747 14.6813 6.33747 14.5157C6.38747 14.347 6.33747 14.147 6.15622 13.9313C5.9781 13.7188 5.67497 13.5157 5.29997 13.4032C5.08747 13.3407 4.88122 13.3126 4.69372 13.3157Z" fill="white"/>-->
                                    <!--        </svg>-->
                                    <!--            {{ __('Insurance payment :amount pounds', ['amount' => $minBalance]) }}-->
                                    <!--</button>-->
                            </div>
                        </div>
                    </div>
                @else
                    <div class="col-12 mx-auto">
                        <div class="insurance-body ">
                            <div class="insurance-img mx-auto d-flex justify-content-center align-items-center">
                                <img src="{{ asset('web/assets/Images/black wallet with credit card.png') }}"
                                    alt="wallet image" />
                            </div>
                            <div class="insurance-price mx-auto mt-3">
                                <p class="mb-0 fw-light d-flex align-items-center gap-1"> <span
                                        class="d-flex gap-1 align-items-center"><span
                                            class="insurance-salary">{{ $minBalance }}+</span>
                                        <strong class="fs-3 mx-1">{{ $balance ?? 00.0 }}</strong> </span>
                                    {{ __('Pound') }} </p>
                            </div>
                            <div class="insurance-footer">
                                <p class=" mt-5 mb-0 text-black text-center fw-light">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none">
                                        <path
                                            d="M12 17C12.2833 17 12.521 16.904 12.713 16.712C12.905 16.52 13.0007 16.2827 13 16V12C13 11.7167 12.904 11.4793 12.712 11.288C12.52 11.0967 12.2827 11.0007 12 11C11.7173 10.9993 11.48 11.0953 11.288 11.288C11.096 11.4807 11 11.718 11 12V16C11 16.2833 11.096 16.521 11.288 16.713C11.48 16.905 11.7173 17.0007 12 17ZM12 9C12.2833 9 12.521 8.904 12.713 8.712C12.905 8.52 13.0007 8.28267 13 8C12.9993 7.71733 12.9033 7.48 12.712 7.288C12.5207 7.096 12.2833 7 12 7C11.7167 7 11.4793 7.096 11.288 7.288C11.0967 7.48 11.0007 7.71733 11 8C10.9993 8.28267 11.0953 8.52033 11.288 8.713C11.4807 8.90567 11.718 9.00133 12 9ZM12 22C10.6167 22 9.31667 21.7373 8.1 21.212C6.88334 20.6867 5.825 19.9743 4.925 19.075C4.025 18.1757 3.31267 17.1173 2.788 15.9C2.26333 14.6827 2.00067 13.3827 2 12C1.99933 10.6173 2.262 9.31733 2.788 8.1C3.314 6.88267 4.02633 5.82433 4.925 4.925C5.82367 4.02567 6.882 3.31333 8.1 2.788C9.318 2.26267 10.618 2 12 2C13.382 2 14.682 2.26267 15.9 2.788C17.118 3.31333 18.1763 4.02567 19.075 4.925C19.9737 5.82433 20.6863 6.88267 21.213 8.1C21.7397 9.31733 22.002 10.6173 22 12C21.998 13.3827 21.7353 14.6827 21.212 15.9C20.6887 17.1173 19.9763 18.1757 19.075 19.075C18.1737 19.9743 17.1153 20.687 15.9 21.213C14.6847 21.739 13.3847 22.0013 12 22ZM12 20C14.2333 20 16.125 19.225 17.675 17.675C19.225 16.125 20 14.2333 20 12C20 9.76667 19.225 7.875 17.675 6.325C16.125 4.775 14.2333 4 12 4C9.76667 4 7.875 4.775 6.325 6.325C4.775 7.875 4 9.76667 4 12C4 14.2333 4.775 16.125 6.325 17.675C7.875 19.225 9.76667 20 12 20Z"
                                            fill="#FF2D55" />
                                    </svg>
                                    {{ __('You must pay a :amount deposit to the app to be able to bid. The amount will remain in your account and you can withdraw it at any time.', ['amount' => number_format($minBalance)]) }}
                                </p>


                                <form method="POST" action="{{ route('web.store_insurance') }}">
                                    @csrf
                                    <input name="balance" type="hidden" value="{{ $minBalance }}">
                                    <input name="payment_method" type="hidden" value="card">
                                    <input name="type" type="hidden" value="web">
                                    <div class="payment-method-selector mb-4">
                                        <h5 class="mb-3">{{ __('Choose your payment method:') }}</h5>

                                        <!-- موديل السيارة -->
                                        <select class="form-select mb-2" name="payment_type">
                                            <option value="" selected>{{ __('Select Type Payment') }}</option>

                                            @foreach ($paymet_types as $paymet_type)
                                                <option value="{{ $paymet_type->id }}">
                                                    <img src="{{ $paymet_type->icon }}" alt="insurance" class="me-2" />
                                                    {{ $paymet_type->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('payment_type')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror

                                    <button type="submit" class="w-100 mt-5 btn-primary border-0 py-2 fs-6 fw-light"
                                        style="border-radius: 8px">
                                        {{ __('Insurance payment + :amount pounds', ['amount' => number_format($minBalance)]) }}
                                    </button>
                                </form>



                            </div>
                        </div>
                    </div>
                @endif










                <!---------------use this col  في حاله سحب المبلغ------

                            <div class="col-12 mx-auto">
                                <div class="insurance-body ">
                                    <div class="insurance-img received-money mx-auto d-flex justify-content-center align-items-center">
                                        <img src="assets/Images/black wallet with credit card.png" alt="wallet image" />
                                    </div>
                                    <div class="insurance-price mx-auto mt-3">
                                        <p class="mb-0 fw-light d-flex align-items-center gap-1"> <span
                                                class="d-flex gap-1 align-items-center"><span class="insurance-salary"></span>
                                                <strong class="fs-3 mx-1">5000.0</strong> </span> جنية </p>
                                    </div>
                                    <div class="insurance-footer">
                                        <form class="w-100 mt-4">
                                            <div class="form-group mb-3">

                                                <input
                                                  name="insurance-num"
                                                  type="number"
                                                  placeholder="اكتب الرقم هنا"
                                                  class="py-2 w-100 form-control"
                                                />
                                            </div>
                                            <div class="form-group ">

                                                <input
                                                  name="insurance-num2"
                                                  type="number"
                                                  placeholder="اكتب الرقم هنا مره اخري... "
                                                  class="py-2 w-100 form-control"
                                                />
                                            </div>

                                          </form>
                                        <button class="w-100 mt-5 btn-primary border-0 py-2 fs-6  fw-light"
                                            style="border-radius: 8px">
                                           سحب المبلغ

                                        </button>
                                    </div>
                                </div>
                            </div> ------------->






                <!------------take this col ----في حاله  ارسال  الطلب -------------------->


                <!------  <div class="col-12 mx-auto ">
                                <div class="insurance-body ">
                                    <div
                                        class="insurance-img received-money mx-auto d-flex justify-content-center align-items-center">
                                        <img src="assets/Images/black wallet with credit card.png" alt="wallet image" />
                                    </div>

                                    <div class="insurance-footer my-4">
                                        <h1 class="text-center fs-5 mb-3">تم إرسال طلبك بنجاح</h1>
                                        <p class="  mb-0 text-black text-center fw-light">
                                            سيتم مراجعة بياناتك وإرسال لك المبلغ فى اقرب وقت سعدنا بالتعامل معك وفى انتظارك للتعامل
                                            مرة اخرى قريباً </p>

                                    </div>

                                </div>


                            </div>
                -------->


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

    <script>
        document.getElementById('insuranceForm').addEventListener('submit', function(event) {
            event.preventDefault();

            let formData = new FormData(this);

            fetch(this.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.redirect_url) {
                        window.open(data.redirect_url, '_blank');
                    } else {
                        alert('حدث خطأ أثناء إنشاء الطلب.');
                    }
                })
                .catch(error => console.error('Error:', error));
        });
    </script>

@endsection
