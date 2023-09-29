@extends('layouts.app')

@section('content')

@include('navbars.primary')

<div class="container text-center mt-5 py-5">
     <h1 class="text-accent mb-4">Application Received</h1>
    <div class="max-width-780 mx-auto">
        <p class="fs-6 mb-5">Hi {{ $user->name }}! We have received your application for <strong>{{ $job->job_title }}</strong> and will forward it to <strong>{{ $job->owner->name }}</strong>.</p>
        <div>
            <a href="{{ route('discover.jobs') }}" class="btn btn-lg btn-primary">Return to Neuly</a>
        </div>
    </div>
</div>
@endsection
