@extends('admin.layout')
@section('title', __('Home'))

@section('content')
    <main class="main-wrapper">
        <div class="main-content">
            <div class="row">

                <div class="col-lg-4 col-md-12 col-sm-12">
                    <div class="card rounded-4">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center gap-3 mb-2">
                                <h5 class="mb-0">
                                    <i class="fa fa-users text-primary"></i> {{ __('Number of Users') }}
                                </h5>
                            </div>
                            <h2 class="mt-4 fw-bold">{{ $user }}</h2>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-12 col-sm-12">
                    <div class="card rounded-4">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center gap-3 mb-2">
                                <h5 class="mb-0">
                                    <i class="fa fa-store text-info"></i> {{ __('Number of Vendors') }}
                                </h5>
                            </div>
                            <h2 class="mt-4 fw-bold">{{ $vendor }}</h2>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-12 col-sm-12">
                    <div class="card rounded-4">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center gap-3 mb-2">
                                <h5 class="mb-0">
                                    <i class="fa fa-briefcase text-warning"></i> {{ __('Number of Buyers') }}
                                </h5>
                            </div>
                            <h2 class="mt-4 fw-bold">{{ $buyer }}</h2>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-12 col-sm-12">
                    <div class="card rounded-4">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center gap-3 mb-2">
                                <h5 class="mb-0">
                                    <i class="fa fa-car text-success"></i> {{ __('Number of Cars') }}
                                </h5>
                            </div>
                            <h2 class="mt-4 fw-bold">{{ $car }}</h2>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-12 col-sm-12">
                    <div class="card rounded-4">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center gap-3 mb-2">
                                <h5 class="mb-0">
                                    <i class="fa fa-gavel text-danger"></i> {{ __('Number of Auctions') }}
                                </h5>
                            </div>
                            <h2 class="mt-4 fw-bold">{{ $auction }}</h2>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-12 col-sm-12">
                    <div class="card rounded-4">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center gap-3 mb-2">
                                <h5 class="mb-0">
                                    <i class="fa fa-trophy text-warning"></i> {{ __('Number of Sold Cars') }}
                                </h5>
                            </div>
                            <h2 class="mt-4 fw-bold">{{ $car_won }}</h2>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-12 col-sm-12">
                    <div class="card rounded-4">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center gap-3 mb-2">
                                <h5 class="mb-0">
                                    <i class="fa fa-hourglass-half text-secondary"></i> {{ __('Number of Unsold Cars') }}
                                </h5>
                            </div>
                            <h2 class="mt-4 fw-bold">{{ $car_pending }}</h2>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-12 col-sm-12">
                    <div class="card rounded-4">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center gap-3 mb-2">
                                <h5 class="mb-0">
                                    <i class="fa fa-tools text-danger"></i> {{ __('Number of Maintenance Centers') }}
                                </h5>
                            </div>
                            <h2 class="mt-4 fw-bold">{{ $maintenance_center }}</h2>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-12 col-sm-12">
                    <div class="card rounded-4">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center gap-3 mb-2">
                                <h5 class="mb-0">
                                    <i class="fa fa-globe text-primary"></i> {{ __('Number of Countries') }}
                                </h5>
                            </div>
                            <h2 class="mt-4 fw-bold">{{ $country }}</h2>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </main>
@endsection
