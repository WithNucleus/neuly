@extends('layouts.app')

@section('body-class', 'page-search bg-light')

@section('content')

    @include('navbars.primary')

    <div class="container-fluid">
        <div class="row">
            <div class="col-12 navbar-tabs-container">
                @include('navbars.tabs')
                @include('navbars.tabs-mobile')
            </div>
        </div>

        <div class="row">
            <div class="col-12 breadcrumbs-container bg-white shadow-sm">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="/">
                                Home
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            Searching
                        </li>
                        <li class="breadcrumb-item">
                            @if ($term == '')
                                Everything
                            @else
                                "{{ $term }}"
                            @endif
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <main id="index-main" role="main" class="mt-2 mt-lg-5 col-lg-9 col-xl-8 mx-auto">
        <div class="row">
            <div class="col-12">
                @if ($term == '')
                    <h1>Discover {{ config('app.name', 'Neuly') }}</h1>
                @else
                    <h1>You are searching for "{{ $term }}"</h1>
                @endif
            </div>
        </div>

        <div class="d-flex flex-column">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4 shadow-sm">
                        <div class="card-header lead lead">
                            <span class="text-danger"><i class="fad fa-building"></i></span> Organizations
                        </div>
                        <div class="card-body">
                            @if ($organizations->count() > 0)
                                <div class="card-deck">
                                    @foreach($organizations as $organization)
                                        <div class="card">
                                            <div class="card-body text-center d-flex justify-content-center align-items-center">
                                                <a href="{{ route('discover.organizations.show', ['slug' => $organization->slug]) }}">
                                                    @if($organization->logo != '')
                                                        <img src="/storage/{{ $organization->logo }}" alt="{{ $organization->name }}" class="company-logo mx-auto" alt="{{$organization->name}}">
                                                    @endif
                                                </a>
                                            </div>
                                            <div class="card-footer bg-white text-center">
                                                <a href="{{ route('discover.organizations.show', ['slug' => $organization->slug]) }}" class="lead text-primary">{{ $organization->name }}</a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <p class="text-center mt-3 mb-0">
                                    @if ($organizations->count() > 2 AND $term != '')
                                        <a href="{{ route('search.organizations').'/'.$term }}" class="btn btn-sm btn-dark shadow-sm mr-1">Show more...</a>
                                    @endif 
                                    <a href="{{ route('discover.organizations') }}" class="btn btn-sm btn-outline-dark shadow-sm">See all organizations</a>
                                </p>
                            @else
                                No organization matched your search criteria.
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4 shadow-sm">
                        <div class="card-header lead">
                            <span class="text-danger"><i class="fad fa-tags"></i></span> Focus
                        </div>
                        <div class="card-body">
                            @if ($focus->count() > 0)
                                <ul class="list-group list-group-flush">
                                    @foreach($focus as $item)
                                        <li class="list-group-item @if ($loop->last)border-bottom-0 @endif">
                                            <a href="{{ route('discover.focus.show', ['slug' => $item->slug]) }}">{{ $item->name }}</a>
                                        </li>
                                    @endforeach
                                    <li class="list-group-item text-center">
                                        @if ($focus->count() > 2 AND $term != '')
                                            <a href="{{ route('search.focus').'/'.$term }}" class="btn btn-sm btn-dark shadow-sm mr-1">Show more...</a>
                                        @endif
                                        <a href="{{ route('discover.focus') }}" class="btn btn-sm btn-outline-dark shadow-sm">See all focus categories</a>
                                    </li>
                                </ul>
                            @else
                                No focus matched your search criteria.
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card mb-4 shadow-sm">
                        <div class="card-header lead">
                            <span class="text-danger"><i class="fad fa-users"></i></span> People
                        </div>
                        <div class="card-body">
                            @if ($people->count() > 0)
                                <ul class="list-group list-group-flush">
                                    @foreach($people as $person)
                                        <li class="list-group-item @if ($loop->last)border-bottom-0 @endif">
                                            <a href="{{ route('discover.people.show', ['slug' => $person->slug]) }}">{{ $person->name }}</a>
                                        </li>
                                    @endforeach
                                    <li class="list-group-item text-center">
                                        @if ($people->count() > 2 AND $term != '')
                                            <a href="{{ route('search.people').'/'.$term }}" class="btn btn-sm btn-dark shadow-sm mr-1">Show more...</a> 
                                        @endif
                                        <a href="{{ route('discover.people') }}" class="btn btn-sm btn-outline-dark shadow-sm">See all people</a>
                                    </li>
                                </ul>
                            @else
                                No people matched your search criteria.
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card mb-4 shadow-sm">
                        <div class="card-header lead">
                            <span class="text-danger"><i class="fad fa-hands-usd"></i></span> Investors
                        </div>
                        <div class="card-body">
                            @if ($investors->count() > 0)
                                <ul class="list-group list-group-flush">
                                    @foreach($investors as $investor)
                                        <li class="list-group-item  @if ($loop->last)border-bottom-0 @endif">
                                            <a href="{{ route('discover.investors.show', ['slug' => $investor->slug]) }}">{{ $investor->name }}</a>
                                        </li>
                                    @endforeach
                                    <li class="list-group-item text-center">
                                        @if ($investors->count() > 2 AND $term != '')
                                            <a href="{{ route('search.investors').'/'.$term }}" class="btn btn-sm btn-dark shadow-sm mr-1">Show more...</a>
                                        @endif
                                        <a href="{{ route('discover.investors') }}" class="btn btn-sm btn-outline-dark shadow-sm">See all investors</a>
                                    </li>
                                </ul>
                            @else
                                No investors matched your search criteria.
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card mb-4 shadow-sm">
                        <div class="card-header lead">
                            <span class="text-danger"><i class="fad fa-microscope"></i></span> Research
                        </div>
                        <div class="card-body">
                            @if ($research->count() > 0)
                                <ul class="list-group list-group-flush">
                                    @foreach($research as $publication)
                                        <li class="list-group-item @if ($loop->last)border-bottom-0 @endif">
                                            <a href="{{ route('discover.research.show', ['slug' => $publication->slug]) }}">{{ $publication->name }}</a>
                                        </li>
                                    @endforeach
                                    <li class="list-group-item text-center">
                                        @if ($research->count() > 2 AND $term != '')
                                            <a href="{{ route('search.research').'/'.$term }}" class="btn btn-sm btn-dark shadow-sm mr-1">Show more...</a>
                                        @endif
                                        <a href="{{ route('discover.research') }}" class="btn btn-sm btn-outline-dark shadow-sm">See all research</a>
                                    </li>
                                </ul>
                            @else
                                No research matched your search criteria.
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card mb-4 shadow-sm">
                        <div class="card-header lead">
                            <span class="text-danger"><i class="fad fa-map-pin"></i></span> Locations
                        </div>
                        <div class="card-body">
                            @if ($locations->count() > 0)
                                <ul class="list-group list-group-flush">
                                    @foreach($locations as $location)
                                        <li class="list-group-item @if ($loop->last)border-bottom-0 @endif">
                                            <a href="{{ route('discover.locations.show', ['slug' => $location->slug]) }}">{{ $location->name }}</a>
                                        </li>
                                    @endforeach
                                    <li class="list-group-item text-center">
                                        @if ($locations->count() > 2 AND $term != '')
                                            <a href="{{ route('search.locations').'/'.$term }}" class="btn btn-sm btn-dark shadow-sm mr-1">Show more...</a>
                                        @endif
                                        <a href="{{ route('discover.locations') }}" class="btn btn-sm btn-outline-dark shadow-sm mr-2">See all locations</a>
                                    </li>
                                </ul>
                            @else
                                No loations matched your search criteria.
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card mb-4 shadow-sm">
                        <div class="card-header lead">
                            <span class="text-danger"><i class="fad fa-calendar"></i></span> Events
                        </div>
                        <div class="card-body">
                            @if ($events->count() > 0)
                                <ul class="list-group list-group-flush">
                                    @foreach($events as $event)
                                        <li class="list-group-item @if ($loop->last)border-bottom-0 @endif">
                                            <a href="{{ route('discover.events.show',['slug' => $event->slug]) }}">{{ $event->name }}</a>
                                        </li>
                                    @endforeach
                                    <li class="list-group-item text-center">
                                        @if ($events->count() > 2 AND $term != '')
                                            <a href="{{ route('search.events').'/'.$term }}" class="btn btn-sm btn-dark shadow-sm mr-1">Show more...</a>
                                        @endif
                                        <a href="{{ route('discover.events') }}" class="btn btn-sm btn-outline-dark shadow-sm">See all events</a>
                                    </li>
                                </ul>
                            @else
                                No events matched your search criteria.
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card mb-4 shadow-sm">
                        <div class="card-header lead">
                            <span class="text-danger"><i class="fad fa-briefcase"></i></span> Jobs
                        </div>
                        <div class="card-body">
                            @if ($jobs->count() > 0)
                                <ul class="list-group list-group-flush">
                                    @foreach($jobs as $job)
                                        <li class="list-group-item @if ($loop->last)border-bottom-0 @endif">
                                            <a href="{{ route('discover.jobs.show', ['slug' => $job->slug]) }}">{{ $job->job_title }}</a>
                                        </li>
                                    @endforeach
                                    <li class="list-group-item text-center">
                                        @if ($jobs->count() > 2 AND $term != '')
                                            <a href="{{ route('search.jobs').'/'.$term }}" class="btn btn-sm btn-dark shadow-sm mr-1">Show more...</a>
                                        @endif
                                        <a href="{{ route('discover.jobs') }}" class="btn btn-sm btn-outline-dark shadow-sm">See all jobs</a>
                                    </li>
                                </ul>
                            @else
                                No jobs matched your search criteria.
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('footers.mini')
    </main>

@endsection