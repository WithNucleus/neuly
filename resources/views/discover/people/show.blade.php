@extends('layouts.entity-show')

@section('breadcrumbs')
    @include('navbars.breadcrumb', [
        'items' => [
            'People' => route('discover.people'),
            $person->name  => false
        ]
    ])
@endsection

@section('content')

    <div class="container py-4">

        <x-entities.entity-show-title-meta title="{{ $person->name }}">
            <div class="me-3">
                @include('members.follow.button', [
                    'followable_type' => get_class($person),
                    'followable_id' => $person->id,
                    'name' => $person->name
                ])
            </div>
        </x-entities.entity-show-title-meta>

        @include('discover.people.data')

        <div class="d-flex flex-wrap justify-content-between align-items-center text-uppercase small fw-bold text-secondary-emphasis mt-4">
            <div class="me-4">
                Last updated: {{ Carbon\Carbon::parse($person->updated_at)->format('M d, Y') }}
            </div>
            @can('edit people')
                <div>
                    <a href="{{ route('person.edit', $person->id) }}" class="text-secondary-emphasis">Edit Person</a>
                </div>
            @endcan
            <div>
                @include('discover.includes.update-listing-form', ['entity' => $person])
            </div>
        </div>
    </div>

@endsection
