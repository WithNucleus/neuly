@extends('layouts.app')

@section('head')
    @livewireStyles
@endsection

@section('body-class', 'page-pubco-index')

@section('content')

    @include('navbars.primary')

    <div class="container-fluid pt-4">
        <h1 class="text-center text-primary mb-3">Public Company Index</h1>

        <div id="psych-index" class="container-fluid">
            <div class="row">
                <div class="col-lg-4 mb-3 flex-wrap">
                    <div class="card h-100">
                        <div class="card-body shadow-sm">
                            <div class="qm-indexsummary">
                                <div data-qmod-tool="indexsummary" data-qmod-params='{ "symbol":"^GPI@PSY" }' class="qtool">
                                    <div class="ball-loader">
                                        <div class="ball-loader-ball ball1"></div>
                                        <div class="ball-loader-ball ball2"></div>
                                        <div class="ball-loader-ball ball3"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 mb-3 flex-wrap">
                    <div class="card  h-100">
                        <div class="card-body shadow-sm">
                            <div class="qm-wrap-interactivechart">
                                <div data-qmod-tool="interactivechart" data-qmod-params='{ "symbol":"^GPI@PSY", "chart":{ "colors":["#EE220C"], "upColor":"#88b640","downColor":"#0d7fa1", "chartType":"1" },"navigatorEnabled":true,"compareEnabled":false}' class="qtool">
                                    <div class="ball-loader">
                                        <div class="ball-loader-ball ball1"></div>
                                        <div class="ball-loader-ball ball2"></div>
                                        <div class="ball-loader-ball ball3"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 mb-3 flex-wrap">
                    <div class="card h-100">
                        <div class="card-body shadow-sm">
                            <div class="qm-wrap-indexconstituents">
                                <div data-qmod-tool="indexconstituents" data-qmod-params='{ "symbol":"^GPI@PSY","colVisible":[true,true,true,true,true,true,true,true,true,true,true,true,true,false]}' class="qtool">
                                    <div class="ball-loader">
                                        <div class="ball-loader-ball ball1"></div>
                                        <div class="ball-loader-ball ball2"></div>
                                        <div class="ball-loader-ball ball3"></div>
                                    </div>
                                </div>
                            </div>
                            <!-- Start of QuoteMedia Footer code -->
                            <p style="margin-bottom: 0;">
                                <span class="qmf-rt">RT</span>=Real-Time, <span class="qmf-non-rt">EOD</span>=End of Day, <span class="qmf-non-rt">PD</span>=Previous Day.
                            </p>
                            <!-- End of QuoteMedia Footer code -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script
          id="qmod"
          type="application/javascript"
          src="//qmod.quotemedia.com/js/qmodLoader.js"
          data-qmod-wmid="103638"
          data-qmod-env="app"
          async
          data-qmod-version=""
        ></script>
    </div>

    <link rel="stylesheet" href="{{ mix('css/index-qm.css') }}">

    @include('footers.full')

@endsection
