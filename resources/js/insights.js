require('./insights/collaborators-list');
require('./insights/topTenLocations');

/* Global Chart Settings */
Chart.defaults.global.defaultFontColor = '#111';
Chart.defaults.global.defaultFontFamily = '"Roboto", Avenir, "Helvetica", Arial, sans-serif';

$('.js-chart-pie-with-action').each(function () {
    let canvasObj = $(this),
        action    = canvasObj.data('action');

    $.getJSON(action, {}, function (response) {
        new Chart(canvasObj, {
            type: 'pie',
            data: {
                datasets: [{
                    data: response.values,
                    backgroundColor: response.colors
                }],
                labels: response.labels
            },
            options: {
                scales: {
                    xAxes: [{
                        display: false,
                    }],
                    yAxes: [{
                        display: false,

                    }],
                },
                legend: {
                    position: 'bottom'
                }
            }
        });
    });
});
