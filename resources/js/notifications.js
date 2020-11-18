if ($(".notification-badge").length !== 0) {
    $(function () {
        var response = '';
        $.ajax({
            'method': 'get',
            'url': '/user/notifications/unread',
        }).done(function (data) {
            if (data > 0) {
                $('.notification-badge').text(data);
                $('.notification-badge').addClass('has-content');
            }
        });
    });
}
