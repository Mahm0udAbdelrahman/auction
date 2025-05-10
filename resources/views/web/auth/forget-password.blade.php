<!DOCTYPE html>
<html lang="ar" dir="rtl">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description"
        content="مرحبًا بك في منصة المزايدات الأفضل للسيارات. اكتشف مجموعة واسعة من السيارات، وقم بالمزايدة في الوقت المثالي، واستمتع بتجربة الفوز بسيارتك المثالية. وكل ذلك بالشعار لا تفوت الفرصة لامتلاك سيارتك الجديدة بكل أناقة" />
    <link rel="icon" type="image/png" href="{{ asset('web/assets/Images/car-bg.png') }}" sizes="32x32" />
    <link rel="apple-touch-icon" href="{{ asset('web/assets/Images/car-bg.png') }}" />
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
    <link rel="stylesheet" href="{{ asset('web/assets/css/main.css') }}" />

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
    <h1 class="text-center">{{__('Reset password')}}</h1>
          <div class="col-12 col-lg-6 mx-auto d-flex flex-column align-items-center mt-4">
            <form method="POST" action="{{ route('web.forgetPassword') }}" class="w-100">
                @csrf
              <div class="form-group mb-3">
                <span class="input-group-text d-flex gap-3">
                  <i class="fa-solid fa-user"></i>
                  <input name="email" type="text" placeholder="{{__('email')}}" class="py-2 w-100" />
                  @error('email')
                  <span class="text-danger">{{ $message }}</span>
              @enderror
              
                </span>
              </div>
              <a href="otpcode.html">
                <button class="w-100 my-4 btn-primary border-0 py-3" style="border-radius: 8px" type="submit">{{__('Send code')}} </button>
              </a>
            </form>
            <a class="d-block mt-5 text-black text-decoration-none" href="Register.html">
                        </div>
        </div>
      </div>
    </section>

    <!----------bootstrap script js -------------->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
