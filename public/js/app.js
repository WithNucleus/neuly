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
$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});
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
  $('.js-global-search-input').typeahead(null, {
    name: 'search-items',
    display: 'name',
    source: globalSearchSuggestions,
    limit: 10
  }); // People Search on Research Index

  if ($('.research-authors .typeahead').length !== 0) {
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
    $('.investors-people .typeahead').typeahead(null, {
      name: 'people',
      display: 'name',
      source: investorsPeople,
      limit: 10
    });
  } // Organization Search on Investors Index


  if ($('.investors-organizations .typeahead').length !== 0) {
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
    });
  } // Location Search on Organizations Index


  if ($('.organizations-locations .typeahead').length !== 0) {
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
    });
  } // Regions Search on Locations Index


  if ($('.locations-locations .typeahead').length !== 0) {
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
    });
  } // Organization Search on Focus Index


  if ($('.focus-organizations .typeahead').length !== 0) {
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
  }

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

__webpack_require__(/*! ./bootstrap */ "./resources/js/bootstrap.js");

__webpack_require__(/*! ./notifications */ "./resources/js/notifications.js");

__webpack_require__(/*! ./insights */ "./resources/js/insights.js");



__webpack_require__(/*! ./global-search */ "./resources/js/global-search.js");

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

/***/ "./resources/js/global-search.js":
/*!***************************************!*\
  !*** ./resources/js/global-search.js ***!
  \***************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$('.global-search-trigger').on('click', function (e) {
  e.preventDefault();
  $('#searchModal').show();
  $('#searchModal').addClass('show');
});
$('#searchModal .btn-close').on('click', function (e) {
  console.log('close modal');
  e.preventDefault();
  $('#searchModal').hide();
  $('#searchModal').removeClass('show');
});
$(function () {
  var searchClient = algoliasearch('2WZKZJIBUG', '686437b222f70e8cdbbba3899ea1f93d');
  /**
   * Define Company based search
   */

  var companySearch = instantsearch({
    indexName: 'companies',
    searchClient: searchClient
  });

  var renderStats = function renderStats(renderOptions, isFirstRender) {
    var nbHits = renderOptions.nbHits;
    document.querySelector('#companies #stats').innerHTML = nbHits;
  };

  var customStats = instantsearch.connectors.connectStats(renderStats);
  companySearch.addWidgets([instantsearch.widgets.configure({
    hitsPerPage: 6
  }), instantsearch.widgets.clearRefinements({
    container: '#companies #reset'
  }), instantsearch.widgets.hits({
    container: '#companies #hits',
    cssClasses: {
      list: ['d-flex', 'flex-wrap'],
      item: ['col-12', 'col-md-6', 'col-xl-4', 'mb-5']
    },
    templates: {
      item: "\n                    <div class=\"card shadow-sm\">\n                        <div class=\"pt-4 text-center\">\n                            <a href=\"https://neuly.com/organization/{{ slug }}\" class=\"text-decoration-none\">\n                                <div class=\"logo-is-contained\" style=\"background-image: url('{{ logo }}')\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"\" data-original-title=\"{{ name }}\"></div>\n                            </a>\n                            <p class=\"my-3 lead\">\n                                <a href=\"https://neuly.com/organization/{{ slug }}\" class=\"text-decoration-none\">{{ name }}</a>\n                            </p>\n\n                        </div>\n                    </div>\n                    "
    }
  }), customStats(), instantsearch.widgets.refinementList({
    container: '#companies #type',
    attribute: 'ownership'
  }), instantsearch.widgets.refinementList({
    container: '#companies #focus',
    attribute: 'focus',
    showMore: true
  }), instantsearch.widgets.refinementList({
    container: '#companies #countries',
    attribute: 'locations.country',
    showMore: false,
    searchable: true,
    searchablePlaceholder: 'e.g. United States',
    templates: {
      searchableSubmit: '<i class="fad fa-search fa-lg"></i>'
    }
  }), instantsearch.widgets.refinementList({
    container: '#companies #locations',
    attribute: 'locations.name',
    showMore: false,
    searchable: true,
    searchablePlaceholder: 'e.g. New York',
    templates: {
      searchableSubmit: '<i class="fad fa-search fa-lg"></i>'
    }
  }), instantsearch.widgets.toggleRefinement({
    container: '#companies #has-events',
    attribute: 'events',
    templates: {
      labelText: 'Upcoming Events'
    }
  }), instantsearch.widgets.toggleRefinement({
    container: '#companies #has-jobs',
    attribute: 'jobs',
    templates: {
      labelText: 'Now Hiring'
    }
  }), instantsearch.widgets.pagination({
    container: '#companies #pagination',
    cssClasses: {
      list: ['pagination'],
      item: ['page-item'],
      selectedItem: ['active'],
      disabledItem: ['disabled'],
      link: ['page-link']
    }
  })]);
  companySearch.start();
  /**
   * Define People based search
   */

  var peopleSearch = instantsearch({
    indexName: 'people',
    searchClient: searchClient
  });

  var renderPeopleStats = function renderPeopleStats(renderOptions, isFirstRender) {
    var nbHits = renderOptions.nbHits;
    document.querySelector('#people #stats').innerHTML = nbHits;
  };

  var customPeopleStats = instantsearch.connectors.connectStats(renderPeopleStats);
  peopleSearch.addWidgets([instantsearch.widgets.configure({
    hitsPerPage: 6
  }), instantsearch.widgets.clearRefinements({
    container: '#people #reset'
  }), instantsearch.widgets.hits({
    container: '#people #hits',
    cssClasses: {
      list: ['d-flex', 'flex-wrap'],
      item: ['col-12', 'col-md-6', 'col-xl-4', 'mb-5']
    },
    templates: {
      item: "\n                    <div class=\"card shadow-sm\">\n                        <div class=\"pt-4 text-center\">\n                            <a href=\"https://neuly.com/person/{{ slug }}\" class=\"text-decoration-none\">\n                                <div class=\"person-photo-small shadow-sm\" style=\"background-image: url('{{ photo }}')\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"\" data-original-title=\"{{ name }}\"></div>\n                            </a>\n                            <p class=\"my-3 lead\">\n                                <a href=\"https://neuly.com/person/{{ slug }}\" class=\"text-decoration-none\">{{ name }}</a>\n                            </p>\n\n                        </div>\n                    </div>\n                    "
    }
  }), customPeopleStats(), instantsearch.widgets.refinementList({
    container: '#people #countries',
    attribute: 'locations.country',
    showMore: false,
    searchable: true,
    searchablePlaceholder: 'e.g. United States',
    templates: {
      searchableSubmit: '<i class="fad fa-search fa-lg"></i>'
    }
  }), instantsearch.widgets.pagination({
    container: '#people #pagination',
    cssClasses: {
      list: ['pagination'],
      item: ['page-item'],
      selectedItem: ['active'],
      disabledItem: ['disabled'],
      link: ['page-link']
    }
  })]);
  peopleSearch.start();
  /**
   * Define Investor based search
   */

  var investorSearch = instantsearch({
    indexName: 'investors',
    searchClient: searchClient
  });

  var renderInvestorsStats = function renderInvestorsStats(renderOptions, isFirstRender) {
    var nbHits = renderOptions.nbHits;
    document.querySelector('#investors #stats').innerHTML = nbHits;
  };

  var customInvestorsStats = instantsearch.connectors.connectStats(renderInvestorsStats);
  investorSearch.addWidgets([instantsearch.widgets.configure({
    hitsPerPage: 6
  }), instantsearch.widgets.clearRefinements({
    container: '#investors #reset'
  }), instantsearch.widgets.hits({
    container: '#investors #hits',
    cssClasses: {
      list: ['d-flex', 'flex-wrap'],
      item: ['col-12', 'col-md-6', 'col-xl-4', 'mb-5']
    },
    templates: {
      item: "\n                    <div class=\"card shadow-sm\">\n                        <div class=\"pt-4 text-center\">\n                            <a href=\"https://neuly.com/investor/{{ slug }}\" class=\"text-decoration-none\">\n                                <div class=\"logo-is-contained\" style=\"background-image: url('{{ logo }}')\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"\" data-original-title=\"{{ name }}\"></div>\n                            </a>\n                            <p class=\"my-3 lead\">\n                                <a href=\"https://neuly.com/investor/{{ slug }}\" class=\"text-decoration-none\">{{ name }}</a>\n                            </p>\n\n                        </div>\n                    </div>\n                    "
    }
  }), customInvestorsStats(), instantsearch.widgets.refinementList({
    container: '#investors #countries',
    attribute: 'locations.country',
    showMore: false,
    searchable: true,
    searchablePlaceholder: 'e.g. United States',
    templates: {
      searchableSubmit: '<i class="fad fa-search fa-lg"></i>'
    }
  }), instantsearch.widgets.refinementList({
    container: '#investors #type',
    attribute: 'type'
  }), instantsearch.widgets.pagination({
    container: '#investors #pagination',
    cssClasses: {
      list: ['pagination'],
      item: ['page-item'],
      selectedItem: ['active'],
      disabledItem: ['disabled'],
      link: ['page-link']
    }
  }), instantsearch.widgets.toggleRefinement({
    container: '#investors #has-jobs',
    attribute: 'jobs',
    templates: {
      labelText: 'Now Hiring'
    }
  })]);
  investorSearch.start();
  /**
   * Define Research based search
   */

  var researchSearch = instantsearch({
    indexName: 'research',
    searchClient: searchClient
  });

  var renderResearchStats = function renderResearchStats(renderOptions, isFirstRender) {
    var nbHits = renderOptions.nbHits;
    document.querySelector('#research #stats').innerHTML = nbHits;
  };

  var customResearchStats = instantsearch.connectors.connectStats(renderResearchStats);
  researchSearch.addWidgets([instantsearch.widgets.configure({
    hitsPerPage: 4
  }), instantsearch.widgets.clearRefinements({
    container: '#research #reset'
  }), instantsearch.widgets.hits({
    container: '#research #hits',
    cssClasses: {
      list: ['d-flex', 'flex-wrap'],
      item: ['col-12', 'mb-5']
    },
    templates: {
      item: "\n                    <div class=\"card shadow-sm\">\n                        <div class=\"p-3\">\n                            <p class=\"lead\">\n                                <a href=\"https://neuly.com/research/{{ slug }}\" class=\"text-decoration-none\">{{ name }}</a>\n                            </p>\n                        </div>\n                    </div>\n                    "
    }
  }), customResearchStats(), instantsearch.widgets.refinementList({
    container: '#research #people',
    attribute: 'people',
    showMore: false,
    searchable: true,
    templates: {
      searchableSubmit: '<i class="fad fa-search fa-lg"></i>'
    }
  }), instantsearch.widgets.refinementList({
    container: '#research #focus',
    attribute: 'focus',
    showMore: true
  }), instantsearch.widgets.refinementList({
    container: '#research #companies',
    attribute: 'companies',
    showMore: true
  }), instantsearch.widgets.pagination({
    container: '#research #pagination',
    cssClasses: {
      list: ['pagination'],
      item: ['page-item'],
      selectedItem: ['active'],
      disabledItem: ['disabled'],
      link: ['page-link']
    }
  })]);
  researchSearch.start();
  /**
   * Define Clinical Trial based search
   */

  var clinicalTrialsSearch = instantsearch({
    indexName: 'clinicaltrials',
    searchClient: searchClient
  });

  var renderClinicalTrialsStats = function renderClinicalTrialsStats(renderOptions, isFirstRender) {
    var nbHits = renderOptions.nbHits;
    document.querySelector('#clinical-trials #stats').innerHTML = nbHits;
  };

  var customClinicalTrialsStats = instantsearch.connectors.connectStats(renderClinicalTrialsStats);
  clinicalTrialsSearch.addWidgets([instantsearch.widgets.configure({
    hitsPerPage: 4
  }), instantsearch.widgets.clearRefinements({
    container: '#clinical-trials #reset'
  }), instantsearch.widgets.hits({
    container: '#clinical-trials #hits',
    cssClasses: {
      list: ['d-flex', 'flex-wrap'],
      item: ['col-12', 'mb-5']
    },
    templates: {
      item: "\n                    <div class=\"card shadow-sm\">\n                        <div class=\"p-3\">\n                            <p class=\"lead\">\n                                <a href=\"https://neuly.com/research/{{ slug }}\" class=\"text-decoration-none\">{{ name }}</a>\n                            </p>\n                        </div>\n                    </div>\n                    "
    }
  }), customClinicalTrialsStats(), instantsearch.widgets.refinementList({
    container: '#clinical-trials #focus',
    attribute: 'focus',
    showMore: true
  }), instantsearch.widgets.refinementList({
    container: '#clinical-trials #companies',
    attribute: 'companies',
    showMore: true
  }), instantsearch.widgets.refinementList({
    container: '#clinical-trials #status',
    attribute: 'status',
    showMore: true
  }), instantsearch.widgets.refinementList({
    container: '#clinical-trials #people',
    attribute: 'people',
    showMore: false,
    searchable: true,
    templates: {
      searchableSubmit: '<i class="fad fa-search fa-lg"></i>'
    }
  }), instantsearch.widgets.pagination({
    container: '#clinical-trials #pagination',
    cssClasses: {
      list: ['pagination'],
      item: ['page-item'],
      selectedItem: ['active'],
      disabledItem: ['disabled'],
      link: ['page-link']
    }
  })]);
  clinicalTrialsSearch.start();
  /**
   * Define Event based search
   */

  var eventsSearch = instantsearch({
    indexName: 'events',
    searchClient: searchClient
  });

  var renderEventsStats = function renderEventsStats(renderOptions, isFirstRender) {
    var nbHits = renderOptions.nbHits;
    document.querySelector('#events #stats').innerHTML = nbHits;
  };

  var customEventsStats = instantsearch.connectors.connectStats(renderEventsStats);
  eventsSearch.addWidgets([instantsearch.widgets.configure({
    hitsPerPage: 4
  }), instantsearch.widgets.clearRefinements({
    container: '#events #reset'
  }), instantsearch.widgets.hits({
    container: '#events #hits',
    cssClasses: {
      list: ['d-flex', 'flex-wrap'],
      item: ['col-12', 'mb-5']
    },
    templates: {
      item: "\n                    <div class=\"card shadow-sm\">\n                        <div class=\"p-3\">\n                            <p class=\"lead\">\n                                <a href=\"https://neuly.com/event/{{ slug }}\" class=\"text-decoration-none\">{{ name }}</a>\n                            </p>\n                        </div>\n                    </div>\n                    "
    }
  }), customEventsStats(), instantsearch.widgets.refinementList({
    container: '#events #focus',
    attribute: 'focus',
    showMore: true
  }), instantsearch.widgets.refinementList({
    container: '#events #companies',
    attribute: 'companies',
    showMore: true
  }), instantsearch.widgets.refinementList({
    container: '#events #type',
    attribute: 'eventTypes',
    showMore: true
  }), instantsearch.widgets.refinementList({
    container: '#events #countries',
    attribute: 'locations.country',
    showMore: false,
    searchable: true,
    searchablePlaceholder: 'e.g. United States',
    templates: {
      searchableSubmit: '<i class="fad fa-search fa-lg"></i>'
    }
  }), instantsearch.widgets.pagination({
    container: '#events #pagination',
    cssClasses: {
      list: ['pagination'],
      item: ['page-item'],
      selectedItem: ['active'],
      disabledItem: ['disabled'],
      link: ['page-link']
    }
  })]);
  eventsSearch.start();
  /**
   * Define Jobs based search
   */

  var jobsSearch = instantsearch({
    indexName: 'jobs',
    searchClient: searchClient
  });

  var renderJobsStats = function renderJobsStats(renderOptions, isFirstRender) {
    var nbHits = renderOptions.nbHits;
    document.querySelector('#jobs #stats').innerHTML = nbHits;
  };

  var customJobsStats = instantsearch.connectors.connectStats(renderJobsStats);
  jobsSearch.addWidgets([instantsearch.widgets.configure({
    hitsPerPage: 4
  }), instantsearch.widgets.clearRefinements({
    container: '#jobs #reset'
  }), instantsearch.widgets.hits({
    container: '#jobs #hits',
    cssClasses: {
      list: ['d-flex', 'flex-wrap'],
      item: ['col-12', 'mb-5']
    },
    templates: {
      item: "\n                    <div class=\"card shadow-sm\">\n                        <div class=\"p-3\">\n                            <p class=\"lead\">\n                                <a href=\"https://neuly.com/jobs/{{ slug }}\" class=\"text-decoration-none\">{{ name }}</a>\n                            </p>\n                        </div>\n                    </div>\n                    "
    }
  }), customJobsStats(), instantsearch.widgets.refinementList({
    container: '#jobs #countries',
    attribute: 'locations.country',
    showMore: false,
    searchable: true,
    searchablePlaceholder: 'e.g. United States',
    templates: {
      searchableSubmit: '<i class="fad fa-search fa-lg"></i>'
    }
  }), instantsearch.widgets.refinementList({
    container: '#jobs #type',
    attribute: 'employment_type',
    showMore: true
  }), instantsearch.widgets.refinementList({
    container: '#jobs #companies',
    attribute: 'owner',
    showMore: true
  }), instantsearch.widgets.pagination({
    container: '#events #pagination',
    cssClasses: {
      list: ['pagination'],
      item: ['page-item'],
      selectedItem: ['active'],
      disabledItem: ['disabled'],
      link: ['page-link']
    }
  })]);
  jobsSearch.start();
  $('#search-button').on('click', function (e) {
    var query = $('#search-input').val().trim();
    companySearch.helper.setQuery(query).search();
    peopleSearch.helper.setQuery(query).search();
    investorSearch.helper.setQuery(query).search();
    researchSearch.helper.setQuery(query).search();
    clinicalTrialsSearch.helper.setQuery(query).search();
    eventsSearch.helper.setQuery(query).search();
    jobsSearch.helper.setQuery(query).search();
  });
});

