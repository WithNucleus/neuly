@extends('layouts.plain')

@section('body-class', 'page-user-settings bg-light')

@section('content')

    @include('navbars.auth')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    @include('members.includes.status-messages')

                    <div class="card-body text-center">

                        <h1 class="h2 text-center border-bottom border-color-tertiary text-primary mb-4">Verify Your New Email</h1>

                        <p class="lead">We sent verification link to your new email address.</p>

                        <p class="lead">Thanks for using Neuly!</p>

                        <p class="mt-4 mb-0"><a href="{{ route('index') }}">Return to home page</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('footers.mini')
@endsection
