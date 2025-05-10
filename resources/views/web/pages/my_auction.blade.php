@extends('web.layouts.app')
@section('contact')
    <!---------------------main--------------------------->
    <section class="elmazad-page py-3">
        <div class="container mt-4">
            <div class="row">
                <!-- Sidebar (Filters) -->
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
                    <div class="row">
                        <!-- Card Item -->
                        @if ($auctions->isEmpty())
                            <!-- Main Content (Car Cards) -->
                            <h4 class="mb-3">{{ __('Add Car') }}</h4>
                            <hr class="my-4" />
                            <div class="row my-5 py-2 d-flex justify-content-center align-items-center">
                                <div class="text-center">
                                    <a href="{{ route('web.cars_index') }}"
                                        class="btn border-primary border-2 empty-car-btn rounded-circle d-flex justify-content-center align-items-center mx-auto p-0">
                                        +
                                    </a>
                                    <p class="mt-2">{{ __('Add Car') }}</p>
                                </div>
                            </div>
                        @else
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4 class="mb-0">{{ __('Latest Auctions') }}</h4>
                                <a href="{{ route('web.cars_index') }}"
                                    class="btn btn-info btn-sm">{{ __('Add Car') }}</a>
                            </div>
                            <hr class="my-3" />
                            @foreach ($auctions as $auction)
                                <div class="col-md-6 col-xl-4 mb-4">
                                    <div class="card">
                                        <div
                                            class="mazad-user-info d-flex flex-wrap align-items-center justify-content-between mb-4">
                                            <div class="user-img d-flex align-items-center gap-2 mb-3 flex-wrap">
                                                <img src="{{ $auction->user->image }}" alt="user img" />
                                                <div class="user-info">
                                                    <h6 class="fw-bold">{{ $auction->user->name }}</h6>
                                                    <a>{{ __('View Profile') }}</a>
                                                </div>
                                            </div>
                                            <span><svg xmlns="http://www.w3.org/2000/svg" width="17" height="16"
                                                    viewBox="0 0 17 16" fill="none">
                                                    <!-- SVG Path -->
                                                </svg> {{ $auction->created_at->diffForHumans() }}</span>
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
                                                @foreach ($auction->carImages as $image)
                                                    <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                                        <img src="{{ $image->image }}" class="card-img-top"
                                                            alt="Car">
                                                    </div>
                                                @endforeach
                                            </div>
                                            <button class="carousel-control-prev" type="button"
                                                data-bs-target="#carousel3" data-bs-slide="prev">
                                                <span class="carousel-control-prev-icon"></span>
                                            </button>
                                            <button class="carousel-control-next" type="button"
                                                data-bs-target="#carousel3" data-bs-slide="next">
                                                <span class="carousel-control-next-icon"></span>
                                            </button>
                                        </div>

                                        <!-- Card Body -->
                                        <div class="card-body">
                                            <div class="car-info d-flex justify-content-between sidebar-category">
                                                <h6 class="card-title">{{ $auction->name }} </h6>
                                                <p class="price">{{ $auction->price }}</p>
                                            </div>

                                            <!-- Auction Details -->
                                            <div class="auction-details">
                                                <span class="badge d-flex align-items-center gap-2"><svg
                                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 16 16" fill="none">
                                                        <!-- SVG Path -->
                                                    </svg> {{ __('Report') }}</span>

                                                <span class="badge d-flex align-items-center gap-2"> <i
                                                        class="fa fa-user"></i>
                                                    المزايدات <strong>{{ $auction->commitAuctions->count() }}</strong>
                                                </span>
                                                <span class="badge d-flex gap-2 align-items-center"> <svg
                                                        xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                        viewBox="0 0 16 16" fill="none">
                                                        <path
                                                            d="M1.33301 12.6667C1.33301 13.8 2.19967 14.6667 3.33301 14.6667H12.6663C13.7997 14.6667 14.6663 13.8 14.6663 12.6667V7.33337H1.33301V12.6667ZM12.6663 2.66671H11.333V2.00004C11.333 1.60004 11.0663 1.33337 10.6663 1.33337C10.2663 1.33337 9.99967 1.60004 9.99967 2.00004V2.66671H5.99967V2.00004C5.99967 1.60004 5.73301 1.33337 5.33301 1.33337C4.93301 1.33337 4.66634 1.60004 4.66634 2.00004V2.66671H3.33301C2.19967 2.66671 1.33301 3.53337 1.33301 4.66671V6.00004H14.6663V4.66671C14.6663 3.53337 13.7997 2.66671 12.6663 2.66671Z"
                                                            fill="#9DB2CE" />
                                                    </svg> {{ __('Week') }}
                                                    {{ ceil(\Carbon\Carbon::parse($auction->created_at)->diffInDays(\Carbon\Carbon::now()) / 7) }}
                                                </span>
                                            </div>

                                            @if ($auction->sold == 1)
                                                <div class="auction-winner p-3 border rounded shadow-sm bg-light mt-2 ">
                                                    <span
                                                        class="badge d-flex gap-2 align-items-center badge-winner text-success">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                            height="16" viewBox="0 0 16 16" fill="none">
                                                            <!-- SVG Path -->
                                                        </svg>
                                                        {{ __('The auction has been sold') }}
                                                    </span>

                                                    <span class="mt-3 d-block fw-bold text-dark">
                                                        {{ __('Please contact the winner by phone.') }}
                                                        <span class="text-primary">{{ $auction->winner->phone }}</span>
                                                        {{ __('Set a car pickup appointment.') }}
                                                         {{ __('Price') }}
                                                        <span class="text-primary">
    {{ optional($auction->auctions->first())->commitAuctions->first()->price ?? 'N/A' }}
