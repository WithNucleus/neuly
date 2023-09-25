@extends('layouts.plain')

@section('body-class', 'plain-layout')

@section('content')

    @include('navbars.primary')

    <div class="container text-center py-5 my-5">
        <div class="max-width-780 mx-auto">
            <h1 class="text-primary">Access Denied</h1>
            <p class="fs-6">
                Hi there! You've been blocked temporarily because of your previous actions.
                If you are a real person, please <a href="/feedback">contact us</a>. Sorry for any inconvenience.
            </p>
        </div>
    </div>

    @include('footers.full')
@endsection
