/* On Discover Dropdown Change */
$("select.discover").change(function(){

	// Get Value
	var value = $(this).val();

	// Redirect Based on Value
	if (value == 'dashboard') {
		window.location.replace("/dashboard");
	} else if (value == 'home') {
		window.location.replace("/");
	} else if (value == 'organizations') {
		window.location.replace("/organizations");
	} else if (value == 'people') {
		window.location.replace("/people");
	} else if (value == 'investors') {
		window.location.replace("/investors");
	} else if (value == 'research') {
		window.location.replace("/research");
	} else if (value == 'locations') {
		window.location.replace("/locations/map");
	} else if (value == 'focus') {
		window.location.replace("/focus");
	} else if (value == 'events') {
		window.location.replace("/events");
	} else if (value == 'jobs') {
		window.location.replace("/jobs");
	} else if (value == 'clinicaltrials') {
		window.location.replace("/clinical-trials");
	} else if (value == 'insights') {
		window.location.replace("/insights");
	} else if (value == 'index') {
		window.location.replace("/psychedelic-index");
	} else if (value == 'news') {
        window.location.replace("/news");
    } else if (value == 'books') {
        window.location.replace("/books");
    } else if (value == 'podcasts') {
        window.location.replace("/podcasts");
    }


});
