@extends('layouts.app')

@section('body-class', 'bg-white text-dark')

@section('content')

    @include('navbars.primary')

    <div class="container-fluid">
        <main id="show-main" role="main" class="col-12">
            @include('discover.includes.status-messages')

            <div class="pr-5 position-relative">
                <div id="nonProfitFocusChart"></div>
            </div>

        </main>
    </div>
    @include('discover.includes.limited-access-modal')
@endsection

@section('after_scripts')
    <script src="https://cdn.amcharts.com/lib/4/core.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>

    <style>
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
            chart.hiddenState.properties.opacity = 0;

            chart.padding(0, 0, 0, 0);
            chart.data = {!! $chartData !!};

            chart.maxLevels = 1;

            // data fields
            chart.dataFields.value = "value";
            chart.dataFields.name = "name";
            chart.dataFields.image = "image";
            chart.dataFields.url = "url";
            chart.dataFields.insightUrl = "insightUrl";
            chart.dataFields.focus = "focus";
            chart.dataFields.location = "location";
            chart.dataFields.children = "children";
            chart.dataFields.type = "type";
            chart.dataFields.color = "color";
            chart.dataFields.jobsCount = "jobs";
            chart.dataFields.eventsCount = "events";
            chart.dataFields.clinicalTrialsCount = "clinicalTrials";
            chart.dataFields.peopleCount = "people";
            chart.homeText = "Non-Profits by Focus";

            chart.navigationBar = new am4charts.NavigationBar();

            // level 1
            let level1Series = chart.seriesTemplates.create("0");
            let level1_column = level1Series.columns.template;
            level1_column.column.cornerRadius(5, 5, 5, 5);
            level1_column.fillOpacity = 0.8;
            level1_column.stroke = am4core.color("#f8f9fa");
            level1_column.strokeWidth = 5;
            level1_column.strokeOpacity = 1;
            level1_column.tooltipText = "{name}: {value} Non-profits";
            level1Series.tooltip.getFillFromObject = false;
            level1Series.tooltip.background.fill = am4core.color("#7076c8");

            let level1Image = level1Series.columns.template.createChild(
                am4core.Image
            );
            level1Image.opacity = .9;
            level1Image.align = "center";
            level1Image.valign = "middle";
            level1Image.width = am4core.percent(70);
            level1Image.height = am4core.percent(70);

            level1Image.adapter.add("href", (href, target) => {
                let dataItem = target.parent.dataItem;
                if (dataItem) {
                    return (
                        dataItem.treeMapDataItem.image
                    );
                }
            });

            let level1HoverState = level1Series.columns.template.states.create("hover");
            level1HoverState.adapter.add("fill", (fill, target) => {
                return am4core.color(am4core.colors.brighten(fill.rgb, -0.15));
            });

            // level 2
            let level2Series = chart.seriesTemplates.create("1");
            let level2_column = level2Series.columns.template;
            level2_column.column.cornerRadius(5, 5, 5, 5);
            level2_column.fillOpacity = 1;
            level2_column.stroke = am4core.color("#f8f9fa");
            level2_column.strokeWidth = 5;
            level2_column.strokeOpacity = 1;
            level2_column.tooltipText = "{name}";

            let level2Image = level2Series.columns.template.createChild(
                am4core.Image
            );
            level2Image.opacity = .9;
            level2Image.align = "center";
            level2Image.valign = "middle";
            level2Image.width = am4core.percent(80);
            level2Image.height = am4core.percent(80);

            level2Image.adapter.add("href", (href, target) => {
                let dataItem = target.parent.dataItem;
                if (dataItem) {
                    return (
                        dataItem.treeMapDataItem.image
                    );
                }
            });

            let level2HoverState = level2Series.columns.template.states.create("hover");
            level2HoverState.adapter.add("fill", (fill, target) => {
                return am4core.color(am4core.colors.brighten(fill.rgb, -0.1));
            });

            // level 3
            let level3Series = chart.seriesTemplates.create("2");
            let level3_column = level3Series.columns.template;
            level3_column.column.cornerRadius(5, 5, 5, 5);
            level3_column.fillOpacity = 1;
            level3_column.stroke = am4core.color("#f8f9fa");
            level3_column.strokeWidth = 5;
            level3_column.strokeOpacity = 1;
            level3_column.tooltipText = "{name}";

            let level3Image = level3Series.columns.template.createChild(
                am4core.Image
            );
            level3Image.opacity = .9;
            level3Image.align = "center";
            level3Image.valign = "middle";
            level3Image.width = am4core.percent(80);
            level3Image.height = am4core.percent(80);

            level3Image.adapter.add("href", (href, target) => {
                let dataItem = target.parent.dataItem;
                if (dataItem) {
                    return (
                        dataItem.treeMapDataItem.image
                    );
                }
            });

            let level3HoverState = level3Series.columns.template.states.create("hover");
            level3HoverState.adapter.add("fill", (fill, target) => {
                return am4core.color(am4core.colors.brighten(fill.rgb, -0.1));
            });

            // On Click - Level 2
            level2Series.columns.template.events.on('hit', function(event) {
                if (event.target.dataItem.dataContext.type === 'company') {
                    getModal(event);
                }
            });

            // On Click - Level 3
            level3Series.columns.template.events.on('hit', function(event) {
                if (event.target.dataItem.dataContext.type === 'company') {
                    getModal(event);
                }
            });

            function getModal(event) {
                let modalContent = '<div style="max-width: 400px;min-width: 250px;text-align:center">';

                modalContent += "<img src='" + event.target.dataItem.dataContext.image + "' alt='' width='140' class='mx-auto mb-2'>";

                modalContent += '<p class="lead text-center mb-1"><strong>' + event.target.dataItem.dataContext.name + '</strong></p>';
                modalContent += '<p class="text-left mb-1"><i class="fad fa-flask text-secondarydark fa-fw"></i> ' + event.target.dataItem.dataContext.focus + '</p>';

                if (event.target.dataItem.dataContext.location !== '') {
                    modalContent += '<p class="text-left mb-1"><i class="fad fa-globe-stand text-success fa-fw"></i>' + event.target.dataItem.dataContext.location + '</p>';
                }

                if (event.target.dataItem.dataContext.peopleCount !== 0) {
                    modalContent += '<p class="text-left mb-1"><i class="fad fa-briefcase text-quaternary fa-fw"></i> ' + event.target.dataItem.dataContext.peopleCount + ' People</p>';
                }

                if (event.target.dataItem.dataContext.jobsCount !== 0) {
                    modalContent += '<p class="text-left mb-1"><i class="fad fa-briefcase text-danger fa-fw"></i> ' + event.target.dataItem.dataContext.jobsCount + ' Jobs Posted</p>';
                }

                if (event.target.dataItem.dataContext.eventsCount !== 0) {
                    modalContent += '<p class="text-left mb-1"><i class="fad fa-calendar text-primary fa-fw"></i> ' + event.target.dataItem.dataContext.eventsCount + ' Events</p>';
                }

                if (event.target.dataItem.dataContext.clinicalTrialsCount !== 0) {
                    modalContent += '<p class="text-left mb-1"><i class="fad fa-stethoscope text-quaternary fa-fw"></i> ' + event.target.dataItem.dataContext.clinicalTrialsCount + ' Clinical Trials</p>';
                }

                modalContent += '<p class="mt-3"><a href="' + event.target.dataItem.dataContext.url + '" class="btn btn-sm btn-primary m-2" target="_blank" rel="noopener noreferrer">View Listing</a><a href="' + event.target.dataItem.dataContext.insightUrl + '" class="btn btn-sm btn-primary m-2" target="_blank" rel="noopener noreferrer">View Insight Chart</a></p>';

                modalContent += "</div>";
                chart.openModal(modalContent);
            }

        }); // end am4core.ready()
    </script>
@endsection
