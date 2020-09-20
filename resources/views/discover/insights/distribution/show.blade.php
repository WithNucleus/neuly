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

    <div class="row">

        @include('sidebars.primary')

        <main id="index-main" role="main" class="col-lg-9 col-xl-10 ml-auto">
            @include('discover.includes.status-messages')

            <div class="row">

                <div class="col-12">
                    <div class="full-width-show-view">

                        <div class="page-title-default d-md-flex justify-content-between">
                            <h1 class="mb-0 mr-5">Clinical Trial distribution by country</h1>
                        </div>

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
                    </div>
                </div>
            </div>
        </main>
        <script type="text/javascript" src="{{ asset('assets/maps/world.js') }}"></script>
        <script>
            var countries = {!! json_encode($countriesByCode) !!}
            $(function(){
                $('#world-distribution-map').vectorMap({
                    map: 'world_merc',
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
    </div>
@endsection

