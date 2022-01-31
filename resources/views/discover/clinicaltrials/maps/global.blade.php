@extends('layouts.app')

@section('body-class', 'bg-light')

@section('content')

    @include('navbars.primary')

    <div class="container-fluid">

        <div class="row">
            <div class="col-12 navbar-tabs-container">
                @include('navbars.tabs')
            </div>
        </div>

        <div class="row">
            @include('navbars.tabs-mobile')
        </div>

        <div class="row">
            <div class="col-12 breadcrumbs-container bg-white shadow-sm">

                @include('navbars.breadcrumb', [
                    'items' => [
                        'Clinical Trials' => false,
                    ]
                ])

            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            @include('sidebars.primary')

            <main id="index-main" role="main" class="col-lg-9 col-xl-10 ml-auto">
                @include('discover.includes.status-messages')

                <div class="d-flex align-items-center justify-content-between">
                    <h1>Clinical Trials Map</h1>

                    <div class="switch-view ml-auto mt-2 mb-3 my-md-0 d-flex">
                        <div class="btn-group" role="group" aria-label="Switch Location view">
                            <a href="{{ route('discover.locations') }}" class="btn btn-outline-primary" title="List View" data-toggle="tooltip" data-placement="top">
                                <i class="fad fa-list-ul fa-lg"></i>
                            </a>
                            <a href="{{ route('discover.locations.maps.global') }}" class="btn btn-primary" title="Map View" data-toggle="tooltip" data-placement="top">
                                <i class="fad fa-map"></i>
                            </a>
                        </div>
                        <div class="text-right">
                            <button id="open-full-screen-table" class="btn btn-link text-secondarydark" title="Open in Full Screen" data-toggle="tooltip" data-placement="left">
                                <i class="far fa-expand-arrows fa-lg"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <div style="margin-right: 2rem;">
                    <div class="resizable overflow-hidden" style="height: 600px;">
                        <div id="world-distribution-map" style="width: 100%; height: 100%;"></div>
                    </div>
                </div>

                <div id="resizable-fullscreen-table-container">
                    <button id="close-full-screen-table" class="btn d-none mb-3 btn-dark text-uppercase"><i class="fas fa-times"></i> Close</button>
                    <div class="position-relative">
                        <table id="resizable-table-with-x-borders" class="table table-striped bg-white border-0">
                            <thead class="font-size-large">
                            <th scope="col" class="sticky-top text-no-wrap bg-dark text-light">Country</th>
                            @foreach($filters_focus as $name)
                                <th scope="col" class="sticky-top text-no-wrap bg-dark text-light">{{ $name }}</th>
                            @endforeach
                            <th scope="col" class="sticky-top text-no-wrap bg-dark text-light">Total</th>
                            </thead>
                            <tbody>
                            @foreach($countriesByCode as $alpha2code => $item)
                                <tr>
                                    <td>
                                        {{ $item['name'] }}
                                    </td>
                                    @foreach($item['focus'] as $name => $value)
                                        <td>{{ $value }}</td>
                                    @endforeach
                                    <td><strong>{{ $item['total'] }}</strong></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <script type="text/javascript" src="{{ asset('assets/maps/world.js') }}"></script>
    <script>
        // Map
        var countries = {!! json_encode($countriesByCode) !!}

        var values = [];

        for(var index in countries) {
            values[index] = countries[index].total;
        }


        $('#world-distribution-map').vectorMap({
            map: 'world_merc',
            series: {
                regions: [{
                    values: values,
                    scale: ['#60c6a9', '#265dad'],
                    normalizeFunction: 'polynomial',
                    legend: {
                        vertical: true
                    }
                }]
            },
            onRegionTipShow: function(event, label, code){
                if(countries[code] !== undefined)
                {

                    var focus_entries = '';

                    for(var item in countries[code]['focus']) {
                        focus_entries += '<br><strong>' +item + ': ' + countries[code]['focus'][item] + '</strong>'
                    }

                    label.html(
                        '<strong>' + label.html() + '</strong>'
                        + focus_entries
                        + '<br><strong>Total: ' + countries[code].total + '</strong>'
                    );
                } else {
                    label.html(label.html());
                }
            },
            onRegionClick: function(event, code){
                var country = countries[code].country;
                if(countries[code] !== undefined) {
                    window.location.href = "/clinical-trials/map/" + country;

                }
            }
        });
    </script>

    @include('discover.includes.limited-access-modal')
@endsection
