<div class="widget-controls mb-3">
    <div class="d-flex align-items-stretch">
        <button class="btn btn-sm has-accordion-arrow filter-control" type="button" data-toggle="collapse"
                data-target="#filters-chart-clinical-trials-focus-phases" aria-expanded="false"
                aria-controls="filters-chart-clinical-trials-focus-phases">
            Phase Filter
        </button>
    </div>

    <div class="filter-checkboxes" data-filter="phases">
        <div class="filter-group bg-white border shadow-sm px-3 py-2 collapse"
             id="filters-chart-clinical-trials-focus-phases">
            @foreach ($filterValues as $value => $label)
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input"
                           id="filters-chart-clinical-trials-focus-phases-{{ $value }}" data-name="{{ $value }}"
                        {{ $filteredPhases && in_array($value, $filteredPhases) ? 'checked' : '' }}>
                    <label class="custom-control-label"
                           for="filters-chart-clinical-trials-focus-phases-{{ $value }}">{{ $label }}</label>
                </div>
            @endforeach
        </div>
    </div>
</div>
<div class="resizable-widget-container">
    <canvas id="clinicalTrialsFocusChart" style="height: 500px" data-labels="{{ $labels }}" data-values="{{ $values }}"
            data-colors="{{ $colors }}" data-url="{{ route('discover.clinicaltrials') }}?filter[focus]="></canvas>
</div>

<script>

    $(document).ready(function () {

        let canvas = document.getElementById("clinicalTrialsFocusChart");
        let data = JSON.parse(canvas.dataset.values);
        let labels = JSON.parse(canvas.dataset.labels);
        let colors = JSON.parse(canvas.dataset.colors);
        let actionUrl = canvas.dataset.url;

        let ctx = canvas.getContext("2d");
        let myNewChart = new Chart(ctx, {
            type: 'horizontalBar',
            data: {
                labels: labels,
                datasets: [{
                    data: data,
                    backgroundColor: colors,
                    barPercentage: .9,
                    minBarLength: 2,
                }]
            },
            options: {
                legend: {
                    display: false
                },
                maintainAspectRatio: false
            }
        });

        canvas.onclick = function (evt) {
            let activePoints = myNewChart.getElementsAtEvent(evt);
            if (activePoints[0]) {
                let chartData = activePoints[0]['_chart'].config.data;
                let idx = activePoints[0]['_index'];

                let label = chartData.labels[idx];
                let value = chartData.datasets[0].data[idx];

                let url = actionUrl + label;
                window.open(url, '_blank');
            }
        };
    });
</script>

