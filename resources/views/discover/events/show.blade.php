@extends('layouts.app')

@section('body-class', 'bg-light')

@section('content')

    @include('discover.includes.show-begin', ['full_width' => false])

    <p class="dashboard-actions-container m-2 float-right">

        @include('members.bookmarks.add-button', [
            'entity' => $entity,
            'entity_id' => $event->id,
            'name' => $event->name,
            'bookmarks' => $bookmarks
        ])
        @include('members.follow.button', [
            'followable_type' => get_class($event),
            'followable_id' => $event->id,
            'name' => $event->name,
        ])
    </p>

    <h1>{{ $event->name }}</h1>

    @include('discover.includes.status-messages')

    @include('discover.events.data')

    <p class="mb-0">
        <small>Last updated: {{ Carbon\Carbon::parse($event->updated_at)->format('M d, Y') }}</small>
    </p>

    @include('discover.includes.show-end')

@endsection
