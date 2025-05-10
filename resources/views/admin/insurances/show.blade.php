@extends('admin.layout')
@section('title', __('Show Car'))
@section('content')
<main class="main-wrapper">
    <div class="main-content">
        <div class="row mb-5">
            <div class="col-12">
                <div class="card shadow-lg rounded-4">
                    <div class="card-header d-flex justify-content-between align-items-center bg-primary text-white rounded-top-4">
                        <h5 class="mb-0">{{ __('Car Details') }}</h5>
                        <a href="{{ route('Admin.insurances.edit', $insurance->id) }}" class="btn btn-warning btn-sm">
                            <i class="bi bi-pencil-square"></i> {{ __('Edit') }}
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="row g-4">
                            <div class="col-md-6">
                                <label class="fw-semibold">{{ __('User') }}</label>
                                <div class="border rounded-3 p-2 bg-light">{{ $insurance->user->name }}</div>
                            </div>
                            <div class="col-md-6">
                                <label class="fw-semibold">{{ __('Balance') }}</label>
                                <div class="border rounded-3 p-2 bg-light">{{ $insurance->balance ?? '-' }}</div>
                            </div>
                            <div class="col-md-6">
                                <label class="fw-semibold">{{ __('Status') }}</label>
                                <div class="border rounded-3 p-2 bg-light">{{ __($insurance->payment_status) }}</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-4">
                    <a href="{{ route('Admin.insurances.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left-circle"></i> {{ __('Back') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
