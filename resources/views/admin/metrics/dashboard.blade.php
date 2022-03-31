@extends(backpack_view('blank'))

@section('header')
    <div class="container-fluid mt-5">
        <h2>
            <span class="text-capitalize">Metrics Dashboard - Counts</span>
            {{--            <a href="{{ route('admin.datafeed.index') }}" class="font-sm"><i class="la la-angle-double-left"></i> Back to <span>Data Feeds</span></a>--}}
        </h2>
    </div>
@endsection

@section('content')
    <div class="row mt-4">

        <div class="col-12 mb-4 d-flex flex-wrap align-items-start">
            <div class="d-flex align-items-center mr-5 my-1">
                <label for="filter-date-range" class="font-weight-bold text-nowrap mr-2 mb-0">Date Range</label>
                <select name="filter-date-range" id="filter-date-range" class="form-control">
                    @foreach ($presetRanges as $rangeValue => $rangeLabel)
                        <option value="{{ $rangeValue }}" @if ($dateRange == $rangeValue) selected @endif>{{ $rangeLabel }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mr-5 my-1">
                <button class="btn btn-outline-primary d-flex align-items-center" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                    Included Data Types <i class="las la-angle-down ml-2"></i>
                </button>
                <div id="collapseExample" class="collapse">
                    <div class="d-flex flex-wrap mt-2" style="max-width: 600px;">
                        @foreach ($allFields as $fieldName => $fieldLabel)
                            <div class="custom-control custom-checkbox mr-2 data-type-checkbox-group">
                                <input type="checkbox" class="custom-control-input chart-series-item" id="chart-series-item-{{ $fieldName }}" @if (array_key_exists($fieldName, $currentFields)) checked @endif value="{{ $fieldName }}">
                                <label class="custom-control-label" for="chart-series-item-{{ $fieldName }}">{{ $fieldLabel }}</label>
                            </div>
                        @endforeach
                    </div>
                    <div class="mt-2">
                        <button id="update-chart-series" class="btn btn-sm btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div id="chart" data-stackedBar-values="{{ $stackedBarData }}" data-chart-series="{{ $currentFieldsJson }}" data-page-url="{{ route('admin.metrics-dashboard') }}"></div>

            <table class="table mt-5">
                <thead>
                <tr>
                    <th>Date</th>
                    @foreach($currentFields as $fieldName => $fieldLabel)
                        <th>{{ $fieldLabel }}</th>
                    @endforeach
                </tr>1
                </thead>
                <tbody>
                @forelse ($metrics as $metric)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($metric->date)->format('Y-m-d') }}</td>
                        @foreach($currentFields as $fieldName => $fieldLabel)
                            <td>{{ $metric->{$fieldName} }}</td>
                        @endforeach
                    </tr>
                @empty
                    <tr>
                        <td colspan="3">
                            no records match your query
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('after_scripts')
    <style>
        #chart {
            width: 100%;
            height: 800px;
        }

        .data-type-checkbox-group {
            min-width: 150px;
        }

        /*.btn[data-toggle="collapse"]:after {*/
        /*    width: 1rem;*/
        /*    font-size: 1rem;*/
        /*    display: block;*/
        /*}*/

        /*.btn[data-toggle="collapse"][aria-expanded="false"]:after {*/
        /*    content: "+";*/
        /*}*/

        .btn[data-toggle="collapse"][aria-expanded="true"] i {
            transform: rotate(180deg);
        }
    </style>
    <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
    <script>

        let chartElement = document.getElementById('chart');

        let stackedBarValues = JSON.parse(chartElement.getAttribute('data-stackedBar-values'));
        let pageUrl = chartElement.getAttribute('data-page-url');

        // Create root element
        // https://www.amcharts.com/docs/v5/getting-started/#Root_element
        let root = am5.Root.new("chart");

        // Set themes
        // https://www.amcharts.com/docs/v5/concepts/themes/
        root.setThemes([
            am5themes_Animated.new(root)
        ]);


        // Create chart
        // https://www.amcharts.com/docs/v5/charts/xy-chart/
        let chart = root.container.children.push(am5xy.XYChart.new(root, {
            panX: false,
            panY: false,
            wheelX: "panX",
            wheelY: "zoomX",
            layout: root.verticalLayout
        }));

        // Add scrollbar
        // https://www.amcharts.com/docs/v5/charts/xy-chart/scrollbars/
        chart.set("scrollbarX", am5.Scrollbar.new(root, {
            orientation: "horizontal",
            marginBottom: 20
        }));

        // Create axes
        // https://www.amcharts.com/docs/v5/charts/xy-chart/axes/
        let xAxis = chart.xAxes.push(am5xy.CategoryAxis.new(root, {
            categoryField: "date",
            renderer: am5xy.AxisRendererX.new(root, {}),
            tooltip: am5.Tooltip.new(root, {}),
            marginTop: 20
        }));

        xAxis.data.setAll(stackedBarValues);

        let yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
            min: 0,
            renderer: am5xy.AxisRendererY.new(root, {})
        }));


        // Add legend
        // https://www.amcharts.com/docs/v5/charts/xy-chart/legend-xy-series/
        let legend = chart.children.push(am5.Legend.new(root, {
            centerX: am5.p50,
            x: am5.p50,
            marginTop: 10
        }));


        // Add series
        // https://www.amcharts.com/docs/v5/charts/xy-chart/series/
        function makeSeries(name, fieldName) {
            let series = chart.series.push(am5xy.ColumnSeries.new(root, {
                name: name,
                stacked: true,
                xAxis: xAxis,
                yAxis: yAxis,
                valueYField: fieldName,
                categoryXField: "date"
            }));

            series.columns.template.setAll({
                tooltipText: "{valueY} {name}",
                tooltipY: am5.percent(10)
            });
            series.data.setAll(stackedBarValues);

            // Make stuff animate on load
            // https://www.amcharts.com/docs/v5/concepts/animations/
            series.appear();

            series.bullets.push(function () {
                return am5.Bullet.new(root, {
                    sprite: am5.Label.new(root, {
                        fill: root.interfaceColors.get("alternativeText"),
                        centerY: am5.p50,
                        centerX: am5.p50,
                        populateText: false
                    })
                });
            });

            legend.data.push(series);
        }

        let seriesFields = JSON.parse(chartElement.getAttribute('data-chart-series'));

        for (const property in seriesFields) {
            makeSeries(seriesFields[property], property);
        }

        // Make stuff animate on load
        // https://www.amcharts.com/docs/v5/concepts/animations/
        chart.appear(1000, 100);

        // Date Range Filter
        let dateRangeElement = document.getElementById('filter-date-range');

        dateRangeElement.addEventListener('change', function(event) {
            let dateFilter = this.value;
            updatePageUrl(dateFilter);
        });

        function updatePageUrl(dateFilter) {
            window.location.href = pageUrl + "?range=" + dateFilter;
        }

        document.getElementById('update-chart-series').addEventListener('click', function(event) {
            let chartSeriesItems = document.querySelectorAll('.chart-series-item');
            let removeSeriesItems = [];

            for (let i = 0; i < chartSeriesItems.length; i++) {
                if (chartSeriesItems[i].checked === false) {
                    removeSeriesItems.push(chartSeriesItems[i].value);
                }
            }

            console.log(removeSeriesItems);

            window.location.href = pageUrl + "?remove=" + removeSeriesItems;
        });
    </script>
@endsection
