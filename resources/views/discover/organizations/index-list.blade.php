    @extends('layouts.app')

@section('body-class', 'page-companies bg-light')

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
                        'Companies' => false
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
                                <h1 class="mb-0 mr-5">Companies</h1>

                                <span class="lead-smaller align-self-end pb-1">
                                    Showing {{ $companies->total() }} Companies
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

                            </div>
                            <?php endif; ?>

                            {{-- Companies --}}
                            <ul class="list-group list-group-flush mb-4 shadow-sm">
                                @forelse($companies as $company)
                                    <li class="list-group-item p-4 d-md-flex">

                                        <div class="image mr-3">

                                            @if($company->entityImageUrl)
                                                <div class="company-logo-contained" style="background-image: url('{{ $company->entityImageUrl }}');">
                                                </div>
                                            @else
                                                <div class="company-logo-contained">
                                                    <img src="{{ asset('images/icons/organizations.svg') }}" alt="{{ $company->name }}">
                                                </div>
                                            @endif
                                        </div>

                                        <div class="text">
                                            <p class="lead-smaller mb-1 mt-1">
                                                <a href="{{ route('discover.organizations.show', $company->slug) }}">{{ $company->name }}</a>
                                            </p>

                                            @if($company->locations->count() > 0)
                                                <p class="mb-1 truncate-this-xl">
                                                    <span class="text-info"><i class="fad fa-globe-stand"></i></span>
                                                    @foreach ($company->locations as $location)
                                                        {{ $location->name }}@if (!$loop->last) &bull; @endif
                                                    @endforeach
                                                </p>
                                            @endif

                                            @if($company->focus->count() > 0)
                                                <p class="mb-1 truncate-this-xl">
                                                    <span class="text-quaternary"><i class="fad fa-flask"></i></span>
                                                    @foreach ($company->focus as $item)
                                                        {{ $item->name }}@if (!$loop->last) &bull; @endif
                                                    @endforeach
                                                </p>
                                            @endif

                                            @if($company->research->count() > 0)
                                                <p class="mb-1 truncate-this-xl">
                                                    <span class="text-primary"><i class="fad fa-microscope"></i></span>
                                                    @foreach ($company->research as $article)
                                                        {{ $article->name }}@if (!$loop->last) &bull; @endif
                                                    @endforeach
                                                </p>
                                            @endif

                                            @if($company->investors->count() > 0)
                                                <p class="mb-1 truncate-this-xl">
                                                    <span class="text-danger"><i class="fad fa-hands-usd"></i></span>
                                                    @foreach ($company->investors as $investor)
                                                        {{ $investor->name }}@if (!$loop->last) &bull; @endif
                                                    @endforeach
                                                </p>
                                            @endif

                                        </div>

                                    </li>

                                @empty
                                    <li class="list-group-item">
                                        <p class="lead mb-0">
                                            No companies match your search criteria.
                                        </p>
                                    </li>
                                @endforelse
                            </ul>

                            {{ $companies->links() }}
                        </div>
                    </div>

                </div>

                @include('discover.includes.discover-footer-content')

            </main>

        </div>

    </div>

    @include('discover.includes.limited-access-modal')
@endsection
