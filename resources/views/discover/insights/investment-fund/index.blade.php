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
                        'Insights' => route('discover.insights'),
                        'Investment Funds' => false,
                    ]
                ])

            </div>
        </div>
    </div>

    <div class="container-fluid">
        <main id="show-main" role="main" class="col-12">
            @include('discover.includes.status-messages')

            <div class="investment-funds-container bg-white shadow-sm position-relative">
                <div id="chart-controls" class="d-flex justify-content-between p-2">
                    <div>
                        <a href="{{ route('insights.investment-funds') }}" class="btn btn-sm mb-2 {{ ($filter == 'top-five') ? 'btn-dark' : 'btn-primary' }}">Top 5 Investors</a>
                        <a href="{{ route('insights.investment-funds') }}?top-ten" class="btn btn-sm mb-2 {{ ($filter == 'top-ten') ? 'btn-dark' : 'btn-primary' }}">Top 10 Investors</a>
                        <a href="{{ route('insights.investment-funds') }}?all" class="btn btn-sm mb-2 {{ ($filter == 'all') ? 'btn-dark' : 'btn-primary' }}">All Investors</a>
                    </div>
                    <div>
                        <a href="{{ route('insights.investment-funds') }}" id="resetZoom" class="btn btn-secondarydark btn-sm mb-2"><i class="fad fa-search-plus"></i> Reset Zoom</a>
                        <a href="{{ route('insights.investment-funds') }}" id="expandAll" class="btn btn-secondarydark btn-sm mb-2"><i class="fad fa-expand"></i> Expand All</a>
                        <a href="{{ route('insights.investment-funds') }}" id="collapseAll" class="btn btn-secondarydark btn-sm mb-2"><i class="fad fa-compress"></i> Collapse All</a>
                    </div>
                </div>
                <div id="investmentFundChart"></div>
            </div>

        </main>
    </div>
@endsection

@section('after_scripts')
    <script src="https://cdn.amcharts.com/lib/4/core.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/plugins/forceDirected.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>

    <style>
        #investmentFundChart {
            width: 100%;
            height: 1024px;
            max-width:100%;
        }

        @media (min-width: 768px) {
            #investmentFundChart {
                height: 75vh;
            }
        }

        .ampopup-content {
            background: #fff;
            box-shadow: 0 .125rem .25rem rgba(0,0,0,.075);
            min-width: 220px;
            text-align: center;
        }
    </style>

    <script>
        am4core.ready(function() {

            am4core.useTheme(am4themes_animated);

            var chart = am4core.create("investmentFundChart", am4plugins_forceDirected.ForceDirectedTree);

            var investorSeries = chart.series.push(new am4plugins_forceDirected.ForceDirectedSeries());
            investorSeries.dataFields.linkWith = "linkWith";
            investorSeries.dataFields.name = "name";
            investorSeries.dataFields.id = "name";
            investorSeries.dataFields.value = "value";
            investorSeries.dataFields.children = "children";

            investorSeries.fontSize = 8;
            investorSeries.linkWithStrength = 0;

            var nodeTemplate = investorSeries.nodes.template;
            nodeTemplate.tooltipText = "{name}";
            nodeTemplate.fillOpacity = 1;
            nodeTemplate.label.hideOversized = true;
            nodeTemplate.label.truncate = true;

            var linkTemplate = investorSeries.links.template;
            linkTemplate.strokeWidth = 2;

            var linkHoverState = linkTemplate.states.create("hover");
            linkHoverState.properties.strokeOpacity = 1;
            linkHoverState.properties.strokeWidth = 3;

            nodeTemplate.events.on("over", function (event) {
                var dataItem = event.target.dataItem;
                dataItem.childLinks.each(function (link) {
                    link.isHover = true;
                })
            });

            nodeTemplate.events.on("out", function (event) {
                var dataItem = event.target.dataItem;
                dataItem.childLinks.each(function (link) {
                    link.isHover = false;
                })
            });

            // logos
            investorSeries.nodes.template.circle.disabled = true;
            var icon = investorSeries.nodes.template.createChild(am4core.Image);
            icon.propertyFields.href = "image";
            icon.horizontalCenter = "middle";
            icon.verticalCenter = "middle";

            if (window.innerWidth < 768) {
                icon.width = 30;
                icon.height = 30;
                investorSeries.maxLevels = 1;
            } else if(window.innerWidth < 1600) {
                icon.width = 40;
                icon.height = 40;
            } else {
                icon.width = 60;
                icon.height = 60;
            }

            investorSeries.data = {!! $chartData !!};

            // on data item click
            investorSeries.nodes.template.events.on("hit", function(event) {
                event.target.isActive = true;
                chart.zoomToDataItem(event.target.dataItem, 2, false);

                if (event.target.dataItem.dataContext.type == 'company') {

                    // setup modal content
                    let modalContent = "<img src='" + event.target.dataItem.dataContext.image + "' alt='' width='140' class='mx-auto mb-2'><br>";

                    modalContent += '<p class="lead text-center"><strong>' + event.target.dataItem.dataContext.name + '</strong></p>';
                    modalContent += '<p class="text-left"><i class="fad fa-building text-quaternary fa-fw"></i> ' + event.target.dataItem.dataContext.ownership + '<br>';

                    modalContent += '<i class="fad fa-hands-usd fa-fw text-info"></i> ' + event.target.dataItem.dataContext.investors_count;

                    if (event.target.dataItem.dataContext.investors_count === 1) {
                        modalContent += ' Investor';
                    } else {
                        modalContent += ' Investors';
                    }

                    modalContent += '<br><i class="fad fa-flask text-secondarydark fa-fw"></i> ' + event.target.dataItem.dataContext.focus_list;

                    modalContent += '</p><p class="text-center mb-0">';
                    modalContent += '<a href="' + event.target.dataItem.dataContext.chart_url + '" class="btn btn-sm btn-primary mr-3">View More</a>';
                    modalContent += '<a href="' + event.target.dataItem.dataContext.listing_url + '" class="btn btn-sm btn-dark">View Listing</a></p>';

                    chart.openModal(modalContent);
                }
            });

            // chart filter
            let chartFilter = '{{ $filter }}';

            // start collapsed
            if (chartFilter === 'all') {
                investorSeries.maxLevels = 1;
            }

            if (chartFilter !== 'all') {
                // Close other nodes when one is opened
                investorSeries.nodes.template.events.on("hit", function(ev) {
                    var targetNode = ev.target;
                    if (targetNode.isActive) {
                        investorSeries.nodes.each(function(node) {
                            if (targetNode !== node && node.isActive && targetNode.dataItem.level == node.dataItem.level) {
                                node.isActive = false;
                            }
                        });
                    }
                });
            }

            investorSeries.centerStrength = 1;
            chart.zoomable = true;

            // Custom Chart Controls
            let resetZoomTrigger = document.getElementById('resetZoom');
            resetZoomTrigger.addEventListener('click', function(event){
                event.preventDefault();
                chart.zoomOut();
            });

            let expandAllTrigger = document.getElementById('expandAll');
            expandAllTrigger.addEventListener('click', function(event){
                event.preventDefault();
                investorSeries.nodes.each(function(node) {
                    node.isActive = true;
                });
                chart.zoomOut();
            });

            let collapseAllTrigger = document.getElementById('collapseAll');
            collapseAllTrigger.addEventListener('click', function(event){
                event.preventDefault();
                investorSeries.nodes.each(function(node) {
                    node.isActive = false;
                });
                chart.zoomOut();
            });

        }); // end am4core.ready()
    </script>
@endsection
