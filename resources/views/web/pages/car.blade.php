@extends('web.layouts.app')
@section('contact')
    <section class="add-car-section py-5">
        <div class="container">
            <div class="addCar-details-header text-right">
                <span class="fs-5">{{ __('Add Car') }}</span>
            </div>
            <hr />
            <div class="row mt-5">
                <div class="col-12 mx-auto">
                    <div class="progress mb-4" style="height: 8px;">
                        <div class="progress-bar prog-parent" role="progressbar" style=" height: 8px;" id="progressBar">
                        </div>
                    </div>
                    <form id="carForm" method="post" action="{{ route('web.cars') }}" enctype="multipart/form-data"
                        class="add-car-form">
                        @csrf
                        <div class="row form-step active my-5" id="step1">
                            <div class="col-12 col-lg-4 mb-3">
                                <label class="form-label">{{ __('Car Model') }}</label>
                                <input type="text" name="name" id="carName" class="form-control"
                                    placeholder="{{ __('Example: Mercedes C200') }}">
                            </div>
                            <div class="col-12 col-lg-4 mb-3">
                                <label class="form-label">{{ __('Car Name') }}</label>
                                <select name="car_type_id" id="carType" class="form-select">
                                    @foreach ($types as $type)
                                        <option value="{{ $type->id }}">{{ $type->{'name_' . app()->getLocale()} }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-12 col-lg-4 mb-3">
                                <label class="form-label">{{ __('Country') }}</label>
                                <select name="country_id" id="carCountry" class="form-select">
                                    @foreach ($countries as $country)
                                        <option value="{{ $country->id }}">{{ $country->{'name_' . app()->getLocale()} }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            @php
                                $currentYear = date('Y');
                            @endphp
                            <div class="col-12 col-lg-4 mb-3">
                                <label class="form-label">{{ __('Manufacturing year') }}</label>
                                <select name="model" id="carModel" class="form-select">
                                    @for ($year = $currentYear; $year >= 1980; $year--)
                                        <option value="{{ $year }}">{{ $year }}</option>
                                    @endfor
                                </select>
                            </div>
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

                            @endphp
                            <div class="col-12 col-lg-4 mb-3">
                                <label class="form-label">{{ __('Color') }}</label>
                                <select name="color" id="carColor" class="form-select">
                                    @foreach ($colors as $color)
                                        <option value="{{ $color }}">{{ $color }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12 col-lg-4 mb-3">
                                <label class="form-label">{{ __('Kilometer') }}</label>
                                <div
                                    class="km-input px-2 py-0 mb-2 d-flex align-items-center justify-content-between form-control">
                                    <input type="number" name="kilometer" id="carKilometer" class="form-control border-0"
                                        placeholder="350">
                                    <span>{{ __('km') }}</span>
                                </div>
                            </div>

                            <div class="col-12 col-lg-4 mb-3">
                                <label class="form-label">{{ __('Sale Price') }}</label>
                                <input type="number" name="price" id="carPrice" class="form-control"
                                    placeholder="2,0000,000">
                            </div>

                            {{-- <div class="col-12 col-lg-4 mb-3">
                                <label class="form-label">{{ __('License') }}</label>
                                <select name="license_year" id="carLicense" class="form-select">
                                    @for ($year = $currentYear; $year >= 1980; $year--)
                                        <option value="{{ $year }}">{{ $year }}</option>
                                    @endfor
                                </select>
                            </div> --}}

                            <div class="col-12 col-lg-4 mb-3">
                                <label class="form-label">{{ __('License') }}</label>
                                @php
                                    $endYear = max($currentYear, 2035);
                                @endphp
                                <select name="license_year" id="carLicense" class="form-select">
                                    <option value="">{{ __('Select Year') }}</option>
                                    @for ($year = $endYear; $year >= 1980; $year--)
                                        <option value="{{ $year }}">{{ $year }}</option>
                                    @endfor
                                </select>
                            </div>


                            <div class="col-12 mb-3">
                                <label class="form-label">{{ __('Description') }}</label>
                                <textarea name="description" id="carDescription" class="form-control" placeholder="{{ __('Write here...') }}"></textarea>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label">{{ __('Notes') }}</label>
                                <textarea name="notes" id="carNotes" class="form-control" placeholder="{{ __('Write here...') }}"></textarea>
                            </div>
                            <div class="col-12">
                                <button type="button" class="btn btn-primary px-4 next">{{ __('Next') }}</button>
                            </div>
                        </div>
                        <div class="row form-step my-5" id="step2">
                            <h1 class="fs-6 mb-4">{{ __('Add Car Image') }}</h1>
                            <div class="col-12 col-lg-3 mb-3">
                                <div class="upload-card text-center p-5">
                                    <input type="file" name="images[]" id="fileUpload1" class="d-none"
                                        onchange="previewImage(event, 'fileUpload1')" />
                                    <label for="fileUpload1" id="upload-label-1"
                                        class="upload-icon bg-dark text-white rounded-circle p-3 mx-auto"
                                        style="display: flex; align-items: center; justify-content: center; width: 100px; height: 100px; background-size: cover; background-position: center;">
                                        <svg id="upload-icon-1" xmlns="http://www.w3.org/2000/svg" width="24"
                                            height="25" viewBox="0 0 24 25" fill="none">
                                            <g clip-path="url(#clip0_393_4316)">
                                                <path
                                                    d="M23 4.5V6.5H20V9.5H18V6.5H15V4.5H18V1.5H20V4.5H23ZM14.5 11.5C15.328 11.5 16 10.828 16 10C16 9.172 15.328 8.5 14.5 8.5C13.672 8.5 13 9.172 13 10C13 10.828 13.672 11.5 14.5 11.5ZM18 14.734L17.487 14.164C16.693 13.279 15.307 13.279 14.511 14.164L13.856 14.894L9 9.5L6 12.833V6.5H13V4.5H6C4.895 4.5 4 5.395 4 6.5V18.5C4 19.605 4.895 20.5 6 20.5H18C19.105 20.5 20 19.605 20 18.5V11.5H18V14.734Z"
                                                    fill="#386BF6" />
                                            </g>
                                            <defs>
                                                <clipPath id="clip0_393_4316">
                                                    <rect width="24" height="24" fill="white"
                                                        transform="translate(0 0.5)" />
                                                </clipPath>
                                            </defs>
                                        </svg>
                                    </label>

                                    <p class="mt-3">{{ __('Right Interior Image') }}</p>

                                    <div class="progress-container">
                                        <div class="progress mt-2">
                                            <div class="progress-bar bg-primary" id="progress-bar-1" style="width: 0%;">
                                            </div>
                                        </div>
                                        <span class="progress-text" id="progress-text-1">0%</span>
                                    </div>
                                </div>
                            </div>


                            <div class="col-12 col-lg-3 mb-3">
                                <div class="upload-card text-center p-5">
                                    <input type="file" name="images[]" id="fileUpload2" class="d-none"
                                        onchange="previewImage(event, 'fileUpload2')" />
                                    <label for="fileUpload2" id="upload-label-2"
                                        class="upload-icon bg-dark text-white rounded-circle p-3 mx-auto"
                                        style="display: flex; align-items: center; justify-content: center; width: 100px; height: 100px; background-size: cover; background-position: center;">
                                        <svg id="upload-icon-2" xmlns="http://www.w3.org/2000/svg" width="24"
                                            height="25" viewBox="0 0 24 25" fill="none">
                                            <g clip-path="url(#clip0_393_4316)">
                                                <path
                                                    d="M23 4.5V6.5H20V9.5H18V6.5H15V4.5H18V1.5H20V4.5H23ZM14.5 11.5C15.328 11.5 16 10.828 16 10C16 9.172 15.328 8.5 14.5 8.5C13.672 8.5 13 9.172 13 10C13 10.828 13.672 11.5 14.5 11.5ZM18 14.734L17.487 14.164C16.693 13.279 15.307 13.279 14.511 14.164L13.856 14.894L9 9.5L6 12.833V6.5H13V4.5H6C4.895 4.5 4 5.395 4 6.5V18.5C4 19.605 4.895 20.5 6 20.5H18C19.105 20.5 20 19.605 20 18.5V11.5H18V14.734Z"
                                                    fill="#386BF6" />
                                            </g>
                                            <defs>
                                                <clipPath id="clip0_393_4316">
                                                    <rect width="24" height="24" fill="white"
                                                        transform="translate(0 0.5)" />
                                                </clipPath>
                                            </defs>
                                        </svg>
                                    </label>

                                    <p class="mt-3">{{ __('Right Exterior Image') }}</p>

                                    <div class="progress-container">
                                        <div class="progress mt-2">
                                            <div class="progress-bar bg-primary" id="progress-bar-2" style="width: 0%;">
                                            </div>
                                        </div>
                                        <span class="progress-text" id="progress-text-2">0%</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-lg-3 mb-3">
                                <div class="upload-card text-center p-5">
                                    <input type="file" name="images[]" id="fileUpload3" class="d-none"
                                        onchange="previewImage(event, 'fileUpload3')" />
                                    <label for="fileUpload3" id="upload-label-3"
                                        class="upload-icon bg-dark text-white rounded-circle p-3 mx-auto"
                                        style="display: flex; align-items: center; justify-content: center; width: 100px; height: 100px; background-size: cover; background-position: center;">
                                        <svg id="upload-icon-3" xmlns="http://www.w3.org/2000/svg" width="24"
                                            height="25" viewBox="0 0 24 25" fill="none">
                                            <g clip-path="url(#clip0_393_4316)">
                                                <path
                                                    d="M23 4.5V6.5H20V9.5H18V6.5H15V4.5H18V1.5H20V4.5H23ZM14.5 11.5C15.328 11.5 16 10.828 16 10C16 9.172 15.328 8.5 14.5 8.5C13.672 8.5 13 9.172 13 10C13 10.828 13.672 11.5 14.5 11.5ZM18 14.734L17.487 14.164C16.693 13.279 15.307 13.279 14.511 14.164L13.856 14.894L9 9.5L6 12.833V6.5H13V4.5H6C4.895 4.5 4 5.395 4 6.5V18.5C4 19.605 4.895 20.5 6 20.5H18C19.105 20.5 20 19.605 20 18.5V11.5H18V14.734Z"
                                                    fill="#386BF6" />
                                            </g>
                                            <defs>
                                                <clipPath id="clip0_393_4316">
                                                    <rect width="24" height="24" fill="white"
                                                        transform="translate(0 0.5)" />
                                                </clipPath>
                                            </defs>
                                        </svg>
                                    </label>

                                    <p class="mt-3">{{ __('Left Interior Image') }}</p>

                                    <div class="progress-container">
                                        <div class="progress mt-2">
                                            <div class="progress-bar bg-primary" id="progress-bar-3" style="width: 0%;">
                                            </div>
                                        </div>
                                        <span class="progress-text" id="progress-text-3">0%</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-lg-3 mb-3">
                                <div class="upload-card text-center p-5">
                                    <input type="file" name="images[]" id="fileUpload4" class="d-none"
                                        onchange="previewImage(event, 'fileUpload4')" />
                                    <label for="fileUpload4" id="upload-label-4"
                                        class="upload-icon bg-dark text-white rounded-circle p-3 mx-auto"
                                        style="display: flex; align-items: center; justify-content: center; width: 100px; height: 100px; background-size: cover; background-position: center;">
                                        <svg id="upload-icon-4" xmlns="http://www.w3.org/2000/svg" width="24"
                                            height="25" viewBox="0 0 24 25" fill="none">
                                            <g clip-path="url(#clip0_393_4316)">
                                                <path
                                                    d="M23 4.5V6.5H20V9.5H18V6.5H15V4.5H18V1.5H20V4.5H23ZM14.5 11.5C15.328 11.5 16 10.828 16 10C16 9.172 15.328 8.5 14.5 8.5C13.672 8.5 13 9.172 13 10C13 10.828 13.672 11.5 14.5 11.5ZM18 14.734L17.487 14.164C16.693 13.279 15.307 13.279 14.511 14.164L13.856 14.894L9 9.5L6 12.833V6.5H13V4.5H6C4.895 4.5 4 5.395 4 6.5V18.5C4 19.605 4.895 20.5 6 20.5H18C19.105 20.5 20 19.605 20 18.5V11.5H18V14.734Z"
                                                    fill="#386BF6" />
                                            </g>
                                            <defs>
                                                <clipPath id="clip0_393_4316">
                                                    <rect width="24" height="24" fill="white"
                                                        transform="translate(0 0.5)" />
                                                </clipPath>
                                            </defs>
                                        </svg>
                                    </label>

                                    <p class="mt-3">{{ __('Left Exterior Image') }}</p>

                                    <div class="progress-container">
                                        <div class="progress mt-2">
                                            <div class="progress-bar bg-primary" id="progress-bar-4" style="width: 0%;">
                                            </div>
                                        </div>
                                        <span class="progress-text" id="progress-text-4">0%</span>
                                    </div>
                                </div>
                            </div>

                            {{-- new --}}

                            <div class="col-12 col-lg-3 mb-3">
                                <div class="upload-card text-center p-5">
                                    <input type="file" name="images[]" id="fileUpload8" class="d-none"
                                        onchange="previewImage(event, 'fileUpload8')" />
                                    <label for="fileUpload8" id="upload-label-8"
                                        class="upload-icon bg-dark text-white rounded-circle p-3 mx-auto"
                                        style="display: flex; align-items: center; justify-content: center; width: 100px; height: 100px; background-size: cover; background-position: center;">
                                        <svg id="upload-icon-8" xmlns="http://www.w3.org/2000/svg" width="24"
                                            height="25" viewBox="0 0 24 25" fill="none">
                                            <g clip-path="url(#clip0_393_4316)">
                                                <path
                                                    d="M23 4.5V6.5H20V9.5H18V6.5H15V4.5H18V1.5H20V4.5H23ZM14.5 11.5C15.328 11.5 16 10.828 16 10C16 9.172 15.328 8.5 14.5 8.5C13.672 8.5 13 9.172 13 10C13 10.828 13.672 11.5 14.5 11.5ZM18 14.734L17.487 14.164C16.693 13.279 15.307 13.279 14.511 14.164L13.856 14.894L9 9.5L6 12.833V6.5H13V4.5H6C4.895 4.5 4 5.395 4 6.5V18.5C4 19.605 4.895 20.5 6 20.5H18C19.105 20.5 20 19.605 20 18.5V11.5H18V14.734Z"
                                                    fill="#386BF6" />
                                            </g>
                                            <defs>
                                                <clipPath id="clip0_393_4316">
                                                    <rect width="24" height="24" fill="white"
                                                        transform="translate(0 0.5)" />
                                                </clipPath>
                                            </defs>
                                        </svg>
                                    </label>

                                    <p class="mt-3">{{ __('Front image car') }}</p>

                                    <div class="progress-container">
                                        <div class="progress mt-2">
                                            <div class="progress-bar bg-primary" id="progress-bar-8" style="width: 0%;">
                                            </div>
                                        </div>
                                        <span class="progress-text" id="progress-text-8">0%</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-lg-3 mb-3">
                                <div class="upload-card text-center p-5">
                                    <input type="file" name="images[]" id="fileUpload9" class="d-none"
                                        onchange="previewImage(event, 'fileUpload9')" />
                                    <label for="fileUpload9" id="upload-label-9"
                                        class="upload-icon bg-dark text-white rounded-circle p-3 mx-auto"
                                        style="display: flex; align-items: center; justify-content: center; width: 100px; height: 100px; background-size: cover; background-position: center;">
                                        <svg id="upload-icon-9" xmlns="http://www.w3.org/2000/svg" width="24"
                                            height="25" viewBox="0 0 24 25" fill="none">
                                            <g clip-path="url(#clip0_393_4316)">
                                                <path
                                                    d="M23 4.5V6.5H20V9.5H18V6.5H15V4.5H18V1.5H20V4.5H23ZM14.5 11.5C15.328 11.5 16 10.828 16 10C16 9.172 15.328 8.5 14.5 8.5C13.672 8.5 13 9.172 13 10C13 10.828 13.672 11.5 14.5 11.5ZM18 14.734L17.487 14.164C16.693 13.279 15.307 13.279 14.511 14.164L13.856 14.894L9 9.5L6 12.833V6.5H13V4.5H6C4.895 4.5 4 5.395 4 6.5V18.5C4 19.605 4.895 20.5 6 20.5H18C19.105 20.5 20 19.605 20 18.5V11.5H18V14.734Z"
                                                    fill="#386BF6" />
                                            </g>
                                            <defs>
                                                <clipPath id="clip0_393_4316">
                                                    <rect width="24" height="24" fill="white"
                                                        transform="translate(0 0.5)" />
                                                </clipPath>
                                            </defs>
                                        </svg>
                                    </label>

                                    <p class="mt-3">{{ __('Background image car') }}</p>

                                    <div class="progress-container">
                                        <div class="progress mt-2">
                                            <div class="progress-bar bg-primary" id="progress-bar-9" style="width: 0%;">
                                            </div>
                                        </div>
                                        <span class="progress-text" id="progress-text-9">0%</span>
                                    </div>
                                </div>
                            </div>
                            {{-- --}}

                            <div class="row">
                                <div class="col-12 col-lg-3 mb-3">
                                    <h1 class="fs-6 mb-4">{{ __('Add Car License Image') }}</h1>

                                    <div class="d-flex gap-3">

                                        <div class="upload-card text-center p-5">
                                            <input type="file" name="image_license[]" id="fileUpload5" class="d-none"
                                                onchange="previewImage(event, 'fileUpload5')" />
                                            <label for="fileUpload5" id="upload-label-5"
                                                class="upload-icon bg-dark text-white rounded-circle p-3 mx-auto"
                                                style="display: flex; align-items: center; justify-content: center; width: 100px; height: 100px; background-size: cover; background-position: center;">
                                                <svg id="upload-icon-5" xmlns="http://www.w3.org/2000/svg" width="24"
                                                    height="25" viewBox="0 0 24 25" fill="none">
                                                    <g clip-path="url(#clip0_393_4316)">
                                                        <path
                                                            d="M23 4.5V6.5H20V9.5H18V6.5H15V4.5H18V1.5H20V4.5H23ZM14.5 11.5C15.328 11.5 16 10.828 16 10C16 9.172 15.328 8.5 14.5 8.5C13.672 8.5 13 9.172 13 10C13 10.828 13.672 11.5 14.5 11.5ZM18 14.734L17.487 14.164C16.693 13.279 15.307 13.279 14.511 14.164L13.856 14.894L9 9.5L6 12.833V6.5H13V4.5H6C4.895 4.5 4 5.395 4 6.5V18.5C4 19.605 4.895 20.5 6 20.5H18C19.105 20.5 20 19.605 20 18.5V11.5H18V14.734Z"
                                                            fill="#386BF6" />
                                                    </g>
                                                    <defs>
                                                        <clipPath id="clip0_393_4316">
                                                            <rect width="24" height="24" fill="white"
                                                                transform="translate(0 0.5)" />
                                                        </clipPath>
                                                    </defs>
                                                </svg>
                                            </label>

                                            <p class="mt-3">{{ __('Front license photo') }}</p>

                                            <div class="progress-container">
                                                <div class="progress mt-2">
                                                    <div class="progress-bar bg-primary" id="progress-bar-5"
                                                        style="width: 0%;">
                                                    </div>
                                                </div>
                                                <span class="progress-text" id="progress-text-5">0%</span>
                                            </div>
                                        </div>


                                        <div class="upload-card text-center p-5">
                                            <input type="file" name="image_license[]" id="fileUpload7" class="d-none"
                                                onchange="previewImage(event, 'fileUpload7')" />
                                            <label for="fileUpload7" id="upload-label-7"
                                                class="upload-icon bg-dark text-white rounded-circle p-3 mx-auto"
                                                style="display: flex; align-items: center; justify-content: center; width: 100px; height: 100px; background-size: cover; background-position: center;">
                                                <svg id="upload-icon-7" xmlns="http://www.w3.org/2000/svg" width="24"
                                                    height="25" viewBox="0 0 24 25" fill="none">
                                                    <g clip-path="url(#clip0_393_4316)">
                                                        <path
                                                            d="M23 4.5V6.5H20V9.5H18V6.5H15V4.5H18V1.5H20V4.5H23ZM14.5 11.5C15.328 11.5 16 10.828 16 10C16 9.172 15.328 8.5 14.5 8.5C13.672 8.5 13 9.172 13 10C13 10.828 13.672 11.5 14.5 11.5ZM18 14.734L17.487 14.164C16.693 13.279 15.307 13.279 14.511 14.164L13.856 14.894L9 9.5L6 12.833V6.5H13V4.5H6C4.895 4.5 4 5.395 4 6.5V18.5C4 19.605 4.895 20.5 6 20.5H18C19.105 20.5 20 19.605 20 18.5V11.5H18V14.734Z"
                                                            fill="#386BF6" />
                                                    </g>
                                                    <defs>
                                                        <clipPath id="clip0_393_4316">
                                                            <rect width="24" height="24" fill="white"
                                                                transform="translate(0 0.5)" />
                                                        </clipPath>
                                                    </defs>
                                                </svg>
                                            </label>

                                            <p class="mt-3">{{ __('Rear license photo') }}</p>

                                            <div class="progress-container">
                                                <div class="progress mt-2">
                                                    <div class="progress-bar bg-primary" id="progress-bar-7"
                                                        style="width: 0%;">
                                                    </div>
                                                </div>
                                                <span class="progress-text" id="progress-text-7">0%</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>






                            <div class="d-flex justify-content-between w-100 mt-4">
                                <button type="button" class="btn btn-primary px-4 next">{{ __('Next') }}</button>
                                <button type="button" class="btn btn-secondary px-4 prev">{{ __('Previous') }}</button>


                            </div>
                        </div>

                        <div class="row form-step my-5" id="step3">
                            <div class="col-12">
                                <h1 class="fs-6 mb-2 fw-light">
                                    {{ __('Please visit one of our authorized service centers and have your vehicle reported.') }}
                                </h1>
                                <p class="fw-bold">{{ __('To know the authorized maintenance centers') }}<a
                                        href="{{ route('web.maintenance_center') }}"
                                        class="mx-1">{{ __('Click here') }}</a>
                                </p>
                                <div class="add-car-information d-flex align-items-center gap-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none">
                                        <path
                                            d="M12 17C12.2833 17 12.521 16.904 12.713 16.712C12.905 16.52 13.0007 16.2827 13 16V12C13 11.7167 12.904 11.4793 12.712 11.288C12.52 11.0967 12.2827 11.0007 12 11C11.7173 10.9993 11.48 11.0953 11.288 11.288C11.096 11.4807 11 11.718 11 12V16C11 16.2833 11.096 16.521 11.288 16.713C11.48 16.905 11.7173 17.0007 12 17ZM12 9C12.2833 9 12.521 8.904 12.713 8.712C12.905 8.52 13.0007 8.28267 13 8C12.9993 7.71733 12.9033 7.48 12.712 7.288C12.5207 7.096 12.2833 7 12 7C11.7167 7 11.4793 7.096 11.288 7.288C11.0967 7.48 11.0007 7.71733 11 8C10.9993 8.28267 11.0953 8.52033 11.288 8.713C11.4807 8.90567 11.718 9.00133 12 9ZM12 22C10.6167 22 9.31667 21.7373 8.1 21.212C6.88334 20.6867 5.825 19.9743 4.925 19.075C4.025 18.1757 3.31267 17.1173 2.788 15.9C2.26333 14.6827 2.00067 13.3827 2 12C1.99933 10.6173 2.262 9.31733 2.788 8.1C3.314 6.88267 4.02633 5.82433 4.925 4.925C5.82367 4.02567 6.882 3.31333 8.1 2.788C9.318 2.26267 10.618 2 12 2C13.382 2 14.682 2.26267 15.9 2.788C17.118 3.31333 18.1763 4.02567 19.075 4.925C19.9737 5.82433 20.6863 6.88267 21.213 8.1C21.7397 9.31733 22.002 10.6173 22 12C21.998 13.3827 21.7353 14.6827 21.212 15.9C20.6887 17.1173 19.9763 18.1757 19.075 19.075C18.1737 19.9743 17.1153 20.687 15.9 21.213C14.6847 21.739 13.3847 22.0013 12 22ZM12 20C14.2333 20 16.125 19.225 17.675 17.675C19.225 16.125 20 14.2333 20 12C20 9.76667 19.225 7.875 17.675 6.325C16.125 4.775 14.2333 4 12 4C9.76667 4 7.875 4.775 6.325 6.325C4.775 7.875 4 9.76667 4 12C4 14.2333 4.775 16.125 6.325 17.675C7.875 19.225 9.76667 20 12 20Z"
                                            fill="#FFCC00" />
                                    </svg>
                                    <p class="mb-0">
                                        {{ __('The auction period is 4 weeks after the vehicle is approved for auction.') }}
                                    </p>

                                </div>
                                <div class="add-car-information d-flex align-items-center gap-3 mt-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none">
                                        <path
                                            d="M12 17C12.2833 17 12.521 16.904 12.713 16.712C12.905 16.52 13.0007 16.2827 13 16V12C13 11.7167 12.904 11.4793 12.712 11.288C12.52 11.0967 12.2827 11.0007 12 11C11.7173 10.9993 11.48 11.0953 11.288 11.288C11.096 11.4807 11 11.718 11 12V16C11 16.2833 11.096 16.521 11.288 16.713C11.48 16.905 11.7173 17.0007 12 17ZM12 9C12.2833 9 12.521 8.904 12.713 8.712C12.905 8.52 13.0007 8.28267 13 8C12.9993 7.71733 12.9033 7.48 12.712 7.288C12.5207 7.096 12.2833 7 12 7C11.7167 7 11.4793 7.096 11.288 7.288C11.0967 7.48 11.0007 7.71733 11 8C10.9993 8.28267 11.0953 8.52033 11.288 8.713C11.4807 8.90567 11.718 9.00133 12 9ZM12 22C10.6167 22 9.31667 21.7373 8.1 21.212C6.88334 20.6867 5.825 19.9743 4.925 19.075C4.025 18.1757 3.31267 17.1173 2.788 15.9C2.26333 14.6827 2.00067 13.3827 2 12C1.99933 10.6173 2.262 9.31733 2.788 8.1C3.314 6.88267 4.02633 5.82433 4.925 4.925C5.82367 4.02567 6.882 3.31333 8.1 2.788C9.318 2.26267 10.618 2 12 2C13.382 2 14.682 2.26267 15.9 2.788C17.118 3.31333 18.1763 4.02567 19.075 4.925C19.9737 5.82433 20.6863 6.88267 21.213 8.1C21.7397 9.31733 22.002 10.6173 22 12C21.998 13.3827 21.7353 14.6827 21.212 15.9C20.6887 17.1173 19.9763 18.1757 19.075 19.075C18.1737 19.9743 17.1153 20.687 15.9 21.213C14.6847 21.739 13.3847 22.0013 12 22ZM12 20C14.2333 20 16.125 19.225 17.675 17.675C19.225 16.125 20 14.2333 20 12C20 9.76667 19.225 7.875 17.675 6.325C16.125 4.775 14.2333 4 12 4C9.76667 4 7.875 4.775 6.325 6.325C4.775 7.875 4 9.76667 4 12C4 14.2333 4.775 16.125 6.325 17.675C7.875 19.225 9.76667 20 12 20Z"
                                            fill="#FFCC00" />
                                    </svg>
                                    <p class="mb-0">
                                        {{ __('It is preferable to upload the technical report for a quick sale.') }}
                                    </p>

                                </div>
                            </div>


                            <div class="col-12 col-lg-4 mx-auto my-5">
                                <h1 class="fs-6 mb-4">{{ __('Attach Report') }}</h1>
                                <div class="upload-card text-center p-5">

                                    <input type="file" name="report" id="fileUpload6" class="d-none"
                                        onchange="previewImage(event, 'fileUpload6')" />
                                    <label for="fileUpload6" id="upload-label-6"
                                        class="upload-icon bg-dark text-white rounded-circle p-3 mx-auto">
                                        <svg id="upload-icon-6" xmlns="http://www.w3.org/2000/svg" width="24"
                                            height="25" viewBox="0 0 24 25" fill="none">
                                            <g clip-path="url(#clip0_393_4316)">
                                                <path
                                                    d="M23 4.5V6.5H20V9.5H18V6.5H15V4.5H18V1.5H20V4.5H23ZM14.5 11.5C15.328 11.5 16 10.828 16 10C16 9.172 15.328 8.5 14.5 8.5C13.672 8.5 13 9.172 13 10C13 10.828 13.672 11.5 14.5 11.5ZM18 14.734L17.487 14.164C16.693 13.279 15.307 13.279 14.511 14.164L13.856 14.894L9 9.5L6 12.833V6.5H13V4.5H6C4.895 4.5 4 5.395 4 6.5V18.5C4 19.605 4.895 20.5 6 20.5H18C19.105 20.5 20 19.605 20 18.5V11.5H18V14.734Z"
                                                    fill="#386BF6" />
                                            </g>
                                            <defs>
                                                <clipPath id="clip0_393_4316">
                                                    <rect width="24" height="24" fill="white"
                                                        transform="translate(0 0.5)" />
                                                </clipPath>
                                            </defs>
                                        </svg>
                                    </label>

                                    <p class="mt-3">{{ __('Attach File') }}
                                        {{ __('Allowed Formats') }}</p>
                                    <div class="progress-container">
                                        <div class="progress mt-2">
                                            <div class="progress-bar bg-primary" id="progress-bar-6" style="width: 0%;">
                                            </div>
                                        </div>
                                        <span class="progress-text" id="progress-text-6">0%
                                            {{ __('Upload Progress') }}</span>
                                    </div>
                                </div>


                            </div>

                            {{-- <button class="accordion-button collapsed text-center" type="button"
                                data-bs-toggle="collapse" data-bs-target="#collapseOptions" aria-expanded="false"
                                aria-controls="collapseOptions">
                                <strong>عرض تفاصيل الطلب</strong>
                            </button> --}}



                            <div id="collapseOptions" aria-labelledby="headingOptions" data-bs-parent="#filterAccordion"
                                class="row accordion-collapse collapse toggler-car-details  my-5">
                                <div class="col-12 col-lg-4 mb-3">
                                    <label class="form-label">اسم السيارة</label>
                                    <input type="text" id="displayCarName" class="form-control" value="c200 مرسيدس ">
                                </div>
                                <div class="col-12 col-lg-4 mb-3">
                                    <label class="form-label">نوع السيارة</label>
                                    <input type="text" id="displayCarType" class="form-control" value="c200 مرسيدس ">

                                </div>
                                <div class="col-12 col-lg-4 mb-3">
                                    <label class="form-label">موديل السيارة</label>
                                    <input type="text" id="displayCarModel" class="form-control" value="2024">

                                </div>
                                <div class="col-12 col-lg-4 mb-3">
                                    <label class="form-label">اللون </label>
                                    <input type="text" id="displayCarColor" class="form-control" value="ازرق">

                                </div>
                                <div class="col-12 col-lg-4 mb-3">
                                    <label class="form-label">الكيلو متر</label>
                                    <div
                                        class="km-input px-2 py-0 mb-2 d-flex align-items-center justify-content-between form-control">
                                        <input type="text" id="displayCarKilometer" class="form-control border-0"
                                            value="350 ">
                                        <span>كم </span>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-4 mb-3">
                                    <label class="form-label">السعر المناسب للبيع </label>
                                    <input type="number" id="displayCarPrice" class="form-control" value="2,0000,000">

                                </div>
                                <div class="col-12 col-lg-4 mb-3">
                                    <label class="form-label">الرخصه</label>
                                    <input type="number" id="displayCarLicense" class="form-control" value="2026">


                                </div>
                                <div class="col-12  mb-3">
                                    <label class="form-label">الوصف</label>
                                    <textarea class="form-control " id="displayCarDescription">  هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى، حيث يمكنك أن تولد مثل هذا النص أو العديد من النصوص الأخرى إضافة إلى زيادة عدد الحروف التى يولدها التطبيق  </textarea>

                                </div>

                                <span class="fw-light">صور السياره : </span>
                                <div class="add-car-photos d-flex flex-wrap gap-3 my-2">
                                    <img src="assets/Images/car.png" alt="car photo" />
                                    <img src="assets/Images/car.png" alt="car photo" />
                                    <img src="assets/Images/car.png" alt="car photo" />

                                </div>
                                <span class="fw-light">صور رخصه السياره : </span>
                                <div class="add-car-photos d-flex flex-wrap gap-3 my-2">
                                    <img src="assets/Images/card.png"
                                        alt="License
                                Car  photo" />
                                    <img src="assets/Images/card.png"
                                        alt="License
                                Car photo" />
                                </div>

                            </div>
                            <div class="d-flex justify-content-between w-100 mt-4">
                                <button type="submit" class="btn btn-primary px-4 next">{{ __('To Confirm') }}</button>
                                <button type="button" class="btn btn-secondary px-4 prev">{{ __('Previous') }}</button>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <script>
        function previewImage(event, id) {
            if (event.target.files.length > 0) {
                let src = URL.createObjectURL(event.target.files[0]);
                let uploadLabel = document.getElementById(`upload-label-${id.replace('fileUpload', '')}`);
                let uploadIcon = document.getElementById(`upload-icon-${id.replace('fileUpload', '')}`);
                let progressBar = document.getElementById(`progress-bar-${id.replace('fileUpload', '')}`);
                let progressText = document.getElementById(`progress-text-${id.replace('fileUpload', '')}`);

                uploadLabel.style.backgroundImage = `url(${src})`;
                uploadLabel.style.backgroundSize = "cover";
                uploadLabel.style.backgroundPosition = "center";

                uploadIcon.style.display = "none";

                progressBar.style.width = "100%";
                progressText.innerText = "100%";
            }
        }
    </script>
    <script>
        document.getElementById("carName").addEventListener("input", function() {
            document.getElementById("displayCarName").value = this.value;
        });
        document.getElementById("carType").addEventListener("input", function() {
            document.getElementById("displayCarType").value = this.value;
        });
        document.getElementById("carModel").addEventListener("input", function() {
            document.getElementById("displayCarModel").value = this.value;
        });
        document.getElementById("carColor").addEventListener("input", function() {
            document.getElementById("displayCarColor").value = this.value;
        });
        document.getElementById("carKilometer").addEventListener("input", function() {
            document.getElementById("displayCarKilometer").value = this.value;
        });
        document.getElementById("carPrice").addEventListener("input", function() {
            document.getElementById("displayCarPrice").value = this.value;
        });
        document.getElementById("carLicense").addEventListener("input", function() {
            document.getElementById("displayCarLicense").value = this.value;
        });
        document.getElementById("carDescription").addEventListener("input", function() {
            document.getElementById("displayCarDescription").value = this.value;
        });
    </script>
@endsection
