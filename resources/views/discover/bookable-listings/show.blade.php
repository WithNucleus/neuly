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

        <x-entities.entity-show-title-meta title="{{ $bookableListing->name }}" headingClasses="max-width-780 text-success mb-2" />

        @if($bookableListing->status == \App\Models\BookableListing::STATUS_PENDING)
            <div class="alert alert-warning">This listing is pending. We'll review it as soon as possible to include in our care provider directory.</div>
        @endif

        @include('discover.bookable-listings.show.' . $bookableEntity)
    </div>

@endsection
