<script>
    let chartElement = document.getElementById('chart');

    let stackedBarValues = JSON.parse(chartElement.getAttribute('data-stackedBar-values'));

    // Create root element
    // https://www.amcharts.com/docs/v5/getting-started/#Root_element
    let root = am5.Root.new("chart");

    // Set themes
    // https://www.amcharts.com/docs/v5/concepts/themes/
    root.setThemes([
        am5themes_Animated.new(root),
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
</script>
