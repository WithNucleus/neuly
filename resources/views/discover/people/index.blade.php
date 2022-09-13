@extends('layouts.app')

@section('body-class', 'page-people bg-light')

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
                        'People' => false
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
                                <h1 class="mb-0 mr-5">People</h1>

                                <span class="lead-smaller align-self-end pb-1">
                                    Showing {{ $people->total() }} People
                                </span>
                            </div>

                            {{-- Sorting --}}
                            @isset($sort)
                                <div class="sort-container font-size-small mt-3 mb-3">
                                    <strong class="text-uppercase mr-3 text-black-50">Sort by:</strong>
                                    <div class="d-inline sort-name text-uppercase">

                                        @include('discover.includes.filters.sort-button-default', [
                                            'asc' => 'date',
                                            'desc' => '-date',
                                            'label' => 'Date Added'
                                        ])

                                        @include('discover.includes.filters.sort-button', [
                                            'asc' => 'name',
                                            'desc' => '-name',
                                            'label' => 'Name'
                                        ])

                                    </div>
                                </div>
                            @endisset

                            {{-- Filters --}}
                            <?php if (
                                isset($filters_location) && $filters_location OR
                                isset($filters_company_name) && $filters_company_name OR
                                isset($filters_focuses) && $filters_focuses OR
                                isset($filters_type) && $filters_type
                                ) : ?>
                            <div class="current-filter-list font-size-small align-self-end border-bottom mb-3 pb-1">
                                <strong class="text-uppercase mr-3 text-black-50">Current Filters:</strong>

                                <?php if (isset($filters_type) && $filters_type) : ?>
                                        <span class="mr-3">
                                            <i class="fad fa-briefcase text-quaternary"></i>
                                            @foreach ($filters_type as $type)
                                                {{ $type }}
                                                @if (!$loop->last) <strong class="text-black-50">/</strong> @endif
                                            @endforeach
                                        </span>
                                <?php endif; ?>

                                <?php if (isset($filters_location) && $filters_location) : ?>
                                        <span class="mr-3">
                                            <i class="fad fa-map-marker-alt text-info"></i>
                                            @foreach ($filters_location as $location)
                                                {{ $location }}
                                                @if (!$loop->last) <strong class="text-info">/</strong> @endif
                                            @endforeach
                                        </span>
                                <?php endif; ?>

                                <?php if (isset($filters_company_name) && $filters_company_name) : ?>
                                        <span class="mr-3">
                                            <i class="fad fa-building text-secondarydark"></i>
                                            @foreach ($filters_company_name as $company)
                                                {{ $company }}
                                                @if (!$loop->last) <strong class="text-black-50">/</strong> @endif
                                            @endforeach
                                        </span>
                                <?php endif; ?>

                                <?php if (isset($filters_focuses) && $filters_focuses) : ?>
                                <span class="mr-3">
                                            <i class="fad fa-flask text-secondarydark"></i>
                                            @foreach ($filters_focuses as $focus)
                                        {{ $focus }}
                                        @if (!$loop->last) <strong class="text-black-50">/</strong> @endif
                                    @endforeach
                                        </span>
                                <?php endif; ?>

                            </div>
                            <?php endif; ?>

                            {{-- People --}}
                            <ul class="list-group list-group-flush mb-4 shadow-sm">
                                @forelse($people as $person)
                                    <li class="list-group-item p-4 d-md-flex">

                                        <div class="image mr-3">
                                            @if($person->entityImageUrl)
                                                <div class="person-photo-small shadow-sm" style="background-image: url('{{ $person->entityImageUrl }}');">
                                                    <span class="sr-only">{{ $person->name }}</span>
                                                </div>
                                            @else
                                                <img src="{{ asset('images/person-blank.png') }}" class="person-photo-small shadow-sm" alt="{{ $person->name }}">
                                            @endif
                                        </div>

                                        <div class="text">
                                            <p class="lead-smaller mb-1 mt-1">
                                                <a href="{{ route('discover.people.show', $person->slug) }}">{{ $person->name }}</a>
                                            </p>

                                            @if($person->locations->count() > 0)
                                                <p class="mb-1 truncate-this-xl">
                                                    <span class="text-info"><i class="fad fa-globe-stand"></i></span>
                                                    @foreach ($person->locations as $location)
                                                        {{ $location->name }}@if (!$loop->last) &bull; @endif
                                                    @endforeach
                                                </p>
                                            @endif

                                            @if($person->companies->count() > 0)
                                                <p class="mb-1 truncate-this-xl">
                                                    <span class="text-quaternary"><i class="fad fa-briefcase"></i></span>
                                                    @foreach ($person->companies as $company)
                                                        {{ $company->name }}@if (!$loop->last) &bull; @endif
                                                    @endforeach
                                                </p>
                                            @endif

                                            @if($person->research->count() > 0)
                                                <p class="mb-1 truncate-this-xl">
                                                    <span class="text-primary"><i class="fad fa-microscope"></i></span>
                                                    @foreach ($person->research as $article)
                                                        {{ $article->name }}@if (!$loop->last) &bull; @endif
                                                    @endforeach
                                                </p>
                                            @endif

                                            @if($person->investors->count() > 0)
                                                <p class="mb-1 truncate-this-xl">
                                                    <span class="text-danger"><i class="fad fa-hands-usd"></i></span>
                                                    @foreach ($person->investors as $investor)
                                                        {{ $investor->name }}@if (!$loop->last) &bull; @endif
                                                    @endforeach
                                                </p>
                                            @endif

                                        </div>

                                    </li>

                                @empty
                                    <li class="list-group-item">
                                        <p class="lead mb-0">
                                            No people match your search criteria.
                                        </p>
                                    </li>
                                @endforelse
                            </ul>

                            {{ $people->links() }}
                        </div>
                    </div>

                </div>

                @include('discover.includes.discover-footer-content')

            </main>

        </div>

    </div>

    @include('discover.includes.limited-access-modal')
@endsection
