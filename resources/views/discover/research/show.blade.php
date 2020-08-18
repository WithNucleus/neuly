@extends('layouts.app')

@section('body-class', 'bg-light')

@section('content')

    @include('discover.includes.show-begin', ['full_width' => false])

    @include('discover.includes.status-messages')

    <p class="dashboard-actions-container m-2 float-right">

        @include('members.bookmarks.add-button', [
            'entity' => $entity,
            'entity_id' => $research->id,
            'name' => $research->name,
            'bookmarks' => $bookmarks
        ])

        @include('members.follow.add-button', [
            'entity' => $entity,
            'entity_id' => $research->id,
            'name' => $research->name,
        ])

    </p>

    @include('discover.research.data')

    <p class="mb-0 mt-3">
        <small>Last updated: {{ Carbon\Carbon::parse($research->updated_at)->format('M d, Y') }}</small>
    </p>

    @include('discover.includes.show-end')

@endsection
