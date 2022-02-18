$(function() {
    if ($('body').hasClass('unauthorized') && $("#limitedAccessModal").length !== 0) {
        $('#limitedAccessModal').modal({backdrop: 'static', keyboard: false}).show();
        $('body').css('overflow', 'hidden');
    }
});
