<!----------------Top Navbar---------------->
<nav class="navbar top-nav navbar-expand-sm">
    <div class="container">
        <ul class="navbar-nav ms-auto mx-auto">
            <div class="d-flex justify-content-between gap-3">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('web.feddback.create') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 16 16"
                            fill="none">
                            <path
                                d="M6.75596 7.02402L7.82996 6.04002C8.12362 5.77044 8.33003 5.41925 8.42268 5.03153C8.51533 4.64381 8.49001 4.23725 8.34996 3.86402L7.89196 2.64102C7.72085 2.18444 7.3821 1.81027 6.94473 1.59474C6.50736 1.37922 6.00427 1.33855 5.53796 1.48102C3.82196 2.00602 2.50296 3.60102 2.90896 5.49502C3.17596 6.74102 3.68696 8.30502 4.65496 9.96902C5.62496 11.637 6.73296 12.869 7.68296 13.735C9.11696 15.04 11.167 14.714 12.486 13.484C12.8393 13.1542 13.0537 12.7022 13.0855 12.2199C13.1172 11.7376 12.964 11.2613 12.657 10.888L11.817 9.86802C11.5636 9.55957 11.2238 9.33398 10.8411 9.22028C10.4585 9.10659 10.0506 9.10998 9.66996 9.23002L8.28195 9.66702C7.9233 9.29728 7.60916 8.88682 7.34596 8.44402C7.09197 7.99624 6.89383 7.51901 6.75596 7.02302"
                                fill="#386BF6" />
                        </svg>
                        {{ __('Feedback') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('web.faqs') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 16 16"
                            fill="none">
                            <path
                                d="M7.66667 1.33331C4.54 1.33331 2 3.87331 2 6.99998C2 10.1266 4.54 12.6666 7.66667 12.6666H8V14.6666C11.24 13.1066 13.3333 9.99998 13.3333 6.99998C13.3333 3.87331 10.7933 1.33331 7.66667 1.33331ZM8.33333 11H7V9.66665H8.33333V11ZM8.33333 8.66665H7C7 6.49998 9 6.66665 9 5.33331C9 4.59998 8.4 3.99998 7.66667 3.99998C6.93333 3.99998 6.33333 4.59998 6.33333 5.33331H5C5 3.85998 6.19333 2.66665 7.66667 2.66665C9.14 2.66665 10.3333 3.85998 10.3333 5.33331C10.3333 6.99998 8.33333 7.16665 8.33333 8.66665Z"
                                fill="#386BF6" />
                        </svg>
                        {{ __('FAQ') }}
                    </a>
                </li>
            </div>

            <div class="d-flex justify-content-between">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('web.terms_condition') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 12 15"
                            fill="none">
                            <path
                                d="M4 5.46198L6 4.71198L8 5.46198V7.01864C7.99999 7.39001 7.89658 7.75404 7.70135 8.06995C7.50613 8.38586 7.22681 8.64118 6.89467 8.80731L6 9.25464L5.10533 8.80798C4.77299 8.64175 4.49353 8.38622 4.2983 8.07005C4.10306 7.75388 3.99977 7.38957 4 7.01798V5.46198Z"
                                fill="#386BF6" />
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M6.468 0.463312C6.16625 0.350201 5.83375 0.350201 5.532 0.463312L0.865333 2.21331C0.611129 2.3086 0.392068 2.47921 0.237435 2.70235C0.0828026 2.92548 -3.37989e-05 3.1905 1.03452e-08 3.46198V7.03731C-2.40211e-05 8.1516 0.310247 9.24387 0.896046 10.1917C1.48184 11.1396 2.32003 11.9056 3.31667 12.404L5.55267 13.5213C5.69155 13.5908 5.84471 13.6269 6 13.6269C6.15529 13.6269 6.30845 13.5908 6.44733 13.5213L8.68333 12.4033C9.67997 11.905 10.5182 11.139 11.104 10.1911C11.6898 9.24321 12 8.15093 12 7.03665V3.46265C12 3.19117 11.9172 2.92615 11.7626 2.70302C11.6079 2.47988 11.3889 2.30927 11.1347 2.21398L6.468 0.463312ZM6.35133 3.41998C6.12482 3.33498 5.87518 3.33498 5.64867 3.41998L3.31533 4.29465C3.12472 4.36618 2.96047 4.49419 2.84456 4.66156C2.72864 4.82894 2.66658 5.02772 2.66667 5.23131V7.01798C2.66656 7.63712 2.8389 8.24406 3.16437 8.77076C3.48983 9.29745 3.95555 9.7231 4.50933 9.99998L5.62733 10.5586C5.74304 10.6165 5.87063 10.6466 6 10.6466C6.12937 10.6466 6.25696 10.6165 6.37267 10.5586L7.49067 9.99998C8.04435 9.72315 8.51 9.29761 8.83546 8.77104C9.16092 8.24447 9.33331 7.63767 9.33333 7.01865V5.23131C9.33342 5.02772 9.27136 4.82894 9.15544 4.66156C9.03953 4.49419 8.87529 4.36618 8.68467 4.29465L6.35133 3.41998Z"
                                fill="#386BF6" />
                        </svg>
                        {{ __('Terms and Conditions Policy') }}
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('web.return_policy') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 12 15"
                            fill="none">
                            <path
                                d="M4 5.46198L6 4.71198L8 5.46198V7.01864C7.99999 7.39001 7.89658 7.75404 7.70135 8.06995C7.50613 8.38586 7.22681 8.64118 6.89467 8.80731L6 9.25464L5.10533 8.80798C4.77299 8.64175 4.49353 8.38622 4.2983 8.07005C4.10306 7.75388 3.99977 7.38957 4 7.01798V5.46198Z"
                                fill="#386BF6" />
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M6.468 0.463312C6.16625 0.350201 5.83375 0.350201 5.532 0.463312L0.865333 2.21331C0.611129 2.3086 0.392068 2.47921 0.237435 2.70235C0.0828026 2.92548 -3.37989e-05 3.1905 1.03452e-08 3.46198V7.03731C-2.40211e-05 8.1516 0.310247 9.24387 0.896046 10.1917C1.48184 11.1396 2.32003 11.9056 3.31667 12.404L5.55267 13.5213C5.69155 13.5908 5.84471 13.6269 6 13.6269C6.15529 13.6269 6.30845 13.5908 6.44733 13.5213L8.68333 12.4033C9.67997 11.905 10.5182 11.139 11.104 10.1911C11.6898 9.24321 12 8.15093 12 7.03665V3.46265C12 3.19117 11.9172 2.92615 11.7626 2.70302C11.6079 2.47988 11.3889 2.30927 11.1347 2.21398L6.468 0.463312ZM6.35133 3.41998C6.12482 3.33498 5.87518 3.33498 5.64867 3.41998L3.31533 4.29465C3.12472 4.36618 2.96047 4.49419 2.84456 4.66156C2.72864 4.82894 2.66658 5.02772 2.66667 5.23131V7.01798C2.66656 7.63712 2.8389 8.24406 3.16437 8.77076C3.48983 9.29745 3.95555 9.7231 4.50933 9.99998L5.62733 10.5586C5.74304 10.6165 5.87063 10.6466 6 10.6466C6.12937 10.6466 6.25696 10.6165 6.37267 10.5586L7.49067 9.99998C8.04435 9.72315 8.51 9.29761 8.83546 8.77104C9.16092 8.24447 9.33331 7.63767 9.33333 7.01865V5.23131C9.33342 5.02772 9.27136 4.82894 9.15544 4.66156C9.03953 4.49419 8.87529 4.36618 8.68467 4.29465L6.35133 3.41998Z"
                                fill="#386BF6" />
                        </svg>
                        {{ __('Return Policy') }}
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('web.terms') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 12 15"
                            fill="none">
                            <path
                                d="M4 5.46198L6 4.71198L8 5.46198V7.01864C7.99999 7.39001 7.89658 7.75404 7.70135 8.06995C7.50613 8.38586 7.22681 8.64118 6.89467 8.80731L6 9.25464L5.10533 8.80798C4.77299 8.64175 4.49353 8.38622 4.2983 8.07005C4.10306 7.75388 3.99977 7.38957 4 7.01798V5.46198Z"
                                fill="#386BF6" />
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M6.468 0.463312C6.16625 0.350201 5.83375 0.350201 5.532 0.463312L0.865333 2.21331C0.611129 2.3086 0.392068 2.47921 0.237435 2.70235C0.0828026 2.92548 -3.37989e-05 3.1905 1.03452e-08 3.46198V7.03731C-2.40211e-05 8.1516 0.310247 9.24387 0.896046 10.1917C1.48184 11.1396 2.32003 11.9056 3.31667 12.404L5.55267 13.5213C5.69155 13.5908 5.84471 13.6269 6 13.6269C6.15529 13.6269 6.30845 13.5908 6.44733 13.5213L8.68333 12.4033C9.67997 11.905 10.5182 11.139 11.104 10.1911C11.6898 9.24321 12 8.15093 12 7.03665V3.46265C12 3.19117 11.9172 2.92615 11.7626 2.70302C11.6079 2.47988 11.3889 2.30927 11.1347 2.21398L6.468 0.463312ZM6.35133 3.41998C6.12482 3.33498 5.87518 3.33498 5.64867 3.41998L3.31533 4.29465C3.12472 4.36618 2.96047 4.49419 2.84456 4.66156C2.72864 4.82894 2.66658 5.02772 2.66667 5.23131V7.01798C2.66656 7.63712 2.8389 8.24406 3.16437 8.77076C3.48983 9.29745 3.95555 9.7231 4.50933 9.99998L5.62733 10.5586C5.74304 10.6165 5.87063 10.6466 6 10.6466C6.12937 10.6466 6.25696 10.6165 6.37267 10.5586L7.49067 9.99998C8.04435 9.72315 8.51 9.29761 8.83546 8.77104C9.16092 8.24447 9.33331 7.63767 9.33333 7.01865V5.23131C9.33342 5.02772 9.27136 4.82894 9.15544 4.66156C9.03953 4.49419 8.87529 4.36618 8.68467 4.29465L6.35133 3.41998Z"
                                fill="#386BF6" />
                        </svg>
                        {{ __('Privacy Policy') }}
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="languageDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 16 16"
                            fill="none">
                            <path
                                d="M8 0C12.4183 0 16 3.58172 16 8C16 12.4183 12.4183 16 8 16C3.58172 16 0 12.4183 0 8C0 3.58172 3.58172 0 8 0Z"
                                fill="#386BF6" />
                            <path
                                d="M8 2C8.55228 2 9 2.44772 9 3V13C9 13.5523 8.55228 14 8 14C7.44772 14 7 13.5523 7 13V3C7 2.44772 7.44772 2 8 2Z"
                                fill="white" />
                            <path
                                d="M2 8C2 7.44772 2.44772 7 3 7H13C13.5523 7 14 7.44772 14 8C14 8.55228 13.5523 9 13 9H3C2.44772 9 2 8.55228 2 8Z"
                                fill="white" />
                        </svg>
                        {{ __('Language') }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="languageDropdown">
                        @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                            <a class="dropdown-item d-flex align-items-center gap-2 py-2"
                                href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                @if (App::getLocale() == $localeCode)
                                    <i class="fas fa-check text-success"></i>
                                @endif
                                <span>{{ $properties['native'] }}</span>
                            </a>
                        @endforeach
                    </ul>
                </li>
            </div>

        </ul>
    </div>
</nav>

<!----------------------primary navbar--------------------->
<nav class="navbar primary-navbar navbar-expand-lg">
    <div class="container">
        @if (auth()->check())
            <div class="d-flex justify-content-end align-items-center gap-3">
                <img src="{{ auth()->user()->image }}" alt="Logo" class="navbar-logo">
                <div class="navbar-logo-text ">
                    <h4>{{ auth()->user()->name }}</h4>
                    <span class="d-flex align-items-center gap-1">
                        <div class="status"></div>
                        {{ __('Online') }}
                    </span>
                </div>
            </div>
        @endif

        <button class="navbar-toggler mt-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-------------------Navbar Links------------------------>
        <!--<div class="collapse navbar-collapse" id="navbarNav">-->
        <!--    <ul class="navbar-nav mx-auto">-->
        <!--        <li class="nav-item">-->
        <!--            <a class="nav-link active" href="{{ route('web.home') }}">{{ __('Home') }}</a>-->
        <!--        </li>-->
        <!--        <li class="nav-item">-->
        <!--            <a class="nav-link" href="{{ route('web.autions') }}">{{ __('Auctions') }}</a>-->
        <!--        </li>-->
        <!--        @if (Auth::check() && auth()->user()->service == 'vendor')
-->
        <!--        <li class="nav-item">-->
        <!--            <a class="nav-link" href="{{ route('web.my_autions') }}">{{ __('My Auctions') }}</a>-->
        <!--        </li>-->
        <!--        <li class="nav-item">-->
        <!--            <a class="nav-link" href="{{ route('web.withdraw_money') }}">{{ __('Withdraw Money') }}</a>-->
        <!--        </li>-->
        <!--
@endif-->

        <!--        <li class="nav-item">-->
        <!--            <a class="nav-link" href="{{ route('web.maintenance_center') }}">{{ __('Maintenance Center') }}</a>-->
        <!--        </li>-->
        <!--        @if (Auth::check() && auth()->user()->service == 'buyer')
-->

        <!--        <li class="nav-item">-->
        <!--            <a class="nav-link" href="{{ route('web.my_commit_autions') }}">{{ __('Auction History') }}</a>-->
        <!--        </li>-->
        <!--
@endif-->
        <!--        @if (Auth::check())
-->
        <!--        <li class="nav-item">-->
        <!--            <a class="nav-link" href="{{ route('web.insurance') }}">{{ __('Insurance') }}</a>-->
        <!--        </li>-->
        <!--
@endif-->
        <!--        <li class="nav-item dropdown">-->
        <!--            <a class="nav-link dropdown-toggle" href="#" id="accountDropdown" role="button"-->
        <!--                data-bs-toggle="dropdown" aria-expanded="false">-->
        <!--                {{ __('My Account') }}-->
        <!--            </a>-->
        <!--            <ul class="dropdown-menu" aria-labelledby="accountDropdown">-->
        <!--                @if (auth()->check())
-->
        <!--                <form method="post" action="{{ route('web.logout') }}">-->
        <!--                    @csrf-->
        <!--                    <li><button type="submit" class="dropdown-item">{{ __('Logout') }}</button></li>-->
        <!--                </form>-->
    <!--            @else-->
        <!--                <li><a class="dropdown-item" href="{{ route('web.loginView') }}">{{ __('Login') }}</a></li>-->
        <!--
@endif-->
        <!--            @if (Auth::check())
-->
        <!--                <li><a class="dropdown-item" href="{{ route('web.profile.my') }}">{{ __('Profile') }}</a></li>-->
        <!--
@endif-->
        <!--                <li><a class="dropdown-item" href="{{ route('web.faqs') }}">{{ __('FAQs') }}</a></li>-->
        <!--                <li><a class="dropdown-item" href="{{ route('web.terms') }}">{{ __('Privacy Policy') }}</a></li>-->
        <!--            </ul>-->
        <!--        </li>-->
        <!--    </ul>-->
        <!--</div>-->

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <a class="nav-link {{ Route::currentRouteName() == 'web.home' ? 'active' : '' }}"
                        href="{{ route('web.home') }}">{{ __('Home') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Route::currentRouteName() == 'web.autions' ? 'active' : '' }}"
                        href="{{ route('web.autions') }}">{{ __('Auctions') }}</a>
                </li>
                @if (Auth::check() && auth()->user()->service == 'vendor')
                    <li class="nav-item">
                        <a class="nav-link {{ Route::currentRouteName() == 'web.my_autions' ? 'active' : '' }}"
                            href="{{ route('web.my_autions') }}">{{ __('My Auctions') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::currentRouteName() == 'web.withdraw_money' ? 'active' : '' }}"
                            href="{{ route('web.withdraw_money') }}">{{ __('Withdraw Money') }}</a>
                    </li>
                @endif

                <li class="nav-item">
                    <a class="nav-link {{ Route::currentRouteName() == 'web.maintenance_center' ? 'active' : '' }}"
                        href="{{ route('web.maintenance_center') }}">{{ __('Maintenance Center') }}</a>
                </li>
                @if (Auth::check() && auth()->user()->service == 'buyer')
                    <li class="nav-item">
                        <a class="nav-link {{ Route::currentRouteName() == 'web.my_commit_autions' ? 'active' : '' }}"
                            href="{{ route('web.my_commit_autions') }}">{{ __('Auction History') }}</a>
                    </li>
                @endif
                @if (Auth::check())
                    <li class="nav-item">
                        <a class="nav-link {{ Route::currentRouteName() == 'web.insurance' ? 'active' : '' }}"
                            href="{{ route('web.insurance') }}">{{ __('Insurance') }}</a>
                    </li>
                @endif
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="accountDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        {{ __('My Account') }}
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="accountDropdown">
                        @if (auth()->check())
                            <form method="post" action="{{ route('web.logout') }}">
                                @csrf
                                <li><button type="submit" class="dropdown-item">{{ __('Logout') }}</button></li>
                            </form>
                        @else
                            <li><a class="dropdown-item" href="{{ route('web.loginView') }}">{{ __('Login') }}</a>
                            </li>
                        @endif
                        @if (Auth::check())
                            <li><a class="dropdown-item"
                                    href="{{ route('web.profile.my') }}">{{ __('Profile') }}</a></li>
                        @endif
                        <li><a class="dropdown-item" href="{{ route('web.faqs') }}">{{ __('FAQs') }}</a></li>
                        <li><a class="dropdown-item" href="{{ route('web.terms') }}">{{ __('Privacy Policy') }}</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>



        <div class="d-flex justify-content-center align-items-center navbar-custom-icon position-relative"
            id="notificationsModal">
            <a href="{{ route('web.notifications') }}"
                class="d-flex justify-content-center align-items-center position-relative">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 22 21"
                    fill="white">
                    <path
                        d="M10.1343 4.12075C10.6862 4.10176 11.1183 3.63892 11.0993 3.08696C11.0803 2.535 10.6175 2.10293 10.0655 2.12192L10.1343 4.12075ZM4.0445 9.74933L3.04498 9.78C3.04534 9.79173 3.0459 9.80347 3.04667 9.8152L4.0445 9.74933ZM2.3376 14.3053L2.99042 15.0628C3.0083 15.0475 3.02563 15.0315 3.04238 15.0148L2.3376 14.3053ZM1.7526 14.7893L2.34002 15.5987C2.35652 15.5867 2.37266 15.5741 2.3884 15.5612L1.7526 14.7893ZM7.4999 18C8.05219 18 8.49992 17.5523 8.49992 17C8.49992 16.4477 8.05219 16 7.4999 16V18ZM10.1343 2.12192C9.58232 2.10293 9.11952 2.535 9.10046 3.08696C9.08152 3.63892 9.51352 4.10176 10.0655 4.12075L10.1343 2.12192ZM16.1553 9.74933L17.1531 9.81507C17.1539 9.80333 17.1545 9.79173 17.1549 9.78L16.1553 9.74933ZM17.8622 14.304L17.1574 15.0135C17.1742 15.03 17.1915 15.0461 17.2094 15.0615L17.8622 14.304ZM18.4473 14.788L17.8114 15.5599C17.8269 15.5725 17.8426 15.5848 17.8587 15.5965L18.4473 14.788ZM12.6999 16C12.1477 16 11.6999 16.4477 11.6999 17C11.6999 17.5523 12.1477 18 12.6999 18V16ZM9.09992 3.12133C9.09992 3.67361 9.54766 4.12133 10.0999 4.12133C10.6522 4.12133 11.0999 3.67361 11.0999 3.12133H9.09992ZM11.0999 1C11.0999 0.44772 10.6522 0 10.0999 0C9.54766 0 9.09992 0.44772 9.09992 1H11.0999ZM7.4999 16C6.94762 16 6.4999 16.4477 6.4999 17C6.4999 17.5523 6.94762 18 7.4999 18V16ZM12.6999 18C13.2522 18 13.6999 17.5523 13.6999 17C13.6999 16.4477 13.2522 16 12.6999 16V18ZM8.49992 17C8.49992 16.4477 8.05219 16 7.4999 16C6.94762 16 6.4999 16.4477 6.4999 17H8.49992ZM13.6999 17C13.6999 16.4477 13.2522 16 12.6999 16C12.1477 16 11.6999 16.4477 11.6999 17H13.6999ZM10.0655 2.12192C6.0364 2.26051 2.92004 5.70935 3.04498 9.78L5.04403 9.71867C4.95143 6.70151 7.25323 4.21984 10.1343 4.12075L10.0655 2.12192ZM3.04667 9.8152C3.14031 11.2331 2.61948 12.6157 1.63283 13.5959L3.04238 15.0148C4.44554 13.6208 5.17354 11.6701 5.04232 9.68347L3.04667 9.8152ZM1.68479 13.5479C1.47587 13.7279 1.30027 13.8664 1.11679 14.0175L2.3884 15.5612C2.53512 15.4403 2.75992 15.2615 2.99042 15.0628L1.68479 13.5479ZM1.16519 13.98C0.872843 14.1923 0.60719 14.4955 0.409163 14.8156C0.21359 15.1316 0.0264699 15.5571 0.00249657 16.0277C-0.0237301 16.5425 0.153603 17.1151 0.680416 17.5179C1.15172 17.8784 1.77278 18 2.4299 18V16C2.21212 16 2.06807 15.9787 1.9797 15.9561C1.89207 15.9339 1.87648 15.9148 1.89536 15.9292C1.91982 15.948 1.95607 15.9877 1.97998 16.0449C2.00168 16.0971 1.99982 16.1312 1.99991 16.1296C2.0001 16.1257 2.00275 16.0977 2.02179 16.0452C2.04039 15.9939 2.0697 15.9329 2.10991 15.868C2.1499 15.8033 2.19538 15.7432 2.24043 15.6931C2.28676 15.6413 2.32278 15.6111 2.34002 15.5987L1.16519 13.98ZM2.4299 18H7.4999V16H2.4299V18ZM10.0655 4.12075C12.9466 4.21984 15.2483 6.70151 15.1558 9.71867L17.1549 9.78C17.2798 5.70935 14.1634 2.26051 10.1343 2.12192L10.0655 4.12075ZM15.1575 9.6836C15.0267 11.6699 15.7547 13.6199 17.1574 15.0135L18.567 13.5945C17.5806 12.6147 17.0598 11.2325 17.1531 9.81507L15.1575 9.6836ZM17.2094 15.0615C17.4399 15.2601 17.6647 15.4389 17.8114 15.5599L19.083 14.0161C18.8995 13.8651 18.7239 13.7265 18.515 13.5465L17.2094 15.0615ZM17.8587 15.5965C17.8766 15.6095 17.9131 15.6403 17.9598 15.6924C18.0053 15.7431 18.0511 15.8035 18.0915 15.8685C18.1321 15.9339 18.1617 15.9951 18.1805 16.0467C18.1997 16.0995 18.2025 16.1276 18.2026 16.1313C18.2027 16.1329 18.2007 16.0984 18.2226 16.0459C18.2466 15.988 18.2833 15.948 18.3079 15.9291C18.3269 15.9145 18.3113 15.9336 18.2233 15.956C18.1345 15.9787 17.9898 16 17.7713 16V18C18.429 18 19.0509 17.8785 19.5225 17.518C20.0503 17.1145 20.2271 16.5409 20.1998 16.0257C20.1749 15.5548 19.9867 15.1296 19.7909 14.8139C19.5925 14.4941 19.3269 14.1915 19.0357 13.9795L17.8587 15.5965ZM17.7713 16H12.6999V18H17.7713V16ZM11.0999 3.12133V1H9.09992V3.12133H11.0999ZM7.4999 18H12.6999V16H7.4999V18ZM6.4999 17C6.4999 19.0011 8.08792 20.6667 10.0999 20.6667V18.6667C9.23992 18.6667 8.49992 17.9445 8.49992 17H6.4999ZM10.0999 20.6667C12.1118 20.6667 13.6999 19.0011 13.6999 17H11.6999C11.6999 17.9445 10.9598 18.6667 10.0999 18.6667V20.6667Z"
                        fill="white" />
                </svg>
                @if (Auth::check())
                    @php
                        $unreadNotifications = Auth::user()->unreadNotifications->count();
                    @endphp
                    @if ($unreadNotifications > 0)
                        <span
                            class="badge badge-danger position-absolute top-0 start-100 translate-middle p-1 px-2 rounded-circle">
                            {{ $unreadNotifications }}
                        </span>
                    @endif
                @endif
            </a>
        </div>

    </div>
</nav>
