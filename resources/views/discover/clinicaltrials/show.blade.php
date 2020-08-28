@extends('layouts.app')

@section('body-class', 'bg-light')

@section('content')

    @include('discover.includes.show-begin', ['full_width' => false])

    <p class="dashboard-actions-container m-2 float-right">

        @include('members.bookmarks.add-button', [
            'entity' => $entity,
            'entity_id' => $clinicaltrial->id,
            'name' => $clinicaltrial->title,
            'bookmarks' => $bookmarks
        ])

        @include('members.follow.button', [
            'followable_type' => get_class($clinicaltrial),
            'followable_id' => $clinicaltrial->id,
            'name' => $clinicaltrial->title,
        ])

    </p>

    <h1 class="h3 font-normal mb-4">{{ $clinicaltrial->title }}</h1>

    @include('discover.includes.status-messages')

    @include('discover.clinicaltrials.data')

    @include('discover.includes.show-end')

@endsection
