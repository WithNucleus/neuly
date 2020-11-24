@extends('layouts.app')

@section('body-class', 'bg-light')

@section('content')

    @include('discover.includes.show-begin', ['full_width' => false])

    <p class="dashboard-actions-container m-2 float-right">
        @include('members.follow.button', [
            'followable_type' => get_class($person),
            'followable_id' => $person->id,
            'name' => $person->name
        ])

        @if($isVerified)
            <span class="badge badge-success">verified</span>
        @else
            @if(Auth::check() && Auth::user()->hasRaisedClaimBefore() === false)
                <a class="btn btn-primary" href="{{ route('discover.people.claim', ['slug' => $person->slug]) }}">Claim this person?</a>
            @endif
        @endif
    </p>

    <h1>{{ $person->name }}</h1>

    @include('discover.includes.status-messages')

    @include('discover.people.data')

    <p class="mb-0 d-flex justify-content-between">
        <small>Last updated: {{ Carbon\Carbon::parse($person->updated_at)->format('M d, Y') }}</small>
{{--    TODO: after "Claim Person" functionality will be finished and merged - add condition to show this link only for unverified person --}}
        <small><a href="{{ route('discover.people.requestDeletion', $person->slug) }}" class="text-danger">Request deletion</a></small>
    </p>

    @include('discover.includes.show-end')

@endsection
