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
        am5themes_Kelly.new(root)
    ]);

    root.dateFormatter.setAll({
        dateFormat: "yyyy",
        dateFields: ["valueX"]
    });

    // Create chart
    // https://www.amcharts.com/docs/v5/charts/xy-chart/
    let chart = root.container.children.push(am5xy.XYChart.new(root, {
        focusable: true,
        panX: true,
        panY: true,
        wheelX: "panX",
        wheelY: "zoomX",
        pinchZoomX:true,
        layout: root.verticalLayout
    }));

    let easing = am5.ease.linear;


    // Create axes
    // https://www.amcharts.com/docs/v5/charts/xy-chart/axes/
    let xAxis = chart.xAxes.push(am5xy.DateAxis.new(root, {
        maxDeviation: 0.1,
        groupData: true,
        baseInterval: {
            timeUnit: "day",
            count: 1
        },
        renderer: am5xy.AxisRendererX.new(root, {

        }),
        tooltip: am5.Tooltip.new(root, {}),
    }));

    xAxis.data.setAll(stackedBarValues);

    let yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
        maxDeviation: 0.2,
        renderer: am5xy.AxisRendererY.new(root, {})
    }));

    let legend = chart.children.push(am5.Legend.new(root, {
        marginBottom: 10,
        marginTop: 10
    }));

    let seriesFields = JSON.parse(chartElement.getAttribute('data-chart-series'));

    for (const property in seriesFields) {
        makeSeries(seriesFields[property], property);
    }

    function makeSeries(name, fieldName) {
        let series = chart.series.push(am5xy.LineSeries.new(root, {
            name: name,
            minBulletDistance: 1,
            connect: true,
            xAxis: xAxis,
            yAxis: yAxis,
            valueYField: fieldName,
            valueXField: "date",
            tooltip: am5.Tooltip.new(root, {
                pointerOrientation: "horizontal",
                labelText: "{valueY} {name}"
            })
        }));

        series.strokes.template.setAll({
            strokeWidth: 2
        });

        // Set up data processor to parse string dates
        // https://www.amcharts.com/docs/v5/concepts/data/#Pre_processing_data
        series.data.processor = am5.DataProcessor.new(root, {
            dateFormat: "yyyy-MM-dd",
            dateFields: ["date"]
        });

        series.data.setAll(stackedBarValues);
        legend.data.push(series);
    }


    // Add cursor
    // https://www.amcharts.com/docs/v5/charts/xy-chart/cursor/
    let cursor = chart.set("cursor", am5xy.XYCursor.new(root, {
        xAxis: xAxis,
        behavior: "none"
    }));
    cursor.lineY.set("visible", false);

    // add scrollbar
    chart.set("scrollbarX", am5.Scrollbar.new(root, {
        orientation: "horizontal",
    }));


    // Make stuff animate on load
    // https://www.amcharts.com/docs/v5/concepts/animations/
    chart.appear(1000, 100);
</script>
