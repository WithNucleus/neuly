/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./node_modules/js-cookie/src/js.cookie.js":
/*!*************************************************!*\
  !*** ./node_modules/js-cookie/src/js.cookie.js ***!
  \*************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

var __WEBPACK_AMD_DEFINE_FACTORY__, __WEBPACK_AMD_DEFINE_RESULT__;/*!
 * JavaScript Cookie v2.2.1
 * https://github.com/js-cookie/js-cookie
 *
 * Copyright 2006, 2015 Klaus Hartl & Fagner Brack
 * Released under the MIT license
 */
;(function (factory) {
	var registeredInModuleLoader;
	if (true) {
		!(__WEBPACK_AMD_DEFINE_FACTORY__ = (factory),
				__WEBPACK_AMD_DEFINE_RESULT__ = (typeof __WEBPACK_AMD_DEFINE_FACTORY__ === 'function' ?
				(__WEBPACK_AMD_DEFINE_FACTORY__.call(exports, __webpack_require__, exports, module)) :
				__WEBPACK_AMD_DEFINE_FACTORY__),
				__WEBPACK_AMD_DEFINE_RESULT__ !== undefined && (module.exports = __WEBPACK_AMD_DEFINE_RESULT__));
		registeredInModuleLoader = true;
	}
	if (true) {
		module.exports = factory();
		registeredInModuleLoader = true;
	}
	if (!registeredInModuleLoader) {
		var OldCookies = window.Cookies;
		var api = window.Cookies = factory();
		api.noConflict = function () {
			window.Cookies = OldCookies;
			return api;
		};
	}
}(function () {
	function extend () {
		var i = 0;
		var result = {};
		for (; i < arguments.length; i++) {
			var attributes = arguments[ i ];
			for (var key in attributes) {
				result[key] = attributes[key];
			}
		}
		return result;
	}

	function decode (s) {
		return s.replace(/(%[0-9A-Z]{2})+/g, decodeURIComponent);
	}

	function init (converter) {
		function api() {}

		function set (key, value, attributes) {
			if (typeof document === 'undefined') {
				return;
			}

			attributes = extend({
				path: '/'
			}, api.defaults, attributes);

			if (typeof attributes.expires === 'number') {
				attributes.expires = new Date(new Date() * 1 + attributes.expires * 864e+5);
			}

			// We're using "expires" because "max-age" is not supported by IE
			attributes.expires = attributes.expires ? attributes.expires.toUTCString() : '';

			try {
				var result = JSON.stringify(value);
				if (/^[\{\[]/.test(result)) {
					value = result;
				}
			} catch (e) {}

			value = converter.write ?
				converter.write(value, key) :
				encodeURIComponent(String(value))
					.replace(/%(23|24|26|2B|3A|3C|3E|3D|2F|3F|40|5B|5D|5E|60|7B|7D|7C)/g, decodeURIComponent);

			key = encodeURIComponent(String(key))
				.replace(/%(23|24|26|2B|5E|60|7C)/g, decodeURIComponent)
				.replace(/[\(\)]/g, escape);

			var stringifiedAttributes = '';
			for (var attributeName in attributes) {
				if (!attributes[attributeName]) {
					continue;
				}
				stringifiedAttributes += '; ' + attributeName;
				if (attributes[attributeName] === true) {
					continue;
				}

				// Considers RFC 6265 section 5.2:
				// ...
				// 3.  If the remaining unparsed-attributes contains a %x3B (";")
				//     character:
				// Consume the characters of the unparsed-attributes up to,
				// not including, the first %x3B (";") character.
				// ...
				stringifiedAttributes += '=' + attributes[attributeName].split(';')[0];
			}

			return (document.cookie = key + '=' + value + stringifiedAttributes);
		}

		function get (key, json) {
			if (typeof document === 'undefined') {
				return;
			}

			var jar = {};
			// To prevent the for loop in the first place assign an empty array
			// in case there are no cookies at all.
			var cookies = document.cookie ? document.cookie.split('; ') : [];
			var i = 0;

			for (; i < cookies.length; i++) {
				var parts = cookies[i].split('=');
				var cookie = parts.slice(1).join('=');

				if (!json && cookie.charAt(0) === '"') {
					cookie = cookie.slice(1, -1);
				}

				try {
					var name = decode(parts[0]);
					cookie = (converter.read || converter)(cookie, name) ||
						decode(cookie);

					if (json) {
						try {
							cookie = JSON.parse(cookie);
						} catch (e) {}
					}

					jar[name] = cookie;

					if (key === name) {
						break;
					}
				} catch (e) {}
			}

			return key ? jar[key] : jar;
		}

		api.set = set;
		api.get = function (key) {
			return get(key, false /* read as raw */);
		};
		api.getJSON = function (key) {
			return get(key, true /* read as json */);
		};
		api.remove = function (key, attributes) {
			set(key, '', extend(attributes, {
				expires: -1
			}));
		};

		api.defaults = {};

		api.withConverter = init;

		return api;
	}

	return init(function () {});
}));


/***/ }),

