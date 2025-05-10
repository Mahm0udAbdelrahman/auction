<!doctype html>
<html lang="ar" data-bs-theme="light_mode" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mazad | @yield('title')</title>
    <!--favicon-->
    <link rel="icon" href="{{ asset('dash-assets/assets/images/logo2.png') }}" type="image/png">
    <!-- loader-->
    <link href="{{ asset('dash-assets/assets/css/pace.min.css') }}" rel="stylesheet">
    <script src="{{ asset('dash-assets/assets/js/pace.min.js') }}"></script>

    <!--plugins-->
    <link href="{{ asset('dash-assets/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('dash-assets/assets/plugins/metismenu/metisMenu.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dash-assets/assets/plugins/metismenu/mm-vertical.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dash-assets/assets/plugins/simplebar/css/simplebar.css') }}">
    <!--bootstrap css-->
    <link href="{{ asset('dash-assets/assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css"
        integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="{{ asset('dash-assets/assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}"
        rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Material+Icons+Outlined" rel="stylesheet">
    <!-- toastr -->
    <link href="{{ asset('layout/plugins/toastr/toastr.min.css') }}" rel="stylesheet">
    <!--main css-->
    <link href="{{ asset('dash-assets/assets/css/bootstrap-extended.css') }}" rel="stylesheet">
    @if (App::getLocale() == 'ar')
        <link href="{{ asset('dash-assets/sass/main.css') }}" rel="stylesheet">

        <link href="{{ asset('dash-assets/sass/semi-dark.css') }}" rel="stylesheet">
        <link href="{{ asset('dash-assets/sass/bordered-theme.css') }}" rel="stylesheet">
        <link href="{{ asset('dash-assets/sass/responsive.css') }}" rel="stylesheet">
    @endif
    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>

    @if (App::getLocale() == 'en' || App::getLocale() == 'ru')
        <link href="{{ asset('dash-assets/assets/css/main.css') }}" rel="stylesheet">
        <link href="{{ asset('dash-assets/assets/css/responsive.css') }}" rel="stylesheet">
    @endif
    @stack('css')

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
</head>

