@extends('layouts.app')

@section('body-class', 'page-user-settings bg-light')

@section('content')

    @include('navbars.primary')

    <div class="container">
        <main id="content-main" role="main" class="col-12">
            <div class="row">
                <div class="col-12 col-xl-10 mx-auto bg-white p-4 shadow-sm">

                    <h1 class="page-title-default text-primary mb-4">Person Claiming Verification</h1>

                    <div class="py-4 col-12 col-lg-12">
                        How to verify a claim by social logins:
                        <br /><br />
                        <ol>
                            <li>Click the send verification email button.</li>
                            <li>Click on the verification link from the mail</li>
                        </ol>
                        Your verification link will be valid for xx hours.
                        <br /><br />

                        <a href="{{ route('user.person.send.mail') }}" class="btn btn-primary mt-4">Send verification email</a>
                    </div>

                </div>
            </div>
        </main>
    </div>

    @include('footers.mini')

@endsection
