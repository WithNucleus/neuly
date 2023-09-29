@extends('layouts.app')

@section('content')

    @include('navbars.primary')

    <div class="container text-center my-5">
        <h1 class="text-center text-primary">Thank you!</h1>
        @include('discover.includes.status-messages')
        <p class="text-center fs-6">We appreciate your feedback.</p>
        <div>
            <a href="/" class="btn btn-dark rounded-0">Return to Neuly</a>
        </div>
    </div>
@endsection


