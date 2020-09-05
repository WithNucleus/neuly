$(document).ready(function() {
    if($('.collaborators-list') !== undefined)
    {
        let order = 'DESC';
        let focusFilter = [];

        let requestData = {
            'orderBy': order,
            'focus': focusFilter,
        };

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.post("/insights/collaborators/list",[], function(data) {
            var resultHtml = "";

            data.forEach(function(value, index) {
                var position = index + 1;
                var item = "<tr><td>"+position+"</td><td>"+value.name+"</td><td>"+value.trials+"</td></tr>";
                resultHtml = resultHtml + item;
            });

            $('.collaborators-body').html(resultHtml);
        }).fail(function (data) {
            // set fail behaviour
        });
    }
});
