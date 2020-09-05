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
    </p>

    <h1>{{ $person->name }}</h1>

    @include('discover.includes.status-messages')

    @include('discover.people.data')

    <p class="mb-0">
        <small>Last updated: {{ Carbon\Carbon::parse($person->updated_at)->format('M d, Y') }}</small>
    </p>

    @include('discover.includes.show-end')

@endsection
