@extends('layouts.app')

@section('body-class', 'page-user-settings bg-light')

@section('content')
    @include('navbars.primary')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    @include('members.includes.status-messages')

                    <div class="card-body text-center">

                        <h1 class="h2 text-center border-bottom border-color-tertiary text-primary mb-4">Verify Your New Email Address</h1>

                        We're requiring users to verify their email address. We already sent verification link to your new email address.<br>
                        Sorry for any inconvenience, and thanks for using Neuly!<br><br>

                        <p class="mt-4 mb-0"><a href="{{ route('index') }}">Return to home page</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('footers.mini')
@endsection
