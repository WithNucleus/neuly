<link rel="stylesheet" href="{{ asset('assets/bootstrap-tagsinput.css') }}"/>
<script type="text/javascript" src="{{ asset('assets/typeahead.js') }}"></script>
<script>
    if ($('.js-fix-location-search-input') !== undefined) {

        let searchInputs = $('.js-fix-location-search-input'),
            getListAction =  searchInputs.first().data('action'),
            entityType = searchInputs.first().data('entity-type'),
            entityIdsByName = [],
            entityNames = [];

        $.getJSON(getListAction, {'entity_type': entityType }, function(response) {
            if (response.status === 'ok') {
                $.each(response.data, function (i, item) {
                    entityNames.push(item.name);
                    entityIdsByName[item.name] = item.id;
                });

                let entitiesList = new Bloodhound({
                    datumTokenizer: Bloodhound.tokenizers.whitespace,
                    queryTokenizer: Bloodhound.tokenizers.whitespace,
                    local: entityNames
                });

                searchInputs.each(function (){
                    let input = $(this),
                        locationIdInput = input.siblings('.js-location-id-input');

                    input.typeahead(null, {
                        name: 'master',
                        source: entitiesList
                    });
                    input.attr('disabled', false);

                    input.bind('typeahead:select', function (event, item) {
                        input.removeClass('is-invalid')
                        locationIdInput.val(entityIdsByName[item]);
                    });
                });
            }
        });
    }

    $('.js-fix-location-failure-attach-button').on('click', function () {
        let button = $(this),
            itemBlock = button.parents('.js-failure-item-container'),
            searchInput = itemBlock.find('.js-fix-location-search-input'),
            locationId = itemBlock.find('.js-location-id-input').val(),
            action = button.data('action'),
            model = button.data('model');

        if (!locationId) {
            searchInput.addClass('is-invalid');
            return false;
        }

        let data = {
            'model'      : model,
            'location_id': locationId,
        };

        $.post(action, data, function (response){
            processRequestResponse(itemBlock, response.status);
        });
    });

    $(".js-fix-location-failure-button").on('click', function () {
        let button = $(this),
            itemBlock = button.parents('.js-failure-item-container'),
            action = button.data('action'),
            model = button.data('model'),
            countryInput = itemBlock.find('input[name=country]'),
            regionInput = itemBlock.find('input[name=region]'),
            cityInput = itemBlock.find('input[name=city]'),
            country = countryInput.val().trim(),
            region = regionInput.val().trim(),
            city = cityInput.val().trim();

        countryInput.removeClass('is-invalid');

        if (country === '') {
            countryInput.addClass('is-invalid');
            return false;
        }

        let data = {
            'model'  : model,
            'country': country,
            'region' : region,
            'city'   : city
        };

        $.post(action, data, function (response){
            processRequestResponse(itemBlock, response.status);
        });
    });

    $(".js-fix-sponsor-failure-button").on('click', function () {
        let button = $(this),
            itemBlock = button.parents('.js-failure-item-container'),
            model = button.data('model'),
            action = button.data('action');

        $.post(action, {'model' : model}, function (response){
            processRequestResponse(itemBlock, response.status);
        });
    });

    $(".js-fix-image-failure-button").on('click', function () {
        let button = $(this),
            itemBlock = button.parents('.js-failure-item-container'),
            action = button.data('action'),
            image = itemBlock.find('input[type=file]').prop("files")[0],
            formData = new FormData();

        formData.append("image", image);

        $.ajax({
            url: action,
            method: 'post',
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            success: function (response) {
                processRequestResponse(itemBlock, response.status);
            }
        });
    });

    $(".js-delete-failure-button").on('click', function () {
        let button = $(this),
            itemBlock = button.parents('.js-failure-item-container'),
            action = button.data('action');

        $.post(action, {}, function (response){
            processRequestResponse(itemBlock, response.status);
        });
    });

    $('.js-custom-file-input').on('change', function (event) {
        let input = event.target;
        let fileName = input.files[0].name;
        $(input).siblings('label').text(fileName);
    });

    function processRequestResponse(itemBlock, status) {
        if (status === 'success') {
            itemBlock.slideUp();
        } else {
            itemBlock.find('.js-fix-action-error').show();
        }
    }
</script>
