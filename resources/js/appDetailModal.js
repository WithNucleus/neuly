/* Load Content into Modal */
$('.load-ajax-modal').click(function(e){

    // Return Title and Body to Loading Text
    $('#dynamic-modal div.modal-body').text('Loading...');
    $('#dynamic-modal .modal-title').text(' ');

    // No Clicking
    e.preventDefault();

    // Ajax Header
	$.ajaxSetup({
	    headers: {
	        'X-CSRF-Token': $('meta[name="_token"]').attr('content')
	    }
	});

    // Get Modal Title
    var title = $(this).data('title');

    // Get Application Record
    var applicationRecord = $(this).data('application');

    // Ajax Content
    $.ajax({
        type : 'GET',
        url : $(this).data('path'),

        success: function(result) {
            $('#dynamic-modal div.modal-body').html(result);
            $('#dynamic-modal .modal-title').text(title);
        }
    });

    // Show Modal
    $('#dynamic-modal').modal('show');
    
});

/* Load Content into Modal */
$('.load-ajax-modal-alt').click(function(e){

    // Return Title and Body to Loading Text
    $('#dynamic-modal-alt div.modal-replacement-content').text('Loading...');
    // $('#dynamic-modal-alt .modal-title').text(' ');

    // No Clicking
    e.preventDefault();

    // Ajax Header
    $.ajaxSetup({
        headers: {
            'X-CSRF-Token': $('meta[name="_token"]').attr('content')
        }
    });

    // Get Modal Title
    var title = $(this).data('title');

    // Get Application Record
    var applicationRecord = $(this).data('application');

    // Ajax Content
    $.ajax({
        type : 'GET',
        url : $(this).data('path'),

        success: function(result) {
            $('#dynamic-modal-alt div.modal-replacement-content').html(result);
            // $('#dynamic-modal-alt .modal-title').text(title);
        }
    });

    // Show Modal
    $('#dynamic-modal-alt').modal('show');
    
});