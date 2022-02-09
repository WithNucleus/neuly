<script>
    let isFirstQueryParam = true;

    function getUrlParamPrefix() {
        if (isFirstQueryParam === true) {
            isFirstQueryParam = false;
            return '?';
        }

        return '&';
    }

    function clearFilters() {
        window.location.replace('{{ $path }}');
    }

    function getFilterValuesByName(filterName) {
        var filters = [];

        $("#filterSidebar input[name='" + filterName + "']:checked").each(function(){
            filters.push($(this).val());
        });

        $("#filterSidebar select[name='" + filterName + "'] option:selected").each(function(){
            filters.push($(this).val());
        });

        if(filterName === 'valuation_min' || filterName === 'valuation_max' || filterName === 'age') {
            filters.push($("#filterSidebar input[name='" + filterName + "']").val());
        }

        return filters.join("|");
    }

    function build_filters_url() {
        // Build URL
        let url = '{{ $path }}';

        let allowedFilters = [
            'type',
            'locations',
            'company',
            'investor',
            'status',
            'focus',
            'people',
            'region',
            'countries',
            'hiring',
            'upcoming_events',
            'phase',
            'researchers',
            'conditions',
            'interventions',
            'outcome_measures',
            'study_designs',
            'foundation_year',
            'valuation_min',
            'valuation_max',
            'age',
            'gender',
            'year',
        ];

        $('#filterSidebar input').prop('disabled', true);

        allowedFilters.forEach(function (filterName) {
            let filters = getFilterValuesByName(filterName);

            if (filters != '') {
                url += getUrlParamPrefix() + 'filter[' + filterName + ']=' + filters;
            }
        });

        return url;
    }

    function get_filters_and_go(new_sort = '') {

        // Build URL
        var url = build_filters_url();

        // Check Sorting
        var current_sort = '{{ $sort }}';

        if (new_sort != '') {
            url += getUrlParamPrefix() + 'sort=' + new_sort;
        } else if (current_sort != '') {
            url += getUrlParamPrefix() + 'sort=' + current_sort;
        }

        // Redirect

        document.location.href = url;
    }

    $(document).ready(function() {

        $('.js-typeahead-filter').each(function () {
            let input = $(this),
                name = input.attr('name'),
                action = input.data('action');

            let resource = new Bloodhound({
                datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
                queryTokenizer: Bloodhound.tokenizers.whitespace,
                prefetch: action
            });

            resource.initialize();

            input.typeahead(null, {
                name: name,
                display: 'name',
                source: resource,
                limit: 10,
            })
        });

        $('.js-typeahead-filter').on('change', function() {
            let input = $(this),
                name = input.attr('name'),
                value = $(this).val(),
                container = input.parents('.js-typeahead-filter-container'),
                valuesBlock = container.find('.js-typeahead-filter-values');

            let checkbox = '<div class="custom-control custom-checkbox">' +
                '<input type="checkbox" class="custom-control-input" name="' + name + '" id="' + value + '" value="' + value + '" checked>' +
                '<label class="custom-control-label" for="' + value + '">' + value + '</label></div>';

            valuesBlock.append(checkbox);

            get_filters_and_go();
        });

        // Checkboxes
        $("#filterSidebar input[type=checkbox]").on('change', function() {
            get_filters_and_go();
        });

        $("#filterSidebar select").on('change', function() {
            get_filters_and_go();
        });

        // Radio Buttons
        $("#filterSidebar input[type=radio]").on('change', function() {
            get_filters_and_go();
        });

        // People Search
        $("input[name=people-search]").on('change', function() {
            let name = $(this).val();

            let this_item = '<div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" name="people" id="' + name + '" value="' + name + '"checked><label class="custom-control-label" for="' + name + '">' + name + '</label></div>';

            $(this_item).insertAfter("#people-filter .title");

            get_filters_and_go();
        });

        // Organization Search
        $("input[name=organizations-search]").on('change', function() {
            let name = $(this).val();

            let this_item = '<div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" name="company" id="' + name + '" value="' + name + '"checked><label class="custom-control-label" for="' + name + '">' + name + '</label></div>';

            $(this_item).insertAfter("#organizations-filter .title");

            get_filters_and_go();
        });

        // Location Search
        $("input[name=locations-search]").on('change', function() {
            let name = $(this).val();

            let this_item = '<div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" name="locations" id="' + name + '" value="' + name + '"checked><label class="custom-control-label" for="' + name + '">' + name + '</label></div>';

            $(this_item).insertAfter("#locations-filter .title");

            get_filters_and_go();
        });

        // Region Search
        $("input[name=regions-search]").on('change', function() {
            let name = $(this).val();

            let this_item = '<div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" name="region" id="' + name + '" value="' + name + '"checked><label class="custom-control-label" for="' + name + '">' + name + '</label></div>';

            $(this_item).insertAfter("#regions-filter .title");

            get_filters_and_go();
        });

        // Sort Buttons
        $(".sort-records").on('click', function(){

            let new_sort = $(this).data("sort");

            get_filters_and_go(new_sort);
        });

        $(".set-valuation-filter").on('click', function() {
            let min_input = $("input[name=valuation_min]");
            let max_input = $("input[name=valuation_max]");

            let values = slider.noUiSlider.get();

            console.log(values[0], values[1])

            min_input.val(values[0]);
            max_input.val(values[1]);

            get_filters_and_go();
        })

        $(".set-age-filter").on('click', function() {
            let min_input = $("input[name=age]");

            let values = slider.noUiSlider.get();

            console.log(parseInt(values));

            min_input.val(parseInt(values));

            get_filters_and_go();
        })

        $(".js-collapse-filter")
            .on('show.bs.collapse', function(){
                $(this).prev(".toggle-more").find(".fad").removeClass("fa-arrow-square-down").addClass("fa-arrow-square-up");
                $(this).prev(".toggle-more").find("span").html("Show Less");
            })
            .on('hide.bs.collapse', function(){
                $(this).prev(".toggle-more").find(".fad").removeClass("fa-arrow-square-up").addClass("fa-arrow-square-down");
                $(this).prev(".toggle-more").find("span").html("Show More");
            });
    });

</script>
