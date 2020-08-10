@extends('layouts.app')

@section('body-class', 'bg-light')

@section('content')

    @include('discover.includes.show-begin', ['full_width' => true])

    	<p class="dashboard-actions-container m-2 float-right">

            @include('members.bookmarks.add-button', [
                'entity' => $entity,
                'entity_id' => $location->id,
                'name' => $location->name,
                'bookmarks' => $bookmarks
            ])

        </p>

        <h1>{{ $location->name }}</h1>

        @include('discover.locations.data') 

    @include('discover.includes.show-end')

@endsection