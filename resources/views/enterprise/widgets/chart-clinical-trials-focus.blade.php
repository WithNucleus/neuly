<div class="widget-controls mb-3">
    <div class="d-flex align-items-stretch">
        <button class="btn btn-sm has-accordion-arrow filter-control" type="button" data-toggle="collapse"
                data-target="#filters-chart-clinical-trials-focus-phases" aria-expanded="false"
                aria-controls="filters-chart-clinical-trials-focus-phases">
            Phase Filter
        </button>
    </div>

    <div class="filter-checkboxes" data-filter="phases">
        <div class="filter-group border shadow-sm px-3 py-2 collapse"
             id="filters-chart-clinical-trials-focus-phases">
            @foreach ($phases as $key => $label)
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input"
                           id="filters-chart-clinical-trials-focus-phases-{{ $key }}" data-name="{{ $key }}"
                        {{ $filteredPhases && in_array($key, $filteredPhases) ? 'checked' : '' }}>
                    <label class="custom-control-label"
                           for="filters-chart-clinical-trials-focus-phases-{{ $key }}">{{ $label }}</label>
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
        let preparedLabels = JSON.parse(canvas.dataset.labels);
        let colors = JSON.parse(canvas.dataset.colors);
        let actionUrl = canvas.dataset.url;
        let preparedData = [];
        let i = 0;

        for (let focus in data) {
            preparedData.push({
                data: data[focus],
                label: focus,
                backgroundColor: colors[i],
            })

            i++;
        }

        let ctx = canvas.getContext("2d");
        let myNewChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: preparedLabels,
                datasets: preparedData
            },
            options: {
                maintainAspectRatio: false,
                scales: {
                    xAxes: [{
                        display: true,
                        gridLines: {
                            display: true,
                            color: "#1e2125"
                        },
                    }],
                    yAxes: [{
                        display: true,
                        gridLines: {
                            display: true,
                            color: "#1e2125"
                        },
                    }]
                }
            }
        });

        canvas.onclick = function (evt) {
            let activePoint = myNewChart.getElementAtEvent(evt);

            if (activePoint[0]) {
                let chartData = activePoint[0]['_chart'].config.data;
                let idx = activePoint[0]['_datasetIndex'];
                let focus = chartData.datasets[idx].label;
                let url = actionUrl + focus;
                window.open(url, '_blank');
            }
        };
    });
</script>

