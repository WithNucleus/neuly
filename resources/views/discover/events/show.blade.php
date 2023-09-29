@extends('layouts.entity-show')

@section('breadcrumbs')
    @include('navbars.breadcrumb', [
        'items' => [
            'Events' => route('discover.events'),
            $event->name  => false
        ]
    ])
@endsection

@section('content')

    <div class="container py-4">

        <x-entities.entity-show-title-meta title="{{ $event->name }}" headingClasses="max-width-780 text-success mb-2">
            <div class="me-3">
                @include('members.follow.button', [
                    'followable_type' => get_class($event),
                    'followable_id' => $event->id,
                    'name' => $event->name
                ])
            </div>
        </x-entities.entity-show-title-meta>

        @include('discover.events.data')

        <div class="d-flex flex-wrap justify-content-between align-items-center text-uppercase small fw-bold text-secondary-emphasis mt-4">
            <div class="me-4">
                Last updated: {{ Carbon\Carbon::parse($event->updated_at)->format('M d, Y') }}
            </div>
            @can('edit events')
                <div>
                    <a href="{{ route('event.edit', $event->id) }}" class="text-secondary-emphasis">Edit Event</a>
                </div>
            @endcan
            <div>
                @include('discover.includes.update-listing-form', ['entity' => $event])
            </div>
        </div>
    </div>

@endsection