/***/ "./resources/js/app.js":
/*!*****************************!*\
  !*** ./resources/js/app.js ***!
  \*****************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var js_cookie__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! js-cookie */ "./node_modules/js-cookie/src/js.cookie.js");
/* harmony import */ var js_cookie__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(js_cookie__WEBPACK_IMPORTED_MODULE_0__);
__webpack_require__(/*! ./bootstrap */ "./resources/js/bootstrap.js");

__webpack_require__(/*! ./notifications */ "./resources/js/notifications.js");

__webpack_require__(/*! ./insights */ "./resources/js/insights.js");


$(document).ready(function () {
  // Confirm Action
  $(document).on('click', '.confirm-action', function () {
    return confirm("Are you sure?");
  }); // Initialize Tooltips

  $(function () {
    $('[data-toggle="tooltip"]').tooltip();
  }); // Get Body Class

  var $body = $('body'); // Viewport Function

  $.fn.isInViewport = function () {
    var elementTop = $(this).offset().top;
    var elementBottom = elementTop + $(this).outerHeight();
    var viewportTop = $(window).scrollTop();
    var viewportBottom = viewportTop + $(window).height();
    return elementBottom > viewportTop && elementTop < viewportBottom;
  }; // Homepage Global vs Navbar Search


  if ($body.hasClass('page-home')) {
    // If Homepage
    $(window).on('resize scroll', function () {
      // Search Form
      var hero = $('.home-hero');
      var navbarSearch = $('.global-search-form');

      if ($(hero).isInViewport() && $(window).width() > 991) {
        $(navbarSearch).slideUp();
      } else {
        $(navbarSearch).slideDown();
      }
    });
  } // Discover Menu -- Navigate Neuly


  $("#toggle-discover-menu").on('click', function () {
    $('#discover-menu').slideToggle();
    $('#discover-backdrop').toggle();
  }); // Discover feedback -- Navigate Neuly

  $("#toggle-feedback-modal").on('click', function () {
    $('#discover-feedback').slideToggle();
    $('#discover-backdrop').toggle();
  });
  $('#submit-feedback').on('click', function (event) {
    event.preventDefault();
    var requestData = {
      'title': $('#feedback-form input[name="title"]').val(),
      'type': $('#feedback-form select[name="type"] option:selected').val(),
      'content': $('#feedback-form textarea[name="content"]').val(),
      'url': $(location).attr('href'),
      'user_name': $('#feedback-form input[name="user_name"]').val(),
      'user_email': $('#feedback-form input[name="user_email"]').val()
    };
    $.post("/api/feedback", requestData, function (data) {
      $('#feedback-form .alert-danger').hide();
      $('#feedback-form')[0].reset();
      $('#feedback-form .alert-success').show();
    }).fail(function (data) {
      var content = '';
      Object.keys(data.responseJSON).forEach(function (key) {
        content = content + data.responseJSON[key] + '<br />';
      });
      $('#feedback-form .alert-danger').html(content);
      $('#feedback-form .alert-success').hide();
      $('#feedback-form .alert-danger').show();
    });
  });
  $("#discover-backdrop").on('click', function () {
    if ($('#discover-menu').is(':visible')) {
      $('#discover-menu').slideToggle();
    }

    if ($('#discover-feedback').is(':visible')) {
      $('#discover-feedback').slideToggle();
    }

    $('#discover-backdrop').toggle();
  }); // Admin Menu

  $("#toggle-admin-menu").on('click', function () {
    $('#admin-menu').slideToggle();
    $('#admin-backdrop').toggle();
  });
  $("#admin-backdrop").on('click', function () {
    $('#admin-menu').slideToggle();
    $('#admin-backdrop').toggle();
  }); // Global Search

  var globalSearchSuggestions = new Bloodhound({
    datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
    queryTokenizer: Bloodhound.tokenizers.whitespace,
    prefetch: '/searchassets/everything.json'
  });
  globalSearchSuggestions.initialize();
  $('#homepage-discover .typeahead').typeahead(null, {
    name: 'search-items',
    display: 'name',
    source: globalSearchSuggestions,
    limit: 10
  });
  $('.global-search-form .typeahead').typeahead(null, {
    name: 'search-items',
    display: 'name',
    source: globalSearchSuggestions,
    limit: 10
  }); // People Search on Research Index

  var researchAuthors = new Bloodhound({
    datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
    queryTokenizer: Bloodhound.tokenizers.whitespace,
    prefetch: '/searchassets/researchAuthors.json'
  });
  researchAuthors.initialize();
  $('.research-authors .typeahead').typeahead(null, {
    name: 'authors',
    display: 'name',
    source: researchAuthors,
    limit: 10
  }); // People Search on Investors Index

  var investorsPeople = new Bloodhound({
    datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
    queryTokenizer: Bloodhound.tokenizers.whitespace,
    prefetch: '/searchassets/investorsPeople.json'
  });
  investorsPeople.initialize();
  $('.investors-people .typeahead').typeahead(null, {
    name: 'people',
    display: 'name',
    source: investorsPeople,
    limit: 10
  }); // Organization Search on Investors Index

  var investorsOrganizations = new Bloodhound({
    datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
    queryTokenizer: Bloodhound.tokenizers.whitespace,
    prefetch: '/searchassets/investorsOrganizations.json'
  });
  investorsOrganizations.initialize();
  $('.investors-organizations .typeahead').typeahead(null, {
    name: 'organizations',
    display: 'name',
    source: investorsOrganizations,
    limit: 10
  }); // Location Search on Organizations Index

  var companiesLocations = new Bloodhound({
    datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
    queryTokenizer: Bloodhound.tokenizers.whitespace,
    prefetch: '/searchassets/companiesLocations.json'
  });
  companiesLocations.initialize();
  $('.organizations-locations .typeahead').typeahead(null, {
    name: 'organizations',
    display: 'name',
    source: companiesLocations,
    limit: 10
  }); // Regions Search on Locations Index

  var locationsRegions = new Bloodhound({
    datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
    queryTokenizer: Bloodhound.tokenizers.whitespace,
    prefetch: '/searchassets/locationsRegions.json'
  });
  locationsRegions.initialize();
  $('.locations-locations .typeahead').typeahead(null, {
    name: 'organizations',
    display: 'name',
    source: locationsRegions,
    limit: 10
  }); // Organization Search on Focus Index

  var focusOrganizations = new Bloodhound({
    datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
    queryTokenizer: Bloodhound.tokenizers.whitespace,
    prefetch: '/searchassets/focusOrganizations.json'
  });
  focusOrganizations.initialize();
  $('.focus-organizations .typeahead').typeahead(null, {
    name: 'organizations',
    display: 'name',
    source: focusOrganizations,
    limit: 10
  });
  $('.single-notification').on('mouseenter', function () {
    var id = $(this).data('notification-id');
    $.get('/dashboard/notifications/' + id + '/read');
    var button = $(this).find('.load-ajax-modal');
    button.removeClass('font-weight-bold');
    button.removeClass('btn-lg');
    button.removeClass('text-secondarydark');
    button.addClass('text-dark');
    button.addClass('lead-smaller');
  });
  $('.read-all-button').on('click', function (event) {
    event.preventDefault();
    console.log($.get('/dashboard/notifications/read'));
    $('.single-notification').each(function () {
      var button = $(this).find('.load-ajax-modal');
      button.removeClass('font-weight-bold');
      button.removeClass('btn-lg');
      button.removeClass('text-secondarydark');
      button.addClass('text-dark');
      button.addClass('lead-smaller');
    });
  });
});

