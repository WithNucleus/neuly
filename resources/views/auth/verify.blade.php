@extends('layouts.app')

@section('content')

@include('navbars.primary')

<div class="container py-5">
    <div class="max-width-780 mx-auto bg-body-secondary p-4 p-lg-5 text-center">
        <div class="display-1">
            <i class="fa-sharp fa-solid fa-envelope-circle-check text-accent mb-2"></i>
        </div>
        <h1 class="h2 text-transform-none mb-3">Verify Your Email Address</h1>
        @if (session('resent'))
            <div class="alert alert-success" role="alert">
                {{ __('A fresh verification link has been sent to your email address.') }}
            </div>
        @endif

        @if(auth()->user()->created_at < '2020-10-28')
            Hi {{ Auth::user()->name }}! We're requiring users to verify their email address, even though you signed up awhile ago.
                Please click the button below, and we'll send you an email with a verification link.<br>
            <form method="POST" action="{{ route('verification.resend') }}">
                @csrf
                <button type="submit" class="btn btn-primary m-4">Send Verification Email</button>
            </form>
            Sorry for any inconvenience, and thanks for using Neuly!

        @else
            <p class="fs-5 px-lg-4 mb-4 mx-auto">We sent an email with a link to verify your address. We know it's annoying, and we're sorry, but spam.</p>

            <p>If you didn't get an email from us, please request a new one.</p>
            <form method="POST" action="{{ route('verification.resend') }}">
                @csrf
                <button type="submit" class="btn btn-primary">Send Verification Email</button>
            </form>
        @endif
        <p class="mt-4 mb-0"><a href="/">Back to Neuly</a></p>
    </div>
</div>

@endsection
