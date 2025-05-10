

    @extends('web.layouts.app')
    @section('contact')
    <!-------------------------Account section------------------------>

    <section class="account-section py-5">
        <div class="container">
            <div class="account-details-header text-right">
                <span class="fs-5">{{ __('Modify Data') }}</span>
            </div>
            <hr />
            <div class="row mt-5">
                <div class="col-12 mx-auto">
                    <div class="account-body ">
                        <form method="post" action="{{ route('web.updateProfile') }}" class="w-100 mt-4" enctype="multipart/form-data">
                        <div class="account-img mx-auto d-flex justify-content-center align-items-center">

                            <img id="imagePreview" src="{{ asset(Auth::user()->image)}}" alt="wallet image" />
                        </div>

                            @csrf
                        <label class="upload-container text-center mt-3 mx-auto d-block" for="fileUpload">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 16 16"
                                fill="none">
                                <path
                                    d="M12.125 5.125H10.25V4.375H5.5625V5.125H3.6875C3.42228 5.125 3.16793 5.23036 2.98039 5.41789C2.79286 5.60543 2.6875 5.85978 2.6875 6.125V11.3125C2.6875 11.5777 2.79286 11.8321 2.98039 12.0196C3.16793 12.2071 3.42228 12.3125 3.6875 12.3125H12.125C12.3902 12.3125 12.6446 12.2071 12.8321 12.0196C13.0196 11.8321 13.125 11.5777 13.125 11.3125V6.125C13.125 5.85978 13.0196 5.60543 12.8321 5.41789C12.6446 5.23036 12.3902 5.125 12.125 5.125ZM7.906 11.75C6.235 11.75 4.876 10.39 4.876 8.719C4.876 7.048 6.235 5.688 7.906 5.688C9.577 5.688 10.937 7.048 10.937 8.719C10.937 10.39 9.577 11.749 7.906 11.749V11.75ZM7.906 6.6875C7.63919 6.68753 7.37499 6.74012 7.1285 6.84225C6.88201 6.94439 6.65805 7.09407 6.46941 7.28276C6.28077 7.47145 6.13114 7.69545 6.02906 7.94196C5.92699 8.18848 5.87447 8.45269 5.8745 8.7195C5.87453 8.98631 5.92712 9.25051 6.02925 9.497C6.13139 9.74349 6.28107 9.96745 6.46976 10.1561C6.65845 10.3447 6.88245 10.4944 7.12896 10.5964C7.37548 10.6985 7.63969 10.751 7.9065 10.751C8.44542 10.7509 8.96224 10.5368 9.34327 10.1557C9.72429 9.77454 9.93832 9.25767 9.93825 8.71875C9.93818 8.17983 9.72404 7.66301 9.34291 7.28198C8.96179 6.90096 8.44492 6.68693 7.906 6.687V6.6875Z"
                                    fill="black" />
                            </svg>
                            <span class="upload-text">{{ __('Change Image') }}</span>
                            <input type="file" name="image" id="fileUpload" onchange="previewImage(event)">
                            @error('image')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                        </label>
                        <script>
    function previewImage(event) {
        const file = event.target.files[0];
        const reader = new FileReader();

        reader.onload = function(e) {
            const imagePreview = document.getElementById('imagePreview');
            imagePreview.src = e.target.result;
            imagePreview.classList.remove('d-none'); // Show the image preview
        }

        if (file) {
            reader.readAsDataURL(file);
        }
    }
