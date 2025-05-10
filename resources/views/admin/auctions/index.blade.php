@extends('admin.layout')
@section('title', __('Auctions'))
@section('content')
<main class="main-wrapper">
    <div class="main-content">

        <!-- Filter Form -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form method="GET" action="{{ route('Admin.auctions.index') }}" class="row g-3">
                            <div class="col-md-3">
                                <label for="month" class="form-label">{{ __('Month') }}</label>
                                <select name="month" id="month" class="form-select">
                                    <option value="">{{ __('All Months') }}</option>
                                    @foreach(range(1, 12) as $m)
                                        <option value="{{ $m }}" {{ request('month') == $m ? 'selected' : '' }}>
                                            {{ \Carbon\Carbon::create()->month($m)->format('F') }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-3">
                                <label for="status" class="form-label">{{ __('Status') }}</label>
                                <select name="status" id="status" class="form-select">
                                    <option value="">{{ __('All Statuses') }}</option>
                                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}> {{ __('Pending') }} </option>
                                    <option value="won" {{ request('status') == 'won' ? 'selected' : '' }}>{{ __('Won') }}</option>
                                    <option value="lost" {{ request('status') == 'lost' ? 'selected' : '' }}>{{ __('Lost') }}</option>
                                </select>
                            </div>

                            <div class="col-md-3">
                                <label for="user" class="form-label">{{ __('User Name') }}</label>
                                <input type="text" name="user" id="user" class="form-control" value="{{ request('user') }}" placeholder="{{ __('Search by User') }}">
                            </div>

                            <div class="col-md-3 d-flex align-items-end">
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="fas fa-filter"></i> {{ __('Filter') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Auctions Table -->
        <div class="row mb-5">
            <div class="col-12">
                <div class="card">
                    <div style="overflow: auto;" class="card-body">
                        <h6>{{ __('Auctions') }}</h6>
                        <table class="table table-bordered table-striped mt-3">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('User') }}</th>
                                    <th>{{ __('Car') }}</th>
                                    <th>{{ __('Start Price') }}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th>{{ __('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($auctions as $auction)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $auction->user->name }}</td>
                                        <td>{{ $auction->car->name }}</td>
                                        <td>${{ number_format($auction->start_price, 2) }}</td>
                                        <td>
                                            <span class="badge bg-{{ $auction->status === 'pending' ? 'warning' : ($auction->status === 'won' ? 'success' : 'danger') }}">
                                                {{ __(ucfirst($auction->status)) }}
                                            </span>
                                        </td>
                                        <td style="display: flex; gap: 3px;">
                                            @can('auctions-show')
                                                <a href="{{ route('Admin.auctions.show', $auction->id) }}" class="btn btn-warning">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            @endcan
                                            @can('auctions-delete')
                                                <button type="button" class="btn btn-danger w-25 delete-country-btn" data-id="{{ $auction->id }}">
                                                <i class="far fa-trash-alt"></i>
                                            </button>
                                            @endcan
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">{{ __('No Auctions Found') }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {!! $auctions->appends(request()->query())->links('pagination::bootstrap-5') !!}
                    </div>
                </div>
            </div>
        </div>

    </div>
</main>
@endsection
@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll('.delete-country-btn').forEach(button => {
            button.addEventListener('click', function () {
                let id = this.getAttribute('data-id');

                Swal.fire({
                    title: '{{ __("Are you sure?") }}',
                    text: "{{ __('Do you want to delete this item') }}",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#DC143C',
                    cancelButtonColor: '#696969',
                    cancelButtonText: "{{ __('Cancel') }}",
                    confirmButtonText: '{{ __("Yes, delete it!") }}'
                }).then((result) => {
                    if (result.isConfirmed) {
                        let form = document.createElement('form');
                        form.action = '{{ url("/admin/auctions") }}/' + id;
                        form.method = 'POST';
                        form.style.display = 'none';

                        let csrfInput = document.createElement('input');
                        csrfInput.type = 'hidden';
                        csrfInput.name = '_token';
                        csrfInput.value = '{{ csrf_token() }}';

                        let methodInput = document.createElement('input');
                        methodInput.type = 'hidden';
                        methodInput.name = '_method';
                        methodInput.value = 'DELETE';

                        form.appendChild(csrfInput);
                        form.appendChild(methodInput);
                        document.body.appendChild(form);
                        form.submit();
                    }
                });
            });
        });
    });
</script>
@endpush
