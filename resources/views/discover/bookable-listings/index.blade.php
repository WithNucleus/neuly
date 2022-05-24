@extends('layouts.app')

@section('body-class', 'page-practitioners bg-light')

@section('content')

    @include('navbars.primary')

    <div class="container-fluid text-center">

        <div id="practitioners-page" class="mx-auto px-lg-5 container text-left" style="max-width: 1500px" data-page-url="{{ route('discover.bookable-listing.practitioners') }}">

            @include('discover.includes.status-messages')

            <h1 class="mt-3 mb-4 text-center">Find a Practitioner</h1>

            <div id="filter-container-type" class="my-4 d-sm-flex align-items-center justify-content-center flex-wrap">
                <div class="font-weight-bold lead mr-3">Care Type</div>
                @foreach($filterTypeOptions as $typeOption)
                    <div class="custom-control custom-checkbox mr-3 d-flex align-items-center lead">
                        <input type="checkbox" class="custom-control-input filter-type"
                               id="filterType-{{ $typeOption }}" value="{{ $typeOption }}" @if (in_array($typeOption, $filterTypes)) checked @endif>
                        <label class="custom-control-label" for="filterType-{{ $typeOption }}">{{ $typeOption }}</label>
                    </div>
                @endforeach
            </div>

            <div class="d-flex align-items-center flex-wrap mx-auto" style="max-width: 1024px">

                <div id="filter-container-location" class="d-flex align-items-center mr-4 my-2 flex-grow-1">
                    <button id="find-me" class="btn btn-info mr-4"><i class="fas fa-map-marked-alt"></i> Use Geolocation</button>
                    <div class="flex-grow-1">
                        <div id="autocomplete"></div>
                    </div>
                </div>

                <div id="filter-container-distance" class="d-flex align-items-center my-2 mr-3">
                    <label for="filter-distance" class="font-weight-bold mr-2 mb-0 d-block text-nowrap">Distance (miles)</label>
                    <select id="filter-distance" class="custom-select">
                        @foreach ($filterDistanceOptions as $distanceOption)
                            <option value="{{ $distanceOption }}" @if($filterDistance == $distanceOption) selected @endif>{{ $distanceOption }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <button id="reset-filters" class="btn btn-link btn-sm">Reset Filters</button>
                </div>
            </div>

            <div>
                <input type="hidden" name="locationName" id="locationName" value="{{ $locationName }}">
                <input type="hidden" name="locationLatitude" id="locationLatitude" value="{{ $filterLatitude }}">
                <input type="hidden" name="locationLongitude" id="locationLongitude" value="{{ $filterLongitude }}">
            </div>

            <div class="my-4 lead d-flex justify-content-between mx-auto">
                <div id="location-search-status">
                    @if ($locationSearch == true)
                        Searching within {{ $filterDistance }} miles of {{ $locationName }}
                    @endif
                </div>

                <div class="align-self-end">
                    {{ $bookableListings->total() }} Results
                </div>
            </div>

            <div id="loading-results" style="display: none">
                <div class="p-5 d-flex align-items-center justify-content-center"><i class="fas fa-spinner fa-spin fa-3x text-primary"></i></div>
            </div>

            <div id="error-results" style="display: none">
                <div class="alert alert-danger alert-dismissible fade show mb-5" role="alert">
                    <p class="lead">
                        We're unable to retrieve your location. Please check your location access settings and enable Neuly.
                    </p>
                    <button type="button" id="hide-no-location" class="close" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>

            <div id="bookable-list" class="row">
                @forelse($bookableListings as $bookableListing)
                    <div class="col-12 col-md-6 col-xl-4 mb-5">
                        <div class="card shadow-sm h-100 p-4 d-flex flex-grow-1">
                            <a href="{{ route('discover.bookable-listing.show', $bookableListing->slug) }}" class="text-decoration-none d-flex flex-column justify-content-between flex-grow-1">
                                <div class="mb-3">
                                    <div class="bookable-image" style="background-image: url('{{ $bookableListing->image }}');"></div>
                                    <h2 class="h5 mt-3 text-center">
                                        {{ $bookableListing->name }}
                                    </h2>
                                </div>
                                <div>
                                    <div class="text-center">
                                        @if($bookableListing->company_branch_id != '')
                                            <address class="mb-1 text-dark">
                                                {!! $bookableListing->companyBranch->fullAddress !!}
                                            </address>
                                            @if ($bookableListing->companyBranch->phone != '')
                                                <span class="d-block text-dark">
                                                    <i class="fa fa-phone-square-alt mr-1 text-info"></i>{{ $bookableListing->companyBranch->phone }}
                                                </span>
                                            @endif
                                        @endif

                                        <address class="text-dark">
                                            @if($bookableListing->address != '')
                                                <span class="d-block">{{$bookableListing->address }}</span>
                                            @endif
                                            @if ($bookableListing->city != '')
                                                <span class="d-block">{{ $bookableListing->city }}</span>
                                            @endif
                                        </address>
                                    </div>
                                    <div class="text-muted lead-smaller d-flex justify-content-center flex-wrap">
                                        <span class="mx-4">
                                            {{ ucwords($bookableListing->type) }}
                                        </span>
                                        @if ($locationSearch == true)
                                            <span class="mx-4">{{ number_format($bookableListing->distance, 2) }} miles</span>
                                        @endif
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-12 card shadow-sm h-100 p-5">
                        <p class="lead mb-0 text-center">
                            No care practitioners match your search criteria.
                        </p>
                    </div>
                @endforelse
            </div>

            {{ $bookableListings->links() }}

            @include('discover.includes.discover-footer-content')

        </div>

    </div>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@opencage/geosearch-bundle/dist/css/autocomplete-theme-classic.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/@opencage/geosearch-bundle" type="text/javascript"></script>
    <script src="{{ mix('js/practitioners.js') }}" type="text/javascript"></script>

@endsection
