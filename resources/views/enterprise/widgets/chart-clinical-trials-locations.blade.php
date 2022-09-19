<div>
    <div class="widget-controls mb-3">
        <div class="resizable-widget-container">
            <div style="position: relative;">
                <img src="{{ asset('images/educational-organizations.jpg') }}" alt="View Trials Location" style="width: 100%;height: auto">
                <a href="#" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#clinicalTrialLocations" style="position: absolute; top: 50%; left: 50%;">Open Map</a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="clinicalTrialLocations" tabindex="-1" aria-labelledby="clinicalTrialLocations" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen-dialog">
        <div class="modal-content bg-dark modal-fullscreen-content">
            <div class="modal-header d-flex justify-content-between">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#participating">
                    Interested in Participating?
                </button>
                <h5 class="modal-title" id="exampleModalLabel">Location of Trials</h5>
                <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close" style="margin-left: 10%;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="clinicalTrialsLocationsChart" data-wasloaded="false"></div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="participating" tabindex="-1" aria-labelledby="participating" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content bg-dark">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Interested in Participating?</h5>
                <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="lead-smaller">If you're interested in learning more or potentially participating in this or similar clinical trials, please fill out the form below.</p>

                <form class="js-dashboard-request-form" method="post" action="{{ route('enterprise.dashboard.request.clinicalTrialParticipating') }}">

                    <div class="js-ajax-response-block alert position-relative" style="display: none;">
                        <span class="message"></span>
                        <button type="button" class="close js-close-ajax-response-block" data-hide="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    @csrf
                    <div class="form-group">
                        <label>Message:</label>
                        <textarea name="content" class="form-control" rows="8" style="resize: none;" required></textarea>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Submit Request</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    .modal-fullscreen-dialog {
        max-width: 100%;
        width: 100%;
        height: 100%;
        margin: 0;
        padding: 0;
    }

    .modal-fullscreen-content {
        height: auto;
        min-height: 100%;
        border-radius: 0;
    }

    #clinicalTrialsLocationsChart {
        height: 80vh;
        width: 100%;
        max-width: 100%;
    }
</style>

