<script>

    function clearFilters() {
        window.location.replace('{{ $path }}');
    }

    function get_filters(filterName) {

        var filters = [];

        $.each($("input[name='" + filterName + "']:checked"), function(){
            filters.push($(this).val());
        });

        return filters.join("|");
    }

    function build_url(type, locations, companies, status, focus, people, regions, countries, hiring) {

        // Build URL
        var url = '{{ $path }}';

        if (type != '') {

            url = url + '?filter[type]=' + type;

        }

        if (locations != '') {

            // Add & or ?
            if (type == '') {

                url = url + '?filter[locations]=' + locations;

            } else {

                url = url + '&filter[locations]=' + locations;
            }

        }

        if (companies != '') {

            // Add & or ?
            if (type == '' && locations == '') {

                url = url + '?filter[company]=' + companies;

            } else {

                url = url + '&filter[company]=' + companies;
            }

        }

        if (status != '') {

            // Add & or ?
            if (type == '' && locations == '' && companies == '') {

                url = url + '?filter[status]=' + status;

            } else {

                url = url + '&filter[status]=' + status;
            }

        }

        if (focus != '') {

            // Add & or ?
            if (type == '' && locations == '' && companies == '' && status == '') {

                url = url + '?filter[focus]=' + focus;

            } else {

                url = url + '&filter[focus]=' + focus;
            }

        }

        if (people != '') {

            // Add & or ?
            if (type == '' && locations == '' && companies == '' && status == '' && focus == '') {

                url = url + '?filter[people]=' + people;

            } else {

                url = url + '&filter[people]=' + people;
            }

        }

        if (regions != '') {

            // Add & or ?
            if (type == '' && locations == '' && companies == '' && status == '' && focus == '' && people == '') {

                url = url + '?filter[region]=' + regions;

            } else {

                url = url + '&filter[region]=' + regions;
            }

        }

        if (countries != '') {

            // Add & or ?
            if (type == '' && locations == '' && companies == '' && status == '' && focus == '' && people == '' && regions == '') {

                url = url + '?filter[countries]=' + countries;

            } else {

                url = url + '&filter[countries]=' + countries;
            }

        }

        if (hiring != '') {

            // Add & or ?
            if (type == '' && locations == '' && companies == '' && status == '' && focus == '' && people == '' && regions == '' && countries == '') {

                url = url + '?filter[hiring]=' + hiring;

            } else {

                url = url + '&filter[hiring]=' + hiring;
            }

        }

        // console.log(url);

        // document.location.href=url;
        return url;

    }

    function get_filters_and_go(new_sort = '') {

        var type = get_filters('type');
        var locations = get_filters('location');
        var companies = get_filters('company');
        var status = get_filters('status');
        var focus = get_filters('focus');
        var people = get_filters('people');
        var regions = get_filters('region');
        var countries = get_filters('countries');
        var hiring = get_filters('hiring');

        // Build URL
        var url = build_url(type, locations, companies, status, focus, people, regions, countries, hiring);

        // console.log("URL with filters: " + url);

        // Check Sorting
        var current_sort = '{{ $sort }}';

        if (new_sort != '') {

            // use new_sort
            if (type == '' && locations == '' && companies == '' && status == '' && focus == '' && people == '' && hiring == '') {
                url = url + '?sort=' + new_sort;
            } else {
                url = url + '&sort=' + new_sort;
            }

        } else {

            // new_sort is blank so check current_sort
            if (current_sort != '') {

                if (type == '' && locations == '' && companies == '' && status == '' && focus == '' && people == '' && hiring == '') {
                    url = url + '?sort=' + current_sort;
                } else {
                    url = url + '&sort=' + current_sort;
                }
            }

        }

        console.log("URL: " + url);

        // Redirect
        document.location.href=url;

    }

    $(document).ready(function() {

        // Checkboxes
        $("input[type=checkbox]").on('change', function() {

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

            var this_item = '<div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" name="location" id="' + name + '" value="' + name + '"checked><label class="custom-control-label" for="' + name + '">' + name + '</label></div>';

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

        // Radio Buttons
        $("input[type=radio]").on('change', function() {

            get_filters_and_go();

        });

        // Sort Buttons
        $(".sort-records").click(function(){

            var new_sort = $(this).data("sort");

            get_filters_and_go(new_sort);
        });
    });

</script>
