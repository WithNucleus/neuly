$('.js-top-ten-locations-list').each(function () {
    let itemsHtml    = '',
        itemsList    = $(this),
        action       = itemsList.data('action'),
        itemTemplate = itemsList.find('.js-item-template').clone(),
        icon = '<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-person-fill" fill="#D81E5B" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/></svg>';

    $.getJSON(action, {}, function (response) {
        if (response !== '') {
            response.forEach(function (item, i) {
                let bar = '',
                    link = '<a href="' + item.link + '">' + item.name + '</a>';

                for (i = 0; i < item.percent; i++) {
                    bar += icon;
                }

                itemTemplate.find('.js-item-link').html(link);
                itemTemplate.find('.js-item-bar').html(bar);
                itemTemplate.removeClass('js-item-template', 'd-none');

                if (i === response.length - 1){
                    itemTemplate.addClass('border-bottom-0');
                }

                itemsHtml += itemTemplate.get(0).outerHTML;
            });

            itemsList.html(itemsHtml).slideDown();
        }
    });
});
