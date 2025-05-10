@extends('web.layouts.app')
@section('contact')
<section class="notification-section py-5">
    <div class="container">
        <div class="notification-details-header text-right">
            <span class="fs-5">{{ __('Notifications') }}</span>
        </div>
        <hr />
        <div class="row mt-3">
            <div class="col-12 mx-auto">
                @if(Auth::check())
                    @forelse(auth()->user()->notifications()->latest()->get() as $notification)
                        @php
                            $isUnread = is_null($notification->read_at); 
                        @endphp
                        <a href="{{ $notification->data['url'] }}?notification_id={{ $notification->id }}" class="text-decoration-none text-dark">
                            <div class="notification-card p-3 rounded {{ $isUnread ? 'bg-primary-subtle text-dark' : 'bg-light text-muted' }}">
                                <div class="notification-header mb-3 flex-wrap d-flex justify-content-between align-items-center">
                                    <span>{{ $notification->data['title_'. app()->getLocale()] }} </span>
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="17" height="16" viewBox="0 0 17 16" fill="none">
                                            <path d="M15.9999 7.99996C15.9999 12.05 12.7167 15.3333 8.66659 15.3333C4.6165 15.3333 1.33325 12.05 1.33325 7.99996C1.33325 3.94987 4.6165 0.666626 8.66659 0.666626C12.7167 0.666626 15.9999 3.94987 15.9999 7.99996ZM2.67114 7.99996C2.67114 11.3112 5.35539 13.9954 8.66659 13.9954C11.9778 13.9954 14.6621 11.3112 14.6621 7.99996C14.6621 4.68877 11.9778 2.00451 8.66659 2.00451C5.35539 2.00451 2.67114 4.68877 2.67114 7.99996Z" fill="#606060" />
                                            <path d="M8.66642 3.33337C8.29822 3.33337 7.99976 3.63185 7.99976 4.00004V8.31117C7.99976 8.31117 7.99976 8.48497 8.08422 8.61571C8.14076 8.72657 8.22889 8.82291 8.34469 8.88977L11.4246 10.668C11.7434 10.852 12.1512 10.7428 12.3352 10.4239C12.5193 10.105 12.4101 9.69731 12.0912 9.51324L9.33309 7.92084V4.00004C9.33309 3.63185 9.03462 3.33337 8.66642 3.33337Z" fill="#606060" />
                                        </svg> {{ $notification->created_at->diffForHumans() }}
                                    </span>
                                </div>
                                <div class="notification-body">
                                    <h1 class="fs-5 fw-bold">{{ $notification->data['name'] }}</h1>
                                    <span class="fw-light">{{ $notification->data['body_'. app()->getLocale()] }}</span>
                                </div>
                                <p class="badge mt-4 fw-light">
                                    <span class="fs-4 mx-1 fw-light">{{ $notification->data['price'] }}</span> جنيه
                                </p>
                            </div>
                        </a>
                        <hr />
                    @empty
                        <div class="text-center text-muted py-3">
                            {{ __('No new notifications') }}
                        </div>
                    @endforelse
                @else
                    <div class="text-center text-muted py-3">
                        {{ __('No new notifications') }}
                    </div>
                @endif
            </div>
        </div>
        

    </div>

</section>

@endsection
