@extends('layouts.app')

@section('body-class', 'bg-light')

@section('content')

    @include('discover.includes.show-begin', ['full_width' => true])

    	<p class="dashboard-actions-container m-2 float-right">
            @include('members.follow.button', [
                'followable_type' => get_class($location),
                'followable_id' => $location->id,
                'name' => $location->name,
            ])
        </p>

        <h1>{{ $location->name }}</h1>

        @include('discover.includes.status-messages')

        @include('discover.locations.data')

    @include('discover.includes.show-end')
    @include('discover.includes.limited-access-modal')

@endsection
