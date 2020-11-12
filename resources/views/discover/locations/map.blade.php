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
                        'Insights' => false,
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

                <h1>Locations Map</h1>

                <div class="row">
                    <div class="col-12">
                        <div id="world-distribution-map" style="width: 100%; height: 600px"></div>
                    </div>
                </div>
{{--                @if(Route::is('insights.distribution.countries.show') OR Route::is('discover.locations.map'))--}}
{{--                    @include('discover.insights.distribution.countries')--}}
{{--                @endif--}}
{{--                @if(Route::is('insights.distribution.countries.focus.show'))--}}
{{--                    @include('discover.insights.distribution.focus-by-countries')--}}
{{--                @endif--}}
                <table class="table table-striped mt-3">
                    <thead>
                    <th scope="col">Name</th>
                    <th scope="col">Organizations</th>
                    <th scope="col">People</th>
                    <th scope="col">Investors</th>
                    <th scope="col">Jobs</th>
                    <th scope="col">Events</th>
                    <th scope="col">Clinical Trials</th>
                    <th scope="col">Total</th>
                    </thead>
                    <tbody>
                    @foreach($countriesByCode as $alpha2code => $item)
                        <tr>
                            <td>{{ $item['country'] }}</td>
                            <td>{{ $item['total'] }}</td>
                            <td>{{ $item['companies'] }}</td>
                            <td>{{ $item['people'] }}</td>
                            <td>{{ $item['investors'] }}</td>
                            <td>{{ $item['jobs'] }}</td>
                            <td>{{ $item['events'] }}</td>
                            <td>{{ $item['clinicaltrials'] }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </main>
        </div>
    </div>
    <script type="text/javascript" src="{{ asset('assets/maps/world.js') }}"></script>
    <script>
        var countries = {!! json_encode($countriesByCode) !!}
        $(function(){
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
                        normalizeFunction: 'polynomial'
                    }]
                },
                onRegionTipShow: function(event, label, code){
                    var total = 0;

                    if(countries[code] !== undefined)
                    {
                        label.html(label.html() +
                            '<br>Organizations: ' + countries[code].companies +
                            '<br>People: ' + countries[code].people +
                            '<br>Investors: ' + countries[code].investors +
                            '<br>Jobs: ' + countries[code].jobs +
                            '<br>Events: ' + countries[code].events +
                            '<br>Clinical Trials: ' + countries[code].clinicaltrials +
                            '<br><strong>Total: ' + countries[code].total + '</strong>'
                        );
                    } else {
                        label.html(label.html());
                    }
                }
            });
        });
    </script>
@endsection

