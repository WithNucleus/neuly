@extends('layouts.entity-show')

@section('breadcrumbs')
    @include('navbars.breadcrumb', [
        'items' => [
            'Find a Care Provider' => route('discover.bookable-listing.practitioners'),
            $bookableListing->name  => false
        ]
    ])
@endsection

@section('content')

    <div class="container py-4">

        <x-entities.entity-show-title-meta title="{{ urlencode($bookableListing->name) }}" headingClasses="max-width-780 text-success mb-2" />

        @if($bookableListing->status == \App\Models\BookableListing::STATUS_PENDING)
            <div class="alert alert-warning">This listing is pending. We'll review it as soon as possible to include in our care provider directory.</div>
        @endif

        @include('discover.bookable-listings.show.' . $bookableEntity)

        @can('edit companies')
            <div class="d-flex flex-wrap justify-content-between align-items-center text-uppercase small fw-bold text-secondary-emphasis mt-4">
                <div class="me-4">
                    Last updated: {{ Carbon\Carbon::parse($bookableListing->updated_at)->format('M d, Y') }}
                </div>
                @can('edit companies')
                    <div>
                        <a href="{{ route('bookable-listing.edit', $bookableListing->id) }}" class="text-secondary-emphasis">Edit Bookable Listing</a>
                    </div>
                @endcan
            </div>
        @endcan
    </div>

@endsection
