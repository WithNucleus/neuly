import * as bootstrap from 'bootstrap';
window.bootstrap = bootstrap;

import $ from "jquery";

try {
    window.Popper = require('@popperjs/core');
    require('bootstrap');
} catch (e) {
    console.log(e);
}

import './color-modes';

let tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
let tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl)
});

/* Confirm */
let confirmationButtons = document.querySelectorAll('.confirm-action');

confirmationButtons.forEach(button => {
    button.addEventListener('click', function(event) {
        if (confirm("Are you sure?") !== true) {
            event.preventDefault();
        }
    });
});

/* CSRF Token Ajax */
$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});

/* Toast Notifications */
window.addEventListener('toast-notification', event => {
    let time = 4000;

    if(window.innerWidth < 768) {
        time = 2000;
    }

    let backgroundColor = 'bg-quaternary';

    if (event.detail.background) {
        backgroundColor =  event.detail.background;
    }

    let textColor = 'text-white';

    if (event.detail.color) {
        textColor =  event.detail.color;
    }

    let toastContainer = document.querySelector('#toast-container');

    let toastElement = document.createElement('div');
    toastElement.classList.add('toast', 'show', backgroundColor, textColor, 'border-0');

    let toastBody = document.createElement('div');
    toastBody.classList.add('toast-body', 'd-flex');

    let toastText = document.createElement('span');
    toastText.innerText = event.detail.text;

    let closeButton = document.createElement('button');
    closeButton.classList.add('btn-close', 'btn-close-white', 'me-2', 'm-auto');
    closeButton.ariaLabel = 'Close';
    closeButton.setAttribute('data-bs-dismiss', 'toast');

    toastContainer.appendChild(toastElement);
    toastElement.appendChild(toastBody);
    toastBody.appendChild(toastText);
    toastBody.appendChild(closeButton);

    setTimeout(() => {
        toastElement.remove();
    }, time);
});

