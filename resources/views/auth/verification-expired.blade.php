@extends('layouts.app')

@section('content')

    @include('navbars.primary')

    <div class="container py-5">
        <div class="max-width-780 mx-auto bg-body-secondary p-4 p-lg-5 text-center ">
             <div class="display-1">
                <i class="fa-sharp fa-solid fa-envelope-circle-check text-accent mb-2"></i>
            </div>
            <h1 class="h2 text-transform-none">Email Verification Expired</h1>
            <p class="fs-6">The link to verify your email expired.<br>We sent a new link, it's good for 7 days.</p>
            <p class="text-body-secondary small">If you don't get your link within 15 minutes, please email <a href="support@neuly.com">support@neuly.com</a>.</p>
        </div>
    </div>

@endsection