/***/ }),

/***/ "./resources/js/bootstrap.js":
/*!***********************************!*\
  !*** ./resources/js/bootstrap.js ***!
  \***********************************/
/*! no static exports found */
/***/ (function(module, exports) {

//window._ = require('lodash');

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */
//window.axios = require('axios');
//window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */
// import Echo from 'laravel-echo';
// window.Pusher = require('pusher-js');
// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.MIX_PUSHER_APP_KEY,
//     cluster: process.env.MIX_PUSHER_APP_CLUSTER,
//     forceTLS: true
// });

/***/ }),

/***/ "./resources/js/insights.js":
/*!**********************************!*\
  !*** ./resources/js/insights.js ***!
  \**********************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! ./insights/topTenLocations */ "./resources/js/insights/topTenLocations.js");
/* Global Chart Settings */


Chart.defaults.global.defaultFontColor = '#111';
Chart.defaults.global.defaultFontFamily = '"Roboto", Avenir, "Helvetica", Arial, sans-serif';
$('.js-chart-pie-with-action').each(function () {
  var canvasObj = $(this),
      action = canvasObj.data('action');
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
            display: false
          }],
          yAxes: [{
            display: false
          }]
        },
        legend: {
          position: 'bottom'
        }
      }
    });
  });
});

