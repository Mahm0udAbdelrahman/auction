@extends('admin.layout')
@section('title', __('Car'))

@section('content')
<!--start main wrapper-->
<main class="main-wrapper">
    <div class="main-content">
        <div class="row mb-5">
            <div class="col-12 col-xl-12">
                <div class="card">
                    <div class="add d-flex justify-content-end p-2">
                        {{-- @can('cars-create')
                        <a href="{{ route('Admin.cars.create') }}" class="btn btn-primary"> <i class="fas fa-add"></i> {{ __('Add Maintenance Center') }}</a>
                        @endcan --}}
                    </div>
                    <div class="card-body">
                        <div class="table-responsive text-center">
                            <table id="example2" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>{{ __('ID') }}</th>
                                        <th>{{ __('Car owner') }}</th>
                                        <th>{{ __('Name Car') }}</th>
                                        <th>{{ __('Type Car') }}</th>
                                        <th>{{ __('Model Car') }}</th>
                                        <th>{{ __('Color Car') }}</th>
                                        <th>{{ __('Kilometer Car') }}</th>
                                        <th>{{ __('Price Car') }}</th>
                                        <th>{{ __('License_year Car') }}</th>
                                        <th>{{ __('Status') }}</th>
                                        <th>{{ __('Actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($data as $car)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $car->user->name }}</td>
                                        <td>{{ $car->name }}</td>
                                        <td>{{ $car->carType->{'name_' . app()->getLocale()} }}</td>
                                        <td>{{ $car->model }}</td>
                                        <td>{{ $car->color }}</td>
                                        <td>{{ $car->kilometer }}</td>
                                        <td>{{ $car->price }}</td>
                                        <td>{{ $car->license_year }}</td>
                                        <td>{{ $car->status }}</td>
                                        <td>
                                            @can('cars-delete')
                                            <button type="button" class="btn btn-danger delete-country-btn" data-id="{{ $car->id }}">
                                                <i class="far fa-trash-alt"></i>
                                            </button>
                                            @endcan

                                            @can('cars-show')
                                            <a href="{{ route('Admin.cars.show',$car) }}" class="btn btn-warning"><i class="fas fa-eye"></i>                                            </a>
                                            @endcan

                                            @can('cars-update')
                                            <a href="{{ route('Admin.cars.edit',$car) }}" class="btn btn-info"><i class="fas fa-edit"></i></a>
                                            @endcan
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="11">{{ __('No data available') }}</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <div style="padding:5px;direction: ltr;">
                                {!! $data->withQueryString()->links('pagination::bootstrap-5') !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<!--end main wrapper-->
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
                        form.action = '{{ url("/admin/cars") }}/' + id;
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
