<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إعادة تعيين كلمة السر</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('web/assets/css/main.css') }}">
</head>
<body>
    <section class="login-page d-flex align-items-center" style="min-height: 100vh; background-color: #f8f9fa;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 text-center mb-4">
                    <img src="{{ asset('web/assets/Images/Group.png') }}" alt="Logo" class="img-fluid" style="max-width: 150px;">
                </div>
                <div class="col-md-6 col-lg-5 bg-white p-4 shadow rounded">
                    <h3 class="text-center mb-3">{{__('Reset password')}}</h3>
                    <form id="otp-form" method="POST" action="{{ route('web.reset_password') }}" dir="ltr">
                        @csrf
                        <input type="hidden" name="email" value="{{ session('email') }}">
                        <input type="hidden" name="otp" id="otp">

                       <h5 class="text-center mb-4">{{__('Enter verification code')}}</h5>

                        <div class="form-group mb-3 d-flex justify-content-center">
                            @for ($i = 0; $i < 4; $i++)
                                <input type="text" class="otp-input text-center mx-2 rounded border border-secondary" maxlength="1"
                                    pattern="[0-9]" inputmode="numeric" required style="width: 50px; height: 50px; font-size: 1.5rem;">
                            @endfor
                        </div>
                        @error('otp')
                            <span class="text-danger d-block text-center">{{ $message }}</span>
                        @enderror

                        <div class="mb-3">
                           <label class="form-label fw-bold">{{__('New Password')}}</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="fa fa-lock"></i></span>
                                <input type="password" name="password" class="form-control" required id="password">


                            </div>
                            @error('password')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                          <label class="form-label fw-bold">{{__('Confirm password')}}</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="fa fa-lock"></i></span>
                                <input type="password" name="password_confirmation" class="form-control" required id="confirm-password">

                            </div>
                            @error('password_confirmation')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                       <button type="submit" class="btn btn-primary w-100 py-2 fw-bold">{{__('Submit')}}</button>
                    </form>

                    <script>
                        document.querySelectorAll('.toggle-password').forEach(button => {
                            button.addEventListener('click', function () {
                                let input = this.previousElementSibling;
                                if (input.type === "password") {
                                    input.type = "text";
                                    this.innerHTML = '<i class="fa fa-eye-slash"></i>';
                                } else {
                                    input.type = "password";
                                    this.innerHTML = '<i class="fa fa-eye"></i>';
                                }
                            });
                        });
                    </script>

                </div>
            </div>
        </div>
    </section>
    <script>
        document.getElementById('otp-form').addEventListener('submit', function(event) {
            event.preventDefault();
            let otpInputs = document.querySelectorAll('.otp-input');
            let otpValue = Array.from(otpInputs).map(input => input.value).join('');
            document.getElementById('otp').value = otpValue;
            this.submit();
        });

        document.querySelectorAll('.otp-input').forEach((input, index, inputs) => {
            input.addEventListener('input', () => {
                if (input.value.length === 1 && index < inputs.length - 1) {
                    inputs[index + 1].focus();
                }
            });

            input.addEventListener('keydown', (event) => {
                if (event.key === "Backspace" && input.value.length === 0 && index > 0) {
                    inputs[index - 1].focus();
                }
            });
        });
    </script>

                </div>
</div>
</div>
</section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>


</body>
</html>