<body dir="{{ App::getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
    <!--start header-->
    <header class="top-header">
        <nav class="navbar navbar-expand d-flex align-items-center justify-content-between">
            <div class="btn-toggle">
                <a href="javascript:;"><i class="material-icons-outlined">menu</i></a>
            </div>

            <div class="card-body search-content text-center">
                <!-- <h1 style="color: #025e6e;">Row Best</h1> -->
            </div>

            <ul class="navbar-nav gap-4 nav-right-links align-items-center"> <!-- زيادة gap -->
                <li class="nav-item dropdown">
                    <div
                        class="dropdown-menu dropdown-notify dropdown-menu-{{ in_array(App::getLocale(), ['en', 'ru']) ? 'end' : 'start' }}  shadow">
                        <div class="notify-list"></div>
                    </div>
                </li>

                <li class="nav-item dropdown me-4">
                    <a href="javascript:;"
                        class="dropdown-toggle position-relative d-flex align-items-center notificationsIcon"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-bell fs-5"></i>
                        @if (Auth::user()->unreadNotifications()->count())
                            <span
                                class="badge rounded-pill bg-danger position-absolute top-0 start-100 translate-middle"
                                id="notificationsIconCounter">
                                {{ Auth::user()->unreadNotifications()->count() }}
                            </span>
                        @endif
                    </a>
                    <div class="dropdown-menu dropdown-menu-{{ in_array(App::getLocale(), ['en', 'ru']) ? 'end' : 'start' }} shadow-lg"
                        style="width: 380px; max-height: 450px; overflow-y: auto; border-radius: 8px;">
                        <div class="dropdown-header bg-primary text-white text-center py-2">
                            <strong>{{ __('Notifications') }}</strong>
                        </div>
                        <div class="list-group" id="notificationsModal">
                            @forelse(auth()->user()->notifications()->orderBy('created_at', 'desc')->take(5)->get() as $notification)
                                <a href="{{ $notification->data['url'] }}?notification_id={{ $notification->id }}"
                                    class="list-group-item list-group-item-action d-flex gap-3 align-items-start mark-as-read"
                                    data-id="{{ $notification->id }}">
                                    <i class="fas fa-user-circle text-primary fs-4"></i>
                                    <div class="w-100">
                                        <div class="d-flex justify-content-between">
                                            <p
                                                class="mb-1 @if (!$notification->read_at) text-dark fw-bold @else text-muted @endif">
                                                {{ $notification->data['message'] }}
                                            </p>
                                            <small
                                                class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                                        </div>
                                    </div>
                                </a>
                            @empty
                                <div class="text-center text-muted py-3">
                                    {{ __('No new notifications') }}
                                </div>
                            @endforelse
                        </div>
                        {{-- @if ($notifications->count()) --}}
                        <div class="text-center p-2 border-top">
                            <a href="{{ route('Admin.notifications.markAllRead') }}"
                                class="btn btn-sm btn-outline-primary me-2">{{ __('Read All') }}</a>
                            <a href="{{ route('Admin.notifications') }}"
                                class="btn btn-sm btn-primary">{{ __('Index All') }}</a>
                        </div>
                        {{-- @endif --}}
                    </div>
                </li>

                <!-- اللغة -->
                <li class="nav-item dropdown me-4">
                    <a href="javascript:;" class="dropdown-toggle dropdown-toggle-nocaret" data-bs-toggle="dropdown">
                        <i class="fas fa-globe fs-5"></i>
                    </a>
                    <div
                        class="dropdown-menu dropdown-menu-{{ in_array(App::getLocale(), ['en', 'ru']) ? 'end' : 'start' }} shadow">
                        <div class="dropdown-header bg-primary text-white text-center py-2">
                            <strong>{{ __('Language') }}</strong>
                        </div>
                        @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                            <a class="dropdown-item d-flex align-items-center gap-2 py-2"
                                href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                @if (App::getLocale() == $localeCode)
                                    <i class="fas fa-check text-success"></i>
                                @endif
                                <span>{{ $properties['native'] }}</span>
                            </a>
                        @endforeach
                    </div>
                </li>


                <li class="nav-item dropdown me-4"> <!-- زيادة المسافة -->
                    <a href="javascript:;" class="dropdown-toggle dropdown-toggle-nocaret" data-bs-toggle="dropdown">
                        <img src="{{ asset('dash-assets/assets/images/logo2.png') }}"
                            class="rounded-circle p-1 border" width="45" height="45" alt="">
                    </a>
                    <div
                        class="dropdown-menu dropdown-user dropdown-menu-{{ in_array(App::getLocale(), ['en', 'ru']) ? 'end' : 'start' }}  shadow">
                        <a class="dropdown-item gap-2 py-2" href="javascript:;">
                            <div class="text-center">
                                <img src="{{ asset('dash-assets/assets/images/logo2.png') }}"
                                    class="rounded-circle p-1 shadow mb-3" width="90" height="90"
                                    alt="">
                                <h5 class="user-name mb-0 fw-bold">{{ __('Mazad') }}</h5>
                            </div>
                        </a>
                        @can('profile-update')
                            <hr class="dropdown-divider">
                            <a href="{{ route('Admin.profile') }}"
                                class="dropdown-item d-flex align-items-center gap-2 py-2">{{ __('Profile') }}</a>
                        @endcan
                        <hr class="dropdown-divider">
                        <a class="dropdown-item d-flex align-items-center gap-2 py-2"
                            href="{{ route('Admin.logout') }}"><i
                                class="material-icons-outlined">power_settings_new</i>{{ __('Logout') }}</a>
                    </div>
                </li>
            </ul>

        </nav>
    </header>
    <!--end top header-->

    <!--start sidebar-->
    <aside class="sidebar-wrapper" data-simplebar="true">
        <div class="sidebar-header">
            <div class="logo-name flex-grow-1 text-center fw-bold">
                <a href="{{ route('Admin.home') }}">
                    <img src="{{ asset('auth-assets/media/logo.jpeg') }}" style="width: 100px; height: auto;"
                        alt="Logo">
                </a>
            </div>

            <div class="sidebar-close">
                <span class="material-icons-outlined">close</span>
            </div>
        </div>

        <div class="sidebar-nav">
            <ul class="metismenu" id="sidenav">

                <li>
                    <a href="{{ route('Admin.home') }}" @if (Route::currentRouteName() == 'Admin.home') class="active" @endif>
                        <div class="parent-icon"><i class="fas fa-tachometer-alt"></i></div>
                        <div class="menu-title">{{ __('Home') }}</div>
                    </a>
                </li>

                @can('users-index')
                    <li>
                        <a href="{{ route('Admin.users.index') }}"
                            @if (Route::currentRouteName() == 'Admin.users.index') class="active" @endif>
                            <div class="parent-icon"><i class="fas fa-users"></i></div>
                            <div class="menu-title">{{ __('Users') }}</div>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('Admin.get_users_vendor_a') }}"
                            @if (Route::currentRouteName() == 'Admin.get_users_vendor_a') class="active" @endif>
                            <div class="parent-icon"><i class="fas fa-store"></i></div>
                            <div class="menu-title">{{ __('Vendor A') }}</div>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('Admin.get_users_vendor_b') }}"
                            @if (Route::currentRouteName() == 'Admin.get_users_vendor_b') class="active" @endif>
                            <div class="parent-icon"><i class="fas fa-store-alt"></i></div>
                            <div class="menu-title">{{ __('Vendor B') }}</div>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('Admin.get_users_vendor_c') }}"
                            @if (Route::currentRouteName() == 'Admin.get_users_vendor_c') class="active" @endif>
                            <div class="parent-icon"><i class="fas fa-store"></i></div>
                            <div class="menu-title">{{ __('Vendor C') }}</div>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('Admin.get_users_buyer_a') }}"
                            @if (Route::currentRouteName() == 'Admin.get_users_buyer_a') class="active" @endif>
                            <div class="parent-icon"><i class="fas fa-shopping-cart"></i></div>
                            <div class="menu-title">{{ __('Buyer A') }}</div>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('Admin.get_users_buyer_b') }}"
                            @if (Route::currentRouteName() == 'Admin.get_users_buyer_b') class="active" @endif>
                            <div class="parent-icon"><i class="fas fa-cart-plus"></i></div>
                            <div class="menu-title">{{ __('Buyer B') }}</div>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('Admin.get_users_buyer_c') }}"
                            @if (Route::currentRouteName() == 'Admin.get_users_buyer_c') class="active" @endif>
                            <div class="parent-icon"><i class="fas fa-cart-arrow-down"></i></div>
                            <div class="menu-title">{{ __('Buyer C') }}</div>
                        </a>
                    </li>
                @endcan

                @can('roles-index')
                    <li>
                        <a href="{{ route('Admin.roles.index') }}"
                            @if (Route::currentRouteName() == 'Admin.roles.index') class="active" @endif>
                            <div class="parent-icon"><i class="fas fa-user-shield"></i></div>
                            <div class="menu-title">{{ __('Roles') }}</div>
                        </a>
                    </li>
                @endcan

                @can('maintenance_centers-index')
                    <li>
                        <a href="{{ route('Admin.maintenance_centers.index') }}"
                            @if (Route::currentRouteName() == 'Admin.maintenance_centers') class="active" @endif>
                            <div class="parent-icon"><i class="fas fa-tools"></i></div>
                            <div class="menu-title">{{ __('Maintenance Center') }}</div>
                        </a>
                    </li>
                @endcan
                @can('type_payment-index')
                    <li>
                        <a href="{{ route('Admin.type_payment.index') }}"
                            @if (Route::currentRouteName() == 'Admin.car_types') class="active" @endif>
                            <div class="parent-icon"><i class="fas fa-car-side"></i></div>
                            <div class="menu-title">{{ __('Type Payment') }}</div>
                        </a>
                    </li>
                @endcan
                @can('car_types-index')
                    <li>
                        <a href="{{ route('Admin.car_types.index') }}"
                            @if (Route::currentRouteName() == 'Admin.car_types') class="active" @endif>
                            <div class="parent-icon"><i class="fas fa-car-side"></i></div>
                            <div class="menu-title">{{ __('Car Types') }}</div>
                        </a>
                    </li>
                @endcan

                @can('cars-index')
                    <li>
                        <a href="{{ route('Admin.cars.index') }}"
                            @if (Route::currentRouteName() == 'Admin.cars') class="active" @endif>
                            <div class="parent-icon"><i class="fas fa-car"></i></div>
                            <div class="menu-title">{{ __('Cars') }}</div>
                        </a>
                    </li>
                @endcan

                @can('auctions-index')
                    <li>
                        <a href="{{ route('Admin.auctions.index') }}"
                            @if (Route::currentRouteName() == 'Admin.auctions.index') class="active" @endif>
                            <div class="parent-icon"><i class="fas fa-gavel"></i></div>
                            <div class="menu-title">{{ __('Auctions') }}</div>
                        </a>
                    </li>
                @endcan

                @can('insurances-index')
                    <li>
                        <a href="{{ route('Admin.insurances.index') }}"
                            @if (Route::currentRouteName() == 'Admin.insurances.index') class="active" @endif>
                            <div class="parent-icon"><i class="fas fa-file-contract"></i></div>
                            <div class="menu-title">{{ __('Insurances') }}</div>
                        </a>
                    </li>
                @endcan
                @can('notifications-index')
                    <li>
                        <a href="{{ route('Admin.notifications') }}"
                            @if (Route::currentRouteName() == 'Admin.notifications') class="active" @endif>
                            <div class="parent-icon"><i class="fas fa-bell"></i></div>
                            <div class="menu-title">{{ __('Notifications') }}</div>
                        </a>
                    </li>
                @endcan

                @can('balance_insurances-index')
                    <li>
                        <a href="{{ route('Admin.balance_insurances.index') }}"
                            @if (Route::currentRouteName() == 'Admin.balance_insurances.index') class="active" @endif>
                            <div class="parent-icon"><i class="fas fa-shield-alt"></i></div>
                            <div class="menu-title">{{ __('Balance Insurances') }}</div>
                        </a>
                    </li>
                @endcan

                @can('withdraw_money-index')
                    <li>
                        <a href="{{ route('Admin.withdraw_money.index') }}"
                            @if (Route::currentRouteName() == 'Admin.withdraw_money.index') class="active" @endif>
                            <div class="parent-icon"><i class="fas fa-money-bill-wave"></i></div>
                            <div class="menu-title">{{ __('Withdraw Money') }}</div>
                        </a>
                    </li>
                @endcan



                @can('send_notifications-index')
                    <li>
                        <a href="{{ route('Admin.send_notifications.index') }}"
                            @if (Route::currentRouteName() == 'Admin.send_notifications.index') class="active" @endif>
                            <div class="parent-icon"><i class="fas fa-paper-plane"></i></div>
                            <div class="menu-title">{{ __('Send Notification') }}</div>
                        </a>
                    </li>
                @endcan

                @can('countries-index')
                    <li>
                        <a href="{{ route('Admin.countries.index') }}"
                            @if (Route::currentRouteName() == 'Admin.countries.index') class="active" @endif>
                            <div class="parent-icon"><i class="fas fa-globe"></i></div>
                            <div class="menu-title">{{ __('Countries') }}</div>
                        </a>
                    </li>
                @endcan

                @can('governorates-index')
                    <li>
                        <a href="{{ route('Admin.governorates.index') }}"
                            @if (Route::currentRouteName() == 'Admin.governorates.index') class="active" @endif>
                            <div class="parent-icon"><i class="fas fa-map-marked-alt"></i></div>
                            <div class="menu-title">{{ __('Governorates') }}</div>
                        </a>
                    </li>
                @endcan

                @can('privacy_policy-update')
                    <li>
                        <a href="{{ route('Admin.privacy_policy.index') }}"
                            @if (Route::currentRouteName() == 'Admin.privacy_policy.index') class="active" @endif>
                            <div class="parent-icon"><i class="fas fa-shield-alt"></i></div>
                            <div class="menu-title">{{ __('Privacy Policy') }}</div>
                        </a>
                    </li>
                @endcan

                @can('feedback-index')
                    <li>
                        <a href="{{ route('Admin.feedback.index') }}"
                            @if (Route::currentRouteName() == 'Admin.feedback.index') class="active" @endif>
                            <div class="parent-icon"><i class="fas fa-shield-alt"></i></div>
                            <div class="menu-title">{{ __('Feedback') }}</div>
                        </a>
                    </li>
                @endcan

                @can('questions-index')
                    <li>
                        <a href="{{ route('Admin.questions.index') }}"
                            @if (Route::currentRouteName() == 'Admin.questions.index') class="active" @endif>
                            <div class="parent-icon"><i class="fas fa-question-circle"></i></div>
                            <div class="menu-title">{{ __('Questions') }}</div>
                        </a>
                    </li>
                @endcan
                @can('setting-update')
                    <li>
                        <a href="{{ route('Admin.setting.show') }}"
                            @if (Route::currentRouteName() == 'Admin.setting.show') class="active" @endif>
                            <div class="parent-icon"><i class="fas fa-cog"></i></div>
                            <div class="menu-title">{{ __('Settings') }}</div>
                        </a>
                    </li>
                @endcan

                @can('privacy_policy-update')
                    <li>
                        <a href="{{ route('Admin.privacy_policy.index') }}"
                            @if (Route::currentRouteName() == 'Admin.privacy_policy.index') class="active" @endif>
                            <div class="parent-icon"><i class="fas fa-shield-alt"></i></div>
                            <div class="menu-title">{{ __('Privacy Policy') }}</div>
                        </a>
                    </li>
                @endcan

                <li>
                    <a href="{{ route('Admin.return_policy.index') }}"
                        @if (Route::currentRouteName() == 'Admin.return_policy.index') class="active" @endif>
                        <div class="parent-icon"><i class="fas fa-cog"></i></div>
                        <div class="menu-title">{{ __('Return Policy') }}</div>
                    </a>
                </li>


                <li>
                    <a href="{{ route('Admin.terms_condition.index') }}"
                        @if (Route::currentRouteName() == 'Admin.terms_condition.index') class="active" @endif>
                        <div class="parent-icon"><i class="fas fa-cog"></i></div>
                        <div class="menu-title">{{ __('Terms and Conditions Policy') }}</div>
                    </a>
                </li>


            </ul>
        </div>
    </aside>
    <!--end sidebar-->

    @yield('content')


    <!--start overlay-->
    <div class="overlay btn-toggle"></div>
    <!--end overlay-->

    <!--bootstrap js-->
    <script src="{{ asset('dash-assets/assets/js/bootstrap.bundle.min.js') }}"></script>

    <!--plugins-->
    <script src="{{ asset('dash-assets/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('dash-assets/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('dash-assets/assets/plugins/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('dash-assets/assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('dash-assets/assets/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('dash-assets/assets/plugins/simplebar/js/simplebar.min.js') }}"></script>
    <script src="{{ asset('dash-assets/assets/js/main.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- toastr -->
    <script src="{{ asset('layout/plugins/toastr/toastr.min.js') }}"></script>
    @stack('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const notifications = document.querySelectorAll('.mark-as-read');

            notifications.forEach(notification => {
                notification.addEventListener('click', function(e) {
                    e.preventDefault();

                    const notificationId = this.dataset.id;

                    fetch('{{ route('Admin.notifications.markAsRead') }}', {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Content-Type': 'application/json',
                            },
                            body: JSON.stringify({
                                id: notificationId
                            }),
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                this.classList.remove('fw-bold');
                                this.querySelector('p').classList.remove('fw-bold');
                            }
                        })
                        .catch(error => console.error('Error:', error));
                });
            });
        });

        .then(data => {
            if (data.success) {
                this.classList.remove('fw-bold');
                this.querySelector('p').classList.remove('fw-bold');

                const counter = document.getElementById('notificationsIconCounter');
                if (counter) {
                    const currentCount = parseInt(counter.innerText);
                    const newCount = currentCount - 1;

                    if (newCount > 0) {
                        counter.innerText = newCount;
                    } else {
                        counter.remove();
                    }
                }
            }
        })
    </script>

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
    <script src="https://js.pusher.com/8.4.0/pusher.min.js"></script>
    <script>
        Pusher.logToConsole = true;

        var pusher = new Pusher('be0ad09caf2a03bff45e', {
            cluster: "mt1"
        });

        var channel = pusher.subscribe('mazad');
        channel.bind('auction', function(data) {
            $(".notificationsIcon").load(" .notificationsIcon > *");
            $('#notificationsModal').load(" #notificationsModal > *");
        });
    </script>
</body>

</html>
