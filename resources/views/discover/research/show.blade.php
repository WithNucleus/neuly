@extends('layouts.entity-show')

@section('breadcrumbs')
    @include('navbars.breadcrumb', [
        'items' => [
            'Research' => route('discover.research'),
            $research->name  => false
        ]
    ])
@endsection

@section('content')

    <div class="container py-4">

        <x-entities.entity-show-title-meta title="{{ $research->name }}" headingClasses="text-success h2 text-transform-none mb-2 max-width-780">
            <div class="me-3">
                @include('members.follow.button', [
                    'followable_type' => get_class($research),
                    'followable_id' => $research->id,
                    'name' => $research->name
                ])
            </div>
        </x-entities.entity-show-title-meta>

        @include('discover.research.data')

        <div class="d-flex flex-wrap justify-content-between align-items-center text-uppercase small fw-bold text-secondary-emphasis mt-4">
            <div class="me-4">
                Last updated: {{ Carbon\Carbon::parse($research->updated_at)->format('M d, Y') }}
            </div>
            @can('edit people')
                <div>
                    <a href="{{ route('person.edit', $research->id) }}" class="text-secondary-emphasis">Edit Research</a>
                </div>
            @endcan
            <div>
                @include('discover.includes.update-listing-form', ['entity' => $research])
            </div>
        </div>
    </div>

@endsection
