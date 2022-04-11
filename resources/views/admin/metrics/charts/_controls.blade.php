<div class="col-12 mb-4 d-flex flex-wrap align-items-start">
    <div class="my-1 mr-4">
        <button id="update-chart-series" class="btn btn-primary" data-page-url="{{ route('admin.metrics.charts') }}">Update Filters</button>
    </div>
    <div class="d-flex align-items-center mr-4 my-1">
        <label for="filter-date-range" class="font-weight-bold text-nowrap mr-2 mb-0">Date Range</label>
        <select name="filter-date-range" id="filter-date-range" class="form-control">
            @foreach ($presetRanges as $rangeValue => $rangeLabel)
                <option value="{{ $rangeValue }}" @if ($filterDateRange == $rangeValue) selected @endif>{{ $rangeLabel }}</option>
            @endforeach
        </select>
    </div>

    <div class="d-flex align-items-center mr-4 my-1">
        <label for="filter-metrics-type" class="font-weight-bold text-nowrap mr-2 mb-0">Metrics Type</label>
        <select name="filter-metrics-type" id="filter-metrics-type" class="form-control">
            <option value="counts">Counts</option>
            <option value="changes" @if ($filterMetricsType == 'changes') selected @endif>Changes</option>
        </select>
    </div>

    <div class="d-flex align-items-center mr-4 my-1">
        <label for="filter-chart-type" class="font-weight-bold text-nowrap mr-2 mb-0">Chart Type</label>
        <select name="filter-chart-type" id="filter-chart-type" class="form-control">
            <option value="line">Line</option>
            <option value="bar" @if ($filterChartType == 'bar') selected @endif>Bar</option>
        </select>
    </div>

    <div class="mr-4 my-1">
        <button class="btn btn-outline-primary d-flex align-items-center" type="button" data-toggle="collapse" data-target="#data-types-group" aria-expanded="false" aria-controls="data-types-group">
            Included Data Types <i class="las la-angle-down ml-2"></i>
        </button>
        <div id="data-types-group" class="collapse">
            <div class="d-flex flex-wrap mt-2" style="max-width: 480px;">
                @foreach ($allFields as $fieldName => $fieldLabel)
                    <div class="custom-control custom-checkbox mr-2 data-type-checkbox-group">
                        <input type="checkbox" class="custom-control-input chart-series-item" id="chart-series-item-{{ $fieldName }}" @if (array_key_exists($fieldName, $currentFields)) checked @endif value="{{ $fieldName }}">
                        <label class="custom-control-label" for="chart-series-item-{{ $fieldName }}">{{ $fieldLabel }}</label>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
<style>
    .data-type-checkbox-group {
        width: 150px;
    }

    .btn[data-toggle="collapse"][aria-expanded="true"] i {
        transform: rotate(180deg);
    }
</style>
<script>
    let dateRangeElement = document.getElementById('filter-date-range');
    let chartTypeElement = document.getElementById('filter-chart-type');
    let metricsTypeElement = document.getElementById('filter-metrics-type');
    let chartSeriesItems = document.querySelectorAll('.chart-series-item');
    let updateChartButton = document.getElementById('update-chart-series');

    let pageUrl = updateChartButton.getAttribute('data-page-url');

    updateChartButton.addEventListener('click', function(event) {
        updatePageUrl();
    });

    function updatePageUrl() {

        // Check Series
        let removeSeriesItems = [];

        for (let i = 0; i < chartSeriesItems.length; i++) {
            if (chartSeriesItems[i].checked === false) {
                removeSeriesItems.push(chartSeriesItems[i].value);
            }
        }

        console.log("removeSeriesItems: " + removeSeriesItems);

        // Check Date Filter
        let dateFilter = dateRangeElement.value;
        console.log("dateFilter: " + dateFilter);

        // Check Chart Type
        let chartType = chartTypeElement.value;
        console.log("chartType: " + chartType);

        let metricsType = metricsTypeElement.value;
        console.log("metricsType: " + metricsType);

        let url = pageUrl + "?range=" + dateFilter;

        if (removeSeriesItems.length > 0) {
            url += '&remove=' + removeSeriesItems
        }

        if (chartType === 'bar') {
            url += '&type=' + chartType;
        }

        if (metricsType === 'changes') {
            url += '&metrics=' + metricsType;
        }

        window.location.href = url;
    }
</script>
