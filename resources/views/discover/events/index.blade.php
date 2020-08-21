@extends('layouts.app')

@section('body-class', 'page-events bg-light')

@section('content')

    @include('navbars.primary')

    <div class="container-fluid">
        {{-- Discover Tabs Desktop --}}
        <div class="row">
            <div class="col-12 navbar-tabs-container">
                @include('navbars.tabs')
            </div>
        </div>
    </div>

    {{-- Discover Tabs Mobile --}}
    @include('navbars.tabs-mobile')

    <div class="container-fluid">
        {{-- Breadcrumbs --}}
        <div class="row">
            <div class="col-12 breadcrumbs-container bg-white shadow-sm">
                @include('navbars.breadcrumb', [
                    'items' => [
                        'Events' => false
                    ]
                ])
            </div>
        </div>

        {{-- Sidebar and Content Area --}}
        <div class="row">

            @include('sidebars.primary')

            <main id="index-main" role="main" class="col-lg-9 col-xl-10 ml-auto">
                @include('discover.includes.status-messages')

                <div class="row">

                    <div class="col-12">
                        <div class="full-width-show-view">

                            <div class="page-title-default d-md-flex justify-content-between">
                                <h1 class="mb-0 mr-5">
                                    @if(Route::is('discover.events'))
                                        Upcoming Events
                                    @else
                                        Past Events
                                    @endif
                                </h1>

                                <span class="lead-smaller align-self-end pb-1">
                                    Showing {{ $events->total() }} Events
                                </span>
                            </div>

                            {{-- Events Navbar --}}
                            @include('navbars.events')

                            {{-- Events --}}
                            <ul class="list-group list-group-flush mb-4 shadow-sm">
                                @forelse($events as $event)
                                    <li class="list-group-item p-4 d-md-flex">

                                        <div class="image mr-3 mt-1">
                                            <a href="{{ route('discover.events.show', $event->slug) }}">
                                                @if ($event->image == '')
                                                     <div class="logo-is-contained bg-brains rounded">
                                                        <img src="{{ asset('images/icons/events.svg') }}" alt="{{ $event->name }}">
                                                    </div>
                                                @else
                                                    <div class="logo-is-contained" style="background-image: url('/storage/{{ $event->image }}');"></div>
                                                @endif
                                            </a>
                                        </div>

                                        <div class="text">
                                            <p class="lead mb-1">
                                                <a href="{{ route('discover.events.show', $event->slug) }}">{{ $event->name }}</a>
                                            </p>

                                            <p class="font-size-large mb-1">
                                                <span class="text-danger"><i class="fad fa-calendar"></i></span>
                                                {{ \Carbon\Carbon::parse($event->start_date)->format('M d, Y') }}
                                            </p>

                                            @if($event->eventTypes->count() > 0)
                                                <p class="mb-1 truncate-this-xl">
                                                    <span class="text-quaternary"><i class="fad fa-list-ul"></i></span>
                                                    @foreach ($event->eventTypes as $type)
                                                        {{ $type->name }}@if (!$loop->last) &bull; @endif
                                                    @endforeach
                                                </p>
                                            @endif

                                            @if($event->focus->count() > 0)
                                                <p class="mb-1 truncate-this-xl">
                                                    <span class="text-secondarydark"><i class="fad fa-flask"></i></span>
                                                    @foreach ($event->focus as $focus)
                                                        {{ $focus->name }}@if (!$loop->last) &bull; @endif
                                                    @endforeach
                                                </p>
                                            @endif

                                            @if($event->locations->count() > 0)
                                                <p class="mb-1 truncate-this-xl">
                                                    <span class="text-info"><i class="fad fa-globe-stand"></i></span>
                                                    @foreach ($event->locations as $location)
                                                        {{ $location->name }}@if (!$loop->last) &bull; @endif
                                                    @endforeach
                                                </p>
                                            @endif

                                            @if($event->companies->count() > 0)
                                                <p class="mb-1 truncate-this-xl">
                                                    <span class="text-quaternary"><i class="fad fa-briefcase"></i></span>
                                                    @foreach ($event->companies as $company)
                                                        {{ $company->name }}@if (!$loop->last) &bull; @endif
                                                    @endforeach
                                                </p>
                                            @endif

                                        </div>

                                    </li>

                                @empty
                                    <li class="list-group-item">
                                        <p class="lead mb-0">
                                            No events match your search criteria.
                                        </p>
                                    </li>
                                @endforelse
                            </ul>

                            {{ $events->links() }}
                        </div>
                    </div>

                </div>

                @include('discover.includes.discover-footer-content')

            </main>

        </div>

    </div>

@endsection
