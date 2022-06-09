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

    if ($('.js-fix-sponsor-failure-search-company-input') !== undefined) {

        let companySearchInputs = $('.js-fix-sponsor-failure-search-company-input'),
            companyGetListAction =  companySearchInputs.first().data('action'),
            companyType = companySearchInputs.first().data('entity-type'),
            companyIdsByName = [],
            companyNames = [];

        $.getJSON(companyGetListAction, {'entity_type': companyType }, function(response) {
            if (response.status === 'ok') {
                $.each(response.data, function (i, item) {
                    companyNames.push(item.name);
                    companyIdsByName[item.name] = item.id;
                });

                let companyEntitiesList = new Bloodhound({
                    datumTokenizer: Bloodhound.tokenizers.whitespace,
                    queryTokenizer: Bloodhound.tokenizers.whitespace,
                    local: companyNames
                });

                companySearchInputs.each(function (){
                    let input = $(this),
                        idInput = input.siblings('.js-company-id-input');

                    input.typeahead(null, {
                        name: 'master',
                        source: companyEntitiesList
                    });
                    input.attr('disabled', false);

                    input.bind('typeahead:select', function (event, item) {
                        input.removeClass('is-invalid')
                        idInput.val(companyIdsByName[item]);
                    });
                });
            }
        });
    }

    $('.js-fix-sponsor-failure-attach-company-button').on('click', function () {
        let button = $(this),
            itemBlock = button.parents('.js-failure-item-container'),
            searchInput = itemBlock.find('.js-fix-company-search-input'),
            companyId = itemBlock.find('.js-company-id-input').val(),
            action = button.data('action'),
            model = button.data('model');

        if (!companyId) {
            searchInput.addClass('is-invalid');
            return false;
        }

        let data = {
            'model' : model,
            'id': companyId,
        };

        $.post(action, data, function (response){
            processRequestResponse(itemBlock, response.status);
        });
    });

    if ($('.js-fix-sponsor-failure-search-person-input') !== undefined) {

        let peopleSearchInputs = $('.js-fix-sponsor-failure-search-person-input'),
            peopleGetListAction =  peopleSearchInputs.first().data('action'),
            personType = peopleSearchInputs.first().data('entity-type'),
            peopleIdsByName = [],
            peopleNames = [];

        $.getJSON(peopleGetListAction, {'entity_type': personType }, function(response) {
            if (response.status === 'ok') {
                $.each(response.data, function (i, item) {
                    peopleNames.push(item.name);
                    peopleIdsByName[item.name] = item.id;
                });

                let peopleEntitiesList = new Bloodhound({
                    datumTokenizer: Bloodhound.tokenizers.whitespace,
                    queryTokenizer: Bloodhound.tokenizers.whitespace,
                    local: peopleNames
                });

                peopleSearchInputs.each(function (){
                    let input = $(this),
                        idInput = input.siblings('.js-person-id-input');

                    input.typeahead(null, {
                        name: 'master',
                        source: peopleEntitiesList
                    });
                    input.attr('disabled', false);

                    input.bind('typeahead:select', function (event, item) {
                        input.removeClass('is-invalid')
                        idInput.val(peopleIdsByName[item]);
                    });
                });
            }
        });
    }

    $('.js-fix-sponsor-failure-attach-person-button').on('click', function () {
        let button = $(this),
            itemBlock = button.parents('.js-failure-item-container'),
            searchInput = itemBlock.find('.js-fix-person-search-input'),
            personId = itemBlock.find('.js-person-id-input').val(),
            action = button.data('action'),
            model = button.data('model');

        if (!personId) {
            searchInput.addClass('is-invalid');
            return false;
        }

        let data = {
            'model' : model,
            'id': personId,
        };

        $.post(action, data, function (response){
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

    $(".js-fix-people-orgs-failure-button").on('click', function () {
        let button = $(this),
            itemBlock = button.parents('.js-failure-item-container'),
            action = button.data('action'),
            type = button.data('type'),
            companyId = itemBlock.find('input[name=company_id').val(),
            data = {
                'type': type,
                'company_id': companyId
            };

        let inputsSelector = '.js-import-data-input';

        if (type === 'update') {
            inputsSelector += ':enabled';
        }

        itemBlock.find(inputsSelector).each(function () {
            data[$(this).attr('name')] = $(this).val();
        });

        $.post(action, data, function (response){
            processRequestResponse(itemBlock, response.status);
        });
    });

    $('.js-toogle-input-checkbox').on('change', function (event) {
        let checkbox = $(this);
        let input = checkbox.parents('.input-group').find('.js-import-data-input');

        input.prop('disabled', !checkbox.prop('checked'));
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
