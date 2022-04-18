@extends(backpack_view('blank'))

@section('header')
    <div class="container-fluid mt-5">
        <h2>
            <span class="text-capitalize">Neuly Records</span>
            <small id="datatable_info_stack" class="animated fadeIn" style="display: inline-flex;">
                <span class="mr-2">
                    {{ $totalRecords }} items added between {{ Carbon\Carbon::parse($filterDateStart)->format('M d, Y') }} - {{ Carbon\Carbon::parse($filterDateEnd)->format('M d, Y') }}
                </span>
                <span><a href="{{ backpack_url('metric') }}">View all Metrics</a></span>
            </small>
        </h2>
    </div>
@endsection

@section('content')
    <div class="row mt-4">

        <div class="col-12 mb-4 d-flex flex-wrap align-items-start">
            <div class="d-flex align-items-center mr-4 my-1">
                <label for="filter-date-range" class="font-weight-bold text-nowrap mr-2 mb-0">Date Range</label>
                <select name="filter-date-range" id="filter-date-range" class="form-control" data-page-url="{{ route('admin.metrics.tiles') }}">
                    @foreach ($presetRanges as $rangeValue => $rangeLabel)
                        <option value="{{ $rangeValue }}" @if ($filterDateRange == $rangeValue) selected @endif>{{ $rangeLabel }}</option>
                    @endforeach
                </select>
            </div>

            <div class="filter-custom-dates d-flex align-items-center mr-4 my-1">
                <label for="datepicker" class="sr-only">Date Range</label>
                <input class="form-control" id="datepicker"
                       data-start-date="{{ Carbon\Carbon::parse($filterDateStart)->format('Y-m-d') }}"
                       data-end-date="{{ Carbon\Carbon::parse($filterDateEnd)->format('Y-m-d') }}"
                       style="min-width: 200px"
                />
            </div>

        </div>

        <div class="col-12">
            <div id="chart" data-chart-data="{{ $chartData }}"></div>
        </div>

        @foreach ($metrics as $metricEntity => $metric)
            @include('admin.metrics.tiles.tile-template')
        @endforeach

    </div>
@endsection

@section('after_scripts')
    <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <style>
        [data-toggle="collapse"]:hover {
            cursor: pointer;
        }
        [data-toggle="collapse"][aria-expanded="true"] i {
            transform: rotate(180deg);
        }

        #chart {
            width: 100%;
            height: 500px;
            margin-bottom: 2rem;
        }

        .filter-custom-dates {
            position: relative;
            z-index: 2;
        }
    </style>
    <script>

        // Preset Date Ranges
        let dateRangeElement = document.getElementById('filter-date-range');
        let pageUrl = dateRangeElement.getAttribute('data-page-url');
        let chartData = JSON.parse(document.getElementById('chart').getAttribute('data-chart-data'));

        let datepickerElement = document.getElementById('datepicker');
        let defaultStartDate = datepickerElement.getAttribute('data-start-date');
        let defaultEndDate = datepickerElement.getAttribute('data-end-date');

        dateRangeElement.addEventListener('change', function() {
            let dateFilter = dateRangeElement.value;

            if (dateFilter === 'custom') {
                console.log("show custom date thing");
            } else {
                window.location.href = pageUrl + "?range=" + dateFilter;
            }
        });

        // Custom Date Picker
        let customDatePicker = flatpickr("#datepicker", {
            minDate: "2020-06-01",
            dateFormat: "Y-m-d",
            mode: "range",
            defaultDate: [defaultStartDate, defaultEndDate],
            onChange: function(selectedDates, dateStr, instance) {

                let startDate = selectedDates[0].toISOString().split('T')[0];
                let endDate = selectedDates[1].toISOString().split('T')[0];

                window.location.href = pageUrl + "?start=" + startDate + "&end=" + endDate;

            }
        });

        // Chart
        let root = am5.Root.new("chart");

        root.setThemes([
            am5themes_Animated.new(root)
        ]);

        let chart = root.container.children.push(am5xy.XYChart.new(root, {
            panX: true,
            panY: true,
            wheelX: "panX",
            wheelY: "zoomX",
            pinchZoomX:true
        }));

        let cursor = chart.set("cursor", am5xy.XYCursor.new(root, {}));
        cursor.lineY.set("visible", false);

        let xRenderer = am5xy.AxisRendererX.new(root, { minGridDistance: 30 });
        xRenderer.labels.template.setAll({
            rotation: -90,
            centerY: am5.p50,
            centerX: am5.p100,
            paddingRight: 15
        });

        let xAxis = chart.xAxes.push(am5xy.CategoryAxis.new(root, {
            maxDeviation: 0.3,
            categoryField: "label",
            renderer: xRenderer,
            tooltip: am5.Tooltip.new(root, {})
        }));

        let yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
            maxDeviation: 0.3,
            renderer: am5xy.AxisRendererY.new(root, {})
        }));

        let series = chart.series.push(am5xy.ColumnSeries.new(root, {
            name: "Records",
            xAxis: xAxis,
            yAxis: yAxis,
            valueYField: "count",
            sequencedInterpolation: true,
            categoryXField: "label",
            tooltip: am5.Tooltip.new(root, {
                labelText:"{valueY}"
            })
        }));

        series.columns.template.setAll({ cornerRadiusTL: 5, cornerRadiusTR: 5 });
        series.columns.template.adapters.add("fill", function(fill, target) {
            return chart.get("colors").getIndex(series.columns.indexOf(target));
        });

        series.columns.template.adapters.add("stroke", function(stroke, target) {
            return chart.get("colors").getIndex(series.columns.indexOf(target));
        });

        xAxis.data.setAll(chartData);
        series.data.setAll(chartData);

        series.appear(1000);
        chart.appear(1000, 100);
    </script>
@endsection
