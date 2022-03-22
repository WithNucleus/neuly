<div>
    <div class="resizable-widget-container">
        <canvas id="clinicalTrialsStatusChart" style="height: 500px" data-labels="{{ $labels }}" data-values="{{ $values }}" data-url="{{ route('discover.clinicaltrials') }}?filter[status]="></canvas>
    </div>

    <script>

        $(document).ready(function() {

            let canvas = document.getElementById("clinicalTrialsStatusChart");
            let data = JSON.parse(canvas.dataset.values);
            let labels = JSON.parse(canvas.dataset.labels);
            let actionUrl = canvas.dataset.url;

            let ctx = canvas.getContext("2d");
            let myNewChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        data: data['Psilocybin'],
                        label: 'Psilocybin',
                        backgroundColor: '#3B3EAC',
                        barPercentage: .9,
                        minBarLength: 2,
                    },
                    {
                        data: data['Ketamine'],
                        label: 'Ketamine',
                        backgroundColor: '#994499',
                        barPercentage: .9,
                        minBarLength: 2,
                    },
                    {
                        data: data['MDMA'],
                        label: 'MDMA',
                        backgroundColor: '#FF9900',
                        barPercentage: .9,
                        minBarLength: 2,
                    },
                    {
                        data: data['GHB'],
                        label: 'GHB',
                        backgroundColor: '#0099C6',
                        barPercentage: .9,
                        minBarLength: 2,
                    },
                    {
                        data: data['LSD'],
                        label: 'LSD',
                        backgroundColor: '#329262',
                        barPercentage: .9,
                        minBarLength: 2,
                    }]
                },
                options: {
                    maintainAspectRatio: false,
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
