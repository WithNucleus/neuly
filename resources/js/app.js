require('./bootstrap');
require('./notifications');

import Cookies from 'js-cookie';

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

	$('#homepage-discover .typeahead').typeahead(null,
	{
	  name: 'search-items',
	  display: 'name',
	  source: globalSearchSuggestions,
	  limit: 10,
	});

	$('.global-search-form .typeahead').typeahead(null,
	{
	  name: 'search-items',
	  display: 'name',
	  source: globalSearchSuggestions,
	  limit: 10,
	});

	// People Search on Research Index
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

	// Organization Search on Investors Index
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

	// Location Search on Organizations Index
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

	// Regions Search on Locations Index
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

	// Organization Search on Focus Index
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
    })

    /* Global Chart Settings */
    Chart.defaults.global.defaultFontColor = '#111';
    Chart.defaults.global.defaultFontFamily = '"Roboto", Avenir, "Helvetica", Arial, sans-serif';

    $('.js-chart-pie-with-action').each(function () {
        let canvasObj = $(this),
            action    = canvasObj.data('action');

        $.getJSON(action, {}, function (response) {
            new Chart(canvasObj, {
                type: 'pie',
                data: {
                    datasets: [{
                        data: response.values,
                        backgroundColor: response.colors
                    }],
                    labels: response.labels
                },
                options: {
                    scales: {
                        xAxes: [{
                            display: false,
                        }],
                        yAxes: [{
                            display: false,

                        }],
                    },
                    legend: {
                        position: 'bottom'
                    }
                }
            });
        });
    });

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

});
