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

            data.forEach(function(value) {
                var item = "<tr><td><a href='/organization/"+value.slug+"'>"+value.name+"</a></td><td>"+value.trials+"</td></tr>";
                resultHtml = resultHtml + item;
            });

            $('.collaborators-body').html(resultHtml);
        }).fail(function (data) {
            // set fail behaviour
        });
    }
});
