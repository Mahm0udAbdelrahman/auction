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
    <meta property="og:image" content="{{ asset('web/assets/images/car-bg.png')}}" />
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
    <!---------------------------main css---------------------------------->
    <link rel="stylesheet" href="{{ asset('web/assets/css/main.css')}}" />
  </head>
  <body>
    <section class="login-page choose-service">
        <div class="container">
          <div class="row">
            <div class="col-12">
              <div class="login-logo d-flex justify-content-center">
                <img src="{{ asset('web/assets/Images/Group.png')}}" alt="Logo" />
              </div>
            </div>
          </div>
          <div class="row py-5 mt-4">
            <h1 class="text-center">اختيار الخدمة</h1>
            <div class="col-12 col-md-6 mx-auto d-flex flex-column align-items-center mt-4">
              <form class="w-100">
                <div class="d-flex justify-content-between flex-wrap gap-3">
                  <!----------------- Sell Car Option -------------->
                  <div class="card position-relative flex-grow-1 bg-light">
                    <input
                      type="radio"
                      name="service"
                      id="sell-car"
                      value="sell"

                      class="position-absolute top-0 end-0 m-2 form-check-input option-radio"
                    />
                    <label for="sell-car" class="card-body text-center">
                        <img src="{{ asset('web/assets/Images/car-angled-front-left_svgrepo.com.png')}}" alt="Buy Icon" class="mb-3" />
                        <p class="mb-0">اريد بيع سيارة</p>
                    </label>
                  </div>

                  <!---------------------- Buy Car Option ---------------------->
                  <div class="card position-relative flex-grow-1  bg-light">
                    <input
                      type="radio"
                      name="service"
                      id="buy-car"
                      value="buy"
                      class="position-absolute top-0 end-0 m-2 form-check-input option-radio"
                    />
                    <label for="buy-car" class="card-body text-center">
                      <img src="{{ asset('web/assets/Images/auction_svgrepo.com.png')}}" alt="Buy Icon" class="mb-3" />
                      <p class="mb-0">اريد شراء سيارة</p>
                    </label>
                  </div>
                </div>
                <a
                href="choose-category.html"
                  class="w-100 my-4 btn-primary border-0 py-3 d-block text-center text-decoration-none "
                  style="border-radius: 4px"

                >
                  استمرار
            </a>
              </form>
              <a class="d-block mt-5 text-black text-decoration-none" href="#">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  width="25"
                  height="24"
                  viewBox="0 0 25 24"
                  fill="none"
                >
                  <path
                    d="M12.5 21.25C17.6086 21.25 21.75 17.1086 21.75 12C21.75 6.89137 17.6086 2.75 12.5 2.75C7.39137 2.75 3.25 6.89137 3.25 12C3.25 17.1086 7.39137 21.25 12.5 21.25Z"
                    stroke="black"
                    stroke-width="1.5"
                  />
                  <path
                    d="M12.5 11.813V16.813"
                    stroke="black"
                    stroke-width="1.5"
                    stroke-linecap="round"
                  />
                  <path
                    d="M12.5 9.68799C13.1904 9.68799 13.75 9.12834 13.75 8.43799C13.75 7.74763 13.1904 7.18799 12.5 7.18799C11.8096 7.18799 11.25 7.74763 11.25 8.43799C11.25 9.12834 11.8096 9.68799 12.5 9.68799Z"
                    fill="black"
                  />
                </svg>
                انا اواجه مشكله تواصل معنا
              </a>
              <hr />
            </div>
          </div>
        </div>
      </section>

    <!-------------------bootstrap script js ----------------------->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
