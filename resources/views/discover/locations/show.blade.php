@extends('layouts.entity-show')

@section('breadcrumbs')
    @include('navbars.breadcrumb', [
        'items' => [
            'Locations' => route('discover.locations'),
            $location->name  => false
        ]
    ])
@endsection

@section('content')

    <div class="container py-4">

        <x-entities.entity-show-title-meta title="{{ urlencode($location->name) }}">
            <div class="me-3">
                @include('members.follow.button')
            </div>
        </x-entities.entity-show-title-meta>

        @include('discover.locations.data')

        @auth
            <div class="d-flex flex-wrap justify-content-between align-items-center text-uppercase small fw-bold text-secondary-emphasis mt-4">
                <div class="me-4">
                    First added: {{ Carbon\Carbon::parse($location->created_at)->format('M d, Y') }}
                </div>
                @can('edit companies')
                    <div>
                        <a href="{{ route('location.edit', $location->id) }}" class="text-secondary-emphasis">Edit location</a>
                    </div>
                @endcan
                <div>
                    @include('discover.includes.update-listing-form', ['entity' => $location])
                </div>
            </div>
        @endauth
    </div>

@endsection
