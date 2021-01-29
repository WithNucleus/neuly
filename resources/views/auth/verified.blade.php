@extends('layouts.plain')

@section('content')

@include('navbars.auth')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-body text-center">

                    <h1 class="h2 text-center border-bottom border-color-tertiary text-primary mb-4">Thanks for verifying your email!</h1>

                    <p class="mt-4 text-success">Email "{{ $email }}" verified successfully.</p>

                    <p class="mt-4 mb-0"><a href="{{ route('index') }}">Return to home page</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
