@extends('admin.layout')
@section('title', __('Withdraw Money'))
@section('content')
    <main class="main-wrapper">
        <div class="main-content">
            <div class="row mb-5">
                <div class="col-12">
                    <div class="card shadow-lg rounded-4">
                        <div
                            class="card-header d-flex justify-content-between align-items-center bg-primary text-white rounded-top-4">
                            <h5 class="mb-0">{{ __('Withdraw Money Details') }}</h5>
                            <a href="{{ route('Admin.withdraw_money.edit', $withdraw_money->id) }}" class="btn btn-warning btn-sm">
                                <i class="bi bi-pencil-square"></i> {{ __('Edit') }}
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="row g-4">

                                <div class="col-md-6">
                                    <label class="fw-semibold">{{ __('Name') }}</label>
                                    <div class="border rounded-3 p-2 bg-light">{{ $withdraw_money->user->name ?? '-' }}
                                    </div>
                                </div>



                                <div class="col-md-6">
                                    <label class="fw-semibold">{{ __('phone') }}</label>
                                    <div class="border rounded-3 p-2 bg-light">{{ $withdraw_money->phone }}</div>
                                </div>

                                <div class="col-12">
                                    <label class="fw-semibold">{{ __('money') }}</label>
                                    <div class="border rounded-3 p-3 bg-light">{{ $withdraw_money->money }}</div>
                                </div>

                                <div class="col-md-6 text-center">
                                    <label class="fw-semibold">{{ __('Image') }}</label>
                                    @if ($withdraw_money->image)
                                        <img src="{{ asset($withdraw_money->image) }}" alt="Image License"
                                            class="img-fluid rounded-3 shadow" style="max-height: 200px;">
                                    @else
                                        <p class="text-muted">-</p>
                                    @endif
                                </div>

                                <div class="col-md-6">
                                    <label class="fw-semibold">{{ __('Status') }}</label>
                                    <div class="border rounded-3 p-2 bg-light">{{ ucfirst($withdraw_money->status) ?? '-' }}</div>
                                </div>


                            </div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <a href="{{ route('Admin.withdraw_money.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left-circle"></i> {{ __('Back') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
