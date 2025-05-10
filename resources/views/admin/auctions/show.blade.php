@extends('admin.layout')
@section('title', __('Auction Details'))
@section('content')
    <main class="main-wrapper">
        <div class="main-content">
            <div class="row mb-5">
                <div class="col-12">
                    <div class="card shadow rounded-4">
                        <div class="card-header bg-primary text-white rounded-top-4">
                            <h5 class="mb-0">{{ __('Auction Details') }}</h5>
                        </div>
                        <div class="card-body p-4">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item py-3">
                                    <strong>{{ __('Name Owner') }}</strong> <span
                                        class="ms-2">{{ $auction->user->name }}</span>
                                </li>
                                <li class="list-group-item py-3">
                                    <strong>{{ __('Phone Owner') }}</strong> <span
                                        class="ms-2">{{ $auction->user->phone }}</span>
                                </li>
                                <li class="list-group-item py-3">
                                    <strong>{{ __('Car:') }}</strong> <span
                                        class="ms-2">{{ $auction->car->name }}</span>
                                </li>
                                <li class="list-group-item py-3">
                                    <strong>{{ __('Start Price:') }}</strong> <span
                                        class="ms-2">{{ number_format($auction->start_price, 2) }}</span>
                                </li>
                                <li class="list-group-item py-3">
                                    <strong>{{ __('Start Date:') }}</strong> <span
                                        class="ms-2">{{ $auction->start_date->format('Y-m-d H:i') }}</span>
                                </li>
                                <li class="list-group-item py-3">
                                    <strong>{{ __('End Date:') }}</strong> <span
                                        class="ms-2">{{ $auction->end_date->format('Y-m-d H:i') }}</span>
                                </li>
                                <li class="list-group-item py-3">
                                    <strong>{{ __('Status:') }}</strong>
                                    <span
                                        class="badge rounded-pill ms-2
                                    {{ $auction->status === 'pending' ? 'bg-warning text-dark' : ($auction->status === 'won' ? 'bg-success' : 'bg-danger') }}">
                                        {{ ucfirst($auction->status) }}
                                    </span>
                                </li>
                                @if ($auction->winner)
                                    <li class="list-group-item py-3">
                                        <strong>{{ __('Winner Name:') }}</strong> <span
                                            class="ms-2">{{ $auction->winner->name }}</span>
                                    </li>
                                    <li class="list-group-item py-3">
                                        <strong>{{ __('Winner Phone:') }}</strong> <span
                                            class="ms-2">{{ $auction->winner->phone }}</span>
                                    </li>
                                    <li class="list-group-item py-3">
                                        <strong>{{ __('Winner Price:') }}</strong> <span
                                            class="ms-2">{{ number_format($auction->winner_price, 2) }}</span>
                                    </li>
                                    <li class="list-group-item py-3">
                                        <strong>{{ __('Winner Date:') }}</strong> <span
                                            class="ms-2">{{ $auction->winner_date->format('Y-m-d H:i') }}</span>
                                    </li>
                                @endif
                            </ul>

                            <h5 class="mt-5">{{ __('Commit Auctions') }}</h5>
                            <hr class="mb-4">

                            @if ($auction->commitAuctions->isNotEmpty())
                                <div id="notificationsModal" class="list-group">
                                    @foreach ($auction->commitAuctions as $commit)
                                        <div
                                            class="list-group-item d-flex align-items-center py-3 rounded-3 shadow-sm mb-3 @if ($commit->user_id == $auction->winner_id && $commit->price == $auction->winner_price && $auction->status == 'won') bg-success-subtle border-success @endif">
                                            <img src="{{ $commit->user->image ?? asset('default/default.png') }}"
                                                alt="{{ $commit->user->name }}" class="rounded-circle me-4 border"
                                                width="60" height="60">
                                            <div class="flex-grow-1">
                                                <h6 class="mb-1">{{ $commit->user->name }}</h6>
                                                <p class="mb-1 text-muted">
                                                    {{ __('Price:') }}
                                                    <strong>{{ number_format((float)$commit->price, 2) }}</strong>
                                                </p>
                                                <small
                                                    class="text-muted">{{ $commit->created_at->diffForHumans() }}</small>
                                            </div>

                                            <form method="POST"
                                                action="{{ route('Admin.auctions.update', $auction->id) }}"
                                                id="form-{{ $commit->id }}">
                                                @csrf

                                                <input type="hidden" name="commit_id" value="{{ $commit->id }}">
                                                <input type="hidden" name="status" id="statusInput{{ $commit->id }}"
                                                    value="{{ $commit->status }}">

                                                <!-- زر الحالة -->
                                                <div class="dropdown">
                                                    <button
                                                        class="btn btn-outline-primary fw-bold px-3 py-1 rounded-pill dropdown-toggle"
                                                        type="button" id="statusDropdown{{ $commit->id }}"
                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                        @if ($commit->status == 'won')
                                                            <i class="fas fa-check-circle text-success"></i> فائز (Won)
                                                        @elseif ($commit->status == 'pending')
                                                            <i class="fas fa-times-circle text-danger"></i> قيد الانتظار
                                                            (pending)
                                                        @else
                                                            حالة المزايدة <i class="fas fa-chevron-down ms-1"></i>
                                                        @endif
                                                    </button>

                                                    <!-- القائمة المنسدلة -->
                                                    <ul class="dropdown-menu shadow border-0">
                                                        <li>
                                                            <a class="dropdown-item d-flex align-items-center gap-2 text-success fw-bold status-option"
                                                                data-value="won" data-id="{{ $commit->id }}"
                                                                href="#">
                                                                <i class="fas fa-check-circle"></i> فائز (Won)
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item d-flex align-items-center gap-2 text-warning fw-bold status-option"
                                                                data-value="lost" data-id="{{ $commit->id }}"
                                                                href="#">
                                                                <i class="fas fa-times-circle"></i> قيد الانتظار (pending)
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </form>

                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-muted">{{ __('No commits yet.') }}</p>
                            @endif

                            <script>
                                document.querySelectorAll(".status-option").forEach(item => {
                                    item.addEventListener("click", function(e) {
                                        e.preventDefault();
                                        let commitId = this.getAttribute("data-id");
                                        let newStatus = this.getAttribute("data-value");

                                        document.getElementById("statusInput" + commitId).value = newStatus;

                                        document.getElementById("form-" + commitId).submit();
                                    });
                                });
                            </script>


                            <a href="{{ route('Admin.auctions.index') }}" class="btn btn-secondary mt-4">
                                <i class="bi bi-arrow-left"></i> {{ __('Back to List') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
