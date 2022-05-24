@extends('layouts.app')

@section('body-class', 'bg-light')

@section('content')

    @include('discover.includes.show-begin', ['full_width' => false])

    <h1>{{ $bookableListing->bookable->name }}</h1>

    @if($bookableEntity == 'organizations')
        @php $company = $bookableListing->bookable; @endphp
        @include('discover.bookable-listings.show.organizations')
    @elseif($bookableEntity == 'people')
        @php $person = $bookableListing->bookable; @endphp
        @include('discover.bookable-listings.show.people')
    @endif

    @include('discover.includes.show-end')
    @include('discover.includes.limited-access-modal')

@endsection
