require('./insights/collaborators-list');
require('./insights/most-interest-list');

/* Global Chart Settings */
Chart.defaults.global.defaultFontColor = '#111';
Chart.defaults.global.defaultFontFamily = '"Roboto", Avenir, "Helvetica", Arial, sans-serif';

window.addEventListener("load", function() {
    setTimeout(function () {
        $('.insights-grid').masonry().animate({opacity: 1});
    }, 1000);
});

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

$('.js-top-ten-list-chart').each(function () {
    let itemsHtml    = '',
        itemsList    = $(this),
        action       = itemsList.data('action'),
        itemTemplate = itemsList.find('.js-item-template').clone(),
        icon = '<i class="' + itemsList.data('icon-class') + '"></i> ';

    $.getJSON(action, {}, function (response) {
        if (response !== '') {
            response.forEach(function (item, i) {
                let bar = '',
                    link = '<a href="' + item.link + '">' + item.name + '</a>';

                for (let j = 0; j < item.percent; j++) {
                    bar += icon;
                }

                itemTemplate.find('.js-item-link').html(link);
                itemTemplate.find('.js-item-bar').html(bar);
                itemTemplate.removeClass('js-item-template', 'd-none');

                if (i === response.length - 1){
                    itemTemplate.addClass('border-bottom-0');
                }

                itemsHtml += itemTemplate.get(0).outerHTML;
            });

            itemsList.html(itemsHtml).show();
        }
    });
});

$('.js-bar-chart').each(function (i, item) {
    new Chartisan({
        el: item,
        url: $(this).data('action'),
        hooks: new ChartisanHooks()
            .colors(['rgba(63, 69, 49, 1)'])
            .responsive()
            .beginAtZero()
            .legend(false)
            .datasets(['bar']),
    });
});
