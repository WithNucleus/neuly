$('.search-form .btn').on('click', function(event) {
    event.preventDefault();
    event.stopPropagation();

    var value = $('.search-field').val();
    $('.search-form').attr('action', '/search/'+value);
    $('.search-form').trigger('submit');
});