// $(document).ready(function() {
//
// 	// Confirm Action
// 	$(document).on('click', '.confirm-action', function() {
// 		return confirm("Are you sure?");
// 	});
//
// 	// Initialize Tooltips
// 	$(function () {
// 		$('[data-toggle="tooltip"]').tooltip()
// 	});
//
// 	// Get Body Class
// 	let $body = $('body');
//
// 	// Viewport Function
// 	$.fn.isInViewport = function() {
// 		var elementTop = $(this).offset().top;
// 		var elementBottom = elementTop + $(this).outerHeight();
// 		var viewportTop = $(window).scrollTop();
// 		var viewportBottom = viewportTop + $(window).height();
// 		return elementBottom > viewportTop && elementTop < viewportBottom;
// 	};
//
// 	// Discover Menu -- Navigate Neuly
// 	$("#toggle-discover-menu").on('click', function() {
//         $('#discover-menu').slideToggle();
//         $('#discover-backdrop').toggle();
//     });
//
//     // Discover feedback -- Navigate Neuly
//     $("#toggle-feedback-modal").on('click', function() {
//         $('#discover-feedback').slideToggle();
//         $('#discover-backdrop').toggle();
//     });
//
//     $('#submit-feedback').on('click', function(event) {
//         event.preventDefault();
//         let requestData = {
//             'title': $('#feedback-form input[name="title"]').val(),
//             'type': $('#feedback-form select[name="type"] option:selected').val(),
//             'content': $('#feedback-form textarea[name="content"]').val(),
//             'url': $(location).attr('href'),
//             'user_name': $('#feedback-form input[name="user_name"]').val(),
//             'user_email': $('#feedback-form input[name="user_email"]').val()
//         };
//
//         $.post("/api/feedback",requestData, function(data) {
//             $('#feedback-form .alert-danger').hide();
//             $('#feedback-form')[0].reset();
//             $('#feedback-form .alert-success').show();
//         }).fail(function (data) {
//             let content  = '';
//
//             Object.keys(data.responseJSON).forEach(function(key) {
//                 content = content + data.responseJSON[key] + '<br />';
//             });
//
//             $('#feedback-form .alert-danger').html(content);
//
//             $('#feedback-form .alert-success').hide();
//             $('#feedback-form .alert-danger').show();
//         });
//     })
//
//     $("#discover-backdrop").on('click', function() {
//         if($('#discover-menu').is(':visible')) {
//             $('#discover-menu').slideToggle();
//         }
//         if($('#discover-feedback').is(':visible')) {
//             $('#discover-feedback').slideToggle();
//         }
//         $('#discover-backdrop').toggle();
//     });
//
//     // Admin Menu
//     $("#toggle-admin-menu").on('click', function() {
//         $('#admin-menu').slideToggle();
//         $('#admin-backdrop').toggle();
//     });
//
//     $("#admin-backdrop").on('click', function() {
//         $('#admin-menu').slideToggle();
//         $('#admin-backdrop').toggle();
//     });
//
//     // Global Search
//     var globalSearchSuggestions = new Bloodhound({
// 	  datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
// 	  queryTokenizer: Bloodhound.tokenizers.whitespace,
// 	  prefetch: '/searchassets/everything.json'
// 	});
//
// 	globalSearchSuggestions.initialize();
//
// 	$('.js-global-search-input').typeahead(null,
// 	{
// 	  name: 'search-items',
// 	  display: 'name',
// 	  source: globalSearchSuggestions,
// 	  limit: 10,
// 	});
//
// 	// People Search on Research Index
//     if ($('.research-authors .typeahead').length !== 0) {
//         var researchAuthors = new Bloodhound({
//             datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
//             queryTokenizer: Bloodhound.tokenizers.whitespace,
//             prefetch: '/searchassets/researchAuthors.json'
//         });
//
//         researchAuthors.initialize();
//
//         $('.research-authors .typeahead').typeahead(null,
//             {
//                 name: 'authors',
//                 display: 'name',
//                 source: researchAuthors,
//                 limit: 10,
//             });
//     }
//
//     if ($('.investors-people .typeahead').length !== 0) {
//         // People Search on Investors Index
//         var investorsPeople = new Bloodhound({
//             datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
//             queryTokenizer: Bloodhound.tokenizers.whitespace,
//             prefetch: '/searchassets/investorsPeople.json'
//         });
//
//         investorsPeople.initialize();
//
//         $('.investors-people .typeahead').typeahead(null,
//             {
//                 name: 'people',
//                 display: 'name',
//                 source: investorsPeople,
//                 limit: 10,
//             });
//     }
//
// 	// Organization Search on Investors Index
//     if ($('.investors-organizations .typeahead').length !== 0) {
//         var investorsOrganizations = new Bloodhound({
//           datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
//           queryTokenizer: Bloodhound.tokenizers.whitespace,
//           prefetch: '/searchassets/investorsOrganizations.json'
//         });
//
//         investorsOrganizations.initialize();
//
//         $('.investors-organizations .typeahead').typeahead(null,
//         {
//           name: 'organizations',
//           display: 'name',
//           source: investorsOrganizations,
//           limit: 10,
//         });
//     }
//
// 	// Regions Search on Locations Index
//     if ($('.filter-locations .typeahead').length !== 0) {
//         var actionUrl = $('.filter-locations .typeahead').data('action-url');
//         var locationsList = new Bloodhound({
//             datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
//             queryTokenizer: Bloodhound.tokenizers.whitespace,
//             prefetch: actionUrl
//         });
//
//         locationsList.initialize();
//
//         $('.filter-locations .typeahead').typeahead(null,
//             {
//                 name: 'organizations',
//                 display: 'name',
//                 source: locationsList,
//                 limit: 10,
//             });
//     }
//
// 	// Organization Search on Focus Index
//     if ($('.focus-organizations .typeahead').length !== 0) {
//         var focusOrganizations = new Bloodhound({
//             datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
//             queryTokenizer: Bloodhound.tokenizers.whitespace,
//             prefetch: '/searchassets/focusOrganizations.json'
//         });
//
//         focusOrganizations.initialize();
//
//         $('.focus-organizations .typeahead').typeahead(null,
//             {
//                 name: 'organizations',
//                 display: 'name',
//                 source: focusOrganizations,
//                 limit: 10,
//             });
//     }
//
// 	$('.single-notification').on('mouseenter', function() {
// 	    let id = $(this).data('notification-id');
//
// 	    $.get('/dashboard/notifications/'+id+'/read');
//
//         let button = $(this).find('.load-ajax-modal');
//
//         button.removeClass('font-weight-bold');
//         button.removeClass('btn-lg');
//         button.removeClass('text-secondarydark');
//         button.addClass('text-dark');
//         button.addClass('lead-smaller');
//     });
//
// 	$('.read-all-button').on('click', function(event) {
// 	    event.preventDefault();
//
//         console.log($.get('/dashboard/notifications/read'));
//
//         $('.single-notification').each(function() {
//             let button = $(this).find('.load-ajax-modal');
//
//             button.removeClass('font-weight-bold');
//             button.removeClass('btn-lg');
//             button.removeClass('text-secondarydark');
//             button.addClass('text-dark');
//             button.addClass('lead-smaller');
//         })
//     });
// });

// require('./bootstrap');
// require('./notifications');
// require('./insights');
// require('./limited-access-modal');
import Cookies from 'js-cookie';
