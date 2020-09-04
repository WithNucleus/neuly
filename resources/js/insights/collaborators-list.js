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
            //set data for collaborators list
        }).fail(function (data) {
            // set fail behaviour
        });
    }
});
