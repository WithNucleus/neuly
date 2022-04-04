<div>
    <div class="resizable-widget-container">
        <canvas id="organizationIndustryChart" style="height: 700px" data-labels="{{ $labels }}" data-values="{{ $values }}" data-colors="{{ $colors }}" data-url="{{ route('discover.organizations') }}?filter[focus]="></canvas>
    </div>

    <script>

        $(document).ready(function() {

            let canvas = document.getElementById("organizationIndustryChart");
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

            canvas.onclick = function(evt) {
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
</div>
