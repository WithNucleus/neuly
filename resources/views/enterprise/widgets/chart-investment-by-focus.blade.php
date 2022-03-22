<div>
    <div class="resizable-widget-container">
        <canvas id="investmentsByFocus" style="height: 350px"
                data-labels="{{ $labels }}"
                data-values="{{ $values }}"
                data-colors="{{ $colors }}"
                data-url="{{ route('discover.organizations') }}?filter[focus]="
        ></canvas>
    </div>

    <script>

        $(document).ready(function() {

            let canvas = document.getElementById("investmentsByFocus");
            let values = JSON.parse(canvas.dataset.values);
            let labels = JSON.parse(canvas.dataset.labels);
            let colors = JSON.parse(canvas.dataset.colors);
            let actionUrl = canvas.dataset.url;

            let ctx = canvas.getContext("2d");
            let myNewChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Organizations',
                        backgroundColor: colors,
                        data: values,
                        borderColor: "#fff",
                        borderWidth: 2,
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
                        position: "right"
                    },
                }
            });
        });

    </script>
</div>
