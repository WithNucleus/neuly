@extends('layouts.plain')

@section('body-class', 'plain-layout')

@section('content')

@include('navbars.auth')

<div class="container">
    <div class="max-width-780 mx-auto bg-body-secondary p-4 p-lg-5 text-center ">
        <h1 class="h2 text-transform-none mb-3">Thanks for verifying your email!</h1>
        <p class="mt-4 text-accent fw-bold">Email "{{ $email }}" verified successfully.</p>
        <p class="mt-4 mb-0"><a href="/">Back to Neuly</a></p>
    </div>
</div>

@endsection
