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
                            <li>Make sure your neuly E-Mail address is the one used with your social profile</li>
                            <li>Log out from neuly.</li>
                            <li>Login via a social login the claimed person has stated on neuly.</li>
                            <li>Come back to this site and check your status</li>
                        </ol>

                        <a href="{{ route('discover.people.claim.social.verify', ['claim' => $claim->id]) }}" class="btn btn-primary mt-4">Check verification status</a>
                    </div>

                </div>
            </div>
        </main>
    </div>

    @include('footers.mini')

@endsection