/***/ }),

/***/ "./resources/js/insights/topTenLocations.js":
/*!**************************************************!*\
  !*** ./resources/js/insights/topTenLocations.js ***!
  \**************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$('.js-top-ten-locations-list').each(function () {
  var itemsHtml = '',
      itemsList = $(this),
      action = itemsList.data('action'),
      itemTemplate = itemsList.find('.js-item-template').clone(),
      icon = '<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-person-fill" fill="#D81E5B" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/></svg>';
  $.getJSON(action, {}, function (response) {
    if (response !== '') {
      response.forEach(function (item, i) {
        var bar = '',
            link = '<a href="' + item.link + '">' + item.name + '</a>';

        for (i = 0; i < item.percent; i++) {
          bar += icon;
        }

        itemTemplate.find('.js-item-link').html(link);
        itemTemplate.find('.js-item-bar').html(bar);
        itemTemplate.removeClass('js-item-template', 'd-none');

        if (i === response.length - 1) {
          itemTemplate.addClass('border-bottom-0');
        }

        itemsHtml += itemTemplate.get(0).outerHTML;
      });
      itemsList.html(itemsHtml).slideDown();
    }
  });
});

/***/ }),

/***/ "./resources/js/notifications.js":
/*!***************************************!*\
  !*** ./resources/js/notifications.js ***!
  \***************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(function () {
  var response = '';
  $.ajax({
    'method': 'get',
    'url': '/user/notifications/unread'
  }).done(function (data) {
    if (data > 0) {
      $('.notification-badge').text(data);
      $('.notification-badge').addClass('has-content');
    }
  });
});

/***/ }),

/***/ "./resources/sass/app.scss":
/*!*********************************!*\
  !*** ./resources/sass/app.scss ***!
  \*********************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/sass/datatables.scss":
/*!****************************************!*\
  !*** ./resources/sass/datatables.scss ***!
  \****************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/sass/index-qm.scss":
/*!**************************************!*\
  !*** ./resources/sass/index-qm.scss ***!
  \**************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ 0:
/*!*****************************************************************************************************************************!*\
  !*** multi ./resources/js/app.js ./resources/sass/app.scss ./resources/sass/index-qm.scss ./resources/sass/datatables.scss ***!
  \*****************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! /var/www/neuly/resources/js/app.js */"./resources/js/app.js");
__webpack_require__(/*! /var/www/neuly/resources/sass/app.scss */"./resources/sass/app.scss");
__webpack_require__(/*! /var/www/neuly/resources/sass/index-qm.scss */"./resources/sass/index-qm.scss");
module.exports = __webpack_require__(/*! /var/www/neuly/resources/sass/datatables.scss */"./resources/sass/datatables.scss");


/***/ })

/******/ });