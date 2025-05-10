<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مزاد عربيتي</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/all.min.js"></script>
    <link rel="stylesheet" href="{{ asset('web/assets/css/main.css') }}">
    <!-- toastr -->
    <link href="{{ asset('layout/plugins/toastr/toastr.min.css') }}" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

</head>

<body>

    <section class="login-page choose-service">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <div class="login-logo">
                        <img src="{{ asset('web/assets/Images/Group.png') }}" alt="Logo">
                    </div>

                </div>
            </div>

           <form method="POST" action="{{ route('web.register_store') }}">
                @csrf
                <!-- الصفحة الأولى -->
                <div id="page1">
                    <div class="row">
                        <div class="col-12 text-center">
                            <h1 class="mt-4">{{__('Select service')}}</h1>
                        </div>
                    </div>

                    <div class="row py-4">
                        <div class="col-md-6 mx-auto d-flex flex-column align-items-center">
                            <div class="d-flex justify-content-between flex-wrap gap-3">
                                <!-- بيع سيارة -->
                                <div class="card position-relative flex-grow-1 bg-light">
                                    <input type="radio" name="service" id="sell-car1" value="vendor"
                                        class="position-absolute top-0 end-0 m-2 form-check-input option-radio">
                                    <label for="sell-car1" class="card-body text-center">
                                        <img src="{{ asset('web/assets/Images/car-angled-front-left_svgrepo.com.png') }}"
                                            alt="Sell Icon" class="mb-3">
                                        <p class="mb-0">{{__('I want to sell a car')}}</p>
                                    </label>
                                </div>


                                <!-- شراء سيارة -->
                                <div class="card position-relative flex-grow-1 bg-light">
                                    <input type="radio" name="service" id="buy-car1" value="buyer"
                                        class="position-absolute top-0 end-0 m-2 form-check-input option-radio">
                                    <label for="buy-car1" class="card-body text-center">
                                        <img src="{{ asset('web/assets/Images/auction_svgrepo.com.png') }}"
                                            alt="Buy Icon" class="mb-3">
                                        <p class="mb-0">{{__('I want to buy a car')}}</p>
                                    </label>
                                </div>
                            </div>
                            <button type="button" class="btn btn-primary w-100 mt-4"
                                onclick="showPage2()">{{__('continue')}}</button>
                        </div>
                    </div>
                </div>

                <!-- الصفحة الثانية -->
                <div id="page2" style="display: none;">
                    <div class="row">
                        <div class="col-12 text-center">
                            <h1 class="mt-4">{{__('Select service')}}</h1>
                        </div>
                    </div>
                    <div class="row py-4">
                        <div class="col-md-6 mx-auto d-flex flex-column align-items-center">
                            <div class="d-flex justify-content-between flex-wrap gap-3">
                                <!-- لي -->
                                <div class="card position-relative flex-grow-1 bg-light">
                                    <input type="radio" name="category" id="private" value="my"
                                        class="position-absolute top-0 end-0 m-2 form-check-input option-radio">
                                    <label for="private" class="card-body text-center">
                                        <img src="{{ asset('web/assets/Images/403019_avatar_male_man_person_user_icon 1.png') }}"
                                            alt="Sell Icon" class="mb-3">
                                        <p class="mb-0">{{__("My own car")}}</p>
                                    </label>
                                </div>

                                <!-- تاجر -->
                                <div class="card position-relative flex-grow-1 bg-light">
                                    <input type="radio" name="category" id="dealer" value="dealer"
                                        class="position-absolute top-0 end-0 m-2 form-check-input option-radio">
                                    <label for="dealer" class="card-body text-center">
                                        <img src="{{ asset('web/assets/Images/403022_business man_male_user_avatar_profile_icon 1.png') }}"
                                            alt="Buy Icon" class="mb-3">
                                        <p class="mb-0">{{__('I am a car dealer')}}</p>
                                    </label>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between w-100 mt-4">
                                <button type="button" class="btn btn-secondary"
                                    onclick="showPage1()">{{__('back')}}</button>
                                <button type="button" class="btn btn-primary"
                                    onclick="showPage3()">{{__('continue')}}</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- الصفحة الثالثة -->
                <div id="page3" style="display: none;">
                    <div class="row py-4">
                        <div class="col-md-6 mx-auto">
                            <h3 class="text-center">{{__('Create an account')}}</h3>
                            <div class="form-group mb-3">
                                <span class="input-group-text d-flex gap-3">
                                    <i class="fa-solid fa-user"></i>
                                    <input name="name" placeholder="{{__('Name')}}" class="py-2 w-100" type="text" />
                                </span>
                            </div>
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror

                            <div class="form-group mb-3">
                                <span class="input-group-text d-flex gap-3">
                                    <i class="fa-solid fa-envelope"></i>
                                    <input name="email" placeholder="{{__('User email')}}" class="py-2 w-100"
                                        type="text" />
                                </span>
                            </div>
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror

                            <div class="form-group mb-3">
                                <span class="input-group-text d-flex gap-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16"
                                        fill="none">
                                        <path fill="#386BF6"
                                            d="M8 0C4.14 0 1 3.14 1 7s3.14 7 7 7 7-3.14 7-7-3.14-7-7-7zm-.5 13c-1.07 0-2.09-.27-3-.74V12h6v.26c-.91.47-1.93.74-3 .74zm3.5-2H4v-1h7v1zm1-2H3V7h10v2zm0-3H3V4h10v2z" />
                                    </svg>
                                    <select name="country_id" class="py-2 w-100 border-0 bg-transparent">
                                        <option selected>{{__('Select the country')}}</option>

                                        @foreach ($countries as $country)
                                            <option value="{{ $country->id }}">
                                                {{ $country->{'name_' . app()->getLocale()} }}
                                            </option>
                                        @endforeach
                                    </select>
                                </span>
                            </div>
                            @error('country_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror

                            <div class="form-group mb-3">
                                <span class="input-group-text d-flex gap-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="21" viewBox="0 0 14 21"
                                        fill="none">
                                        <path
                                            d="M0.25 3.3C0.25 1.927 1.32 0.75 2.714 0.75H11.286C12.681 0.75 13.75 1.927 13.75 3.3V17.7C13.75 19.073 12.68 20.25 11.286 20.25H2.714C1.319 20.25 0.25 19.073 0.25 17.7V3.3ZM5.5 3.75C5.30109 3.75 5.11032 3.82902 4.96967 3.96967C4.82902 4.11032 4.75 4.30109 4.75 4.5C4.75 4.69891 4.82902 4.88968 4.96967 5.03033C5.11032 5.17098 5.30109 5.25 5.5 5.25H8.5C8.69891 5.25 8.88968 5.17098 9.03033 5.03033C9.17098 4.88968 9.25 4.69891 9.25 4.5C9.25 4.30109 9.17098 4.11032 9.03033 3.96967C8.88968 3.82902 8.69891 3.75 8.5 3.75H5.5Z"
                                            fill="#386BF6" />
                                    </svg>
                                    <input name="phone" type="text" placeholder="{{__('Phone number')}}"
                                        class="py-2 w-100" />
                                </span>
                            </div>
                            @error('phone')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror

                            {{-- <div class="form-group mb-3" id="nationalIdField" style="display: none;">
                                <span class="input-group-text d-flex gap-3">
                                    <i class="fa-solid fa-id-card"></i>
                                    <input name="national_number" type="text" placeholder="رقم القومي"
                                        class="py-2 w-100" />
                                </span>
                            </div>
                            @error('national_number')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror --}}

                            <div class="form-group mb-3">
                                <span class="input-group-text d-flex gap-3">
                                    <i class="fa-solid fa-lock"></i>
                                    <input name="password" type="password" placeholder="{{__('Password')}}"
                                        class="py-2 w-100" />
                                </span>
                            </div>
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <div class="form-group mb-3">
                                <span class="input-group-text d-flex gap-3">
                                    <i class="fa-solid fa-lock"></i>
                                    <input name="password_confirmation" type="password"
                                        placeholder="{{__('Confirm password')}}" class="py-2 w-100" />
                                </span>
                            </div>
                            @error('password_confirmation')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <div class="form-terms d-flex gap-3 align-items-center">
                                <input type="hidden" name="terms_and_conditions" value="0">
                                <input name="terms_and_conditions" type="checkbox" value="1" />
                                <a  href="{{ route('web.terms_condition') }}" class="d-block text-black text-decoration-none">
                                    {{__('I agree with all')}} <span
                                        class="text-decoration-underline">{{__('Terms and Conditions')}}</span>
                                </a>
                            </div>
                            @error('terms_and_conditions')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror

                            <div class="d-flex justify-content-between">
                                {{-- <button type="button" class="btn btn-secondary" onclick="showPage2()">رجوع</button>
                                --}}
                                {{-- <button type="submit" class="w-100 my-4 btn-primary border-0 py-3">انشاء</button>
                                --}}
                                <button type="submit" class="btn btn-primary w-100 mt-4">{{__("Submit")}}</button>

                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <script>
        window.addEventListener('DOMContentLoaded', function () {
            @if ($errors->any())
                showPage3();
            @endif
        });
    </script>

    <script>
        function showPage1() {
            document.getElementById("page1").style.display = "block";
            document.getElementById("page2").style.display = "none";
            document.getElementById("page3").style.display = "none";
        }

        function showPage2() {
            document.getElementById("page1").style.display = "none";
            document.getElementById("page2").style.display = "block";
            document.getElementById("page3").style.display = "none";
        }

        function showPage3() {
            document.getElementById("page1").style.display = "none";
            document.getElementById("page2").style.display = "none";
            document.getElementById("page3").style.display = "block";
        }
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let serviceRadios = document.querySelectorAll("input[name='service']");
            let nationalIdField = document.getElementById("nationalIdField");

            serviceRadios.forEach(radio => {
                radio.addEventListener("change", function() {
                    if (this.value === "vendor") {
                        nationalIdField.style.display = "block";
                    } else {
                        nationalIdField.style.display = "none";
                    }
                });
            });
        });
    </script>

<script src="{{ asset('layout/plugins/toastr/toastr.min.js') }}"></script>

<script src="{{ asset('web/assets/js/main.js') }}"></script>

@if (\Session::has('message'))
    <script type="text/javascript">
        $(function() {
            toastr["{{ \Session::get('message')['type'] }}"]('{!! \Session::get('message')['text'] !!}',
                "{{ ucfirst(\Session::get('message')['type']) }}!");
            toastr.options = {
                "closeButton": false,
                "debug": false,
                "newestOnTop": false,
                "progressBar": false,
                "positionClass": "toast-top-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }
        });
    </script>
    <?php echo \Session::forget('message'); ?>
@endif

@if ($errors->any())
    <script type="text/javascript">
        $(function() {
            toastr["error"]('{{ $errors->first() }}', "Error!");
        });
    </script>
@endif
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>


</body>

</html>
