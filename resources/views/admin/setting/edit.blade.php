@extends('admin.layout')

@section('title', __('Edit Setting'))

@section('content')
    <main class="main-wrapper">
        <div class="main-content">
            <div class="row mb-5">
                <div class="col-12 col-xl-12">
                    <div class="card">

                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ __('Success Message') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="{{ __('Close') }}"></button>
                            </div>
                        @endif

                        <div class="card shadow-lg rounded-3">
                            <div class="card-header bg-primary text-white">
                                <h4 style="color:#fff ;" class="mb-0">{{ __('Edit Setting') }}</h4>
                            </div>
                            <div class="card-body">
                                <form method="post" action="{{ route('Admin.setting.update') }}">
                                    @csrf
                                    @method('PUT')

                                 <div class="col-md-6">
    <label for="service" class="form-label">{{ __('Country') }}</label>
    <select class="form-select" name="country_id" id="service">
        <option disabled selected>{{ __('Choose Country...') }}</option>
        @foreach ($countries as $country)
            <option @selected(isset($setting) && $country->id == $setting->country_id) value="{{ $country->id }}">
                {{ $country->{'name_'.app()->getLocale()} }}
            </option>
        @endforeach
    </select>
    @error('country_id')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>


                                    <div class="col-md-6">
                                        <label class="fw-semibold">{{ __('Phone') }}</label>
                                        <input type="text" value="{{ old('phone', $setting->phone ?? '') }}" name="phone" class="form-control" required placeholder="{{ __('Enter Phone') }}">
                                    </div>

                                    <div class="col-md-6">
                                        <label class="fw-semibold">{{ __('email') }}</label>
                                        <input type="email" name="email" value="{{ old('email', $setting->email ?? '') }}" class="form-control" required placeholder="{{ __('Enter your email') }}">
                                    </div>


                                    <div class="mb-3">
                                        <label for="description_ar" class="form-label">{{ __('Description (Arabic)') }}</label>
                                        <textarea id="description_ar" name="description_ar" class="form-control @error('description_ar') is-invalid @enderror" rows="6">{{ old('description_ar', $setting->description_ar ?? '') }}</textarea>
                                        @error('description_ar')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="description_en" class="form-label">{{ __('Description (English)') }}</label>
                                        <textarea id="description_en" name="description_en" class="form-control @error('description_en') is-invalid @enderror" rows="6">{{ old('description_en', $setting->description_en ?? '') }}</textarea>
                                        @error('description_en')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="description_ru" class="form-label">{{ __('Description (Russian)') }}</label>
                                        <textarea id="description_ru" name="description_ru" class="form-control @error('description_ru') is-invalid @enderror" rows="6">{{ old('description_ru', $setting->description_ru ?? '') }}</textarea>
                                        @error('description_ru')
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
@endsection
