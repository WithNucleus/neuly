@extends('layouts.app')

@section('body-class', 'listing-requests')

@section('content')
    @include('navbars.primary')

    <div class="container my-5">
        <h1 class="text-center text-body-emphasis">Neuly Listing Request</h1>
        <p class="text-center lead">Your listing request has been submitted. Thanks!</p>

        @if($additionalEntitiesRequested)
            <div class="mb-2 text-center">
                @foreach($additionalEntitiesRequested as $type => $value)
                    <p class="lead">Please create a request for {{ ucfirst($type) }} "{{ $value }}"</p>
                @endforeach
                <p class="text-center">
                    <a class="btn btn-primary" href="{{ route('listing.request') }}">New Listing
                        Request</a>
                </p>
            </div>
        @else
            <p class="text-center">
                <a href="{{ route('index') }}" class="btn btn-accent">Back to Neuly</a>
            </p>
        @endif
    </div>

    @include('footers.full')

@endsection
