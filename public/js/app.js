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

/***/ "./resources/js/app.js":
/*!*****************************!*\
  !*** ./resources/js/app.js ***!
  \*****************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! ./bootstrap */ "./resources/js/bootstrap.js");

__webpack_require__(/*! ./search */ "./resources/js/search.js");

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
  });
  $("#discover-backdrop").on('click', function () {
    $('#discover-menu').slideToggle();
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

/***/ "./resources/js/search.js":
/*!********************************!*\
  !*** ./resources/js/search.js ***!
  \********************************/
/*! no static exports found */
/***/ (function(module, exports) {

$('.search-form .btn').on('click', function (event) {
  event.preventDefault();
  event.stopPropagation();
  var value = $('.search-field').val();
  $('.search-form').attr('action', '/search/' + value);
  $('.search-form').trigger('submit');
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

__webpack_require__(/*! /Users/syd/sites/neuly/resources/js/app.js */"./resources/js/app.js");
__webpack_require__(/*! /Users/syd/sites/neuly/resources/sass/app.scss */"./resources/sass/app.scss");
__webpack_require__(/*! /Users/syd/sites/neuly/resources/sass/index-qm.scss */"./resources/sass/index-qm.scss");
module.exports = __webpack_require__(/*! /Users/syd/sites/neuly/resources/sass/datatables.scss */"./resources/sass/datatables.scss");


/***/ })

/******/ });