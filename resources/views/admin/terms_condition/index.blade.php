@extends('admin.layout')

@section('title', __('Terms and Conditions Policy'))

@section('content')
    <!--start main wrapper-->
    <main class="main-wrapper">
        <div class="main-content">
            <div class="row mb-5">
                <div class="col-12 col-xl-12">
                    <div class="card">
                        <div class="add d-flex justify-content-end p-2">
                            {{-- @can('balance_insurances-create') --}}
                            <a href="{{ route('Admin.terms_condition.create') }}" class="btn btn-primary"> <i
                                    class="fas fa-add"></i> {{ __('Add Terms and Conditions Policy') }}</a>
                            {{-- @endcan --}}
                        </div>
                        <div class="card-body">
                            <div class="table-responsive text-center">
                                <table id="example2" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>{{ __('ID') }}</th>
                                            <th>{{ __('Terms and Conditions') }}</th>
                                            <th>{{ __('Country') }}</th>
                                            <th>{{ __('Actions') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($data as $terms_condition)
                                            <tr>
                                                <td>{{ $terms_condition->id }}</td>
                                                <td>{{ __($terms_condition->{'message_' . app()->getLocale()}) }}
                                                </td>
                                                <td>{{ __($terms_condition->country->{'name_' . app()->getLocale()}) }}</td>

                                                <td>
                                                    {{-- @can('balance_insurances-delete') --}}
                                                    <button type="button" class="btn btn-danger delete-terms_condition-btn"
                                                        data-id="{{ $terms_condition->id }}">
                                                        <i class="far fa-trash-alt"></i>
                                                    </button>
                                                    {{-- @endcan --}}

                                                    {{-- @can('balance_insurances-update') --}}
                                                    <a href="{{ route('Admin.terms_condition.edit', $terms_condition) }}"
                                                        class="btn btn-info"><i class="fas fa-edit"></i></a>
                                                    {{-- @endcan --}}
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7">{{ __('No data available') }}</td>
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
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll('.delete-terms_condition-btn').forEach(button => {
                button.addEventListener('click', function() {
                    let id = this.getAttribute('data-id');

                    Swal.fire({
                        title: "{{ __('Are you sure?') }}",
                        text: "{{ __('Do you want to delete this item') }}",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#DC143C',
                        cancelButtonColor: '#696969',
                        cancelButtonText: "{{ __('Cancel') }}",
                        confirmButtonText: "{{ __('Yes, delete it!') }}"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            let form = document.createElement('form');
                            form.action = '{{ url('/admin/terms_condition') }}/' + id;
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

{{-- 
@section('content')
    <main class="main-wrapper">
        <div class="main-content">
            <div class="row mb-5">
                <div class="col-12 col-xl-12">
                    <div class="card">

                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ __('Success Message') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="{{ __('Close') }}"></button>
                            </div>
                        @endif

                        <div class="card shadow-lg rounded-3">
                            <div class="card-header bg-primary text-white">
                                <h4 class="mb-0 text-white">{{ __('Edit Privacy Policy') }}</h4>
                            </div>
                            <div class="card-body">
                                <form method="post" action="{{ route('Admin.privacy_policy.update') }}">
                                    @csrf
                                    @method('PUT')

                                    <div class="mb-3">
                                        <label for="message_ar"
                                            class="form-label">{{ __('Privacy Policy (Arabic)') }}</label>
                                        <textarea id="message_ar" name="message_ar" class="form-control @error('message_ar') is-invalid @enderror"
                                            rows="6">{{ old('message_ar', $privacy_policy->message_ar ?? '') }}</textarea>
                                        @error('message_ar')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="message_en"
                                            class="form-label">{{ __('Privacy Policy (English)') }}</label>
                                        <textarea id="message_en" name="message_en" class="form-control @error('message_en') is-invalid @enderror"
                                            rows="6">{{ old('message_en', $privacy_policy->message_en ?? '') }}</textarea>
                                        @error('message_en')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="message_ru"
                                            class="form-label">{{ __('Privacy Policy (Russian)') }}</label>
                                        <textarea id="message_ru" name="message_ru" class="form-control @error('message_ru') is-invalid @enderror"
                                            rows="6">{{ old('message_ru', $privacy_policy->message_ru ?? '') }}</textarea>
                                        @error('message_ru')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="text-end">
                                        <button type="submit" class="btn btn-success">{{ __('Update') }}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection --}}
