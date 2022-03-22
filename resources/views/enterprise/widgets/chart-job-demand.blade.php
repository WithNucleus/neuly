<div>
    <div class="resizable-widget-container">
        <canvas id="jobDemandChart" style="height: 350px"
                data-labels="{{ $labels }}"
                data-values="{{ $values }}"
                data-url="{{ route('discover.organizations') }}?filter[focus]="
        ></canvas>
    </div>

    <script>

        $(document).ready(function() {

            let canvas = document.getElementById("jobDemandChart");
            let values = JSON.parse(canvas.dataset.values);
            let labels = JSON.parse(canvas.dataset.labels);
            let actionUrl = canvas.dataset.url;

            let ctx = canvas.getContext("2d");
            let myNewChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Total Jobs',
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
        });

    </script>
</div>
