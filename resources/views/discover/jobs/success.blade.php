@extends('layouts.plain')

@section('content')

@include('navbars.auth')

<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <div class="bg-white shadow-sm p-4">

                    <h1 class="h2 text-center text-primary page-title-default mb-4">Application Received</h1>

                    <p class="lead">Hi {{ $user->name }}! We have received your application for <strong>{{ $job->job_title }}</strong> and will forward it to <strong>{{ $job->owner->name }}</strong>.</p>

                    <p class="text-center mb-0">
                        <a href="{{ route('discover.jobs') }}" class="btn btn-dark">Return to Database</a>
                    </p>
            </div>
        </div>
    </div>
</div>
@endsection
