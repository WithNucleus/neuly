@extends('layouts.plain')

@section('content')

@include('navbars.auth')

<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <div class="bg-white shadow-sm p-4">

                    <h1 class="h2 text-center text-primary page-title-default mb-4">Thanks for registering!</h1>

                    <p class="lead text-center">You'll be hearing from us when we're ready to launch...and give you a little 'thank you' for registering early!"</p>

                    <p class="text-center mb-0">
                        <a href="/organizations" class="btn btn-dark">Return to Database</a>
                    </p>
            </div>
        </div>
    </div>
</div>
@endsection
