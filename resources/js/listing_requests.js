$(document).ready(function() {
    $('select#general_type').on('change', function(event) {
        var value = $('select#general_type option:selected').text().toLowerCase();
        $('form').attr('action', '/listing/request/'+value);
    });
});
