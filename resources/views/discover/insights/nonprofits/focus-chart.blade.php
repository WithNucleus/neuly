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

            <div class="pr-5 position-relative">
                <div id="nonProfitFocusChart"></div>
            </div>

        </main>
    </div>
@endsection

@section('after_scripts')
    <script src="https://cdn.amcharts.com/lib/4/core.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>

    <style>
        #nonProfitFocusChart {
            width: 100%;
            height: 1024px;
            max-width:100%;
        }

        @media (min-width: 768px) {
            #nonProfitFocusChart {
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

            let chart = am4core.create("nonProfitFocusChart", am4charts.TreeMap);
            chart.hiddenState.properties.opacity = 0; // this makes initial fade in effect

            chart.padding(0, 0, 0, 0);
            chart.data = {!! $chartData !!};

            // only one level visible initially
            chart.maxLevels = 1;

            // define data fields
            chart.dataFields.value = "value";
            chart.dataFields.name = "name";
            chart.dataFields.image = "image";
            chart.dataFields.url = "url";
            chart.dataFields.focus = "focus";
            chart.dataFields.location = "location";
            chart.dataFields.children = "children";
            chart.dataFields.type = "type";
            chart.homeText = "Non-Profits by Focus";

            // enable navigation
            chart.navigationBar = new am4charts.NavigationBar();

            // level 1
            let level1Series = chart.seriesTemplates.create("0");
            let level1_column = level1Series.columns.template;
            level1_column.column.cornerRadius(5, 5, 5, 5);
            level1_column.fillOpacity = 0.8;
            level1_column.stroke = am4core.color("#fff");
            level1_column.strokeWidth = 5;
            level1_column.strokeOpacity = 1;
            level1_column.column.fill = am4core.color("#A7ABDD");
            level1_column.tooltipText = "{name}: {value} Non-profits";
            level1Series.tooltip.getFillFromObject = false;
            level1Series.tooltip.background.fill = am4core.color("#7076c8");

            level1Series.bulletsContainer.hiddenState.properties.opacity = 0;
            level1Series.bulletsContainer.hiddenState.properties.visible = false;

            let level1Image = level1Series.columns.template.createChild(
                am4core.Image
            );
            level1Image.opacity = .6;
            level1Image.align = "center";
            level1Image.valign = "middle";
            level1Image.width = am4core.percent(70);
            level1Image.height = am4core.percent(70);

            // add adapter for href to load correct image
            level1Image.adapter.add("href", (href, target) => {
                let dataItem = target.parent.dataItem;
                if (dataItem) {
                    return (
                        dataItem.treeMapDataItem.image
                    );
                }
            });

            // create hover state
            let hoverState = level1Series.columns.template.states.create("hover");

            // darken
            hoverState.adapter.add("fill", (fill, target) => {
                return am4core.color(am4core.colors.brighten(fill.rgb, -0.2));
            });

            // level 2
            let level2Series = chart.seriesTemplates.create("1");

            level2Series.columns.template.adapter.add("fill", function(fill, target) { return fill; });

            let level2_column = level2Series.columns.template;
            level2_column.column.cornerRadius(5, 5, 5, 5);
            level2_column.fillOpacity = 1;
            level2_column.column.fill = am4core.color("#fff");
            level2_column.stroke = am4core.color("#ccc");
            level2_column.strokeWidth = 5;
            level2_column.strokeOpacity = 1;
            level2_column.tooltipText = "{name}";

            let level2Image = level2Series.columns.template.createChild(
                am4core.Image
            );
            level2Image.opacity = 1;
            level2Image.align = "center";
            level2Image.valign = "middle";
            level2Image.width = am4core.percent(80);
            level2Image.height = am4core.percent(80);

            // add adapter for href to load correct image
            level2Image.adapter.add("href", (href, target) => {
                let dataItem = target.parent.dataItem;
                if (dataItem) {
                    return (
                        dataItem.treeMapDataItem.image
                    );
                }
            });

            // level 3
            let level3Series = chart.seriesTemplates.create("2");

            level3Series.columns.template.adapter.add("fill", function(fill, target) { return fill; });

            let level3_column = level3Series.columns.template;
            level3_column.column.cornerRadius(5, 5, 5, 5);
            level3_column.fillOpacity = 1;
            level3_column.column.fill = am4core.color("#fff");
            level3_column.stroke = am4core.color("#ccc");
            level3_column.strokeWidth = 5;
            level3_column.strokeOpacity = 1;
            level3_column.tooltipText = "{name}";

            let level3Image = level3Series.columns.template.createChild(
                am4core.Image
            );
            level3Image.opacity = 1;
            level3Image.align = "center";
            level3Image.valign = "middle";
            level3Image.width = am4core.percent(80);
            level3Image.height = am4core.percent(80);

            // add adapter for href to load correct image
            level3Image.adapter.add("href", (href, target) => {
                let dataItem = target.parent.dataItem;
                if (dataItem) {
                    return (
                        dataItem.treeMapDataItem.image
                    );
                }
            });

            // On Click - Level 1
            level1Series.columns.template.events.on('hit', function(event) {
                console.log(event.target.dataItem.dataContext.name);
            });

            // On Click - Level 2
            level2Series.columns.template.events.on('hit', function(event) {

                console.log(event.target.dataItem.dataContext.name);
                console.log(event.target.dataItem.dataContext.type);

                if (event.target.dataItem.dataContext.type === 'company') {
                    getModal(event);
                }
            });

            // On Click - Level 3
            level3Series.columns.template.events.on('hit', function(event) {

                console.log(event.target.dataItem.dataContext.name);
                console.log(event.target.dataItem.dataContext.type);

                if (event.target.dataItem.dataContext.type === 'company') {
                    getModal(event);
                }
            });

            function getModal(event) {
                // setup modal content
                let modalContent = "<img src='" + event.target.dataItem.dataContext.image + "' alt='' width='140' class='mx-auto mb-2'><br>";

                modalContent += '<p class="lead text-center mb-1"><strong>' + event.target.dataItem.dataContext.name + '</strong></p>';

                modalContent += '<p class="text-center mb-1"><i class="fad fa-flask text-secondarydark fa-fw"></i> ' + event.target.dataItem.dataContext.focus + '</p>';

                if (event.target.dataItem.dataContext.location !== '') {
                    modalContent += '<p class="text-center mb-1"><i class="fad fa-globe-stand text-success fa-fw"></i>' + event.target.dataItem.dataContext.location + '</p>';

                }

                modalContent += '<p class="mt-3"><a href="' + event.target.dataItem.dataContext.url + '" class="btn btn-sm btn-primary">View Listing</a></p>';

                chart.openModal(modalContent);
            }

        }); // end am4core.ready()
    </script>
@endsection