<script>
    $(document).on('shown.bs.modal', '#clinicalTrialLocations', function () {
        let chartElement = document.getElementById('clinicalTrialsLocationsChart');

        if (chartElement.dataset.wasloaded === 'false') {
            chartElement.dataset.wasloaded = 'true';

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

            let chart = am4core.create(chartElement, am4maps.MapChart);
            chart.projection = new am4maps.projections.Miller();

            let worldSeries = chart.series.push(new am4maps.MapPolygonSeries());
            worldSeries.useGeodata = true;
            worldSeries.geodata = am4geodata_worldLow;
            worldSeries.exclude = ["AQ"];

            let worldPolygon = worldSeries.mapPolygons.template;
            worldPolygon.tooltipText = "{name}";
            worldPolygon.nonScalingStroke = true;
            worldPolygon.strokeOpacity = 0.2;
            worldPolygon.fill = am4core.color("#000");

            let hs = worldPolygon.states.create("hover");
            hs.properties.fill = am4core.color("#454a91");
            hs.properties.fillOpacity = .4;

            let countrySeries = chart.series.push(new am4maps.MapPolygonSeries());
            countrySeries.useGeodata = true;
            countrySeries.hide();
            countrySeries.geodataSource.events.on("done", function (event) {
                countrySeries.show();
            });

            let countryPolygon = countrySeries.mapPolygons.template;
            countryPolygon.tooltipText = "{name}";
            countryPolygon.nonScalingStroke = true;
            countryPolygon.strokeOpacity = 0.5;
            countryPolygon.fill = am4core.color("#111");

            worldPolygon.events.on("hit", function (event) {
                event.target.series.chart.zoomToMapObject(event.target);
                let map = event.target.dataItem.dataContext.map;
                if (map) {
                    event.target.isHover = false;
                    countrySeries.geodataSource.url = "https://www.amcharts.com/lib/4/geodata/json/" + map + ".json";
                    countrySeries.geodataSource.load();
                }
            });

            let data = [];
            for (let id in am4geodata_data_countries2) {
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
            homeButton.events.on("hit", function () {
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
            circle.category = "{focus}"
            circle.fill = "{color}";
            circle.fillOpacity = 0.8;
            circle.stroke = am4core.color("#000");
            circle.strokeWidth = 1;
            circle.strokeOpacity = 0.7;
            circle.nonScaling = true;
            circle.tooltipText = "{title}";
            circle.propertyFields.fill = "color";

            imageSeriesTemplate.events.on("hit", function (event) {
                getModal(event, chart);
            });

            imageSeriesTemplate.propertyFields.latitude = "latitude";
            imageSeriesTemplate.propertyFields.longitude = "longitude";

            imageSeriesTemplate.layout = "absolute";
            imageSeriesTemplate.isMeasured = true;
            let overlap = chart.plugins.push(new am4plugins_overlapBuster.OverlapBuster());
            overlap.targets.push(imageSeries.mapImages.template);

            let legend = chart.createChild(am4maps.Legend);
            legend.data = {!! $colorsLegend !!};
            legend.align = "center";
            legend.valign = "top";
            legend.background.fill = am4core.color("#000");
            legend.background.fillOpacity = 0.5;
            legend.labels.template.fill = am4core.color("#fff");
        }

        function getModal(event, chart) {
            let modalContent = '<div style="max-width: 400px;text-align:center">';
            modalContent += '<p class="lead text-center mb-1"><strong>' + event.target.dataItem.dataContext.title + '</strong></p><br>';
            modalContent += '<p class="text-left mb-1">Start date: ' + event.target.dataItem.dataContext.start_date + '</p>';
            modalContent += '<p class="text-left mb-1">Completion date: ' + event.target.dataItem.dataContext.completion_date + '</p>';
            modalContent += '<p class="text-left mb-1">Gender: ' + event.target.dataItem.dataContext.gender + '</p>';
            modalContent += '<p class="text-left mb-1">Min. age: ' + event.target.dataItem.dataContext.min_age + '</p>';
            modalContent += '<p class="text-left mb-1">Max. age: ' + event.target.dataItem.dataContext.max_age + '</p>';
            modalContent += '<br>';

            if (event.target.dataItem.dataContext.location !== '') {
                modalContent += '<p class="text-left mb-1"><i class="fad fa-globe-stand text-success fa-fw"></i> ' + event.target.dataItem.dataContext.location + '</p>';
            }

            if (event.target.dataItem.dataContext.focus !== '') {
                modalContent += '<p class="text-left mb-1"><i class="fad fa-flask text-info fa-fw"></i> ' + event.target.dataItem.dataContext.focus + '</p>';
            }

            modalContent += '<p class="mt-3"><a href="' + event.target.dataItem.dataContext.url + '" class="btn btn-sm btn-primary m-2" target="_blank" rel="noopener noreferrer">View Listing</a>';
            modalContent += "</div>";
            chart.openModal(modalContent);
        }
    });

    $('#participating .js-dashboard-request-form').on('submit', function(event) {
        event.preventDefault();

        let form = $(this);
        let actionUrl = form.attr('action');
        let responseBlock = form.find('.js-ajax-response-block');
        let contentInput = form.find('textarea[name="content"]');
        let content = contentInput.val();

        $.post(actionUrl, {
            content: content,
        }, function (response) {
            console.log('response');

            responseBlock.find('.message').text(response.message);
            responseBlock.removeClass('alert-danger').addClass('alert-success').show();
            contentInput.val('');
        })
        .fail(function(jqXHR) {

            console.log(jqXHR.responseJSON.errors);

            $.each(jqXHR.responseJSON.errors, function (key, item) {
                responseBlock.find('.message').append("<span>"+item+"</span>")
            });
            responseBlock.removeClass('alert-success').addClass('alert-danger').show();
        });
    });

    $('#participating .js-close-ajax-response-block').on('click', function() {
        $(this).parent().hide();
    });

    $('#participating').on('show.bs.modal', function (){
        $(this).css('z-index', 2010);
        $('.modal-backdrop').css('z-index', 2000);
    });

    $('#participating').on('hide.bs.modal', function (){
        $(this).css('z-index', '');
        $('.modal-backdrop').css('z-index', '');
    });
</script>
