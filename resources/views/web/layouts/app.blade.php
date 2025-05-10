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

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
    <!-------------font awesome  css----------------->

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet" />
    <!----------Aos Animate ON SCROLL----------------->
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

    <!-------------main css----------------->
    @if(App::getLocale() == 'ar')
    <link rel="stylesheet" href="{{ asset('web/assets/css/main.css') }}" />
    @endif

    @if(App::getLocale() == 'ru')
    <link rel="stylesheet" href="{{ asset('web/assets/css/main-ru.css') }}" />
    @endif

    @if(App::getLocale() == 'en')
    <link rel="stylesheet" href="{{ asset('web/assets/css/main-en.css') }}" />
    @endif


  


    <!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">-->
    <!--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">



</head>

<body dir="{{ App::getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
   @include('web.layouts.header')

    @yield('contact')

</body>

</html>


<script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>
<!----------bootstrap script js -------------->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<!-----------scripts defer------------------->
<script src="https://unpkg.com/aos@next/dist/aos.js"></script>


<script src="{{ asset('web/assets/js/main.js') }}"></script>
 <script src="https://js.pusher.com/8.4.0/pusher.min.js"></script>
  <script>

    Pusher.logToConsole = true;

    var pusher = new Pusher("{{ env('PUSHER_APP_KEY') }}", {
      cluster: "{{ env('PUSHER_APP_CLUSTER') }}"
    });

    var channel = pusher.subscribe('mazad');
    channel.bind('auction', function(data) {
        $(".notificationsIcon").load(" .notificationsIcon > *");
        $('#notificationsModal').load(" #notificationsModal > *");
    });
  </script>
  <!-- toastr -->
  <script src="{{ asset('layout/plugins/toastr/toastr.min.js') }}"></script>


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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

</body>

</html>
