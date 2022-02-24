$(function() {
    var link = '';
    $('.open-search-template').on('click', function() {
        if(!window.location.search) {
            $('#error-messages').text('No filters selected. Please select Filters before you save a search template.');
            $('#error-messages').show();
            $('.save-search-template').attr('disabled', true);
        }

       $('.template-save-modal').show();
    });

    $('.choose-search-template').on('click', function() {
        $('.template-choose-modal').show();
    });

    $('.save-search-template').on('click', function() {
        var name = $('#template-name').val();
        var description = $('#template-description').val();
        var link = location.href;
        var type = link.substring(link.indexOf('?') + 1).split('%5B')[0];
        type = type.substr(0,1).toUpperCase() + type.substr(1);
        var user_id = $('#user_id').val();


        $('#error-messages').hide();
        $('#error-message').html('<div class="alert alert-danger" id="error-messages" role="alert"></div>');

        console.log(type);

        $.ajax({
            method: 'POST',
            url: 'http://neuly.local/api/search/templates',
            data: {
                name: name,
                description: description,
                link: link,
                type: type,
                user_id: user_id
            },
            success: function() {

            },
            error: function(xhr, ajaxOptions, thrownError) {
                var errors = JSON.parse(xhr.responseText).errors;
                var errorMessage = '';

                for(const [key, value] of Object.entries(errors))
                {
                    value.forEach(function(item){
                       errorMessage += item + '\n';
                    });
                }
               var obj = $('#error-messages').text(errorMessage);
                obj.html(obj.html().replace(/\n/g,'<br/>'));

                $('#error-messages').show();
            }
        });
    });

    $('.filter-selection').on('change', function () {
        var type = $(this).children("option:selected").val();
        if (type != "all") {
            $('tr[data-type="' + type + '"]').show();
            $('tr:not([data-type="' + type + '"])').hide();
        } else {
            $('tr').show();
        }


    })
});
