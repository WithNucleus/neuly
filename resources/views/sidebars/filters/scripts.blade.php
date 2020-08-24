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

        return filters.join("|");
    }

    function build_filters_url() {
        // Build URL
        let url = '{{ $path }}';

        let allowedFilters = [
            'type',
            'locations',
            'company',
            'status',
            'focus',
            'people',
            'region',
            'countries',
            'hiring',
            'upcoming_events'
        ];

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

        console.log("URL: " + url);

        // Redirect
        document.location.href = url;
    }

    $(document).ready(function() {

        // Checkboxes
        $("#filterSidebar input[type=checkbox]").on('change', function() {
            get_filters_and_go();
        });

        // Radio Buttons
        $("#filterSidebar input[type=radio]").on('change', function() {
            get_filters_and_go();
        });

        // People Search
        $("input[name=people-search]").on('change', function() {
            console.log("people-search");
            console.log(this);
            console.log($(this).val());

            var name = $(this).val();

            var this_item = '<div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" name="people" id="' + name + '" value="' + name + '"checked><label class="custom-control-label" for="' + name + '">' + name + '</label></div>';

            $(this_item).insertAfter("#people-filter .title");

            get_filters_and_go();


        });

        // Organization Search
        $("input[name=organizations-search]").on('change', function() {
            console.log("organizations-search");
            console.log(this);
            console.log($(this).val());

            var name = $(this).val();

            var this_item = '<div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" name="company" id="' + name + '" value="' + name + '"checked><label class="custom-control-label" for="' + name + '">' + name + '</label></div>';

            $(this_item).insertAfter("#organizations-filter .title");

            get_filters_and_go();


        });

        // Organization Search
        $("input[name=locations-search]").on('change', function() {
            console.log("locations-search");
            console.log(this);
            console.log($(this).val());

            var name = $(this).val();

            var this_item = '<div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" name="locations" id="' + name + '" value="' + name + '"checked><label class="custom-control-label" for="' + name + '">' + name + '</label></div>';

            $(this_item).insertAfter("#locations-filter .title");

            get_filters_and_go();


        });

        // Region Search
        $("input[name=regions-search]").on('change', function() {
            console.log("regions-search");
            console.log(this);
            console.log($(this).val());

            var name = $(this).val();

            var this_item = '<div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" name="region" id="' + name + '" value="' + name + '"checked><label class="custom-control-label" for="' + name + '">' + name + '</label></div>';

            $(this_item).insertAfter("#regions-filter .title");

            get_filters_and_go();


        });

        // Sort Buttons
        $(".sort-records").click(function(){

            var new_sort = $(this).data("sort");

            get_filters_and_go(new_sort);
        });
    });

</script>
