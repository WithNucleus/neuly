@extends('layouts.app')

@section('body-class', 'bg-light')

@section('content')

    @include('discover.includes.show-begin', ['full_width' => true])

    	<p class="dashboard-actions-container m-2 float-right">

            @include('members.bookmarks.add-button', [
                'entity' => $entity,
                'entity_id' => $focus->id,
                'name' => $focus->name,
                'bookmarks' => $bookmarks
            ])

        </p>

        <h1>{{ $focus->name }}</h1>

        @include('discover.focus.data') 

    @include('discover.includes.show-end')

@endsection