@extends('web.layouts.app')
@section('contact')
    <!---------------------main--------------------------->
    <section class="elmazad-page py-3">
        <div class="container mt-4">
            <div class="row">
                @php
                $colors = [
                    __('Red'),
                    __('Blue'),
                    __('Green'),
                    __('Yellow'),
                    __('Orange'),
                    __('Black'),
                    __('White'),
                    __('Gray'),
                    __('Brown'),
                    __('Pink'),
                    __('Purple'),
                    __('Gold'),
                    __('Silver'),
                ];

                $currentYear = date('Y');
            @endphp

            <div class="col-lg-3 mb-4">
                <form method="get">
                    <div class="aside">
                        <h5 class="mb-4">{{ __('Filter By') }}</h5>
                        <hr style="margin-top: 29px;" />

                        <!-- السعر -->
                            <label class="form-label">{{ __('Price') }}</label>
                            <div class="d-flex sidebar-price gap-3">
                                <input type="number" class="form-control mb-2" name="price_min"
                                    placeholder="{{__('From 200,000')}}" step="0.01"
                                    value="{{ old('price_min', request('price_min')) }}">
                                <input type="number" class="form-control mb-2" name="price_max"
                                    placeholder="{{__('To 200,000')}}" step="0.01"
                                    value="{{ old('price_max', request('price_max')) }}">
                            </div>

                        <!-- نوع السيارة -->
                        <label class="form-label">{{ __('Car Type') }}</label>
                        <select class="form-select mb-2" name="car_type_id">
                            <option value="" selected>{{ __('Select Type') }}</option>
                            @foreach ($types as $type)
                                <option value="{{ $type->id }}"
                                    {{ old('car_type_id', request('car_type_id')) == $type->id ? 'selected' : '' }}>
                                    {{ $type->{'name_' . app()->getLocale()} }}
                                </option>
                            @endforeach
                        </select>

                        <!-- موديل السيارة -->
                        <label class="form-label">{{ __('Car Model') }}</label>
                        <select class="form-select mb-2" name="model">
                            <option value="" selected>{{ __('Select Model') }}</option>
                            @for ($year = $currentYear; $year >= 1980; $year--)
                                <option value="{{ $year }}"
                                    {{ old('model', request('model')) == $year ? 'selected' : '' }}>
                                    {{ $year }}
                                </option>
                            @endfor
                        </select>

                        <!-- تاريخ المزاد -->
                        <label class="form-label">{{ __('Auction Date') }}</label>
                        <select class="form-select mb-2" name="auction_date">
                            <option value="">{{ __('Select...') }}</option>
                            <option value="first_week"
                                {{ old('auction_date', request('auction_date')) == 'first_week' ? 'selected' : '' }}>
                                {{ __('First Week') }}</option>
                            <option value="second_week"
                                {{ old('auction_date', request('auction_date')) == 'second_week' ? 'selected' : '' }}>
                                {{ __('Second Week') }}</option>
                            <option value="third_week"
                                {{ old('auction_date', request('auction_date')) == 'third_week' ? 'selected' : '' }}>
                                {{ __('Third Week') }}</option>
                            <option value="last_month"
                                {{ old('auction_date', request('auction_date')) == 'last_month' ? 'selected' : '' }}>
                                {{ __('Last Month') }}</option>
                        </select>

                        <!-- قسم Accordion -->
                        <div class="accordion mt-4" id="filterAccordion">
                            <div class="accordion-item">
                                <button class="accordion-button collapsed text-center" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#collapseOptions" aria-expanded="false"
                                    aria-controls="collapseOptions">
                                    {{ __('More Options') }}
                                </button>

                                <div id="collapseOptions" class="accordion-collapse collapse"
                                    aria-labelledby="headingOptions" data-bs-parent="#filterAccordion">
                                    <div class="accordion-body">
                                        <!-- الكيلو متر -->
                                        <label class="form-label">{{ __('Kilometer') }}</label>
                                        <div
                                            class="km-input mb-2 d-flex align-items-center justify-content-between form-control">
                                            <input type="text" name="kilometer" class="form-control border-0"
                                                placeholder="350" value="{{ old('kilometer', request('kilometer')) }}">
                                            <span>{{ __('km') }}</span>
                                        </div>

                                        <!-- اللون -->
                                        <label class="form-label">{{ __('Color') }}</label>
                                        <select class="form-select mb-2" name="color">
                                            <option value="" selected>{{ __('Choose Color') }}</option>
                                            @foreach ($colors as $color)
                                                <option value="{{ $color }}"
                                                    {{ old('color', request('color')) == $color ? 'selected' : '' }}>
                                                    {{ $color }}
                                                </option>
                                            @endforeach
                                        </select>

                                        <!-- الرخصة -->
                                        <label class="form-label">{{ __('License') }}</label>
                                        <select class="form-select mb-2" name="license_year">
                                            <option value="" selected>{{ __('Choose Year') }}</option>
                                            @for ($year = $currentYear; $year >= 1980; $year--)
                                                <option value="{{ $year }}"
                                                    {{ old('license_year', request('license_year')) == $year ? 'selected' : '' }}>
                                                    {{ $year }}
                                                </option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- زر البحث -->
                        <button type="submit" class="btn btn-primary w-100 mt-3">{{ __('Search') }}</button>
                    </div>
                </form>
            </div>
                <!-- Main Content (Car Cards) -->
                <div class="col-lg-9">
                    <h4 class="mb-3">{{ __('The Auctioneer') }}</h4>
                    <hr class="my-4" />
                    <div class="row my-5 py-2 ">
                        <!-- Card Item -->
                        @foreach ($commit_auctions as $commit)
                            <div class="col-md-6 col-xl-4 mb-4">
                                <div class="card">
                                    <div
                                        class="mazad-user-info d-flex flex-wrap align-items-center justify-content-between mb-4">
                                        <div class="user-img d-flex align-items-center gap-2 mb-3 flex-wrap">
                                            <img src="{{ $commit->auction->user->image }}" alt="user img" />
                                            <div class="user-info">
                                                <h6 class="fw-bold">{{ $commit->auction->user->name }}</h6>
                                                <!--<a>{{ __('View Profile') }}</a>-->
                                            </div>
                                        </div>
                                        <span><svg xmlns="http://www.w3.org/2000/svg" width="17" height="16"
                                                viewBox="0 0 17 16" fill="none">
                                                <path
                                                    d="M15.9999 7.99996C15.9999 12.05 12.7167 15.3333 8.66659 15.3333C4.6165 15.3333 1.33325 12.05 1.33325 7.99996C1.33325 3.94987 4.6165 0.666626 8.66659 0.666626C12.7167 0.666626 15.9999 3.94987 15.9999 7.99996ZM2.67114 7.99996C2.67114 11.3112 5.35539 13.9954 8.66659 13.9954C11.9778 13.9954 14.6621 11.3112 14.6621 7.99996C14.6621 4.68877 11.9778 2.00451 8.66659 2.00451C5.35539 2.00451 2.67114 4.68877 2.67114 7.99996Z"
                                                    fill="#606060" />
                                                <path
                                                    d="M8.66642 3.33337C8.29822 3.33337 7.99976 3.63185 7.99976 4.00004V8.31117C7.99976 8.31117 7.99976 8.48497 8.08422 8.61571C8.14076 8.72657 8.22889 8.82291 8.34469 8.88977L11.4246 10.668C11.7434 10.852 12.1512 10.7428 12.3352 10.4239C12.5193 10.105 12.4101 9.69731 12.0912 9.51324L9.33309 7.92084V4.00004C9.33309 3.63185 9.03462 3.33337 8.66642 3.33337Z"
                                                    fill="#606060" />
                                            </svg> {{ $commit->auction->created_at->diffForHumans() }}</span>
                                    </div>
                                    <div id="carousel3" class="carousel slide" data-bs-ride="carousel">
                                        <div class="carousel-indicators">
                                            <button type="button" data-bs-target="#carousel3" data-bs-slide-to="0"
                                                class="active"></button>
                                            <button type="button" data-bs-target="#carousel3"
                                                data-bs-slide-to="1"></button>
                                            <button type="button" data-bs-target="#carousel3"
                                                data-bs-slide-to="2"></button>
                                        </div>
                                        <div class="carousel-inner">
                                            @foreach ($commit->auction->car->carImages as $image)
                                                <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                                    <img src="{{ $image->image }}" class="card-img-top" alt="Car">
                                                </div>
                                            @endforeach



                                        </div>
                                        <button class="carousel-control-prev" type="button" data-bs-target="#carousel3"
                                            data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon"></span>
                                        </button>
                                        <button class="carousel-control-next" type="button" data-bs-target="#carousel3"
                                            data-bs-slide="next">
                                            <span class="carousel-control-next-icon"></span>
                                        </button>
                                    </div>

                                    <!-- Card Body -->
                                    <div class="card-body">
                                        <div class="car-info d-flex  justify-content-between sidebar-category">
                                            <h6 class="card-title">{{ $commit->auction->car->name }} </h6>
                                            <p class="price">{{ $commit->auction->car->price }}</p>
                                        </div>

                                        <!-- Auction Details -->
                                        <div class="auction-details">
                                            <span class="badge d-flex align-items-center gap-2"><svg
                                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 16 16" fill="none">
                                                    <path
                                                        d="M14.6688 8.96703L10.8028 7.57753L9.18676 5.54853C9.04624 5.37673 8.86924 5.23837 8.66859 5.1435C8.46795 5.04862 8.2487 4.99961 8.02676 5.00003H4.02876C3.78426 5.00003 3.54346 5.0598 3.32734 5.17414C3.11122 5.28847 2.92633 5.4539 2.78876 5.65603L1.43276 7.64753C1.15067 8.06216 0.999804 8.55204 0.999756 9.05353V13C0.999756 13.1326 1.05243 13.2598 1.1462 13.3536C1.23997 13.4473 1.36715 13.5 1.49976 13.5H2.57076C2.67952 13.9291 2.92827 14.3097 3.27764 14.5816C3.62702 14.8535 4.05707 15.0011 4.49976 15.0011C4.94244 15.0011 5.37249 14.8535 5.72187 14.5816C6.07124 14.3097 6.31999 13.9291 6.42876 13.5H9.57076C9.67952 13.9291 9.92827 14.3097 10.2776 14.5816C10.627 14.8535 11.0571 15.0011 11.4998 15.0011C11.9424 15.0011 12.3725 14.8535 12.7219 14.5816C13.0712 14.3097 13.32 13.9291 13.4288 13.5H14.4998C14.6324 13.5 14.7595 13.4473 14.8533 13.3536C14.9471 13.2598 14.9998 13.1326 14.9998 13V9.43753C14.9997 9.33456 14.9679 9.23412 14.9087 9.14991C14.8495 9.0657 14.7657 9.00183 14.6688 8.96703ZM4.49976 14C4.30197 14 4.10863 13.9414 3.94419 13.8315C3.77974 13.7216 3.65156 13.5654 3.57588 13.3827C3.50019 13.2 3.48039 12.9989 3.51897 12.8049C3.55756 12.611 3.6528 12.4328 3.79265 12.2929C3.9325 12.1531 4.11068 12.0578 4.30467 12.0192C4.49865 11.9807 4.69971 12.0005 4.88244 12.0761C5.06517 12.1518 5.22134 12.28 5.33123 12.4445C5.44111 12.6089 5.49976 12.8022 5.49976 13C5.49936 13.2651 5.39387 13.5192 5.20642 13.7067C5.01897 13.8941 4.76485 13.9996 4.49976 14ZM11.4998 14C11.302 14 11.1086 13.9414 10.9442 13.8315C10.7797 13.7216 10.6516 13.5654 10.5759 13.3827C10.5002 13.2 10.4804 12.9989 10.519 12.8049C10.5576 12.611 10.6528 12.4328 10.7926 12.2929C10.9325 12.1531 11.1107 12.0578 11.3047 12.0192C11.4986 11.9807 11.6997 12.0005 11.8824 12.0761C12.0652 12.1518 12.2213 12.28 12.3312 12.4445C12.4411 12.6089 12.4998 12.8022 12.4998 13C12.4994 13.2651 12.3939 13.5192 12.2064 13.7067C12.019 13.8941 11.7649 13.9996 11.4998 14ZM13.9998 12.5H13.4288C13.32 12.0709 13.0712 11.6903 12.7219 11.4184C12.3725 11.1466 11.9424 10.999 11.4998 10.999C11.0571 10.999 10.627 11.1466 10.2776 11.4184C9.92827 11.6903 9.67952 12.0709 9.57076 12.5H6.42876C6.31999 12.0709 6.07124 11.6903 5.72187 11.4184C5.37249 11.1466 4.94244 10.999 4.49976 10.999C4.05707 10.999 3.62702 11.1466 3.27764 11.4184C2.92827 11.6903 2.67952 12.0709 2.57076 12.5H1.99976V9.05353C1.99976 8.75248 2.09036 8.45839 2.25976 8.20953L3.61526 6.21903C3.66109 6.15157 3.72273 6.09634 3.79481 6.05817C3.86688 6.02 3.9472 6.00004 4.02876 6.00003H8.02676C8.09951 6.00004 8.17138 6.01593 8.23736 6.04659C8.30334 6.07724 8.36183 6.12193 8.40876 6.17753L10.1088 8.31152C10.1666 8.3841 10.2434 8.43915 10.3308 8.47053L13.9998 9.78903V12.5ZM12.2773 3.00003C12.2773 2.73481 12.3826 2.48046 12.5701 2.29292C12.7577 2.10538 13.012 2.00003 13.2773 2.00003H14.9998C14.8029 1.65639 14.5078 1.37939 14.1524 1.20456C13.7971 1.02972 13.3976 0.965019 13.0052 1.01874C12.6128 1.07246 12.2454 1.24217 11.9501 1.50608C11.6548 1.77 11.445 2.11611 11.3478 2.50003H7.99976V3.50003H11.3478C11.445 3.88394 11.6548 4.23005 11.9501 4.49397C12.2454 4.75789 12.6128 4.92759 13.0052 4.98131C13.3976 5.03503 13.7971 4.97033 14.1524 4.79549C14.5078 4.62066 14.8029 4.34366 14.9998 4.00003H13.2773C13.012 4.00003 12.7577 3.89467 12.5701 3.70713C12.3826 3.5196 12.2773 3.26524 12.2773 3.00003Z"
                                                        fill="#386BF6" />
                                                </svg> {{ __('Report') }}</span>

                                            <span class="badge d-flex align-items-center gap-2"> <i
                                                    class="fa fa-user"></i>
                                                {{ __("Bids") }} <strong>{{ $commit->auction->commitAuctions->count() }}</strong>
                                            </span>
                                            <span class="badge d-flex gap-2 align-items-center"> <svg
                                                    xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                    viewBox="0 0 16 16" fill="none">
                                                    <path
                                                        d="M1.33301 12.6667C1.33301 13.8 2.19967 14.6667 3.33301 14.6667H12.6663C13.7997 14.6667 14.6663 13.8 14.6663 12.6667V7.33337H1.33301V12.6667ZM12.6663 2.66671H11.333V2.00004C11.333 1.60004 11.0663 1.33337 10.6663 1.33337C10.2663 1.33337 9.99967 1.60004 9.99967 2.00004V2.66671H5.99967V2.00004C5.99967 1.60004 5.73301 1.33337 5.33301 1.33337C4.93301 1.33337 4.66634 1.60004 4.66634 2.00004V2.66671H3.33301C2.19967 2.66671 1.33301 3.53337 1.33301 4.66671V6.00004H14.6663V4.66671C14.6663 3.53337 13.7997 2.66671 12.6663 2.66671Z"
                                                        fill="#9DB2CE" />
                                                </svg> {{ __('Week') }}
                                                {{ ceil(\Carbon\Carbon::parse($commit->auction->created_at)->diffInDays(\Carbon\Carbon::now()) / 7) }}
                                            </span>
                                        </div>
                                        @if ($commit->auction->status == 'pending')
                                            <span class="mt-3 d-block span-title"><svg xmlns="http://www.w3.org/2000/svg"
                                                    width="21" height="20" viewBox="0 0 21 20" fill="none">
                                                    <path
                                                        d="M10.6668 1.66663C15.2693 1.66663 19.0002 5.39746 19.0002 9.99996C19.0002 14.6025 15.2693 18.3333 10.6668 18.3333C6.06433 18.3333 2.3335 14.6025 2.3335 9.99996C2.3335 5.39746 6.06433 1.66663 10.6668 1.66663ZM10.6668 3.33329C8.89872 3.33329 7.20303 4.03567 5.95278 5.28591C4.70254 6.53616 4.00016 8.23185 4.00016 9.99996C4.00016 11.7681 4.70254 13.4638 5.95278 14.714C7.20303 15.9642 8.89872 16.6666 10.6668 16.6666C12.4349 16.6666 14.1306 15.9642 15.3809 14.714C16.6311 13.4638 17.3335 11.7681 17.3335 9.99996C17.3335 8.23185 16.6311 6.53616 15.3809 5.28591C14.1306 4.03567 12.4349 3.33329 10.6668 3.33329ZM10.6668 4.99996C10.8709 4.99999 11.0679 5.07492 11.2205 5.21056C11.373 5.34619 11.4704 5.53308 11.4943 5.73579L11.5002 5.83329V9.65496L13.756 11.9108C13.9055 12.0608 13.9922 12.262 13.9987 12.4736C14.0051 12.6852 13.9308 12.8914 13.7908 13.0502C13.6508 13.209 13.4555 13.3085 13.2448 13.3286C13.034 13.3487 12.8235 13.2878 12.656 13.1583L12.5777 13.0891L10.0777 10.5891C9.94815 10.4595 9.86496 10.2908 9.841 10.1091L9.8335 9.99996V5.83329C9.8335 5.61228 9.92129 5.40032 10.0776 5.24404C10.2339 5.08776 10.4458 4.99996 10.6668 4.99996Z"
                                                        fill="#FFCC00" />
                                                </svg> {{ __('Under Review') }}</span>
                                            <a href="{{ route('web.aution_details', $commit->auction->id) }}"
                                                class="btn mazad-btn w-100 mt-3"> <svg xmlns="http://www.w3.org/2000/svg"
                                                    width="21" height="20" viewBox="0 0 21 20" fill="none">
                                                    <g clip-path="url(#clip0_246_3877)">
                                                        <path
                                                            d="M8.85376 17.4163H8.42497V16.4343C8.42497 15.8588 7.95849 15.3921 7.38243 15.3921H2.84716C2.27138 15.3921 1.80458 15.8588 1.80458 16.4343V17.4163H1.37583C0.800361 17.4163 0.333252 17.8831 0.333252 18.4592V19.6233H9.8963V18.4592C9.8963 17.8831 9.42985 17.4163 8.85376 17.4163Z"
                                                            fill="white" />
                                                        <path
                                                            d="M19.7456 13.0472L12.2657 8.01344L12.6625 7.42383C12.9734 6.96176 13.0265 6.40203 12.8547 5.91449C13.5059 5.01988 14.0801 5.6673 14.5246 4.82168C14.9803 3.95437 14.4228 3.15902 12.2733 1.71254C10.1238 0.265975 9.17702 0.0489048 8.54561 0.797772C7.94784 1.50613 8.69765 1.79887 8.21046 2.67367C7.63468 2.64262 7.05733 2.90648 6.7121 3.41941L4.34929 6.93062C4.00784 7.43797 3.97737 8.06305 4.21421 8.58133C3.62491 9.20203 3.10476 8.71203 2.69448 9.4923C2.23901 10.3593 2.79628 11.1546 4.94577 12.6011C7.0953 14.0477 8.04206 14.2644 8.67374 13.5159C9.2621 12.8182 8.54433 12.5245 8.98663 11.6805C9.49831 11.6525 9.99147 11.393 10.2996 10.935L10.7803 10.2211L18.2598 15.2548C18.8694 15.6651 19.6962 15.5033 20.1065 14.8939C20.5167 14.2842 20.355 13.4575 19.7456 13.0472Z"
                                                            fill="white" />
                                                    </g>
                                                    <defs>
                                                        <clipPath id="clip0_246_3877">
                                                            <rect width="20" height="20" fill="white"
                                                                transform="translate(0.333252)" />
                                                        </clipPath>
                                                    </defs>
                                                </svg> {{ __('Bidding') }}</a>
                                        @elseif($commit->auction->winner_id == auth()->user()->id)
                                        <div class="auction-winner p-3 border rounded shadow-sm bg-light">
                                            <span class="badge d-flex gap-2 align-items-center badge-winner text-success">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                                    <g clip-path="url(#clip0_275_2199)">
                                                        <path d="M6.81616 13.9331H6.47313V13.1475C6.47313 12.6871 6.09994 12.3137 5.6391 12.3137H2.01088C1.55026 12.3137 1.17682 12.6871 1.17682 13.1475V13.9331H0.833818C0.373443 13.9331 -0.000244141 14.3065 -0.000244141 14.7674V15.6987H7.65019V14.7674C7.65019 14.3065 7.27704 13.9331 6.81616 13.9331Z" fill="#34C759"/>
                                                        <path d="M13.8564 5.894L6.64407 5.81854L6.64997 5.25005C6.65464 4.8045 6.44402 4.40707 6.11484 4.15677C6.15669 3.27255 6.82513 3.45277 6.75036 2.69219C6.67364 1.91214 5.95131 1.62572 3.87869 1.60409C1.80607 1.5824 1.07787 1.85361 0.985148 2.63172C0.897089 3.36798 1.52692 3.23395 1.58596 4.03282C1.18749 4.26523 0.917644 4.69543 0.912439 5.19004L0.877113 8.57561C0.871985 9.06482 1.12646 9.49598 1.51263 9.73823C1.39169 10.4122 0.828606 10.3134 0.89748 11.0153C0.974261 11.795 1.69641 12.0815 3.76901 12.1032C5.84166 12.1248 6.5697 11.8534 6.66275 11.0754C6.74922 10.3504 6.14037 10.4697 6.06487 9.71113C6.39455 9.46746 6.61007 9.07722 6.61465 8.63562L6.62194 7.94712L13.8341 8.02276C14.4219 8.02886 14.9034 7.55722 14.9096 6.96955C14.9157 6.38168 14.4441 5.90025 13.8564 5.894Z" fill="#34C759"/>
                                                    </g>
                                                    <defs>
                                                        <clipPath id="clip0_275_2199">
                                                            <rect width="16" height="16" fill="white" transform="translate(-0.000244141)"/>
                                                        </clipPath>
                                                    </defs>
                                                </svg>
                                                {{ __('You Won The Auction') }}
                                            </span>

                                            <span class="mt-3 d-block fw-bold text-dark">
                                                {{ __('Please Contact The Car Owner Via Phone') }}
                                                <span class="text-primary">{{ $commit->auction->car->user->phone }}</span>
                                                {{ __('To Schedule Car Pickup') }}
                                            </span>


                                            <p class="mb-2 mt-2">
                                                <span class="fw-bold text-dark">{{ __('Required Documents:') }}</span> {{ __('National ID And Cash Amount') }}
                                            </p>

                                            {{-- <button class="btn btn-success w-100 mt-3 d-flex align-items-center justify-content-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="21" height="20" viewBox="0 0 21 20" fill="none" class="me-2">
                                                    <path d="M11.8883 8.77998L10.5458 7.54998C10.1787 7.21301 9.92072 6.77402 9.8049 6.28937C9.68908 5.80472 9.72074 5.29651 9.89581 4.82998L10.4683 3.30123C10.6822 2.7305 11.1056 2.26279 11.6523 1.99338C12.1991 1.72397 12.8279 1.67314 13.4108 1.85123C15.5558 2.50748 17.2046 4.50123 16.6971 6.86873C16.3633 8.42623 15.7246 10.3812 14.5146 12.4612C13.3021 14.5462 11.9171 16.0862 10.7296 17.1687C8.93706 18.8 6.37456 18.3925 4.72581 16.855C4.28411 16.4427 4.01613 15.8777 3.97642 15.2748C3.93671 14.6719 4.12825 14.0766 4.51206 13.61L5.56206 12.335C5.87874 11.9494 6.30355 11.6674 6.78183 11.5253C7.2601 11.3832 7.76996 11.3874 8.24581 11.5375L9.98081 12.0837C10.4291 11.6216 10.8218 11.1085 11.1508 10.555C11.4683 9.99525 11.716 9.39872 11.8883 8.77873" fill="white"/>
                                                </svg>
                                                اتصل بنا
                                            </button> --}}
                                        </div>

                        @endif
                    </div>
                </div>
            </div>
            @endforeach
            </div>

 <div style="padding:5px;direction: ltr;">
                                {!! $commit_auctions->withQueryString()->links('pagination::bootstrap-5') !!}
                            </div>

        </div>

        </div>
        </div>
    </section>
@endsection
