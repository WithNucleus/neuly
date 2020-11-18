@extends('layouts.plain')

@section('content')

    @include('navbars.auth')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="bg-white shadow-sm p-4">

                    <h1 class="h2 text-center text-primary page-title-default mb-4">Access Denied</h1>

                    <p class="lead-smaller text-center">
                        Hi there! You've been blocked temporarily because of your previous actions.
                        If you are a real person, please <a href="mailto:support@neuly.com">contact us</a>. Sorry for any inconvenience.
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
