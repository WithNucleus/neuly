@extends('layouts.app')

@section('content')
    @include('navbars.primary')

    <div class="error-page-container container py-5">
        <div class="text-center max-width-740 mx-auto mb-5">
            <div class="display-1 text-accent mb-2">
                <i class="fa-sharp fa-solid fa-bugs"></i>
            </div>
            <h1 class="error-title text-primary">
                @can('admin login')
                    <span>{{ $error_number }}</span>
                @endcan
                @yield('title')
            </h1>
            <div class="error-description text-body-emphasis fs-5 mb-4">@yield('description')</div>
            <div class="error-action text-body-secondary mb-4">
                Please <a href="javascript:history.back()">go back</a> or return to <a href="{{ route('index') }}">our homepage</a>.
            </div>
            <div class="error-feedback text-body-secondary ">
                You got the feeling that something is a bit off? Please <a href="{{ route('feedback.create') }}">contact us</a>.
            </div>
        </div>
    </div>
    @include('footers.full')
@endsection
