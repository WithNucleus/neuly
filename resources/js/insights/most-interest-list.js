$(document).ready(function() {
    if($('.focus-list') !== undefined)
    {
        let order = 'DESC';

        let requestData = {
            'orderBy': order,
        };

        $.post("/insights/most-interest/list",[], function(data) {
            var resultHtml = "";

            data.forEach(function(value) {
                var item = "<tr><td><a href='clinical-trials?filter[focus]="+value.name+"'>"+value.name+"</a></td><td>"+value.trials+"</td></tr>";
                resultHtml = resultHtml + item;
            });

            $('.focus-body').html(resultHtml);
        }).fail(function (data) {
            // set fail behaviour
        });
    }
});
