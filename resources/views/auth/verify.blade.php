@extends('layouts.plain')

@section('content')

@include('navbars.auth')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">

                <div class="card-body text-center">

                    <h1 class="h2 text-center border-bottom border-color-tertiary text-primary mb-4">Verify Your Email Address</h1>

                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    @if(auth()->user()->created_at < '2020-10-28')
                        Hi {{ Auth::user()->name }}! We're requiring users to verify their email address, even though you signed up awhile ago.
                            Please click the button below and we'll send you an email with a verification link.<br>
                        <form method="POST" action="{{ route('verification.resend') }}">
                            @csrf
                            <button type="submit" class="btn btn-primary m-4">Send Verification Email</button>
                        </form>
                        Sorry for any inconvenience, and thanks for using Neuly!

                    @else
                        {{ __('Before proceeding, please check your email for a verification link.') }}<br>
                        {{ __('If you did not receive the email') }},
                        <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                            @csrf
                            <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
                        </form>
                    @endif

                    <p class="mt-4 mb-0"><a href="{{ route('index') }}">Return to home page</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
