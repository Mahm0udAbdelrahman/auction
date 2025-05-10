@extends('admin.layout')
@section('title', __('Feedback Details'))

@section('content')
<!--start main wrapper-->
<main class="main-wrapper">
    <div class="main-content">
        <div class="row mb-5">
            <div class="col-12">
                <div class="card">
                    <div class="card-header text-center">
                        <h4>{{ __('Feedback Details') }}</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tr>
                                <th>{{ __('ID') }}</th>
                                <td>{{ $feedback->id }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('User') }}</th>
                                <td>{{ $feedback->user->name ?? __('N/A') }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('Subject') }}</th>
                                <td>{{ $feedback->address }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('Description') }}</th>
                                <td>{{ $feedback->description }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('Created At') }}</th>
                                <td>{{ $feedback->created_at->format('Y-m-d H:i') }}</td>
                            </tr>
                        </table>
                        <div class="text-center mt-3">
                            <a href="{{ route('Admin.feedback.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> {{ __('Back to list') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<!--end main wrapper-->
@endsection
