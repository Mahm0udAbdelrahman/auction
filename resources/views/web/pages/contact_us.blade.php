@extends('web.layouts.app')
@section('contact')
    <section class="login-page">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="login-logo d-flex justify-content-center">
                <img src="{{ asset('web/assets/Images/Group.png')}}" alt="Logo" />
            </div>
          </div>
        </div>
        <div class="row py-2">
          <h1 class="text-center">{{ __('For Complaints and Suggestions') }}</h1>
          <div
            class="col-12 col-lg-6 mx-auto d-flex flex-column align-items-center mt-4"
          >
            <form class="w-100" action="{{ route('web.feddback.store') }}" method="POST">
              @csrf

              <div class="form-group mb-3">
                <span class="input-group-text d-flex gap-3">
                  <i class="fa-solid fa-pen"></i>
                  <input
                    name="address"
                    type="text"
                    placeholder="{{ __('Problem Title') }}"
                    class="py-2 w-100"
                  />
                </span>
                <div class="input-group mt-4">
                    <span class="input-group-text">
                      <i class="fa-solid fa-note-sticky"></i>
                    </span>
                    <textarea
                      name="description"
                      placeholder="{{ __('Problem Description') }}"
                      class="form-control py-2"
                      rows="4"
                    ></textarea>
                  </div>
                  {{-- <div class="input-group mt-4">
                    <span class="input-group-text">
                      <i class="fa-regular fa-lightbulb"></i>
                    </span>
                    <textarea
                      name="suggestion"
                      placeholder="اكتب اقتراحك هنا..."
                      class="form-control py-2"
                      rows="4"
                    ></textarea>
                  </div> --}}


              </div>


             <button class="w-100 my-4 btn-primary border-0 py-3" style="border-radius: 8px" type="submit">
        {{__('Submit')}}
        </button>
            </form>

          </div>
        </div>
      </div>
    </section>

@endsection