/***/ }),

/***/ "./resources/js/insights.js":
/*!**********************************!*\
  !*** ./resources/js/insights.js ***!
  \**********************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! ./insights/collaborators-list */ "./resources/js/insights/collaborators-list.js");

__webpack_require__(/*! ./insights/most-interest-list */ "./resources/js/insights/most-interest-list.js");
/* Global Chart Settings */


Chart.defaults.global.defaultFontColor = '#111';
Chart.defaults.global.defaultFontFamily = '"Roboto", Avenir, "Helvetica", Arial, sans-serif';

if ($(".insights-grid").length !== 0) {
  window.addEventListener("load", function () {
    setTimeout(function () {
      $('.insights-grid').masonry().animate({
        opacity: 1
      });
      $('.loading').hide();
    }, 1000);
  });
}

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
$('.js-top-ten-list-chart').each(function () {
  var itemsHtml = '',
      itemsList = $(this),
      action = itemsList.data('action'),
      itemTemplate = itemsList.find('.js-item-template').clone(),
      icon = '<i class="' + itemsList.data('icon-class') + '"></i> ';
  $.getJSON(action, {}, function (response) {
    if (response !== '') {
      response.forEach(function (item, i) {
        var bar = '',
            link = '<a href="' + item.link + '">' + item.name + '</a>';

        for (var j = 0; j < item.percent; j++) {
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
      itemsList.html(itemsHtml).show();
    }
  });
});
$('.js-bar-chart').each(function (i, item) {
  new Chartisan({
    el: item,
    url: $(this).data('action'),
    hooks: new ChartisanHooks().colors(['rgba(63, 69, 49, 1)']).responsive().beginAtZero().legend(false).datasets(['bar'])
  });
});

if ($("#open-full-screen-table").length) {
  document.getElementById('open-full-screen-table').onclick = function () {
    maximizeContent();
  };
}

if ($("#close-full-screen-table").length) {
  document.getElementById('close-full-screen-table').onclick = function () {
    closeCsv();
  };
}

function maximizeContent() {
  document.getElementById('resizable-fullscreen-table-container').classList.toggle('fixed');
  document.getElementById('close-full-screen-table').classList.toggle('d-none');
  document.body.classList.toggle('noscroll');
}

function closeCsv() {
  document.getElementById('resizable-fullscreen-table-container').classList.toggle('fixed');
  document.getElementById('close-full-screen-table').classList.toggle('d-none');
  document.body.classList.toggle('noscroll');
}

/***/ }),

/***/ "./resources/js/insights/collaborators-list.js":
/*!*****************************************************!*\
  !*** ./resources/js/insights/collaborators-list.js ***!
  \*****************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(document).ready(function () {
  if ($(".collaborators-list").length !== 0) {
    if ($('.collaborators-list') !== undefined) {
      var order = 'DESC';
      var focusFilter = [];
      var requestData = {
        'orderBy': order,
        'focus': focusFilter
      };
      $.post("/insights/collaborators/list", [], function (data) {
        var resultHtml = "";
        data.forEach(function (value) {
          var item = "<tr><td><a href='/organization/" + value.slug + "'>" + value.name + "</a></td><td>" + value.trials + "</td></tr>";
          resultHtml = resultHtml + item;
        });
        $('.collaborators-body').html(resultHtml);
      }).fail(function (data) {// set fail behaviour
      });
    }
  }
});

/***/ }),

