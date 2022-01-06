$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function() {

	// Confirm Action
	$(document).on('click', '.confirm-action', function() {
		return confirm("Are you sure?");
	});

	// Initialize Tooltips
	$(function () {
		$('[data-toggle="tooltip"]').tooltip()
	});

	// Get Body Class
	let $body = $('body');

	// Viewport Function
	$.fn.isInViewport = function() {
		var elementTop = $(this).offset().top;
		var elementBottom = elementTop + $(this).outerHeight();
		var viewportTop = $(window).scrollTop();
		var viewportBottom = viewportTop + $(window).height();
		return elementBottom > viewportTop && elementTop < viewportBottom;
	};

	// Homepage Global vs Navbar Search
	if($body.hasClass('page-home')) {
		// If Homepage
		$(window).on('resize scroll', function() {

			// Search Form
			var hero = $('.home-hero');
			var navbarSearch = $('.global-search-form');

			if ($(hero).isInViewport() && $(window).width() > 991) {
				$(navbarSearch).slideUp();
			} else {
				$(navbarSearch).slideDown();
			}
		});
	}

	// Discover Menu -- Navigate Neuly
	$("#toggle-discover-menu").on('click', function() {
        $('#discover-menu').slideToggle();
        $('#discover-backdrop').toggle();
    });

    // Discover feedback -- Navigate Neuly
    $("#toggle-feedback-modal").on('click', function() {
        $('#discover-feedback').slideToggle();
        $('#discover-backdrop').toggle();
    });

    $('#submit-feedback').on('click', function(event) {
        event.preventDefault();
        let requestData = {
            'title': $('#feedback-form input[name="title"]').val(),
            'type': $('#feedback-form select[name="type"] option:selected').val(),
            'content': $('#feedback-form textarea[name="content"]').val(),
            'url': $(location).attr('href'),
            'user_name': $('#feedback-form input[name="user_name"]').val(),
            'user_email': $('#feedback-form input[name="user_email"]').val()
        };

        $.post("/api/feedback",requestData, function(data) {
            $('#feedback-form .alert-danger').hide();
            $('#feedback-form')[0].reset();
            $('#feedback-form .alert-success').show();
        }).fail(function (data) {
            let content  = '';

            Object.keys(data.responseJSON).forEach(function(key) {
                content = content + data.responseJSON[key] + '<br />';
            });

            $('#feedback-form .alert-danger').html(content);

            $('#feedback-form .alert-success').hide();
            $('#feedback-form .alert-danger').show();
        });
    })

    $("#discover-backdrop").on('click', function() {
        if($('#discover-menu').is(':visible')) {
            $('#discover-menu').slideToggle();
        }
        if($('#discover-feedback').is(':visible')) {
            $('#discover-feedback').slideToggle();
        }
        $('#discover-backdrop').toggle();
    });

    // Admin Menu
    $("#toggle-admin-menu").on('click', function() {
        $('#admin-menu').slideToggle();
        $('#admin-backdrop').toggle();
    });

    $("#admin-backdrop").on('click', function() {
        $('#admin-menu').slideToggle();
        $('#admin-backdrop').toggle();
    });

    // Global Search
    var globalSearchSuggestions = new Bloodhound({
	  datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
	  queryTokenizer: Bloodhound.tokenizers.whitespace,
	  prefetch: '/searchassets/everything.json'
	});

	globalSearchSuggestions.initialize();

	$('.js-global-search-input').typeahead(null,
	{
	  name: 'search-items',
	  display: 'name',
	  source: globalSearchSuggestions,
	  limit: 10,
	});

	// People Search on Research Index
    if ($('.research-authors .typeahead').length !== 0) {
        var researchAuthors = new Bloodhound({
            datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
            queryTokenizer: Bloodhound.tokenizers.whitespace,
            prefetch: '/searchassets/researchAuthors.json'
        });

        researchAuthors.initialize();

        $('.research-authors .typeahead').typeahead(null,
            {
                name: 'authors',
                display: 'name',
                source: researchAuthors,
                limit: 10,
            });
    }

    if ($('.investors-people .typeahead').length !== 0) {
        // People Search on Investors Index
        var investorsPeople = new Bloodhound({
            datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
            queryTokenizer: Bloodhound.tokenizers.whitespace,
            prefetch: '/searchassets/investorsPeople.json'
        });

        investorsPeople.initialize();

        $('.investors-people .typeahead').typeahead(null,
            {
                name: 'people',
                display: 'name',
                source: investorsPeople,
                limit: 10,
            });
    }

	// Organization Search on Investors Index
    if ($('.investors-organizations .typeahead').length !== 0) {
        var investorsOrganizations = new Bloodhound({
          datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
          queryTokenizer: Bloodhound.tokenizers.whitespace,
          prefetch: '/searchassets/investorsOrganizations.json'
        });

        investorsOrganizations.initialize();

        $('.investors-organizations .typeahead').typeahead(null,
        {
          name: 'organizations',
          display: 'name',
          source: investorsOrganizations,
          limit: 10,
        });
    }

	// Location Search on Organizations Index
    if ($('.organizations-locations .typeahead').length !== 0) {
        var companiesLocations = new Bloodhound({
            datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
            queryTokenizer: Bloodhound.tokenizers.whitespace,
            prefetch: '/searchassets/companiesLocations.json'
        });

        companiesLocations.initialize();

        $('.organizations-locations .typeahead').typeahead(null,
            {
                name: 'organizations',
                display: 'name',
                source: companiesLocations,
                limit: 10,
            });
    }

	// Regions Search on Locations Index
    if ($('.locations-locations .typeahead').length !== 0) {
        var locationsRegions = new Bloodhound({
            datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
            queryTokenizer: Bloodhound.tokenizers.whitespace,
            prefetch: '/searchassets/locationsRegions.json'
        });

        locationsRegions.initialize();

        $('.locations-locations .typeahead').typeahead(null,
            {
                name: 'organizations',
                display: 'name',
                source: locationsRegions,
                limit: 10,
            });
    }

	// Organization Search on Focus Index
    if ($('.focus-organizations .typeahead').length !== 0) {
        var focusOrganizations = new Bloodhound({
            datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
            queryTokenizer: Bloodhound.tokenizers.whitespace,
            prefetch: '/searchassets/focusOrganizations.json'
        });

        focusOrganizations.initialize();

        $('.focus-organizations .typeahead').typeahead(null,
            {
                name: 'organizations',
                display: 'name',
                source: focusOrganizations,
                limit: 10,
            });
    }

	$('.single-notification').on('mouseenter', function() {
	    let id = $(this).data('notification-id');

	    $.get('/dashboard/notifications/'+id+'/read');

        let button = $(this).find('.load-ajax-modal');

        button.removeClass('font-weight-bold');
        button.removeClass('btn-lg');
        button.removeClass('text-secondarydark');
        button.addClass('text-dark');
        button.addClass('lead-smaller');
    });

	$('.read-all-button').on('click', function(event) {
	    event.preventDefault();

        console.log($.get('/dashboard/notifications/read'));

        $('.single-notification').each(function() {
            let button = $(this).find('.load-ajax-modal');

            button.removeClass('font-weight-bold');
            button.removeClass('btn-lg');
            button.removeClass('text-secondarydark');
            button.addClass('text-dark');
            button.addClass('lead-smaller');
        })
    });
});

require('./bootstrap');
require('./notifications');
require('./insights');
import Cookies from 'js-cookie';
require('./global-search');
