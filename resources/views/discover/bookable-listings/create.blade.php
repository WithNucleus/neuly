@extends('layouts.app')

@section('body-class', 'page-practitioners bg-light')

@section('content')

    @include('navbars.primary')

    <div class="container-fluid text-center">

        <div id="practitioners-page" class="mx-auto px-lg-5 container text-left">

            <h1 class="mt-3 mb-4 text-center">Add a Care Listing</h1>

            <div class="mx-auto" style="max-width: 640px">
                @include('discover.includes.status-messages')
                <form action="{{ route('discover.bookable-listing.store') }}" method="post">
                    @csrf
                    <div class="row mb-4">
                        <div class="col-12 col-lg-8 offset-lg-2">
                            <label for="bookable_id" class="sr-only">Select a Care Provider {{ old('bookable_id') }}</label>
                            <select name="bookable_id" id="bookable_id" class="form-control select2" required>
                                <option selected disabled>Select a provider</option>
                                @foreach($organizations as $id => $name)
                                    <option value="organization-{{ $id }}" data-type="organization" @if(old('bookable_id') == "organization-" . $id) selected @endif>{{ $name }}</option>
                                @endforeach
                                @foreach($people as $id => $name)
                                    <option value="person-{{ $id }}" data-type="person" @if(old('bookable_id') == "person-" . $id) selected @endif>{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-12 col-lg-6">
                            <label for="name" class="font-weight-bold">Listing Name</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
                        </div>
                        <div class="col-12 col-lg-6">
                            <label for="type" class="font-weight-bold">Provider Type</label>
                            <select id="type" name="type" class="custom-select" required>
                                <option selected disabled></option>
                                @foreach($types as $type)
                                    <option value="{{ $type }}" @if(old('type') == $type) selected @endif>{{ $type }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-12 col-lg-6">
                            <label for="url" class="font-weight-bold">URL</label>
                            <input type="url" name="url" id="url" class="form-control" value="{{ old('url') }}">
                        </div>
                        <div class="col-12 col-lg-6">
                            <label for="phone" class="font-weight-bold">Phone</label>
                            <input type="tel" name="phone" id="phone" class="form-control" value="{{ old('phone') }}">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-12">
                            <p class="font-weight-bold mb-0">Location</p>
                        </div>
                        <div class="col-12 col-lg-6">
                            <input type="text" name="address" id="address" class="form-control" value="{{ old('address') }}">
                            <label for="address" class="d-block text-muted font-size-small">Address</label>
                        </div>

                        <div class="col-12 col-lg-6">
                            <div id="autocomplete"></div>
                            <label for="autocomplete" class="d-block text-muted font-size-small">City / Region / Country</label>
                        </div>
                    </div>

                    <div class="mb-4">
                        <div class="custom-control custom-checkbox lead">
                            <input type="checkbox" class="custom-control-input" id="virtual" name="virtual" value="1">
                            <label class="custom-control-label" for="virtual">We offer virtual / remote services</label>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-12">
                            <p class="font-weight-bold mb-0">Focus</p>
                        </div>
                        @foreach($focuses as $focusId => $focusName)
                            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" name="focus[{{ $focusId }}]" id="focus-{{ $focusId }}">
                                    <label class="custom-control-label" for="focus-{{ $focusId }}">{{ $focusName }}</label>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="row mb-4">
                        <div class="col-12">
                            <label for="description" class="font-weight-bold">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="5" required></textarea>
                        </div>
                    </div>

                    <div>
                        <input type="hidden" name="location_name" id="location_name" value="{{ old('location_name') }}">
                        <input type="hidden" name="latitude" id="latitude" value="{{ old('latitude') }}">
                        <input type="hidden" name="longitude" id="longitude" value="{{ old('longitude') }}">
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary btn-lg">Submit</button>
                    </div>
                </form>
            </div>

            @include('discover.includes.discover-footer-content')

        </div>

    </div>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@opencage/geosearch-bundle/dist/css/autocomplete-theme-classic.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/@opencage/geosearch-bundle" type="text/javascript"></script>
    {{-- select2 --}}
    <link href="{{ asset('packages/select2/dist/css/select2.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('packages/select2-bootstrap-theme/dist/select2-bootstrap.min.css') }}" rel="stylesheet"
          type="text/css"/>
    <script src="{{ asset('packages/select2/dist/js/select2.full.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            let careProvidersField = $('.select2').select2();

            careProvidersField.on('select2:select', function (e) {
                let data = e.params.data;
                let careProviderName = data.text;
                $('#name').val(careProviderName);
            });
        });

        const pageUrl = document.getElementById('practitioners-page').getAttribute('data-page-url');

        const locationSearchOptions = {
            key: "oc_gs_8jhgsf873gebvjsfhvkshkbghfun44",
            language: 'en'
        };

        const locationNameField = document.getElementById('location_name');
        const locationLatitudeField = document.getElementById('latitude');
        const locationLongitudeField = document.getElementById('longitude');

        const bookableListElement = document.getElementById('bookable-list');
        const loadingResult = document.getElementById('loading-results');
        const errorResult = document.getElementById('error-results');

        const handleLocationSearchResult = ({ item }) => {

            let locationName = item.formatted;
            let latitude = item.geometry.lat;
            let longitude = item.geometry.lng;

            locationNameField.value = locationName;
            locationLatitudeField.value = latitude;
            locationLongitudeField.value = longitude;
        };

        const locationSearchEvents = {
            onSelect: handleLocationSearchResult
        };

        opencage.algoliaAutocomplete({
            container: "#autocomplete",
            placeholder: "Search for places",
            plugins: [opencage.OpenCageGeoSearchPlugin(locationSearchOptions, locationSearchEvents)]
        });
    </script>
    <style>
        .select2-container .select2-selection--single,
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 3rem;
            font-size: 1.1rem;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 2.9rem;
        }

        .select2-container--default .select2-selection--single {
            border-color: #ced4da;
        }

        :root{
            --aa-search-input-height:37px;
            --aa-panel-border-color-rgb:141,145,201;
            --aa-panel-border-color-alpha:1.0;
            --aa-input-border-color-rgb:206,212,218;
            --aa-input-border-color-alpha:1.0;
            --aa-overlay-color-rgb:206,212,218;
            --aa-overlay-color-alpha:1.0;
            --aa-icon-color-rgb:26,136,101;
            --aa-icon-color-alpha:1;
            --aa-primary-color-rgb:69,74,145;
            --aa-primary-color-alpha:0.25;
        }

        .aa-SubmitButton:focus {
            outline: 0;
        }

        .aa-Label, .aa-LoadingIndicator {
            margin-bottom: 0;
        }
    </style>
    @include('discover.includes.limited-access-modal')
@endsection