/***/ "./resources/js/insights/most-interest-list.js":
/*!*****************************************************!*\
  !*** ./resources/js/insights/most-interest-list.js ***!
  \*****************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(document).ready(function () {
  if ($(".focus-list").length !== 0) {
    if ($('.focus-list') !== undefined) {
      var order = 'DESC';
      var requestData = {
        'orderBy': order
      };
      $.post("/insights/most-interest/list", [], function (data) {
        var resultHtml = "";
        data.forEach(function (value) {
          var item = "<tr><td><a href='clinical-trials?filter[focus]=" + value.name + "'>" + value.name + "</a></td><td>" + value.trials + "</td></tr>";
          resultHtml = resultHtml + item;
        });
        $('.focus-body').html(resultHtml);
      }).fail(function (data) {// set fail behaviour
      });
    }
  }
});

/***/ }),

/***/ "./resources/js/notifications.js":
/*!***************************************!*\
  !*** ./resources/js/notifications.js ***!
  \***************************************/
/*! no static exports found */
/***/ (function(module, exports) {

if ($(".notification-badge").length !== 0) {
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
}

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

/***/ "./resources/sass/embed-search.scss":
/*!******************************************!*\
  !*** ./resources/sass/embed-search.scss ***!
  \******************************************/
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
/*!****************************************************************************************************************************************************************!*\
  !*** multi ./resources/js/app.js ./resources/sass/app.scss ./resources/sass/index-qm.scss ./resources/sass/datatables.scss ./resources/sass/embed-search.scss ***!
  \****************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! /var/www/neuly/resources/js/app.js */"./resources/js/app.js");
__webpack_require__(/*! /var/www/neuly/resources/sass/app.scss */"./resources/sass/app.scss");
__webpack_require__(/*! /var/www/neuly/resources/sass/index-qm.scss */"./resources/sass/index-qm.scss");
__webpack_require__(/*! /var/www/neuly/resources/sass/datatables.scss */"./resources/sass/datatables.scss");
module.exports = __webpack_require__(/*! /var/www/neuly/resources/sass/embed-search.scss */"./resources/sass/embed-search.scss");


/***/ })

/******/ });