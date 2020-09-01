<script>
    $(".js-fix-location-failure-button").on('click', function () {
        let errors = false,
            button = $(this),
            itemBlock = button.parent(),
            action = button.data('action'),
            model = button.data('model'),
            countryInput = itemBlock.find('input[name=country]'),
            regionInput = itemBlock.find('input[name=region]'),
            cityInput = itemBlock.find('input[name=city]'),
            country = countryInput.val().trim(),
            region = regionInput.val().trim(),
            city = cityInput.val().trim();

        countryInput.removeClass('is-invalid');
        regionInput.removeClass('is-invalid');

        if (country === '') {
            errors = true;
            countryInput.addClass('is-invalid');
        }

        if (region === '') {
            errors = true;
            regionInput.addClass('is-invalid');
        }

        if (errors === true) {
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
            itemBlock = button.parent(),
            model = button.data('model'),
            action = button.data('action');

        $.post(action, {'model' : model}, function (response){
            processRequestResponse(itemBlock, response.status);
        });
    });

    $(".js-delete-failure-button").on('click', function () {
        let button = $(this),
            itemBlock = button.parent(),
            action = button.data('action');

        $.post(action, {}, function (response){
            processRequestResponse(itemBlock, response.status);
        });
    });

    function processRequestResponse(itemBlock, status) {
        if (status === 'success') {
            itemBlock.slideUp();
        } else {
            itemBlock.find('.alert').removeClass('d-none');
        }
    }
</script>
