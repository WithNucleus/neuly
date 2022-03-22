<div>
    <div class="resizable-widget-container">
        <canvas id="activePatentsByYearChart" style="height: 350px"
                data-labels="{{ $labels }}"
                data-values="{{ $values }}"
                data-url="{{ route('discover.patents') }}?filter[priority_date]="
        ></canvas>
    </div>

    <script>

        $(document).ready(function() {

            let canvas = document.getElementById("activePatentsByYearChart");
            let values = JSON.parse(canvas.dataset.values);
            let labels = JSON.parse(canvas.dataset.labels);
            let actionUrl = canvas.dataset.url;

            let ctx = canvas.getContext("2d");
            let myNewChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Patents',
                        pointBackgroundColor: "#3366CC",
                        borderColor: 'rgba(51,102,204,0.25)',
                        backgroundColor: 'transparent',
                        data: values,
                        pointRadius: 5,
                        pointHitRadius: 10,
                    }]
                },
                options: {
                    tooltips: {
                        displayColors: true,
                        callbacks:{
                            mode: 'x',
                        },
                    },
                    responsive: true,
                    maintainAspectRatio: false,
                    legend: {
                        display: false
                    },
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