</span>
                                                         
                                                    </span>

                                                    <p class="mb-2 mt-2">
                                                        <span
                                                            class="fw-bold text-dark">{{ __('Required Documents:') }}</span>
                                                        {{ __('National ID And Cash Amount') }}
                                                    </p>
                                                    <a href="{{ route('web.aution_details', $auction->auctions->id ?? '#') }}" 
                                                    class="btn mazad-btn w-100 mt-3">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="21" height="20"
                                                          viewBox="0 0 21 20" fill="none">
                                                             SVG Path
                                                        </svg> {{ __('Auction') }}
                                                </a>    
                                                </div>
                                            @elseif($auction->status == 'pending')
                                                <span class="mt-3 d-block span-title"><svg
                                                        xmlns="http://www.w3.org/2000/svg" width="21" height="20"
                                                        viewBox="0 0 21 20" fill="none">
                                                        <path
                                                            d="M10.6668 1.66663C15.2693 1.66663 19.0002 5.39746 19.0002 9.99996C19.0002 14.6025 15.2693 18.3333 10.6668 18.3333C6.06433 18.3333 2.3335 14.6025 2.3335 9.99996C2.3335 5.39746 6.06433 1.66663 10.6668 1.66663ZM10.6668 3.33329C8.89872 3.33329 7.20303 4.03567 5.95278 5.28591C4.70254 6.53616 4.00016 8.23185 4.00016 9.99996C4.00016 11.7681 4.70254 13.4638 5.95278 14.714C7.20303 15.9642 8.89872 16.6666 10.6668 16.6666C12.4349 16.6666 14.1306 15.9642 15.3809 14.714C16.6311 13.4638 17.3335 11.7681 17.3335 9.99996C17.3335 8.23185 16.6311 6.53616 15.3809 5.28591C14.1306 4.03567 12.4349 3.33329 10.6668 3.33329ZM10.6668 4.99996C10.8709 4.99999 11.0679 5.07492 11.2205 5.21056C11.373 5.34619 11.4704 5.53308 11.4943 5.73579L11.5002 5.83329V9.65496L13.756 11.9108C13.9055 12.0608 13.9922 12.262 13.9987 12.4736C14.0051 12.6852 13.9308 12.8914 13.7908 13.0502C13.6508 13.209 13.4555 13.3085 13.2448 13.3286C13.034 13.3487 12.8235 13.2878 12.656 13.1583L12.5777 13.0891L10.0777 10.5891C9.94815 10.4595 9.86496 10.2908 9.841 10.1091L9.8335 9.99996V5.83329C9.8335 5.61228 9.92129 5.40032 10.0776 5.24404C10.2339 5.08776 10.4458 4.99996 10.6668 4.99996Z"
                                                            fill="#FFCC00" />
                                                    </svg> جاري المراجعة </span>
                                            @elseif($auction->status == 'approved')
                                                <span class="mt-3 d-block span-title">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="21" height="20"
                                                        viewBox="0 0 21 20" fill="none">
                                                        <path
                                                            d="M10.6668 1.66663C15.2693 1.66663 19.0002 5.39746 19.0002 9.99996C19.0002 14.6025 15.2693 18.3333 10.6668 18.3333C6.06433 18.3333 2.3335 14.6025 2.3335 9.99996C2.3335 5.39746 6.06433 1.66663 10.6668 1.66663ZM10.6668 3.33329C8.89872 3.33329 7.20303 4.03567 5.95278 5.28591C4.70254 6.53616 4.00016 8.23185 4.00016 9.99996C4.00016 11.7681 4.70254 13.4638 5.95278 14.714C7.20303 15.9642 8.89872 16.6666 10.6668 16.6666C12.4349 16.6666 14.1306 15.9642 15.3809 14.714C16.6311 13.4638 17.3335 11.7681 17.3335 9.99996C17.3335 8.23185 16.6311 6.53616 15.3809 5.28591C14.1306 4.03567 12.4349 3.33329 10.6668 3.33329ZM10.6668 4.99996C10.8709 4.99999 11.0679 5.07492 11.2205 5.21056C11.373 5.34619 11.4704 5.53308 11.4943 5.73579L11.5002 5.83329V9.65496L13.756 11.9108C13.9055 12.0608 13.9922 12.262 13.9987 12.4736C14.0051 12.6852 13.9308 12.8914 13.7908 13.0502C13.6508 13.209 13.4555 13.3085 13.2448 13.3286C13.034 13.3487 12.8235 13.2878 12.656 13.1583L12.5777 13.0891L10.0777 10.5891C9.94815 10.4595 9.86496 10.2908 9.841 10.1091L9.8335 9.99996V5.83329C9.8335 5.61228 9.92129 5.40032 10.0776 5.24404C10.2339 5.08776 10.4458 4.99996 10.6668 4.99996Z"
                                                            fill="#28a745" />
                                                    </svg>
                                                    تم الموافقة
                                                </span>
                                                <!--<a href="{{ route('web.aution_details', $auction->id) }}"-->
                                                <!--    class="btn mazad-btn w-100 mt-3">-->
                                                <!--    <svg xmlns="http://www.w3.org/2000/svg" width="21" height="20"-->
                                                <!--        viewBox="0 0 21 20" fill="none">-->
                                                <!--        SVG Path-->
                                                <!--    </svg> {{ __('Auction') }}-->
                                                <!--</a>-->
                                                
                                                <a href="{{ route('web.aution_details', $auction->auctions->id ?? '#') }}" 
                                                    class="btn mazad-btn w-100 mt-3">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="21" height="20"
                                                          viewBox="0 0 21 20" fill="none">
                                                             SVG Path
                                                        </svg> {{ __('Auction') }}
                                                </a>    
                                            @endif

                                            <!--<a href="{{ route('web.aution_details', $auction->id) }}" class="btn mazad-btn w-100 mt-3">-->
                                            <!--    <svg xmlns="http://www.w3.org/2000/svg" width="21" height="20" viewBox="0 0 21 20" fill="none">-->
                                            <!--         SVG Path -->
                                            <!--    </svg> {{ __('Auction') }}-->
                                            <!--</a>-->
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <div style="padding:5px;direction: ltr;">
                                {!! $auctions->withQueryString()->links('pagination::bootstrap-5') !!}
                            </div>
                </div>
            </div>
        </div>
    </section>
@endsection
