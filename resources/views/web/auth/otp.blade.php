<!DOCTYPE html>
<html lang="ar" dir="rtl">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description"
        content="مرحبًا بك في منصة المزايدات الأفضل للسيارات. اكتشف مجموعة واسعة من السيارات، وقم بالمزايدة في الوقت المثالي، واستمتع بتجربة الفوز بسيارتك المثالية. وكل ذلك بالشعار لا تفوت الفرصة لامتلاك سيارتك الجديدة بكل أناقة" />
    <link rel="icon" type="image/png" href="{{ asset('web/assets/Images/car-bg.png')}}" sizes="32x32" />
    <link rel="apple-touch-icon" href="{{ asset('web/assets/Images/car-bg.png')}}" />
    <meta name="keywords" content="تواصل معنا من نحن مزاد عربيتي سيارات فاخره car auction زايد الان المزايده" />
    <meta name="author" content="Blue Building" />
    <meta property="og:image" content="{{ asset('web/assets/images/car-bg.png') }}" />
    <title>مزاد عربيتي</title>

    <!-------------bootstrap 5  css----------------->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
      crossorigin="anonymous"
    />
        <!-------------font awesome  css----------------->

    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
      rel="stylesheet"
    />
    <!-----------------------main css--------------------------->
    <link rel="stylesheet" href="{{ asset('web/assets/css/main.css')}}" />
    <style>
        .otp-input{
            width:50px;
        }
        @media (max-width:500px) {
           .otp-input{
            width:40px;
        }
            }
    </style>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

  </head>
  <body>
    <section class="login-page">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="login-logo d-flex justify-content-center">
              <img src="{{ asset('web/assets/Images/Group.png') }}" alt="Logo" />
            </div>
          </div>
        </div>
        <div class="row py-5 mt-4">
    <h1 class="text-center">{{__('OTP Code')}}</h1>
          <div class="col-12 col-lg-6 mx-auto d-flex flex-column align-items-center mt-4">
            <form id="otp-form" method="post" action="{{ route('web.verify') }}" class="w-100" dir="ltr">
                @csrf
                <input type="hidden" name="email" value="{{ session('email') }}">
                <input type="hidden" name="otp" id="otp">

                <div class="form-group mb-3 d-flex justify-content-center align-items-center">
                    @for ($i = 0; $i < 4; $i++)
                        <input
                        
                            type="text"
                            class="py-2 text-center mx-2 otp-input"
                            maxlength="1"
                            pattern="[0-9]"
                            inputmode="numeric"
                            required
                        />
                    @endfor
                </div>
                @error('otp')
                    <span class="text-danger">{{ $message }}</span>
                @enderror

                <button class="w-100 my-4 btn-primary border-0 py-3" style="border-radius: 8px" type="submit">
                    {{__('Submit')}}
                </button>
            </form>

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

            <a class="d-block mt-5 text-black text-decoration-none" href="Register.html">
                        </div>
        </div>
      </div>
    </section>

    <!----------bootstrap script js -------------->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
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
