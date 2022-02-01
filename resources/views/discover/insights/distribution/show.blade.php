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

                <h1>Clinical Trial Distribution by Country</h1>

                <div class="row">
                    <div class="col-12">
                        <div id="world-distribution-map" style="width: 100%; height: 600px"></div>
                    </div>
                </div>
                @if(Route::is('insights.distribution.countries.show'))
                    @include('discover.insights.distribution.countries')
                @endif
                @if(Route::is('insights.distribution.countries.focus.show'))
                    @include('discover.insights.distribution.focus-by-countries')
                @endif
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
                onRegionTipShow: function(e, el, code){
                    var total = 0;

                    if(countries[code] !== undefined)
                    {
                        total = countries[code].total;
                    }

                    el.html(el.html()+' (Total Trials - '+total+')');
                }
            });
        });
    </script>

    @include('discover.includes.limited-access-modal')
@endsection

