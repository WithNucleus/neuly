@extends('layouts.app')

@section('body-class', 'bg-white text-dark')

@section('content')

    @include('navbars.primary')

    <div class="container-fluid">
        <main id="show-main" role="main" class="col-12">
            <h1 class="text-primary text-center mt-3 mb-5">
                Psychedelic Educational Organizations
            </h1>
            <div class="pr-5">
                <div id="chart"></div>
            </div>
        </main>
    </div>
@endsection

@section('after_scripts')
    <script src="https://cdn.amcharts.com/lib/4/core.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/maps.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/geodata/worldLow.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/geodata/data/countries2.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/plugins/overlapBuster.js"></script>

    <style>
        #chart {
            width: 100%;
            height: 60vh;
            max-width:100%;
        }

        @media (min-width: 768px) {
            #chart {
                height: 80vh;
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

            let continents = {
                "AF": 0,
                "AN": 1,
                "AS": 2,
                "EU": 3,
                "NA": 4,
                "OC": 5,
                "SA": 6
            }

            let chart = am4core.create("chart", am4maps.MapChart);
            chart.projection = new am4maps.projections.Miller();

            let worldSeries = chart.series.push(new am4maps.MapPolygonSeries());
            worldSeries.useGeodata = true;
            worldSeries.geodata = am4geodata_worldLow;
            worldSeries.exclude = ["AQ"];

            let worldPolygon = worldSeries.mapPolygons.template;
            worldPolygon.tooltipText = "{name}";
            worldPolygon.nonScalingStroke = true;
            worldPolygon.strokeOpacity = 0.5;
            worldPolygon.fill = am4core.color("#dbdbdb");

            let hs = worldPolygon.states.create("hover");
            hs.properties.fill = am4core.color("#c1c0c0");

            let countrySeries = chart.series.push(new am4maps.MapPolygonSeries());
            countrySeries.useGeodata = true;
            countrySeries.hide();
            countrySeries.geodataSource.events.on("done", function(event) {
                countrySeries.show();
            });

            let countryPolygon = countrySeries.mapPolygons.template;
            countryPolygon.tooltipText = "{name}";
            countryPolygon.nonScalingStroke = true;
            countryPolygon.strokeOpacity = 0.5;
            countryPolygon.fill = am4core.color("#dbdbdb");

            worldPolygon.events.on("hit", function(event) {
                event.target.series.chart.zoomToMapObject(event.target);
                let map = event.target.dataItem.dataContext.map;
                if (map) {
                    event.target.isHover = false;
                    countrySeries.geodataSource.url = "https://www.amcharts.com/lib/4/geodata/json/" + map + ".json";
                    countrySeries.geodataSource.load();
                }
            });

            let data = [];
            for(let id in am4geodata_data_countries2) {
                if (am4geodata_data_countries2.hasOwnProperty(id)) {
                    let country = am4geodata_data_countries2[id];
                    if (country.maps.length) {
                        data.push({
                            id: id,
                            color: chart.colors.getIndex(continents[country.continent_code]),
                            map: country.maps[0]
                        });
                    }
                }
            }
            worldSeries.data = data;

            chart.zoomControl = new am4maps.ZoomControl();

            let homeButton = new am4core.Button();
            homeButton.events.on("hit", function() {
                worldSeries.show();
                countrySeries.hide();
                chart.goHome();
            });

            homeButton.icon = new am4core.Sprite();
            homeButton.padding(7, 5, 7, 5);
            homeButton.width = 30;
            homeButton.icon.path = "M16,8 L14,8 L14,16 L10,16 L10,10 L6,10 L6,16 L2,16 L2,8 L0,8 L8,0 L16,8 Z M16,8";
            homeButton.marginBottom = 10;
            homeButton.parent = chart.zoomControl;
            homeButton.insertBefore(chart.zoomControl.plusButton);

            let imageSeries = chart.series.push(new am4maps.MapImageSeries());

            imageSeries.data = {!! $chartData !!};

            let imageSeriesTemplate = imageSeries.mapImages.template;
            let circle = imageSeriesTemplate.createChild(am4core.Circle);
            circle.radius = 6;
            circle.fill = am4core.color("#275dad");
            circle.fillOpacity = 0.5;
            circle.stroke = am4core.color("#FFFFFF");
            circle.strokeWidth = 1;
            circle.strokeOpacity = 0.7;
            circle.nonScaling = true;
            circle.tooltipText = "{name}";

            imageSeriesTemplate.events.on("hit", function(event) {
                getModal(event);
            });

            imageSeriesTemplate.propertyFields.latitude = "latitude";
            imageSeriesTemplate.propertyFields.longitude = "longitude";

            imageSeriesTemplate.layout = "absolute";
            imageSeriesTemplate.isMeasured = true;
            let overlap = chart.plugins.push(new am4plugins_overlapBuster.OverlapBuster());
            overlap.targets.push(imageSeries.mapImages.template);

            function getModal(event) {
                let modalContent = '<div style="max-width: 400px;text-align:center">';

                modalContent += "<img src='" + event.target.dataItem.dataContext.image + "' alt='' width='140' class='mx-auto mb-2'>";

                modalContent += '<p class="lead text-center mb-1"><strong>' + event.target.dataItem.dataContext.name + '</strong></p>';
                modalContent += '<p class="text-left mb-1"><i class="fad fa-flask text-secondarydark fa-fw"></i> ' + event.target.dataItem.dataContext.focus + '</p>';

                if (event.target.dataItem.dataContext.location !== '') {
                    modalContent += '<p class="text-left mb-1"><i class="fad fa-globe-stand text-success fa-fw"></i> ' + event.target.dataItem.dataContext.location + '</p>';
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

                modalContent += '<p class="mt-3"><a href="' + event.target.dataItem.dataContext.url + '" class="btn btn-sm btn-primary m-2" target="_blank" rel="noopener noreferrer">View Listing</a>';
                modalContent += '<a href="' + event.target.dataItem.dataContext.insightUrl + '" class="btn btn-sm btn-primary m-2" target="_blank" rel="noopener noreferrer">View Insight Chart</a></p>';

                modalContent += "</div>";
                chart.openModal(modalContent);
            }

        });

    </script>
@endsection
