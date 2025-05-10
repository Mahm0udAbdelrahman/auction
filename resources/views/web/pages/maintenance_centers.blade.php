@extends('web.layouts.app')
@section('contact')
    <!---------------------main--------------------------->
    <section class="login-page choose-service">
        <div class="container">
            <h1 class="text-center">{{ __('Choose a maintenance center') }}</h1>
            <div class="col-lg-12">
                <hr class="my-4" />
                <div class="row my-5 py-2 ">
                    <!-- Card Item -->
                    @foreach ($maintenance_centers as $maintenance_center)
                        <div class="col-md-6 col-xl-4 mb-4">
                            <div class="card border-warning border shadow-sm rounded p-3">
                                <div class="mazad-user-info text-center bg-light p-3 rounded">
                                    <h4 class="fw-bold mb-2">{{ $maintenance_center->{'name_' . app()->getLocale()} }}</h4>
                                    <p class="text-muted mb-2">📍
                                        {{ $maintenance_center->{'address_' . app()->getLocale()} }}</p>
                                    <p class="text-muted mb-0">📞 {{ $maintenance_center->phone }}</p>
                                      <a href="{{ $maintenance_center->location }}" target="_blank" class="btn btn-outline-primary btn-sm">{{ __('Location') }}</a>
                                </div>
                            </div>
                        </div>
                    @endforeach






                </div>
            </div>
        </div>
    </section>
@endsection
