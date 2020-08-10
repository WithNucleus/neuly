require('./bootstrap');
require('./search');

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

    $("#discover-backdrop").on('click', function() {
        $('#discover-menu').slideToggle();
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

});