</script>

                            <div class="form-group mb-3">
                                <span class="input-group-text d-flex gap-3">
                                    <i class="fa-solid fa-user fs-5"></i>
                                    <input name="name" placeholder="" value="{{ Auth::user()->name }}" class="py-2 w-100"
                                        type="text" />
                                </span>
                                @error('name')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                            </div>
                            <div class="form-group mb-3">
                                <span class="input-group-text d-flex gap-3">
                                    <i class="fa-solid fa-envelope fs-5"></i>
                                    <input name="email" placeholder="" value="{{ Auth::user()->email }}" class="py-2 w-100"
                                        type="text" />
                                </span>
                                @error('email')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                            </div>
                            <div class="form-group mb-3">
                                <span class="input-group-text d-flex gap-3">
                                    <i class="fa-solid fa-location-dot fs-5"></i>
                                    <input name="country_id" type="text" placeholder="العنوان" value="{{ Auth::user()->country->{'name_' . app()->getLocale()} }}"
                                        class="py-2 w-100" />
                                </span>
                                @error('country_id')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                            </div>

                        <!--    @if(Auth::user()->service == 'vendor')-->
                        <!--    <div class="form-group mb-3">-->
                        <!--        <span class="input-group-text d-flex gap-3">-->
                        <!--            <i class="fa-solid fa-id-card fs-5"></i>-->
                        <!--            <input name="national_number" type="text" placeholder="رقم القومي"-->
                        <!--                value="{{ Auth::user()->national_number }}" class="py-2 w-100" />-->
                        <!--        </span>-->
                        <!--    </div>-->

                        <!--    @endif-->
                        <!--    @error('national_number')-->
                        <!--    <div class="alert alert-danger mt-2">{{ $message }}</div>-->
                        <!--@enderror-->
                            <div class="form-group mb-3">
                                <span class="input-group-text d-flex gap-3">
                                  <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="14"
                                    height="21"
                                    viewBox="0 0 14 21"
                                    fill="none"
                                  >
                                    <path
                                      d="M0.25 3.3C0.25 1.927 1.32 0.75 2.714 0.75H11.286C12.681 0.75 13.75 1.927 13.75 3.3V17.7C13.75 19.073 12.68 20.25 11.286 20.25H2.714C1.319 20.25 0.25 19.073 0.25 17.7V3.3ZM5.5 3.75C5.30109 3.75 5.11032 3.82902 4.96967 3.96967C4.82902 4.11032 4.75 4.30109 4.75 4.5C4.75 4.69891 4.82902 4.88968 4.96967 5.03033C5.11032 5.17098 5.30109 5.25 5.5 5.25H8.5C8.69891 5.25 8.88968 5.17098 9.03033 5.03033C9.17098 4.88968 9.25 4.69891 9.25 4.5C9.25 4.30109 9.17098 4.11032 9.03033 3.96967C8.88968 3.82902 8.69891 3.75 8.5 3.75H5.5Z"
                                      fill="#7B7B7B"
                                    />
                                  </svg>
                                  <input
                                    name="phone"
                                    type="text"
                                    placeholder=""
                                   value="{{ Auth::user()->phone }}"
                                    class="py-2 w-100"
                                  />
                                </span>
                              </div>
                              @error('phone')
                              <div class="alert alert-danger mt-2">{{ $message }}</div>
                          @enderror
                              <div class="form-group mb-3">
                                <span class="input-group-text d-flex gap-3">
                                  <i class="fa-solid fa-lock fs-5"></i>
                                  <input
                                    name="password"
                                    type="password"
                                    placeholder=""
                                  value=""
                                    class="py-2 w-100"
                                  />
                                </span>
                              </div>
                              @error('password')
                              <div class="alert alert-danger mt-2">{{ $message }}</div>
                          @enderror
                              <div class="form-group ">
                                <span class="input-group-text d-flex gap-3">
                                  <i class="fa-solid fa-lock fs-5"></i>
                                  <input
                                    name="password_confirmation"
                                    type="password"
                                    placeholder=""
                                  value=""
                                    class="py-2 w-100"
                                  />
                                </span>
                              </div>
                              @error('password_confirmation')
                              <div class="alert alert-danger mt-2">{{ $message }}</div>
                          @enderror
                              <button class="w-100 mt-4 btn-primary border-0 py-3 fs-6  fw-light"
                              style="border-radius: 8px">{{ __('Save Changes') }}

                          </button>
                        </form>

                    </div>
                </div>

            </div>

        </div>

    </section>
@endsection

