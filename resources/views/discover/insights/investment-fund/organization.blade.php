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
                        'Insights' => route('discover.insights'),
                        'Investment Funds' => route('insights.investment-funds'),
                        $companyName => false
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

            let chart = am4core.create("investmentFundChart", am4plugins_forceDirected.ForceDirectedTree);

            let companySeries = chart.series.push(new am4plugins_forceDirected.ForceDirectedSeries());
            companySeries.dataFields.linkWith = "linkWith";
            companySeries.dataFields.name = "name";
            companySeries.dataFields.id = "name";
            companySeries.dataFields.value = "value";
            companySeries.dataFields.children = "children";

            companySeries.fontSize = 12;
            companySeries.linkWithStrength = 0;

            let investorTemplate = companySeries.nodes.template;
            investorTemplate.tooltipText = "{name}";
            investorTemplate.fillOpacity = 1;
            investorTemplate.label.hideOversized = true;
            investorTemplate.label.truncate = true;

            let investorLinkTemplate = companySeries.links.template;
            investorLinkTemplate.strokeWidth = 2;

            let investorLinkHoverState = investorLinkTemplate.states.create("hover");
            investorLinkHoverState.properties.strokeOpacity = 1;
            investorLinkHoverState.properties.strokeWidth = 3;

            investorTemplate.events.on("over", function (event) {
                let dataItem = event.target.dataItem;
                dataItem.childLinks.each(function (link) {
                    link.isHover = true;
                })
            });

            investorTemplate.events.on("out", function (event) {
                let dataItem = event.target.dataItem;
                dataItem.childLinks.each(function (link) {
                    link.isHover = false;
                })
            });

            // logos
            companySeries.nodes.template.circle.disabled = true;
            let investorIcon = companySeries.nodes.template.createChild(am4core.Image);
            investorIcon.propertyFields.href = "image";
            investorIcon.horizontalCenter = "middle";
            investorIcon.verticalCenter = "middle";

            if (window.innerWidth < 768) {
                investorIcon.width = 40;
                investorIcon.height = 40;
                companySeries.maxLevels = 1;
            } else if(window.innerWidth < 1600) {
                investorIcon.width = 60;
                investorIcon.height = 60;
            } else {
                investorIcon.width = 80;
                investorIcon.height = 80;
            }

            companySeries.data = {!! $chartData !!};

            // on data item click
            companySeries.nodes.template.events.on("hit", function(event) {

                if (event.target.dataItem.dataContext.listing_url !== '') {
                    event.target.isActive = true;
                    chart.zoomToDataItem(event.target.dataItem, 2, false);

                    // setup modal content
                    let modalContent = "<img src='" + event.target.dataItem.dataContext.image + "' alt='' width='140' class='mx-auto mb-2'><br>";

                    modalContent += '<p class="lead text-center mb-0"><strong>' + event.target.dataItem.dataContext.name + '</strong></p>';

                    modalContent += '</p><p class="text-center mb-0">';

                    if (event.target.dataItem.dataContext.chart_url !== '') {
                        modalContent += '<a href="' + event.target.dataItem.dataContext.chart_url + '" class="btn btn-sm btn-primary mr-3">View Chart</a>';
                    }

                    modalContent += '<a href="' + event.target.dataItem.dataContext.listing_url + '" class="btn btn-sm btn-dark">View Listing</a></p>';

                    chart.openModal(modalContent);
                }
            });

            chart.zoomable = true;
            chart.legend = new am4charts.Legend();

            // Custom Chart Controls
            let resetZoomTrigger = document.getElementById('resetZoom');
            resetZoomTrigger.addEventListener('click', function(event){
                event.preventDefault();
                chart.zoomOut();
            });

            let expandAllTrigger = document.getElementById('expandAll');
            expandAllTrigger.addEventListener('click', function(event){
                event.preventDefault();
                companySeries.nodes.each(function(node) {
                    node.isActive = true;
                });
                chart.zoomOut();
            });

            let collapseAllTrigger = document.getElementById('collapseAll');
            collapseAllTrigger.addEventListener('click', function(event){
                event.preventDefault();
                companySeries.nodes.each(function(node) {

                    if (node.dataItem.level === 0) {
                        node.isActive = true;
                    } else if(node.dataItem.level === 1) {
                        node.isActive = false;
                    } else {
                        node.isActive = false;
                    }
                });

                chart.zoomOut();
            });

        }); // end am4core.ready()
    </script>
@endsection
