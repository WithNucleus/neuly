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
/******/ 	return __webpack_require__(__webpack_require__.s = 4);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./node_modules/algoliasearch/dist/algoliasearch-lite.umd.js":
/*!*******************************************************************!*\
  !*** ./node_modules/algoliasearch/dist/algoliasearch-lite.umd.js ***!
  \*******************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

/*! algoliasearch-lite.umd.js | 4.12.0 | © Algolia, inc. | https://github.com/algolia/algoliasearch-client-javascript */
!function(e,t){ true?module.exports=t():undefined}(this,(function(){"use strict";function e(e,t,r){return t in e?Object.defineProperty(e,t,{value:r,enumerable:!0,configurable:!0,writable:!0}):e[t]=r,e}function t(e,t){var r=Object.keys(e);if(Object.getOwnPropertySymbols){var n=Object.getOwnPropertySymbols(e);t&&(n=n.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),r.push.apply(r,n)}return r}function r(r){for(var n=1;n<arguments.length;n++){var o=null!=arguments[n]?arguments[n]:{};n%2?t(Object(o),!0).forEach((function(t){e(r,t,o[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(r,Object.getOwnPropertyDescriptors(o)):t(Object(o)).forEach((function(e){Object.defineProperty(r,e,Object.getOwnPropertyDescriptor(o,e))}))}return r}function n(e,t){if(null==e)return{};var r,n,o=function(e,t){if(null==e)return{};var r,n,o={},a=Object.keys(e);for(n=0;n<a.length;n++)r=a[n],t.indexOf(r)>=0||(o[r]=e[r]);return o}(e,t);if(Object.getOwnPropertySymbols){var a=Object.getOwnPropertySymbols(e);for(n=0;n<a.length;n++)r=a[n],t.indexOf(r)>=0||Object.prototype.propertyIsEnumerable.call(e,r)&&(o[r]=e[r])}return o}function o(e,t){return function(e){if(Array.isArray(e))return e}(e)||function(e,t){if(!(Symbol.iterator in Object(e)||"[object Arguments]"===Object.prototype.toString.call(e)))return;var r=[],n=!0,o=!1,a=void 0;try{for(var u,i=e[Symbol.iterator]();!(n=(u=i.next()).done)&&(r.push(u.value),!t||r.length!==t);n=!0);}catch(e){o=!0,a=e}finally{try{n||null==i.return||i.return()}finally{if(o)throw a}}return r}(e,t)||function(){throw new TypeError("Invalid attempt to destructure non-iterable instance")}()}function a(e){return function(e){if(Array.isArray(e)){for(var t=0,r=new Array(e.length);t<e.length;t++)r[t]=e[t];return r}}(e)||function(e){if(Symbol.iterator in Object(e)||"[object Arguments]"===Object.prototype.toString.call(e))return Array.from(e)}(e)||function(){throw new TypeError("Invalid attempt to spread non-iterable instance")}()}function u(e){var t,r="algoliasearch-client-js-".concat(e.key),n=function(){return void 0===t&&(t=e.localStorage||window.localStorage),t},a=function(){return JSON.parse(n().getItem(r)||"{}")};return{get:function(e,t){var r=arguments.length>2&&void 0!==arguments[2]?arguments[2]:{miss:function(){return Promise.resolve()}};return Promise.resolve().then((function(){var r=JSON.stringify(e),n=a()[r];return Promise.all([n||t(),void 0!==n])})).then((function(e){var t=o(e,2),n=t[0],a=t[1];return Promise.all([n,a||r.miss(n)])})).then((function(e){return o(e,1)[0]}))},set:function(e,t){return Promise.resolve().then((function(){var o=a();return o[JSON.stringify(e)]=t,n().setItem(r,JSON.stringify(o)),t}))},delete:function(e){return Promise.resolve().then((function(){var t=a();delete t[JSON.stringify(e)],n().setItem(r,JSON.stringify(t))}))},clear:function(){return Promise.resolve().then((function(){n().removeItem(r)}))}}}function i(e){var t=a(e.caches),r=t.shift();return void 0===r?{get:function(e,t){var r=arguments.length>2&&void 0!==arguments[2]?arguments[2]:{miss:function(){return Promise.resolve()}},n=t();return n.then((function(e){return Promise.all([e,r.miss(e)])})).then((function(e){return o(e,1)[0]}))},set:function(e,t){return Promise.resolve(t)},delete:function(e){return Promise.resolve()},clear:function(){return Promise.resolve()}}:{get:function(e,n){var o=arguments.length>2&&void 0!==arguments[2]?arguments[2]:{miss:function(){return Promise.resolve()}};return r.get(e,n,o).catch((function(){return i({caches:t}).get(e,n,o)}))},set:function(e,n){return r.set(e,n).catch((function(){return i({caches:t}).set(e,n)}))},delete:function(e){return r.delete(e).catch((function(){return i({caches:t}).delete(e)}))},clear:function(){return r.clear().catch((function(){return i({caches:t}).clear()}))}}}function s(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:{serializable:!0},t={};return{get:function(r,n){var o=arguments.length>2&&void 0!==arguments[2]?arguments[2]:{miss:function(){return Promise.resolve()}},a=JSON.stringify(r);if(a in t)return Promise.resolve(e.serializable?JSON.parse(t[a]):t[a]);var u=n(),i=o&&o.miss||function(){return Promise.resolve()};return u.then((function(e){return i(e)})).then((function(){return u}))},set:function(r,n){return t[JSON.stringify(r)]=e.serializable?JSON.stringify(n):n,Promise.resolve(n)},delete:function(e){return delete t[JSON.stringify(e)],Promise.resolve()},clear:function(){return t={},Promise.resolve()}}}function c(e){for(var t=e.length-1;t>0;t--){var r=Math.floor(Math.random()*(t+1)),n=e[t];e[t]=e[r],e[r]=n}return e}function l(e,t){return t?(Object.keys(t).forEach((function(r){e[r]=t[r](e)})),e):e}function f(e){for(var t=arguments.length,r=new Array(t>1?t-1:0),n=1;n<t;n++)r[n-1]=arguments[n];var o=0;return e.replace(/%s/g,(function(){return encodeURIComponent(r[o++])}))}var h={WithinQueryParameters:0,WithinHeaders:1};function d(e,t){var r=e||{},n=r.data||{};return Object.keys(r).forEach((function(e){-1===["timeout","headers","queryParameters","data","cacheable"].indexOf(e)&&(n[e]=r[e])})),{data:Object.entries(n).length>0?n:void 0,timeout:r.timeout||t,headers:r.headers||{},queryParameters:r.queryParameters||{},cacheable:r.cacheable}}var m={Read:1,Write:2,Any:3},p=1,v=2,y=3;function g(e){var t=arguments.length>1&&void 0!==arguments[1]?arguments[1]:p;return r(r({},e),{},{status:t,lastUpdate:Date.now()})}function b(e){return"string"==typeof e?{protocol:"https",url:e,accept:m.Any}:{protocol:e.protocol||"https",url:e.url,accept:e.accept||m.Any}}var O="GET",P="POST";function q(e,t){return Promise.all(t.map((function(t){return e.get(t,(function(){return Promise.resolve(g(t))}))}))).then((function(e){var r=e.filter((function(e){return function(e){return e.status===p||Date.now()-e.lastUpdate>12e4}(e)})),n=e.filter((function(e){return function(e){return e.status===y&&Date.now()-e.lastUpdate<=12e4}(e)})),o=[].concat(a(r),a(n));return{getTimeout:function(e,t){return(0===n.length&&0===e?1:n.length+3+e)*t},statelessHosts:o.length>0?o.map((function(e){return b(e)})):t}}))}function w(e,t,n,o){var u=[],i=function(e,t){if(e.method===O||void 0===e.data&&void 0===t.data)return;var n=Array.isArray(e.data)?e.data:r(r({},e.data),t.data);return JSON.stringify(n)}(n,o),s=function(e,t){var n=r(r({},e.headers),t.headers),o={};return Object.keys(n).forEach((function(e){var t=n[e];o[e.toLowerCase()]=t})),o}(e,o),c=n.method,l=n.method!==O?{}:r(r({},n.data),o.data),f=r(r(r({"x-algolia-agent":e.userAgent.value},e.queryParameters),l),o.queryParameters),h=0,d=function t(r,a){var l=r.pop();if(void 0===l)throw{name:"RetryError",message:"Unreachable hosts - your application id may be incorrect. If the error persists, contact support@algolia.com.",transporterStackTrace:A(u)};var d={data:i,headers:s,method:c,url:S(l,n.path,f),connectTimeout:a(h,e.timeouts.connect),responseTimeout:a(h,o.timeout)},m=function(e){var t={request:d,response:e,host:l,triesLeft:r.length};return u.push(t),t},p={onSuccess:function(e){return function(e){try{return JSON.parse(e.content)}catch(t){throw function(e,t){return{name:"DeserializationError",message:e,response:t}}(t.message,e)}}(e)},onRetry:function(n){var o=m(n);return n.isTimedOut&&h++,Promise.all([e.logger.info("Retryable failure",x(o)),e.hostsCache.set(l,g(l,n.isTimedOut?y:v))]).then((function(){return t(r,a)}))},onFail:function(e){throw m(e),function(e,t){var r=e.content,n=e.status,o=r;try{o=JSON.parse(r).message}catch(e){}return function(e,t,r){return{name:"ApiError",message:e,status:t,transporterStackTrace:r}}(o,n,t)}(e,A(u))}};return e.requester.send(d).then((function(e){return function(e,t){return function(e){var t=e.status;return e.isTimedOut||function(e){var t=e.isTimedOut,r=e.status;return!t&&0==~~r}(e)||2!=~~(t/100)&&4!=~~(t/100)}(e)?t.onRetry(e):2==~~(e.status/100)?t.onSuccess(e):t.onFail(e)}(e,p)}))};return q(e.hostsCache,t).then((function(e){return d(a(e.statelessHosts).reverse(),e.getTimeout)}))}function j(e){var t={value:"Algolia for JavaScript (".concat(e,")"),add:function(e){var r="; ".concat(e.segment).concat(void 0!==e.version?" (".concat(e.version,")"):"");return-1===t.value.indexOf(r)&&(t.value="".concat(t.value).concat(r)),t}};return t}function S(e,t,r){var n=T(r),o="".concat(e.protocol,"://").concat(e.url,"/").concat("/"===t.charAt(0)?t.substr(1):t);return n.length&&(o+="?".concat(n)),o}function T(e){return Object.keys(e).map((function(t){return f("%s=%s",t,(r=e[t],"[object Object]"===Object.prototype.toString.call(r)||"[object Array]"===Object.prototype.toString.call(r)?JSON.stringify(e[t]):e[t]));var r})).join("&")}function A(e){return e.map((function(e){return x(e)}))}function x(e){var t=e.request.headers["x-algolia-api-key"]?{"x-algolia-api-key":"*****"}:{};return r(r({},e),{},{request:r(r({},e.request),{},{headers:r(r({},e.request.headers),t)})})}var N=function(e){var t=e.appId,n=function(e,t,r){var n={"x-algolia-api-key":r,"x-algolia-application-id":t};return{headers:function(){return e===h.WithinHeaders?n:{}},queryParameters:function(){return e===h.WithinQueryParameters?n:{}}}}(void 0!==e.authMode?e.authMode:h.WithinHeaders,t,e.apiKey),a=function(e){var t=e.hostsCache,r=e.logger,n=e.requester,a=e.requestsCache,u=e.responsesCache,i=e.timeouts,s=e.userAgent,c=e.hosts,l=e.queryParameters,f={hostsCache:t,logger:r,requester:n,requestsCache:a,responsesCache:u,timeouts:i,userAgent:s,headers:e.headers,queryParameters:l,hosts:c.map((function(e){return b(e)})),read:function(e,t){var r=d(t,f.timeouts.read),n=function(){return w(f,f.hosts.filter((function(e){return 0!=(e.accept&m.Read)})),e,r)};if(!0!==(void 0!==r.cacheable?r.cacheable:e.cacheable))return n();var a={request:e,mappedRequestOptions:r,transporter:{queryParameters:f.queryParameters,headers:f.headers}};return f.responsesCache.get(a,(function(){return f.requestsCache.get(a,(function(){return f.requestsCache.set(a,n()).then((function(e){return Promise.all([f.requestsCache.delete(a),e])}),(function(e){return Promise.all([f.requestsCache.delete(a),Promise.reject(e)])})).then((function(e){var t=o(e,2);t[0];return t[1]}))}))}),{miss:function(e){return f.responsesCache.set(a,e)}})},write:function(e,t){return w(f,f.hosts.filter((function(e){return 0!=(e.accept&m.Write)})),e,d(t,f.timeouts.write))}};return f}(r(r({hosts:[{url:"".concat(t,"-dsn.algolia.net"),accept:m.Read},{url:"".concat(t,".algolia.net"),accept:m.Write}].concat(c([{url:"".concat(t,"-1.algolianet.com")},{url:"".concat(t,"-2.algolianet.com")},{url:"".concat(t,"-3.algolianet.com")}]))},e),{},{headers:r(r(r({},n.headers()),{"content-type":"application/x-www-form-urlencoded"}),e.headers),queryParameters:r(r({},n.queryParameters()),e.queryParameters)}));return l({transporter:a,appId:t,addAlgoliaAgent:function(e,t){a.userAgent.add({segment:e,version:t})},clearCache:function(){return Promise.all([a.requestsCache.clear(),a.responsesCache.clear()]).then((function(){}))}},e.methods)},C=function(e){return function(t,r){return t.method===O?e.transporter.read(t,r):e.transporter.write(t,r)}},k=function(e){return function(t){var r=arguments.length>1&&void 0!==arguments[1]?arguments[1]:{},n={transporter:e.transporter,appId:e.appId,indexName:t};return l(n,r.methods)}},J=function(e){return function(t,n){var o=t.map((function(e){return r(r({},e),{},{params:T(e.params||{})})}));return e.transporter.read({method:P,path:"1/indexes/*/queries",data:{requests:o},cacheable:!0},n)}},E=function(e){return function(t,o){return Promise.all(t.map((function(t){var a=t.params,u=a.facetName,i=a.facetQuery,s=n(a,["facetName","facetQuery"]);return k(e)(t.indexName,{methods:{searchForFacetValues:R}}).searchForFacetValues(u,i,r(r({},o),s))})))}},I=function(e){return function(t,r,n){return e.transporter.read({method:P,path:f("1/answers/%s/prediction",e.indexName),data:{query:t,queryLanguages:r},cacheable:!0},n)}},F=function(e){return function(t,r){return e.transporter.read({method:P,path:f("1/indexes/%s/query",e.indexName),data:{query:t},cacheable:!0},r)}},R=function(e){return function(t,r,n){return e.transporter.read({method:P,path:f("1/indexes/%s/facets/%s/query",e.indexName,t),data:{facetQuery:r},cacheable:!0},n)}},D=1,W=2,H=3;function Q(e,t,n){var o,a={appId:e,apiKey:t,timeouts:{connect:1,read:2,write:30},requester:{send:function(e){return new Promise((function(t){var r=new XMLHttpRequest;r.open(e.method,e.url,!0),Object.keys(e.headers).forEach((function(t){return r.setRequestHeader(t,e.headers[t])}));var n,o=function(e,n){return setTimeout((function(){r.abort(),t({status:0,content:n,isTimedOut:!0})}),1e3*e)},a=o(e.connectTimeout,"Connection timeout");r.onreadystatechange=function(){r.readyState>r.OPENED&&void 0===n&&(clearTimeout(a),n=o(e.responseTimeout,"Socket timeout"))},r.onerror=function(){0===r.status&&(clearTimeout(a),clearTimeout(n),t({content:r.responseText||"Network request failed",status:r.status,isTimedOut:!1}))},r.onload=function(){clearTimeout(a),clearTimeout(n),t({content:r.responseText,status:r.status,isTimedOut:!1})},r.send(e.data)}))}},logger:(o=H,{debug:function(e,t){return D>=o&&console.debug(e,t),Promise.resolve()},info:function(e,t){return W>=o&&console.info(e,t),Promise.resolve()},error:function(e,t){return console.error(e,t),Promise.resolve()}}),responsesCache:s(),requestsCache:s({serializable:!1}),hostsCache:i({caches:[u({key:"".concat("4.12.0","-").concat(e)}),s()]}),userAgent:j("4.12.0").add({segment:"Browser",version:"lite"}),authMode:h.WithinQueryParameters};return N(r(r(r({},a),n),{},{methods:{search:J,searchForFacetValues:E,multipleQueries:J,multipleSearchForFacetValues:E,customRequest:C,initIndex:function(e){return function(t){return k(e)(t,{methods:{search:F,searchForFacetValues:R,findAnswers:I}})}}}}))}return Q.version="4.12.0",Q}));


/***/ }),

/***/ "./node_modules/bootstrap/js/src/tab.js":
/*!**********************************************!*\
  !*** ./node_modules/bootstrap/js/src/tab.js ***!
  \**********************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var jquery__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! jquery */ "./node_modules/jquery/dist/jquery.js");
/* harmony import */ var jquery__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(jquery__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _util__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./util */ "./node_modules/bootstrap/js/src/util.js");
/**
 * --------------------------------------------------------------------------
 * Bootstrap (v4.5.0): tab.js
 * Licensed under MIT (https://github.com/twbs/bootstrap/blob/master/LICENSE)
 * --------------------------------------------------------------------------
 */




/**
 * ------------------------------------------------------------------------
 * Constants
 * ------------------------------------------------------------------------
 */

const NAME               = 'tab'
const VERSION            = '4.5.0'
const DATA_KEY           = 'bs.tab'
const EVENT_KEY          = `.${DATA_KEY}`
const DATA_API_KEY       = '.data-api'
const JQUERY_NO_CONFLICT = jquery__WEBPACK_IMPORTED_MODULE_0___default.a.fn[NAME]

const EVENT_HIDE           = `hide${EVENT_KEY}`
const EVENT_HIDDEN         = `hidden${EVENT_KEY}`
const EVENT_SHOW           = `show${EVENT_KEY}`
const EVENT_SHOWN          = `shown${EVENT_KEY}`
const EVENT_CLICK_DATA_API = `click${EVENT_KEY}${DATA_API_KEY}`

const CLASS_NAME_DROPDOWN_MENU = 'dropdown-menu'
const CLASS_NAME_ACTIVE        = 'active'
const CLASS_NAME_DISABLED      = 'disabled'
const CLASS_NAME_FADE          = 'fade'
const CLASS_NAME_SHOW          = 'show'

const SELECTOR_DROPDOWN              = '.dropdown'
const SELECTOR_NAV_LIST_GROUP        = '.nav, .list-group'
const SELECTOR_ACTIVE                = '.active'
const SELECTOR_ACTIVE_UL             = '> li > .active'
const SELECTOR_DATA_TOGGLE           = '[data-toggle="tab"], [data-toggle="pill"], [data-toggle="list"]'
const SELECTOR_DROPDOWN_TOGGLE       = '.dropdown-toggle'
const SELECTOR_DROPDOWN_ACTIVE_CHILD = '> .dropdown-menu .active'

/**
 * ------------------------------------------------------------------------
 * Class Definition
 * ------------------------------------------------------------------------
 */

class Tab {
  constructor(element) {
    this._element = element
  }

  // Getters

  static get VERSION() {
    return VERSION
  }

  // Public

  show() {
    if (this._element.parentNode &&
        this._element.parentNode.nodeType === Node.ELEMENT_NODE &&
        jquery__WEBPACK_IMPORTED_MODULE_0___default()(this._element).hasClass(CLASS_NAME_ACTIVE) ||
        jquery__WEBPACK_IMPORTED_MODULE_0___default()(this._element).hasClass(CLASS_NAME_DISABLED)) {
      return
    }

    let target
    let previous
    const listElement = jquery__WEBPACK_IMPORTED_MODULE_0___default()(this._element).closest(SELECTOR_NAV_LIST_GROUP)[0]
    const selector = _util__WEBPACK_IMPORTED_MODULE_1__["default"].getSelectorFromElement(this._element)

    if (listElement) {
      const itemSelector = listElement.nodeName === 'UL' || listElement.nodeName === 'OL' ? SELECTOR_ACTIVE_UL : SELECTOR_ACTIVE
      previous = jquery__WEBPACK_IMPORTED_MODULE_0___default.a.makeArray(jquery__WEBPACK_IMPORTED_MODULE_0___default()(listElement).find(itemSelector))
      previous = previous[previous.length - 1]
    }

    const hideEvent = jquery__WEBPACK_IMPORTED_MODULE_0___default.a.Event(EVENT_HIDE, {
      relatedTarget: this._element
    })

    const showEvent = jquery__WEBPACK_IMPORTED_MODULE_0___default.a.Event(EVENT_SHOW, {
      relatedTarget: previous
    })

    if (previous) {
      jquery__WEBPACK_IMPORTED_MODULE_0___default()(previous).trigger(hideEvent)
    }

    jquery__WEBPACK_IMPORTED_MODULE_0___default()(this._element).trigger(showEvent)

    if (showEvent.isDefaultPrevented() ||
        hideEvent.isDefaultPrevented()) {
      return
    }

    if (selector) {
      target = document.querySelector(selector)
    }

    this._activate(
      this._element,
      listElement
    )

    const complete = () => {
      const hiddenEvent = jquery__WEBPACK_IMPORTED_MODULE_0___default.a.Event(EVENT_HIDDEN, {
        relatedTarget: this._element
      })

      const shownEvent = jquery__WEBPACK_IMPORTED_MODULE_0___default.a.Event(EVENT_SHOWN, {
        relatedTarget: previous
      })

      jquery__WEBPACK_IMPORTED_MODULE_0___default()(previous).trigger(hiddenEvent)
      jquery__WEBPACK_IMPORTED_MODULE_0___default()(this._element).trigger(shownEvent)
    }

    if (target) {
      this._activate(target, target.parentNode, complete)
    } else {
      complete()
    }
  }

  dispose() {
    jquery__WEBPACK_IMPORTED_MODULE_0___default.a.removeData(this._element, DATA_KEY)
    this._element = null
  }

  // Private

  _activate(element, container, callback) {
    const activeElements = container && (container.nodeName === 'UL' || container.nodeName === 'OL')
      ? jquery__WEBPACK_IMPORTED_MODULE_0___default()(container).find(SELECTOR_ACTIVE_UL)
      : jquery__WEBPACK_IMPORTED_MODULE_0___default()(container).children(SELECTOR_ACTIVE)

    const active = activeElements[0]
    const isTransitioning = callback && (active && jquery__WEBPACK_IMPORTED_MODULE_0___default()(active).hasClass(CLASS_NAME_FADE))
    const complete = () => this._transitionComplete(
      element,
      active,
      callback
    )

    if (active && isTransitioning) {
      const transitionDuration = _util__WEBPACK_IMPORTED_MODULE_1__["default"].getTransitionDurationFromElement(active)

      jquery__WEBPACK_IMPORTED_MODULE_0___default()(active)
        .removeClass(CLASS_NAME_SHOW)
        .one(_util__WEBPACK_IMPORTED_MODULE_1__["default"].TRANSITION_END, complete)
        .emulateTransitionEnd(transitionDuration)
    } else {
      complete()
    }
  }

  _transitionComplete(element, active, callback) {
    if (active) {
      jquery__WEBPACK_IMPORTED_MODULE_0___default()(active).removeClass(CLASS_NAME_ACTIVE)

      const dropdownChild = jquery__WEBPACK_IMPORTED_MODULE_0___default()(active.parentNode).find(
        SELECTOR_DROPDOWN_ACTIVE_CHILD
      )[0]

      if (dropdownChild) {
        jquery__WEBPACK_IMPORTED_MODULE_0___default()(dropdownChild).removeClass(CLASS_NAME_ACTIVE)
      }

      if (active.getAttribute('role') === 'tab') {
        active.setAttribute('aria-selected', false)
      }
    }

    jquery__WEBPACK_IMPORTED_MODULE_0___default()(element).addClass(CLASS_NAME_ACTIVE)
    if (element.getAttribute('role') === 'tab') {
      element.setAttribute('aria-selected', true)
    }

    _util__WEBPACK_IMPORTED_MODULE_1__["default"].reflow(element)

    if (element.classList.contains(CLASS_NAME_FADE)) {
      element.classList.add(CLASS_NAME_SHOW)
    }

    if (element.parentNode && jquery__WEBPACK_IMPORTED_MODULE_0___default()(element.parentNode).hasClass(CLASS_NAME_DROPDOWN_MENU)) {
      const dropdownElement = jquery__WEBPACK_IMPORTED_MODULE_0___default()(element).closest(SELECTOR_DROPDOWN)[0]

      if (dropdownElement) {
        const dropdownToggleList = [].slice.call(dropdownElement.querySelectorAll(SELECTOR_DROPDOWN_TOGGLE))

        jquery__WEBPACK_IMPORTED_MODULE_0___default()(dropdownToggleList).addClass(CLASS_NAME_ACTIVE)
      }

      element.setAttribute('aria-expanded', true)
    }

    if (callback) {
      callback()
    }
  }

  // Static

  static _jQueryInterface(config) {
    return this.each(function () {
      const $this = jquery__WEBPACK_IMPORTED_MODULE_0___default()(this)
      let data = $this.data(DATA_KEY)

      if (!data) {
        data = new Tab(this)
        $this.data(DATA_KEY, data)
      }

      if (typeof config === 'string') {
        if (typeof data[config] === 'undefined') {
          throw new TypeError(`No method named "${config}"`)
        }
        data[config]()
      }
    })
  }
}

/**
 * ------------------------------------------------------------------------
 * Data Api implementation
 * ------------------------------------------------------------------------
 */

jquery__WEBPACK_IMPORTED_MODULE_0___default()(document)
  .on(EVENT_CLICK_DATA_API, SELECTOR_DATA_TOGGLE, function (event) {
    event.preventDefault()
    Tab._jQueryInterface.call(jquery__WEBPACK_IMPORTED_MODULE_0___default()(this), 'show')
  })

/**
 * ------------------------------------------------------------------------
 * jQuery
 * ------------------------------------------------------------------------
 */

jquery__WEBPACK_IMPORTED_MODULE_0___default.a.fn[NAME] = Tab._jQueryInterface
jquery__WEBPACK_IMPORTED_MODULE_0___default.a.fn[NAME].Constructor = Tab
jquery__WEBPACK_IMPORTED_MODULE_0___default.a.fn[NAME].noConflict = () => {
  jquery__WEBPACK_IMPORTED_MODULE_0___default.a.fn[NAME] = JQUERY_NO_CONFLICT
  return Tab._jQueryInterface
}

/* harmony default export */ __webpack_exports__["default"] = (Tab);


/***/ }),

/***/ "./node_modules/bootstrap/js/src/util.js":
/*!***********************************************!*\
  !*** ./node_modules/bootstrap/js/src/util.js ***!
  \***********************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var jquery__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! jquery */ "./node_modules/jquery/dist/jquery.js");
/* harmony import */ var jquery__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(jquery__WEBPACK_IMPORTED_MODULE_0__);
/**
 * --------------------------------------------------------------------------
 * Bootstrap (v4.5.0): util.js
 * Licensed under MIT (https://github.com/twbs/bootstrap/blob/master/LICENSE)
 * --------------------------------------------------------------------------
 */



/**
 * ------------------------------------------------------------------------
 * Private TransitionEnd Helpers
 * ------------------------------------------------------------------------
 */

const TRANSITION_END = 'transitionend'
const MAX_UID = 1000000
const MILLISECONDS_MULTIPLIER = 1000

// Shoutout AngusCroll (https://goo.gl/pxwQGp)
function toType(obj) {
  if (obj === null || typeof obj === 'undefined') {
    return `${obj}`
  }

  return {}.toString.call(obj).match(/\s([a-z]+)/i)[1].toLowerCase()
}

function getSpecialTransitionEndEvent() {
  return {
    bindType: TRANSITION_END,
    delegateType: TRANSITION_END,
    handle(event) {
      if (jquery__WEBPACK_IMPORTED_MODULE_0___default()(event.target).is(this)) {
        return event.handleObj.handler.apply(this, arguments) // eslint-disable-line prefer-rest-params
      }
      return undefined
    }
  }
}

function transitionEndEmulator(duration) {
  let called = false

  jquery__WEBPACK_IMPORTED_MODULE_0___default()(this).one(Util.TRANSITION_END, () => {
    called = true
  })

  setTimeout(() => {
    if (!called) {
      Util.triggerTransitionEnd(this)
    }
  }, duration)

  return this
}

function setTransitionEndSupport() {
  jquery__WEBPACK_IMPORTED_MODULE_0___default.a.fn.emulateTransitionEnd = transitionEndEmulator
  jquery__WEBPACK_IMPORTED_MODULE_0___default.a.event.special[Util.TRANSITION_END] = getSpecialTransitionEndEvent()
}

/**
 * --------------------------------------------------------------------------
 * Public Util Api
 * --------------------------------------------------------------------------
 */

const Util = {
  TRANSITION_END: 'bsTransitionEnd',

  getUID(prefix) {
    do {
      // eslint-disable-next-line no-bitwise
      prefix += ~~(Math.random() * MAX_UID) // "~~" acts like a faster Math.floor() here
    } while (document.getElementById(prefix))
    return prefix
  },

  getSelectorFromElement(element) {
    let selector = element.getAttribute('data-target')

    if (!selector || selector === '#') {
      const hrefAttr = element.getAttribute('href')
      selector = hrefAttr && hrefAttr !== '#' ? hrefAttr.trim() : ''
    }

    try {
      return document.querySelector(selector) ? selector : null
    } catch (err) {
      return null
    }
  },

  getTransitionDurationFromElement(element) {
    if (!element) {
      return 0
    }

    // Get transition-duration of the element
    let transitionDuration = jquery__WEBPACK_IMPORTED_MODULE_0___default()(element).css('transition-duration')
    let transitionDelay = jquery__WEBPACK_IMPORTED_MODULE_0___default()(element).css('transition-delay')

    const floatTransitionDuration = parseFloat(transitionDuration)
    const floatTransitionDelay = parseFloat(transitionDelay)

    // Return 0 if element or transition duration is not found
    if (!floatTransitionDuration && !floatTransitionDelay) {
      return 0
    }

    // If multiple durations are defined, take the first
    transitionDuration = transitionDuration.split(',')[0]
    transitionDelay = transitionDelay.split(',')[0]

    return (parseFloat(transitionDuration) + parseFloat(transitionDelay)) * MILLISECONDS_MULTIPLIER
  },

  reflow(element) {
    return element.offsetHeight
  },

  triggerTransitionEnd(element) {
    jquery__WEBPACK_IMPORTED_MODULE_0___default()(element).trigger(TRANSITION_END)
  },

  // TODO: Remove in v5
  supportsTransitionEnd() {
    return Boolean(TRANSITION_END)
  },

  isElement(obj) {
    return (obj[0] || obj).nodeType
  },

  typeCheckConfig(componentName, config, configTypes) {
    for (const property in configTypes) {
      if (Object.prototype.hasOwnProperty.call(configTypes, property)) {
        const expectedTypes = configTypes[property]
        const value         = config[property]
        const valueType     = value && Util.isElement(value)
          ? 'element' : toType(value)

        if (!new RegExp(expectedTypes).test(valueType)) {
          throw new Error(
            `${componentName.toUpperCase()}: ` +
            `Option "${property}" provided type "${valueType}" ` +
            `but expected type "${expectedTypes}".`)
        }
      }
    }
  },

  findShadowRoot(element) {
    if (!document.documentElement.attachShadow) {
      return null
    }

    // Can find the shadow root otherwise it'll return the document
    if (typeof element.getRootNode === 'function') {
      const root = element.getRootNode()
      return root instanceof ShadowRoot ? root : null
    }

    if (element instanceof ShadowRoot) {
      return element
    }

    // when we don't find a shadow root
    if (!element.parentNode) {
      return null
    }

    return Util.findShadowRoot(element.parentNode)
  },

  jQueryDetection() {
    if (typeof jquery__WEBPACK_IMPORTED_MODULE_0___default.a === 'undefined') {
      throw new TypeError('Bootstrap\'s JavaScript requires jQuery. jQuery must be included before Bootstrap\'s JavaScript.')
    }

    const version = jquery__WEBPACK_IMPORTED_MODULE_0___default.a.fn.jquery.split(' ')[0].split('.')
    const minMajor = 1
    const ltMajor = 2
    const minMinor = 9
    const minPatch = 1
    const maxMajor = 4

    if (version[0] < ltMajor && version[1] < minMinor || version[0] === minMajor && version[1] === minMinor && version[2] < minPatch || version[0] >= maxMajor) {
      throw new Error('Bootstrap\'s JavaScript requires at least jQuery v1.9.1 but less than v4.0.0')
    }
  }
}

Util.jQueryDetection()
setTransitionEndSupport()

/* harmony default export */ __webpack_exports__["default"] = (Util);


/***/ }),

/***/ "./node_modules/instantsearch.js/dist/instantsearch.production.min.js":
/*!****************************************************************************!*\
  !*** ./node_modules/instantsearch.js/dist/instantsearch.production.min.js ***!
  \****************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

/*! InstantSearch.js 4.37.2 | © Algolia, Inc. and contributors; MIT License | https://github.com/algolia/instantsearch.js */
!function(e,t){ true?module.exports=t():undefined}(this,function(){"use strict";function h(e){return(h="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(e){return typeof e}:function(e){return e&&"function"==typeof Symbol&&e.constructor===Symbol&&e!==Symbol.prototype?"symbol":typeof e})(e)}function C(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}function r(e,t){for(var n=0;n<t.length;n++){var r=t[n];r.enumerable=r.enumerable||!1,r.configurable=!0,"value"in r&&(r.writable=!0),Object.defineProperty(e,r.key,r)}}function E(e,t,n){return t&&r(e.prototype,t),n&&r(e,n),e}function k(e,t,n){return t in e?Object.defineProperty(e,t,{value:n,enumerable:!0,configurable:!0,writable:!0}):e[t]=n,e}function f(){return(f=Object.assign||function(e){for(var t=1;t<arguments.length;t++){var n=arguments[t];for(var r in n)Object.prototype.hasOwnProperty.call(n,r)&&(e[r]=n[r])}return e}).apply(this,arguments)}function i(t,e){var n=Object.keys(t);if(Object.getOwnPropertySymbols){var r=Object.getOwnPropertySymbols(t);e&&(r=r.filter(function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable})),n.push.apply(n,r)}return n}function W(t){for(var e=1;e<arguments.length;e++){var n=null!=arguments[e]?arguments[e]:{};e%2?i(Object(n),!0).forEach(function(e){k(t,e,n[e])}):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(n)):i(Object(n)).forEach(function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(n,e))})}return t}function L(e,t){if("function"!=typeof t&&null!==t)throw new TypeError("Super expression must either be null or a function");e.prototype=Object.create(t&&t.prototype,{constructor:{value:e,writable:!0,configurable:!0}}),t&&n(e,t)}function a(e){return(a=Object.setPrototypeOf?Object.getPrototypeOf:function(e){return e.__proto__||Object.getPrototypeOf(e)})(e)}function n(e,t){return(n=Object.setPrototypeOf||function(e,t){return e.__proto__=t,e})(e,t)}function M(e,t){if(null==e)return{};var n,r,i=function(e,t){if(null==e)return{};var n,r,i={},a=Object.keys(e);for(r=0;r<a.length;r++)n=a[r],0<=t.indexOf(n)||(i[n]=e[n]);return i}(e,t);if(Object.getOwnPropertySymbols){var a=Object.getOwnPropertySymbols(e);for(r=0;r<a.length;r++)n=a[r],0<=t.indexOf(n)||Object.prototype.propertyIsEnumerable.call(e,n)&&(i[n]=e[n])}return i}function j(e){if(void 0===e)throw new ReferenceError("this hasn't been initialised - super() hasn't been called");return e}function O(r){var i=function(){if("undefined"==typeof Reflect||!Reflect.construct)return!1;if(Reflect.construct.sham)return!1;if("function"==typeof Proxy)return!0;try{return Date.prototype.toString.call(Reflect.construct(Date,[],function(){})),!0}catch(e){return!1}}();return function(){var e,t=a(r);if(i){var n=a(this).constructor;e=Reflect.construct(t,arguments,n)}else e=t.apply(this,arguments);return function(e,t){return!t||"object"!=typeof t&&"function"!=typeof t?j(e):t}(this,e)}}function D(e,t){return function(e){if(Array.isArray(e))return e}(e)||function(e,t){if("undefined"==typeof Symbol||!(Symbol.iterator in Object(e)))return;var n=[],r=!0,i=!1,a=void 0;try{for(var s,o=e[Symbol.iterator]();!(r=(s=o.next()).done)&&(n.push(s.value),!t||n.length!==t);r=!0);}catch(e){i=!0,a=e}finally{try{r||null==o.return||o.return()}finally{if(i)throw a}}return n}(e,t)||s(e,t)||function(){throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")}()}function P(e){return function(e){if(Array.isArray(e))return o(e)}(e)||function(e){if("undefined"!=typeof Symbol&&Symbol.iterator in Object(e))return Array.from(e)}(e)||s(e)||function(){throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")}()}function s(e,t){if(e){if("string"==typeof e)return o(e,t);var n=Object.prototype.toString.call(e).slice(8,-1);return"Object"===n&&e.constructor&&(n=e.constructor.name),"Map"===n||"Set"===n?Array.from(e):"Arguments"===n||/^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)?o(e,t):void 0}}function o(e,t){(null==t||t>e.length)&&(t=e.length);for(var n=0,r=new Array(t);n<t;n++)r[n]=e[n];return r}function c(e){return"function"==typeof e||Array.isArray(e)||"[object Object]"===Object.prototype.toString.call(e)}function u(e,t){if(e===t)return e;for(var n in t)if(Object.prototype.hasOwnProperty.call(t,n)&&"__proto__"!==n){var r=t[n],i=e[n];void 0!==i&&void 0===r||(c(i)&&c(r)?e[n]=u(i,r):e[n]="object"==typeof(a=r)&&null!==a?u(Array.isArray(a)?[]:{},a):a)}var a;return e}var m=function(e){c(e)||(e={});for(var t=1,n=arguments.length;t<n;t++){var r=arguments[t];c(r)&&u(e,r)}return e},p=function(){return Array.prototype.slice.call(arguments).reduceRight(function(t,n){return Object.keys(Object(n)).forEach(function(e){void 0!==n[e]&&(void 0!==t[e]&&delete t[e],t[e]=n[e])}),t},{})};var l=function(n,r){return n.filter(function(e,t){return-1<r.indexOf(e)&&n.indexOf(e)===t})},g=function(e,t){if(Array.isArray(e))for(var n=0;n<e.length;n++)if(t(e[n]))return e[n]};var d=function e(t){if("number"==typeof t)return t;if("string"==typeof t)return parseFloat(t);if(Array.isArray(t))return t.map(e);throw new Error("The value should be a number, a parsable string or an array of those.")};var v=function(e,t){if(null===e)return{};var n,r,i={},a=Object.keys(e);for(r=0;r<a.length;r++)n=a[r],0<=t.indexOf(n)||(i[n]=e[n]);return i};var y=function(e){return e&&0<Object.keys(e).length},t=function(e){return null!==e&&/^[a-zA-Z0-9_-]{1,64}$/.test(e)},b={addRefinement:function(e,t,n){if(b.isRefined(e,t,n))return e;var r=""+n,i=e[t]?e[t].concat(r):[r],a={};return a[t]=i,p({},a,e)},removeRefinement:function(e,n,t){if(void 0===t)return b.clearRefinement(e,function(e,t){return n===t});var r=""+t;return b.clearRefinement(e,function(e,t){return n===t&&r===e})},toggleRefinement:function(e,t,n){if(void 0===n)throw new Error("toggleRefinement should be used with a value");return b.isRefined(e,t,n)?b.removeRefinement(e,t,n):b.addRefinement(e,t,n)},clearRefinement:function(i,a,s){if(void 0===a)return y(i)?{}:i;if("string"==typeof a)return v(i,[a]);if("function"==typeof a){var o=!1,e=Object.keys(i).reduce(function(e,t){var n=i[t]||[],r=n.filter(function(e){return!a(e,t,s)});return r.length!==n.length&&(o=!0),e[t]=r,e},{});return o?e:i}},isRefined:function(e,t,n){var r=!!e[t]&&0<e[t].length;if(void 0===n||!r)return r;var i=""+n;return-1!==e[t].indexOf(i)}},R=b;function S(e,n){return Array.isArray(e)&&Array.isArray(n)?e.length===n.length&&e.every(function(e,t){return S(n[t],e)}):e===n}function w(e){var r=e?w._parseNumbers(e):{};void 0===r.userToken||t(r.userToken)||console.warn("[algoliasearch-helper] The `userToken` parameter is invalid. This can lead to wrong analytics.\n  - Format: [a-zA-Z0-9_-]{1,64}"),this.facets=r.facets||[],this.disjunctiveFacets=r.disjunctiveFacets||[],this.hierarchicalFacets=r.hierarchicalFacets||[],this.facetsRefinements=r.facetsRefinements||{},this.facetsExcludes=r.facetsExcludes||{},this.disjunctiveFacetsRefinements=r.disjunctiveFacetsRefinements||{},this.numericRefinements=r.numericRefinements||{},this.tagRefinements=r.tagRefinements||[],this.hierarchicalFacetsRefinements=r.hierarchicalFacetsRefinements||{};var i=this;Object.keys(r).forEach(function(e){var t=-1!==w.PARAMETERS.indexOf(e),n=void 0!==r[e];!t&&n&&(i[e]=r[e])})}w.PARAMETERS=Object.keys(new w),w._parseNumbers=function(i){if(i instanceof w)return i;var r={};if(["aroundPrecision","aroundRadius","getRankingInfo","minWordSizefor2Typos","minWordSizefor1Typo","page","maxValuesPerFacet","distinct","minimumAroundRadius","hitsPerPage","minProximity"].forEach(function(e){var t=i[e];if("string"==typeof t){var n=parseFloat(t);r[e]=isNaN(n)?t:n}}),Array.isArray(i.insideBoundingBox)&&(r.insideBoundingBox=i.insideBoundingBox.map(function(e){return Array.isArray(e)?e.map(function(e){return parseFloat(e)}):e})),i.numericRefinements){var a={};Object.keys(i.numericRefinements).forEach(function(n){var r=i.numericRefinements[n]||{};a[n]={},Object.keys(r).forEach(function(e){var t=r[e].map(function(e){return Array.isArray(e)?e.map(function(e){return"string"==typeof e?parseFloat(e):e}):"string"==typeof e?parseFloat(e):e});a[n][e]=t})}),r.numericRefinements=a}return m({},i,r)},w.make=function(e){var n=new w(e);return(e.hierarchicalFacets||[]).forEach(function(e){if(e.rootPath){var t=n.getHierarchicalRefinement(e.name);0<t.length&&0!==t[0].indexOf(e.rootPath)&&(n=n.clearRefinements(e.name)),0===(t=n.getHierarchicalRefinement(e.name)).length&&(n=n.toggleHierarchicalFacetRefinement(e.name,e.rootPath))}}),n},w.validate=function(e,t){var n=t||{};return e.tagFilters&&n.tagRefinements&&0<n.tagRefinements.length?new Error("[Tags] Cannot switch from the managed tag API to the advanced API. It is probably an error, if it is really what you want, you should first clear the tags with clearTags method."):0<e.tagRefinements.length&&n.tagFilters?new Error("[Tags] Cannot switch from the advanced tag API to the managed API. It is probably an error, if it is not, you should first clear the tags with clearTags method."):e.numericFilters&&n.numericRefinements&&y(n.numericRefinements)?new Error("[Numeric filters] Can't switch from the advanced to the managed API. It is probably an error, if this is really what you want, you have to first clear the numeric filters."):y(e.numericRefinements)&&n.numericFilters?new Error("[Numeric filters] Can't switch from the managed API to the advanced. It is probably an error, if this is really what you want, you have to first clear the numeric filters."):null},w.prototype={constructor:w,clearRefinements:function(e){var t={numericRefinements:this._clearNumericRefinements(e),facetsRefinements:R.clearRefinement(this.facetsRefinements,e,"conjunctiveFacet"),facetsExcludes:R.clearRefinement(this.facetsExcludes,e,"exclude"),disjunctiveFacetsRefinements:R.clearRefinement(this.disjunctiveFacetsRefinements,e,"disjunctiveFacet"),hierarchicalFacetsRefinements:R.clearRefinement(this.hierarchicalFacetsRefinements,e,"hierarchicalFacet")};return t.numericRefinements===this.numericRefinements&&t.facetsRefinements===this.facetsRefinements&&t.facetsExcludes===this.facetsExcludes&&t.disjunctiveFacetsRefinements===this.disjunctiveFacetsRefinements&&t.hierarchicalFacetsRefinements===this.hierarchicalFacetsRefinements?this:this.setQueryParameters(t)},clearTags:function(){return void 0===this.tagFilters&&0===this.tagRefinements.length?this:this.setQueryParameters({tagFilters:void 0,tagRefinements:[]})},setIndex:function(e){return e===this.index?this:this.setQueryParameters({index:e})},setQuery:function(e){return e===this.query?this:this.setQueryParameters({query:e})},setPage:function(e){return e===this.page?this:this.setQueryParameters({page:e})},setFacets:function(e){return this.setQueryParameters({facets:e})},setDisjunctiveFacets:function(e){return this.setQueryParameters({disjunctiveFacets:e})},setHitsPerPage:function(e){return this.hitsPerPage===e?this:this.setQueryParameters({hitsPerPage:e})},setTypoTolerance:function(e){return this.typoTolerance===e?this:this.setQueryParameters({typoTolerance:e})},addNumericRefinement:function(e,t,n){var r=d(n);if(this.isNumericRefined(e,t,r))return this;var i=m({},this.numericRefinements);return i[e]=m({},i[e]),i[e][t]?(i[e][t]=i[e][t].slice(),i[e][t].push(r)):i[e][t]=[r],this.setQueryParameters({numericRefinements:i})},getConjunctiveRefinements:function(e){return this.isConjunctiveFacet(e)&&this.facetsRefinements[e]||[]},getDisjunctiveRefinements:function(e){return this.isDisjunctiveFacet(e)&&this.disjunctiveFacetsRefinements[e]||[]},getHierarchicalRefinement:function(e){return this.hierarchicalFacetsRefinements[e]||[]},getExcludeRefinements:function(e){return this.isConjunctiveFacet(e)&&this.facetsExcludes[e]||[]},removeNumericRefinement:function(n,r,i){return void 0!==i?this.isNumericRefined(n,r,i)?this.setQueryParameters({numericRefinements:this._clearNumericRefinements(function(e,t){return t===n&&e.op===r&&S(e.val,d(i))})}):this:void 0!==r?this.isNumericRefined(n,r)?this.setQueryParameters({numericRefinements:this._clearNumericRefinements(function(e,t){return t===n&&e.op===r})}):this:this.isNumericRefined(n)?this.setQueryParameters({numericRefinements:this._clearNumericRefinements(function(e,t){return t===n})}):this},getNumericRefinements:function(e){return this.numericRefinements[e]||{}},getNumericRefinement:function(e,t){return this.numericRefinements[e]&&this.numericRefinements[e][t]},_clearNumericRefinements:function(s){if(void 0===s)return y(this.numericRefinements)?{}:this.numericRefinements;if("string"==typeof s)return v(this.numericRefinements,[s]);if("function"==typeof s){var o=!1,t=this.numericRefinements,e=Object.keys(t).reduce(function(e,r){var i=t[r],a={};return i=i||{},Object.keys(i).forEach(function(t){var e=i[t]||[],n=[];e.forEach(function(e){s({val:e,op:t},r,"numeric")||n.push(e)}),n.length!==e.length&&(o=!0),a[t]=n}),e[r]=a,e},{});return o?e:this.numericRefinements}},addFacet:function(e){return this.isConjunctiveFacet(e)?this:this.setQueryParameters({facets:this.facets.concat([e])})},addDisjunctiveFacet:function(e){return this.isDisjunctiveFacet(e)?this:this.setQueryParameters({disjunctiveFacets:this.disjunctiveFacets.concat([e])})},addHierarchicalFacet:function(e){if(this.isHierarchicalFacet(e.name))throw new Error("Cannot declare two hierarchical facets with the same name: `"+e.name+"`");return this.setQueryParameters({hierarchicalFacets:this.hierarchicalFacets.concat([e])})},addFacetRefinement:function(e,t){if(!this.isConjunctiveFacet(e))throw new Error(e+" is not defined in the facets attribute of the helper configuration");return R.isRefined(this.facetsRefinements,e,t)?this:this.setQueryParameters({facetsRefinements:R.addRefinement(this.facetsRefinements,e,t)})},addExcludeRefinement:function(e,t){if(!this.isConjunctiveFacet(e))throw new Error(e+" is not defined in the facets attribute of the helper configuration");return R.isRefined(this.facetsExcludes,e,t)?this:this.setQueryParameters({facetsExcludes:R.addRefinement(this.facetsExcludes,e,t)})},addDisjunctiveFacetRefinement:function(e,t){if(!this.isDisjunctiveFacet(e))throw new Error(e+" is not defined in the disjunctiveFacets attribute of the helper configuration");return R.isRefined(this.disjunctiveFacetsRefinements,e,t)?this:this.setQueryParameters({disjunctiveFacetsRefinements:R.addRefinement(this.disjunctiveFacetsRefinements,e,t)})},addTagRefinement:function(e){if(this.isTagRefined(e))return this;var t={tagRefinements:this.tagRefinements.concat(e)};return this.setQueryParameters(t)},removeFacet:function(t){return this.isConjunctiveFacet(t)?this.clearRefinements(t).setQueryParameters({facets:this.facets.filter(function(e){return e!==t})}):this},removeDisjunctiveFacet:function(t){return this.isDisjunctiveFacet(t)?this.clearRefinements(t).setQueryParameters({disjunctiveFacets:this.disjunctiveFacets.filter(function(e){return e!==t})}):this},removeHierarchicalFacet:function(t){return this.isHierarchicalFacet(t)?this.clearRefinements(t).setQueryParameters({hierarchicalFacets:this.hierarchicalFacets.filter(function(e){return e.name!==t})}):this},removeFacetRefinement:function(e,t){if(!this.isConjunctiveFacet(e))throw new Error(e+" is not defined in the facets attribute of the helper configuration");return R.isRefined(this.facetsRefinements,e,t)?this.setQueryParameters({facetsRefinements:R.removeRefinement(this.facetsRefinements,e,t)}):this},removeExcludeRefinement:function(e,t){if(!this.isConjunctiveFacet(e))throw new Error(e+" is not defined in the facets attribute of the helper configuration");return R.isRefined(this.facetsExcludes,e,t)?this.setQueryParameters({facetsExcludes:R.removeRefinement(this.facetsExcludes,e,t)}):this},removeDisjunctiveFacetRefinement:function(e,t){if(!this.isDisjunctiveFacet(e))throw new Error(e+" is not defined in the disjunctiveFacets attribute of the helper configuration");return R.isRefined(this.disjunctiveFacetsRefinements,e,t)?this.setQueryParameters({disjunctiveFacetsRefinements:R.removeRefinement(this.disjunctiveFacetsRefinements,e,t)}):this},removeTagRefinement:function(t){if(!this.isTagRefined(t))return this;var e={tagRefinements:this.tagRefinements.filter(function(e){return e!==t})};return this.setQueryParameters(e)},toggleRefinement:function(e,t){return this.toggleFacetRefinement(e,t)},toggleFacetRefinement:function(e,t){if(this.isHierarchicalFacet(e))return this.toggleHierarchicalFacetRefinement(e,t);if(this.isConjunctiveFacet(e))return this.toggleConjunctiveFacetRefinement(e,t);if(this.isDisjunctiveFacet(e))return this.toggleDisjunctiveFacetRefinement(e,t);throw new Error("Cannot refine the undeclared facet "+e+"; it should be added to the helper options facets, disjunctiveFacets or hierarchicalFacets")},toggleConjunctiveFacetRefinement:function(e,t){if(!this.isConjunctiveFacet(e))throw new Error(e+" is not defined in the facets attribute of the helper configuration");return this.setQueryParameters({facetsRefinements:R.toggleRefinement(this.facetsRefinements,e,t)})},toggleExcludeFacetRefinement:function(e,t){if(!this.isConjunctiveFacet(e))throw new Error(e+" is not defined in the facets attribute of the helper configuration");return this.setQueryParameters({facetsExcludes:R.toggleRefinement(this.facetsExcludes,e,t)})},toggleDisjunctiveFacetRefinement:function(e,t){if(!this.isDisjunctiveFacet(e))throw new Error(e+" is not defined in the disjunctiveFacets attribute of the helper configuration");return this.setQueryParameters({disjunctiveFacetsRefinements:R.toggleRefinement(this.disjunctiveFacetsRefinements,e,t)})},toggleHierarchicalFacetRefinement:function(e,t){if(!this.isHierarchicalFacet(e))throw new Error(e+" is not defined in the hierarchicalFacets attribute of the helper configuration");var n=this._getHierarchicalFacetSeparator(this.getHierarchicalFacetByName(e)),r={};return void 0!==this.hierarchicalFacetsRefinements[e]&&0<this.hierarchicalFacetsRefinements[e].length&&(this.hierarchicalFacetsRefinements[e][0]===t||0===this.hierarchicalFacetsRefinements[e][0].indexOf(t+n))?-1===t.indexOf(n)?r[e]=[]:r[e]=[t.slice(0,t.lastIndexOf(n))]:r[e]=[t],this.setQueryParameters({hierarchicalFacetsRefinements:p({},r,this.hierarchicalFacetsRefinements)})},addHierarchicalFacetRefinement:function(e,t){if(this.isHierarchicalFacetRefined(e))throw new Error(e+" is already refined.");if(!this.isHierarchicalFacet(e))throw new Error(e+" is not defined in the hierarchicalFacets attribute of the helper configuration.");var n={};return n[e]=[t],this.setQueryParameters({hierarchicalFacetsRefinements:p({},n,this.hierarchicalFacetsRefinements)})},removeHierarchicalFacetRefinement:function(e){if(!this.isHierarchicalFacetRefined(e))return this;var t={};return t[e]=[],this.setQueryParameters({hierarchicalFacetsRefinements:p({},t,this.hierarchicalFacetsRefinements)})},toggleTagRefinement:function(e){return this.isTagRefined(e)?this.removeTagRefinement(e):this.addTagRefinement(e)},isDisjunctiveFacet:function(e){return-1<this.disjunctiveFacets.indexOf(e)},isHierarchicalFacet:function(e){return void 0!==this.getHierarchicalFacetByName(e)},isConjunctiveFacet:function(e){return-1<this.facets.indexOf(e)},isFacetRefined:function(e,t){return!!this.isConjunctiveFacet(e)&&R.isRefined(this.facetsRefinements,e,t)},isExcludeRefined:function(e,t){return!!this.isConjunctiveFacet(e)&&R.isRefined(this.facetsExcludes,e,t)},isDisjunctiveFacetRefined:function(e,t){return!!this.isDisjunctiveFacet(e)&&R.isRefined(this.disjunctiveFacetsRefinements,e,t)},isHierarchicalFacetRefined:function(e,t){if(!this.isHierarchicalFacet(e))return!1;var n=this.getHierarchicalRefinement(e);return t?-1!==n.indexOf(t):0<n.length},isNumericRefined:function(e,t,n){if(void 0===n&&void 0===t)return!!this.numericRefinements[e];var r=this.numericRefinements[e]&&void 0!==this.numericRefinements[e][t];if(void 0===n||!r)return r;var i=d(n),a=void 0!==function(e,t){return g(e,function(e){return S(e,t)})}(this.numericRefinements[e][t],i);return r&&a},isTagRefined:function(e){return-1!==this.tagRefinements.indexOf(e)},getRefinedDisjunctiveFacets:function(){var t=this,e=l(Object.keys(this.numericRefinements).filter(function(e){return 0<Object.keys(t.numericRefinements[e]).length}),this.disjunctiveFacets);return Object.keys(this.disjunctiveFacetsRefinements).filter(function(e){return 0<t.disjunctiveFacetsRefinements[e].length}).concat(e).concat(this.getRefinedHierarchicalFacets())},getRefinedHierarchicalFacets:function(){var t=this;return l(this.hierarchicalFacets.map(function(e){return e.name}),Object.keys(this.hierarchicalFacetsRefinements).filter(function(e){return 0<t.hierarchicalFacetsRefinements[e].length}))},getUnrefinedDisjunctiveFacets:function(){var t=this.getRefinedDisjunctiveFacets();return this.disjunctiveFacets.filter(function(e){return-1===t.indexOf(e)})},managedParameters:["index","facets","disjunctiveFacets","facetsRefinements","hierarchicalFacets","facetsExcludes","disjunctiveFacetsRefinements","numericRefinements","tagRefinements","hierarchicalFacetsRefinements"],getQueryParams:function(){var n=this.managedParameters,r={},i=this;return Object.keys(this).forEach(function(e){var t=i[e];-1===n.indexOf(e)&&void 0!==t&&(r[e]=t)}),r},setQueryParameter:function(e,t){if(this[e]===t)return this;var n={};return n[e]=t,this.setQueryParameters(n)},setQueryParameters:function(e){if(!e)return this;var t=w.validate(this,e);if(t)throw t;var n=this,i=w._parseNumbers(e),r=Object.keys(this).reduce(function(e,t){return e[t]=n[t],e},{}),a=Object.keys(i).reduce(function(e,t){var n=void 0!==e[t],r=void 0!==i[t];return n&&!r?v(e,[t]):(r&&(e[t]=i[t]),e)},r);return new this.constructor(a)},resetPage:function(){return void 0===this.page?this:this.setPage(0)},_getHierarchicalFacetSortBy:function(e){return e.sortBy||["isRefined:desc","name:asc"]},_getHierarchicalFacetSeparator:function(e){return e.separator||" > "},_getHierarchicalRootPath:function(e){return e.rootPath||null},_getHierarchicalShowParentLevel:function(e){return"boolean"!=typeof e.showParentLevel||e.showParentLevel},getHierarchicalFacetByName:function(t){return g(this.hierarchicalFacets,function(e){return e.name===t})},getHierarchicalFacetBreadcrumb:function(e){if(!this.isHierarchicalFacet(e))return[];var t=this.getHierarchicalRefinement(e)[0];if(!t)return[];var n=this._getHierarchicalFacetSeparator(this.getHierarchicalFacetByName(e));return t.split(n).map(function(e){return e.trim()})},toString:function(){return JSON.stringify(this,null,2)}};var _=w;function N(e,t){if(e!==t){var n=void 0!==e,r=null===e,i=void 0!==t,a=null===t;if(!a&&t<e||r&&i||!n)return 1;if(!r&&e<t||a&&n||!i)return-1}return 0}function x(e){return Array.isArray(e)?e.filter(Boolean):[]}function I(e,t){if(!Array.isArray(e))return-1;for(var n=0;n<e.length;n++)if(t(e[n]))return n;return-1}function F(e,t){var i=(t||[]).map(function(e){return e.split(":")});return e.reduce(function(e,t){var n=t.split(":"),r=g(i,function(e){return e[0]===n[0]});return 1<n.length||!r?(e[0].push(n[0]),e[1].push(n[1])):(e[0].push(r[0]),e[1].push(r[1])),e},[[],[]])}var T=function(e,n,i){if(!Array.isArray(e))return[];Array.isArray(i)||(i=[]);var t=e.map(function(t,e){return{criteria:n.map(function(e){return t[e]}),index:e,value:t}});return t.sort(function(e,t){for(var n=-1;++n<e.criteria.length;){var r=N(e.criteria[n],t.criteria[n]);if(r)return n>=i.length?r:"desc"===i[n]?-r:r}return e.index-t.index}),t.map(function(e){return e.value})},A=function(d){return function(e,t){var n=d.hierarchicalFacets[t],r=d.hierarchicalFacetsRefinements[n.name]&&d.hierarchicalFacetsRefinements[n.name][0]||"",i=d._getHierarchicalFacetSeparator(n),a=d._getHierarchicalRootPath(n),s=d._getHierarchicalShowParentLevel(n),o=F(d._getHierarchicalFacetSortBy(n)),c=e.every(function(e){return e.exhaustive}),u=function(o,c,u,l,d){return function(e,n,t){var r=e;if(0<t){var i=0;for(r=e;i<t;){var a=r&&Array.isArray(r.data)?r.data:[];r=g(a,function(e){return e.isRefined}),i++}}if(r){var s=Object.keys(n.data).map(function(e){return[e,n.data[e]]}).filter(function(e){return function(e,t,n,r,i,a){return(!i||0===e.indexOf(i)&&i!==e)&&(!i&&-1===e.indexOf(r)||i&&e.split(r).length-i.split(r).length==1||-1===e.indexOf(r)&&-1===n.indexOf(r)||0===n.indexOf(e)||0===e.indexOf(t+r)&&(a||0===e.indexOf(n)))}(e[0],r.path||u,d,c,u,l)});r.data=T(s.map(function(e){var t=e[0];return function(e,t,n,r,i){var a=t.split(n);return{name:a[a.length-1].trim(),path:t,count:e,isRefined:r===t||0===r.indexOf(t+n),exhaustive:i,data:null}}(e[1],t,c,d,n.exhaustive)}),o[0],o[1])}return e}}(o,i,a,s,r),l=e;return a&&(l=e.slice(a.split(i).length)),l.reduce(u,{name:d.hierarchicalFacets[t].name,count:null,isRefined:!0,path:null,exhaustive:c,data:null})}};function H(e){var n={};return e.forEach(function(e,t){n[e]=t}),n}function B(e,t,n){t&&t[n]&&(e.stats=t[n])}function U(l,n){var c=n[0];this._rawResults=n;var d=this;Object.keys(c).forEach(function(e){d[e]=c[e]}),this.processingTimeMS=n.reduce(function(e,t){return void 0===t.processingTimeMS?e:e+t.processingTimeMS},0),this.disjunctiveFacets=[],this.hierarchicalFacets=l.hierarchicalFacets.map(function(){return[]}),this.facets=[];var e=l.getRefinedDisjunctiveFacets(),u=H(l.facets),h=H(l.disjunctiveFacets),r=1,f=c.facets||{};Object.keys(f).forEach(function(e){var t=f[e],n=function(e,t){return g(e,function(e){return-1<(e.attributes||[]).indexOf(t)})}(l.hierarchicalFacets,e);if(n){var r=n.attributes.indexOf(e),i=I(l.hierarchicalFacets,function(e){return e.name===n.name});d.hierarchicalFacets[i][r]={attribute:e,data:t,exhaustive:c.exhaustiveFacetsCount}}else{var a,s=-1!==l.disjunctiveFacets.indexOf(e),o=-1!==l.facets.indexOf(e);s&&(a=h[e],d.disjunctiveFacets[a]={name:e,data:t,exhaustive:c.exhaustiveFacetsCount},B(d.disjunctiveFacets[a],c.facets_stats,e)),o&&(a=u[e],d.facets[a]={name:e,data:t,exhaustive:c.exhaustiveFacetsCount},B(d.facets[a],c.facets_stats,e))}}),this.hierarchicalFacets=x(this.hierarchicalFacets),e.forEach(function(e){var a=n[r],s=a&&a.facets?a.facets:{},o=l.getHierarchicalFacetByName(e);Object.keys(s).forEach(function(t){var n,e=s[t];if(o){n=I(l.hierarchicalFacets,function(e){return e.name===o.name});var r=I(d.hierarchicalFacets[n],function(e){return e.attribute===t});if(-1===r)return;d.hierarchicalFacets[n][r].data=m({},d.hierarchicalFacets[n][r].data,e)}else{n=h[t];var i=c.facets&&c.facets[t]||{};d.disjunctiveFacets[n]={name:t,data:p({},e,i),exhaustive:a.exhaustiveFacetsCount},B(d.disjunctiveFacets[n],a.facets_stats,t),l.disjunctiveFacetsRefinements[t]&&l.disjunctiveFacetsRefinements[t].forEach(function(e){!d.disjunctiveFacets[n].data[e]&&-1<l.disjunctiveFacetsRefinements[t].indexOf(e)&&(d.disjunctiveFacets[n].data[e]=0)})}}),r++}),l.getRefinedHierarchicalFacets().forEach(function(e){var s=l.getHierarchicalFacetByName(e),o=l._getHierarchicalFacetSeparator(s),c=l.getHierarchicalRefinement(e);if(!(0===c.length||c[0].split(o).length<2)){var t=n[r],u=t&&t.facets?t.facets:{};Object.keys(u).forEach(function(t){var e=u[t],n=I(l.hierarchicalFacets,function(e){return e.name===s.name}),r=I(d.hierarchicalFacets[n],function(e){return e.attribute===t});if(-1!==r){var i={};if(0<c.length){var a=c[0].split(o)[0];i[a]=d.hierarchicalFacets[n][r].data[a]}d.hierarchicalFacets[n][r].data=p(i,e,d.hierarchicalFacets[n][r].data)}}),r++}}),Object.keys(l.facetsExcludes).forEach(function(t){var e=l.facetsExcludes[t],n=u[t];d.facets[n]={name:t,data:c.facets[t],exhaustive:c.exhaustiveFacetsCount},e.forEach(function(e){d.facets[n]=d.facets[n]||{name:t},d.facets[n].data=d.facets[n].data||{},d.facets[n].data[e]=0})}),this.hierarchicalFacets=this.hierarchicalFacets.map(A(l)),this.facets=x(this.facets),this.disjunctiveFacets=x(this.disjunctiveFacets),this._state=l}function q(e,t){var n=g(e,function(e){return e.name===t});return n&&n.stats}function Q(e,t,n,r,i){var a=g(i,function(e){return e.name===n}),s=a&&a.data&&a.data[r]?a.data[r]:0,o=a&&a.exhaustive||!1;return{type:t,attributeName:n,name:r,count:s,exhaustive:o}}U.prototype.getFacetByName=function(t){function e(e){return e.name===t}return g(this.facets,e)||g(this.disjunctiveFacets,e)||g(this.hierarchicalFacets,e)},U.DEFAULT_SORT=["isRefined:desc","count:desc","name:asc"],U.prototype.getFacetValues=function(e,t){var n=function(t,n){function e(e){return e.name===n}if(t._state.isConjunctiveFacet(n)){var r=g(t.facets,e);return r?Object.keys(r.data).map(function(e){return{name:e,count:r.data[e],isRefined:t._state.isFacetRefined(n,e),isExcluded:t._state.isExcludeRefined(n,e)}}):[]}if(t._state.isDisjunctiveFacet(n)){var i=g(t.disjunctiveFacets,e);return i?Object.keys(i.data).map(function(e){return{name:e,count:i.data[e],isRefined:t._state.isDisjunctiveFacetRefined(n,e)}}):[]}if(t._state.isHierarchicalFacet(n))return g(t.hierarchicalFacets,e)}(this,e);if(n){var r,i=p({},t,{sortBy:U.DEFAULT_SORT,facetOrdering:!(t&&t.sortBy)}),a=this;if(Array.isArray(n))r=[e];else r=a._state.getHierarchicalFacetByName(n.name).attributes;return function t(n,e,r,i){if(i=i||0,Array.isArray(e))return n(e,r[i]);if(!e.data||0===e.data.length)return e;var a=e.data.map(function(e){return t(n,e,r,i+1)}),s=n(a,r[i]);return p({data:s},e)}(function(e,t){if(i.facetOrdering){var n=function(e,t){return e.renderingContent&&e.renderingContent.facetOrdering&&e.renderingContent.facetOrdering.values&&e.renderingContent.facetOrdering.values[t]}(a,t);if(Boolean(n))return function(e,t){var n=[],r=[],i=(t.order||[]).reduce(function(e,t,n){return e[t]=n,e},{});e.forEach(function(e){var t=e.path||e.name;void 0!==i[t]?n[i[t]]=e:r.push(e)}),n=n.filter(function(e){return e});var a,s=t.sortRemainingBy;return"hidden"===s?n:(a="alpha"===s?[["path","name"],["asc","asc"]]:[["count"],["desc"]],n.concat(T(r,a[0],a[1])))}(e,n)}if(Array.isArray(i.sortBy)){var r=F(i.sortBy,U.DEFAULT_SORT);return T(e,r[0],r[1])}if("function"==typeof i.sortBy)return function(e,t){return t.sort(e)}(i.sortBy,e);throw new Error("options.sortBy is optional but if defined it must be either an array of string (predicates) or a sorting function")},n,r)}},U.prototype.getFacetStats=function(e){return this._state.isConjunctiveFacet(e)?q(this.facets,e):this._state.isDisjunctiveFacet(e)?q(this.disjunctiveFacets,e):void 0},U.prototype.getRefinements=function(){var r=this._state,n=this,i=[];return Object.keys(r.facetsRefinements).forEach(function(t){r.facetsRefinements[t].forEach(function(e){i.push(Q(r,"facet",t,e,n.facets))})}),Object.keys(r.facetsExcludes).forEach(function(t){r.facetsExcludes[t].forEach(function(e){i.push(Q(r,"exclude",t,e,n.facets))})}),Object.keys(r.disjunctiveFacetsRefinements).forEach(function(t){r.disjunctiveFacetsRefinements[t].forEach(function(e){i.push(Q(r,"disjunctive",t,e,n.disjunctiveFacets))})}),Object.keys(r.hierarchicalFacetsRefinements).forEach(function(t){r.hierarchicalFacetsRefinements[t].forEach(function(e){i.push(function(e,t,n,r){var i=e.getHierarchicalFacetByName(t),a=e._getHierarchicalFacetSeparator(i),s=n.split(a),o=g(r,function(e){return e.name===t}),c=s.reduce(function(e,t){var n=e&&g(e.data,function(e){return e.name===t});return void 0!==n?n:e},o),u=c&&c.count||0,l=c&&c.exhaustive||!1,d=c&&c.path||"";return{type:"hierarchical",attributeName:t,name:d,count:u,exhaustive:l}}(r,t,e,n.hierarchicalFacets))})}),Object.keys(r.numericRefinements).forEach(function(n){var e=r.numericRefinements[n];Object.keys(e).forEach(function(t){e[t].forEach(function(e){i.push({type:"numeric",attributeName:n,name:e,numericValue:e,operator:t})})})}),r.tagRefinements.forEach(function(e){i.push({type:"tag",attributeName:"_tags",name:e})}),i};var $=U;function V(){this._events=this._events||{},this._maxListeners=this._maxListeners||void 0}var e=V;function K(e){return"function"==typeof e}function z(e){return"object"==typeof e&&null!==e}function J(e){return void 0===e}V.prototype._events=void 0,V.prototype._maxListeners=void 0,V.defaultMaxListeners=10,V.prototype.setMaxListeners=function(e){if(!function(e){return"number"==typeof e}(e)||e<0||isNaN(e))throw TypeError("n must be a positive number");return this._maxListeners=e,this},V.prototype.emit=function(e){var t,n,r,i,a,s;if(this._events||(this._events={}),"error"===e&&(!this._events.error||z(this._events.error)&&!this._events.error.length)){if((t=arguments[1])instanceof Error)throw t;var o=new Error('Uncaught, unspecified "error" event. ('+t+")");throw o.context=t,o}if(J(n=this._events[e]))return!1;if(K(n))switch(arguments.length){case 1:n.call(this);break;case 2:n.call(this,arguments[1]);break;case 3:n.call(this,arguments[1],arguments[2]);break;default:i=Array.prototype.slice.call(arguments,1),n.apply(this,i)}else if(z(n))for(i=Array.prototype.slice.call(arguments,1),r=(s=n.slice()).length,a=0;a<r;a++)s[a].apply(this,i);return!0},V.prototype.on=V.prototype.addListener=function(e,t){var n;if(!K(t))throw TypeError("listener must be a function");return this._events||(this._events={}),this._events.newListener&&this.emit("newListener",e,K(t.listener)?t.listener:t),this._events[e]?z(this._events[e])?this._events[e].push(t):this._events[e]=[this._events[e],t]:this._events[e]=t,z(this._events[e])&&!this._events[e].warned&&(n=J(this._maxListeners)?V.defaultMaxListeners:this._maxListeners)&&0<n&&this._events[e].length>n&&(this._events[e].warned=!0,console.error("(node) warning: possible EventEmitter memory leak detected. %d listeners added. Use emitter.setMaxListeners() to increase limit.",this._events[e].length),"function"==typeof console.trace&&console.trace()),this},V.prototype.once=function(e,t){if(!K(t))throw TypeError("listener must be a function");var n=!1;function r(){this.removeListener(e,r),n||(n=!0,t.apply(this,arguments))}return r.listener=t,this.on(e,r),this},V.prototype.removeListener=function(e,t){var n,r,i,a;if(!K(t))throw TypeError("listener must be a function");if(!this._events||!this._events[e])return this;if(i=(n=this._events[e]).length,r=-1,n===t||K(n.listener)&&n.listener===t)delete this._events[e],this._events.removeListener&&this.emit("removeListener",e,t);else if(z(n)){for(a=i;0<a--;)if(n[a]===t||n[a].listener&&n[a].listener===t){r=a;break}if(r<0)return this;1===n.length?(n.length=0,delete this._events[e]):n.splice(r,1),this._events.removeListener&&this.emit("removeListener",e,t)}return this},V.prototype.removeAllListeners=function(e){var t,n;if(!this._events)return this;if(!this._events.removeListener)return 0===arguments.length?this._events={}:this._events[e]&&delete this._events[e],this;if(0===arguments.length){for(t in this._events)"removeListener"!==t&&this.removeAllListeners(t);return this.removeAllListeners("removeListener"),this._events={},this}if(K(n=this._events[e]))this.removeListener(e,n);else if(n)for(;n.length;)this.removeListener(e,n[n.length-1]);return delete this._events[e],this},V.prototype.listeners=function(e){return this._events&&this._events[e]?K(this._events[e])?[this._events[e]]:this._events[e].slice():[]},V.prototype.listenerCount=function(e){if(this._events){var t=this._events[e];if(K(t))return 1;if(t)return t.length}return 0},V.listenerCount=function(e,t){return e.listenerCount(t)};var Y=function(e,t){e.prototype=Object.create(t.prototype,{constructor:{value:e,enumerable:!1,writable:!0,configurable:!0}})};function X(e,t){this.main=e,this.fn=t,this.lastResults=null}Y(X,e),X.prototype.detach=function(){this.removeAllListeners(),this.main.detachDerivedHelper(this)},X.prototype.getModifiedState=function(e){return this.fn(e)};var G=X,Z={_getQueries:function(i,a){var s=[];return s.push({indexName:i,params:Z._getHitsSearchParams(a)}),a.getRefinedDisjunctiveFacets().forEach(function(e){s.push({indexName:i,params:Z._getDisjunctiveFacetSearchParams(a,e)})}),a.getRefinedHierarchicalFacets().forEach(function(e){var t=a.getHierarchicalFacetByName(e),n=a.getHierarchicalRefinement(e),r=a._getHierarchicalFacetSeparator(t);0<n.length&&1<n[0].split(r).length&&s.push({indexName:i,params:Z._getDisjunctiveFacetSearchParams(a,e,!0)})}),s},_getHitsSearchParams:function(e){var t=e.facets.concat(e.disjunctiveFacets).concat(Z._getHitsHierarchicalFacetsAttributes(e)),n=Z._getFacetFilters(e),r=Z._getNumericFilters(e),i=Z._getTagFilters(e),a={facets:-1<t.indexOf("*")?["*"]:t,tagFilters:i};return 0<n.length&&(a.facetFilters=n),0<r.length&&(a.numericFilters=r),m({},e.getQueryParams(),a)},_getDisjunctiveFacetSearchParams:function(e,t,n){var r=Z._getFacetFilters(e,t,n),i=Z._getNumericFilters(e,t),a={hitsPerPage:1,page:0,attributesToRetrieve:[],attributesToHighlight:[],attributesToSnippet:[],tagFilters:Z._getTagFilters(e),analytics:!1,clickAnalytics:!1},s=e.getHierarchicalFacetByName(t);return a.facets=s?Z._getDisjunctiveHierarchicalFacetAttribute(e,s,n):t,0<i.length&&(a.numericFilters=i),0<r.length&&(a.facetFilters=r),m({},e.getQueryParams(),a)},_getNumericFilters:function(e,i){if(e.numericFilters)return e.numericFilters;var a=[];return Object.keys(e.numericRefinements).forEach(function(r){var t=e.numericRefinements[r]||{};Object.keys(t).forEach(function(n){var e=t[n]||[];i!==r&&e.forEach(function(e){if(Array.isArray(e)){var t=e.map(function(e){return r+n+e});a.push(t)}else a.push(r+n+e)})})}),a},_getTagFilters:function(e){return e.tagFilters?e.tagFilters:e.tagRefinements.join(",")},_getFacetFilters:function(o,c,u){var l=[],e=o.facetsRefinements||{};Object.keys(e).forEach(function(t){(e[t]||[]).forEach(function(e){l.push(t+":"+e)})});var n=o.facetsExcludes||{};Object.keys(n).forEach(function(t){(n[t]||[]).forEach(function(e){l.push(t+":-"+e)})});var r=o.disjunctiveFacetsRefinements||{};Object.keys(r).forEach(function(t){var e=r[t]||[];if(t!==c&&e&&0!==e.length){var n=[];e.forEach(function(e){n.push(t+":"+e)}),l.push(n)}});var d=o.hierarchicalFacetsRefinements||{};return Object.keys(d).forEach(function(e){var t=(d[e]||[])[0];if(void 0!==t){var n,r,i=o.getHierarchicalFacetByName(e),a=o._getHierarchicalFacetSeparator(i),s=o._getHierarchicalRootPath(i);if(c===e){if(-1===t.indexOf(a)||!s&&!0===u||s&&s.split(a).length===t.split(a).length)return;t=s?(r=s.split(a).length-1,s):(r=t.split(a).length-2,t.slice(0,t.lastIndexOf(a))),n=i.attributes[r]}else r=t.split(a).length-1,n=i.attributes[r];n&&l.push([n+":"+t])}}),l},_getHitsHierarchicalFacetsAttributes:function(s){return s.hierarchicalFacets.reduce(function(e,t){var n=s.getHierarchicalRefinement(t.name)[0];if(!n)return e.push(t.attributes[0]),e;var r=s._getHierarchicalFacetSeparator(t),i=n.split(r).length,a=t.attributes.slice(0,i+1);return e.concat(a)},[])},_getDisjunctiveHierarchicalFacetAttribute:function(e,t,n){var r=e._getHierarchicalFacetSeparator(t);if(!0===n){var i=e._getHierarchicalRootPath(t),a=0;return i&&(a=i.split(r).length),[t.attributes[a]]}var s=(e.getHierarchicalRefinement(t.name)[0]||"").split(r).length-1;return t.attributes.slice(0,1+s)},getSearchForFacetQuery:function(e,t,n,r){var i=r.isDisjunctiveFacet(e)?r.clearRefinements(e):r,a={facetQuery:t,facetName:e};return"number"==typeof n&&(a.maxFacetHits=n),m({},Z._getHitsSearchParams(i),a)}},ee=Z,te="3.7.0";function ne(e,t,n){"function"==typeof e.addAlgoliaAgent&&e.addAlgoliaAgent("JS Helper (3.7.0)"),this.setClient(e);var r=n||{};r.index=t,this.state=_.make(r),this.lastResults=null,this._queryId=0,this._lastQueryIdReceived=-1,this.derivedHelpers=[],this._currentNbQueries=0}function re(e){if(e<0)throw new Error("Page requested below 0.");return this._change({state:this.state.setPage(e),isPageReset:!1}),this}function ie(){return this.state.page}Y(ne,e),ne.prototype.search=function(){return this._search({onlyWithDerivedHelpers:!1}),this},ne.prototype.searchOnlyWithDerivedHelpers=function(){return this._search({onlyWithDerivedHelpers:!0}),this},ne.prototype.getQuery=function(){var e=this.state;return ee._getHitsSearchParams(e)},ne.prototype.searchOnce=function(e,t){var n=e?this.state.setQueryParameters(e):this.state,r=ee._getQueries(n.index,n),i=this;if(this._currentNbQueries++,this.emit("searchOnce",{state:n}),!t)return this.client.search(r).then(function(e){return i._currentNbQueries--,0===i._currentNbQueries&&i.emit("searchQueueEmpty"),{content:new $(n,e.results),state:n,_originalResponse:e}},function(e){throw i._currentNbQueries--,0===i._currentNbQueries&&i.emit("searchQueueEmpty"),e});this.client.search(r).then(function(e){i._currentNbQueries--,0===i._currentNbQueries&&i.emit("searchQueueEmpty"),t(null,new $(n,e.results),n)}).catch(function(e){i._currentNbQueries--,0===i._currentNbQueries&&i.emit("searchQueueEmpty"),t(e,null,n)})},ne.prototype.findAnswers=function(e){var t=this.state,n=this.derivedHelpers[0];if(!n)return Promise.resolve([]);var r=n.getModifiedState(t),i=m({attributesForPrediction:e.attributesForPrediction,nbHits:e.nbHits},{params:v(ee._getHitsSearchParams(r),["attributesToSnippet","hitsPerPage","restrictSearchableAttributes","snippetEllipsisText"])}),a="search for answers was called, but this client does not have a function client.initIndex(index).findAnswers";if("function"!=typeof this.client.initIndex)throw new Error(a);var s=this.client.initIndex(r.index);if("function"!=typeof s.findAnswers)throw new Error(a);return s.findAnswers(r.query,e.queryLanguages,i)},ne.prototype.searchForFacetValues=function(t,e,n,r){var i="function"==typeof this.client.searchForFacetValues;if(!i&&"function"!=typeof this.client.initIndex)throw new Error("search for facet values (searchable) was called, but this client does not have a function client.searchForFacetValues or client.initIndex(index).searchForFacetValues");var a=this.state.setQueryParameters(r||{}),s=a.isDisjunctiveFacet(t),o=ee.getSearchForFacetQuery(t,e,n,a);this._currentNbQueries++;var c=this;return this.emit("searchForFacetValues",{state:a,facet:t,query:e}),(i?this.client.searchForFacetValues([{indexName:a.index,params:o}]):this.client.initIndex(a.index).searchForFacetValues(o)).then(function(e){return c._currentNbQueries--,0===c._currentNbQueries&&c.emit("searchQueueEmpty"),(e=Array.isArray(e)?e[0]:e).facetHits.forEach(function(e){e.isRefined=s?a.isDisjunctiveFacetRefined(t,e.value):a.isFacetRefined(t,e.value)}),e},function(e){throw c._currentNbQueries--,0===c._currentNbQueries&&c.emit("searchQueueEmpty"),e})},ne.prototype.setQuery=function(e){return this._change({state:this.state.resetPage().setQuery(e),isPageReset:!0}),this},ne.prototype.clearRefinements=function(e){return this._change({state:this.state.resetPage().clearRefinements(e),isPageReset:!0}),this},ne.prototype.clearTags=function(){return this._change({state:this.state.resetPage().clearTags(),isPageReset:!0}),this},ne.prototype.addDisjunctiveFacetRefinement=function(e,t){return this._change({state:this.state.resetPage().addDisjunctiveFacetRefinement(e,t),isPageReset:!0}),this},ne.prototype.addDisjunctiveRefine=function(){return this.addDisjunctiveFacetRefinement.apply(this,arguments)},ne.prototype.addHierarchicalFacetRefinement=function(e,t){return this._change({state:this.state.resetPage().addHierarchicalFacetRefinement(e,t),isPageReset:!0}),this},ne.prototype.addNumericRefinement=function(e,t,n){return this._change({state:this.state.resetPage().addNumericRefinement(e,t,n),isPageReset:!0}),this},ne.prototype.addFacetRefinement=function(e,t){return this._change({state:this.state.resetPage().addFacetRefinement(e,t),isPageReset:!0}),this},ne.prototype.addRefine=function(){return this.addFacetRefinement.apply(this,arguments)},ne.prototype.addFacetExclusion=function(e,t){return this._change({state:this.state.resetPage().addExcludeRefinement(e,t),isPageReset:!0}),this},ne.prototype.addExclude=function(){return this.addFacetExclusion.apply(this,arguments)},ne.prototype.addTag=function(e){return this._change({state:this.state.resetPage().addTagRefinement(e),isPageReset:!0}),this},ne.prototype.removeNumericRefinement=function(e,t,n){return this._change({state:this.state.resetPage().removeNumericRefinement(e,t,n),isPageReset:!0}),this},ne.prototype.removeDisjunctiveFacetRefinement=function(e,t){return this._change({state:this.state.resetPage().removeDisjunctiveFacetRefinement(e,t),isPageReset:!0}),this},ne.prototype.removeDisjunctiveRefine=function(){return this.removeDisjunctiveFacetRefinement.apply(this,arguments)},ne.prototype.removeHierarchicalFacetRefinement=function(e){return this._change({state:this.state.resetPage().removeHierarchicalFacetRefinement(e),isPageReset:!0}),this},ne.prototype.removeFacetRefinement=function(e,t){return this._change({state:this.state.resetPage().removeFacetRefinement(e,t),isPageReset:!0}),this},ne.prototype.removeRefine=function(){return this.removeFacetRefinement.apply(this,arguments)},ne.prototype.removeFacetExclusion=function(e,t){return this._change({state:this.state.resetPage().removeExcludeRefinement(e,t),isPageReset:!0}),this},ne.prototype.removeExclude=function(){return this.removeFacetExclusion.apply(this,arguments)},ne.prototype.removeTag=function(e){return this._change({state:this.state.resetPage().removeTagRefinement(e),isPageReset:!0}),this},ne.prototype.toggleFacetExclusion=function(e,t){return this._change({state:this.state.resetPage().toggleExcludeFacetRefinement(e,t),isPageReset:!0}),this},ne.prototype.toggleExclude=function(){return this.toggleFacetExclusion.apply(this,arguments)},ne.prototype.toggleRefinement=function(e,t){return this.toggleFacetRefinement(e,t)},ne.prototype.toggleFacetRefinement=function(e,t){return this._change({state:this.state.resetPage().toggleFacetRefinement(e,t),isPageReset:!0}),this},ne.prototype.toggleRefine=function(){return this.toggleFacetRefinement.apply(this,arguments)},ne.prototype.toggleTag=function(e){return this._change({state:this.state.resetPage().toggleTagRefinement(e),isPageReset:!0}),this},ne.prototype.nextPage=function(){var e=this.state.page||0;return this.setPage(e+1)},ne.prototype.previousPage=function(){var e=this.state.page||0;return this.setPage(e-1)},ne.prototype.setCurrentPage=re,ne.prototype.setPage=re,ne.prototype.setIndex=function(e){return this._change({state:this.state.resetPage().setIndex(e),isPageReset:!0}),this},ne.prototype.setQueryParameter=function(e,t){return this._change({state:this.state.resetPage().setQueryParameter(e,t),isPageReset:!0}),this},ne.prototype.setState=function(e){return this._change({state:_.make(e),isPageReset:!1}),this},ne.prototype.overrideStateWithoutTriggeringChangeEvent=function(e){return this.state=new _(e),this},ne.prototype.hasRefinements=function(e){return!!y(this.state.getNumericRefinements(e))||(this.state.isConjunctiveFacet(e)?this.state.isFacetRefined(e):this.state.isDisjunctiveFacet(e)?this.state.isDisjunctiveFacetRefined(e):!!this.state.isHierarchicalFacet(e)&&this.state.isHierarchicalFacetRefined(e))},ne.prototype.isExcluded=function(e,t){return this.state.isExcludeRefined(e,t)},ne.prototype.isDisjunctiveRefined=function(e,t){return this.state.isDisjunctiveFacetRefined(e,t)},ne.prototype.hasTag=function(e){return this.state.isTagRefined(e)},ne.prototype.isTagRefined=function(){return this.hasTagRefinements.apply(this,arguments)},ne.prototype.getIndex=function(){return this.state.index},ne.prototype.getCurrentPage=ie,ne.prototype.getPage=ie,ne.prototype.getTags=function(){return this.state.tagRefinements},ne.prototype.getRefinements=function(e){var n=[];if(this.state.isConjunctiveFacet(e))this.state.getConjunctiveRefinements(e).forEach(function(e){n.push({value:e,type:"conjunctive"})}),this.state.getExcludeRefinements(e).forEach(function(e){n.push({value:e,type:"exclude"})});else if(this.state.isDisjunctiveFacet(e)){this.state.getDisjunctiveRefinements(e).forEach(function(e){n.push({value:e,type:"disjunctive"})})}var r=this.state.getNumericRefinements(e);return Object.keys(r).forEach(function(e){var t=r[e];n.push({value:t,operator:e,type:"numeric"})}),n},ne.prototype.getNumericRefinement=function(e,t){return this.state.getNumericRefinement(e,t)},ne.prototype.getHierarchicalFacetBreadcrumb=function(e){return this.state.getHierarchicalFacetBreadcrumb(e)},ne.prototype._search=function(e){var r=this.state,i=[],t=[];e.onlyWithDerivedHelpers||(t=ee._getQueries(r.index,r),i.push({state:r,queriesCount:t.length,helper:this}),this.emit("search",{state:r,results:this.lastResults}));var n=this.derivedHelpers.map(function(e){var t=e.getModifiedState(r),n=ee._getQueries(t.index,t);return i.push({state:t,queriesCount:n.length,helper:e}),e.emit("search",{state:t,results:e.lastResults}),n}),a=Array.prototype.concat.apply(t,n),s=this._queryId++;this._currentNbQueries++;try{this.client.search(a).then(this._dispatchAlgoliaResponse.bind(this,i,s)).catch(this._dispatchAlgoliaError.bind(this,s))}catch(e){this.emit("error",{error:e})}},ne.prototype._dispatchAlgoliaResponse=function(e,t,n){if(!(t<this._lastQueryIdReceived)){this._currentNbQueries-=t-this._lastQueryIdReceived,this._lastQueryIdReceived=t,0===this._currentNbQueries&&this.emit("searchQueueEmpty");var s=n.results.slice();e.forEach(function(e){var t=e.state,n=e.queriesCount,r=e.helper,i=s.splice(0,n),a=r.lastResults=new $(t,i);r.emit("result",{results:a,state:t})})}},ne.prototype._dispatchAlgoliaError=function(e,t){e<this._lastQueryIdReceived||(this._currentNbQueries-=e-this._lastQueryIdReceived,this._lastQueryIdReceived=e,this.emit("error",{error:t}),0===this._currentNbQueries&&this.emit("searchQueueEmpty"))},ne.prototype.containsRefinement=function(e,t,n,r){return e||0!==t.length||0!==n.length||0!==r.length},ne.prototype._hasDisjunctiveRefinements=function(e){return this.state.disjunctiveRefinements[e]&&0<this.state.disjunctiveRefinements[e].length},ne.prototype._change=function(e){var t=e.state,n=e.isPageReset;t!==this.state&&(this.state=t,this.emit("change",{state:this.state,results:this.lastResults,isPageReset:n}))},ne.prototype.clearCache=function(){return this.client.clearCache&&this.client.clearCache(),this},ne.prototype.setClient=function(e){return this.client===e||("function"==typeof e.addAlgoliaAgent&&e.addAlgoliaAgent("JS Helper (3.7.0)"),this.client=e),this},ne.prototype.getClient=function(){return this.client},ne.prototype.derive=function(e){var t=new G(this,e);return this.derivedHelpers.push(t),t},ne.prototype.detachDerivedHelper=function(e){var t=this.derivedHelpers.indexOf(e);if(-1===t)throw new Error("Derived helper already detached");this.derivedHelpers.splice(t,1)},ne.prototype.hasPendingRequests=function(){return 0<this._currentNbQueries};var ae=ne;function se(e,t,n){return new ae(e,t,n)}se.version=te,se.AlgoliaSearchHelper=ae,se.SearchParameters=_,se.SearchResults=$;var oe=se;function ce(r){function e(){for(var e=arguments.length,t=new Array(e),n=0;n<e;n++)t[n]=arguments[n];null===i&&(i=ue.then(function(){i=null,a?a=!1:r.apply(void 0,t)}))}var i=null,a=!1;return e.wait=function(){if(null===i)throw new Error("The deferred function should be called before calling `wait()`");return i},e.cancel=function(){null!==i&&(a=!0)},e}var ue=Promise.resolve();function le(e){var t="string"==typeof e,n=t?document.querySelector(e):e;if(function(e){return e instanceof HTMLElement||Boolean(e)&&0<e.nodeType}(n))return n;var r="Container must be `string` or `HTMLElement`.";throw t&&(r+=" Unable to find ".concat(e)),new Error(r)}function de(e){return 1===e.button||e.altKey||e.ctrlKey||e.metaKey||e.shiftKey}function he(e){return e.filter(function(e,t,n){return n.indexOf(e)===t})}function fe(e){var t=e.defaultTemplates,n=e.templates;return W({templatesConfig:e.templatesConfig},function(a,e){var s=1<arguments.length&&void 0!==e?e:{};return he([].concat(P(Object.keys(a||{})),P(Object.keys(s)))).reduce(function(e,t){var n=a?a[t]:void 0,r=s[t],i=void 0!==r&&r!==n;return e.templates[t]=i?r:n,e.useCustomCompileOptions[t]=i,e},{templates:{},useCustomCompileOptions:{}})}(t,n))}function me(e,t){return e(t={exports:{}},t.exports),t.exports}var pe=me(function(e,t){!function(R){var S=/\S/,t=/\"/g,n=/\n/g,r=/\r/g,i=/\\/g,a=/\u2028/,s=/\u2029/;function w(e){"}"===e.n.substr(e.n.length-1)&&(e.n=e.n.substring(0,e.n.length-1))}function _(e){return e.trim?e.trim():e.replace(/^\s*|\s*$/g,"")}function P(e,t,n){if(t.charAt(n)!=e.charAt(0))return!1;for(var r=1,i=e.length;r<i;r++)if(t.charAt(n+r)!=e.charAt(r))return!1;return!0}R.tags={"#":1,"^":2,"<":3,$:4,"/":5,"!":6,">":7,"=":8,_v:9,"{":10,"&":11,_t:12},R.scan=function(e,t){var n,r,i,a,s,o=e.length,c=0,u=null,l=null,d="",h=[],f=!1,m=0,p=0,g="{{",v="}}";function y(){0<d.length&&(h.push({tag:"_t",text:new String(d)}),d="")}function b(e,t){if(y(),e&&function(){for(var e=!0,t=p;t<h.length;t++)if(!(e=R.tags[h[t].tag]<R.tags._v||"_t"==h[t].tag&&null===h[t].text.match(S)))return!1;return e}())for(var n,r=p;r<h.length;r++)h[r].text&&((n=h[r+1])&&">"==n.tag&&(n.indent=h[r].text.toString()),h.splice(r,1));else t||h.push({tag:"\n"});f=!1,p=h.length}for(t&&(t=t.split(" "),g=t[0],v=t[1]),m=0;m<o;m++)0==c?P(g,e,m)?(--m,y(),c=1):"\n"==e.charAt(m)?b(f):d+=e.charAt(m):1==c?(m+=g.length-1,c="="==(u=(l=R.tags[e.charAt(m+1)])?e.charAt(m+1):"_v")?(r=m,void 0,i="="+v,a=(n=e).indexOf(i,r),s=_(n.substring(n.indexOf("=",r)+1,a)).split(" "),g=s[0],v=s[s.length-1],m=a+i.length-1,0):(l&&m++,2),f=m):P(v,e,m)?(h.push({tag:u,n:_(d),otag:g,ctag:v,i:"/"==u?f-g.length:m+v.length}),d="",m+=v.length-1,c=0,"{"==u&&("}}"==v?m++:w(h[h.length-1]))):d+=e.charAt(m);return b(f,!0),h};var u={_t:!0,"\n":!0,$:!0,"/":!0};function l(e,t){for(var n=0,r=t.length;n<r;n++)if(t[n].o==e.n)return e.tag="#",!0}function d(e,t,n){for(var r=0,i=n.length;r<i;r++)if(n[r].c==e&&n[r].o==t)return!0}function o(e){var t=[];for(var n in e.partials)t.push('"'+h(n)+'":{name:"'+h(e.partials[n].name)+'", '+o(e.partials[n])+"}");return"partials: {"+t.join(",")+"}, subs: "+function(e){var t=[];for(var n in e)t.push('"'+h(n)+'": function(c,p,t,i) {'+e[n]+"}");return"{ "+t.join(",")+" }"}(e.subs)}R.stringify=function(e,t,n){return"{code: function (c,p,i) { "+R.wrapMain(e.code)+" },"+o(e)+"}"};var c=0;function h(e){return e.replace(i,"\\\\").replace(t,'\\"').replace(n,"\\n").replace(r,"\\r").replace(a,"\\u2028").replace(s,"\\u2029")}function f(e){return~e.indexOf(".")?"d":"f"}function m(e,t){var n="<"+(t.prefix||"")+e.n+c++;return t.partials[n]={name:e.n,partials:{}},t.code+='t.b(t.rp("'+h(n)+'",c,p,"'+(e.indent||"")+'"));',n}function e(e,t){t.code+="t.b(t.t(t."+f(e.n)+'("'+h(e.n)+'",c,p,0)));'}function p(e){return"t.b("+e+");"}R.generate=function(e,t,n){c=0;var r={code:"",subs:{},partials:{}};return R.walk(e,r),n.asString?this.stringify(r,t,n):this.makeTemplate(r,t,n)},R.wrapMain=function(e){return'var t=this;t.b(i=i||"");'+e+"return t.fl();"},R.template=R.Template,R.makeTemplate=function(e,t,n){var r=this.makePartials(e);return r.code=new Function("c","p","i",this.wrapMain(e.code)),new this.template(r,t,this,n)},R.makePartials=function(e){var t,n={subs:{},partials:e.partials,name:e.name};for(t in n.partials)n.partials[t]=this.makePartials(n.partials[t]);for(t in e.subs)n.subs[t]=new Function("c","p","t","i",e.subs[t]);return n},R.codegen={"#":function(e,t){t.code+="if(t.s(t."+f(e.n)+'("'+h(e.n)+'",c,p,1),c,p,0,'+e.i+","+e.end+',"'+e.otag+" "+e.ctag+'")){t.rs(c,p,function(c,p,t){',R.walk(e.nodes,t),t.code+="});c.pop();}"},"^":function(e,t){t.code+="if(!t.s(t."+f(e.n)+'("'+h(e.n)+'",c,p,1),c,p,1,0,0,"")){',R.walk(e.nodes,t),t.code+="};"},">":m,"<":function(e,t){var n={partials:{},code:"",subs:{},inPartial:!0};R.walk(e.nodes,n);var r=t.partials[m(e,t)];r.subs=n.subs,r.partials=n.partials},$:function(e,t){var n={subs:{},code:"",partials:t.partials,prefix:e.n};R.walk(e.nodes,n),t.subs[e.n]=n.code,t.inPartial||(t.code+='t.sub("'+h(e.n)+'",c,p,i);')},"\n":function(e,t){t.code+=p('"\\n"'+(e.last?"":" + i"))},_v:function(e,t){t.code+="t.b(t.v(t."+f(e.n)+'("'+h(e.n)+'",c,p,0)));'},_t:function(e,t){t.code+=p('"'+h(e.text)+'"')},"{":e,"&":e},R.walk=function(e,t){for(var n,r=0,i=e.length;r<i;r++)(n=R.codegen[e[r].tag])&&n(e[r],t);return t},R.parse=function(e,t,n){return function e(t,n,r,i){var a,s=[],o=null,c=null;for(a=r[r.length-1];0<t.length;){if(c=t.shift(),a&&"<"==a.tag&&!(c.tag in u))throw new Error("Illegal content in < super tag.");if(R.tags[c.tag]<=R.tags.$||l(c,i))r.push(c),c.nodes=e(t,c.tag,r,i);else{if("/"==c.tag){if(0===r.length)throw new Error("Closing tag without opener: /"+c.n);if(o=r.pop(),c.n!=o.n&&!d(c.n,o.n,i))throw new Error("Nesting error: "+o.n+" vs. "+c.n);return o.end=c.i,s}"\n"==c.tag&&(c.last=0==t.length||"\n"==t[0].tag)}s.push(c)}if(0<r.length)throw new Error("missing closing tag: "+r.pop().n);return s}(e,0,[],(n=n||{}).sectionTags||[])},R.cache={},R.cacheKey=function(e,t){return[e,!!t.asString,!!t.disableLambda,t.delimiters,!!t.modelGet].join("||")},R.compile=function(e,t){t=t||{};var n=R.cacheKey(e,t),r=this.cache[n];if(r){var i=r.partials;for(var a in i)delete i[a].instance;return r}return r=this.generate(this.parse(this.scan(e,t.delimiters),e,t),e,t),this.cache[n]=r}}(t)}),ge=me(function(e,t){!function(e){function l(e,t,n){var r;return t&&"object"==typeof t&&(void 0!==t[e]?r=t[e]:n&&t.get&&"function"==typeof t.get&&(r=t.get(e))),r}e.Template=function(e,t,n,r){e=e||{},this.r=e.code||this.r,this.c=n,this.options=r||{},this.text=t||"",this.partials=e.partials||{},this.subs=e.subs||{},this.buf=""},e.Template.prototype={r:function(e,t,n){return""},v:function(e){return e=o(e),s.test(e)?e.replace(t,"&amp;").replace(n,"&lt;").replace(r,"&gt;").replace(i,"&#39;").replace(a,"&quot;"):e},t:o,render:function(e,t,n){return this.ri([e],t||{},n)},ri:function(e,t,n){return this.r(e,t,n)},ep:function(e,t){var n=this.partials[e],r=t[n.name];if(n.instance&&n.base==r)return n.instance;if("string"==typeof r){if(!this.c)throw new Error("No compiler available.");r=this.c.compile(r,this.options)}if(!r)return null;if(this.partials[e].base=r,n.subs){for(key in t.stackText||(t.stackText={}),n.subs)t.stackText[key]||(t.stackText[key]=void 0!==this.activeSub&&t.stackText[this.activeSub]?t.stackText[this.activeSub]:this.text);r=function(e,t,n,r,i,a){function s(){}function o(){}var c;o.prototype=(s.prototype=e).subs;var u=new s;for(c in u.subs=new o,u.subsText={},u.buf="",r=r||{},u.stackSubs=r,u.subsText=a,t)r[c]||(r[c]=t[c]);for(c in r)u.subs[c]=r[c];for(c in i=i||{},u.stackPartials=i,n)i[c]||(i[c]=n[c]);for(c in i)u.partials[c]=i[c];return u}(r,n.subs,n.partials,this.stackSubs,this.stackPartials,t.stackText)}return this.partials[e].instance=r},rp:function(e,t,n,r){var i=this.ep(e,n);return i?i.ri(t,n,r):""},rs:function(e,t,n){var r=e[e.length-1];if(d(r))for(var i=0;i<r.length;i++)e.push(r[i]),n(e,t,this),e.pop();else n(e,t,this)},s:function(e,t,n,r,i,a,s){var o;return(!d(e)||0!==e.length)&&("function"==typeof e&&(e=this.ms(e,t,n,r,i,a,s)),o=!!e,!r&&o&&t&&t.push("object"==typeof e?e:t[t.length-1]),o)},d:function(e,t,n,r){var i,a=e.split("."),s=this.f(a[0],t,n,r),o=this.options.modelGet,c=null;if("."===e&&d(t[t.length-2]))s=t[t.length-1];else for(var u=1;u<a.length;u++)s=void 0!==(i=l(a[u],s,o))?(c=s,i):"";return!(r&&!s)&&(r||"function"!=typeof s||(t.push(c),s=this.mv(s,t,n),t.pop()),s)},f:function(e,t,n,r){for(var i=!1,a=!1,s=this.options.modelGet,o=t.length-1;0<=o;o--)if(void 0!==(i=l(e,t[o],s))){a=!0;break}return a?(r||"function"!=typeof i||(i=this.mv(i,t,n)),i):!r&&""},ls:function(e,t,n,r,i){var a=this.options.delimiters;return this.options.delimiters=i,this.b(this.ct(o(e.call(t,r)),t,n)),this.options.delimiters=a,!1},ct:function(e,t,n){if(this.options.disableLambda)throw new Error("Lambda features disabled.");return this.c.compile(e,this.options).render(t,n)},b:function(e){this.buf+=e},fl:function(){var e=this.buf;return this.buf="",e},ms:function(e,t,n,r,i,a,s){var o,c=t[t.length-1],u=e.call(c);return"function"==typeof u?!!r||(o=this.activeSub&&this.subsText&&this.subsText[this.activeSub]?this.subsText[this.activeSub]:this.text,this.ls(u,c,n,o.substring(i,a),s)):u},mv:function(e,t,n){var r=t[t.length-1],i=e.call(r);return"function"==typeof i?this.ct(o(i.call(r)),r,n):i},sub:function(e,t,n,r){var i=this.subs[e];i&&(this.activeSub=e,i(t,n,this,r),this.activeSub=!1)}};var t=/&/g,n=/</g,r=/>/g,i=/\'/g,a=/\"/g,s=/[&<>\"\']/;function o(e){return String(null==e?"":e)}var d=Array.isArray||function(e){return"[object Array]"===Object.prototype.toString.call(e)}}(t)});pe.Template=ge.Template,pe.template=pe.Template;var ve=pe;function ye(e){var t=e.templates,n=e.templateKey,r=e.compileOptions,i=e.helpers,a=e.data,s=e.bindEvent,o=t[n];if("string"!=typeof o&&"function"!=typeof o)throw new Error("Template must be 'string' or 'function', was '".concat(h(o),"' (key: ").concat(n,")"));if("function"==typeof o)return o(a,s);var c=function(e,t,n){var r=0<arguments.length&&void 0!==e?e:{},i=1<arguments.length?t:void 0,a=2<arguments.length?n:void 0;return Object.keys(r).reduce(function(e,n){return W(W({},e),{},k({},n,function(){var t=this;return function(e){return r[n].call(a,e,function(e){return ve.compile(e,i).render(t)})}}))},{})}(i,r,a);return ve.compile(o,r).render(W(W({},a),{},{helpers:c})).replace(/[ \n\r\t\f\xA0]+/g,function(e){return e.replace(/(^|\xA0+)[^\xA0]+/g,"$1 ")}).trim()}function be(e,t){for(var n,r=0;r<e.length;r++)if(t(n=e[r],r,e))return n}function Re(e){return String(e).replace(/^\\-/,"-")}function Se(i,e,a,s,t){var o,n={type:e,attribute:a,name:s},c=be(4<arguments.length&&void 0!==t?t:[],function(e){return e.name===a});"hierarchical"===e?function(){for(var e=i.getHierarchicalFacetByName(a),n=s.split(e.separator),t=function(t){c=c&&c.data&&be(Object.keys(c.data).map(function(t){return function(e){return t[e]}}(c.data)),function(e){return e.name===n[t]})},r=0;void 0!==c&&r<n.length;++r)t(r);o=c&&c.count}():o=c&&c.data&&c.data[n.name];var r=c&&c.exhaustive;return void 0!==o&&(n.count=o),void 0!==r&&(n.exhaustive=r),n}function we(n,r,e){var t=2<arguments.length&&void 0!==e&&e,a=[],i=r.facetsRefinements,s=void 0===i?{}:i,o=r.facetsExcludes,c=void 0===o?{}:o,u=r.disjunctiveFacetsRefinements,l=void 0===u?{}:u,d=r.hierarchicalFacetsRefinements,h=void 0===d?{}:d,f=r.numericRefinements,m=void 0===f?{}:f,p=r.tagRefinements,g=void 0===p?[]:p;return Object.keys(s).forEach(function(t){s[t].forEach(function(e){a.push(Se(r,"facet",t,e,n.facets))})}),Object.keys(c).forEach(function(t){c[t].forEach(function(e){a.push({type:"exclude",attribute:t,name:e,exclude:!0})})}),Object.keys(l).forEach(function(t){l[t].forEach(function(e){a.push(Se(r,"disjunctive",t,Re(e),n.disjunctiveFacets))})}),Object.keys(h).forEach(function(t){h[t].forEach(function(e){a.push(Se(r,"hierarchical",t,e,n.hierarchicalFacets))})}),Object.keys(m).forEach(function(r){var i=m[r];Object.keys(i).forEach(function(e){var t=e,n=i[t];(Array.isArray(n)?n:[n]).forEach(function(e){a.push({type:"numeric",attribute:r,name:"".concat(e),numericValue:e,operator:t})})})}),g.forEach(function(e){a.push({type:"tag",attribute:"_tags",name:e})}),t&&r.query&&r.query.trim()&&a.push({attribute:"query",type:"query",name:r.query,query:r.query}),a}function _e(e){var t=e.helper,n=e.attributesToClear,r=void 0===n?[]:n,i=t.state.setPage(0);return i=r.reduce(function(e,t){return i.isNumericRefined(t)?e.removeNumericRefinement(t):i.isHierarchicalFacet(t)?e.removeHierarchicalFacetRefinement(t):i.isDisjunctiveFacet(t)?e.removeDisjunctiveFacetRefinement(t):i.isConjunctiveFacet(t)?e.removeFacetRefinement(t):e},i),-1!==r.indexOf("query")&&(i=i.setQuery("")),i}function Pe(e){return"number"==typeof e&&e<0&&(e=String(e).replace(/^-/,"\\-")),e}function Ne(e,t){if(void 0===e||"function"!=typeof e)throw new Error("The render function is not valid (received type ".concat(function(e){return Object.prototype.toString.call(e).slice(8,-1)}(e),").\n\n").concat(t))}function xe(){}function Ie(e,t){return e}function Fe(e,t){return(Array.isArray(t)?t:t.split(".")).reduce(function(e,t){return e&&e[t]},e)}function Te(e){return"number"==typeof e&&isFinite(e)}function Ce(e){if(!function(e){return"object"===h(e)&&null!==e}(e)||"[object Object]"!==function(e){return null===e?void 0===e?"[object Undefined]":"[object Null]":Object.prototype.toString.call(e)}(e))return!1;if(null===Object.getPrototypeOf(e))return!0;for(var t=e;null!==Object.getPrototypeOf(t);)t=Object.getPrototypeOf(t);return Object.getPrototypeOf(e)===t}function Ee(e){var t=e.start,n=void 0===t?0:t,r=e.end,i=e.step,a=void 0===i?1:i,s=0===a?1:a,o=Math.round((r-n)/s);return P(Array(o)).map(function(e,t){return n+t*s})}function ke(e){return e!==Object(e)}function Le(e,t){if(e===t)return!0;if(ke(e)||ke(t)||"function"==typeof e||"function"==typeof t)return e===t;if(Object.keys(e).length!==Object.keys(t).length)return!1;for(var n=0,r=Object.keys(e);n<r.length;n++){var i=r[n];if(!(i in t))return!1;if(!Le(e[i],t[i]))return!1}return!0}var Me={"&":"&amp;","<":"&lt;",">":"&gt;",'"':"&quot;","'":"&#39;"},je=/[&<>"']/g,Oe=RegExp(je.source);var Ae={"&amp;":"&","&lt;":"<","&gt;":">","&quot;":'"',"&#39;":"'"},He=/&(amp|quot|lt|gt|#39);/g,We=RegExp(He.source);var De={highlightPreTag:"__ais-highlight__",highlightPostTag:"__/ais-highlight__"},Be={highlightPreTag:"<mark>",highlightPostTag:"</mark>"};function Ue(e){return function(e){return e&&Oe.test(e)?e.replace(je,function(e){return Me[e]}):e}(e).replace(new RegExp(De.highlightPreTag,"g"),Be.highlightPreTag).replace(new RegExp(De.highlightPostTag,"g"),Be.highlightPostTag)}function qe(n){return Ce(n)&&"string"!=typeof n.value?Object.keys(n).reduce(function(e,t){return W(W({},e),{},k({},t,qe(n[t])))},{}):Array.isArray(n)?n.map(qe):W(W({},n),{},{value:Ue(n.value)})}function Qe(e){return void 0===e.__escaped&&((e=e.map(function(e){var t=f({},e);return t._highlightResult&&(t._highlightResult=qe(t._highlightResult)),t._snippetResult&&(t._snippetResult=qe(t._snippetResult)),t})).__escaped=!0),e}function $e(e){var t=Be.highlightPreTag,n=Be.highlightPostTag;return e.map(function(e){return e.isHighlighted?t+e.value+n:e.value}).join("")}function Ve(e){var n=Be.highlightPostTag,t=Be.highlightPreTag,r=e.split(t),i=r.shift(),a=i?[{value:i,isHighlighted:!1}]:[];return r.forEach(function(e){var t=e.split(n);a.push({value:t[0],isHighlighted:!0}),""!==t[1]&&a.push({value:t[1],isHighlighted:!1})}),a}var Ke=new RegExp(/\w/i);function ze(e,t){var n,r,i=e[t],a=(null===(n=e[t+1])||void 0===n?void 0:n.isHighlighted)||!0,s=(null===(r=e[t-1])||void 0===r?void 0:r.isHighlighted)||!0;return Ke.test(function(e){return e&&We.test(e)?e.replace(He,function(e){return Ae[e]}):e}(i.value))||s!==a?i.isHighlighted:s}function Je(n){return n.some(function(e){return e.isHighlighted})?n.map(function(e,t){return W(W({},e),{},{isHighlighted:!ze(n,t)})}):n.map(function(e){return W(W({},e),{},{isHighlighted:!1})})}function Ye(e,t){return e.setQueryParameters({hierarchicalFacets:t.hierarchicalFacets.reduce(function(e,t){var n=function(e,t){if(!Array.isArray(e))return-1;for(var n=0;n<e.length;n++)if(t(e[n]))return n;return-1}(e,function(e){return e.name===t.name});if(-1===n)return e.concat(t);var r=e.slice();return r.splice(n,1,t),r},e.hierarchicalFacets)})}function Xe(){for(var e=arguments.length,t=new Array(e),n=0;n<e;n++)t[n]=arguments[n];return t.reduce(function(e,t){var n=function(e,t){return e.setQueryParameters({hierarchicalFacetsRefinements:W(W({},e.hierarchicalFacetsRefinements),t.hierarchicalFacetsRefinements)})}(e,t);return function(e,t){t.facets,t.disjunctiveFacets,t.facetsRefinements,t.facetsExcludes,t.disjunctiveFacetsRefinements,t.numericRefinements,t.tagRefinements,t.hierarchicalFacets,t.hierarchicalFacetsRefinements,t.ruleContexts;var n=M(t,["facets","disjunctiveFacets","facetsRefinements","facetsExcludes","disjunctiveFacetsRefinements","numericRefinements","tagRefinements","hierarchicalFacets","hierarchicalFacetsRefinements","ruleContexts"]);return e.setQueryParameters(n)}(function(e,t){return t.facets.reduce(function(e,t){return e.addFacet(t)},e)}(function(e,t){var n=he([].concat(e.ruleContexts).concat(t.ruleContexts).filter(Boolean));return 0<n.length?e.setQueryParameters({ruleContexts:n}):e}(function(e,t){return t.disjunctiveFacets.reduce(function(e,t){return e.addDisjunctiveFacet(t)},e)}(function(e,t){return e.setQueryParameters({facetsRefinements:W(W({},e.facetsRefinements),t.facetsRefinements)})}(function(e,t){return e.setQueryParameters({facetsExcludes:W(W({},e.facetsExcludes),t.facetsExcludes)})}(function(e,t){return e.setQueryParameters({disjunctiveFacetsRefinements:W(W({},e.disjunctiveFacetsRefinements),t.disjunctiveFacetsRefinements)})}(function(e,t){return e.setQueryParameters({numericRefinements:W(W({},e.numericRefinements),t.numericRefinements)})}(function(e,t){return t.tagRefinements.reduce(function(e,t){return e.addTagRefinement(t)},e)}(Ye(n,t),t),t),t),t),t),t),t),t),t)})}function Ge(e){return Array.isArray(e)?e:[e]}function Ze(){for(var e=arguments.length,t=new Array(e),n=0;n<e;n++)t[n]=arguments[n];var r=t.map(function(e){return function(e){var t=e.name,n=e.connector;return["https://www.algolia.com/doc/api-reference/widgets/",t,"/js/",void 0!==n&&n?"#connector":""].join("")}(e)}).join(", ");return function(e){return[e,"See documentation: ".concat(r)].filter(Boolean).join("\n\n")}}var et=/^(-?\d+(?:\.\d+)?),\s*(-?\d+(?:\.\d+)?)$/;function tt(e){return Array.isArray(e)?function(e){var t=D(e,1)[0],n=D(t=void 0===t?[void 0,void 0,void 0,void 0]:t,4),r=n[0],i=n[1],a=n[2],s=n[3];if(!(r&&i&&a&&s))throw new Error('Invalid value for "insideBoundingBox" parameter: ['.concat(e,"]"));return{northEast:{lat:r,lng:i},southWest:{lat:a,lng:s}}}(e):function(e){var t=D(e.split(",").map(parseFloat),4),n=t[0],r=t[1],i=t[2],a=t[3];if(!(n&&r&&i&&a))throw new Error('Invalid value for "insideBoundingBox" parameter: "'.concat(e,'"'));return{northEast:{lat:n,lng:r},southWest:{lat:i,lng:a}}}(e)}function nt(e,n,r){return e.map(function(e,t){return W(W({},e),{},{__position:r*n+t+1})})}function rt(e,t){return t?e.map(function(e){return W(W({},e),{},{__queryID:t})}):e}function it(e){var o=e.instantSearchInstance,c=e.helper,u=e.attribute,l=e.widgetType;return function(){for(var e=arguments.length,t=new Array(e),n=0;n<e;n++)t[n]=arguments[n];var r=t[0],i=t[1],a=t[2],s=void 0===a?"Filter Applied":a;1===t.length&&"object"===h(t[0])?o.sendEventToInsights(t[0]):"click"!==r||2!==t.length&&3!==t.length||function(e,t,n){return e.state.isHierarchicalFacet(t)?e.state.isHierarchicalFacetRefined(t,n):e.state.isConjunctiveFacet(t)?e.state.isFacetRefined(t,n):e.state.isDisjunctiveFacetRefined(t,n)}(c,u,i)||o.sendEventToInsights({insightsMethod:"clickedFilters",widgetType:l,eventType:r,payload:{eventName:s,index:c.getIndex(),filters:["".concat(u,":").concat(i)]},attribute:u})}}function at(e){return btoa(encodeURIComponent(JSON.stringify(e)))}function st(e){return JSON.parse(decodeURIComponent(atob(e)))}function ot(e){var n=e.index,r=e.widgetType,t=(e.methodName,e.args);if(1===t.length&&"object"===h(t[0]))return[t[0]];var i=t[0],a=t[1],s=t[2];if(!a)return[];if(("click"===i||"conversion"===i)&&!s)return[];var o=Array.isArray(a)?function(e){return e.slice()}(a):[a];if(0===o.length)return[];var c=o[0].__queryID,u=function(e,t){for(var n=1<arguments.length&&void 0!==t?t:20,r=[],i=0;i<Math.ceil(e.length/n);i++)r.push(e.slice(i*n,(i+1)*n));return r}(o),l=u.map(function(e){return e.map(function(e){return e.objectID})}),d=u.map(function(e){return e.map(function(e){return e.__position})});return"view"===i?u.map(function(e,t){return{insightsMethod:"viewedObjectIDs",widgetType:r,eventType:i,payload:{eventName:s||"Hits Viewed",index:n,objectIDs:l[t]},hits:e}}):"click"===i?u.map(function(e,t){return{insightsMethod:"clickedObjectIDsAfterSearch",widgetType:r,eventType:i,payload:{eventName:s,index:n,queryID:c,objectIDs:l[t],positions:d[t]},hits:e}}):"conversion"===i?u.map(function(e,t){return{insightsMethod:"convertedObjectIDsAfterSearch",widgetType:r,eventType:i,payload:{eventName:s,index:n,queryID:c,objectIDs:l[t]},hits:e}}):[]}function ct(e){var r=e.instantSearchInstance,i=e.index,a=e.widgetType;return function(){for(var e=arguments.length,t=new Array(e),n=0;n<e;n++)t[n]=arguments[n];ot({widgetType:a,index:i,methodName:"sendEvent",args:t}).forEach(function(e){return r.sendEventToInsights(e)})}}function ut(e){var i=e.index,a=e.widgetType;return function(){for(var e=arguments.length,t=new Array(e),n=0;n<e;n++)t[n]=arguments[n];var r=ot({widgetType:a,index:i,methodName:"bindEvent",args:t});return r.length?"data-insights-event=".concat(at(r)):""}}function lt(e,n){if(!e)return null;var r=e.numericRefinements[n],i=[];return Object.keys(r).filter(function(e){return Array.isArray(r[e])&&0<r[e].length}).forEach(function(t){r[t].forEach(function(e){i.push("".concat(n).concat(t).concat(e))})}),i}function dt(r,i){var a=null;return function(){for(var e=arguments.length,n=new Array(e),t=0;t<e;t++)n[t]=arguments[t];return new Promise(function(e,t){a&&clearTimeout(a),a=setTimeout(function(){a=null,Promise.resolve(r.apply(void 0,n)).then(e).catch(t)},i)})}}function ht(e,t){var n,r=null===(n=e.getWidgetRenderState)||void 0===n?void 0:n.call(e,t),i=null;if(r&&r.widgetParams){var a=r.widgetParams;a.attribute?i=a.attribute:Array.isArray(a.attributes)&&(i=a.attributes[0])}if("string"!=typeof i)throw new Error("Could not find the attribute of the widget:\n\n".concat(JSON.stringify(e),"\n\nPlease check whether the widget's getWidgetRenderState returns widgetParams.attribute correctly."));return i}function ft(e,t){var n=(1<arguments.length&&void 0!==t?t:{fallback:function(){}}).fallback;return"undefined"==typeof window?n():e({window:window})}var mt=Ze({name:"index-widget"});function pt(e){return"ais.index"===e.$$type}function gt(e,t){var n=t.state,r=t.isPageReset,i=t._uiState;n!==e.state&&(e.state=n,e.emit("change",{state:e.state,results:e.lastResults,isPageReset:r,_uiState:i}))}function vt(e,n,t){var r=2<arguments.length&&void 0!==t?t:{};return e.reduce(function(e,t){return pt(t)?e:t.getWidgetUiState||t.getWidgetState?t.getWidgetUiState?t.getWidgetUiState(e,n):t.getWidgetState(e,n):e},r)}function yt(e,t){var n=t.initialSearchParameters,r=M(t,["initialSearchParameters"]);return e.filter(function(e){return!pt(e)}).reduce(function(e,t){return t.getWidgetSearchParameters?t.getWidgetSearchParameters(e,r):e},n)}function bt(e){if(void 0===e||void 0===e.indexName)throw new Error(mt("The `indexName` option is required."));var l=e.indexName,t=e.indexId,d=void 0===t?l:t,h=[],f={},m=null,p=null,g=null,v=null;return{$$type:"ais.index",$$widgetType:"ais.index",getIndexName:function(){return l},getIndexId:function(){return d},getHelper:function(){return g},getResults:function(){return v&&v.lastResults},getScopedResults:function(){var e=this.getParent();return function n(e){return e.filter(pt).reduce(function(e,t){return e.concat.apply(e,[{indexId:t.getIndexId(),results:t.getResults(),helper:t.getHelper()}].concat(P(n(t.getWidgets()))))},[])}(e?e.getWidgets():[this])},getParent:function(){return p},createURL:function(e){return m._createURL(k({},d,vt(h,{searchParameters:e,helper:g})))},getWidgets:function(){return h},addWidgets:function(e){var t=this;if(!Array.isArray(e))throw new Error(mt("The `addWidgets` method expects an array of widgets."));if(e.some(function(e){return"function"!=typeof e.init&&"function"!=typeof e.render}))throw new Error(mt("The widget definition expects a `render` and/or an `init` method."));return h=h.concat(e),m&&Boolean(e.length)&&(gt(g,{state:yt(h,{uiState:f,initialSearchParameters:g.state}),_uiState:f}),e.forEach(function(e){e.getRenderState&&Rt({renderState:e.getRenderState(m.renderState[t.getIndexId()]||{},{uiState:m._initialUiState,helper:t.getHelper(),parent:t,instantSearchInstance:m,state:g.state,renderState:m.renderState,templatesConfig:m.templatesConfig,createURL:t.createURL,scopedResults:[],searchMetadata:{isSearchStalled:m._isSearchStalled}}),instantSearchInstance:m,parent:t})}),e.forEach(function(e){e.init&&e.init({helper:g,parent:t,uiState:m._initialUiState,instantSearchInstance:m,state:g.state,renderState:m.renderState,templatesConfig:m.templatesConfig,createURL:t.createURL,scopedResults:[],searchMetadata:{isSearchStalled:m._isSearchStalled}})}),m.scheduleSearch()),this},removeWidgets:function(t){var n=this;if(!Array.isArray(t))throw new Error(mt("The `removeWidgets` method expects an array of widgets."));if(t.some(function(e){return"function"!=typeof e.dispose}))throw new Error(mt("The widget definition expects a `dispose` method."));if(h=h.filter(function(e){return-1===t.indexOf(e)}),m&&Boolean(t.length)){var e=t.reduce(function(e,t){return t.dispose({helper:g,state:e,parent:n})||e},g.state);f=vt(h,{searchParameters:e,helper:g}),g.setState(yt(h,{uiState:f,initialSearchParameters:e})),h.length&&m.scheduleSearch()}return this},init:function(e){var t,n=this,r=e.instantSearchInstance,i=e.parent,a=e.uiState;if(null===g){m=r,p=i,f=a[d]||{};var s=r.mainHelper,o=yt(h,{uiState:f,initialSearchParameters:new oe.SearchParameters({index:l})});(g=oe({},o.index,o)).search=function(){return r.onStateChange?(r.onStateChange({uiState:r.mainIndex.getWidgetUiState({}),setUiState:r.setUiState.bind(r)}),s):s.search()},g.searchWithoutTriggeringOnStateChange=function(){return s.search()},g.searchForFacetValues=function(e,t,n,r){var i=g.state.setQueryParameters(r);return s.searchForFacetValues(e,t,n,i)},v=s.derive(function(){return Xe.apply(void 0,P(function(e){for(var t=e.getParent(),n=[e.getHelper().state];null!==t;)n=[t.getHelper().state].concat(n),t=t.getParent();return n}(n)))});var c=null===(t=r._initialResults)||void 0===t?void 0:t[this.getIndexId()];if(c){var u=new oe.SearchResults(new oe.SearchParameters(c.state),c.results);v.lastResults=u,g.lastResults=u}g.on("change",function(e){e.isPageReset&&!function n(e){var t=e.filter(pt);0!==t.length&&t.forEach(function(e){var t=e.getHelper();gt(t,{state:t.state.resetPage(),isPageReset:!0}),n(e.getWidgets())})}(h)}),v.on("search",function(){r.scheduleStalledRender()}),v.on("result",function(e){var t=e.results;r.scheduleRender(),g.lastResults=t}),h.forEach(function(e){e.getRenderState&&Rt({renderState:e.getRenderState(r.renderState[n.getIndexId()]||{},{uiState:a,helper:g,parent:n,instantSearchInstance:r,state:g.state,renderState:r.renderState,templatesConfig:r.templatesConfig,createURL:n.createURL,scopedResults:[],searchMetadata:{isSearchStalled:r._isSearchStalled}}),instantSearchInstance:r,parent:n})}),h.forEach(function(e){e.init&&e.init({uiState:a,helper:g,parent:n,instantSearchInstance:r,state:g.state,renderState:r.renderState,templatesConfig:r.templatesConfig,createURL:n.createURL,scopedResults:[],searchMetadata:{isSearchStalled:r._isSearchStalled}})}),g.on("change",function(e){var t=e.state,n=e._uiState;f=vt(h,{searchParameters:t,helper:g},n||{}),r.onStateChange||r.onInternalStateChange()}),c&&r.scheduleRender()}},render:function(e){var t=this,n=e.instantSearchInstance;this.getResults()&&(h.forEach(function(e){e.getRenderState&&Rt({renderState:e.getRenderState(n.renderState[t.getIndexId()]||{},{helper:t.getHelper(),parent:t,instantSearchInstance:n,results:t.getResults(),scopedResults:t.getScopedResults(),state:t.getResults()._state,renderState:n.renderState,templatesConfig:n.templatesConfig,createURL:t.createURL,searchMetadata:{isSearchStalled:n._isSearchStalled}}),instantSearchInstance:n,parent:t})}),h.forEach(function(e){e.render&&e.render({helper:g,parent:t,instantSearchInstance:n,results:t.getResults(),scopedResults:t.getScopedResults(),state:t.getResults()._state,renderState:n.renderState,templatesConfig:n.templatesConfig,createURL:t.createURL,searchMetadata:{isSearchStalled:n._isSearchStalled}})}))},dispose:function(){var t=this;h.forEach(function(e){e.dispose&&e.dispose({helper:g,state:g.state,parent:t})}),p=m=null,g.removeAllListeners(),g=null,v.detach(),v=null},getWidgetUiState:function(e){return h.filter(pt).reduce(function(e,t){return t.getWidgetUiState(e)},W(W({},e),{},k({},this.getIndexId(),f)))},getWidgetState:function(e){return this.getWidgetUiState(e)},getWidgetSearchParameters:function(e,t){var n=t.uiState;return yt(h,{uiState:n,initialSearchParameters:e})},refreshUiState:function(){f=vt(h,{searchParameters:this.getHelper().state,helper:this.getHelper()},f)}}}function Rt(e){var t=e.renderState,n=e.instantSearchInstance,r=e.parent,i=r?r.getIndexId():n.mainIndex.getIndexId();n.renderState=W(W({},n.renderState),{},k({},i,W(W({},n.renderState[i]),t)))}function St(a){return function(){var e=0<arguments.length&&void 0!==arguments[0]?arguments[0]:{},t=e.descendantName,n=e.modifierName,r=t?"-".concat(t):"",i=n?"--".concat(n):"";return"".concat("ais","-").concat(a).concat(r).concat(i)}}var wt=St("Highlight");function _t(e){var t=e.attribute,n=e.highlightedTagName,r=void 0===n?"mark":n,i=e.hit,a=e.cssClasses,s=void 0===a?{}:a,o=(Fe(i._highlightResult,t)||{}).value,c=void 0===o?"":o,u=wt({descendantName:"highlighted"})+(s.highlighted?" ".concat(s.highlighted):"");return c.replace(new RegExp(Be.highlightPreTag,"g"),"<".concat(r,' class="').concat(u,'">')).replace(new RegExp(Be.highlightPostTag,"g"),"</".concat(r,">"))}var Pt=St("ReverseHighlight");function Nt(e){var t=e.attribute,n=e.highlightedTagName,r=void 0===n?"mark":n,i=e.hit,a=e.cssClasses,s=void 0===a?{}:a,o=(Fe(i._highlightResult,t)||{}).value,c=void 0===o?"":o,u=Pt({descendantName:"highlighted"})+(s.highlighted?" ".concat(s.highlighted):"");return $e(Je(Ve(c))).replace(new RegExp(Be.highlightPreTag,"g"),"<".concat(r,' class="').concat(u,'">')).replace(new RegExp(Be.highlightPostTag,"g"),"</".concat(r,">"))}var xt=St("Snippet");function It(e){var t=e.attribute,n=e.highlightedTagName,r=void 0===n?"mark":n,i=e.hit,a=e.cssClasses,s=void 0===a?{}:a,o=(Fe(i._snippetResult,t)||{}).value,c=void 0===o?"":o,u=xt({descendantName:"highlighted"})+(s.highlighted?" ".concat(s.highlighted):"");return c.replace(new RegExp(Be.highlightPreTag,"g"),"<".concat(r,' class="').concat(u,'">')).replace(new RegExp(Be.highlightPostTag,"g"),"</".concat(r,">"))}var Ft=St("ReverseSnippet");function Tt(e){var t=e.attribute,n=e.highlightedTagName,r=void 0===n?"mark":n,i=e.hit,a=e.cssClasses,s=void 0===a?{}:a,o=(Fe(i._snippetResult,t)||{}).value,c=void 0===o?"":o,u=Ft({descendantName:"highlighted"})+(s.highlighted?" ".concat(s.highlighted):"");return $e(Je(Ve(c))).replace(new RegExp(Be.highlightPreTag,"g"),"<".concat(r,' class="').concat(u,'">')).replace(new RegExp(Be.highlightPostTag,"g"),"</".concat(r,">"))}function Ct(e,t){return function(e){var t,n=e.method,r=e.payload;if("object"!==h(r))throw new Error("The insights helper expects the payload to be an object.");try{t=at(r)}catch(e){throw new Error("Could not JSON serialize the payload object.")}return'data-insights-method="'.concat(n,'" data-insights-payload="').concat(t,'"')}({method:e,payload:t})}function Et(){return function(e){for(var t="".concat(e,"="),n=document.cookie.split(";"),r=0;r<n.length;r++){for(var i=n[r];" "===i.charAt(0);)i=i.substring(1);if(0===i.indexOf(t))return i.substring(t.length,i.length)}}("_ALGOLIA")}function kt(e){e.configure;return M(e,["configure"])}function Lt(){return{stateToRoute:function(n){return Object.keys(n).reduce(function(e,t){return W(W({},e),{},k({},t,kt(n[t])))},{})},routeToState:function(e){var n=0<arguments.length&&void 0!==e?e:{};return Object.keys(n).reduce(function(e,t){return W(W({},e),{},k({},t,kt(n[t])))},{})}}}function Mt(e,t){for(var n=t&&t.plainObjects?Object.create(null):{},r=0;r<e.length;++r)void 0!==e[r]&&(n[r]=e[r]);return n}function jt(e,t){Xt.apply(e,Yt(t)?t:[t])}function Ot(e,t,n,r,i,a,s,o,c,u,l,d,h,f){var m=e;if("function"==typeof s?m=s(t,m):m instanceof Date?m=u(m):"comma"===n&&Yt(m)&&(m=Kt.maybeMap(m,function(e){return e instanceof Date?u(e):e})),null===m){if(r)return a&&!h?a(t,en.encoder,f,"key",l):t;m=""}if(function(e){return"string"==typeof e||"number"==typeof e||"boolean"==typeof e||"symbol"==typeof e||"bigint"==typeof e}(m)||Kt.isBuffer(m))return a?[d(h?t:a(t,en.encoder,f,"key",l))+"="+d(a(m,en.encoder,f,"value",l))]:[d(t)+"="+d(String(m))];var p,g=[];if(void 0===m)return g;if("comma"===n&&Yt(m))p=[{value:0<m.length?m.join(",")||null:void 0}];else if(Yt(s))p=s;else{var v=Object.keys(m);p=o?v.sort(o):v}for(var y=0;y<p.length;++y){var b=p[y],R="object"==typeof b&&void 0!==b.value?b.value:m[b];if(!i||null!==R){var S=Yt(m)?"function"==typeof n?n(t,b):t:t+(c?"."+b:"["+b+"]");jt(g,Ot(R,S,n,r,i,a,s,o,c,u,l,d,h,f))}}return g}function At(e,t){return e&&"string"==typeof e&&t.comma&&-1<e.indexOf(",")?e.split(","):e}function Ht(e,t,n,r){if(e){var i=n.allowDots?e.replace(/\.([^.[]+)/g,"[$1]"):e,a=/(\[[^[\]]*])/g,s=0<n.depth&&/(\[[^[\]]*])/.exec(i),o=s?i.slice(0,s.index):i,c=[];if(o){if(!n.plainObjects&&tn.call(Object.prototype,o)&&!n.allowPrototypes)return;c.push(o)}for(var u=0;0<n.depth&&null!==(s=a.exec(i))&&u<n.depth;){if(u+=1,!n.plainObjects&&tn.call(Object.prototype,s[1].slice(1,-1))&&!n.allowPrototypes)return;c.push(s[1])}return s&&c.push("["+i.slice(s.index)+"]"),function(e,t,n,r){for(var i=r?t:At(t,n),a=e.length-1;0<=a;--a){var s,o=e[a];if("[]"===o&&n.parseArrays)s=[].concat(i);else{s=n.plainObjects?Object.create(null):{};var c="["===o.charAt(0)&&"]"===o.charAt(o.length-1)?o.slice(1,-1):o,u=parseInt(c,10);n.parseArrays||""!==c?!isNaN(u)&&o!==c&&String(u)===c&&0<=u&&n.parseArrays&&u<=n.arrayLimit?(s=[])[u]=i:s[c]=i:s={0:i}}i=s}return i}(c,t,n,r)}}function Wt(e){e&&(window.document.title=e)}var Dt=String.prototype.replace,Bt=/%20/g,Ut="RFC3986",qt={default:Ut,formatters:{RFC1738:function(e){return Dt.call(e,Bt,"+")},RFC3986:function(e){return String(e)}},RFC1738:"RFC1738",RFC3986:Ut},Qt=Object.prototype.hasOwnProperty,$t=Array.isArray,Vt=function(){for(var e=[],t=0;t<256;++t)e.push("%"+((t<16?"0":"")+t.toString(16)).toUpperCase());return e}(),Kt={arrayToObject:Mt,assign:function(e,n){return Object.keys(n).reduce(function(e,t){return e[t]=n[t],e},e)},combine:function(e,t){return[].concat(e,t)},compact:function(e){for(var t=[{obj:{o:e},prop:"o"}],n=[],r=0;r<t.length;++r)for(var i=t[r],a=i.obj[i.prop],s=Object.keys(a),o=0;o<s.length;++o){var c=s[o],u=a[c];"object"==typeof u&&null!==u&&-1===n.indexOf(u)&&(t.push({obj:a,prop:c}),n.push(u))}return function(e){for(;1<e.length;){var t=e.pop(),n=t.obj[t.prop];if($t(n)){for(var r=[],i=0;i<n.length;++i)void 0!==n[i]&&r.push(n[i]);t.obj[t.prop]=r}}}(t),e},decode:function(e,t,n){var r=e.replace(/\+/g," ");if("iso-8859-1"===n)return r.replace(/%[0-9a-f]{2}/gi,unescape);try{return decodeURIComponent(r)}catch(e){return r}},encode:function(e,t,n,r,i){if(0===e.length)return e;var a=e;if("symbol"==typeof e?a=Symbol.prototype.toString.call(e):"string"!=typeof e&&(a=String(e)),"iso-8859-1"===n)return escape(a).replace(/%u[0-9a-f]{4}/gi,function(e){return"%26%23"+parseInt(e.slice(2),16)+"%3B"});for(var s="",o=0;o<a.length;++o){var c=a.charCodeAt(o);45===c||46===c||95===c||126===c||48<=c&&c<=57||65<=c&&c<=90||97<=c&&c<=122||i===qt.RFC1738&&(40===c||41===c)?s+=a.charAt(o):c<128?s+=Vt[c]:c<2048?s+=Vt[192|c>>6]+Vt[128|63&c]:c<55296||57344<=c?s+=Vt[224|c>>12]+Vt[128|c>>6&63]+Vt[128|63&c]:(o+=1,c=65536+((1023&c)<<10|1023&a.charCodeAt(o)),s+=Vt[240|c>>18]+Vt[128|c>>12&63]+Vt[128|c>>6&63]+Vt[128|63&c])}return s},isBuffer:function(e){return!(!e||"object"!=typeof e)&&!!(e.constructor&&e.constructor.isBuffer&&e.constructor.isBuffer(e))},isRegExp:function(e){return"[object RegExp]"===Object.prototype.toString.call(e)},maybeMap:function(e,t){if($t(e)){for(var n=[],r=0;r<e.length;r+=1)n.push(t(e[r]));return n}return t(e)},merge:function r(i,a,s){if(!a)return i;if("object"!=typeof a){if($t(i))i.push(a);else{if(!i||"object"!=typeof i)return[i,a];(s&&(s.plainObjects||s.allowPrototypes)||!Qt.call(Object.prototype,a))&&(i[a]=!0)}return i}if(!i||"object"!=typeof i)return[i].concat(a);var e=i;return $t(i)&&!$t(a)&&(e=Mt(i,s)),$t(i)&&$t(a)?(a.forEach(function(e,t){if(Qt.call(i,t)){var n=i[t];n&&"object"==typeof n&&e&&"object"==typeof e?i[t]=r(n,e,s):i.push(e)}else i[t]=e}),i):Object.keys(a).reduce(function(e,t){var n=a[t];return Qt.call(e,t)?e[t]=r(e[t],n,s):e[t]=n,e},e)}},zt=Object.prototype.hasOwnProperty,Jt={brackets:function(e){return e+"[]"},comma:"comma",indices:function(e,t){return e+"["+t+"]"},repeat:function(e){return e}},Yt=Array.isArray,Xt=Array.prototype.push,Gt=Date.prototype.toISOString,Zt=qt.default,en={addQueryPrefix:!1,allowDots:!1,charset:"utf-8",charsetSentinel:!1,delimiter:"&",encode:!0,encoder:Kt.encode,encodeValuesOnly:!1,format:Zt,formatter:qt.formatters[Zt],indices:!1,serializeDate:function(e){return Gt.call(e)},skipNulls:!1,strictNullHandling:!1},tn=Object.prototype.hasOwnProperty,nn=Array.isArray,rn={allowDots:!1,allowPrototypes:!1,arrayLimit:20,charset:"utf-8",charsetSentinel:!1,comma:!1,decoder:Kt.decode,delimiter:"&",depth:5,ignoreQueryPrefix:!1,interpretNumericEntities:!1,parameterLimit:1e3,parseArrays:!0,plainObjects:!1,strictNullHandling:!1},an={formats:qt,parse:function(e,t){var n=function(e){if(!e)return rn;if(null!==e.decoder&&void 0!==e.decoder&&"function"!=typeof e.decoder)throw new TypeError("Decoder has to be a function.");if(void 0!==e.charset&&"utf-8"!==e.charset&&"iso-8859-1"!==e.charset)throw new TypeError("The charset option must be either utf-8, iso-8859-1, or undefined");var t=void 0===e.charset?rn.charset:e.charset;return{allowDots:void 0===e.allowDots?rn.allowDots:!!e.allowDots,allowPrototypes:"boolean"==typeof e.allowPrototypes?e.allowPrototypes:rn.allowPrototypes,arrayLimit:"number"==typeof e.arrayLimit?e.arrayLimit:rn.arrayLimit,charset:t,charsetSentinel:"boolean"==typeof e.charsetSentinel?e.charsetSentinel:rn.charsetSentinel,comma:"boolean"==typeof e.comma?e.comma:rn.comma,decoder:"function"==typeof e.decoder?e.decoder:rn.decoder,delimiter:"string"==typeof e.delimiter||Kt.isRegExp(e.delimiter)?e.delimiter:rn.delimiter,depth:"number"==typeof e.depth||!1===e.depth?+e.depth:rn.depth,ignoreQueryPrefix:!0===e.ignoreQueryPrefix,interpretNumericEntities:"boolean"==typeof e.interpretNumericEntities?e.interpretNumericEntities:rn.interpretNumericEntities,parameterLimit:"number"==typeof e.parameterLimit?e.parameterLimit:rn.parameterLimit,parseArrays:!1!==e.parseArrays,plainObjects:"boolean"==typeof e.plainObjects?e.plainObjects:rn.plainObjects,strictNullHandling:"boolean"==typeof e.strictNullHandling?e.strictNullHandling:rn.strictNullHandling}}(t);if(""===e||null==e)return n.plainObjects?Object.create(null):{};for(var r="string"==typeof e?function(e,t){var n,r={},i=t.ignoreQueryPrefix?e.replace(/^\?/,""):e,a=t.parameterLimit===1/0?void 0:t.parameterLimit,s=i.split(t.delimiter,a),o=-1,c=t.charset;if(t.charsetSentinel)for(n=0;n<s.length;++n)0===s[n].indexOf("utf8=")&&("utf8=%E2%9C%93"===s[n]?c="utf-8":"utf8=%26%2310003%3B"===s[n]&&(c="iso-8859-1"),o=n,n=s.length);for(n=0;n<s.length;++n)if(n!==o){var u,l,d=s[n],h=d.indexOf("]="),f=-1===h?d.indexOf("="):h+1;(l=-1===f?(u=t.decoder(d,rn.decoder,c,"key"),t.strictNullHandling?null:""):(u=t.decoder(d.slice(0,f),rn.decoder,c,"key"),Kt.maybeMap(At(d.slice(f+1),t),function(e){return t.decoder(e,rn.decoder,c,"value")})))&&t.interpretNumericEntities&&"iso-8859-1"===c&&(l=l.replace(/&#(\d+);/g,function(e,t){return String.fromCharCode(parseInt(t,10))})),-1<d.indexOf("[]=")&&(l=nn(l)?[l]:l),tn.call(r,u)?r[u]=Kt.combine(r[u],l):r[u]=l}return r}(e,n):e,i=n.plainObjects?Object.create(null):{},a=Object.keys(r),s=0;s<a.length;++s){var o=a[s],c=Ht(o,r[o],n,"string"==typeof e);i=Kt.merge(i,c,n)}return Kt.compact(i)},stringify:function(e,t){var n,r=e,i=function(e){if(!e)return en;if(null!==e.encoder&&void 0!==e.encoder&&"function"!=typeof e.encoder)throw new TypeError("Encoder has to be a function.");var t=e.charset||en.charset;if(void 0!==e.charset&&"utf-8"!==e.charset&&"iso-8859-1"!==e.charset)throw new TypeError("The charset option must be either utf-8, iso-8859-1, or undefined");var n=qt.default;if(void 0!==e.format){if(!zt.call(qt.formatters,e.format))throw new TypeError("Unknown format option provided.");n=e.format}var r=qt.formatters[n],i=en.filter;return"function"!=typeof e.filter&&!Yt(e.filter)||(i=e.filter),{addQueryPrefix:"boolean"==typeof e.addQueryPrefix?e.addQueryPrefix:en.addQueryPrefix,allowDots:void 0===e.allowDots?en.allowDots:!!e.allowDots,charset:t,charsetSentinel:"boolean"==typeof e.charsetSentinel?e.charsetSentinel:en.charsetSentinel,delimiter:void 0===e.delimiter?en.delimiter:e.delimiter,encode:"boolean"==typeof e.encode?e.encode:en.encode,encoder:"function"==typeof e.encoder?e.encoder:en.encoder,encodeValuesOnly:"boolean"==typeof e.encodeValuesOnly?e.encodeValuesOnly:en.encodeValuesOnly,filter:i,format:n,formatter:r,serializeDate:"function"==typeof e.serializeDate?e.serializeDate:en.serializeDate,skipNulls:"boolean"==typeof e.skipNulls?e.skipNulls:en.skipNulls,sort:"function"==typeof e.sort?e.sort:null,strictNullHandling:"boolean"==typeof e.strictNullHandling?e.strictNullHandling:en.strictNullHandling}}(t);"function"==typeof i.filter?r=(0,i.filter)("",r):Yt(i.filter)&&(n=i.filter);var a,s=[];if("object"!=typeof r||null===r)return"";a=t&&t.arrayFormat in Jt?t.arrayFormat:t&&"indices"in t?t.indices?"indices":"repeat":"indices";var o=Jt[a];n=n||Object.keys(r),i.sort&&n.sort(i.sort);for(var c=0;c<n.length;++c){var u=n[c];i.skipNulls&&null===r[u]||jt(s,Ot(r[u],u,o,i.strictNullHandling,i.skipNulls,i.encode?i.encoder:null,i.filter,i.sort,i.allowDots,i.serializeDate,i.format,i.formatter,i.encodeValuesOnly,i.charset))}var l=s.join(i.delimiter),d=!0===i.addQueryPrefix?"?":"";return i.charsetSentinel&&("iso-8859-1"===i.charset?d+="utf8=%26%2310003%3B&":d+="utf8=%E2%9C%93&"),0<l.length?d+l:""}},sn=function(){function c(e){var t=this,n=e.windowTitle,r=e.writeDelay,i=void 0===r?400:r,a=e.createURL,s=e.parseURL,o=e.getLocation;C(this,c),k(this,"windowTitle",void 0),k(this,"writeDelay",void 0),k(this,"_createURL",void 0),k(this,"parseURL",void 0),k(this,"getLocation",void 0),k(this,"writeTimer",void 0),k(this,"shouldPushState",!0),this.windowTitle=n,this.writeTimer=void 0,this.writeDelay=i,this._createURL=a,this.parseURL=s,this.getLocation=o,ft(function(){var e=t.windowTitle&&t.windowTitle(t.read());Wt(e)})}return E(c,[{key:"read",value:function(){return this.parseURL({qsModule:an,location:this.getLocation()})}},{key:"write",value:function(i){var a=this;ft(function(e){var t=e.window,n=a.createURL(i),r=a.windowTitle&&a.windowTitle(i);a.writeTimer&&clearTimeout(a.writeTimer),a.writeTimer=setTimeout(function(){Wt(r),a.shouldPushState&&t.history.pushState(i,r||"",n),a.shouldPushState=!0,a.writeTimer=void 0},a.writeDelay)})}},{key:"onUpdate",value:function(n){var r=this;this._onPopState=function(e){r.writeTimer&&(clearTimeout(r.writeTimer),r.writeTimer=void 0),r.shouldPushState=!1;var t=e.state;n(t||r.read())},ft(function(e){e.window.addEventListener("popstate",r._onPopState)})}},{key:"createURL",value:function(e){return this._createURL({qsModule:an,routeState:e,location:this.getLocation()})}},{key:"dispose",value:function(){var n=this;ft(function(e){var t=e.window;n._onPopState&&t.removeEventListener("popstate",n._onPopState)}),this.writeTimer&&clearTimeout(this.writeTimer),this.write({})}}]),c}();function on(){var e=0<arguments.length&&void 0!==arguments[0]?arguments[0]:{},t=e.createURL,n=void 0===t?function(e){var t=e.qsModule,n=e.routeState,r=e.location,i=r.protocol,a=r.hostname,s=r.port,o=void 0===s?"":s,c=r.pathname,u=r.hash,l=t.stringify(n),d=""===o?"":":".concat(o);return l?"".concat(i,"//").concat(a).concat(d).concat(c,"?").concat(l).concat(u):"".concat(i,"//").concat(a).concat(d).concat(c).concat(u)}:t,r=e.parseURL,i=void 0===r?function(e){var t=e.qsModule,n=e.location;return t.parse(n.search.slice(1),{arrayLimit:99})}:r,a=e.writeDelay,s=void 0===a?400:a,o=e.windowTitle,c=e.getLocation;return new sn({createURL:n,parseURL:i,writeDelay:s,windowTitle:o,getLocation:void 0===c?function(){return ft(function(e){return e.window.location},{fallback:function(){throw new Error("You need to provide `getLocation` to the `history` router in environments where `window` does not exist.")}})}:c})}function cn(e){var t=0<arguments.length&&void 0!==e?e:{},n=t.router,a=void 0===n?on():n,r=t.stateMapping,s=void 0===r?Lt():r;return function(e){var r=e.instantSearchInstance;r._createURL=function(n){var e=Object.keys(n).reduce(function(e,t){return W(W({},e),{},k({},t,n[t]))},r.mainIndex.getWidgetUiState({})),t=s.stateToRoute(e);return a.createURL(t)};var i=void 0,t=r._initialUiState;return{onStateChange:function(e){var t=e.uiState,n=s.stateToRoute(t);void 0!==i&&Le(i,n)||(a.write(n),i=n)},subscribe:function(){r._initialUiState=W(W({},t),s.routeToState(a.read())),a.onUpdate(function(e){r.setUiState(s.routeToState(e))})},unsubscribe:function(){a.dispose()}}}}function un(){return ft(function(e){return-1<e.window.navigator.userAgent.indexOf("Algolia Crawler")},{fallback:function(){return!1}})}function ln(){return function(e){var t=e.instantSearchInstance,n={widgets:[]},r=document.createElement("meta"),i=document.querySelector("head");return r.name="instantsearch:widgets",{onStateChange:function(){},subscribe:function(){setTimeout(function(){var e=t.client;n.ua=e.transporter&&e.transporter.userAgent?e.transporter.userAgent.value:e._ua,function i(e,a,s){var t=a.mainIndex,o={instantSearchInstance:a,parent:t,scopedResults:[],state:t.getHelper().state,helper:t.getHelper(),createURL:t.createURL,uiState:a._initialUiState,renderState:a.renderState,templatesConfig:a.templatesConfig,searchMetadata:{isSearchStalled:a._isSearchStalled}};e.forEach(function(e){var t={};if(e.getWidgetRenderState){var n=e.getWidgetRenderState(o);n&&n.widgetParams&&(t=n.widgetParams)}var r=Object.keys(t).filter(function(e){return void 0!==t[e]});s.widgets.push({type:e.$$type,widgetType:e.$$widgetType,params:r}),"ais.index"===e.$$type&&i(e.getWidgets(),a,s)})}(t.mainIndex.getWidgets(),t,n),r.content=JSON.stringify(n),i.appendChild(r)},0)},unsubscribe:function(){r.remove()}}}}var dn=Ze({name:"instantsearch"});function hn(){return"#"}function fn(d,e){var h=1<arguments.length&&void 0!==e?e:xe;return Ne(d,pn()),function(i){var e=i||{},t=e.includedAttributes,a=void 0===t?[]:t,n=e.excludedAttributes,s=void 0===n?["query"]:n,r=e.transformItems,o=void 0===r?function(e){return e}:r;if(i&&i.includedAttributes&&i.excludedAttributes)throw new Error(pn("The options `includedAttributes` and `excludedAttributes` cannot be used together."));function c(){return l.refine()}function u(){return l.createURL()}var l={refine:xe,createURL:function(){return""},attributesToClear:[]};return{$$type:"ais.clearRefinements",init:function(e){var t=e.instantSearchInstance;d(W(W({},this.getWidgetRenderState(e)),{},{instantSearchInstance:t}),!0)},render:function(e){var t=e.instantSearchInstance;d(W(W({},this.getWidgetRenderState(e)),{},{instantSearchInstance:t}),!1)},dispose:function(){h()},getRenderState:function(e,t){return W(W({},e),{},{clearRefinements:this.getWidgetRenderState(t)})},getWidgetRenderState:function(e){var t=e.createURL,n=e.scopedResults;l.attributesToClear=n.reduce(function(e,t){return e.concat(function(e){var t=e.scopedResult,n=e.includedAttributes,r=e.excludedAttributes,i=e.transformItems,a=-1!==n.indexOf("query")||-1===r.indexOf("query");return{helper:t.helper,items:i(he(we(t.results,t.helper.state,a).map(function(e){return e.attribute}).filter(function(e){return 0===n.length||-1!==n.indexOf(e)}).filter(function(e){return"query"===e&&a||-1===r.indexOf(e)})))}}({scopedResult:t,includedAttributes:a,excludedAttributes:s,transformItems:o}))},[]),l.refine=function(){l.attributesToClear.forEach(function(e){var t=e.helper,n=e.items;t.setState(_e({helper:t,attributesToClear:n})).search()})},l.createURL=function(){return t(Xe.apply(void 0,P(l.attributesToClear.map(function(e){return _e({helper:e.helper,attributesToClear:e.items})}))))};var r=l.attributesToClear.some(function(e){return 0<e.items.length});return{canRefine:r,hasRefinements:r,refine:c,createURL:u,widgetParams:i}}}}}var mn=function(){L(R,e);var b=O(R);function R(e){var n;C(this,R),k(j(n=b.call(this)),"client",void 0),k(j(n),"indexName",void 0),k(j(n),"insightsClient",void 0),k(j(n),"onStateChange",null),k(j(n),"helper",void 0),k(j(n),"mainHelper",void 0),k(j(n),"mainIndex",void 0),k(j(n),"started",void 0),k(j(n),"templatesConfig",void 0),k(j(n),"renderState",{}),k(j(n),"_stalledSearchDelay",void 0),k(j(n),"_searchStalledTimer",void 0),k(j(n),"_isSearchStalled",void 0),k(j(n),"_initialUiState",void 0),k(j(n),"_initialResults",void 0),k(j(n),"_createURL",void 0),k(j(n),"_searchFunction",void 0),k(j(n),"_mainHelperSearch",void 0),k(j(n),"middleware",[]),k(j(n),"sendEventToInsights",void 0),k(j(n),"scheduleSearch",ce(function(){n.started&&n.mainHelper.search()})),k(j(n),"scheduleRender",ce(function(){n.mainHelper.hasPendingRequests()||(clearTimeout(n._searchStalledTimer),n._searchStalledTimer=null,n._isSearchStalled=!1),n.mainIndex.render({instantSearchInstance:j(n)}),n.emit("render")})),k(j(n),"onInternalStateChange",ce(function(){var t=n.mainIndex.getWidgetUiState({});n.middleware.forEach(function(e){e.instance.onStateChange({uiState:t})})}));var t=e.indexName,r=void 0===t?null:t,i=e.numberLocale,a=e.initialUiState,s=void 0===a?{}:a,o=e.routing,c=void 0===o?null:o,u=e.searchFunction,l=e.stalledSearchDelay,d=void 0===l?200:l,h=e.searchClient,f=void 0===h?null:h,m=e.insightsClient,p=void 0===m?null:m,g=e.onStateChange,v=void 0===g?null:g;if(null===r)throw new Error(dn("The `indexName` option is required."));if(null===f)throw new Error(dn("The `searchClient` option is required."));if("function"!=typeof f.search)throw new Error("The `searchClient` must implement a `search` method.\n\nSee: https://www.algolia.com/doc/guides/building-search-ui/going-further/backend-search/in-depth/backend-instantsearch/js/");if("function"==typeof f.addAlgoliaAgent&&f.addAlgoliaAgent("instantsearch.js (".concat("4.37.2",")")),p&&"function"!=typeof p)throw new Error(dn("The `insightsClient` option should be a function."));if(n.client=f,n.insightsClient=p,n.indexName=r,n.helper=null,n.mainHelper=null,n.mainIndex=bt({indexName:r}),n.onStateChange=v,n.started=!1,n.templatesConfig={helpers:function(e){var n=e.numberLocale;return{formatNumber:function(e,t){return Number(t(e)).toLocaleString(n)},highlight:function(e,t){try{return t(_t(W(W({},JSON.parse(e)),{},{hit:this})))}catch(e){throw new Error('\nThe highlight helper expects a JSON object of the format:\n{ "attribute": "name", "highlightedTagName": "mark" }')}},reverseHighlight:function(e,t){try{return t(Nt(W(W({},JSON.parse(e)),{},{hit:this})))}catch(e){throw new Error('\n  The reverseHighlight helper expects a JSON object of the format:\n  { "attribute": "name", "highlightedTagName": "mark" }')}},snippet:function(e,t){try{return t(It(W(W({},JSON.parse(e)),{},{hit:this})))}catch(e){throw new Error('\nThe snippet helper expects a JSON object of the format:\n{ "attribute": "name", "highlightedTagName": "mark" }')}},reverseSnippet:function(e,t){try{return t(Tt(W(W({},JSON.parse(e)),{},{hit:this})))}catch(e){throw new Error('\n  The reverseSnippet helper expects a JSON object of the format:\n  { "attribute": "name", "highlightedTagName": "mark" }')}},insights:function(e,t){try{var n=JSON.parse(e),r=n.method,i=n.payload;return t(Ct(r,W({objectIDs:[this.objectID]},i)))}catch(e){throw new Error('\nThe insights helper expects a JSON object of the format:\n{ "method": "method-name", "payload": { "eventName": "name of the event" } }')}}}}({numberLocale:i}),compileOptions:{}},n._stalledSearchDelay=d,n._searchStalledTimer=null,n._isSearchStalled=!1,n._createURL=hn,n._initialUiState=s,n._initialResults=null,u&&(n._searchFunction=u),n.sendEventToInsights=xe,c){var y="boolean"==typeof c?void 0:c;n.use(cn(y))}return un()&&n.use(ln()),n}return E(R,[{key:"use",value:function(){for(var n=this,e=arguments.length,t=new Array(e),r=0;r<e;r++)t[r]=arguments[r];var i=t.map(function(e){var t=W({subscribe:xe,unsubscribe:xe,onStateChange:xe},e({instantSearchInstance:n}));return n.middleware.push({creator:e,instance:t}),t});return this.started&&i.forEach(function(e){e.subscribe()}),this}},{key:"unuse",value:function(){for(var e=arguments.length,t=new Array(e),n=0;n<e;n++)t[n]=arguments[n];return this.middleware.filter(function(e){return t.includes(e.creator)}).forEach(function(e){return e.instance.unsubscribe()}),this.middleware=this.middleware.filter(function(e){return!t.includes(e.creator)}),this}},{key:"EXPERIMENTAL_use",value:function(){return this.use.apply(this,arguments)}},{key:"addWidget",value:function(e){return this.addWidgets([e])}},{key:"addWidgets",value:function(e){if(!Array.isArray(e))throw new Error(dn("The `addWidgets` method expects an array of widgets. Please use `addWidget`."));if(e.some(function(e){return"function"!=typeof e.init&&"function"!=typeof e.render}))throw new Error(dn("The widget definition expects a `render` and/or an `init` method."));return this.mainIndex.addWidgets(e),this}},{key:"removeWidget",value:function(e){return this.removeWidgets([e])}},{key:"removeWidgets",value:function(e){if(!Array.isArray(e))throw new Error(dn("The `removeWidgets` method expects an array of widgets. Please use `removeWidget`."));if(e.some(function(e){return"function"!=typeof e.dispose}))throw new Error(dn("The widget definition expects a `dispose` method."));return this.mainIndex.removeWidgets(e),this}},{key:"start",value:function(){var r=this;if(this.started)throw new Error(dn("The `start` method has already been called once."));var t=this.mainHelper||oe(this.client,this.indexName);if(t.search=function(){return t.searchOnlyWithDerivedHelpers()},this._searchFunction){var i={search:function(){return new Promise(xe)}};this._mainHelperSearch=t.search.bind(t),t.search=function(){var n=r.mainIndex.getHelper(),e=oe(i,n.state.index,n.state);return e.once("search",function(e){var t=e.state;n.overrideStateWithoutTriggeringChangeEvent(t),r._mainHelperSearch()}),e.on("change",function(e){var t=e.state;n.setState(t)}),r._searchFunction(e),t}}if(t.on("error",function(e){var t=e.error;t.error=t,r.emit("error",t)}),this.mainHelper=t,this.middleware.forEach(function(e){e.instance.subscribe()}),this.mainIndex.init({instantSearchInstance:this,parent:null,uiState:this._initialUiState}),this._initialResults){var e=this.scheduleSearch;this.scheduleSearch=ce(xe),ce(function(){r.scheduleSearch=e})()}else this.scheduleSearch();this.helper=this.mainIndex.getHelper(),this.started=!0}},{key:"dispose",value:function(){this.scheduleSearch.cancel(),this.scheduleRender.cancel(),clearTimeout(this._searchStalledTimer),this.removeWidgets(this.mainIndex.getWidgets()),this.mainIndex.dispose(),this.started=!1,this.removeAllListeners(),this.mainHelper.removeAllListeners(),this.mainHelper=null,this.helper=null,this.middleware.forEach(function(e){e.instance.unsubscribe()})}},{key:"scheduleStalledRender",value:function(){var e=this;this._searchStalledTimer||(this._searchStalledTimer=setTimeout(function(){e._isSearchStalled=!0,e.scheduleRender()},this._stalledSearchDelay))}},{key:"setUiState",value:function(e){if(!this.mainHelper)throw new Error(dn("The `start` method needs to be called before `setUiState`."));this.mainIndex.refreshUiState();var r="function"==typeof e?e(this.mainIndex.getWidgetUiState({})):e;!function e(t){var n=r[t.getIndexId()]||{};t.getHelper().setState(t.getWidgetSearchParameters(t.getHelper().state,{uiState:n})),t.getWidgets().filter(pt).forEach(e)}(this.mainIndex),this.scheduleSearch(),this.onInternalStateChange()}},{key:"getUiState",value:function(){return this.started&&this.mainIndex.refreshUiState(),this.mainIndex.getWidgetUiState({})}},{key:"createURL",value:function(e){var t=0<arguments.length&&void 0!==e?e:{};if(!this.started)throw new Error(dn("The `start` method needs to be called before `createURL`."));return this._createURL(t)}},{key:"refresh",value:function(){if(!this.mainHelper)throw new Error(dn("The `start` method needs to be called before `refresh`."));this.mainHelper.clearCache().search()}}]),R}(),pn=Ze({name:"clear-refinements",connector:!0});function gn(r,e){var i=1<arguments.length&&void 0!==e?e:xe;return Ne(r,vn()),function(s){if((s||{}).includedAttributes&&(s||{}).excludedAttributes)throw new Error(vn("The options `includedAttributes` and `excludedAttributes` cannot be used together."));var e=s||{},o=e.includedAttributes,t=e.excludedAttributes,c=void 0===t?["query"]:t,n=e.transformItems,u=void 0===n?function(e){return e}:n;return{$$type:"ais.currentRefinements",init:function(e){var t=e.instantSearchInstance;r(W(W({},this.getWidgetRenderState(e)),{},{instantSearchInstance:t}),!0)},render:function(e){var t=e.instantSearchInstance;r(W(W({},this.getWidgetRenderState(e)),{},{instantSearchInstance:t}),!1)},dispose:function(){i()},getRenderState:function(e,t){return W(W({},e),{},{currentRefinements:this.getWidgetRenderState(t)})},getWidgetRenderState:function(e){var t=e.results,n=e.scopedResults,r=e.createURL,i=e.helper;var a=t?n.reduce(function(e,t){return e.concat(u(yn({results:t.results,helper:t.helper,includedAttributes:o,excludedAttributes:c})))},[]):u(yn({results:{},helper:i,includedAttributes:o,excludedAttributes:c}));return{items:a,canRefine:0<a.length,refine:function(e){return Rn(i,e)},createURL:function(e){return r(bn(i.state,e))},widgetParams:s}}}}}var vn=Ze({name:"current-refinements",connector:!0});function yn(e){var t=e.results,n=e.helper,r=e.includedAttributes,i=e.excludedAttributes,a=-1!==(r||[]).indexOf("query")||-1===(i||[]).indexOf("query"),s=r?function(e){return-1!==r.indexOf(e.attribute)}:function(e){return-1===i.indexOf(e.attribute)},o=we(t,n.state,a).map(Sn).filter(s);return o.reduce(function(e,t){return[].concat(P(e.filter(function(e){return e.attribute!==t.attribute})),[{indexName:n.state.index,attribute:t.attribute,label:t.attribute,refinements:o.filter(function(e){return e.attribute===t.attribute}).sort(function(e,t){return"numeric"===e.type?e.value-t.value:0}),refine:function(e){return Rn(n,e)}}])},[])}function bn(e,t){switch(t.type){case"facet":return e.removeFacetRefinement(t.attribute,String(t.value));case"disjunctive":return e.removeDisjunctiveFacetRefinement(t.attribute,String(t.value));case"hierarchical":return e.removeHierarchicalFacetRefinement(t.attribute);case"exclude":return e.removeExcludeRefinement(t.attribute,String(t.value));case"numeric":return e.removeNumericRefinement(t.attribute,t.operator,String(t.value));case"tag":return e.removeTagRefinement(String(t.value));case"query":return e.setQueryParameter("query","");default:return e}}function Rn(e,t){e.setState(bn(e.state,t)).search()}function Sn(e){var t="numeric"===e.type?Number(e.name):e.name,n=e.operator?"".concat(function(e){switch(e){case">=":return"≥";case"<=":return"≤";default:return e}}(e.operator)," ").concat(e.name):e.name,r={attribute:e.attribute,type:e.type,value:t,label:n};return void 0!==e.operator&&(r.operator=e.operator),void 0!==e.count&&(r.count=e.count),void 0!==e.exhaustive&&(r.exhaustive=e.exhaustive),r}function wn(x,e){var I=1<arguments.length&&void 0!==e?e:xe;return Ne(x,Nn()),function(d){var e=d||{},c=e.attributes,t=e.separator,u=void 0===t?" > ":t,n=e.rootPath,l=void 0===n?null:n,r=e.showParentLevel,h=void 0===r||r,i=e.limit,f=void 0===i?10:i,a=e.showMore,m=void 0!==a&&a,s=e.showMoreLimit,p=void 0===s?20:s,o=e.sortBy,g=void 0===o?xn:o,v=e.transformItems,y=void 0===v?function(e){return e}:v;if(!c||!Array.isArray(c)||0===c.length)throw new Error(Nn("The `attributes` option expects an array of strings."));if(!0===m&&p<=f)throw new Error(Nn("The `showMoreLimit` option must be greater than `limit`."));var b,R,S=D(c,1)[0],w=function(){};function _(){w()}var P=!1;function N(){return P?p:f}return{$$type:"ais.hierarchicalMenu",init:function(e){var t=e.instantSearchInstance;x(W(W({},this.getWidgetRenderState(e)),{},{instantSearchInstance:t}),!0)},render:function(e){var t=e.instantSearchInstance;w=function(e,t){return function(){P=!P,t.render(e)}}(e,this),x(W(W({},this.getWidgetRenderState(e)),{},{instantSearchInstance:t}),!1)},dispose:function(e){var t=e.state;return I(),t.removeHierarchicalFacet(S).setQueryParameter("maxValuesPerFacet",void 0)},getRenderState:function(e,t){return W(W({},e),{},{hierarchicalMenu:W(W({},e.hierarchicalMenu),{},k({},S,this.getWidgetRenderState(t)))})},getWidgetRenderState:function(e){var t=e.results,n=e.state,r=e.createURL,i=e.instantSearchInstance,a=e.helper,s=[],o=!1;if(b=b||it({instantSearchInstance:i,helper:a,attribute:S,widgetType:this.$$type}),R=R||function(e){b("click",e),a.toggleFacetRefinement(S,e).search()},t){var c=t.getFacetValues(S,{sortBy:g,facetOrdering:g===xn}),u=c&&!Array.isArray(c)&&c.data?c.data:[],l=(n.maxValuesPerFacet||0)>N()?u.length<=N():u.length<N();o=m&&(P||!l),s=y(function a(e){return e.slice(0,N()).map(function(e){var t=e.name,n=e.path,r=e.data,i=W(W({},M(e,["name","path","data"])),{},{label:t,value:n,data:null});return Array.isArray(r)&&(i.data=a(r)),i})}(u))}return{items:s,refine:R,canRefine:0<s.length,createURL:function(e){return r(n.resetPage().toggleFacetRefinement(S,e))},sendEvent:b,widgetParams:d,isShowingMore:P,toggleShowMore:_,canToggleShowMore:o}},getWidgetUiState:function(e,t){var n=t.searchParameters.getHierarchicalFacetBreadcrumb(S);return n.length?W(W({},e),{},{hierarchicalMenu:W(W({},e.hierarchicalMenu),{},k({},S,n))}):e},getWidgetSearchParameters:function(e,t){var n=t.uiState,r=n.hierarchicalMenu&&n.hierarchicalMenu[S];if(e.isHierarchicalFacet(S))e.getHierarchicalFacetByName(S);var i=e.removeHierarchicalFacet(S).addHierarchicalFacet({name:S,attributes:c,separator:u,rootPath:l,showParentLevel:h}),a=i.maxValuesPerFacet||0,s=Math.max(a,m?p:f),o=i.setQueryParameter("maxValuesPerFacet",s);return r?o.addHierarchicalFacetRefinement(S,r.join(u)):o.setQueryParameters({hierarchicalFacetsRefinements:W(W({},o.hierarchicalFacetsRefinements),{},k({},S,[]))})}}}}function _n(r,e){var i=1<arguments.length&&void 0!==e?e:xe;return Ne(r,In()),function(a){var s,o,e=a||{},t=e.escapeHTML,c=void 0===t||t,n=e.transformItems,u=void 0===n?function(e){return e}:n;return{$$type:"ais.hits",init:function(e){r(W(W({},this.getWidgetRenderState(e)),{},{instantSearchInstance:e.instantSearchInstance}),!0)},render:function(e){var t=this.getWidgetRenderState(e);t.sendEvent("view",t.hits),r(W(W({},t),{},{instantSearchInstance:e.instantSearchInstance}),!1)},getRenderState:function(e,t){return W(W({},e),{},{hits:this.getWidgetRenderState(t)})},getWidgetRenderState:function(e){var t=e.results,n=e.helper,r=e.instantSearchInstance;if(s=s||ct({instantSearchInstance:r,index:n.getIndex(),widgetType:this.$$type}),o=o||ut({index:n.getIndex(),widgetType:this.$$type}),!t)return{hits:[],results:void 0,sendEvent:s,bindEvent:o,widgetParams:a};c&&0<t.hits.length&&(t.hits=Qe(t.hits));var i=rt(nt(t.hits,t.page,t.hitsPerPage),t.queryID);return{hits:u(i),results:t,sendEvent:s,bindEvent:o,widgetParams:a}},dispose:function(e){var t=e.state;return i(),c?t.setQueryParameters(Object.keys(De).reduce(function(e,t){return W(W({},e),{},k({},t,void 0))},{})):t},getWidgetSearchParameters:function(e){return c?e.setQueryParameters(De):e}}}}function Pn(e){var t=e.method,n=e.results,r=e.hits,i=e.objectIDs,a=n.index,s=function(n,e){return e.map(function(t){var e=be(n,function(e){return e.objectID===t});if(void 0===e)throw new Error('Could not find objectID "'.concat(t,'" passed to `clickedObjectIDsAfterSearch` in the returned hits. This is necessary to infer the absolute position and the query ID.'));return e})}(r,i),o=function(e){var t=he(e.map(function(e){return e.__queryID}));if(1<t.length)throw new Error("Insights currently allows a single `queryID`. The `objectIDs` provided map to multiple `queryID`s.");var n=t[0];if("string"!=typeof n)throw new Error("Could not infer `queryID`. Ensure InstantSearch `clickAnalytics: true` was added with the Configure widget.\n\nSee: https://alg.li/lNiZZ7");return n}(s);switch(t){case"clickedObjectIDsAfterSearch":return{index:a,queryID:o,objectIDs:i,positions:function(e){return e.map(function(e){return e.__position})}(s)};case"convertedObjectIDsAfterSearch":return{index:a,queryID:o,objectIDs:i};default:throw new Error('Unsupported method passed to insights: "'.concat(t,'".'))}}var Nn=Ze({name:"hierarchical-menu",connector:!0}),xn=["name:asc"],In=Ze({name:"hits",connector:!0});function Fn(t){return function(s,e){return t(function(e,t){var n=e.results,r=e.hits,i=e.instantSearchInstance;if(n&&r&&i){var a=function(o,c,u){return function(e){for(var t=arguments.length,n=new Array(1<t?t-1:0),r=1;r<t;r++)n[r-1]=arguments[r];var i=n[0];if(!o){var a=Ze({name:"instantsearch"});throw new Error(a("The `insightsClient` option has not been provided to `instantsearch`."))}if(!Array.isArray(i.objectIDs))throw new TypeError("Expected `objectIDs` to be an array.");var s=Pn({method:e,results:c,hits:u,objectIDs:i.objectIDs});o(e,W(W({},s),i))}}(i.insightsClient,n,r);return s(W(W({},e),{},{insights:a}),t)}return s(e,t)},e)}}var Tn,Cn,En,kn,Ln,Mn,jn={},On=[],An=/acit|ex(?:s|g|n|p|$)|rph|grid|ows|mnc|ntw|ine[ch]|zoo|^ord|itera/i;function Hn(e,t){for(var n in t)e[n]=t[n];return e}function Wn(e){var t=e.parentNode;t&&t.removeChild(e)}function Dn(e,t,n){var r,i,a,s={};for(a in t)"key"==a?r=t[a]:"ref"==a?i=t[a]:s[a]=t[a];if(2<arguments.length&&(s.children=3<arguments.length?Tn.call(arguments,2):n),"function"==typeof e&&null!=e.defaultProps)for(a in e.defaultProps)void 0===s[a]&&(s[a]=e.defaultProps[a]);return Bn(e,s,r,i,null)}function Bn(e,t,n,r,i){var a={type:e,props:t,key:n,ref:r,__k:null,__:null,__b:0,__e:null,__d:void 0,__c:null,__h:null,constructor:void 0,__v:null==i?++En:i};return null==i&&null!=Cn.vnode&&Cn.vnode(a),a}function Un(e){return e.children}function qn(e,t){this.props=e,this.context=t}function Qn(e,t){if(null==t)return e.__?Qn(e.__,e.__.__k.indexOf(e)+1):null;for(var n;t<e.__k.length;t++)if(null!=(n=e.__k[t])&&null!=n.__e)return n.__e;return"function"==typeof e.type?Qn(e):null}function $n(e){var t,n;if(null!=(e=e.__)&&null!=e.__c){for(e.__e=e.__c.base=null,t=0;t<e.__k.length;t++)if(null!=(n=e.__k[t])&&null!=n.__e){e.__e=e.__c.base=n.__e;break}return $n(e)}}function Vn(e){(!e.__d&&(e.__d=!0)&&kn.push(e)&&!Kn.__r++||Mn!==Cn.debounceRendering)&&((Mn=Cn.debounceRendering)||Ln)(Kn)}function Kn(){for(var e;Kn.__r=kn.length;)e=kn.sort(function(e,t){return e.__v.__b-t.__v.__b}),kn=[],e.some(function(e){var t,n,r,i,a,s;e.__d&&(a=(i=(t=e).__v).__e,(s=t.__P)&&(n=[],(r=Hn({},i)).__v=i.__v+1,tr(s,i,r,t.__n,void 0!==s.ownerSVGElement,null!=i.__h?[a]:null,n,null==a?Qn(i):a,i.__h),nr(n,i),i.__e!=a&&$n(i)))})}function zn(e,t,n,r,i,a,s,o,c,u){var l,d,h,f,m,p,g,v=r&&r.__k||On,y=v.length;for(n.__k=[],l=0;l<t.length;l++)if(null!=(f=n.__k[l]=null==(f=t[l])||"boolean"==typeof f?null:"string"==typeof f||"number"==typeof f||"bigint"==typeof f?Bn(null,f,null,null,f):Array.isArray(f)?Bn(Un,{children:f},null,null,null):0<f.__b?Bn(f.type,f.props,f.key,null,f.__v):f)){if(f.__=n,f.__b=n.__b+1,null===(h=v[l])||h&&f.key==h.key&&f.type===h.type)v[l]=void 0;else for(d=0;d<y;d++){if((h=v[d])&&f.key==h.key&&f.type===h.type){v[d]=void 0;break}h=null}tr(e,f,h=h||jn,i,a,s,o,c,u),m=f.__e,(d=f.ref)&&h.ref!=d&&(g=g||[],h.ref&&g.push(h.ref,null,f),g.push(d,f.__c||m,f)),null!=m?(null==p&&(p=m),"function"==typeof f.type&&f.__k===h.__k?f.__d=c=Jn(f,c,e):c=Yn(e,f,h,v,m,c),"function"==typeof n.type&&(n.__d=c)):c&&h.__e==c&&c.parentNode!=e&&(c=Qn(h))}for(n.__e=p,l=y;l--;)null!=v[l]&&("function"==typeof n.type&&null!=v[l].__e&&v[l].__e==n.__d&&(n.__d=Qn(r,l+1)),ir(v[l],v[l]));if(g)for(l=0;l<g.length;l++)rr(g[l],g[++l],g[++l])}function Jn(e,t,n){for(var r,i=e.__k,a=0;i&&a<i.length;a++)(r=i[a])&&(r.__=e,t="function"==typeof r.type?Jn(r,t,n):Yn(n,r,r,i,r.__e,t));return t}function Yn(e,t,n,r,i,a){var s,o,c;if(void 0!==t.__d)s=t.__d,t.__d=void 0;else if(null==n||i!=a||null==i.parentNode)e:if(null==a||a.parentNode!==e)e.appendChild(i),s=null;else{for(o=a,c=0;(o=o.nextSibling)&&c<r.length;c+=2)if(o==i)break e;e.insertBefore(i,a),s=a}return void 0!==s?s:i.nextSibling}function Xn(e,t,n){"-"===t[0]?e.setProperty(t,n):e[t]=null==n?"":"number"!=typeof n||An.test(t)?n:n+"px"}function Gn(e,t,n,r,i){var a;e:if("style"===t)if("string"==typeof n)e.style.cssText=n;else{if("string"==typeof r&&(e.style.cssText=r=""),r)for(t in r)n&&t in n||Xn(e.style,t,"");if(n)for(t in n)r&&n[t]===r[t]||Xn(e.style,t,n[t])}else if("o"===t[0]&&"n"===t[1])a=t!==(t=t.replace(/Capture$/,"")),t=t.toLowerCase()in e?t.toLowerCase().slice(2):t.slice(2),e.l||(e.l={}),e.l[t+a]=n,n?r||e.addEventListener(t,a?er:Zn,a):e.removeEventListener(t,a?er:Zn,a);else if("dangerouslySetInnerHTML"!==t){if(i)t=t.replace(/xlink[H:h]/,"h").replace(/sName$/,"s");else if("href"!==t&&"list"!==t&&"form"!==t&&"tabIndex"!==t&&"download"!==t&&t in e)try{e[t]=null==n?"":n;break e}catch(e){}"function"==typeof n||(null!=n&&(!1!==n||"a"===t[0]&&"r"===t[1])?e.setAttribute(t,n):e.removeAttribute(t))}}function Zn(e){this.l[e.type+!1](Cn.event?Cn.event(e):e)}function er(e){this.l[e.type+!0](Cn.event?Cn.event(e):e)}function tr(e,t,n,r,i,a,s,o,c){var u,l,d,h,f,m,p,g,v,y,b,R=t.type;if(void 0!==t.constructor)return null;null!=n.__h&&(c=n.__h,o=t.__e=n.__e,t.__h=null,a=[o]),(u=Cn.__b)&&u(t);try{e:if("function"==typeof R){if(g=t.props,v=(u=R.contextType)&&r[u.__c],y=u?v?v.props.value:u.__:r,n.__c?p=(l=t.__c=n.__c).__=l.__E:("prototype"in R&&R.prototype.render?t.__c=l=new R(g,y):(t.__c=l=new qn(g,y),l.constructor=R,l.render=ar),v&&v.sub(l),l.props=g,l.state||(l.state={}),l.context=y,l.__n=r,d=l.__d=!0,l.__h=[]),null==l.__s&&(l.__s=l.state),null!=R.getDerivedStateFromProps&&(l.__s==l.state&&(l.__s=Hn({},l.__s)),Hn(l.__s,R.getDerivedStateFromProps(g,l.__s))),h=l.props,f=l.state,d)null==R.getDerivedStateFromProps&&null!=l.componentWillMount&&l.componentWillMount(),null!=l.componentDidMount&&l.__h.push(l.componentDidMount);else{if(null==R.getDerivedStateFromProps&&g!==h&&null!=l.componentWillReceiveProps&&l.componentWillReceiveProps(g,y),!l.__e&&null!=l.shouldComponentUpdate&&!1===l.shouldComponentUpdate(g,l.__s,y)||t.__v===n.__v){l.props=g,l.state=l.__s,t.__v!==n.__v&&(l.__d=!1),(l.__v=t).__e=n.__e,t.__k=n.__k,t.__k.forEach(function(e){e&&(e.__=t)}),l.__h.length&&s.push(l);break e}null!=l.componentWillUpdate&&l.componentWillUpdate(g,l.__s,y),null!=l.componentDidUpdate&&l.__h.push(function(){l.componentDidUpdate(h,f,m)})}l.context=y,l.props=g,l.state=l.__s,(u=Cn.__r)&&u(t),l.__d=!1,l.__v=t,l.__P=e,u=l.render(l.props,l.state,l.context),l.state=l.__s,null!=l.getChildContext&&(r=Hn(Hn({},r),l.getChildContext())),d||null==l.getSnapshotBeforeUpdate||(m=l.getSnapshotBeforeUpdate(h,f)),b=null!=u&&u.type===Un&&null==u.key?u.props.children:u,zn(e,Array.isArray(b)?b:[b],t,n,r,i,a,s,o,c),l.base=t.__e,t.__h=null,l.__h.length&&s.push(l),p&&(l.__E=l.__=null),l.__e=!1}else null==a&&t.__v===n.__v?(t.__k=n.__k,t.__e=n.__e):t.__e=function(e,t,n,r,i,a,s,o){var c,u,l,d=n.props,h=t.props,f=t.type,m=0;if("svg"===f&&(i=!0),null!=a)for(;m<a.length;m++)if((c=a[m])&&"setAttribute"in c==!!f&&(f?c.localName===f:3===c.nodeType)){e=c,a[m]=null;break}if(null==e){if(null===f)return document.createTextNode(h);e=i?document.createElementNS("http://www.w3.org/2000/svg",f):document.createElement(f,h.is&&h),a=null,o=!1}if(null===f)d===h||o&&e.data===h||(e.data=h);else{if(a=a&&Tn.call(e.childNodes),u=(d=n.props||jn).dangerouslySetInnerHTML,l=h.dangerouslySetInnerHTML,!o){if(null!=a)for(d={},m=0;m<e.attributes.length;m++)d[e.attributes[m].name]=e.attributes[m].value;(l||u)&&(l&&(u&&l.__html==u.__html||l.__html===e.innerHTML)||(e.innerHTML=l&&l.__html||""))}if(function(e,t,n,r,i){var a;for(a in n)"children"===a||"key"===a||a in t||Gn(e,a,null,n[a],r);for(a in t)i&&"function"!=typeof t[a]||"children"===a||"key"===a||"value"===a||"checked"===a||n[a]===t[a]||Gn(e,a,t[a],n[a],r)}(e,h,d,i,o),l)t.__k=[];else if(m=t.props.children,zn(e,Array.isArray(m)?m:[m],t,n,r,i&&"foreignObject"!==f,a,s,a?a[0]:n.__k&&Qn(n,0),o),null!=a)for(m=a.length;m--;)null!=a[m]&&Wn(a[m]);o||("value"in h&&void 0!==(m=h.value)&&(m!==d.value||m!==e.value||"progress"===f&&!m)&&Gn(e,"value",m,d.value,!1),"checked"in h&&void 0!==(m=h.checked)&&m!==e.checked&&Gn(e,"checked",m,d.checked,!1))}return e}(n.__e,t,n,r,i,a,s,c);(u=Cn.diffed)&&u(t)}catch(e){t.__v=null,!c&&null==a||(t.__e=o,t.__h=!!c,a[a.indexOf(o)]=null),Cn.__e(e,t,n)}}function nr(e,t){Cn.__c&&Cn.__c(t,e),e.some(function(t){try{e=t.__h,t.__h=[],e.some(function(e){e.call(t)})}catch(e){Cn.__e(e,t.__v)}})}function rr(e,t,n){try{"function"==typeof e?e(t):e.current=t}catch(e){Cn.__e(e,n)}}function ir(e,t,n){var r,i;if(Cn.unmount&&Cn.unmount(e),(r=e.ref)&&(r.current&&r.current!==e.__e||rr(r,null,t)),null!=(r=e.__c)){if(r.componentWillUnmount)try{r.componentWillUnmount()}catch(e){Cn.__e(e,t)}r.base=r.__P=null}if(r=e.__k)for(i=0;i<r.length;i++)r[i]&&ir(r[i],t,"function"!=typeof e.type);n||null==e.__e||Wn(e.__e),e.__e=e.__d=void 0}function ar(e,t,n){return this.constructor(e,n)}function sr(e,t,n){var r,i,a;Cn.__&&Cn.__(e,t),i=(r="function"==typeof n)?null:n&&n.__k||t.__k,a=[],tr(t,e=(!r&&n||t).__k=Dn(Un,null,[e]),i||jn,jn,void 0!==t.ownerSVGElement,!r&&n?[n]:i?null:t.firstChild?Tn.call(t.childNodes):null,a,!r&&n?n:i?i.__e:t.firstChild,r),nr(a,e)}Tn=On.slice,Cn={__e:function(e,t){for(var n,r,i;t=t.__;)if((n=t.__c)&&!n.__)try{if((r=n.constructor)&&null!=r.getDerivedStateFromError&&(n.setState(r.getDerivedStateFromError(e)),i=n.__d),null!=n.componentDidCatch&&(n.componentDidCatch(e),i=n.__d),i)return n.__E=n}catch(t){e=t}throw e}},En=0,qn.prototype.setState=function(e,t){var n;n=null!=this.__s&&this.__s!==this.state?this.__s:this.__s=Hn({},this.state),"function"==typeof e&&(e=e(Hn({},n),this.props)),e&&Hn(n,e),null!=e&&this.__v&&(t&&this.__h.push(t),Vn(this))},qn.prototype.forceUpdate=function(e){this.__v&&(this.__e=!0,e&&this.__h.push(e),Vn(this))},qn.prototype.render=Un,kn=[],Ln="function"==typeof Promise?Promise.prototype.then.bind(Promise.resolve()):setTimeout,Kn.__r=0;function or(e,t,n){for(var r=e;r&&!n(r);){if(r===t)return null;r=r.parentElement}return r}function cr(e){return function(s){return Dn("div",{onClick:function(e){if(s.sendEvent){var t=or(e.target,e.currentTarget,function(e){return e.hasAttribute("data-insights-event")});if(t)(function(e){var t=e.getAttribute("data-insights-event");if("string"!=typeof t)throw new Error("The insights middleware expects `data-insights-event` to be a base64-encoded JSON string.");try{return st(t)}catch(e){throw new Error("The insights middleware was unable to parse `data-insights-event`.")}})(t).forEach(function(e){return s.sendEvent(e)})}var n=or(e.target,e.currentTarget,function(e){return function(e){return e.hasAttribute("data-insights-method")}(e)});if(n){var r=function(e){var t=e.getAttribute("data-insights-method"),n=e.getAttribute("data-insights-payload");if("string"!=typeof n)throw new Error("The insights helper expects `data-insights-payload` to be a base64-encoded JSON string.");try{return{method:t,payload:st(n)}}catch(e){throw new Error("The insights helper was unable to parse `data-insights-payload`.")}}(n),i=r.method,a=r.payload;s.insights(i,a)}}},Dn(e,s))}}function ur(l,e){var d=1<arguments.length&&void 0!==e?e:xe;return Ne(l,dr()),function(a){var e=a||{},t=e.items,n=e.transformItems,s=void 0===n?function(e){return e}:n;if(!Array.isArray(t))throw new Error(dr("The `items` option expects an array of objects."));var o=t,r=o.filter(function(e){return!0===e.default});if(0===r.length)throw new Error(dr("A default value must be specified in `items`."));if(1<r.length)throw new Error(dr("More than one default value is specified in `items`."));var i=r[0],c=function(t){return function(e){return e||0===e?t.setQueryParameter("hitsPerPage",e).search():t.setQueryParameter("hitsPerPage",void 0).search()}},u=function(e){var t=e.state,n=e.createURL;return function(e){return n(t.resetPage().setQueryParameter("hitsPerPage",e||0===e?e:void 0))}};return{$$type:"ais.hitsPerPage",init:function(e){var t=e.state,n=e.instantSearchInstance;o.some(function(e){return Number(t.hitsPerPage)===Number(e.value)})||(o=[{value:"",label:""}].concat(P(o))),l(W(W({},this.getWidgetRenderState(e)),{},{instantSearchInstance:n}),!0)},render:function(e){var t=e.instantSearchInstance;l(W(W({},this.getWidgetRenderState(e)),{},{instantSearchInstance:t}),!1)},dispose:function(e){var t=e.state;return d(),t.setQueryParameter("hitsPerPage",void 0)},getRenderState:function(e,t){return W(W({},e),{},{hitsPerPage:this.getWidgetRenderState(t)})},getWidgetRenderState:function(e){var t=e.state,n=e.results,r=e.createURL,i=e.helper;return{items:s(function(e){var t=e.hitsPerPage;return o.map(function(e){return W(W({},e),{},{isRefined:Number(e.value)===Number(t)})})}(t)),refine:c(i),createURL:u({state:t,createURL:r}),hasNoResults:!n||0===n.nbHits,widgetParams:a}},getWidgetUiState:function(e,t){var n=t.searchParameters.hitsPerPage;return void 0===n||n===i.value?e:W(W({},e),{},{hitsPerPage:n})},getWidgetSearchParameters:function(e,t){var n=t.uiState;return e.setQueryParameters({hitsPerPage:n.hitsPerPage||i.value})}}}}var lr=Fn(_n),dr=Ze({name:"hits-per-page",connector:!0}),hr=Ze({name:"infinite-hits",connector:!0});function fr(e){var t=e||{};t.page;return M(t,["page"])}function mr(i,e){var a=1<arguments.length&&void 0!==e?e:xe;return Ne(i,hr()),function(m){function p(e,t){var n=e.page,r=void 0===n?0:n,i=Object.keys(t).map(Number);return 0===i.length?r:Math.min.apply(Math,[r].concat(P(i)))}function g(e,t){var n=e.page,r=void 0===n?0:n,i=Object.keys(t).map(Number);return 0===i.length?r:Math.max.apply(Math,[r].concat(P(i)))}var v,y,b,R,e=m||{},t=e.escapeHTML,S=void 0===t||t,n=e.transformItems,w=void 0===n?function(e){return e}:n,r=e.cache,_=void 0===r?function(){var r=null,i=null;return{read:function(e){var t=e.state;return Le(i,fr(t))?r:null},write:function(e){var t=e.state,n=e.hits;i=fr(t),r=n}}}():r;return{$$type:"ais.infiniteHits",init:function(e){i(W(W({},this.getWidgetRenderState(e)),{},{instantSearchInstance:e.instantSearchInstance}),!0)},render:function(e){var t=e.instantSearchInstance,n=this.getWidgetRenderState(e);b("view",n.currentPageHits),i(W(W({},n),{},{instantSearchInstance:t}),!1)},getRenderState:function(e,t){return W(W({},e),{},{infiniteHits:this.getWidgetRenderState(t)})},getWidgetRenderState:function(e){var t,n=e.results,r=e.helper,i=e.state,a=e.instantSearchInstance,s=[],o=_.read({state:i})||{};if(n){var c=i.page,u=void 0===c?0:c;S&&0<n.hits.length&&(n.hits=Qe(n.hits));var l=rt(nt(n.hits,n.page,n.hitsPerPage),n.queryID),d=w(l);void 0===o[u]&&(o[u]=d,_.write({state:i,hits:o})),s=d,t=0===p(i,o)}else v=function(e){return function(){e.overrideStateWithoutTriggeringChangeEvent(W(W({},e.state),{},{page:p(e.state,_.read({state:e.state})||{})-1})).searchWithoutTriggeringOnStateChange()}}(r),y=function(e){return function(){e.setPage(g(e.state,_.read({state:e.state})||{})+1).search()}}(r),b=ct({instantSearchInstance:a,index:r.getIndex(),widgetType:this.$$type}),R=ut({index:r.getIndex(),widgetType:this.$$type}),t=void 0===i.page||0===p(i,o);var h=function(n){return Object.keys(n).map(Number).sort(function(e,t){return e-t}).reduce(function(e,t){return e.concat(n[t])},[])}(o),f=!n||n.nbPages<=g(i,o)+1;return{hits:h,currentPageHits:s,sendEvent:b,bindEvent:R,results:n,showPrevious:v,showMore:y,isFirstPage:t,isLastPage:f,widgetParams:m}},dispose:function(e){var t=e.state;a();var n=t.setQueryParameter("page",void 0);return S?n.setQueryParameters(Object.keys(De).reduce(function(e,t){return W(W({},e),{},k({},t,void 0))},{})):n},getWidgetUiState:function(e,t){var n=t.searchParameters.page||0;return n?W(W({},e),{},{page:n+1}):e},getWidgetSearchParameters:function(e,t){var n=t.uiState,r=e;S&&(r=e.setQueryParameters(De));var i=n.page?n.page-1:0;return r.setQueryParameter("page",i)}}}}function pr(s,e){var o=1<arguments.length&&void 0!==e?e:xe;return Ne(s,yr()),function(u){var l,d,h,e=u||{},f=e.attribute,t=e.limit,c=void 0===t?10:t,n=e.showMore,m=void 0!==n&&n,r=e.showMoreLimit,p=void 0===r?20:r,i=e.sortBy,g=void 0===i?br:i,a=e.transformItems,v=void 0===a?function(e){return e}:a;if(!f)throw new Error(yr("The `attribute` option is required."));if(!0===m&&p<=c)throw new Error(yr("The `showMoreLimit` option must be greater than `limit`."));var y=!1,b=function(){};function R(){b()}function S(){return y?p:c}return{$$type:"ais.menu",init:function(e){var t=e.instantSearchInstance;s(W(W({},this.getWidgetRenderState(e)),{},{instantSearchInstance:t}),!0)},render:function(e){var t=e.instantSearchInstance;s(W(W({},this.getWidgetRenderState(e)),{},{instantSearchInstance:t}),!1)},dispose:function(e){var t=e.state;return o(),t.removeHierarchicalFacet(f).setQueryParameter("maxValuesPerFacet",void 0)},getRenderState:function(e,t){return W(W({},e),{},{menu:W(W({},e.menu),{},k({},f,this.getWidgetRenderState(t)))})},getWidgetRenderState:function(e){var t=e.results,n=e.createURL,r=e.instantSearchInstance,i=e.helper,a=[],s=!1;if(l=l||it({instantSearchInstance:r,helper:i,attribute:f,widgetType:this.$$type}),d=d||function(e){return n(i.state.resetPage().toggleFacetRefinement(f,e))},h=h||function(e){var t=D(i.getHierarchicalFacetBreadcrumb(f),1)[0];l("click",e||t),i.toggleFacetRefinement(f,e||t).search()},e.results&&(b=function(e,t){return function(){y=!y,t.render(e)}}(e,this)),t){var o=t.getFacetValues(f,{sortBy:g,facetOrdering:g===br}),c=o&&!Array.isArray(o)&&o.data?o.data:[];s=m&&(y||c.length>S()),a=v(c.slice(0,S()).map(function(e){var t=e.name,n=e.path;return W(W({},M(e,["name","path"])),{},{label:t,value:n})}))}return{items:a,createURL:d,refine:h,sendEvent:l,canRefine:0<a.length,widgetParams:u,isShowingMore:y,toggleShowMore:R,canToggleShowMore:s}},getWidgetUiState:function(e,t){var n=D(t.searchParameters.getHierarchicalFacetBreadcrumb(f),1)[0];return n?W(W({},e),{},{menu:W(W({},e.menu),{},k({},f,n))}):e},getWidgetSearchParameters:function(e,t){var n=t.uiState,r=n.menu&&n.menu[f],i=e.removeHierarchicalFacet(f).addHierarchicalFacet({name:f,attributes:[f]}),a=i.maxValuesPerFacet||0,s=Math.max(a,m?p:c),o=i.setQueryParameter("maxValuesPerFacet",s);return r?o.addHierarchicalFacetRefinement(f,r):o.setQueryParameters({hierarchicalFacetsRefinements:W(W({},o.hierarchicalFacetsRefinements),{},k({},f,[]))})}}}}function gr(i,e){var a=1<arguments.length&&void 0!==e?e:xe;return Ne(i,Rr()),function(s){var e=s||{},t=e.attribute,u=void 0===t?"":t,n=e.items,o=void 0===n?[]:n,r=e.transformItems,c=void 0===r?function(e){return e}:r;if(""===u)throw new Error(Rr("The `attribute` option is required."));if(!o||0===o.length)throw new Error(Rr("The `items` option expects an array of objects."));var l={};return{$$type:Sr,init:function(e){var t=e.instantSearchInstance;i(W(W({},this.getWidgetRenderState(e)),{},{instantSearchInstance:t}),!0)},render:function(e){var t=e.instantSearchInstance;i(W(W({},this.getWidgetRenderState(e)),{},{instantSearchInstance:t}),!1)},dispose:function(e){var t=e.state;return a(),t.clearRefinements(u)},getWidgetUiState:function(e,t){var n=t.searchParameters.getNumericRefinements(u),r=n["="]&&n["="][0];if(r||0===r)return W(W({},e),{},{numericMenu:W(W({},e.numericMenu),{},k({},u,"".concat(n["="])))});var i=n[">="]&&n[">="][0]||"",a=n["<="]&&n["<="][0]||"";return""===i&&""===a?e:W(W({},e),{},{numericMenu:W(W({},e.numericMenu),{},k({},u,"".concat(i,":").concat(a)))})},getWidgetSearchParameters:function(e,t){var n=t.uiState,r=n.numericMenu&&n.numericMenu[u],i=e.clearRefinements(u);if(!r)return i.setQueryParameters({numericRefinements:W(W({},i.numericRefinements),{},k({},u,{}))});if(-1===r.indexOf(":"))return i.addNumericRefinement(u,"=",Number(r));var a=D(r.split(":").map(parseFloat),2),s=a[0],o=a[1],c=Te(s)?i.addNumericRefinement(u,">=",s):i;return Te(o)?c.addNumericRefinement(u,"<=",o):c},getRenderState:function(e,t){return W(W({},e),{},{numericMenu:W(W({},e.numericMenu),{},k({},u,this.getWidgetRenderState(t)))})},getWidgetRenderState:function(e){var t=e.results,n=e.state,r=e.instantSearchInstance,i=e.helper,a=e.createURL;return l.refine||(l.refine=function(e){var t=_r(i.state,u,e);l.sendEvent("click",e),i.setState(t).search()}),l.createURL||(l.createURL=function(t){return function(e){return a(_r(t,u,e))}}),l.sendEvent||(l.sendEvent=function(e){var c=e.instantSearchInstance,u=e.helper,l=e.attribute;return function(){for(var e=arguments.length,t=new Array(e),n=0;n<e;n++)t[n]=arguments[n];if(1!==t.length){var r=t[0],i=t[1],a=t[2],s=void 0===a?"Filter Applied":a;if("click"===r){var o=lt(_r(u.state,l,i),l);o&&0<o.length&&c.sendEventToInsights({insightsMethod:"clickedFilters",widgetType:Sr,eventType:r,payload:{eventName:s,index:u.getIndex(),filters:o},attribute:l})}}else c.sendEventToInsights(t[0])}}({instantSearchInstance:r,helper:i,attribute:u})),{createURL:l.createURL(n),items:c(function(i){return o.map(function(e){var t=e.start,n=e.end,r=e.label;return{label:r,value:encodeURI(JSON.stringify({start:t,end:n})),isRefined:wr(i,u,{start:t,end:n,label:r})}})}(n)),hasNoResults:!t||0===t.nbHits,refine:l.refine,sendEvent:l.sendEvent,widgetParams:s}}}}}var vr=Fn(mr),yr=Ze({name:"menu",connector:!0}),br=["isRefined","name:asc"],Rr=Ze({name:"numeric-menu",connector:!0}),Sr="ais.numericMenu";function wr(e,t,n){var r=e.getNumericRefinements(t);return void 0!==n.start&&void 0!==n.end?n.start===n.end?Pr(r,"=",n.start):Pr(r,">=",n.start)&&Pr(r,"<=",n.end):void 0!==n.start?Pr(r,">=",n.start):void 0!==n.end?Pr(r,"<=",n.end):void 0===n.start&&void 0===n.end&&Object.keys(r).every(function(e){return 0===(r[e]||[]).length})}function _r(e,t,n){var r=e,i=JSON.parse(decodeURI(n)),a=r.getNumericRefinements(t);if(void 0===i.start&&void 0===i.end)return r.removeNumericRefinement(t);if(wr(r,t,i)||(r=r.removeNumericRefinement(t)),void 0!==i.start&&void 0!==i.end){if(i.start>i.end)throw new Error("option.start should be > to option.end");if(i.start===i.end)return r=Pr(a,"=",i.start)?r.removeNumericRefinement(t,"=",i.start):r.addNumericRefinement(t,"=",i.start)}return void 0!==i.start&&(Pr(a,">=",i.start)&&(r=r.removeNumericRefinement(t,">=",i.start)),r=r.addNumericRefinement(t,">=",i.start)),void 0!==i.end&&(Pr(a,"<=",i.end)&&(r=r.removeNumericRefinement(t,"<=",i.end)),r=r.addNumericRefinement(t,"<=",i.end)),"number"==typeof r.page&&(r.page=0),r}function Pr(e,t,n){return void 0!==e[t]&&e[t].includes(n)}function Nr(n,e){var r=1<arguments.length&&void 0!==e?e:xe;return Ne(n,Ir()),function(o){var e=o||{},c=e.totalPages,t=e.padding,u=new xr({currentPage:0,total:0,padding:void 0===t?3:t}),l={};return{$$type:"ais.pagination",init:function(e){var t=e.instantSearchInstance;n(W(W({},this.getWidgetRenderState(e)),{},{instantSearchInstance:t}),!0)},render:function(e){var t=e.instantSearchInstance;n(W(W({},this.getWidgetRenderState(e)),{},{instantSearchInstance:t}),!1)},dispose:function(e){var t=e.state;return r(),t.setQueryParameter("page",void 0)},getWidgetUiState:function(e,t){var n=t.searchParameters.page||0;return n?W(W({},e),{},{page:n+1}):e},getWidgetSearchParameters:function(e,t){var n=t.uiState,r=n.page?n.page-1:0;return e.setQueryParameter("page",r)},getWidgetRenderState:function(e){var t=e.results,n=e.helper,r=e.state,i=e.createURL;l.refine||(l.refine=function(e){n.setPage(e),n.search()}),l.createURL||(l.createURL=function(t){return function(e){return i(t.setPage(e))}});var a=r.page||0,s=function(e){var t=e.nbPages;return void 0!==c?Math.min(c,t):t}(t||{nbPages:0});return u.currentPage=a,u.total=s,{createURL:l.createURL(r),refine:l.refine,canRefine:1<s,currentRefinement:a,nbHits:(null==t?void 0:t.nbHits)||0,nbPages:s,pages:t?u.pages():[],isFirstPage:u.isFirstPage(),isLastPage:u.isLastPage(),widgetParams:o}},getRenderState:function(e,t){return W(W({},e),{},{pagination:this.getWidgetRenderState(t)})}}}}var xr=function(){function t(e){C(this,t),k(this,"currentPage",void 0),k(this,"total",void 0),k(this,"padding",void 0),this.currentPage=e.currentPage,this.total=e.total,this.padding=e.padding}return E(t,[{key:"pages",value:function(){var e=this.total,t=this.currentPage,n=this.padding;if(0===e)return[0];var r=this.nbPagesDisplayed(n,e);if(r===e)return Ee({end:e});var i=this.calculatePaddingLeft(t,n,e,r);return Ee({start:t-i,end:t+(r-i)})}},{key:"nbPagesDisplayed",value:function(e,t){return Math.min(2*e+1,t)}},{key:"calculatePaddingLeft",value:function(e,t,n,r){return e<=t?e:n-t<=e?r-(n-e):t}},{key:"isLastPage",value:function(){return this.currentPage===this.total-1||0===this.total}},{key:"isFirstPage",value:function(){return 0===this.currentPage}}]),t}(),Ir=Ze({name:"pagination",connector:!0}),Fr=Ze({name:"range-input",connector:!0},{name:"range-slider",connector:!0}),Tr="ais.range";function Cr(e){var t=e.min,n=e.max,r=e.precision,i=Math.pow(10,r);return{min:t?Math.floor(t*i)/i:t,max:n?Math.ceil(n*i)/i:n}}function Er(r,e){var i=1<arguments.length&&void 0!==e?e:xe;return Ne(r,Fr()),function(o){var e=o||{},t=e.attribute,w=void 0===t?"":t,_=e.min,P=e.max,n=e.precision,N=void 0===n?0:n;if(!w)throw new Error(Fr("The `attribute` option is required."));if(Te(_)&&Te(P)&&P<_)throw new Error(Fr("The `max` option can't be lower than `min`."));function f(e,t,n,r){var i,a,s=e.state,o=t.min,c=t.max,u=D(s.getNumericRefinement(w,">=")||[],1)[0],l=D(s.getNumericRefinement(w,"<=")||[],1)[0],d=void 0===n||""===n,h=void 0===r||""===r,f=Cr({min:d?void 0:parseFloat(n),max:h?void 0:parseFloat(r),precision:N}),m=f.min,p=f.max;i=Te(_)||o!==m?Te(_)&&d?_:m:void 0,a=Te(P)||c!==p?Te(P)&&h?P:p:void 0;var g=void 0===i,v=Te(o)&&o<=i,y=g||Te(i)&&(!Te(o)||v),b=void 0===a,R=Te(a)&&a<=c,S=b||Te(a)&&(!Te(c)||R);return(u!==i||l!==a)&&y&&S?(s=s.removeNumericRefinement(w),Te(i)&&(s=s.addNumericRefinement(w,">=",i)),Te(a)&&(s=s.addNumericRefinement(w,"<=",a)),s.resetPage()):null}function m(e,t,n,r){var i=3<arguments.length&&void 0!==r?r:"Filter Applied",a=lt(e,w);a&&0<a.length&&t.sendEventToInsights({insightsMethod:"clickedFilters",widgetType:Tr,eventType:"click",payload:{eventName:i,index:n.getIndex(),filters:a},attribute:w})}var c={from:function(e){return e.toLocaleString()},to:function(e){return function(e){return Number(Number(e).toFixed(N))}(e).toLocaleString()}};function u(i,a,s){return function(){var e=D(0<arguments.length&&void 0!==arguments[0]?arguments[0]:[void 0,void 0],2),t=e[0],n=e[1],r=f(a,s,t,n);r&&(m(r,i,a),a.setState(r).search())}}return{$$type:Tr,init:function(e){r(W(W({},this.getWidgetRenderState(e)),{},{instantSearchInstance:e.instantSearchInstance}),!0)},render:function(e){r(W(W({},this.getWidgetRenderState(e)),{},{instantSearchInstance:e.instantSearchInstance}),!1)},getRenderState:function(e,t){return W(W({},e),{},{range:W(W({},e.range),{},k({},w,this.getWidgetRenderState(t)))})},getWidgetRenderState:function(e){var t=e.results,n=e.helper,r=e.instantSearchInstance,i=be(t&&t.disjunctiveFacets||[],function(e){return e.name===w}),a=function(e){return Cr({min:Te(_)?_:Te(e.min)?e.min:0,max:Te(P)?P:Te(e.max)?e.max:0,precision:N})}(i&&i.stats||{min:void 0,max:void 0}),s=function(e){var t=D(e.getNumericRefinement(w,">=")||[],1)[0],n=D(e.getNumericRefinement(w,"<=")||[],1)[0];return[Te(t)?t:-1/0,Te(n)?n:1/0]}(n);return{refine:u(r,n,t?a:{min:void 0,max:void 0}),canRefine:a.min!==a.max,format:c,range:a,sendEvent:function(l,d,h){return function(){for(var e=arguments.length,t=new Array(e),n=0;n<e;n++)t[n]=arguments[n];if(1!==t.length){var r=t[0],i=t[1],a=t[2];if("click"===r){var s=D(i,2),o=s[0],c=s[1],u=f(d,h,o,c);m(u,l,d,a)}}else l.sendEventToInsights(t[0])}}(r,n,a),widgetParams:W(W({},o),{},{precision:N}),start:s}},dispose:function(e){var t=e.state;return i(),t.removeDisjunctiveFacet(w).removeNumericRefinement(w)},getWidgetUiState:function(e,t){var n=t.searchParameters.getNumericRefinements(w),r=n[">="],i=void 0===r?[]:r,a=n["<="],s=void 0===a?[]:a;return 0===i.length&&0===s.length?e:W(W({},e),{},{range:W(W({},e.range),{},k({},w,"".concat(i,":").concat(s)))})},getWidgetSearchParameters:function(e,t){var n=t.uiState,r=e.addDisjunctiveFacet(w).setQueryParameters({numericRefinements:W(W({},e.numericRefinements),{},k({},w,{}))});Te(_)&&(r=r.addNumericRefinement(w,">=",_)),Te(P)&&(r=r.addNumericRefinement(w,"<=",P));var i=n.range&&n.range[w];if(!i||-1===i.indexOf(":"))return r;var a=D(i.split(":").map(parseFloat),2),s=a[0],o=a[1];return Te(s)&&(!Te(_)||_<s)&&(r=(r=r.removeNumericRefinement(w,">=")).addNumericRefinement(w,">=",s)),Te(o)&&(!Te(P)||o<P)&&(r=(r=r.removeNumericRefinement(w,"<=")).addNumericRefinement(w,"<=",o)),r}}}}function kr(u,e){var l=1<arguments.length&&void 0!==e?e:xe;return Ne(u,Dr()),function(f){var e=f||{},m=e.attribute,t=e.operator,d=void 0===t?"or":t,n=e.limit,p=void 0===n?10:n,r=e.showMore,g=void 0!==r&&r,i=e.showMoreLimit,h=void 0===i?20:i,a=e.sortBy,v=void 0===a?Br:a,s=e.escapeFacetValues,o=void 0===s||s,c=e.transformItems,y=void 0===c?function(e){return e}:c;if(!m)throw new Error(Dr("The `attribute` option is required."));if(!/^(and|or)$/.test(d))throw new Error(Dr('The `operator` must one of: `"and"`, `"or"` (got "'.concat(d,'").')));if(!0===g&&h<=p)throw new Error(Dr("`showMoreLimit` should be greater than `limit`."));function b(e){var t=e.name;return W(W({},M(e,["name"])),{},{label:t,value:t,highlighted:t})}var R,S,w,_=[],P=!0,N=!1,x=function(){};function I(){x()}function F(){return N?h:p}function T(n,a){return function(i){return function(e){var r=i.instantSearchInstance;if(""===e&&_)u(W(W({},a.getWidgetRenderState(W(W({},i),{},{results:R}))),{},{instantSearchInstance:r}),!1);else{var t={highlightPreTag:o?De.highlightPreTag:Be.highlightPreTag,highlightPostTag:o?De.highlightPostTag:Be.highlightPostTag};n.searchForFacetValues(m,e,Math.min(F(),100),t).then(function(e){var t=o?function(e){return e.map(function(e){return W(W({},e),{},{highlighted:Ue(e.highlighted)})})}(e.facetHits):e.facetHits,n=y(t.map(function(e){var t=e.value;return W(W({},M(e,["value"])),{},{value:t,label:t})}));u(W(W({},a.getWidgetRenderState(W(W({},i),{},{results:R}))),{},{items:n,canToggleShowMore:!1,canRefine:!0,isFromSearch:!0,instantSearchInstance:r}),!1)})}}}}var C=function(){return function(){}};return{$$type:"ais.refinementList",init:function(e){u(W(W({},this.getWidgetRenderState(e)),{},{instantSearchInstance:e.instantSearchInstance}),!0)},render:function(e){u(W(W({},this.getWidgetRenderState(e)),{},{instantSearchInstance:e.instantSearchInstance}),!1)},getRenderState:function(e,t){return W(W({},e),{},{refinementList:W(W({},e.refinementList),{},k({},m,this.getWidgetRenderState(t)))})},getWidgetRenderState:function(e){var t=e.results,n=e.state,r=e.createURL,i=e.instantSearchInstance,a=e.helper,s=[],o=[];if(w&&S&&C||(w=it({instantSearchInstance:i,helper:a,attribute:m,widgetType:this.$$type}),S=function(e){w("click",e),a.toggleFacetRefinement(m,e).search()},C=T(a,this)),t){var c=t.getFacetValues(m,{sortBy:v,facetOrdering:v===Br});o=c&&Array.isArray(c)?c:[],s=y(o.slice(0,F()).map(b));var u=n.maxValuesPerFacet,l=F();P=l<u?o.length<=l:o.length<l,R=t,_=s,e.results&&(x=function(e,t){return function(){N=!N,t.render(e)}}(e,this))}var d=C&&C(e),h=N&&_.length>p||g&&!P;return{createURL:function(e){return r(n.resetPage().toggleFacetRefinement(m,e))},items:s,refine:S,searchForItems:d,isFromSearch:!1,canRefine:0<s.length,widgetParams:f,isShowingMore:N,canToggleShowMore:h,toggleShowMore:I,sendEvent:w,hasExhaustiveItems:P}},dispose:function(e){var t=e.state;l();var n=t.setQueryParameter("maxValuesPerFacet",void 0);return"and"===d?n.removeFacet(m):n.removeDisjunctiveFacet(m)},getWidgetUiState:function(e,t){var n=t.searchParameters,r="or"===d?n.getDisjunctiveRefinements(m):n.getConjunctiveRefinements(m);return r.length?W(W({},e),{},{refinementList:W(W({},e.refinementList),{},k({},m,r))}):e},getWidgetSearchParameters:function(e,t){var n=t.uiState,r="or"===d,i=n.refinementList&&n.refinementList[m],a=e.clearRefinements(m),s=r?a.addDisjunctiveFacet(m):a.addFacet(m),o=s.maxValuesPerFacet||0,c=Math.max(o,g?h:p),u=s.setQueryParameter("maxValuesPerFacet",c);if(i)return i.reduce(function(e,t){return r?e.addDisjunctiveFacetRefinement(m,t):e.addFacetRefinement(m,t)},u);var l=r?"disjunctiveFacetsRefinements":"facetsRefinements";return u.setQueryParameters(k({},l,W(W({},u[l]),{},k({},m,[]))))}}}}function Lr(e,t){return t(e)}function Mr(n,e){var r=1<arguments.length&&void 0!==e?e:xe;return Ne(n,Ur()),function(i){var a,s,e=(i||{}).queryHook,o=void 0===e?Lr:e;return{$$type:"ais.searchBox",init:function(e){var t=e.instantSearchInstance;n(W(W({},this.getWidgetRenderState(e)),{},{instantSearchInstance:t}),!0)},render:function(e){var t=e.instantSearchInstance;n(W(W({},this.getWidgetRenderState(e)),{},{instantSearchInstance:t}),!1)},dispose:function(e){var t=e.state;return r(),t.setQueryParameter("query",void 0)},getRenderState:function(e,t){return W(W({},e),{},{searchBox:this.getWidgetRenderState(t)})},getWidgetRenderState:function(e){var t=e.helper,n=e.searchMetadata,r=e.state;return a||(a=function(e){o(e,function(e){return t.setQuery(e).search()})},s=function(){t.setQuery("").search()}),{query:r.query||"",refine:a,clear:s,widgetParams:i,isSearchStalled:n.isSearchStalled}},getWidgetUiState:function(e,t){var n=t.searchParameters.query||"";return""===n||e&&e.query===n?e:W(W({},e),{},{query:n})},getWidgetSearchParameters:function(e,t){var n=t.uiState;return e.setQueryParameter("query",n.query||"")}}}}function jr(i,e){var n=1<arguments.length&&void 0!==e?e:xe;Ne(i,qr());var c={};return function(a){var e=a||{},s=e.items,t=e.transformItems,o=void 0===t?function(e){return e}:t;if(!Array.isArray(s))throw new Error(qr("The `items` option expects an array of objects."));return{$$type:"ais.sortBy",init:function(e){var t=e.instantSearchInstance,n=this.getWidgetRenderState(e),r=n.currentRefinement;be(s,function(e){return e.value===r});i(W(W({},n),{},{instantSearchInstance:t}),!0)},render:function(e){var t=e.instantSearchInstance;i(W(W({},this.getWidgetRenderState(e)),{},{instantSearchInstance:t}),!1)},dispose:function(e){var t=e.state;return n(),c.initialIndex?t.setIndex(c.initialIndex):t},getRenderState:function(e,t){return W(W({},e),{},{sortBy:this.getWidgetRenderState(t)})},getWidgetRenderState:function(e){var t=e.results,n=e.helper,r=e.state,i=e.parent;return!c.initialIndex&&i&&(c.initialIndex=i.getIndexName()),c.setIndex||(c.setIndex=function(e){n.setIndex(e).search()}),{currentRefinement:r.index,options:o(s),refine:c.setIndex,hasNoResults:!t||0===t.nbHits,widgetParams:a}},getWidgetUiState:function(e,t){var n=t.searchParameters.index;return W(W({},e),{},{sortBy:n!==c.initialIndex?n:void 0})},getWidgetSearchParameters:function(e,t){var n=t.uiState;return e.setQueryParameter("index",n.sortBy||c.initialIndex||e.index)}}}}function Or(n,e){var i=1<arguments.length&&void 0!==e?e:xe;return Ne(n,Qr()),function(d){var h,e=d||{},f=e.attribute,t=e.max,m=void 0===t?5:t;if(!f)throw new Error(Qr("The `attribute` option is required."));function p(e){var t,n=e.getNumericRefinements(f);if(null!==(t=n[">="])&&void 0!==t&&t.length)return n[">="][0]}function r(e,t){var n=p(e)===Number(t),r=e.resetPage().removeNumericRefinement(f);return n?r:r.addNumericRefinement(f,"<=",m).addNumericRefinement(f,">=",Number(t))}var g=function(e){return function(e,t){h("click",t),e.setState(r(e.state,t)).search()}.bind(null,e)},v=function(e){var t=e.state,n=e.createURL;return function(e){return n(r(t,e))}};return{$$type:$r,init:function(e){var t=e.instantSearchInstance;n(W(W({},this.getWidgetRenderState(e)),{},{instantSearchInstance:t}),!0)},render:function(e){var t=e.instantSearchInstance;n(W(W({},this.getWidgetRenderState(e)),{},{instantSearchInstance:t}),!1)},getRenderState:function(e,t){return W(W({},e),{},{ratingMenu:W(W({},e.ratingMenu),{},k({},f,this.getWidgetRenderState(t)))})},getWidgetRenderState:function(e){var t=e.helper,n=e.results,r=e.state,i=e.instantSearchInstance,a=e.createURL,s=[];if(h=h||function(e){var o=e.instantSearchInstance,c=e.helper,u=e.getRefinedStar,l=e.attribute;return function(){for(var e=arguments.length,t=new Array(e),n=0;n<e;n++)t[n]=arguments[n];if(1!==t.length){var r=t[0],i=t[1],a=t[2],s=void 0===a?"Filter Applied":a;if("click"===r)u()===Number(i)||o.sendEventToInsights({insightsMethod:"clickedFilters",widgetType:$r,eventType:r,payload:{eventName:s,index:c.getIndex(),filters:["".concat(l,">=").concat(i)]},attribute:l})}else o.sendEventToInsights(t[0])}}({instantSearchInstance:i,helper:t,getRefinedStar:function(){return p(t.state)},attribute:f}),n)for(var o=n.getFacetValues(f,{}),c=(o.length,function(e){var r=0;e.forEach(function(e){var t=D(e.name.split("."),2)[1],n=void 0===t?"":t;r=Math.max(r,n.length)})}(o),p(r)),u=function(n){var e=c===n,t=o.filter(function(e){return Number(e.name)>=n&&Number(e.name)<=m}).map(function(e){return e.count}).reduce(function(e,t){return e+t},0);if(c&&!e&&0===t)return"continue";var r=P(new Array(Math.floor(m/1))).map(function(e,t){return 1*t<n});s.push({stars:r,name:String(n),label:String(n),value:String(n),count:t,isRefined:e})},l=1;l<m;l+=1)u(l);return{items:s=s.reverse(),hasNoResults:!n||0===n.nbHits,canRefine:0<s.length,refine:g(t),sendEvent:h,createURL:v({state:r,createURL:a}),widgetParams:d}},dispose:function(e){var t=e.state;return i(),t.removeNumericRefinement(f)},getWidgetUiState:function(e,t){var n=t.searchParameters,r=p(n);return"number"!=typeof r?e:W(W({},e),{},{ratingMenu:W(W({},e.ratingMenu),{},k({},f,r))})},getWidgetSearchParameters:function(e,t){var n=t.uiState,r=n.ratingMenu&&n.ratingMenu[f],i=e.clearRefinements(f).addDisjunctiveFacet(f);return r?i.addNumericRefinement(f,"<=",m).addNumericRefinement(f,">=",r):i.setQueryParameters({numericRefinements:W(W({},i.numericRefinements),{},k({},f,{}))})}}}}function Ar(n,e){var t=1<arguments.length&&void 0!==e?e:xe;return Ne(n,Vr()),function(r){return{$$type:"ais.stats",init:function(e){var t=e.instantSearchInstance;n(W(W({},this.getWidgetRenderState(e)),{},{instantSearchInstance:t}),!0)},render:function(e){var t=e.instantSearchInstance;n(W(W({},this.getWidgetRenderState(e)),{},{instantSearchInstance:t}),!1)},dispose:function(){t()},getRenderState:function(e,t){return W(W({},e),{},{stats:this.getWidgetRenderState(t)})},getWidgetRenderState:function(e){var t=e.results,n=e.state;return t?{hitsPerPage:t.hitsPerPage,nbHits:t.nbHits,nbSortedHits:t.nbSortedHits,areHitsSorted:void 0!==t.appliedRelevancyStrictness&&0<t.appliedRelevancyStrictness&&t.nbSortedHits!==t.nbHits,nbPages:t.nbPages,page:t.page,processingTimeMS:t.processingTimeMS,query:t.query,widgetParams:r}:{hitsPerPage:n.hitsPerPage,nbHits:0,nbSortedHits:void 0,areHitsSorted:!1,nbPages:0,page:n.page||0,processingTimeMS:-1,query:n.query||"",widgetParams:r}}}}}function Hr(i,e){var a=1<arguments.length&&void 0!==e?e:xe;return Ne(i,Kr()),function(m){var e=m||{},p=e.attribute,t=e.on,n=void 0===t||t,r=e.off;if(!p)throw new Error(Kr("The `attribute` option is required."));var g,v=void 0!==r,y=Ge(n).map(Pe),b=v?Ge(r).map(Pe):void 0,R=function(n,e){var r=e.state,i=e.createURL;return function(){r=r.resetPage();var e=n?y:b;e&&e.forEach(function(e){r=r.removeDisjunctiveFacetRefinement(p,e)});var t=n?b:y;return t&&t.forEach(function(e){r=r.addDisjunctiveFacetRefinement(p,e)}),i(r)}};return{$$type:zr,init:function(e){var t=e.instantSearchInstance;i(W(W({},this.getWidgetRenderState(e)),{},{instantSearchInstance:t}),!0)},render:function(e){var t=e.instantSearchInstance;i(W(W({},this.getWidgetRenderState(e)),{},{instantSearchInstance:t}),!1)},dispose:function(e){var t=e.state;return a(),t.removeDisjunctiveFacet(p)},getRenderState:function(e,t){return W(W({},e),{},{toggleRefinement:W(W({},e.toggleRefinement),{},k({},p,this.getWidgetRenderState(t)))})},getWidgetRenderState:function(e){var t=e.state,n=e.helper,r=e.results,i=e.createURL,a=e.instantSearchInstance,s=r?y.every(function(e){return t.isDisjunctiveFacetRefined(p,e)}):y.every(function(e){return t.isDisjunctiveFacetRefined(p,e)}),o={isRefined:s,count:0},c={isRefined:v&&!s,count:0};if(r){var u=Ge(b||!1),l=r.getFacetValues(p,{})||[],d=y.map(function(t){return be(l,function(e){return e.name===Re(t)})}).filter(function(e){return void 0!==e}),h=v?u.map(function(t){return be(l,function(e){return e.name===Re(t)})}).filter(function(e){return void 0!==e}):[];o={isRefined:!!d.length&&d.every(function(e){return e.isRefined}),count:d.reduce(function(e,t){return e+t.count},0)||null},c={isRefined:!!h.length&&h.every(function(e){return e.isRefined}),count:h.reduce(function(e,t){return e+t.count},0)||l.reduce(function(e,t){return e+t.count},0)}}g=g||function(e){var o=e.instantSearchInstance,c=e.helper,u=e.attribute,l=e.on;return function(){for(var e=arguments.length,t=new Array(e),n=0;n<e;n++)t[n]=arguments[n];if(1!==t.length){var r=t[0],i=t[1],a=t[2],s=void 0===a?"Filter Applied":a;"click"===r&&void 0!==l&&(i||o.sendEventToInsights({insightsMethod:"clickedFilters",widgetType:zr,eventType:r,payload:{eventName:s,index:c.getIndex(),filters:l.map(function(e){return"".concat(u,":").concat(e)})},attribute:u}))}else o.sendEventToInsights(t[0])}}({instantSearchInstance:a,attribute:p,on:y,helper:n});var f=s?c:o;return{value:{name:p,isRefined:s,count:r?f.count:null,onFacetValue:o,offFacetValue:c},createURL:R(s,{state:t,createURL:i}),sendEvent:g,canRefine:Boolean(r?f.count:null),refine:function(t){return function(){var e=(0<arguments.length&&void 0!==arguments[0]?arguments[0]:{isRefined:!1}).isRefined;e?(y.forEach(function(e){return t.removeDisjunctiveFacetRefinement(p,e)}),v&&b.forEach(function(e){return t.addDisjunctiveFacetRefinement(p,e)})):(g("click",e),v&&b.forEach(function(e){return t.removeDisjunctiveFacetRefinement(p,e)}),y.forEach(function(e){return t.addDisjunctiveFacetRefinement(p,e)})),t.search()}}(n),widgetParams:m}},getWidgetUiState:function(e,t){var n=t.searchParameters,r=y&&y.every(function(e){return n.isDisjunctiveFacetRefined(p,e)});return r?W(W({},e),{},{toggle:W(W({},e.toggle),{},k({},p,r))}):e},getWidgetSearchParameters:function(e,t){var n=t.uiState,r=e.clearRefinements(p).addDisjunctiveFacet(p);return Boolean(n.toggle&&n.toggle[p])?(y&&y.forEach(function(e){r=r.addDisjunctiveFacetRefinement(p,e)}),r):v?(b&&b.forEach(function(e){r=r.addDisjunctiveFacetRefinement(p,e)}),r):r.setQueryParameters({disjunctiveFacetsRefinements:W(W({},e.disjunctiveFacetsRefinements),{},k({},p,[]))})}}}}function Wr(d,e){var h=1<arguments.length&&void 0!==e?e:xe;Ne(d,Jr());var f={};return function(s){var e=s||{},t=e.attributes,n=e.separator,r=void 0===n?" > ":n,i=e.rootPath,a=void 0===i?null:i,o=e.transformItems,c=void 0===o?function(e){return e}:o;if(!t||!Array.isArray(t)||0===t.length)throw new Error(Jr("The `attributes` option expects an array of strings."));var u=D(t,1)[0];function l(e,t){if(t)return e.resetPage().toggleFacetRefinement(u,t);var n=e.getHierarchicalFacetBreadcrumb(u);return 0===n.length?e:e.resetPage().toggleFacetRefinement(u,n[0])}return{$$type:"ais.breadcrumb",init:function(e){d(W(W({},this.getWidgetRenderState(e)),{},{instantSearchInstance:e.instantSearchInstance}),!0)},render:function(e){d(W(W({},this.getWidgetRenderState(e)),{},{instantSearchInstance:e.instantSearchInstance}),!1)},dispose:function(){h()},getRenderState:function(e,t){return W(W({},e),{},{breadcrumb:W(W({},e.breadcrumb),{},k({},u,this.getWidgetRenderState(t)))})},getWidgetRenderState:function(e){var t=e.helper,n=e.createURL,r=e.results,i=e.state;var a=function(){if(!r||0===i.hierarchicalFacets.length)return[];var e=D(i.hierarchicalFacets,1)[0].name,t=r.getFacetValues(e,{}),n=Array.isArray(t.data)?t.data:[];return c(function(n){return n.map(function(e,t){return{label:e.label,value:t+1===n.length?null:n[t+1].value}})}(function n(e){return e.reduce(function(e,t){return t.isRefined&&(e.push({label:t.name,value:t.path}),Array.isArray(t.data)&&(e=e.concat(n(t.data)))),e},[])}(n)))}();return f.createURL||(f.createURL=function(e){return n(l(t.state,e))}),f.refine||(f.refine=function(e){t.setState(l(t.state,e)).search()}),{canRefine:0<a.length,createURL:f.createURL,items:a,refine:f.refine,widgetParams:s}},getWidgetSearchParameters:function(e){if(e.isHierarchicalFacet(u)){e.getHierarchicalFacetByName(u);return e}return e.addHierarchicalFacet({name:u,attributes:t,separator:r,rootPath:a})}}}}var Dr=Ze({name:"refinement-list",connector:!0}),Br=["isRefined","count:desc","name:asc"],Ur=Ze({name:"search-box",connector:!0}),qr=Ze({name:"sort-by",connector:!0}),Qr=Ze({name:"rating-menu",connector:!0}),$r="ais.ratingMenu",Vr=Ze({name:"stats",connector:!0}),Kr=Ze({name:"toggle-refinement",connector:!0}),zr="ais.toggleRefinement",Jr=Ze({name:"breadcrumb",connector:!0});var Yr=Ze({name:"geo-search",connector:!0});function Xr(e){return e.insideBoundingBox||""}function Gr(e,t){return e.setQueryParameter("insideBoundingBox",t)}function Zr(v,e){var i=1<arguments.length&&void 0!==e?e:xe;return Ne(v,Yr()),function(s){function o(e){return e.aroundLatLng?function(e){var t=e.match(et);if(!t)throw new Error('Invalid value for "aroundLatLng" parameter: "'.concat(e,'"'));return{lat:parseFloat(t[1]),lng:parseFloat(t[2])}}(e.aroundLatLng):void 0}function c(){return g.internalToggleRefineOnMapMove()}function u(e,t){return function(){g.isRefineOnMapMove=!g.isRefineOnMapMove,t(e)}}function l(){return g.isRefineOnMapMove}function d(){return g.internalSetMapMoveSinceLastRefine()}function h(t,n){return function(){var e=!0!==g.hasMapMoveSinceLastRefine;g.hasMapMoveSinceLastRefine=!0,e&&n(t)}}function f(){return g.hasMapMoveSinceLastRefine}var m,e=s||{},t=e.enableRefineOnMapMove,n=void 0===t||t,r=e.transformItems,p=void 0===r?function(e){return e}:r,g={isRefineOnMapMove:n,hasMapMoveSinceLastRefine:!1,lastRefinePosition:"",lastRefineBoundingBox:"",internalToggleRefineOnMapMove:xe,internalSetMapMoveSinceLastRefine:xe};return{$$type:ti,init:function(e){var t=e.instantSearchInstance;g.internalToggleRefineOnMapMove=u(e,xe),g.internalSetMapMoveSinceLastRefine=h(e,xe),v(W(W({},this.getWidgetRenderState(e)),{},{instantSearchInstance:t}),!0)},render:function(e){var t=e.helper,n=e.instantSearchInstance,r=t.state,i=Boolean(r.aroundLatLng)&&Boolean(g.lastRefinePosition)&&r.aroundLatLng!==g.lastRefinePosition,a=!r.insideBoundingBox&&Boolean(g.lastRefineBoundingBox)&&r.insideBoundingBox!==g.lastRefineBoundingBox;(i||a)&&(g.hasMapMoveSinceLastRefine=!1),g.lastRefinePosition=r.aroundLatLng||"",g.lastRefineBoundingBox=Xr(r),g.internalToggleRefineOnMapMove=u(e,this.render.bind(this)),g.internalSetMapMoveSinceLastRefine=h(e,this.render.bind(this));var s=this.getWidgetRenderState(e);m("view",s.items),v(W(W({},s),{},{instantSearchInstance:n}),!1)},getWidgetRenderState:function(e){var t=e.helper,n=e.results,r=e.instantSearchInstance,i=t.state,a=n?p(n.hits.filter(function(e){return e._geoloc})):[];return m=m||ct({instantSearchInstance:r,index:t.getIndex(),widgetType:ti}),{items:a,position:o(i),currentRefinement:function(e){return e.insideBoundingBox&&tt(e.insideBoundingBox)}(i),refine:function(i){return function(e){var t=e.northEast,n=e.southWest,r=[t.lat,t.lng,n.lat,n.lng].join();i.setState(Gr(i.state,r).resetPage()).search(),g.hasMapMoveSinceLastRefine=!1,g.lastRefineBoundingBox=r}}(t),sendEvent:m,clearMapRefinement:function(e){return function(){e.setQueryParameter("insideBoundingBox",void 0).search()}}(t),isRefinedWithMap:function(e){return function(){return Boolean(e.insideBoundingBox)}}(i),toggleRefineOnMapMove:c,isRefineOnMapMove:l,setMapMoveSinceLastRefine:d,hasMapMoveSinceLastRefine:f,widgetParams:s}},getRenderState:function(e,t){return W(W({},e),{},{geoSearch:this.getWidgetRenderState(t)})},dispose:function(e){var t=e.state;return i(),t.setQueryParameter("insideBoundingBox",void 0)},getWidgetUiState:function(e,t){var n=Xr(t.searchParameters);return!n||e&&e.geoSearch&&e.geoSearch.boundingBox===n?e:W(W({},e),{},{geoSearch:{boundingBox:n}})},getWidgetSearchParameters:function(e,t){var n=t.uiState;return n&&n.geoSearch?Gr(e,n.geoSearch.boundingBox):e.setQueryParameter("insideBoundingBox",void 0)}}}}function ei(r,e){var i=1<arguments.length&&void 0!==e?e:xe;Ne(r,ni());var a="https://www.algolia.com/?utm_source=instantsearch.js&utm_medium=website&"+"utm_content=".concat(ft(function(e){var t;return(null===(t=e.window.location)||void 0===t?void 0:t.hostname)||""},{fallback:function(){return""}}),"&")+"utm_campaign=poweredby";return function(e){var t=(e||{}).url,n=void 0===t?a:t;return{$$type:"ais.poweredBy",init:function(e){var t=e.instantSearchInstance;r(W(W({},this.getWidgetRenderState(e)),{},{instantSearchInstance:t}),!0)},render:function(e){var t=e.instantSearchInstance;r(W(W({},this.getWidgetRenderState(e)),{},{instantSearchInstance:t}),!1)},getRenderState:function(e,t){return W(W({},e),{},{poweredBy:this.getWidgetRenderState(t)})},getWidgetRenderState:function(){return{url:n,widgetParams:e}},dispose:function(){i()}}}}var ti="ais.geoSearch",ni=Ze({name:"powered-by",connector:!0}),ri=Ze({name:"configure",connector:!0});function ii(e,t){return e.setQueryParameters(Object.keys(t.searchParameters).reduce(function(e,t){return W(W({},e),{},k({},t,void 0))},{}))}function ai(e,t){var r=0<arguments.length&&void 0!==e?e:xe,a=1<arguments.length&&void 0!==t?t:xe;return function(i){if(!i||!Ce(i.searchParameters))throw new Error(ri("The `searchParameters` option expects an object."));var n={};return{$$type:"ais.configure",init:function(e){var t=e.instantSearchInstance;r(W(W({},this.getWidgetRenderState(e)),{},{instantSearchInstance:t}),!0)},render:function(e){var t=e.instantSearchInstance;r(W(W({},this.getWidgetRenderState(e)),{},{instantSearchInstance:t}),!1)},dispose:function(e){var t=e.state;return a(),ii(t,i)},getRenderState:function(e,t){var n,r=this.getWidgetRenderState(t);return W(W({},e),{},{configure:W(W({},r),{},{widgetParams:W(W({},r.widgetParams),{},{searchParameters:Xe(new oe.SearchParameters(null===(n=e.configure)||void 0===n?void 0:n.widgetParams.searchParameters),new oe.SearchParameters(r.widgetParams.searchParameters)).getQueryParams()})})})},getWidgetRenderState:function(e){var t=e.helper;return n.refine||(n.refine=function(r){return function(e){var t=ii(r.state,i),n=Xe(t,new oe.SearchParameters(e));i.searchParameters=e,r.setState(n).search()}}(t)),{refine:n.refine,widgetParams:i}},getWidgetSearchParameters:function(e,t){var n=t.uiState;return Xe(e,new oe.SearchParameters(W(W({},n.configure),i.searchParameters)))},getWidgetUiState:function(e){return W(W({},e),{},{configure:W(W({},e.configure),i.searchParameters)})}}}}var si=Ze({name:"configure-related-items",connector:!0});function oi(e){var t=e.attributeName,n=e.attributeValue,r=e.attributeScore;return"".concat(t,":").concat(n,"<score=").concat(r||1,">")}function ci(c,u){return function(e){var t=e||{},a=t.hit,s=t.matchingPatterns,n=t.transformSearchParameters,r=void 0===n?function(e){return e}:n;if(!a)throw new Error(si("The `hit` option is required."));if(!s)throw new Error(si("The `matchingPatterns` option is required."));var i=Object.keys(s).reduce(function(e,t){var n=s[t],r=Fe(a,t),i=n.score;return Array.isArray(r)?[].concat(P(e),[r.map(function(e){return oi({attributeName:t,attributeValue:e,attributeScore:i})})]):"string"==typeof r?[].concat(P(e),[oi({attributeName:t,attributeValue:r,attributeScore:i})]):e},[]),o=W({},r(new oe.SearchParameters({sumOrFiltersScores:!0,facetFilters:["objectID:-".concat(a.objectID)],optionalFilters:i})));return W(W({},ai(c,u)({searchParameters:o})),{},{$$type:"ais.configureRelatedItems"})}}var ui=Ze({name:"autocomplete",connector:!0}),li=Ze({name:"query-rules",connector:!0});function di(e){var t=this.helper,n=this.initialRuleContexts,r=this.trackedFilters,i=this.transformRuleContexts,a=e.state,s=a.ruleContexts||[],o=function(e){var i=e.helper,a=e.sharedHelperState,s=e.trackedFilters;return Object.keys(s).reduce(function(e,t){var n=we(i.lastResults||{},a,!0).filter(function(e){return e.attribute===t}).map(function(e){return e.numericValue||e.name}),r=(0,s[t])(n);return[].concat(P(e),P(n.filter(function(e){return r.includes(e)}).map(function(e){return function(e){return e.replace(/[^a-z0-9-_]+/gi,"_")}("ais-".concat(t,"-").concat(e))})))},[])}({helper:t,sharedHelperState:a,trackedFilters:r}),c=i([].concat(P(n),P(o))).slice(0,10);Le(s,c)||t.overrideStateWithoutTriggeringChangeEvent(W(W({},a),{},{ruleContexts:c}))}function hi(d,e){var h=1<arguments.length&&void 0!==e?e:xe;return Ne(d,li()),function(i){var e=i||{},t=e.trackedFilters,a=void 0===t?{}:t,n=e.transformRuleContexts,s=void 0===n?function(e){return e}:n,r=e.transformItems,o=void 0===r?function(e){return e}:r;Object.keys(a).forEach(function(e){if("function"!=typeof a[e])throw new Error(li("'The \"".concat(e,'" filter value in the `trackedFilters` option expects a function.')))});var c,u=0<Object.keys(a).length,l=[];return{$$type:"ais.queryRules",init:function(e){var t=e.helper,n=e.state,r=e.instantSearchInstance;l=n.ruleContexts||[],c=di.bind({helper:t,initialRuleContexts:l,trackedFilters:a,transformRuleContexts:s}),u&&((function(e){return[e.disjunctiveFacetsRefinements,e.facetsRefinements,e.hierarchicalFacetsRefinements,e.numericRefinements].some(function(e){return Boolean(e&&0<Object.keys(e).length)})}(n)||Boolean(i.transformRuleContexts))&&c({state:n}),t.on("change",c)),d(W(W({},this.getWidgetRenderState(e)),{},{instantSearchInstance:r}),!0)},render:function(e){var t=e.instantSearchInstance;d(W(W({},this.getWidgetRenderState(e)),{},{instantSearchInstance:t}),!1)},getWidgetRenderState:function(e){var t=(e.results||{}).userData;return{items:o(void 0===t?[]:t),widgetParams:i}},getRenderState:function(e,t){return W(W({},e),{},{queryRules:this.getWidgetRenderState(t)})},dispose:function(e){var t=e.helper,n=e.state;return h(),u?(t.removeListener("change",c),n.setQueryParameter("ruleContexts",l)):n}}}}function fi(e){function t(e){return{status:e,transcript:"",isSpeechFinal:!1,errorCode:void 0}}function n(e){var t=0<arguments.length&&void 0!==e?e:{};p=W(W({},p),t),f()}function r(e){n(t(0<arguments.length&&void 0!==e?e:"initial"))}function i(){n({status:"waiting"})}function a(e){n({status:"error",errorCode:e.error})}function s(e){n({status:"recognizing",transcript:e.results[0]&&e.results[0][0]&&e.results[0][0].transcript||"",isSpeechFinal:e.results[0]&&e.results[0].isFinal}),l&&p.transcript&&h(p.transcript)}function o(){p.errorCode||!p.transcript||l||h(p.transcript),"error"!==p.status&&n({status:"finished"})}function c(){u&&(u.stop(),u.removeEventListener("start",i),u.removeEventListener("error",a),u.removeEventListener("result",s),u.removeEventListener("end",o),u=void 0)}var u,l=e.searchAsYouSpeak,d=e.language,h=e.onQueryChange,f=e.onStateChange,m=window.webkitSpeechRecognition||window.SpeechRecognition,p=t("initial");return{getState:function(){return p},isBrowserSupported:function(){return Boolean(m)},isListening:function(){return"askingPermission"===p.status||"waiting"===p.status||"recognizing"===p.status},startListening:function(){(u=new m)&&(r("askingPermission"),u.interimResults=!0,d&&(u.lang=d),u.addEventListener("start",i),u.addEventListener("error",a),u.addEventListener("result",s),u.addEventListener("end",o),u.start())},stopListening:function(){c(),r("finished")},dispose:c}}function mi(p,e){var a=1<arguments.length&&void 0!==e?e:xe;return Ne(p,pi()),function(l){var e=l.searchAsYouSpeak,d=void 0!==e&&e,h=l.language,f=l.additionalQueryParameters,t=l.createVoiceSearchHelper,m=void 0===t?fi:t;return{$$type:"ais.voiceSearch",init:function(e){var t=e.instantSearchInstance;p(W(W({},this.getWidgetRenderState(e)),{},{instantSearchInstance:t}),!0)},render:function(e){var t=e.instantSearchInstance;p(W(W({},this.getWidgetRenderState(e)),{},{instantSearchInstance:t}),!1)},getRenderState:function(e,t){return W(W({},e),{},{voiceSearch:this.getWidgetRenderState(t)})},getWidgetRenderState:function(e){var t=this,n=e.helper,r=e.instantSearchInstance;this._refine||(this._refine=function(e){if(e!==n.state.query){var t=h?[h.split("-")[0]]:void 0;n.setQueryParameter("queryLanguages",t),"function"==typeof f&&n.setState(n.state.setQueryParameters(W({ignorePlurals:!0,removeStopWords:!0,optionalWords:e},f({query:e})))),n.setQuery(e).search()}}),this._voiceSearchHelper||(this._voiceSearchHelper=m({searchAsYouSpeak:d,language:h,onQueryChange:function(e){return t._refine(e)},onStateChange:function(){p(W(W({},t.getWidgetRenderState(e)),{},{instantSearchInstance:r}),!1)}}));var i=this._voiceSearchHelper,a=i.isBrowserSupported,s=i.isListening,o=i.startListening,c=i.stopListening,u=i.getState;return{isBrowserSupported:a(),isListening:s(),toggleListening:function(){a()&&(s()?c():o())},voiceListeningState:u(),widgetParams:l}},dispose:function(e){var t=e.state;this._voiceSearchHelper.dispose(),a();var n=t;if("function"==typeof f){var r=f({query:""}),i=r?Object.keys(r).reduce(function(e,t){return e[t]=void 0,e},{}):{};n=t.setQueryParameters(W({queryLanguages:void 0,ignorePlurals:void 0,removeStopWords:void 0,optionalWords:void 0},i))}return n.setQueryParameter("query",void 0)},getWidgetUiState:function(e,t){var n=t.searchParameters.query||"";return n?W(W({},e),{},{query:n}):e},getWidgetSearchParameters:function(e,t){var n=t.uiState;return e.setQueryParameter("query",n.query||"")}}}}var pi=Ze({name:"voice-search",connector:!0});function gi(b,e){var R=1<arguments.length&&void 0!==e?e:xe;return Ne(b,bi()),function(e){var t=e||{},i=t.queryLanguages,a=t.attributesForPrediction,n=t.nbHits,s=void 0===n?1:n,r=t.renderDebounceTime,o=void 0===r?100:r,c=t.searchDebounceTime,u=void 0===c?100:c,l=t.escapeHTML,d=void 0===l||l,h=t.extraParameters,f=void 0===h?{}:h;if(!i||0===i.length)throw new Error(bi("The `queryLanguages` expects an array of strings."));var m,p=function(){var n=-1,r=-1,i=void 0;return function(e){var t=++n;return Promise.resolve(e).then(function(e){return i&&t<r?i:(r=t,i=e)})}}(),g=[],v=!1,y=dt(b,o);return{$$type:"ais.answers",init:function(e){var t=e.state,n=e.instantSearchInstance.client.initIndex(t.index);if(!function(e){return"function"==typeof e.findAnswers}(n))throw new Error(bi("`algoliasearch` >= 4.8.0 required."));m=dt(n.findAnswers,u),b(W(W({},this.getWidgetRenderState(e)),{},{instantSearchInstance:e.instantSearchInstance}),!0)},render:function(n){var r=this,e=n.state.query;if(!e)return v=!(g=[]),void b(W(W({},this.getWidgetRenderState(n)),{},{instantSearchInstance:n.instantSearchInstance}),!1);g=[],v=!0,b(W(W({},this.getWidgetRenderState(n)),{},{instantSearchInstance:n.instantSearchInstance}),!1),p(m(e,i,W(W({},f),{},{nbHits:s,attributesForPrediction:a}))).then(function(e){if(e){d&&0<e.hits.length&&(e.hits=Qe(e.hits));var t=rt(nt(e.hits,0,s),e.queryID);g=t,v=!1,y(W(W({},r.getWidgetRenderState(n)),{},{instantSearchInstance:n.instantSearchInstance}),!1)}})},getRenderState:function(e,t){return W(W({},e),{},{answers:this.getWidgetRenderState(t)})},getWidgetRenderState:function(){return{hits:g,isLoading:v,widgetParams:e}},dispose:function(e){var t=e.state;return R(),t},getWidgetSearchParameters:function(e){return e}}}}function vi(e,t){var n=0<arguments.length&&void 0!==e?e:xe,r=1<arguments.length&&void 0!==t?t:xe;return function(a){var s={};return{$$type:"ais.relevantSort",init:function(e){var t=e.instantSearchInstance;n(W(W({},this.getWidgetRenderState(e)),{},{instantSearchInstance:t}),!0)},render:function(e){var t=e.instantSearchInstance;n(W(W({},this.getWidgetRenderState(e)),{},{instantSearchInstance:t}),!1)},dispose:function(e){var t=e.state;return r(),t.setQueryParameter("relevancyStrictness",void 0)},getRenderState:function(e,t){return W(W({},e),{},{relevantSort:this.getWidgetRenderState(t)})},getWidgetRenderState:function(e){var t=e.results,n=e.helper;s.refine||(s.refine=function(e){n.setQueryParameter("relevancyStrictness",e).search()});var r=(t||{}).appliedRelevancyStrictness,i=void 0!==r;return{isRelevantSorted:void 0!==r&&0<r,isVirtualReplica:i,canRefine:i,refine:s.refine,widgetParams:a}},getWidgetSearchParameters:function(e,t){var n,r=t.uiState;return e.setQueryParameter("relevancyStrictness",null!==(n=r.relevantSort)&&void 0!==n?n:e.relevancyStrictness)},getWidgetUiState:function(e,t){var n=t.searchParameters;return W(W({},e),{},{relevantSort:n.relevancyStrictness||e.relevantSort})}}}}function yi(d,e){var s=1<arguments.length&&void 0!==e?e:xe;return Ne(d,Ri()),function(o){var e=o.widgets,t=o.maxValuesPerFacet,n=void 0===t?20:t,r=o.facets,i=void 0===r?["*"]:r,a=o.transformItems,c=void 0===a?function(e){return e}:a,u=o.fallbackWidget;if(!(e&&Array.isArray(e)&&e.every(function(e){return"object"===h(e)})))throw new Error(Ri("The `widgets` option expects an array of widgets."));if(!(Array.isArray(i)&&i.length<=1)||"*"!==i[0]&&void 0!==i[0])throw new Error(Ri('The `facets` option only accepts [] or ["*"], you passed '.concat(JSON.stringify(i))));var l=new Map;return{$$type:"ais.dynamicWidgets",init:function(n){e.forEach(function(e){var t=ht(e,n);l.set(t,{widget:e,isMounted:!1})}),d(W(W({},this.getWidgetRenderState(n)),{},{instantSearchInstance:n.instantSearchInstance}),!0)},render:function(e){var t=e.parent,a=this.getWidgetRenderState(e),s=[],o=[];u&&a.attributesToRender.forEach(function(e){if(!l.has(e)){var t=u({attribute:e});l.set(e,{widget:t,isMounted:!1})}}),l.forEach(function(e,t){var n=e.widget,r=e.isMounted,i=-1<a.attributesToRender.indexOf(t);!r&&i?(o.push(n),l.set(t,{widget:n,isMounted:!0})):r&&!i&&(s.push(n),l.set(t,{widget:n,isMounted:!1}))}),t.addWidgets(o),setTimeout(function(){return t.removeWidgets(s)},0),d(W(W({},a),{},{instantSearchInstance:e.instantSearchInstance}),!1)},dispose:function(e){var t=e.parent,n=[];l.forEach(function(e){var t=e.widget;e.isMounted&&n.push(t)}),t.removeWidgets(n),s()},getWidgetSearchParameters:function(e){return i.reduce(function(e,t){return e.addFacet(t)},e.setQueryParameters({maxValuesPerFacet:Math.max(n||0,e.maxValuesPerFacet||0)}))},getRenderState:function(e,t){return W(W({},e),{},{dynamicWidgets:this.getWidgetRenderState(t)})},getWidgetRenderState:function(e){var t,n,r,i,a=e.results;e.state;if(!a)return{attributesToRender:[],widgetParams:o};var s=c(null!==(t=null===(n=a.renderingContent)||void 0===n?void 0:null===(r=n.facetOrdering)||void 0===r?void 0:null===(i=r.facets)||void 0===i?void 0:i.order)&&void 0!==t?t:[],{results:a});if(!Array.isArray(s))throw new Error(Ri("The `transformItems` option expects a function that returns an Array."));return{attributesToRender:s,widgetParams:o}}}}}var bi=Ze({name:"answers",connector:!0}),Ri=Ze({name:"dynamic-widgets",connector:!0}),Si=Ie(yi),wi=Object.freeze({__proto__:null,connectDynamicWidgets:yi,EXPERIMENTAL_connectDynamicWidgets:Si,connectClearRefinements:fn,connectCurrentRefinements:gn,connectHierarchicalMenu:wn,connectHits:_n,connectHitsWithInsights:lr,connectHitsPerPage:ur,connectInfiniteHits:mr,connectInfiniteHitsWithInsights:vr,connectMenu:pr,connectNumericMenu:gr,connectPagination:Nr,connectRange:Er,connectRefinementList:kr,connectSearchBox:Mr,connectSortBy:jr,connectRatingMenu:Or,connectStats:Ar,connectToggleRefinement:Hr,connectBreadcrumb:Wr,connectGeoSearch:Zr,connectPoweredBy:ei,connectConfigure:ai,EXPERIMENTAL_connectConfigureRelatedItems:ci,connectAutocomplete:function(r,e){var i=1<arguments.length&&void 0!==e?e:xe;return Ne(r,ui()),function(o){var e=(o||{}).escapeHTML,c=void 0===e||e,u={};return{$$type:"ais.autocomplete",init:function(e){var t=e.instantSearchInstance;r(W(W({},this.getWidgetRenderState(e)),{},{instantSearchInstance:t}),!0)},render:function(e){var t=e.instantSearchInstance,n=this.getWidgetRenderState(e);n.indices.forEach(function(e){(0,e.sendEvent)("view",e.hits)}),r(W(W({},n),{},{instantSearchInstance:t}),!1)},getRenderState:function(e,t){return W(W({},e),{},{autocomplete:this.getWidgetRenderState(t)})},getWidgetRenderState:function(e){var n=this,t=e.helper,r=e.state,i=e.scopedResults,a=e.instantSearchInstance;u.refine||(u.refine=function(e){t.setQuery(e).search()});var s=i.map(function(e){e.results.hits=c?Qe(e.results.hits):e.results.hits;var t=ct({instantSearchInstance:a,index:e.results.index,widgetType:n.$$type});return{indexId:e.indexId,indexName:e.results.index,hits:e.results.hits,results:e.results,sendEvent:t}});return{currentRefinement:r.query||"",indices:s,refine:u.refine,widgetParams:o}},getWidgetUiState:function(e,t){var n=t.searchParameters.query||"";return""===n||e&&e.query===n?e:W(W({},e),{},{query:n})},getWidgetSearchParameters:function(e,t){var n={query:t.uiState.query||""};return c?e.setQueryParameters(W(W({},n),De)):e.setQueryParameters(n)},dispose:function(e){var t=e.state;i();var n=t.setQueryParameter("query",void 0);return c?n.setQueryParameters(Object.keys(De).reduce(function(e,t){return W(W({},e),{},k({},t,void 0))},{})):n}}}},connectQueryRules:hi,connectVoiceSearch:mi,EXPERIMENTAL_connectAnswers:gi,connectRelevantSort:vi}),_i=Ze({name:"analytics"}),Pi=me(function(e){function s(){for(var e=[],t=0;t<arguments.length;t++){var n=arguments[t];if(n){var r=typeof n;if("string"==r||"number"==r)e.push(n);else if(Array.isArray(n)&&n.length){var i=s.apply(null,n);i&&e.push(i)}else if("object"==r)for(var a in n)o.call(n,a)&&n[a]&&e.push(a)}}return e.join(" ")}var o;o={}.hasOwnProperty,e.exports?(s.default=s,e.exports=s):window.classNames=s}),Ni=function(){L(t,qn);var e=O(t);function t(){return C(this,t),e.apply(this,arguments)}return E(t,[{key:"shouldComponentUpdate",value:function(e){return!Le(this.props.data,e.data)||this.props.templateKey!==e.templateKey||!Le(this.props.rootProps,e.rootProps)}},{key:"render",value:function(){var e=this.props.rootTagName,t=this.props.useCustomCompileOptions[this.props.templateKey]?this.props.templatesConfig.compileOptions:{},n=ye({templates:this.props.templates,templateKey:this.props.templateKey,compileOptions:t,helpers:this.props.templatesConfig.helpers,data:this.props.data,bindEvent:this.props.bindEvent});return null===n?null:Dn(e,f({},this.props.rootProps,{dangerouslySetInnerHTML:{__html:n}}))}}]),t}();k(Ni,"defaultProps",{data:{},rootTagName:"div",useCustomCompileOptions:{},templates:{},templatesConfig:{}});function xi(e){var r=e.items,i=e.cssClasses,a=e.templateProps,s=e.createURL,o=e.refine;return Dn("div",{className:Pi(i.root,k({},i.noRefinementRoot,0===r.length))},Dn("ul",{className:i.list},Dn("li",{className:Pi(i.item,k({},i.selectedItem,0===r.length))},Dn(Ni,f({},a,{templateKey:"home",rootTagName:"a",rootProps:{className:i.link,href:s(void 0),onClick:function(e){e.preventDefault(),o(void 0)}}}))),r.map(function(t,e){var n=e===r.length-1;return Dn("li",{key:t.label+e,className:Pi(i.item,k({},i.selectedItem,n))},Dn(Ni,f({},a,{templateKey:"separator",rootTagName:"span",rootProps:{className:i.separator,"aria-hidden":!0}})),n?t.label:Dn("a",{className:i.link,href:s(t.value),onClick:function(e){e.preventDefault(),o(t.value)}},t.label))})))}function Ii(e){var t=e.hasRefinements,n=e.refine,r=e.cssClasses,i=e.templateProps;return Dn("div",{className:r.root},Dn(Ni,f({},i,{templateKey:"resetLabel",rootTagName:"button",rootProps:{className:Pi(r.button,k({},r.disabledButton,!t)),onClick:n,disabled:!t},data:{hasRefinements:t}})))}function Fi(e){var t=e.items,n=e.cssClasses;return Dn("div",{className:n.root},Dn("ul",{className:n.list},t.map(function(t,e){return Dn("li",{key:"".concat(t.indexName,"-").concat(t.attribute,"-").concat(e),className:n.item},Dn("span",{className:n.label},function(e){return e.toString().charAt(0).toUpperCase()+e.toString().slice(1)}(t.label),":"),t.refinements.map(function(e){return Dn("span",{key:function(e){var t=e.attribute,n=e.value;return[t,e.type,n,e.operator].map(function(e){return e}).filter(Boolean).join(":")}(e),className:n.category},Dn("span",{className:n.categoryLabel},"query"===e.attribute?Dn("q",null,e.label):e.label),Dn("button",{className:n.delete,onClick:function(t){return function(e){de(e)||(e.preventDefault(),t())}}(t.refine.bind(null,e))},"✕"))}))})))}function Ti(e,t){var n=e.items,r=e.widgetParams;if(!t){var i=r,a=i.container,s=i.cssClasses;sr(Dn(Fi,{cssClasses:s,items:n}),a)}}function Ci(e){var t=e.hits,n=e.isLoading,r=e.cssClasses,i=e.templateProps;return Dn("div",{className:Pi(r.root,k({},r.emptyRoot,0===t.length))},Dn(Ni,f({},i,{templateKey:"header",rootProps:{className:r.header},data:{hits:t,isLoading:n}})),n?Dn(Ni,f({},i,{templateKey:"loader",rootProps:{className:r.loader}})):Dn("ul",{className:r.list},t.map(function(e,t){return Dn(Ni,f({},i,{templateKey:"item",rootTagName:"li",rootProps:{className:r.item},key:e.objectID,data:W(W({},e),{},{__hitIndex:t})}))})))}var Ei={home:"Home",separator:">"},ki=Ze({name:"breadcrumb"}),Li=St("Breadcrumb"),Mi={resetLabel:"Clear refinements"},ji=Ze({name:"clear-refinements"}),Oi=St("ClearRefinements"),Ai=Ze({name:"current-refinements"}),Hi=St("CurrentRefinements"),Wi={header:"",loader:"",item:function(e){return JSON.stringify(e)}},Di=Ze({name:"answers"}),Bi=St("Answers"),Ui=Ze({name:"dynamic-widgets"}),qi=St("DynamicWidgets");function Qi(e){var t=document.createElement("div");return t.className=qi({descendantName:"widget"}),e.appendChild(t),t}function $i(e){var t=e||{},n=t.container,r=t.widgets,i=t.fallbackWidget,a=M(t,["container","widgets","fallbackWidget"]);if(!n)throw new Error(Ui("The `container` option is required."));if(!(r&&Array.isArray(r)&&r.every(function(e){return"function"==typeof e})))throw new Error(Ui("The `widgets` option expects an array of callbacks."));var s=le(n),o=document.createElement("div");o.className=qi();var c=new Map,u=[],l=yi(function(e,t){var n=e.attributesToRender;t&&s.appendChild(o),n.forEach(function(e){if(c.has(e)){var t=c.get(e);o.appendChild(t)}})},function(){s.removeChild(o)})(W(W({},a),{},{widgets:u,fallbackWidget:"function"==typeof i?function(e){var t=e.attribute,n=Qi(o);return c.set(t,n),i({attribute:t,container:n})}:void 0}));return W(W({},l),{},{init:function(i){r.forEach(function(e){var t=Qi(o),n=e(t),r=ht(n,i);c.set(r,t),u.push(n)}),l.init(i)},$$widgetType:"ais.dynamicWidgets"})}function Vi(e){var t=e.className,n=e.disabled,r=void 0!==n&&n;return Dn("button",{className:t,onClick:e.onClick,disabled:r},e.children)}function Ki(e){var t=e.classNameLabel,n=e.classNameInput,r=e.checked,i=e.onToggle,a=e.children;return Dn("label",{className:t},Dn("input",{className:n,type:"checkbox",checked:r,onChange:i}),a)}function zi(e){var t=e.cssClasses,n=e.enableRefine,r=e.enableRefineControl,i=e.enableClearMapRefinement,a=e.isRefineOnMapMove,s=e.isRefinedWithMap,o=e.hasMapMoveSinceLastRefine,c=e.onRefineToggle,u=e.onRefineClick,l=e.onClearClick,d=e.templateProps;return Dn(Un,null,n&&Dn("div",null,r&&Dn("div",{className:t.control},a||!o?Dn(Ki,{classNameLabel:Pi(t.label,k({},t.selectedLabel,a)),classNameInput:t.input,checked:a,onToggle:c},Dn(Ni,f({},d,{templateKey:"toggle",rootTagName:"span"}))):Dn(Vi,{className:t.redo,disabled:!o,onClick:u},Dn(Ni,f({},d,{templateKey:"redo",rootTagName:"span"})))),!r&&!a&&Dn("div",{className:t.control},Dn(Vi,{className:Pi(t.redo,k({},t.disabledRedo,!o)),disabled:!o,onClick:u},Dn(Ni,f({},d,{templateKey:"redo",rootTagName:"span"})))),i&&s&&Dn(Vi,{className:t.reset,onClick:l},Dn(Ni,f({},d,{templateKey:"reset",rootTagName:"span"})))))}function Ji(e){var t=e.refine,n=e.mapInstance;return t({northEast:n.getBounds().getNorthEast().toJSON(),southWest:n.getBounds().getSouthWest().toJSON()})}function Yi(e,t){e.isUserInteraction=!1,t(),e.isUserInteraction=!0}function Xi(e,t){var n=e.items,r=e.position,i=e.currentRefinement,a=e.refine,s=e.clearMapRefinement,o=e.toggleRefineOnMapMove,c=e.isRefineOnMapMove,u=e.setMapMoveSinceLastRefine,l=e.hasMapMoveSinceLastRefine,d=e.isRefinedWithMap,h=e.widgetParams,f=e.instantSearchInstance,m=h.container,p=h.googleReference,g=h.cssClasses,v=h.templates,y=h.initialZoom,b=h.initialPosition,R=h.enableRefine,S=h.enableClearMapRefinement,w=h.enableRefineControl,_=h.mapOptions,P=h.createMarker,N=h.markerOptions,x=h.renderState;if(t){x.isUserInteraction=!0,x.isPendingRefine=!1,x.markers=[];var I=document.createElement("div");I.className=g.root,m.appendChild(I);var F=document.createElement("div");F.className=g.map,I.appendChild(F);var T=document.createElement("div");T.className=g.tree,I.appendChild(T),x.mapInstance=new p.maps.Map(F,W({mapTypeControl:!1,fullscreenControl:!1,streetViewControl:!1,clickableIcons:!1,zoomControlOptions:{position:p.maps.ControlPosition.LEFT_TOP}},_));return p.maps.event.addListenerOnce(x.mapInstance,"idle",function(){function e(){x.isUserInteraction&&R&&(u(),c()&&(x.isPendingRefine=!0))}x.mapInstance.addListener("center_changed",e),x.mapInstance.addListener("zoom_changed",e),x.mapInstance.addListener("dragstart",e),x.mapInstance.addListener("idle",function(){x.isUserInteraction&&x.isPendingRefine&&(x.isPendingRefine=!1,Ji({mapInstance:x.mapInstance,refine:a}))})}),void(x.templateProps=fe({templatesConfig:f.templatesConfig,templates:v}))}var C=n.map(function(e){return e.objectID}),E=D(function(e,a){return e.reduce(function(e,t){var n=D(e,2),r=n[0],i=n[1];return a.includes(t.__id)?[r.concat(t),i]:[r,i.concat(t)]},[[],[]])}(x.markers,C),2),k=E[0],L=E[1],M=k.map(function(e){return e.__id}),j=n.filter(function(e){return!M.includes(e.objectID)});L.forEach(function(e){return e.setMap(null)}),x.markers=k.concat(j.map(function(n){var r=P({map:x.mapInstance,item:n});return Object.keys(N.events).forEach(function(t){r.addListener(t,function(e){N.events[t]({map:x.mapInstance,event:e,item:n,marker:r})})}),r}));var O=!l(),A=i?0:null,H=!i&&Boolean(x.markers.length)?function(e,t){var n=t.reduce(function(e,t){return e.extend(t.getPosition())},new e.maps.LatLngBounds);return{northEast:n.getNorthEast().toJSON(),southWest:n.getSouthWest().toJSON()}}(p,x.markers):i;H&&O?Yi(x,function(){x.mapInstance.fitBounds(new p.maps.LatLngBounds(H.southWest,H.northEast),A)}):O&&Yi(x,function(){x.mapInstance.setCenter(r||b),x.mapInstance.setZoom(y)}),sr(Dn(zi,{cssClasses:g,enableRefine:R,enableRefineControl:w,enableClearMapRefinement:S,isRefineOnMapMove:c(),isRefinedWithMap:d(),hasMapMoveSinceLastRefine:l(),onRefineToggle:o,onRefineClick:function(){return Ji({mapInstance:x.mapInstance,refine:a})},onClearClick:s,templateProps:x.templateProps}),m.querySelector(".".concat(g.tree)))}var Gi={HTMLMarker:"<p>Your custom HTML Marker</p>",reset:"Clear the map refinement",toggle:"Search as I move the map",redo:"Redo search here"},Zi=Ze({name:"geo-search"}),ea=St("GeoSearch");function ta(e){var t=e.className,n=e.handleClick,r=e.facetValueToRefine,i=e.isRefined,a=e.templateProps,s=e.templateKey,o=e.templateData,c=e.subItems;return Dn("li",{className:t,onClick:function(e){n({facetValueToRefine:r,isRefined:i,originalEvent:e})}},Dn(Ni,f({},a,{templateKey:s,data:o})),c)}var na={query:"",showSubmit:!0,showReset:!0,showLoadingIndicator:!0,autofocus:!1,searchAsYouType:!0,isSearchStalled:!1,disabled:!1,onChange:xe,onSubmit:xe,onReset:xe,refine:xe},ra=function(){L(i,qn);var r=O(i);function i(){var s;C(this,i);for(var e=arguments.length,t=new Array(e),n=0;n<e;n++)t[n]=arguments[n];return k(j(s=r.call.apply(r,[this].concat(t))),"state",{query:s.props.query,focused:!1}),k(j(s),"input",{current:null}),k(j(s),"onInput",function(e){var t=s.props,n=t.searchAsYouType,r=t.refine,i=t.onChange,a=e.target.value;n&&r(a),s.setState({query:a}),i(e)}),k(j(s),"onSubmit",function(e){var t=s.props,n=t.searchAsYouType,r=t.refine,i=t.onSubmit;return e.preventDefault(),e.stopPropagation(),s.input.current&&s.input.current.blur(),n||r(s.state.query),i(e),!1}),k(j(s),"onReset",function(e){var t=s.props,n=t.refine,r=t.onReset;s.input.current&&s.input.current.focus(),n(""),s.setState({query:""}),r(e)}),k(j(s),"onBlur",function(){s.setState({focused:!1})}),k(j(s),"onFocus",function(){s.setState({focused:!0})}),s}return E(i,[{key:"resetInput",value:function(){this.setState({query:""})}},{key:"componentWillReceiveProps",value:function(e){this.state.focused||e.query===this.state.query||this.setState({query:e.query})}},{key:"render",value:function(){var e=this.props,t=e.cssClasses,n=e.placeholder,r=e.autofocus,i=e.showSubmit,a=e.showReset,s=e.showLoadingIndicator,o=e.templates,c=e.isSearchStalled;return Dn("div",{className:t.root},Dn("form",{action:"",role:"search",className:t.form,noValidate:!0,onSubmit:this.onSubmit,onReset:this.onReset},Dn("input",{ref:this.input,value:this.state.query,disabled:this.props.disabled,className:t.input,type:"search",placeholder:n,autoFocus:r,autoComplete:"off",autoCorrect:"off",autoCapitalize:"off",spellCheck:"false",maxLength:512,onInput:this.onInput,onBlur:this.onBlur,onFocus:this.onFocus}),Dn(Ni,{templateKey:"submit",rootTagName:"button",rootProps:{className:t.submit,type:"submit",title:"Submit the search query.",hidden:!i},templates:o,data:{cssClasses:t}}),Dn(Ni,{templateKey:"reset",rootTagName:"button",rootProps:{className:t.reset,type:"reset",title:"Clear the search query.",hidden:!(a&&this.state.query.trim()&&!c)},templates:o,data:{cssClasses:t}}),s&&Dn(Ni,{templateKey:"loadingIndicator",rootTagName:"span",rootProps:{className:t.loadingIndicator,hidden:!c},templates:o,data:{cssClasses:t}})))}}]),i}();k(ra,"defaultProps",na);function ia(e){return void 0!==e.data}var aa=function(){L(u,qn);var n=O(u);function u(e){var t;return C(this,u),k(j(t=n.call(this,e)),"searchBox",{current:null}),t.handleItemClick=t.handleItemClick.bind(j(t)),t}return E(u,[{key:"shouldComponentUpdate",value:function(e){return!Le(this.props.facetValues,e.facetValues)}},{key:"refine",value:function(e){this.props.toggleRefinement(e)}},{key:"_generateFacetItem",value:function(e){var t,n;if(ia(e)&&Array.isArray(e.data)&&0<e.data.length){var r=this.props.cssClasses,i=(r.root,M(r,["root"]));n=Dn(u,f({},this.props,{cssClasses:i,depth:this.props.depth+1,facetValues:e.data,showMore:!1,className:this.props.cssClasses.childList}))}var a=this.props.createURL(e.value),s=W(W({},e),{},{url:a,attribute:this.props.attribute,cssClasses:this.props.cssClasses,isFromSearch:this.props.isFromSearch}),o=e.value;void 0!==e.isRefined&&(o+="/".concat(e.isRefined)),void 0!==e.count&&(o+="/".concat(e.count));var c=Pi(this.props.cssClasses.item,(k(t={},this.props.cssClasses.selectedItem,e.isRefined),k(t,this.props.cssClasses.disabledItem,!e.count),k(t,this.props.cssClasses.parentItem,ia(e)&&Array.isArray(e.data)&&0<e.data.length),t));return Dn(ta,{templateKey:"item",key:o,facetValueToRefine:e.value,handleClick:this.handleItemClick,isRefined:e.isRefined,className:c,subItems:n,templateData:s,templateProps:this.props.templateProps})}},{key:"handleItemClick",value:function(e){var t=e.facetValueToRefine,n=e.isRefined,r=e.originalEvent;if(!de(r)&&r.target instanceof HTMLElement&&r.target.parentNode instanceof HTMLElement&&(!n||!r.target.parentNode.querySelector('input[type="radio"]:checked')))if("INPUT"!==r.target.tagName){for(var i=r.target;i!==r.currentTarget;){if("LABEL"===i.tagName&&(i.querySelector('input[type="checkbox"]')||i.querySelector('input[type="radio"]')))return;"A"===i.tagName&&i.href&&r.preventDefault(),i=i.parentNode}r.stopPropagation(),this.refine(t)}else this.refine(t)}},{key:"componentWillReceiveProps",value:function(e){this.searchBox.current&&!e.isFromSearch&&this.searchBox.current.resetInput()}},{key:"refineFirstValue",value:function(){var e=this.props.facetValues&&this.props.facetValues[0];if(e){var t=e.value;this.props.toggleRefinement(t)}}},{key:"render",value:function(){var t=this,e=Pi(this.props.cssClasses.showMore,k({},this.props.cssClasses.disabledShowMore,!(!0===this.props.showMore&&this.props.canToggleShowMore))),n=!0===this.props.showMore&&Dn(Ni,f({},this.props.templateProps,{templateKey:"showMoreText",rootTagName:"button",rootProps:{className:e,disabled:!this.props.canToggleShowMore,onClick:this.props.toggleShowMore},data:{isShowingMore:this.props.isShowingMore}})),r=!0!==this.props.searchIsAlwaysActive&&!(this.props.isFromSearch||!this.props.hasExhaustiveItems),i=this.props.searchFacetValues&&Dn("div",{className:this.props.cssClasses.searchBox},Dn(ra,{ref:this.searchBox,placeholder:this.props.searchPlaceholder,disabled:r,cssClasses:this.props.cssClasses.searchable,templates:this.props.searchBoxTemplateProps.templates,onChange:function(e){return t.props.searchFacetValues(e.target.value)},onReset:function(){return t.props.searchFacetValues("")},onSubmit:function(){return t.refineFirstValue()},searchAsYouType:!1})),a=this.props.facetValues&&0<this.props.facetValues.length&&Dn("ul",{className:this.props.cssClasses.list},this.props.facetValues.map(this._generateFacetItem,this)),s=this.props.searchFacetValues&&this.props.isFromSearch&&(!this.props.facetValues||0===this.props.facetValues.length)&&Dn(Ni,f({},this.props.templateProps,{templateKey:"searchableNoResults",rootProps:{className:this.props.cssClasses.noResults}}));return Dn("div",{className:Pi(this.props.cssClasses.root,k({},this.props.cssClasses.noRefinementRoot,!this.props.facetValues||0===this.props.facetValues.length),this.props.className)},this.props.children,i,a,s,n)}}]),u}();k(aa,"defaultProps",{cssClasses:{},depth:0});var sa={item:'<a class="{{cssClasses.link}}" href="{{url}}"><span class="{{cssClasses.label}}">{{label}}</span><span class="{{cssClasses.count}}">{{#helpers.formatNumber}}{{count}}{{/helpers.formatNumber}}</span></a>',showMoreText:"\n    {{#isShowingMore}}\n      Show less\n    {{/isShowingMore}}\n    {{^isShowingMore}}\n      Show more\n    {{/isShowingMore}}\n  "},oa=Ze({name:"hierarchical-menu"}),ca=St("HierarchicalMenu"),ua={empty:"No results",item:function(e){return JSON.stringify(e,null,2)}},la=Ze({name:"hits"}),da=St("Hits"),ha=cr(function(e){var t=e.results,n=e.hits,r=e.bindEvent,i=e.cssClasses,a=e.templateProps;return 0===t.hits.length?Dn(Ni,f({},a,{templateKey:"empty",rootProps:{className:Pi(i.root,i.emptyRoot)},data:t})):Dn("div",{className:i.root},Dn("ol",{className:i.list},n.map(function(e,t){return Dn(Ni,f({},a,{templateKey:"item",rootTagName:"li",rootProps:{className:i.item},key:e.objectID,data:W(W({},e),{},{__hitIndex:t}),bindEvent:r}))})))});function fa(e){var t=e.currentValue,n=e.options,r=e.cssClasses,i=e.setValue;return Dn("select",{className:Pi(r.select),onChange:function(e){return i(e.target.value)},value:"".concat(t)},n.map(function(e){return Dn("option",{className:Pi(r.option),key:e.label+e.value,value:"".concat(e.value)},e.label)}))}var ma=Ze({name:"hits-per-page"}),pa=St("HitsPerPage"),ga={empty:"No results",showPreviousText:"Show previous results",showMoreText:"Show more results",item:function(e){return JSON.stringify(e,null,2)}},va=Ze({name:"infinite-hits"}),ya=St("InfiniteHits"),ba=cr(function(e){var t=e.results,n=e.hits,r=e.bindEvent,i=e.hasShowPrevious,a=e.showPrevious,s=e.showMore,o=e.isFirstPage,c=e.isLastPage,u=e.cssClasses,l=e.templateProps;return 0===t.hits.length?Dn(Ni,f({},l,{templateKey:"empty",rootProps:{className:Pi(u.root,u.emptyRoot)},data:t})):Dn("div",{className:u.root},i&&Dn(Ni,f({},l,{templateKey:"showPreviousText",rootTagName:"button",rootProps:{className:Pi(u.loadPrevious,k({},u.disabledLoadPrevious,o)),disabled:o,onClick:a}})),Dn("ol",{className:u.list},n.map(function(e,t){return Dn(Ni,f({},l,{templateKey:"item",rootTagName:"li",rootProps:{className:u.item},key:e.objectID,data:W(W({},e),{},{__hitIndex:t}),bindEvent:r}))})),Dn(Ni,f({},l,{templateKey:"showMoreText",rootTagName:"button",rootProps:{className:Pi(u.loadMore,k({},u.disabledLoadMore,c)),disabled:c,onClick:s}})))}),Ra={item:'<a class="{{cssClasses.link}}" href="{{url}}"><span class="{{cssClasses.label}}">{{label}}</span><span class="{{cssClasses.count}}">{{#helpers.formatNumber}}{{count}}{{/helpers.formatNumber}}</span></a>',showMoreText:"\n    {{#isShowingMore}}\n      Show less\n    {{/isShowingMore}}\n    {{^isShowingMore}}\n      Show more\n    {{/isShowingMore}}\n  "},Sa=Ze({name:"menu"}),wa=St("Menu");function _a(e){var t=e.cssClasses,n=e.templateProps,r=e.items,i=e.refine,a=(be(r,function(e){return e.isRefined})||{value:""}).value;return Dn("div",{className:Pi(t.root,k({},t.noRefinementRoot,0===r.length))},Dn("select",{className:t.select,value:a,onChange:function(e){i(e.target.value)}},Dn(Ni,f({},n,{templateKey:"defaultOption",rootTagName:"option",rootProps:{value:"",className:t.option}})),r.map(function(e){return Dn(Ni,f({},n,{templateKey:"item",rootTagName:"option",rootProps:{value:e.value,className:t.option},key:e.value,data:e}))})))}var Pa={item:"{{label}} ({{#helpers.formatNumber}}{{count}}{{/helpers.formatNumber}})",defaultOption:"See all"},Na=Ze({name:"menu-select"}),xa=St("MenuSelect"),Ia={item:'<label class="{{cssClasses.label}}">\n  <input type="radio" class="{{cssClasses.radio}}" name="{{attribute}}"{{#isRefined}} checked{{/isRefined}} />\n  <span class="{{cssClasses.labelText}}">{{label}}</span>\n</label>'},Fa=Ze({name:"numeric-menu"}),Ta=St("NumericMenu");function Ca(n){function t(t){return function(e){de(e)||(e.preventDefault(),n.setCurrentPage(t))}}return Dn("div",{className:Pi(n.cssClasses.root,k({},n.cssClasses.noRefinementRoot,n.nbPages<=1))},Dn("ul",{className:n.cssClasses.list},n.showFirst&&Dn(Ea,{ariaLabel:"First",className:n.cssClasses.firstPageItem,isDisabled:n.isFirstPage,label:n.templates.first,pageNumber:0,createURL:n.createURL,cssClasses:n.cssClasses,createClickHandler:t}),n.showPrevious&&Dn(Ea,{ariaLabel:"Previous",className:n.cssClasses.previousPageItem,isDisabled:n.isFirstPage,label:n.templates.previous,pageNumber:n.currentPage-1,createURL:n.createURL,cssClasses:n.cssClasses,createClickHandler:t}),n.pages.map(function(e){return Dn(Ea,{key:e,ariaLabel:"".concat(e+1),className:n.cssClasses.pageItem,isSelected:e===n.currentPage,label:"".concat(e+1),pageNumber:e,createURL:n.createURL,cssClasses:n.cssClasses,createClickHandler:t})}),n.showNext&&Dn(Ea,{ariaLabel:"Next",className:n.cssClasses.nextPageItem,isDisabled:n.isLastPage,label:n.templates.next,pageNumber:n.currentPage+1,createURL:n.createURL,cssClasses:n.cssClasses,createClickHandler:t}),n.showLast&&Dn(Ea,{ariaLabel:"Last",className:n.cssClasses.lastPageItem,isDisabled:n.isLastPage,label:n.templates.last,pageNumber:n.nbPages-1,createURL:n.createURL,cssClasses:n.cssClasses,createClickHandler:t})))}function Ea(e){var t=e.label,n=e.ariaLabel,r=e.pageNumber,i=e.className,a=e.isDisabled,s=void 0!==a&&a,o=e.isSelected,c=void 0!==o&&o,u=e.cssClasses,l=e.createURL,d=e.createClickHandler;return Dn("li",{className:Pi(u.item,i,s&&u.disabledItem,c&&u.selectedItem)},s?Dn("span",{className:u.link,dangerouslySetInnerHTML:{__html:t}}):Dn("a",{className:u.link,"aria-label":n,href:l(r),onClick:d(r),dangerouslySetInnerHTML:{__html:t}}))}var ka,La,Ma,ja=St("Pagination"),Oa=Ze({name:"pagination"}),Aa={previous:"‹",next:"›",first:"«",last:"»"},Ha=0,Wa=[],Da=Cn.__b,Ba=Cn.__r,Ua=Cn.diffed,qa=Cn.__c,Qa=Cn.unmount;function $a(e,t){Cn.__h&&Cn.__h(La,e,Ha||t),Ha=0;var n=La.__H||(La.__H={__:[],__h:[]});return e>=n.__.length&&n.__.push({}),n.__[e]}function Va(e){return Ha=1,function(e,t,n){var r=$a(ka++,2);return r.t=e,r.__c||(r.__=[n?n(t):Za(void 0,t),function(e){var t=r.t(r.__[0],e);r.__[0]!==t&&(r.__=[t,r.__[1]],r.__c.setState({}))}],r.__c=La),r.__}(Za,e)}function Ka(e){return Ha=5,function(e,t){var n=$a(ka++,7);return Ga(n.__H,t)&&(n.__=e(),n.__H=t,n.__h=e),n.__}(function(){return{current:e}},[])}function za(){var t;for(Wa.sort(function(e,t){return e.__v.__b-t.__v.__b});t=Wa.pop();)if(t.__P)try{t.__H.__h.forEach(Ya),t.__H.__h.forEach(Xa),t.__H.__h=[]}catch(e){t.__H.__h=[],Cn.__e(e,t.__v)}}Cn.__b=function(e){La=null,Da&&Da(e)},Cn.__r=function(e){Ba&&Ba(e),ka=0;var t=(La=e.__c).__H;t&&(t.__h.forEach(Ya),t.__h.forEach(Xa),t.__h=[])},Cn.diffed=function(e){Ua&&Ua(e);var t=e.__c;t&&t.__H&&t.__H.__h.length&&(1!==Wa.push(t)&&Ma===Cn.requestAnimationFrame||((Ma=Cn.requestAnimationFrame)||function(e){function t(){clearTimeout(r),Ja&&cancelAnimationFrame(n),setTimeout(e)}var n,r=setTimeout(t,100);Ja&&(n=requestAnimationFrame(t))})(za)),La=null},Cn.__c=function(e,n){n.some(function(t){try{t.__h.forEach(Ya),t.__h=t.__h.filter(function(e){return!e.__||Xa(e)})}catch(e){n.some(function(e){e.__h&&(e.__h=[])}),n=[],Cn.__e(e,t.__v)}}),qa&&qa(e,n)},Cn.unmount=function(e){Qa&&Qa(e);var t,n=e.__c;n&&n.__H&&(n.__H.__.forEach(function(e){try{Ya(e)}catch(e){t=e}}),t&&Cn.__e(t,n.__v))};var Ja="function"==typeof requestAnimationFrame;function Ya(e){var t=La,n=e.__c;"function"==typeof n&&(e.__c=void 0,n()),La=t}function Xa(e){var t=La;e.__c=e.__(),La=t}function Ga(n,e){return!n||n.length!==e.length||e.some(function(e,t){return e!==n[t]})}function Za(e,t){return"function"==typeof t?t(e):t}function es(t){var e,n=D(Va(t.isCollapsed),2),r=n[0],i=n[1],a=D(Va(!1),2),s=a[0],o=a[1],c=Ka(null);return function(e,t){var n=$a(ka++,3);!Cn.__s&&Ga(n.__H,t)&&(n.__=e,n.__H=t,La.__H.__h.push(n))}(function(){var e=c.current;if(e)return e.appendChild(t.bodyElement),function(){e.removeChild(t.bodyElement)}},[c,t.bodyElement]),s||t.isCollapsed===r||i(t.isCollapsed),Dn("div",{className:Pi(t.cssClasses.root,(e={},k(e,t.cssClasses.noRefinementRoot,t.hidden),k(e,t.cssClasses.collapsibleRoot,t.collapsible),k(e,t.cssClasses.collapsedRoot,r),e)),hidden:t.hidden},t.templates.header&&Dn("div",{className:t.cssClasses.header},Dn(Ni,{templates:t.templates,templateKey:"header",rootTagName:"span",data:t.data}),t.collapsible&&Dn("button",{className:t.cssClasses.collapseButton,"aria-expanded":!r,onClick:function(e){e.preventDefault(),o(!0),i(function(e){return!e})}},Dn(Ni,{templates:t.templates,templateKey:"collapseButtonText",rootTagName:"span",data:{collapsed:r}}))),Dn("div",{className:t.cssClasses.body,ref:c}),t.templates.footer&&Dn(Ni,{templates:t.templates,templateKey:"footer",rootProps:{className:t.cssClasses.footer},data:t.data}))}function ts(e){var t=e.url,n=e.theme,r=e.cssClasses;return Dn("div",{className:r.root},Dn("a",{href:t,target:"_blank",className:r.link,"aria-label":"Search by Algolia",rel:"noopener noreferrer"},Dn("svg",{height:"1.2em",className:r.logo,viewBox:"0 0 168 24",style:{width:"auto"}},Dn("path",{fill:"dark"===n?"#FFF":"#5D6494",d:"M6.97 6.68V8.3a4.47 4.47 0 00-2.42-.67 2.2 2.2 0 00-1.38.4c-.34.26-.5.6-.5 1.02 0 .43.16.77.49 1.03.33.25.83.53 1.51.83a7.04 7.04 0 011.9 1.08c.34.24.58.54.73.89.15.34.23.74.23 1.18 0 .95-.33 1.7-1 2.24a4 4 0 01-2.6.81 5.71 5.71 0 01-2.94-.68v-1.71c.84.63 1.81.94 2.92.94.58 0 1.05-.14 1.39-.4.34-.28.5-.65.5-1.13 0-.29-.1-.55-.3-.8a2.2 2.2 0 00-.65-.53 23.03 23.03 0 00-1.64-.78 13.67 13.67 0 01-1.11-.64c-.12-.1-.28-.22-.46-.4a1.72 1.72 0 01-.39-.5 4.46 4.46 0 01-.22-.6c-.07-.23-.1-.48-.1-.75 0-.91.33-1.63 1-2.17a4 4 0 012.57-.8c.97 0 1.8.18 2.47.52zm7.47 5.7v-.3a2.26 2.26 0 00-.5-1.44c-.3-.35-.74-.53-1.32-.53-.53 0-.99.2-1.37.58a2.9 2.9 0 00-.72 1.68h3.91zm1 2.79v1.4c-.6.34-1.38.51-2.36.51a4.02 4.02 0 01-3-1.13 4.04 4.04 0 01-1.11-2.97c0-1.3.34-2.32 1.02-3.06a3.38 3.38 0 012.6-1.1c1.03 0 1.85.32 2.46.96.6.64.9 1.57.9 2.78 0 .33-.03.68-.09 1.04h-5.31c.1.7.4 1.24.89 1.61.49.38 1.1.56 1.85.56.86 0 1.58-.2 2.15-.6zm6.61-1.78h-1.21c-.6 0-1.05.12-1.35.36-.3.23-.46.53-.46.89 0 .37.12.66.36.88.23.2.57.32 1.02.32.5 0 .9-.15 1.2-.43.3-.28.44-.65.44-1.1v-.92zm-4.07-2.55V9.33a4.96 4.96 0 012.5-.55c2.1 0 3.17 1.03 3.17 3.08V17H22.1v-.96c-.42.68-1.15 1.02-2.19 1.02-.76 0-1.38-.22-1.84-.66-.46-.44-.7-1-.7-1.68 0-.78.3-1.38.88-1.81.59-.43 1.4-.65 2.46-.65h1.34v-.46c0-.55-.13-.97-.4-1.25-.26-.29-.7-.43-1.32-.43-.86 0-1.65.24-2.35.72zm9.34-1.93v1.42c.39-1 1.1-1.5 2.12-1.5.15 0 .31.02.5.05v1.53c-.23-.1-.48-.14-.76-.14-.54 0-.99.24-1.34.71a2.8 2.8 0 00-.52 1.71V17h-1.57V8.91h1.57zm5 4.09a3 3 0 00.76 2.01c.47.53 1.14.8 2 .8.64 0 1.24-.18 1.8-.53v1.4c-.53.32-1.2.48-2 .48a3.98 3.98 0 01-4.17-4.18c0-1.16.38-2.15 1.14-2.98a4 4 0 013.1-1.23c.7 0 1.34.15 1.92.44v1.44a3.24 3.24 0 00-1.77-.5A2.65 2.65 0 0032.33 13zm7.92-7.28v4.58c.46-1 1.3-1.5 2.5-1.5.8 0 1.42.24 1.9.73.48.5.72 1.17.72 2.05V17H43.8v-5.1c0-.56-.14-.99-.43-1.29-.28-.3-.65-.45-1.1-.45-.54 0-1 .2-1.42.6-.4.4-.61 1.02-.61 1.85V17h-1.56V5.72h1.56zM55.2 15.74c.6 0 1.1-.25 1.5-.76.4-.5.6-1.16.6-1.95 0-.92-.2-1.62-.6-2.12-.4-.5-.92-.74-1.55-.74-.56 0-1.05.22-1.5.67-.44.45-.66 1.13-.66 2.06 0 .96.22 1.67.64 2.14.43.47.95.7 1.57.7zM53 5.72v4.42a2.74 2.74 0 012.43-1.34c1.03 0 1.86.38 2.51 1.15.65.76.97 1.78.97 3.05 0 1.13-.3 2.1-.92 2.9-.62.81-1.47 1.21-2.54 1.21s-1.9-.45-2.46-1.34V17h-1.58V5.72H53zm9.9 11.1l-3.22-7.9h1.74l1 2.62 1.26 3.42c.1-.32.48-1.46 1.15-3.42l.91-2.63h1.66l-2.92 7.87c-.78 2.07-1.96 3.1-3.56 3.1-.28 0-.53-.02-.73-.07v-1.34c.17.04.35.06.54.06 1.03 0 1.76-.57 2.17-1.7z"}),as,ss,Dn("path",{fill:"dark"===n?"#FFF":"#5468FF",d:"M120.92 18.8c-4.38.02-4.38-3.54-4.38-4.1V1.36l2.67-.42v13.25c0 .32 0 2.36 1.71 2.37v2.24zm-10.84-2.18c.82 0 1.43-.04 1.85-.12v-2.72a5.48 5.48 0 00-1.57-.2c-.3 0-.6.02-.9.07-.3.04-.57.12-.81.24-.24.11-.44.28-.58.49a.93.93 0 00-.22.65c0 .63.22 1 .61 1.23.4.24.94.36 1.62.36zm-.23-9.7c.88 0 1.62.11 2.23.33.6.22 1.09.53 1.44.92.36.4.61.92.76 1.48.16.56.23 1.17.23 1.85v6.87a21.69 21.69 0 01-4.68.5c-.69 0-1.32-.07-1.9-.2a4 4 0 01-1.46-.63 3.3 3.3 0 01-.96-1.13 4.3 4.3 0 01-.34-1.8 3.13 3.13 0 011.43-2.63c.45-.3.95-.5 1.54-.62a8.8 8.8 0 013.79.05v-.44c0-.3-.04-.6-.11-.87a1.78 1.78 0 00-1.1-1.22 3.2 3.2 0 00-1.15-.2 9.75 9.75 0 00-2.95.46l-.33-2.19a11.43 11.43 0 013.56-.53zm52.84 9.63c.82 0 1.43-.05 1.85-.13V13.7a5.42 5.42 0 00-1.57-.2c-.3 0-.6.02-.9.07-.3.04-.57.12-.81.24-.24.12-.44.28-.58.5a.93.93 0 00-.22.65c0 .63.22.99.61 1.23.4.24.94.36 1.62.36zm-.23-9.7c.88 0 1.63.11 2.23.33.6.22 1.1.53 1.45.92.35.39.6.92.76 1.48.15.56.23 1.18.23 1.85v6.88c-.41.08-1.03.19-1.87.31-.83.12-1.77.18-2.81.18-.7 0-1.33-.06-1.9-.2a4 4 0 01-1.47-.63c-.4-.3-.72-.67-.95-1.13a4.3 4.3 0 01-.34-1.8c0-.66.13-1.08.38-1.53.26-.45.61-.82 1.05-1.1.44-.3.95-.5 1.53-.62a8.8 8.8 0 013.8.05v-.43c0-.31-.04-.6-.12-.88-.07-.28-.2-.52-.38-.73a1.78 1.78 0 00-.73-.5c-.3-.1-.68-.2-1.14-.2a9.85 9.85 0 00-2.95.47l-.32-2.19a11.63 11.63 0 013.55-.53zm-8.03-1.27a1.62 1.62 0 000-3.24 1.62 1.62 0 100 3.24zm1.35 13.22h-2.7V7.27l2.7-.42V18.8zm-4.72 0c-4.38.02-4.38-3.54-4.38-4.1l-.01-13.34 2.67-.42v13.25c0 .32 0 2.36 1.72 2.37v2.24zm-8.7-5.9a4.7 4.7 0 00-.74-2.79 2.4 2.4 0 00-2.07-1 2.4 2.4 0 00-2.06 1 4.7 4.7 0 00-.74 2.8c0 1.16.25 1.94.74 2.62a2.4 2.4 0 002.07 1.02c.88 0 1.57-.34 2.07-1.02a4.2 4.2 0 00.73-2.63zm2.74 0a6.46 6.46 0 01-1.52 4.23c-.49.53-1.07.94-1.76 1.22-.68.29-1.73.45-2.26.45a6.6 6.6 0 01-2.25-.45 5.1 5.1 0 01-2.88-3.13 7.3 7.3 0 01-.01-4.84 5.13 5.13 0 012.9-3.1 5.67 5.67 0 012.22-.42c.81 0 1.56.14 2.24.42.69.29 1.28.69 1.75 1.22.49.52.87 1.15 1.14 1.89a7 7 0 01.43 2.5zm-20.14 0c0 1.11.25 2.36.74 2.88.5.52 1.13.78 1.91.78a4.07 4.07 0 002.12-.6V9.33c-.19-.04-.99-.2-1.76-.23a2.67 2.67 0 00-2.23 1 4.73 4.73 0 00-.78 2.8zm7.44 5.27c0 1.82-.46 3.16-1.4 4-.94.85-2.37 1.27-4.3 1.27-.7 0-2.17-.13-3.34-.4l.43-2.11c.98.2 2.27.26 2.95.26 1.08 0 1.84-.22 2.3-.66.46-.43.68-1.08.68-1.94v-.44a5.2 5.2 0 01-2.54.6 5.6 5.6 0 01-2.01-.36 4.2 4.2 0 01-2.58-2.71 9.88 9.88 0 01.02-5.35 4.92 4.92 0 012.93-2.96 6.6 6.6 0 012.43-.46 19.64 19.64 0 014.43.66v10.6z"}))))}function ns(e){var t=e.cssClasses,n=e.templates,r=e.items;return Dn(Ni,{templateKey:"default",templates:n,rootProps:{className:t.root},data:{items:r}})}var rs=Ze({name:"panel"}),is=St("Panel"),as=Dn("path",{fill:"#5468FF",d:"M78.99.94h16.6a2.97 2.97 0 012.96 2.96v16.6a2.97 2.97 0 01-2.97 2.96h-16.6a2.97 2.97 0 01-2.96-2.96V3.9A2.96 2.96 0 0179 .94"}),ss=Dn("path",{fill:"#FFF",d:"M89.63 5.97v-.78a.98.98 0 00-.98-.97h-2.28a.98.98 0 00-.97.97V6c0 .09.08.15.17.13a7.13 7.13 0 013.9-.02c.08.02.16-.04.16-.13m-6.25 1L83 6.6a.98.98 0 00-1.38 0l-.46.46a.97.97 0 000 1.38l.38.39c.06.06.15.04.2-.02a7.49 7.49 0 011.63-1.62c.07-.04.08-.14.02-.2m4.16 2.45v3.34c0 .1.1.17.2.12l2.97-1.54c.06-.03.08-.12.05-.18a3.7 3.7 0 00-3.08-1.87c-.07 0-.14.06-.14.13m0 8.05a4.49 4.49 0 110-8.98 4.49 4.49 0 010 8.98m0-10.85a6.37 6.37 0 100 12.74 6.37 6.37 0 000-12.74"}),os=St("PoweredBy"),cs=Ze({name:"powered-by"}),us=Ze({name:"query-rule-context"}),ls={default:function(e){var t=e.items;return JSON.stringify(t,null,2)}},ds=Ze({name:"query-rule-custom-data"}),hs=St("QueryRuleCustomData"),fs=function(){L(a,qn);var i=O(a);function a(){var r;C(this,a);for(var e=arguments.length,t=new Array(e),n=0;n<e;n++)t[n]=arguments[n];return k(j(r=i.call.apply(i,[this].concat(t))),"state",{min:r.props.values.min,max:r.props.values.max}),k(j(r),"onInput",function(n){return function(e){var t=e.currentTarget.value;r.setState(k({},n,Number(t)))}}),k(j(r),"onSubmit",function(e){e.preventDefault(),r.props.refine([r.state.min,r.state.max])}),r}return E(a,[{key:"componentWillReceiveProps",value:function(e){this.setState({min:e.values.min,max:e.values.max})}},{key:"render",value:function(){var e=this.state,t=e.min,n=e.max,r=this.props,i=r.min,a=r.max,s=r.step,o=r.cssClasses,c=r.templateProps,u=!(!i||!a)&&a<=i,l=Boolean(t||n);return Dn("div",{className:Pi(o.root,k({},o.noRefinement,!l))},Dn("form",{className:o.form,onSubmit:this.onSubmit},Dn("label",{className:o.label},Dn("input",{className:Pi(o.input,o.inputMin),type:"number",min:i,max:a,step:s,value:null!=t?t:"",onInput:this.onInput("min"),placeholder:null==i?void 0:i.toString(),disabled:u})),Dn(Ni,f({},c,{templateKey:"separatorText",rootTagName:"span",rootProps:{className:o.separator}})),Dn("label",{className:o.label},Dn("input",{className:Pi(o.input,o.inputMax),type:"number",min:i,max:a,step:s,value:null!=n?n:"",onInput:this.onInput("max"),placeholder:null==a?void 0:a.toString(),disabled:u})),Dn(Ni,f({},c,{templateKey:"submitText",rootTagName:"button",rootProps:{type:"submit",className:o.submit,disabled:u}}))))}}]),a}(),ms=Ze({name:"range-input"}),ps=St("RangeInput"),gs={separatorText:"to",submitText:"Go"},vs=40,ys=35,bs=27,Rs=36,Ss=37,ws=34,_s=33,Ps=39,Ns=38,xs=100;function Is(e,t,n){return(e-t)/(n-t)*100}function Fs(e,t,n){var r=e/100;return 0===e?t:100===e?n:Math.round((n-t)*r+t)}function Ts(e){return["rheostat","vertical"===e.orientation?"rheostat-vertical":"rheostat-horizontal"].concat(e.className.split(" ")).join(" ")}function Cs(e){return Number(e.currentTarget.getAttribute("data-handle-key"))}function Es(e){e.stopPropagation(),e.preventDefault()}var ks=Dn("div",{className:"rheostat-background"}),Ls=function(){L(r,qn);var n=O(r);function r(e){var t;return C(this,r),k(j(t=n.call(this,e)),"state",{className:Ts(t.props),handlePos:t.props.values.map(function(e){return Is(e,t.props.min,t.props.max)}),handleDimensions:0,mousePos:null,sliderBox:{},slidingIndex:null,values:t.props.values}),k(j(t),"rheostat",{current:null}),t.getPublicState=t.getPublicState.bind(j(t)),t.getSliderBoundingBox=t.getSliderBoundingBox.bind(j(t)),t.getProgressStyle=t.getProgressStyle.bind(j(t)),t.getMinValue=t.getMinValue.bind(j(t)),t.getMaxValue=t.getMaxValue.bind(j(t)),t.getHandleDimensions=t.getHandleDimensions.bind(j(t)),t.getClosestSnapPoint=t.getClosestSnapPoint.bind(j(t)),t.getSnapPosition=t.getSnapPosition.bind(j(t)),t.getNextPositionForKey=t.getNextPositionForKey.bind(j(t)),t.getNextState=t.getNextState.bind(j(t)),t.handleClick=t.handleClick.bind(j(t)),t.getClosestHandle=t.getClosestHandle.bind(j(t)),t.setStartSlide=t.setStartSlide.bind(j(t)),t.startMouseSlide=t.startMouseSlide.bind(j(t)),t.startTouchSlide=t.startTouchSlide.bind(j(t)),t.handleMouseSlide=t.handleMouseSlide.bind(j(t)),t.handleTouchSlide=t.handleTouchSlide.bind(j(t)),t.handleSlide=t.handleSlide.bind(j(t)),t.endSlide=t.endSlide.bind(j(t)),t.handleKeydown=t.handleKeydown.bind(j(t)),t.validatePosition=t.validatePosition.bind(j(t)),t.validateValues=t.validateValues.bind(j(t)),t.canMove=t.canMove.bind(j(t)),t.fireChangeEvent=t.fireChangeEvent.bind(j(t)),t.slideTo=t.slideTo.bind(j(t)),t.updateNewValues=t.updateNewValues.bind(j(t)),t}return E(r,[{key:"componentWillReceiveProps",value:function(n){var e=this.props,t=e.className,r=e.disabled,i=e.min,a=e.max,s=e.orientation,o=this.state,c=o.values,u=o.slidingIndex,l=n.min!==i||n.max!==a,d=c.length!==n.values.length||c.some(function(e,t){return n.values[t]!==e}),h=n.className!==t||n.orientation!==s,f=n.disabled&&!r;h&&this.setState({className:Ts(n)}),(l||d)&&this.updateNewValues(n),f&&null!==u&&this.endSlide()}},{key:"getPublicState",value:function(){var e=this.props,t=e.min;return{max:e.max,min:t,values:this.state.values}}},{key:"getSliderBoundingBox",value:function(){var e=this.rheostat.current,t=e.getBoundingClientRect();return{height:t.height||e.clientHeight,left:t.left,top:t.top,width:t.width||e.clientWidth}}},{key:"getProgressStyle",value:function(e){var t=this.state.handlePos,n=t[e];if(0===e)return"vertical"===this.props.orientation?{height:"".concat(n,"%"),top:0}:{left:0,width:"".concat(n,"%")};var r=t[e-1],i=n-r;return"vertical"===this.props.orientation?{height:"".concat(i,"%"),top:"".concat(r,"%")}:{left:"".concat(r,"%"),width:"".concat(i,"%")}}},{key:"getMinValue",value:function(e){return this.state.values[e-1]?Math.max(this.props.min,this.state.values[e-1]):this.props.min}},{key:"getMaxValue",value:function(e){return this.state.values[e+1]?Math.min(this.props.max,this.state.values[e+1]):this.props.max}},{key:"getHandleDimensions",value:function(e,t){var n=e.currentTarget||null;return n?"vertical"===this.props.orientation?n.clientHeight/t.height*xs/2:n.clientWidth/t.width*xs/2:0}},{key:"getClosestSnapPoint",value:function(n){return this.props.snapPoints.length?this.props.snapPoints.reduce(function(e,t){return Math.abs(e-n)<Math.abs(t-n)?e:t}):n}},{key:"getSnapPosition",value:function(e){if(!this.props.snap)return e;var t=this.props,n=t.max,r=t.min,i=Fs(e,r,n);return Is(this.getClosestSnapPoint(i),r,n)}},{key:"getNextPositionForKey",value:function(e,t){var n,r=this.state,i=r.handlePos,a=r.values,s=this.props,o=s.max,c=s.min,u=s.snapPoints,l=this.props.snap,d=a[e],h=i[e],f=h,m=1;100<=o?h=Math.round(h):m=100/(o-c);var p=null;l&&(p=u.indexOf(this.getClosestSnapPoint(a[e])));var g=(k(n={},Ss,function(e){return-1*e}),k(n,Ps,function(e){return e}),k(n,Ns,function(e){return e}),k(n,vs,function(e){return-1*e}),k(n,ws,function(e){return 1<e?-e:-10*e}),k(n,_s,function(e){return 1<e?e:10*e}),n);if(Object.prototype.hasOwnProperty.call(g,t))h+=g[t](m),l&&p&&(f<h?p<u.length-1&&(d=u[p+1]):0<p&&(d=u[p-1]));else if(t===Rs)h=0,l&&(d=u[0]);else{if(t!==ys)return null;h=xs,l&&(d=u[u.length-1])}return l?Is(d,c,o):h}},{key:"getNextState",value:function(n,e){var t=this.state.handlePos,r=this.props,i=r.max,a=r.min,s=this.validatePosition(n,e),o=t.map(function(e,t){return t===n?s:e});return{handlePos:o,values:o.map(function(e){return Fs(e,a,i)})}}},{key:"getClosestHandle",value:function(r){var i=this.state.handlePos;return i.reduce(function(e,t,n){return Math.abs(i[n]-r)<Math.abs(i[e]-r)?n:e},0)}},{key:"setStartSlide",value:function(e,t,n){var r=this.getSliderBoundingBox();this.setState({handleDimensions:this.getHandleDimensions(e,r),mousePos:{x:t,y:n},sliderBox:r,slidingIndex:Cs(e)})}},{key:"startMouseSlide",value:function(e){this.setStartSlide(e,e.clientX,e.clientY),document.addEventListener("mousemove",this.handleMouseSlide,!1),document.addEventListener("mouseup",this.endSlide,!1),Es(e)}},{key:"startTouchSlide",value:function(e){if(!(1<e.changedTouches.length)){var t=e.changedTouches[0];this.setStartSlide(e,t.clientX,t.clientY),document.addEventListener("touchmove",this.handleTouchSlide,!1),document.addEventListener("touchend",this.endSlide,!1),this.props.onSliderDragStart&&this.props.onSliderDragStart(),Es(e)}}},{key:"handleMouseSlide",value:function(e){null!==this.state.slidingIndex&&(this.handleSlide(e.clientX,e.clientY),Es(e))}},{key:"handleTouchSlide",value:function(e){if(null!==this.state.slidingIndex)if(1<e.changedTouches.length)this.endSlide();else{var t=e.changedTouches[0];this.handleSlide(t.clientX,t.clientY),Es(e)}}},{key:"handleSlide",value:function(e,t){var n=this.state,r=n.slidingIndex,i=n.sliderBox,a="vertical"===this.props.orientation?(t-i.top)/i.height*xs:(e-i.left)/i.width*xs;this.slideTo(r,a),this.canMove(r,a)&&(this.setState({mousePos:{x:e,y:t}}),this.props.onSliderDragMove&&this.props.onSliderDragMove())}},{key:"endSlide",value:function(){var e=this,t=this.state.slidingIndex;if(this.setState({slidingIndex:null}),document.removeEventListener("mouseup",this.endSlide,!1),document.removeEventListener("touchend",this.endSlide,!1),document.removeEventListener("touchmove",this.handleTouchSlide,!1),document.removeEventListener("mousemove",this.handleMouseSlide,!1),this.props.onSliderDragEnd&&this.props.onSliderDragEnd(),this.props.snap){var n=this.getSnapPosition(this.state.handlePos[t]);this.slideTo(t,n,function(){return e.fireChangeEvent()})}else this.fireChangeEvent()}},{key:"handleClick",value:function(e){var t=this;if(!e.target.getAttribute("data-handle-key")){var n=this.getSliderBoundingBox(),r=("vertical"===this.props.orientation?(e.clientY-n.top)/n.height:(e.clientX-n.left)/n.width)*xs,i=this.getClosestHandle(r),a=this.getSnapPosition(r);this.slideTo(i,a,function(){return t.fireChangeEvent()}),this.props.onClick&&this.props.onClick()}}},{key:"handleKeydown",value:function(e){var t=this,n=Cs(e);if(e.keyCode!==bs){var r=this.getNextPositionForKey(n,e.keyCode);null!==r&&(this.canMove(n,r)&&(this.slideTo(n,r,function(){return t.fireChangeEvent()}),this.props.onKeyPress&&this.props.onKeyPress()),Es(e))}else e.currentTarget.blur()}},{key:"validatePosition",value:function(e,t){var n=this.state,r=n.handlePos,i=n.handleDimensions;return Math.max(Math.min(t,void 0!==r[e+1]?r[e+1]-i:xs),void 0!==r[e-1]?r[e-1]+i:0)}},{key:"validateValues",value:function(e,t){var n=t||this.props,i=n.max,a=n.min;return e.map(function(e,t,n){var r=Math.max(Math.min(e,i),a);return n.length&&r<n[t-1]?n[t-1]:r})}},{key:"canMove",value:function(e,t){var n=this.state,r=n.handlePos,i=n.handleDimensions;return!(t<0)&&(!(xs<t)&&(!((void 0!==r[e+1]?r[e+1]-i:1/0)<t)&&!(t<(void 0!==r[e-1]?r[e-1]+i:-1/0))))}},{key:"fireChangeEvent",value:function(){var e=this.props.onChange;e&&e(this.getPublicState())}},{key:"slideTo",value:function(e,t,n){var r=this,i=this.getNextState(e,t);this.setState(i,function(){var e=r.props.onValuesUpdated;e&&e(r.getPublicState()),n&&n()})}},{key:"updateNewValues",value:function(e){var t=this;if(null===this.state.slidingIndex){var n=e.max,r=e.min,i=e.values,a=this.validateValues(i,e);this.setState({handlePos:a.map(function(e){return Is(e,r,n)}),values:a},function(){return t.fireChangeEvent()})}}},{key:"render",value:function(){var r=this,e=this.props,t=e.children,i=e.disabled,a=e.handle,s=e.max,o=e.min,c=e.orientation,u=e.pitComponent,n=e.pitPoints,l=e.progressBar,d=this.state,h=d.className,f=d.handlePos,m=d.values;return Dn("div",{className:h,ref:this.rheostat,onClick:i?void 0:this.handleClick,style:{position:"relative"}},ks,f.map(function(e,t){var n="vertical"===c?{top:"".concat(e,"%"),position:"absolute"}:{left:"".concat(e,"%"),position:"absolute"};return Dn(a,{"aria-valuemax":r.getMaxValue(t),"aria-valuemin":r.getMinValue(t),"aria-valuenow":m[t],"aria-disabled":i,"data-handle-key":t,className:"rheostat-handle",key:"handle-".concat(t),onClick:Es,onKeyDown:i?void 0:r.handleKeydown,onMouseDown:i?void 0:r.startMouseSlide,onTouchStart:i?void 0:r.startTouchSlide,role:"slider",style:n,tabIndex:0})}),f.map(function(e,t,n){return 0===t&&1<n.length?null:Dn(l,{className:"rheostat-progress",key:"progress-bar-".concat(t),style:r.getProgressStyle(t)})}),u&&n.map(function(e){var t=Is(e,o,s),n="vertical"===c?{top:"".concat(t,"%"),position:"absolute"}:{left:"".concat(t,"%"),position:"absolute"};return Dn(u,{key:"pit-".concat(e),style:n},e)}),t)}}]),r}();k(Ls,"defaultProps",{className:"",children:null,disabled:!1,handle:function(e){return Dn("button",f({},e,{type:"button"}))},max:xs,min:0,onClick:null,onChange:null,onKeyPress:null,onSliderDragEnd:null,onSliderDragMove:null,onSliderDragStart:null,onValuesUpdated:null,orientation:"horizontal",pitComponent:null,pitPoints:[],progressBar:"div",snap:!1,snapPoints:[],values:[0]});function Ms(e){var t=e.style,n=e.children,r=Math.round(parseFloat(t.left)),i=[0,50,100].includes(r),a=n,s=Math.round(100*parseInt(a,10))/100;return Dn("div",{style:W(W({},t),{},{marginLeft:100===r?"-2px":0}),className:Pi("rheostat-marker","rheostat-marker-horizontal",{"rheostat-marker-large":i})},i&&Dn("div",{className:"rheostat-value"},s))}function js(e){var t=e.cssClasses,n=e.templates,r=e.isRelevantSorted,i=e.isVirtualReplica,a=e.refine;return i?Dn("div",{className:t.root},Dn(Ni,{templateKey:"text",templates:n,rootProps:{className:t.text},data:{isRelevantSorted:r}}),Dn("button",{type:"button",className:t.button,onClick:function(){a(r?0:void 0)}},Dn(Ni,{rootTagName:"span",templateKey:"button",templates:n,data:{isRelevantSorted:r}}))):null}function Os(e){var t=e.nbHits,n=e.nbSortedHits,r=e.cssClasses,i=e.templateProps,a=M(e,["nbHits","nbSortedHits","cssClasses","templateProps"]);return Dn("div",{className:Pi(r.root)},Dn(Ni,f({},i,{templateKey:"text",rootTagName:"span",rootProps:{className:r.text},data:W({hasManySortedResults:n&&1<n,hasNoSortedResults:0===n,hasOneSortedResults:1===n,hasManyResults:1<t,hasNoResults:0===t,hasOneResult:1===t,nbHits:t,nbSortedHits:n,cssClasses:r},a)})))}function As(e){var t=e.currentRefinement,n=e.refine,r=e.cssClasses,i=e.templateProps;return Dn("div",{className:r.root},Dn("label",{className:r.label},Dn("input",{className:r.checkbox,type:"checkbox",checked:t.isRefined,onChange:function(e){return n({isRefined:!e.target.checked})}}),Dn(Ni,f({},i,{rootTagName:"span",rootProps:{className:r.labelText},templateKey:"labelText",data:t}))))}function Hs(e){var t=e.cssClasses,n=e.isBrowserSupported,r=e.isListening,i=e.toggleListening,a=e.voiceListeningState,s=e.templates,o=a.status,c=a.transcript,u=a.isSpeechFinal,l=a.errorCode;return Dn("div",{className:t.root},Dn(Ni,{templateKey:"buttonText",rootTagName:"button",rootProps:{className:t.button,type:"button",title:"Search by voice".concat(n?"":" (not supported on this browser)"),onClick:function(e){e.currentTarget instanceof HTMLElement&&e.currentTarget.blur(),i()},disabled:!n},data:{status:o,errorCode:l,isListening:r,transcript:c,isSpeechFinal:u,isBrowserSupported:n},templates:s}),Dn(Ni,{templateKey:"status",rootProps:{className:t.status},data:{status:o,errorCode:l,isListening:r,transcript:c,isSpeechFinal:u,isBrowserSupported:n},templates:s}))}var Ws=function(){L(a,qn);var i=O(a);function a(){var n;C(this,a);for(var e=arguments.length,t=new Array(e),r=0;r<e;r++)t[r]=arguments[r];return k(j(n=i.call.apply(i,[this].concat(t))),"handleChange",function(e){var t=e.values;n.isDisabled||n.props.refine(t)}),k(j(n),"createHandleComponent",function(r){return function(e){var t=Math.round(100*parseFloat(e["aria-valuenow"]))/100,n="object"===h(r)&&r.format?r.format(t):t;return Dn("div",f({},e,{className:Pi(e.className,{"rheostat-handle-lower":0===e["data-handle-key"],"rheostat-handle-upper":1===e["data-handle-key"]})}),r&&Dn("div",{className:"rheostat-tooltip"},n))}}),n}return E(a,[{key:"isDisabled",get:function(){return this.props.min>=this.props.max}},{key:"computeDefaultPitPoints",value:function(e){var t=e.min,n=e.max,r=(n-t)/34;return[t].concat(P(Ee({end:33}).map(function(e){return t+r*(e+1)})),[n])}},{key:"computeSnapPoints",value:function(e){var t=e.min,n=e.max,r=e.step;if(r)return[].concat(P(Ee({start:t,end:n,step:r})),[n])}},{key:"render",value:function(){var e=this.props,t=e.tooltips,n=e.step,r=e.pips,i=e.values,a=e.cssClasses,s=this.isDisabled?{min:this.props.min,max:this.props.max+.001}:this.props,o=s.min,c=s.max,u=this.computeSnapPoints({min:o,max:c,step:n}),l=!1===r?[]:this.computeDefaultPitPoints({min:o,max:c});return Dn("div",{className:Pi(a.root,k({},a.disabledRoot,this.isDisabled))},Dn(Ls,{handle:this.createHandleComponent(t),onChange:this.handleChange,min:o,max:c,pitComponent:Ms,pitPoints:l,snap:!0,snapPoints:u,values:this.isDisabled?[o,c]:i,disabled:this.isDisabled}))}}]),a}(),Ds=Ze({name:"range-slider"}),Bs=St("RangeSlider"),Us={item:'{{#count}}<a class="{{cssClasses.link}}" aria-label="{{value}} & up" href="{{url}}">{{/count}}{{^count}}<div class="{{cssClasses.link}}" aria-label="{{value}} & up" disabled>{{/count}}\n  {{#stars}}<svg class="{{cssClasses.starIcon}} {{#.}}{{cssClasses.fullStarIcon}}{{/.}}{{^.}}{{cssClasses.emptyStarIcon}}{{/.}}" aria-hidden="true" width="24" height="24">\n    {{#.}}<use xlink:href="#ais-RatingMenu-starSymbol"></use>{{/.}}{{^.}}<use xlink:href="#ais-RatingMenu-starEmptySymbol"></use>{{/.}}\n  </svg>{{/stars}}\n  <span class="{{cssClasses.label}}">& Up</span>\n  {{#count}}<span class="{{cssClasses.count}}">{{#helpers.formatNumber}}{{count}}{{/helpers.formatNumber}}</span>{{/count}}\n{{#count}}</a>{{/count}}{{^count}}</div>{{/count}}'},qs=Ze({name:"rating-menu"}),Qs=St("RatingMenu"),$s=Dn("path",{d:"M12 .288l2.833 8.718h9.167l-7.417 5.389 2.833 8.718-7.416-5.388-7.417 5.388 2.833-8.718-7.416-5.389h9.167z"}),Vs=Dn("path",{d:"M12 6.76l1.379 4.246h4.465l-3.612 2.625 1.379 4.246-3.611-2.625-3.612 2.625 1.379-4.246-3.612-2.625h4.465l1.38-4.246zm0-6.472l-2.833 8.718h-9.167l7.416 5.389-2.833 8.718 7.417-5.388 7.416 5.388-2.833-8.718 7.417-5.389h-9.167l-2.833-8.718z"}),Ks={reset:'\n<svg class="{{cssClasses.resetIcon}}" viewBox="0 0 20 20" width="10" height="10">\n  <path d="M8.114 10L.944 2.83 0 1.885 1.886 0l.943.943L10 8.113l7.17-7.17.944-.943L20 1.886l-.943.943-7.17 7.17 7.17 7.17.943.944L18.114 20l-.943-.943-7.17-7.17-7.17 7.17-.944.943L0 18.114l.943-.943L8.113 10z"></path>\n</svg>\n  ',submit:'\n<svg class="{{cssClasses.submitIcon}}" width="10" height="10" viewBox="0 0 40 40">\n  <path d="M26.804 29.01c-2.832 2.34-6.465 3.746-10.426 3.746C7.333 32.756 0 25.424 0 16.378 0 7.333 7.333 0 16.378 0c9.046 0 16.378 7.333 16.378 16.378 0 3.96-1.406 7.594-3.746 10.426l10.534 10.534c.607.607.61 1.59-.004 2.202-.61.61-1.597.61-2.202.004L26.804 29.01zm-10.426.627c7.323 0 13.26-5.936 13.26-13.26 0-7.32-5.937-13.257-13.26-13.257C9.056 3.12 3.12 9.056 3.12 16.378c0 7.323 5.936 13.26 13.258 13.26z"></path>\n</svg>\n  ',loadingIndicator:'\n<svg class="{{cssClasses.loadingIcon}}" width="16" height="16" viewBox="0 0 38 38" stroke="#444">\n  <g fill="none" fillRule="evenodd">\n    <g transform="translate(1 1)" strokeWidth="2">\n      <circle strokeOpacity=".5" cx="18" cy="18" r="18" />\n      <path d="M36 18c0-9.94-8.06-18-18-18">\n        <animateTransform\n          attributeName="transform"\n          type="rotate"\n          from="0 18 18"\n          to="360 18 18"\n          dur="1s"\n          repeatCount="indefinite"\n        />\n      </path>\n    </g>\n  </g>\n</svg>\n  '},zs={item:'<label class="{{cssClasses.label}}">\n  <input type="checkbox"\n         class="{{cssClasses.checkbox}}"\n         value="{{value}}"\n         {{#isRefined}}checked{{/isRefined}} />\n  <span class="{{cssClasses.labelText}}">{{#isFromSearch}}{{{highlighted}}}{{/isFromSearch}}{{^isFromSearch}}{{highlighted}}{{/isFromSearch}}</span>\n  <span class="{{cssClasses.count}}">{{#helpers.formatNumber}}{{count}}{{/helpers.formatNumber}}</span>\n</label>',showMoreText:"\n    {{#isShowingMore}}\n      Show less\n    {{/isShowingMore}}\n    {{^isShowingMore}}\n      Show more\n    {{/isShowingMore}}\n    ",searchableNoResults:"No results"},Js=Ze({name:"refinement-list"}),Ys=St("RefinementList"),Xs=St("SearchBox"),Gs={text:"",button:function(e){return e.isRelevantSorted?"See all results":"See relevant results"}},Zs=Ze({name:"relevant-sort"}),eo=St("RelevantSort"),to=Ze({name:"search-box"}),no=St("SearchBox"),ro=Ze({name:"sort-by"}),io=St("SortBy"),ao=Ze({name:"stats"}),so=St("Stats"),oo={text:"\n    {{#areHitsSorted}}\n      {{#hasNoSortedResults}}No relevant results{{/hasNoSortedResults}}\n      {{#hasOneSortedResults}}1 relevant result{{/hasOneSortedResults}}\n      {{#hasManySortedResults}}{{#helpers.formatNumber}}{{nbSortedHits}}{{/helpers.formatNumber}} relevant results{{/hasManySortedResults}}\n      sorted out of {{#helpers.formatNumber}}{{nbHits}}{{/helpers.formatNumber}}\n    {{/areHitsSorted}}\n    {{^areHitsSorted}}\n      {{#hasNoResults}}No results{{/hasNoResults}}\n      {{#hasOneResult}}1 result{{/hasOneResult}}\n      {{#hasManyResults}}{{#helpers.formatNumber}}{{nbHits}}{{/helpers.formatNumber}} results{{/hasManyResults}}\n    {{/areHitsSorted}}\n    found in {{processingTimeMS}}ms"},co={labelText:"{{name}}"},uo=Ze({name:"toggle-refinement"}),lo=St("ToggleRefinement"),ho={buttonText:function(e){var t=e.status,n=e.errorCode,r=e.isListening;return'<svg\n       width="16"\n       height="16"\n       viewBox="0 0 24 24"\n       fill="none"\n       stroke="currentColor"\n       stroke-width="2"\n       stroke-linecap="round"\n       stroke-linejoin="round"\n     >\n       '.concat(function(e,t,n){return"error"===e&&"not-allowed"===t?'<line x1="1" y1="1" x2="23" y2="23"></line>\n            <path d="M9 9v3a3 3 0 0 0 5.12 2.12M15 9.34V4a3 3 0 0 0-5.94-.6"></path>\n            <path d="M17 16.95A7 7 0 0 1 5 12v-2m14 0v2a7 7 0 0 1-.11 1.23"></path>\n            <line x1="12" y1="19" x2="12" y2="23"></line>\n            <line x1="8" y1="23" x2="16" y2="23"></line>':'<path\n            d="M12 1a3 3 0 0 0-3 3v8a3 3 0 0 0 6 0V4a3 3 0 0 0-3-3z"\n            fill="'.concat(n?"currentColor":"none",'">\n          </path>\n          <path d="M19 10v2a7 7 0 0 1-14 0v-2"></path>\n          <line x1="12" y1="19" x2="12" y2="23"></line>\n          <line x1="8" y1="23" x2="16" y2="23"></line>')}(t,n,r),"\n     </svg>")},status:"<p>{{transcript}}</p>"},fo=Ze({name:"voice-search"}),mo=St("VoiceSearch"),po=Ie($i),go=Object.freeze({__proto__:null,dynamicWidgets:$i,EXPERIMENTAL_dynamicWidgets:po,analytics:function(e){var t=e||{},s=t.pushFunction,n=t.delay,r=void 0===n?3e3:n,i=t.triggerOnUIInteraction,a=void 0!==i&&i,o=t.pushInitialSearch,c=void 0===o||o,u=t.pushPagination,l=void 0!==u&&u;if(!s)throw new Error(_i("The `pushFunction` option is required."));function d(e){if(null!==e){var t=[],n=function(e){var t=[];for(var n in e)if(e.hasOwnProperty(n)){var r=e[n].join("+");t.push("".concat(encodeURIComponent(n),"=").concat(encodeURIComponent(n),"_").concat(encodeURIComponent(r)))}return t.join("&")}(W(W(W({},e.state.disjunctiveFacetsRefinements),e.state.facetsRefinements),e.state.hierarchicalFacetsRefinements)),r=function(e){var t=[];for(var n in e)if(e.hasOwnProperty(n)){var r=e[n];if(r.hasOwnProperty(">=")&&r.hasOwnProperty("<="))r[">="]&&r[">="][0]===r["<="]&&r["<="][0]?t.push("".concat(n,"=").concat(n,"_").concat(r[">="])):t.push("".concat(n,"=").concat(n,"_").concat(r[">="],"to").concat(r["<="]));else if(r.hasOwnProperty(">="))t.push("".concat(n,"=").concat(n,"_from").concat(r[">="]));else if(r.hasOwnProperty("<="))t.push("".concat(n,"=").concat(n,"_to").concat(r["<="]));else if(r.hasOwnProperty("=")){var i=[];for(var a in r["="])r["="].hasOwnProperty(a)&&i.push(r["="][a]);t.push("".concat(n,"=").concat(n,"_").concat(i.join("-")))}}return t.join("&")}(e.state.numericRefinements);""!==n&&t.push(n),""!==r&&t.push(r);var i=t.join("&"),a="Query: ".concat(e.state.query||"",", ").concat(i);!0===l&&(a+=", Page: ".concat(e.state.page||0)),m!==a&&(s(i,e.state,e.results),m=a)}}var h,f=null,m="",p=!0;!0===c&&(p=!1);function g(){d(f)}function v(){d(f)}return{$$type:"ais.analytics",$$widgetType:"ais.analytics",init:function(){!0===a&&(document.addEventListener("click",g),window.addEventListener("beforeunload",v))},render:function(e){var t=e.results,n=e.state;!0!==p?(f={results:t,state:n},h&&clearTimeout(h),h=window.setTimeout(function(){return d(f)},r)):p=!1},dispose:function(){!0===a&&(document.removeEventListener("click",g),window.removeEventListener("beforeunload",v))},getRenderState:function(e,t){return W(W({},e),{},{analytics:this.getWidgetRenderState(t)})},getWidgetRenderState:function(){return{widgetParams:e}}}},breadcrumb:function(e){var t=e||{},n=t.container,r=t.attributes,i=t.separator,a=t.rootPath,s=t.transformItems,o=t.templates,c=void 0===o?{}:o,u=t.cssClasses,l=void 0===u?{}:u;if(!n)throw new Error(ki("The `container` option is required."));var d=le(n),h={root:Pi(Li(),l.root),noRefinementRoot:Pi(Li({modifierName:"noRefinement"}),l.noRefinementRoot),list:Pi(Li({descendantName:"list"}),l.list),item:Pi(Li({descendantName:"item"}),l.item),selectedItem:Pi(Li({descendantName:"item",modifierName:"selected"}),l.selectedItem),separator:Pi(Li({descendantName:"separator"}),l.separator),link:Pi(Li({descendantName:"link"}),l.link)},f=function(e){var o=e.containerNode,c=e.cssClasses,u=e.renderState,l=e.templates;return function(e,t){var n=e.canRefine,r=e.createURL,i=e.instantSearchInstance,a=e.items,s=e.refine;t?u.templateProps=fe({defaultTemplates:Ei,templatesConfig:i.templatesConfig,templates:l}):sr(Dn(xi,{canRefine:n,cssClasses:c,createURL:r,items:a,refine:s,templateProps:u.templateProps}),o)}}({containerNode:d,cssClasses:h,renderState:{},templates:c});return W(W({},Wr(f,function(){return sr(null,d)})({attributes:r,separator:i,rootPath:a,transformItems:s})),{},{$$widgetType:"ais.breadcrumb"})},clearRefinements:function(e){var t=e||{},n=t.container,r=t.templates,i=void 0===r?{}:r,a=t.includedAttributes,s=t.excludedAttributes,o=t.transformItems,c=t.cssClasses,u=void 0===c?{}:c;if(!n)throw new Error(ji("The `container` option is required."));var l=le(n),d={root:Pi(Oi(),u.root),button:Pi(Oi({descendantName:"button"}),u.button),disabledButton:Pi(Oi({descendantName:"button",modifierName:"disabled"}),u.disabledButton)},h=function(e){var a=e.containerNode,s=e.cssClasses,o=e.renderState,c=e.templates;return function(e,t){var n=e.refine,r=e.hasRefinements,i=e.instantSearchInstance;t?o.templateProps=fe({defaultTemplates:Mi,templatesConfig:i.templatesConfig,templates:c}):sr(Dn(Ii,{refine:n,cssClasses:s,hasRefinements:r,templateProps:o.templateProps}),a)}}({containerNode:l,cssClasses:d,renderState:{},templates:i});return W(W({},fn(h,function(){return sr(null,l)})({includedAttributes:a,excludedAttributes:s,transformItems:o})),{},{$$widgetType:"ais.clearRefinements"})},configure:function(e){return W(W({},ai(xe)({searchParameters:e})),{},{$$widgetType:"ais.configure"})},currentRefinements:function(e){var t=e||{},n=t.container,r=t.includedAttributes,i=t.excludedAttributes,a=t.cssClasses,s=void 0===a?{}:a,o=t.transformItems;if(!n)throw new Error(Ai("The `container` option is required."));var c=le(n),u={root:Pi(Hi(),s.root),list:Pi(Hi({descendantName:"list"}),s.list),item:Pi(Hi({descendantName:"item"}),s.item),label:Pi(Hi({descendantName:"label"}),s.label),category:Pi(Hi({descendantName:"category"}),s.category),categoryLabel:Pi(Hi({descendantName:"categoryLabel"}),s.categoryLabel),delete:Pi(Hi({descendantName:"delete"}),s.delete)};return W(W({},gn(Ti,function(){return sr(null,c)})({container:c,cssClasses:u,includedAttributes:r,excludedAttributes:i,transformItems:o})),{},{$$widgetType:"ais.currentRefinements"})},EXPERIMENTAL_answers:function(e){var t=e||{},n=t.container,r=t.attributesForPrediction,i=t.queryLanguages,a=t.nbHits,s=t.searchDebounceTime,o=t.renderDebounceTime,c=t.escapeHTML,u=t.extraParameters,l=t.templates,d=void 0===l?{}:l,h=t.cssClasses,f=void 0===h?{}:h;if(!n)throw new Error(Di("The `container` option is required."));var m=le(n),p={root:Pi(Bi(),f.root),emptyRoot:Pi(Bi({modifierName:"empty"}),f.emptyRoot),header:Pi(Bi({descendantName:"header"}),f.header),loader:Pi(Bi({descendantName:"loader"}),f.loader),list:Pi(Bi({descendantName:"list"}),f.list),item:Pi(Bi({descendantName:"item"}),f.item)},g=function(e){var a=e.containerNode,s=e.cssClasses,o=e.renderState,c=e.templates;return function(e,t){var n=e.hits,r=e.isLoading,i=e.instantSearchInstance;t?o.templateProps=fe({defaultTemplates:Wi,templatesConfig:i.templatesConfig,templates:c}):sr(Dn(Ci,{cssClasses:s,hits:n,isLoading:r,templateProps:o.templateProps}),a)}}({containerNode:m,cssClasses:p,templates:d,renderState:{}});return W(W({},gi(g,function(){return sr(null,m)})({attributesForPrediction:r,queryLanguages:i,nbHits:a,searchDebounceTime:s,renderDebounceTime:o,escapeHTML:c,extraParameters:u})),{},{$$widgetType:"ais.answers"})},EXPERIMENTAL_configureRelatedItems:function(e){return W(W({},ci(xe)(e)),{},{$$widgetType:"ais.configureRelatedItems"})},geoSearch:function(e){var t=e||{},n=t.initialZoom,r=void 0===n?1:n,i=t.initialPosition,a=void 0===i?{lat:0,lng:0}:i,s=t.templates,o=void 0===s?{}:s,c=t.cssClasses,u=void 0===c?{}:c,l=t.builtInMarker,d=void 0===l?{}:l,h=t.customHTMLMarker,f=t.enableRefine,m=void 0===f||f,p=t.enableClearMapRefinement,g=void 0===p||p,v=t.enableRefineControl,y=void 0===v||v,b=t.container,R=t.googleReference,S=M(t,["initialZoom","initialPosition","templates","cssClasses","builtInMarker","customHTMLMarker","enableRefine","enableClearMapRefinement","enableRefineControl","container","googleReference"]);if(!b)throw new Error(Zi("The `container` option is required."));if(!R)throw new Error(Zi("The `googleReference` option is required."));var w=le(b),_={root:Pi(ea(),u.root),tree:ea({descendantName:"tree"}),map:Pi(ea({descendantName:"map"}),u.map),control:Pi(ea({descendantName:"control"}),u.control),label:Pi(ea({descendantName:"label"}),u.label),selectedLabel:Pi(ea({descendantName:"label",modifierName:"selected"}),u.selectedLabel),input:Pi(ea({descendantName:"input"}),u.input),redo:Pi(ea({descendantName:"redo"}),u.redo),disabledRedo:Pi(ea({descendantName:"redo",modifierName:"disabled"}),u.disabledRedo),reset:Pi(ea({descendantName:"reset"}),u.reset)},P=W(W({},Gi),o),N=W(W({},{createOptions:function(){return{}},events:{}}),d),x=(Boolean(h)||Boolean(o.HTMLMarker))&&W(W({},{createOptions:function(){return{}},events:{}}),h),I=function(d){return function(){L(l,d.maps.OverlayView);var u=O(l);function l(e){var t,n=e.__id,r=e.position,i=e.map,a=e.template,s=e.className,o=e.anchor,c=void 0===o?{x:0,y:0}:o;return C(this,l),k(j(t=u.call(this)),"__id",void 0),k(j(t),"anchor",void 0),k(j(t),"offset",void 0),k(j(t),"listeners",void 0),k(j(t),"latLng",void 0),k(j(t),"element",void 0),t.__id=n,t.anchor=c,t.listeners={},t.latLng=new d.maps.LatLng(r),t.element=document.createElement("div"),t.element.className=s,t.element.style.position="absolute",t.element.innerHTML=a,t.setMap(i),t}return E(l,[{key:"onAdd",value:function(){this.getPanes().overlayMouseTarget.appendChild(this.element);var e=this.element.getBoundingClientRect();this.offset={x:this.anchor.x+e.width/2,y:this.anchor.y+e.height},this.element.style.width="".concat(e.width,"px")}},{key:"draw",value:function(){var e=this.getProjection().fromLatLngToDivPixel(this.latLng);this.element.style.left="".concat(Math.round(e.x-this.offset.x),"px"),this.element.style.top="".concat(Math.round(e.y-this.offset.y),"px"),this.element.style.zIndex=String(parseInt(this.element.style.top,10))}},{key:"onRemove",value:function(){var t=this;this.element&&(this.element.parentNode.removeChild(this.element),Object.keys(this.listeners).forEach(function(e){t.element.removeEventListener(e,t.listeners[e])}),delete this.element,delete this.listeners)}},{key:"addListener",value:function(e,t){this.listeners[e]=t;var n=this.element;return n.addEventListener(e,t),{remove:function(){return n.removeEventListener(e,t)}}}},{key:"getPosition",value:function(){return this.latLng}}]),l}()}(R),F=x?function(e){var t=e.item,n=M(e,["item"]);return new I(W(W(W({},x.createOptions(t)),n),{},{__id:t.objectID,position:t._geoloc,className:Pi(ea({descendantName:"marker"})),template:ye({templateKey:"HTMLMarker",templates:P,data:t})}))}:function(e){var t=e.item,n=M(e,["item"]);return new R.maps.Marker(W(W(W({},N.createOptions(t)),n),{},{__id:t.objectID,position:t._geoloc}))},T=x||N;return W(W({},Zr(Xi,function(){return sr(null,w)})(W(W({},S),{},{renderState:{},container:w,googleReference:R,initialZoom:r,initialPosition:a,templates:P,cssClasses:_,createMarker:F,markerOptions:T,enableRefine:m,enableClearMapRefinement:g,enableRefineControl:y}))),{},{$$widgetType:"ais.geoSearch"})},hierarchicalMenu:function(e){var t=e||{},n=t.container,r=t.attributes,i=t.separator,a=t.rootPath,s=t.showParentLevel,o=t.limit,c=t.showMore,u=void 0!==c&&c,l=t.showMoreLimit,d=t.sortBy,h=t.transformItems,f=t.templates,m=void 0===f?{}:f,p=t.cssClasses,g=void 0===p?{}:p;if(!n)throw new Error(oa("The `container` option is required."));var v=le(n),y=function(e){var u=e.cssClasses,l=e.containerNode,d=e.showMore,h=e.templates,f=e.renderState;return function(e,t){var n=e.createURL,r=e.items,i=e.refine,a=e.instantSearchInstance,s=e.isShowingMore,o=e.toggleShowMore,c=e.canToggleShowMore;t?f.templateProps=fe({defaultTemplates:sa,templatesConfig:a.templatesConfig,templates:h}):sr(Dn(aa,{createURL:n,cssClasses:u,facetValues:r,templateProps:f.templateProps,toggleRefinement:i,showMore:d,toggleShowMore:o,isShowingMore:s,canToggleShowMore:c}),l)}}({cssClasses:{root:Pi(ca(),g.root),noRefinementRoot:Pi(ca({modifierName:"noRefinement"}),g.noRefinementRoot),list:Pi(ca({descendantName:"list"}),g.list),childList:Pi(ca({descendantName:"list",modifierName:"child"}),g.childList),item:Pi(ca({descendantName:"item"}),g.item),selectedItem:Pi(ca({descendantName:"item",modifierName:"selected"}),g.selectedItem),parentItem:Pi(ca({descendantName:"item",modifierName:"parent"}),g.parentItem),link:Pi(ca({descendantName:"link"}),g.link),label:Pi(ca({descendantName:"label"}),g.label),count:Pi(ca({descendantName:"count"}),g.count),showMore:Pi(ca({descendantName:"showMore"}),g.showMore),disabledShowMore:Pi(ca({descendantName:"showMore",modifierName:"disabled"}),g.disabledShowMore)},containerNode:v,templates:m,showMore:u,renderState:{}});return W(W({},wn(y,function(){return sr(null,v)})({attributes:r,separator:i,rootPath:a,showParentLevel:s,limit:o,showMore:u,showMoreLimit:l,sortBy:d,transformItems:h})),{},{$$widgetType:"ais.hierarchicalMenu"})},hits:function(e){var t=e||{},n=t.container,r=t.escapeHTML,i=t.transformItems,a=t.templates,s=void 0===a?{}:a,o=t.cssClasses,c=void 0===o?{}:o;if(!n)throw new Error(la("The `container` option is required."));var u=le(n),l={root:Pi(da(),c.root),emptyRoot:Pi(da({modifierName:"empty"}),c.emptyRoot),list:Pi(da({descendantName:"list"}),c.list),item:Pi(da({descendantName:"item"}),c.item)},d=function(e){var o=e.renderState,c=e.cssClasses,u=e.containerNode,l=e.templates;return function(e,t){var n=e.hits,r=e.results,i=e.instantSearchInstance,a=e.insights,s=e.bindEvent;t?o.templateProps=fe({defaultTemplates:ua,templatesConfig:i.templatesConfig,templates:l}):sr(Dn(ha,{cssClasses:c,hits:n,results:r,templateProps:o.templateProps,insights:a,sendEvent:function(e){i.sendEventToInsights(e)},bindEvent:s}),u)}}({containerNode:u,cssClasses:l,renderState:{},templates:s});return W(W({},Fn(_n)(d,function(){return sr(null,u)})({escapeHTML:r,transformItems:i})),{},{$$widgetType:"ais.hits"})},hitsPerPage:function(e){var t=e||{},n=t.container,r=t.items,i=t.cssClasses,a=void 0===i?{}:i,s=t.transformItems;if(!n)throw new Error(ma("The `container` option is required."));var o=le(n),c={root:Pi(pa(),a.root),select:Pi(pa({descendantName:"select"}),a.select),option:Pi(pa({descendantName:"option"}),a.option)},u=function(e){var a=e.containerNode,s=e.cssClasses;return function(e,t){var n=e.items,r=e.refine;if(!t){var i=(be(n,function(e){return e.isRefined})||{}).value;sr(Dn("div",{className:s.root},Dn(fa,{cssClasses:s,currentValue:i,options:n,setValue:r})),a)}}}({containerNode:o,cssClasses:c});return W(W({},ur(u,function(){return sr(null,o)})({items:r,transformItems:s})),{},{$$widgetType:"ais.hitsPerPage"})},index:bt,infiniteHits:function(e){var t=e||{},n=t.container,r=t.escapeHTML,i=t.transformItems,a=t.templates,s=void 0===a?{}:a,o=t.cssClasses,c=void 0===o?{}:o,u=t.showPrevious,l=t.cache;if(!n)throw new Error(va("The `container` option is required."));var d=le(n),h={root:Pi(ya(),c.root),emptyRoot:Pi(ya({modifierName:"empty"}),c.emptyRoot),item:Pi(ya({descendantName:"item"}),c.item),list:Pi(ya({descendantName:"list"}),c.list),loadPrevious:Pi(ya({descendantName:"loadPrevious"}),c.loadPrevious),disabledLoadPrevious:Pi(ya({descendantName:"loadPrevious",modifierName:"disabled"}),c.disabledLoadPrevious),loadMore:Pi(ya({descendantName:"loadMore"}),c.loadMore),disabledLoadMore:Pi(ya({descendantName:"loadMore",modifierName:"disabled"}),c.disabledLoadMore)},f=function(e){var d=e.containerNode,h=e.cssClasses,f=e.renderState,m=e.templates,p=e.showPrevious;return function(e,t){var n=e.hits,r=e.results,i=e.showMore,a=e.showPrevious,s=e.isFirstPage,o=e.isLastPage,c=e.instantSearchInstance,u=e.insights,l=e.bindEvent;t?f.templateProps=fe({defaultTemplates:ga,templatesConfig:c.templatesConfig,templates:m}):sr(Dn(ba,{cssClasses:h,hits:n,results:r,hasShowPrevious:p,showPrevious:a,showMore:i,templateProps:f.templateProps,isFirstPage:s,isLastPage:o,insights:u,sendEvent:function(e){c.sendEventToInsights(e)},bindEvent:l}),d)}}({containerNode:d,cssClasses:h,templates:s,showPrevious:u,renderState:{}});return W(W({},Fn(mr)(f,function(){return sr(null,d)})({escapeHTML:r,transformItems:i,showPrevious:u,cache:l})),{},{$$widgetType:"ais.infiniteHits"})},menu:function(e){var t=e||{},n=t.container,r=t.attribute,i=t.sortBy,a=t.limit,s=t.showMore,o=t.showMoreLimit,c=t.cssClasses,u=void 0===c?{}:c,l=t.templates,d=void 0===l?{}:l,h=t.transformItems;if(!n)throw new Error(Sa("The `container` option is required."));var f=le(n),m={root:Pi(wa(),u.root),noRefinementRoot:Pi(wa({modifierName:"noRefinement"}),u.noRefinementRoot),list:Pi(wa({descendantName:"list"}),u.list),item:Pi(wa({descendantName:"item"}),u.item),selectedItem:Pi(wa({descendantName:"item",modifierName:"selected"}),u.selectedItem),link:Pi(wa({descendantName:"link"}),u.link),label:Pi(wa({descendantName:"label"}),u.label),count:Pi(wa({descendantName:"count"}),u.count),showMore:Pi(wa({descendantName:"showMore"}),u.showMore),disabledShowMore:Pi(wa({descendantName:"showMore",modifierName:"disabled"}),u.disabledShowMore)},p=function(e){var l=e.containerNode,d=e.cssClasses,h=e.renderState,f=e.templates,m=e.showMore;return function(e,t){var n=e.refine,r=e.items,i=e.createURL,a=e.instantSearchInstance,s=e.isShowingMore,o=e.toggleShowMore,c=e.canToggleShowMore;if(t)h.templateProps=fe({defaultTemplates:Ra,templatesConfig:a.templatesConfig,templates:f});else{var u=r.map(function(e){return W(W({},e),{},{url:i(e.value)})});sr(Dn(aa,{createURL:i,cssClasses:d,facetValues:u,showMore:m,templateProps:h.templateProps,toggleRefinement:n,toggleShowMore:o,isShowingMore:s,canToggleShowMore:c}),l)}}}({containerNode:f,cssClasses:m,renderState:{},templates:d,showMore:s});return W(W({},pr(p,function(){return sr(null,f)})({attribute:r,limit:a,showMore:s,showMoreLimit:o,sortBy:i,transformItems:h})),{},{$$widgetType:"ais.menu"})},menuSelect:function(e){var t=e||{},n=t.container,r=t.attribute,i=t.sortBy,a=void 0===i?["name:asc"]:i,s=t.limit,o=void 0===s?10:s,c=t.cssClasses,u=void 0===c?{}:c,l=t.templates,d=void 0===l?{}:l,h=t.transformItems;if(!n)throw new Error(Na("The `container` option is required."));var f=le(n),m={root:Pi(xa(),u.root),noRefinementRoot:Pi(xa({modifierName:"noRefinement"}),u.noRefinementRoot),select:Pi(xa({descendantName:"select"}),u.select),option:Pi(xa({descendantName:"option"}),u.option)},p=function(e){var a=e.containerNode,s=e.cssClasses,o=e.renderState,c=e.templates;return function(e,t){var n=e.refine,r=e.items,i=e.instantSearchInstance;t?o.templateProps=fe({defaultTemplates:Pa,templatesConfig:i.templatesConfig,templates:c}):sr(Dn(_a,{cssClasses:s,items:r,refine:n,templateProps:o.templateProps}),a)}}({containerNode:f,cssClasses:m,renderState:{},templates:d});return W(W({},pr(p,function(){return sr(null,f)})({attribute:r,limit:o,sortBy:a,transformItems:h})),{},{$$widgetType:"ais.menuSelect"})},numericMenu:function(e){var t=e||{},n=t.container,r=t.attribute,i=t.items,a=t.cssClasses,s=void 0===a?{}:a,o=t.templates,c=void 0===o?{}:o,u=t.transformItems;if(!n)throw new Error(Fa("The `container` option is required."));var l=le(n),d={root:Pi(Ta(),s.root),noRefinementRoot:Pi(Ta({modifierName:"noRefinement"}),s.noRefinementRoot),list:Pi(Ta({descendantName:"list"}),s.list),item:Pi(Ta({descendantName:"item"}),s.item),selectedItem:Pi(Ta({descendantName:"item",modifierName:"selected"}),s.selectedItem),label:Pi(Ta({descendantName:"label"}),s.label),radio:Pi(Ta({descendantName:"radio"}),s.radio),labelText:Pi(Ta({descendantName:"labelText"}),s.labelText)},h=function(e){var s=e.containerNode,o=e.attribute,c=e.cssClasses,u=e.renderState,l=e.templates;return function(e,t){var n=e.createURL,r=e.instantSearchInstance,i=e.refine,a=e.items;t?u.templateProps=fe({defaultTemplates:Ia,templatesConfig:r.templatesConfig,templates:l}):sr(Dn(aa,{createURL:n,cssClasses:c,facetValues:a,templateProps:u.templateProps,toggleRefinement:i,attribute:o}),s)}}({containerNode:l,attribute:r,cssClasses:d,renderState:{},templates:c});return W(W({},gr(h,function(){return sr(null,l)})({attribute:r,items:i,transformItems:u})),{},{$$widgetType:"ais.numericMenu"})},pagination:function(e){var t=e||{},n=t.container,r=t.templates,i=void 0===r?{}:r,a=t.cssClasses,s=void 0===a?{}:a,o=t.totalPages,c=t.padding,u=t.showFirst,l=void 0===u||u,d=t.showLast,h=void 0===d||d,f=t.showPrevious,m=void 0===f||f,p=t.showNext,g=void 0===p||p,v=t.scrollTo,y=void 0===v?"body":v;if(!n)throw new Error(Oa("The `container` option is required."));var b=le(n),R=!0===y?"body":y,S=!1!==R&&le(R),w={root:Pi(ja(),s.root),noRefinementRoot:Pi(ja({modifierName:"noRefinement"}),s.noRefinementRoot),list:Pi(ja({descendantName:"list"}),s.list),item:Pi(ja({descendantName:"item"}),s.item),firstPageItem:Pi(ja({descendantName:"item",modifierName:"firstPage"}),s.firstPageItem),lastPageItem:Pi(ja({descendantName:"item",modifierName:"lastPage"}),s.lastPageItem),previousPageItem:Pi(ja({descendantName:"item",modifierName:"previousPage"}),s.previousPageItem),nextPageItem:Pi(ja({descendantName:"item",modifierName:"nextPage"}),s.nextPageItem),pageItem:Pi(ja({descendantName:"item",modifierName:"page"}),s.pageItem),selectedItem:Pi(ja({descendantName:"item",modifierName:"selected"}),s.selectedItem),disabledItem:Pi(ja({descendantName:"item",modifierName:"disabled"}),s.disabledItem),link:Pi(ja({descendantName:"link"}),s.link)},_=W(W({},Aa),i),P=function(e){var u=e.containerNode,l=e.cssClasses,d=e.templates,h=e.showFirst,f=e.showLast,m=e.showPrevious,p=e.showNext,g=e.scrollToNode;return function(e,t){var n=e.createURL,r=e.currentRefinement,i=e.nbPages,a=e.pages,s=e.isFirstPage,o=e.isLastPage,c=e.refine;if(!t){sr(Dn(Ca,{createURL:n,cssClasses:l,currentPage:r,templates:d,nbPages:i,pages:a,isFirstPage:s,isLastPage:o,setCurrentPage:function(e){c(e),!1!==g&&g.scrollIntoView()},showFirst:h,showLast:f,showPrevious:m,showNext:p}),u)}}}({containerNode:b,cssClasses:w,templates:_,showFirst:l,showLast:h,showPrevious:m,showNext:g,scrollToNode:S});return W(W({},Nr(P,function(){return sr(null,b)})({totalPages:o,padding:c})),{},{$$widgetType:"ais.pagination"})},panel:function(e){var t=e||{},n=t.templates,r=void 0===n?{}:n,i=t.hidden,c=void 0===i?function(){return!1}:i,a=t.collapsed,s=t.cssClasses,o=void 0===s?{}:s,u=document.createElement("div"),l=Boolean(a),d="function"==typeof a?a:function(){return!1},h={root:Pi(is(),o.root),noRefinementRoot:Pi(is({modifierName:"noRefinement"}),o.noRefinementRoot),collapsibleRoot:Pi(is({modifierName:"collapsible"}),o.collapsibleRoot),collapsedRoot:Pi(is({modifierName:"collapsed"}),o.collapsedRoot),collapseButton:Pi(is({descendantName:"collapseButton"}),o.collapseButton),collapseIcon:Pi(is({descendantName:"collapseIcon"}),o.collapseIcon),body:Pi(is({descendantName:"body"}),o.body),header:Pi(is({descendantName:"header"}),o.header),footer:Pi(is({descendantName:"footer"}),o.footer)};return function(t){return function(e){if(!e||!e.container)throw new Error(rs("The `container` option is required in the widget within the panel."));var i=le(e.container),s=function(e){var a=e.containerNode,s=e.bodyContainerNode,o=e.cssClasses,c=e.templates;return function(e){var t=e.options,n=e.hidden,r=e.collapsible,i=e.collapsed;sr(Dn(es,{cssClasses:o,hidden:n,collapsible:r,isCollapsed:i,templates:c,data:t,bodyElement:s}),a)}}({containerNode:i,bodyContainerNode:u,cssClasses:h,templates:W(W({},{header:"",footer:"",collapseButtonText:function(e){var t=e.collapsed;return'<svg\n          class="'.concat(h.collapseIcon,'"\n          width="1em"\n          height="1em"\n          viewBox="0 0 500 500"\n        >\n        <path d="').concat(t?"M100 250l300-150v300z":"M250 400l150-300H100z",'" fill="currentColor" />\n        </svg>')}}),r)}),o=t(W(W({},e),{},{container:u}));return W(W({},o),{},{init:function(){for(var e=arguments.length,t=new Array(e),n=0;n<e;n++)t[n]=arguments[n];var r,i=t[0],a=W(W({},o.getWidgetRenderState?o.getWidgetRenderState(i):{}),i);s({options:a,hidden:!0,collapsible:l,collapsed:!1}),"function"==typeof o.init&&(r=o.init).call.apply(r,[this].concat(t))},render:function(){for(var e=arguments.length,t=new Array(e),n=0;n<e;n++)t[n]=arguments[n];var r,i=t[0],a=W(W({},o.getWidgetRenderState?o.getWidgetRenderState(i):{}),i);s({options:a,hidden:Boolean(c(a)),collapsible:l,collapsed:Boolean(d(a))}),"function"==typeof o.render&&(r=o.render).call.apply(r,[this].concat(t))},dispose:function(){if(sr(null,i),"function"==typeof o.dispose){for(var e,t=arguments.length,n=new Array(t),r=0;r<t;r++)n[r]=arguments[r];return(e=o.dispose).call.apply(e,[this].concat(n))}}})}}},places:function(e){var t=e||{},n=t.placesReference,r=t.defaultPosition,o=void 0===r?[]:r,i=M(t,["placesReference","defaultPosition"]);if("function"!=typeof n)throw new Error("The `placesReference` option requires a valid Places.js reference.");var c=n(i),u={query:"",initialLatLngViaIP:void 0,isInitialLatLngViaIPSet:!1};return{$$type:"ais.places",$$widgetType:"ais.places",init:function(e){var s=e.helper;c.on("change",function(e){var t=e.suggestion,n=t.value,r=t.latlng,i=r.lat,a=r.lng;u.query=n,s.setQueryParameter("insideBoundingBox",void 0).setQueryParameter("aroundLatLngViaIP",!1).setQueryParameter("aroundLatLng","".concat(i,",").concat(a)).search()}),c.on("clear",function(){u.query="",s.setQueryParameter("insideBoundingBox",void 0),1<o.length?s.setQueryParameter("aroundLatLngViaIP",!1).setQueryParameter("aroundLatLng",o.join(",")):s.setQueryParameter("aroundLatLngViaIP",u.initialLatLngViaIP).setQueryParameter("aroundLatLng",void 0),s.search()})},getWidgetUiState:function(e,t){var n=t.searchParameters.aroundLatLng||o.join(",");if(n!==o.join(",")||u.query)return W(W({},e),{},{places:{query:u.query,position:n}});e.places;return M(e,["places"])},getWidgetSearchParameters:function(e,t){var n=t.uiState.places||{},r=n.query,i=void 0===r?"":r,a=n.position,s=void 0===a?o.join(","):a;return u.query=i,u.isInitialLatLngViaIPSet||(u.isInitialLatLngViaIPSet=!0,u.initialLatLngViaIP=e.aroundLatLngViaIP),c.setVal(i),c.close(),e.setQueryParameter("insideBoundingBox",void 0).setQueryParameter("aroundLatLngViaIP",!1).setQueryParameter("aroundLatLng",s||void 0)},getRenderState:function(e,t){return W(W({},e),{},{places:this.getWidgetRenderState(t)})},getWidgetRenderState:function(){return{widgetParams:e}}}},poweredBy:function(e){var t=e||{},n=t.container,r=t.cssClasses,i=void 0===r?{}:r,a=t.theme,s=void 0===a?"light":a;if(!n)throw new Error(cs("The `container` option is required."));var o=le(n),c={root:Pi(os(),os({modifierName:"dark"===s?"dark":"light"}),i.root),link:Pi(os({descendantName:"link"}),i.link),logo:Pi(os({descendantName:"logo"}),i.logo)},u=function(e){var a=e.containerNode,s=e.cssClasses;return function(e,t){var n=e.url,r=e.widgetParams;if(t){var i=r.theme;sr(Dn(ts,{cssClasses:s,url:n,theme:void 0===i?"light":i}),a)}else;}}({containerNode:o,cssClasses:c});return W(W({},ei(u,function(){return sr(null,o)})({theme:s})),{},{$$widgetType:"ais.poweredBy"})},queryRuleContext:function(e){var t=0<arguments.length&&void 0!==e?e:{};if(!t.trackedFilters)throw new Error(us("The `trackedFilters` option is required."));return W(W({},hi(xe)(t)),{},{$$widgetType:"ais.queryRuleContext"})},queryRuleCustomData:function(e){var t=e||{},n=t.container,r=t.cssClasses,i=void 0===r?{}:r,a=t.templates,s=void 0===a?{}:a,o=t.transformItems,c=void 0===o?function(e){return e}:o;if(!n)throw new Error(ds("The `container` option is required."));var u={root:Pi(hs(),i.root)},l=le(n),d=W(W({},ls),s),h=function(e){var n=e.containerNode,r=e.cssClasses,i=e.templates;return function(e){var t=e.items;sr(Dn(ns,{cssClasses:r,templates:i,items:t}),n)}}({containerNode:l,cssClasses:u,renderState:{},templates:d});return W(W({},hi(h,function(){sr(null,l)})({transformItems:c})),{},{$$widgetType:"ais.queryRuleCustomData"})},rangeInput:function(e){var t=e||{},n=t.container,r=t.attribute,i=t.min,a=t.max,s=t.precision,o=void 0===s?0:s,c=t.cssClasses,u=void 0===c?{}:c,l=t.templates,d=void 0===l?{}:l;if(!n)throw new Error(ms("The `container` option is required."));var h=le(n),f={root:Pi(ps(),u.root),noRefinement:Pi(ps({modifierName:"noRefinement"})),form:Pi(ps({descendantName:"form"}),u.form),label:Pi(ps({descendantName:"label"}),u.label),input:Pi(ps({descendantName:"input"}),u.input),inputMin:Pi(ps({descendantName:"input",modifierName:"min"}),u.inputMin),inputMax:Pi(ps({descendantName:"input",modifierName:"max"}),u.inputMax),separator:Pi(ps({descendantName:"separator"}),u.separator),submit:Pi(ps({descendantName:"submit"}),u.submit)},m=function(e){var f=e.containerNode,m=e.cssClasses,p=e.renderState,g=e.templates;return function(e,t){var n=e.refine,r=e.range,i=e.start,a=e.widgetParams,s=e.instantSearchInstance;if(t)p.templateProps=fe({defaultTemplates:gs,templatesConfig:s.templatesConfig,templates:g});else{var o=r.min,c=r.max,u=D(i,2),l=u[0],d=u[1],h=1/Math.pow(10,a.precision||0);sr(Dn(fs,{min:o,max:c,step:h,values:{min:l!==-1/0&&l!==o?l:void 0,max:d!==1/0&&d!==c?d:void 0},cssClasses:m,refine:n,templateProps:p.templateProps}),f)}}}({containerNode:h,cssClasses:f,templates:d,renderState:{}});return W(W({},Er(m,function(){return sr(null,h)})({attribute:r,min:i,max:a,precision:o})),{},{$$type:"ais.rangeInput",$$widgetType:"ais.rangeInput"})},rangeSlider:function(e){var t=e||{},n=t.container,r=t.attribute,i=t.min,a=t.max,s=t.cssClasses,o=void 0===s?{}:s,c=t.step,u=t.pips,l=void 0===u||u,d=t.precision,h=void 0===d?0:d,f=t.tooltips,m=void 0===f||f;if(!n)throw new Error(Ds("The `container` option is required."));var p=le(n),g={root:Pi(Bs(),o.root),disabledRoot:Pi(Bs({modifierName:"disabled"}),o.disabledRoot)},v=function(e){var h=e.containerNode,f=e.cssClasses,m=e.pips,p=e.step,g=e.tooltips;return function(e,t){var n=e.refine,r=e.range,i=e.start;if(!t){var a=r.min,s=r.max,o=D(i,2),c=o[0],u=o[1],l=c===-1/0?a:c,d=u===1/0?s:u;sr(Dn(Ws,{cssClasses:f,refine:n,min:a,max:s,values:[s<l?s:l,d<a?a:d],tooltips:g,step:p,pips:m}),h)}}}({containerNode:p,step:c,pips:l,tooltips:m,cssClasses:g});return W(W({},Er(v,function(){return sr(null,p)})({attribute:r,min:i,max:a,precision:h})),{},{$$type:"ais.rangeSlider",$$widgetType:"ais.rangeSlider"})},ratingMenu:function(e){var t=e||{},n=t.container,r=t.attribute,i=t.max,a=void 0===i?5:i,s=t.cssClasses,o=void 0===s?{}:s,c=t.templates,u=void 0===c?{}:c;if(!n)throw new Error(qs("The `container` option is required."));var l=le(n),d={root:Pi(Qs(),o.root),noRefinementRoot:Pi(Qs({modifierName:"noRefinement"}),o.noRefinementRoot),list:Pi(Qs({descendantName:"list"}),o.list),item:Pi(Qs({descendantName:"item"}),o.item),selectedItem:Pi(Qs({descendantName:"item",modifierName:"selected"}),o.selectedItem),disabledItem:Pi(Qs({descendantName:"item",modifierName:"disabled"}),o.disabledItem),link:Pi(Qs({descendantName:"link"}),o.link),starIcon:Pi(Qs({descendantName:"starIcon"}),o.starIcon),fullStarIcon:Pi(Qs({descendantName:"starIcon",modifierName:"full"}),o.fullStarIcon),emptyStarIcon:Pi(Qs({descendantName:"starIcon",modifierName:"empty"}),o.emptyStarIcon),label:Pi(Qs({descendantName:"label"}),o.label),count:Pi(Qs({descendantName:"count"}),o.count)},h=function(e){var s=e.containerNode,o=e.cssClasses,c=e.templates,u=e.renderState;return function(e,t){var n=e.refine,r=e.items,i=e.createURL,a=e.instantSearchInstance;t?u.templateProps=fe({defaultTemplates:Us,templatesConfig:a.templatesConfig,templates:c}):sr(Dn(aa,{createURL:i,cssClasses:o,facetValues:r,templateProps:u.templateProps,toggleRefinement:n},Dn("svg",{style:"display:none;"},Dn("symbol",{id:Qs({descendantName:"starSymbol"}),viewBox:"0 0 24 24"},$s),Dn("symbol",{id:Qs({descendantName:"starEmptySymbol"}),viewBox:"0 0 24 24"},Vs))),s)}}({containerNode:l,cssClasses:d,renderState:{},templates:u});return W(W({},Or(h,function(){return sr(null,l)})({attribute:r,max:a})),{},{$$widgetType:"ais.ratingMenu"})},refinementList:function(e){var t=e||{},n=t.container,r=t.attribute,i=t.operator,a=t.sortBy,s=t.limit,o=t.showMore,c=t.showMoreLimit,u=t.searchable,l=void 0!==u&&u,d=t.searchablePlaceholder,h=void 0===d?"Search...":d,f=t.searchableEscapeFacetValues,m=void 0===f||f,p=t.searchableIsAlwaysActive,g=void 0===p||p,v=t.cssClasses,y=void 0===v?{}:v,b=t.templates,R=void 0===b?{}:b,S=t.transformItems;if(!n)throw new Error(Js("The `container` option is required."));var w=!!l&&Boolean(m),_=le(n),P={root:Pi(Ys(),y.root),noRefinementRoot:Pi(Ys({modifierName:"noRefinement"}),y.noRefinementRoot),list:Pi(Ys({descendantName:"list"}),y.list),item:Pi(Ys({descendantName:"item"}),y.item),selectedItem:Pi(Ys({descendantName:"item",modifierName:"selected"}),y.selectedItem),searchBox:Pi(Ys({descendantName:"searchBox"}),y.searchBox),label:Pi(Ys({descendantName:"label"}),y.label),checkbox:Pi(Ys({descendantName:"checkbox"}),y.checkbox),labelText:Pi(Ys({descendantName:"labelText"}),y.labelText),count:Pi(Ys({descendantName:"count"}),y.count),noResults:Pi(Ys({descendantName:"noResults"}),y.noResults),showMore:Pi(Ys({descendantName:"showMore"}),y.showMore),disabledShowMore:Pi(Ys({descendantName:"showMore",modifierName:"disabled"}),y.disabledShowMore),searchable:{root:Pi(Xs(),y.searchableRoot),form:Pi(Xs({descendantName:"form"}),y.searchableForm),input:Pi(Xs({descendantName:"input"}),y.searchableInput),submit:Pi(Xs({descendantName:"submit"}),y.searchableSubmit),submitIcon:Pi(Xs({descendantName:"submitIcon"}),y.searchableSubmitIcon),reset:Pi(Xs({descendantName:"reset"}),y.searchableReset),resetIcon:Pi(Xs({descendantName:"resetIcon"}),y.searchableResetIcon),loadingIndicator:Pi(Xs({descendantName:"loadingIndicator"}),y.searchableLoadingIndicator),loadingIcon:Pi(Xs({descendantName:"loadingIcon"}),y.searchableLoadingIcon)}},N=function(e){var h=e.containerNode,f=e.cssClasses,m=e.templates,p=e.searchBoxTemplates,g=e.renderState,v=e.showMore,y=e.searchable,b=e.searchablePlaceholder,R=e.searchableIsAlwaysActive;return function(e,t){var n=e.refine,r=e.items,i=e.createURL,a=e.searchForItems,s=e.isFromSearch,o=e.instantSearchInstance,c=e.toggleShowMore,u=e.isShowingMore,l=e.hasExhaustiveItems,d=e.canToggleShowMore;if(t)return g.templateProps=fe({defaultTemplates:zs,templatesConfig:o.templatesConfig,templates:m}),void(g.searchBoxTemplateProps=fe({defaultTemplates:Ks,templatesConfig:o.templatesConfig,templates:p}));sr(Dn(aa,{createURL:i,cssClasses:f,facetValues:r,templateProps:g.templateProps,searchBoxTemplateProps:g.searchBoxTemplateProps,toggleRefinement:n,searchFacetValues:y?a:void 0,searchPlaceholder:b,searchIsAlwaysActive:R,isFromSearch:s,showMore:v&&!s&&0<r.length,toggleShowMore:c,isShowingMore:u,hasExhaustiveItems:l,canToggleShowMore:d}),h)}}({containerNode:_,cssClasses:P,templates:R,searchBoxTemplates:{submit:R.searchableSubmit,reset:R.searchableReset,loadingIndicator:R.searchableLoadingIndicator},renderState:{},searchable:l,searchablePlaceholder:h,searchableIsAlwaysActive:g,showMore:o});return W(W({},kr(N,function(){return sr(null,_)})({attribute:r,operator:i,limit:s,showMore:o,showMoreLimit:c,sortBy:a,escapeFacetValues:w,transformItems:S})),{},{$$widgetType:"ais.refinementList"})},relevantSort:function(e){var t=e.container,n=e.templates,r=void 0===n?{}:n,i=e.cssClasses,a=void 0===i?{}:i;if(!t)throw new Error(Zs("The `container` option is required."));var s=le(t),o={root:Pi(eo(),a.root),text:Pi(eo({descendantName:"text"}),a.text),button:Pi(eo({descendantName:"button"}),a.button)},c=W(W({},Gs),r),u=function(e){var i=e.containerNode,a=e.cssClasses,s=e.templates;return function(e){var t=e.isRelevantSorted,n=e.isVirtualReplica,r=e.refine;sr(Dn(js,{cssClasses:a,templates:s,isRelevantSorted:t,isVirtualReplica:n,refine:r}),i)}}({containerNode:s,cssClasses:o,renderState:{},templates:c});return W(W({},vi(u,function(){sr(null,s)})({})),{},{$$widgetType:"ais.relevantSort"})},searchBox:function(e){var t=e||{},n=t.container,r=t.placeholder,i=void 0===r?"":r,a=t.cssClasses,s=void 0===a?{}:a,o=t.autofocus,c=void 0!==o&&o,u=t.searchAsYouType,l=void 0===u||u,d=t.showReset,h=void 0===d||d,f=t.showSubmit,m=void 0===f||f,p=t.showLoadingIndicator,g=void 0===p||p,v=t.queryHook,y=t.templates,b=void 0===y?{}:y;if(!n)throw new Error(to("The `container` option is required."));var R=le(n),S={root:Pi(no(),s.root),form:Pi(no({descendantName:"form"}),s.form),input:Pi(no({descendantName:"input"}),s.input),submit:Pi(no({descendantName:"submit"}),s.submit),submitIcon:Pi(no({descendantName:"submitIcon"}),s.submitIcon),reset:Pi(no({descendantName:"reset"}),s.reset),resetIcon:Pi(no({descendantName:"resetIcon"}),s.resetIcon),loadingIndicator:Pi(no({descendantName:"loadingIndicator"}),s.loadingIndicator),loadingIcon:Pi(no({descendantName:"loadingIcon"}),s.loadingIcon)},w=W(W({},Ks),b),_=function(e){var i=e.containerNode,a=e.cssClasses,s=e.placeholder,o=e.templates,c=e.autofocus,u=e.searchAsYouType,l=e.showReset,d=e.showSubmit,h=e.showLoadingIndicator;return function(e){var t=e.refine,n=e.query,r=e.isSearchStalled;sr(Dn(ra,{query:n,placeholder:s,autofocus:c,refine:t,searchAsYouType:u,templates:o,showSubmit:d,showReset:l,showLoadingIndicator:h,isSearchStalled:r,cssClasses:a}),i)}}({containerNode:R,cssClasses:S,placeholder:i,templates:w,autofocus:c,searchAsYouType:l,showReset:h,showSubmit:m,showLoadingIndicator:g});return W(W({},Mr(_,function(){return sr(null,R)})({queryHook:v})),{},{$$widgetType:"ais.searchBox"})},sortBy:function(e){var t=e||{},n=t.container,r=t.items,i=t.cssClasses,a=void 0===i?{}:i,s=t.transformItems;if(!n)throw new Error(ro("The `container` option is required."));var o=le(n),c={root:Pi(io(),a.root),select:Pi(io({descendantName:"select"}),a.select),option:Pi(io({descendantName:"option"}),a.option)},u=function(e){var a=e.containerNode,s=e.cssClasses;return function(e,t){var n=e.currentRefinement,r=e.options,i=e.refine;t||sr(Dn("div",{className:s.root},Dn(fa,{cssClasses:s,currentValue:n,options:r,setValue:i})),a)}}({containerNode:o,cssClasses:c});return W(W({},jr(u,function(){return sr(null,o)})({container:o,items:r,transformItems:s})),{},{$$widgetType:"ais.sortBy"})},stats:function(e){var t=e||{},n=t.container,r=t.cssClasses,i=void 0===r?{}:r,a=t.templates,s=void 0===a?{}:a;if(!n)throw new Error(ao("The `container` option is required."));var o=le(n),c={root:Pi(so(),i.root),text:Pi(so({descendantName:"text"}),i.text)},u=function(e){var d=e.renderState,h=e.cssClasses,f=e.containerNode,m=e.templates;return function(e,t){var n=e.hitsPerPage,r=e.nbHits,i=e.nbSortedHits,a=e.areHitsSorted,s=e.nbPages,o=e.page,c=e.processingTimeMS,u=e.query,l=e.instantSearchInstance;t?d.templateProps=fe({defaultTemplates:oo,templatesConfig:l.templatesConfig,templates:m}):sr(Dn(Os,{cssClasses:h,hitsPerPage:n,nbHits:r,nbSortedHits:i,areHitsSorted:a,nbPages:s,page:o,processingTimeMS:c,query:u,templateProps:d.templateProps}),f)}}({containerNode:o,cssClasses:c,templates:s,renderState:{}});return W(W({},Ar(u,function(){return sr(null,o)})({})),{},{$$widgetType:"ais.stats"})},toggleRefinement:function(e){var t=e||{},n=t.container,r=t.attribute,i=t.cssClasses,a=void 0===i?{}:i,s=t.templates,o=void 0===s?{}:s,c=t.on,u=void 0===c||c,l=t.off;if(!n)throw new Error(uo("The `container` option is required."));var d=le(n),h={root:Pi(lo(),a.root),label:Pi(lo({descendantName:"label"}),a.label),checkbox:Pi(lo({descendantName:"checkbox"}),a.checkbox),labelText:Pi(lo({descendantName:"labelText"}),a.labelText)},f=function(e){var a=e.containerNode,s=e.cssClasses,o=e.renderState,c=e.templates;return function(e,t){var n=e.value,r=e.refine,i=e.instantSearchInstance;t?o.templateProps=fe({defaultTemplates:co,templatesConfig:i.templatesConfig,templates:c}):sr(Dn(As,{cssClasses:s,currentRefinement:n,templateProps:o.templateProps,refine:r}),a)}}({containerNode:d,cssClasses:h,renderState:{},templates:o});return W(W({},Hr(f,function(){return sr(null,d)})({attribute:r,on:u,off:l})),{},{$$widgetType:"ais.toggleRefinement"})},voiceSearch:function(e){var t=e||{},n=t.container,r=t.cssClasses,i=void 0===r?{}:r,a=t.templates,s=void 0===a?{}:a,o=t.searchAsYouSpeak,c=void 0!==o&&o,u=t.language,l=t.additionalQueryParameters,d=t.createVoiceSearchHelper;if(!n)throw new Error(fo("The `container` option is required."));var h=le(n),f={root:Pi(mo(),i.root),button:Pi(mo({descendantName:"button"}),i.button),status:Pi(mo({descendantName:"status"}),i.status)},m=W(W({},ho),s),p=function(e){var a=e.containerNode,s=e.cssClasses,o=e.templates;return function(e){var t=e.isBrowserSupported,n=e.isListening,r=e.toggleListening,i=e.voiceListeningState;sr(Dn(Hs,{cssClasses:s,templates:o,isBrowserSupported:t,isListening:n,toggleListening:r,voiceListeningState:i}),a)}}({containerNode:h,cssClasses:f,templates:m});return W(W({},mi(p,function(){return sr(null,h)})({container:h,cssClasses:f,templates:m,searchAsYouSpeak:c,language:u,additionalQueryParameters:l,createVoiceSearchHelper:d})),{},{$$widgetType:"ais.voiceSearch"})}}),vo=Object.freeze({__proto__:null,createInsightsMiddleware:function(e){var t=e||{},d=t.insightsClient,h=t.insightsInitParams,f=t.onEvent;if(null!==d&&!d)throw new Error("The `insightsClient` option is required. To disable, set it to `null`.");var m=Boolean(d),p=null===d?xe:d;return function(e){var n=e.instantSearchInstance,t=D(function(e){if(e.transporter){var t=e.transporter,n=t.headers,r=t.queryParameters,i="x-algolia-application-id",a="x-algolia-api-key";return[n[i]||r[i],n[a]||r[a]]}return[e.applicationID,e.apiKey]}(n.client),2),r=t[0],i=t[1],a=void 0,s=void 0;if(Array.isArray(p.queue)){var o=D(be(p.queue.slice().reverse(),function(e){return"setUserToken"===D(e,1)[0]})||[],2);a=o[1]}p("getUserToken",null,function(e,t){s=t}),p("init",W({appId:r,apiKey:i},h));var c,u,l=ai(xe);return{onStateChange:function(){},subscribe:function(){p("addAlgoliaAgent","insights-middleware"),c=l({searchParameters:{clickAnalytics:!0}}),n.addWidgets([c]);function e(e){u&&n.removeWidgets([u]),u=l({searchParameters:{userToken:e}}),n.addWidgets([u])}var t=Et();m&&t&&e(t),s?p("setUserToken",s):a&&p("setUserToken",a),p("onUserTokenChange",e,{immediate:!0}),n.sendEventToInsights=function(e){if(f)f(e,d);else if(e.insightsMethod){Boolean(n.renderState[n.indexName].configure.widgetParams.searchParameters.userToken)&&p(e.insightsMethod,e.payload)}}},unsubscribe:function(){p("onUserTokenChange",void 0),n.removeWidgets([c,u]),u=c=void 0,n.sendEventToInsights=xe}}}},createRouterMiddleware:cn,isMetadataEnabled:un,createMetadataMiddleware:ln}),yo=Object.freeze({__proto__:null,history:on});function bo(e){e.configure;return M(e,["configure"])}var Ro=Object.freeze({__proto__:null,simple:Lt,singleIndex:function(t){return{stateToRoute:function(e){return bo(e[t]||{})},routeToState:function(e){return k({},t,bo(0<arguments.length&&void 0!==e?e:{}))}}}});function So(e){var t=e||{};t.page;return M(t,["page"])}var wo="ais.infiniteHits";function _o(e){return new mn(e)}return _o.version="4.37.2",_o.connectors=wi,_o.widgets=go,_o.middlewares=vo,_o.routers=yo,_o.stateMappings=Ro,_o.createInfiniteHitsSessionStorageCache=function(){return{read:function(e){var t=e.state,n=ft(function(e){return e.window.sessionStorage});if(!n)return null;try{var r=JSON.parse(n.getItem(wo));return r&&Le(r.state,So(t))?r.hits:null}catch(e){if(e instanceof SyntaxError)try{n.removeItem(wo)}catch(e){}return null}},write:function(e){var t=e.state,n=e.hits,r=ft(function(e){return e.window.sessionStorage});if(r)try{r.setItem(wo,JSON.stringify({state:So(t),hits:n}))}catch(e){}}}},_o.highlight=_t,_o.reverseHighlight=Nt,_o.snippet=It,_o.reverseSnippet=Tt,_o.insights=Ct,_o});
//# sourceMappingURL=instantsearch.production.min.js.map


/***/ }),

/***/ "./node_modules/jquery/dist/jquery.js":
/*!********************************************!*\
  !*** ./node_modules/jquery/dist/jquery.js ***!
  \********************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

var __WEBPACK_AMD_DEFINE_ARRAY__, __WEBPACK_AMD_DEFINE_RESULT__;/*!
 * jQuery JavaScript Library v3.5.1
 * https://jquery.com/
 *
 * Includes Sizzle.js
 * https://sizzlejs.com/
 *
 * Copyright JS Foundation and other contributors
 * Released under the MIT license
 * https://jquery.org/license
 *
 * Date: 2020-05-04T22:49Z
 */
( function( global, factory ) {

	"use strict";

	if (  true && typeof module.exports === "object" ) {

		// For CommonJS and CommonJS-like environments where a proper `window`
		// is present, execute the factory and get jQuery.
		// For environments that do not have a `window` with a `document`
		// (such as Node.js), expose a factory as module.exports.
		// This accentuates the need for the creation of a real `window`.
		// e.g. var jQuery = require("jquery")(window);
		// See ticket #14549 for more info.
		module.exports = global.document ?
			factory( global, true ) :
			function( w ) {
				if ( !w.document ) {
					throw new Error( "jQuery requires a window with a document" );
				}
				return factory( w );
			};
	} else {
		factory( global );
	}

// Pass this if window is not defined yet
} )( typeof window !== "undefined" ? window : this, function( window, noGlobal ) {

// Edge <= 12 - 13+, Firefox <=18 - 45+, IE 10 - 11, Safari 5.1 - 9+, iOS 6 - 9.1
// throw exceptions when non-strict code (e.g., ASP.NET 4.5) accesses strict mode
// arguments.callee.caller (trac-13335). But as of jQuery 3.0 (2016), strict mode should be common
// enough that all such attempts are guarded in a try block.
"use strict";

var arr = [];

var getProto = Object.getPrototypeOf;

var slice = arr.slice;

var flat = arr.flat ? function( array ) {
	return arr.flat.call( array );
} : function( array ) {
	return arr.concat.apply( [], array );
};


var push = arr.push;

var indexOf = arr.indexOf;

var class2type = {};

var toString = class2type.toString;

var hasOwn = class2type.hasOwnProperty;

var fnToString = hasOwn.toString;

var ObjectFunctionString = fnToString.call( Object );

var support = {};

var isFunction = function isFunction( obj ) {

      // Support: Chrome <=57, Firefox <=52
      // In some browsers, typeof returns "function" for HTML <object> elements
      // (i.e., `typeof document.createElement( "object" ) === "function"`).
      // We don't want to classify *any* DOM node as a function.
      return typeof obj === "function" && typeof obj.nodeType !== "number";
  };


var isWindow = function isWindow( obj ) {
		return obj != null && obj === obj.window;
	};


var document = window.document;



	var preservedScriptAttributes = {
		type: true,
		src: true,
		nonce: true,
		noModule: true
	};

	function DOMEval( code, node, doc ) {
		doc = doc || document;

		var i, val,
			script = doc.createElement( "script" );

		script.text = code;
		if ( node ) {
			for ( i in preservedScriptAttributes ) {

				// Support: Firefox 64+, Edge 18+
				// Some browsers don't support the "nonce" property on scripts.
				// On the other hand, just using `getAttribute` is not enough as
				// the `nonce` attribute is reset to an empty string whenever it
				// becomes browsing-context connected.
				// See https://github.com/whatwg/html/issues/2369
				// See https://html.spec.whatwg.org/#nonce-attributes
				// The `node.getAttribute` check was added for the sake of
				// `jQuery.globalEval` so that it can fake a nonce-containing node
				// via an object.
				val = node[ i ] || node.getAttribute && node.getAttribute( i );
				if ( val ) {
					script.setAttribute( i, val );
				}
			}
		}
		doc.head.appendChild( script ).parentNode.removeChild( script );
	}


function toType( obj ) {
	if ( obj == null ) {
		return obj + "";
	}

	// Support: Android <=2.3 only (functionish RegExp)
	return typeof obj === "object" || typeof obj === "function" ?
		class2type[ toString.call( obj ) ] || "object" :
		typeof obj;
}
/* global Symbol */
// Defining this global in .eslintrc.json would create a danger of using the global
// unguarded in another place, it seems safer to define global only for this module



var
	version = "3.5.1",

	// Define a local copy of jQuery
	jQuery = function( selector, context ) {

		// The jQuery object is actually just the init constructor 'enhanced'
		// Need init if jQuery is called (just allow error to be thrown if not included)
		return new jQuery.fn.init( selector, context );
	};

jQuery.fn = jQuery.prototype = {

	// The current version of jQuery being used
	jquery: version,

	constructor: jQuery,

	// The default length of a jQuery object is 0
	length: 0,

	toArray: function() {
		return slice.call( this );
	},

	// Get the Nth element in the matched element set OR
	// Get the whole matched element set as a clean array
	get: function( num ) {

		// Return all the elements in a clean array
		if ( num == null ) {
			return slice.call( this );
		}

		// Return just the one element from the set
		return num < 0 ? this[ num + this.length ] : this[ num ];
	},

	// Take an array of elements and push it onto the stack
	// (returning the new matched element set)
	pushStack: function( elems ) {

		// Build a new jQuery matched element set
		var ret = jQuery.merge( this.constructor(), elems );

		// Add the old object onto the stack (as a reference)
		ret.prevObject = this;

		// Return the newly-formed element set
		return ret;
	},

	// Execute a callback for every element in the matched set.
	each: function( callback ) {
		return jQuery.each( this, callback );
	},

	map: function( callback ) {
		return this.pushStack( jQuery.map( this, function( elem, i ) {
			return callback.call( elem, i, elem );
		} ) );
	},

	slice: function() {
		return this.pushStack( slice.apply( this, arguments ) );
	},

	first: function() {
		return this.eq( 0 );
	},

	last: function() {
		return this.eq( -1 );
	},

	even: function() {
		return this.pushStack( jQuery.grep( this, function( _elem, i ) {
			return ( i + 1 ) % 2;
		} ) );
	},

	odd: function() {
		return this.pushStack( jQuery.grep( this, function( _elem, i ) {
			return i % 2;
		} ) );
	},

	eq: function( i ) {
		var len = this.length,
			j = +i + ( i < 0 ? len : 0 );
		return this.pushStack( j >= 0 && j < len ? [ this[ j ] ] : [] );
	},

	end: function() {
		return this.prevObject || this.constructor();
	},

	// For internal use only.
	// Behaves like an Array's method, not like a jQuery method.
	push: push,
	sort: arr.sort,
	splice: arr.splice
};

jQuery.extend = jQuery.fn.extend = function() {
	var options, name, src, copy, copyIsArray, clone,
		target = arguments[ 0 ] || {},
		i = 1,
		length = arguments.length,
		deep = false;

	// Handle a deep copy situation
	if ( typeof target === "boolean" ) {
		deep = target;

		// Skip the boolean and the target
		target = arguments[ i ] || {};
		i++;
	}

	// Handle case when target is a string or something (possible in deep copy)
	if ( typeof target !== "object" && !isFunction( target ) ) {
		target = {};
	}

	// Extend jQuery itself if only one argument is passed
	if ( i === length ) {
		target = this;
		i--;
	}

	for ( ; i < length; i++ ) {

		// Only deal with non-null/undefined values
		if ( ( options = arguments[ i ] ) != null ) {

			// Extend the base object
			for ( name in options ) {
				copy = options[ name ];

				// Prevent Object.prototype pollution
				// Prevent never-ending loop
				if ( name === "__proto__" || target === copy ) {
					continue;
				}

				// Recurse if we're merging plain objects or arrays
				if ( deep && copy && ( jQuery.isPlainObject( copy ) ||
					( copyIsArray = Array.isArray( copy ) ) ) ) {
					src = target[ name ];

					// Ensure proper type for the source value
					if ( copyIsArray && !Array.isArray( src ) ) {
						clone = [];
					} else if ( !copyIsArray && !jQuery.isPlainObject( src ) ) {
						clone = {};
					} else {
						clone = src;
					}
					copyIsArray = false;

					// Never move original objects, clone them
					target[ name ] = jQuery.extend( deep, clone, copy );

				// Don't bring in undefined values
				} else if ( copy !== undefined ) {
					target[ name ] = copy;
				}
			}
		}
	}

	// Return the modified object
	return target;
};

jQuery.extend( {

	// Unique for each copy of jQuery on the page
	expando: "jQuery" + ( version + Math.random() ).replace( /\D/g, "" ),

	// Assume jQuery is ready without the ready module
	isReady: true,

	error: function( msg ) {
		throw new Error( msg );
	},

	noop: function() {},

	isPlainObject: function( obj ) {
		var proto, Ctor;

		// Detect obvious negatives
		// Use toString instead of jQuery.type to catch host objects
		if ( !obj || toString.call( obj ) !== "[object Object]" ) {
			return false;
		}

		proto = getProto( obj );

		// Objects with no prototype (e.g., `Object.create( null )`) are plain
		if ( !proto ) {
			return true;
		}

		// Objects with prototype are plain iff they were constructed by a global Object function
		Ctor = hasOwn.call( proto, "constructor" ) && proto.constructor;
		return typeof Ctor === "function" && fnToString.call( Ctor ) === ObjectFunctionString;
	},

	isEmptyObject: function( obj ) {
		var name;

		for ( name in obj ) {
			return false;
		}
		return true;
	},

	// Evaluates a script in a provided context; falls back to the global one
	// if not specified.
	globalEval: function( code, options, doc ) {
		DOMEval( code, { nonce: options && options.nonce }, doc );
	},

	each: function( obj, callback ) {
		var length, i = 0;

		if ( isArrayLike( obj ) ) {
			length = obj.length;
			for ( ; i < length; i++ ) {
				if ( callback.call( obj[ i ], i, obj[ i ] ) === false ) {
					break;
				}
			}
		} else {
			for ( i in obj ) {
				if ( callback.call( obj[ i ], i, obj[ i ] ) === false ) {
					break;
				}
			}
		}

		return obj;
	},

	// results is for internal usage only
	makeArray: function( arr, results ) {
		var ret = results || [];

		if ( arr != null ) {
			if ( isArrayLike( Object( arr ) ) ) {
				jQuery.merge( ret,
					typeof arr === "string" ?
					[ arr ] : arr
				);
			} else {
				push.call( ret, arr );
			}
		}

		return ret;
	},

	inArray: function( elem, arr, i ) {
		return arr == null ? -1 : indexOf.call( arr, elem, i );
	},

	// Support: Android <=4.0 only, PhantomJS 1 only
	// push.apply(_, arraylike) throws on ancient WebKit
	merge: function( first, second ) {
		var len = +second.length,
			j = 0,
			i = first.length;

		for ( ; j < len; j++ ) {
			first[ i++ ] = second[ j ];
		}

		first.length = i;

		return first;
	},

	grep: function( elems, callback, invert ) {
		var callbackInverse,
			matches = [],
			i = 0,
			length = elems.length,
			callbackExpect = !invert;

		// Go through the array, only saving the items
		// that pass the validator function
		for ( ; i < length; i++ ) {
			callbackInverse = !callback( elems[ i ], i );
			if ( callbackInverse !== callbackExpect ) {
				matches.push( elems[ i ] );
			}
		}

		return matches;
	},

	// arg is for internal usage only
	map: function( elems, callback, arg ) {
		var length, value,
			i = 0,
			ret = [];

		// Go through the array, translating each of the items to their new values
		if ( isArrayLike( elems ) ) {
			length = elems.length;
			for ( ; i < length; i++ ) {
				value = callback( elems[ i ], i, arg );

				if ( value != null ) {
					ret.push( value );
				}
			}

		// Go through every key on the object,
		} else {
			for ( i in elems ) {
				value = callback( elems[ i ], i, arg );

				if ( value != null ) {
					ret.push( value );
				}
			}
		}

		// Flatten any nested arrays
		return flat( ret );
	},

	// A global GUID counter for objects
	guid: 1,

	// jQuery.support is not used in Core but other projects attach their
	// properties to it so it needs to exist.
	support: support
} );

if ( typeof Symbol === "function" ) {
	jQuery.fn[ Symbol.iterator ] = arr[ Symbol.iterator ];
}

// Populate the class2type map
jQuery.each( "Boolean Number String Function Array Date RegExp Object Error Symbol".split( " " ),
function( _i, name ) {
	class2type[ "[object " + name + "]" ] = name.toLowerCase();
} );

function isArrayLike( obj ) {

	// Support: real iOS 8.2 only (not reproducible in simulator)
	// `in` check used to prevent JIT error (gh-2145)
	// hasOwn isn't used here due to false negatives
	// regarding Nodelist length in IE
	var length = !!obj && "length" in obj && obj.length,
		type = toType( obj );

	if ( isFunction( obj ) || isWindow( obj ) ) {
		return false;
	}

	return type === "array" || length === 0 ||
		typeof length === "number" && length > 0 && ( length - 1 ) in obj;
}
var Sizzle =
/*!
 * Sizzle CSS Selector Engine v2.3.5
 * https://sizzlejs.com/
 *
 * Copyright JS Foundation and other contributors
 * Released under the MIT license
 * https://js.foundation/
 *
 * Date: 2020-03-14
 */
( function( window ) {
var i,
	support,
	Expr,
	getText,
	isXML,
	tokenize,
	compile,
	select,
	outermostContext,
	sortInput,
	hasDuplicate,

	// Local document vars
	setDocument,
	document,
	docElem,
	documentIsHTML,
	rbuggyQSA,
	rbuggyMatches,
	matches,
	contains,

	// Instance-specific data
	expando = "sizzle" + 1 * new Date(),
	preferredDoc = window.document,
	dirruns = 0,
	done = 0,
	classCache = createCache(),
	tokenCache = createCache(),
	compilerCache = createCache(),
	nonnativeSelectorCache = createCache(),
	sortOrder = function( a, b ) {
		if ( a === b ) {
			hasDuplicate = true;
		}
		return 0;
	},

	// Instance methods
	hasOwn = ( {} ).hasOwnProperty,
	arr = [],
	pop = arr.pop,
	pushNative = arr.push,
	push = arr.push,
	slice = arr.slice,

	// Use a stripped-down indexOf as it's faster than native
	// https://jsperf.com/thor-indexof-vs-for/5
	indexOf = function( list, elem ) {
		var i = 0,
			len = list.length;
		for ( ; i < len; i++ ) {
			if ( list[ i ] === elem ) {
				return i;
			}
		}
		return -1;
	},

	booleans = "checked|selected|async|autofocus|autoplay|controls|defer|disabled|hidden|" +
		"ismap|loop|multiple|open|readonly|required|scoped",

	// Regular expressions

	// http://www.w3.org/TR/css3-selectors/#whitespace
	whitespace = "[\\x20\\t\\r\\n\\f]",

	// https://www.w3.org/TR/css-syntax-3/#ident-token-diagram
	identifier = "(?:\\\\[\\da-fA-F]{1,6}" + whitespace +
		"?|\\\\[^\\r\\n\\f]|[\\w-]|[^\0-\\x7f])+",

	// Attribute selectors: http://www.w3.org/TR/selectors/#attribute-selectors
	attributes = "\\[" + whitespace + "*(" + identifier + ")(?:" + whitespace +

		// Operator (capture 2)
		"*([*^$|!~]?=)" + whitespace +

		// "Attribute values must be CSS identifiers [capture 5]
		// or strings [capture 3 or capture 4]"
		"*(?:'((?:\\\\.|[^\\\\'])*)'|\"((?:\\\\.|[^\\\\\"])*)\"|(" + identifier + "))|)" +
		whitespace + "*\\]",

	pseudos = ":(" + identifier + ")(?:\\((" +

		// To reduce the number of selectors needing tokenize in the preFilter, prefer arguments:
		// 1. quoted (capture 3; capture 4 or capture 5)
		"('((?:\\\\.|[^\\\\'])*)'|\"((?:\\\\.|[^\\\\\"])*)\")|" +

		// 2. simple (capture 6)
		"((?:\\\\.|[^\\\\()[\\]]|" + attributes + ")*)|" +

		// 3. anything else (capture 2)
		".*" +
		")\\)|)",

	// Leading and non-escaped trailing whitespace, capturing some non-whitespace characters preceding the latter
	rwhitespace = new RegExp( whitespace + "+", "g" ),
	rtrim = new RegExp( "^" + whitespace + "+|((?:^|[^\\\\])(?:\\\\.)*)" +
		whitespace + "+$", "g" ),

	rcomma = new RegExp( "^" + whitespace + "*," + whitespace + "*" ),
	rcombinators = new RegExp( "^" + whitespace + "*([>+~]|" + whitespace + ")" + whitespace +
		"*" ),
	rdescend = new RegExp( whitespace + "|>" ),

	rpseudo = new RegExp( pseudos ),
	ridentifier = new RegExp( "^" + identifier + "$" ),

	matchExpr = {
		"ID": new RegExp( "^#(" + identifier + ")" ),
		"CLASS": new RegExp( "^\\.(" + identifier + ")" ),
		"TAG": new RegExp( "^(" + identifier + "|[*])" ),
		"ATTR": new RegExp( "^" + attributes ),
		"PSEUDO": new RegExp( "^" + pseudos ),
		"CHILD": new RegExp( "^:(only|first|last|nth|nth-last)-(child|of-type)(?:\\(" +
			whitespace + "*(even|odd|(([+-]|)(\\d*)n|)" + whitespace + "*(?:([+-]|)" +
			whitespace + "*(\\d+)|))" + whitespace + "*\\)|)", "i" ),
		"bool": new RegExp( "^(?:" + booleans + ")$", "i" ),

		// For use in libraries implementing .is()
		// We use this for POS matching in `select`
		"needsContext": new RegExp( "^" + whitespace +
			"*[>+~]|:(even|odd|eq|gt|lt|nth|first|last)(?:\\(" + whitespace +
			"*((?:-\\d)?\\d*)" + whitespace + "*\\)|)(?=[^-]|$)", "i" )
	},

	rhtml = /HTML$/i,
	rinputs = /^(?:input|select|textarea|button)$/i,
	rheader = /^h\d$/i,

	rnative = /^[^{]+\{\s*\[native \w/,

	// Easily-parseable/retrievable ID or TAG or CLASS selectors
	rquickExpr = /^(?:#([\w-]+)|(\w+)|\.([\w-]+))$/,

	rsibling = /[+~]/,

	// CSS escapes
	// http://www.w3.org/TR/CSS21/syndata.html#escaped-characters
	runescape = new RegExp( "\\\\[\\da-fA-F]{1,6}" + whitespace + "?|\\\\([^\\r\\n\\f])", "g" ),
	funescape = function( escape, nonHex ) {
		var high = "0x" + escape.slice( 1 ) - 0x10000;

		return nonHex ?

			// Strip the backslash prefix from a non-hex escape sequence
			nonHex :

			// Replace a hexadecimal escape sequence with the encoded Unicode code point
			// Support: IE <=11+
			// For values outside the Basic Multilingual Plane (BMP), manually construct a
			// surrogate pair
			high < 0 ?
				String.fromCharCode( high + 0x10000 ) :
				String.fromCharCode( high >> 10 | 0xD800, high & 0x3FF | 0xDC00 );
	},

	// CSS string/identifier serialization
	// https://drafts.csswg.org/cssom/#common-serializing-idioms
	rcssescape = /([\0-\x1f\x7f]|^-?\d)|^-$|[^\0-\x1f\x7f-\uFFFF\w-]/g,
	fcssescape = function( ch, asCodePoint ) {
		if ( asCodePoint ) {

			// U+0000 NULL becomes U+FFFD REPLACEMENT CHARACTER
			if ( ch === "\0" ) {
				return "\uFFFD";
			}

			// Control characters and (dependent upon position) numbers get escaped as code points
			return ch.slice( 0, -1 ) + "\\" +
				ch.charCodeAt( ch.length - 1 ).toString( 16 ) + " ";
		}

		// Other potentially-special ASCII characters get backslash-escaped
		return "\\" + ch;
	},

	// Used for iframes
	// See setDocument()
	// Removing the function wrapper causes a "Permission Denied"
	// error in IE
	unloadHandler = function() {
		setDocument();
	},

	inDisabledFieldset = addCombinator(
		function( elem ) {
			return elem.disabled === true && elem.nodeName.toLowerCase() === "fieldset";
		},
		{ dir: "parentNode", next: "legend" }
	);

// Optimize for push.apply( _, NodeList )
try {
	push.apply(
		( arr = slice.call( preferredDoc.childNodes ) ),
		preferredDoc.childNodes
	);

	// Support: Android<4.0
	// Detect silently failing push.apply
	// eslint-disable-next-line no-unused-expressions
	arr[ preferredDoc.childNodes.length ].nodeType;
} catch ( e ) {
	push = { apply: arr.length ?

		// Leverage slice if possible
		function( target, els ) {
			pushNative.apply( target, slice.call( els ) );
		} :

		// Support: IE<9
		// Otherwise append directly
		function( target, els ) {
			var j = target.length,
				i = 0;

			// Can't trust NodeList.length
			while ( ( target[ j++ ] = els[ i++ ] ) ) {}
			target.length = j - 1;
		}
	};
}

function Sizzle( selector, context, results, seed ) {
	var m, i, elem, nid, match, groups, newSelector,
		newContext = context && context.ownerDocument,

		// nodeType defaults to 9, since context defaults to document
		nodeType = context ? context.nodeType : 9;

	results = results || [];

	// Return early from calls with invalid selector or context
	if ( typeof selector !== "string" || !selector ||
		nodeType !== 1 && nodeType !== 9 && nodeType !== 11 ) {

		return results;
	}

	// Try to shortcut find operations (as opposed to filters) in HTML documents
	if ( !seed ) {
		setDocument( context );
		context = context || document;

		if ( documentIsHTML ) {

			// If the selector is sufficiently simple, try using a "get*By*" DOM method
			// (excepting DocumentFragment context, where the methods don't exist)
			if ( nodeType !== 11 && ( match = rquickExpr.exec( selector ) ) ) {

				// ID selector
				if ( ( m = match[ 1 ] ) ) {

					// Document context
					if ( nodeType === 9 ) {
						if ( ( elem = context.getElementById( m ) ) ) {

							// Support: IE, Opera, Webkit
							// TODO: identify versions
							// getElementById can match elements by name instead of ID
							if ( elem.id === m ) {
								results.push( elem );
								return results;
							}
						} else {
							return results;
						}

					// Element context
					} else {

						// Support: IE, Opera, Webkit
						// TODO: identify versions
						// getElementById can match elements by name instead of ID
						if ( newContext && ( elem = newContext.getElementById( m ) ) &&
							contains( context, elem ) &&
							elem.id === m ) {

							results.push( elem );
							return results;
						}
					}

				// Type selector
				} else if ( match[ 2 ] ) {
					push.apply( results, context.getElementsByTagName( selector ) );
					return results;

				// Class selector
				} else if ( ( m = match[ 3 ] ) && support.getElementsByClassName &&
					context.getElementsByClassName ) {

					push.apply( results, context.getElementsByClassName( m ) );
					return results;
				}
			}

			// Take advantage of querySelectorAll
			if ( support.qsa &&
				!nonnativeSelectorCache[ selector + " " ] &&
				( !rbuggyQSA || !rbuggyQSA.test( selector ) ) &&

				// Support: IE 8 only
				// Exclude object elements
				( nodeType !== 1 || context.nodeName.toLowerCase() !== "object" ) ) {

				newSelector = selector;
				newContext = context;

				// qSA considers elements outside a scoping root when evaluating child or
				// descendant combinators, which is not what we want.
				// In such cases, we work around the behavior by prefixing every selector in the
				// list with an ID selector referencing the scope context.
				// The technique has to be used as well when a leading combinator is used
				// as such selectors are not recognized by querySelectorAll.
				// Thanks to Andrew Dupont for this technique.
				if ( nodeType === 1 &&
					( rdescend.test( selector ) || rcombinators.test( selector ) ) ) {

					// Expand context for sibling selectors
					newContext = rsibling.test( selector ) && testContext( context.parentNode ) ||
						context;

					// We can use :scope instead of the ID hack if the browser
					// supports it & if we're not changing the context.
					if ( newContext !== context || !support.scope ) {

						// Capture the context ID, setting it first if necessary
						if ( ( nid = context.getAttribute( "id" ) ) ) {
							nid = nid.replace( rcssescape, fcssescape );
						} else {
							context.setAttribute( "id", ( nid = expando ) );
						}
					}

					// Prefix every selector in the list
					groups = tokenize( selector );
					i = groups.length;
					while ( i-- ) {
						groups[ i ] = ( nid ? "#" + nid : ":scope" ) + " " +
							toSelector( groups[ i ] );
					}
					newSelector = groups.join( "," );
				}

				try {
					push.apply( results,
						newContext.querySelectorAll( newSelector )
					);
					return results;
				} catch ( qsaError ) {
					nonnativeSelectorCache( selector, true );
				} finally {
					if ( nid === expando ) {
						context.removeAttribute( "id" );
					}
				}
			}
		}
	}

	// All others
	return select( selector.replace( rtrim, "$1" ), context, results, seed );
}

/**
 * Create key-value caches of limited size
 * @returns {function(string, object)} Returns the Object data after storing it on itself with
 *	property name the (space-suffixed) string and (if the cache is larger than Expr.cacheLength)
 *	deleting the oldest entry
 */
function createCache() {
	var keys = [];

	function cache( key, value ) {

		// Use (key + " ") to avoid collision with native prototype properties (see Issue #157)
		if ( keys.push( key + " " ) > Expr.cacheLength ) {

			// Only keep the most recent entries
			delete cache[ keys.shift() ];
		}
		return ( cache[ key + " " ] = value );
	}
	return cache;
}

/**
 * Mark a function for special use by Sizzle
 * @param {Function} fn The function to mark
 */
function markFunction( fn ) {
	fn[ expando ] = true;
	return fn;
}

/**
 * Support testing using an element
 * @param {Function} fn Passed the created element and returns a boolean result
 */
function assert( fn ) {
	var el = document.createElement( "fieldset" );

	try {
		return !!fn( el );
	} catch ( e ) {
		return false;
	} finally {

		// Remove from its parent by default
		if ( el.parentNode ) {
			el.parentNode.removeChild( el );
		}

		// release memory in IE
		el = null;
	}
}

/**
 * Adds the same handler for all of the specified attrs
 * @param {String} attrs Pipe-separated list of attributes
 * @param {Function} handler The method that will be applied
 */
function addHandle( attrs, handler ) {
	var arr = attrs.split( "|" ),
		i = arr.length;

	while ( i-- ) {
		Expr.attrHandle[ arr[ i ] ] = handler;
	}
}

/**
 * Checks document order of two siblings
 * @param {Element} a
 * @param {Element} b
 * @returns {Number} Returns less than 0 if a precedes b, greater than 0 if a follows b
 */
function siblingCheck( a, b ) {
	var cur = b && a,
		diff = cur && a.nodeType === 1 && b.nodeType === 1 &&
			a.sourceIndex - b.sourceIndex;

	// Use IE sourceIndex if available on both nodes
	if ( diff ) {
		return diff;
	}

	// Check if b follows a
	if ( cur ) {
		while ( ( cur = cur.nextSibling ) ) {
			if ( cur === b ) {
				return -1;
			}
		}
	}

	return a ? 1 : -1;
}

/**
 * Returns a function to use in pseudos for input types
 * @param {String} type
 */
function createInputPseudo( type ) {
	return function( elem ) {
		var name = elem.nodeName.toLowerCase();
		return name === "input" && elem.type === type;
	};
}

/**
 * Returns a function to use in pseudos for buttons
 * @param {String} type
 */
function createButtonPseudo( type ) {
	return function( elem ) {
		var name = elem.nodeName.toLowerCase();
		return ( name === "input" || name === "button" ) && elem.type === type;
	};
}

/**
 * Returns a function to use in pseudos for :enabled/:disabled
 * @param {Boolean} disabled true for :disabled; false for :enabled
 */
function createDisabledPseudo( disabled ) {

	// Known :disabled false positives: fieldset[disabled] > legend:nth-of-type(n+2) :can-disable
	return function( elem ) {

		// Only certain elements can match :enabled or :disabled
		// https://html.spec.whatwg.org/multipage/scripting.html#selector-enabled
		// https://html.spec.whatwg.org/multipage/scripting.html#selector-disabled
		if ( "form" in elem ) {

			// Check for inherited disabledness on relevant non-disabled elements:
			// * listed form-associated elements in a disabled fieldset
			//   https://html.spec.whatwg.org/multipage/forms.html#category-listed
			//   https://html.spec.whatwg.org/multipage/forms.html#concept-fe-disabled
			// * option elements in a disabled optgroup
			//   https://html.spec.whatwg.org/multipage/forms.html#concept-option-disabled
			// All such elements have a "form" property.
			if ( elem.parentNode && elem.disabled === false ) {

				// Option elements defer to a parent optgroup if present
				if ( "label" in elem ) {
					if ( "label" in elem.parentNode ) {
						return elem.parentNode.disabled === disabled;
					} else {
						return elem.disabled === disabled;
					}
				}

				// Support: IE 6 - 11
				// Use the isDisabled shortcut property to check for disabled fieldset ancestors
				return elem.isDisabled === disabled ||

					// Where there is no isDisabled, check manually
					/* jshint -W018 */
					elem.isDisabled !== !disabled &&
					inDisabledFieldset( elem ) === disabled;
			}

			return elem.disabled === disabled;

		// Try to winnow out elements that can't be disabled before trusting the disabled property.
		// Some victims get caught in our net (label, legend, menu, track), but it shouldn't
		// even exist on them, let alone have a boolean value.
		} else if ( "label" in elem ) {
			return elem.disabled === disabled;
		}

		// Remaining elements are neither :enabled nor :disabled
		return false;
	};
}

/**
 * Returns a function to use in pseudos for positionals
 * @param {Function} fn
 */
function createPositionalPseudo( fn ) {
	return markFunction( function( argument ) {
		argument = +argument;
		return markFunction( function( seed, matches ) {
			var j,
				matchIndexes = fn( [], seed.length, argument ),
				i = matchIndexes.length;

			// Match elements found at the specified indexes
			while ( i-- ) {
				if ( seed[ ( j = matchIndexes[ i ] ) ] ) {
					seed[ j ] = !( matches[ j ] = seed[ j ] );
				}
			}
		} );
	} );
}

/**
 * Checks a node for validity as a Sizzle context
 * @param {Element|Object=} context
 * @returns {Element|Object|Boolean} The input node if acceptable, otherwise a falsy value
 */
function testContext( context ) {
	return context && typeof context.getElementsByTagName !== "undefined" && context;
}

// Expose support vars for convenience
support = Sizzle.support = {};

/**
 * Detects XML nodes
 * @param {Element|Object} elem An element or a document
 * @returns {Boolean} True iff elem is a non-HTML XML node
 */
isXML = Sizzle.isXML = function( elem ) {
	var namespace = elem.namespaceURI,
		docElem = ( elem.ownerDocument || elem ).documentElement;

	// Support: IE <=8
	// Assume HTML when documentElement doesn't yet exist, such as inside loading iframes
	// https://bugs.jquery.com/ticket/4833
	return !rhtml.test( namespace || docElem && docElem.nodeName || "HTML" );
};

/**
 * Sets document-related variables once based on the current document
 * @param {Element|Object} [doc] An element or document object to use to set the document
 * @returns {Object} Returns the current document
 */
setDocument = Sizzle.setDocument = function( node ) {
	var hasCompare, subWindow,
		doc = node ? node.ownerDocument || node : preferredDoc;

	// Return early if doc is invalid or already selected
	// Support: IE 11+, Edge 17 - 18+
	// IE/Edge sometimes throw a "Permission denied" error when strict-comparing
	// two documents; shallow comparisons work.
	// eslint-disable-next-line eqeqeq
	if ( doc == document || doc.nodeType !== 9 || !doc.documentElement ) {
		return document;
	}

	// Update global variables
	document = doc;
	docElem = document.documentElement;
	documentIsHTML = !isXML( document );

	// Support: IE 9 - 11+, Edge 12 - 18+
	// Accessing iframe documents after unload throws "permission denied" errors (jQuery #13936)
	// Support: IE 11+, Edge 17 - 18+
	// IE/Edge sometimes throw a "Permission denied" error when strict-comparing
	// two documents; shallow comparisons work.
	// eslint-disable-next-line eqeqeq
	if ( preferredDoc != document &&
		( subWindow = document.defaultView ) && subWindow.top !== subWindow ) {

		// Support: IE 11, Edge
		if ( subWindow.addEventListener ) {
			subWindow.addEventListener( "unload", unloadHandler, false );

		// Support: IE 9 - 10 only
		} else if ( subWindow.attachEvent ) {
			subWindow.attachEvent( "onunload", unloadHandler );
		}
	}

	// Support: IE 8 - 11+, Edge 12 - 18+, Chrome <=16 - 25 only, Firefox <=3.6 - 31 only,
	// Safari 4 - 5 only, Opera <=11.6 - 12.x only
	// IE/Edge & older browsers don't support the :scope pseudo-class.
	// Support: Safari 6.0 only
	// Safari 6.0 supports :scope but it's an alias of :root there.
	support.scope = assert( function( el ) {
		docElem.appendChild( el ).appendChild( document.createElement( "div" ) );
		return typeof el.querySelectorAll !== "undefined" &&
			!el.querySelectorAll( ":scope fieldset div" ).length;
	} );

	/* Attributes
	---------------------------------------------------------------------- */

	// Support: IE<8
	// Verify that getAttribute really returns attributes and not properties
	// (excepting IE8 booleans)
	support.attributes = assert( function( el ) {
		el.className = "i";
		return !el.getAttribute( "className" );
	} );

	/* getElement(s)By*
	---------------------------------------------------------------------- */

	// Check if getElementsByTagName("*") returns only elements
	support.getElementsByTagName = assert( function( el ) {
		el.appendChild( document.createComment( "" ) );
		return !el.getElementsByTagName( "*" ).length;
	} );

	// Support: IE<9
	support.getElementsByClassName = rnative.test( document.getElementsByClassName );

	// Support: IE<10
	// Check if getElementById returns elements by name
	// The broken getElementById methods don't pick up programmatically-set names,
	// so use a roundabout getElementsByName test
	support.getById = assert( function( el ) {
		docElem.appendChild( el ).id = expando;
		return !document.getElementsByName || !document.getElementsByName( expando ).length;
	} );

	// ID filter and find
	if ( support.getById ) {
		Expr.filter[ "ID" ] = function( id ) {
			var attrId = id.replace( runescape, funescape );
			return function( elem ) {
				return elem.getAttribute( "id" ) === attrId;
			};
		};
		Expr.find[ "ID" ] = function( id, context ) {
			if ( typeof context.getElementById !== "undefined" && documentIsHTML ) {
				var elem = context.getElementById( id );
				return elem ? [ elem ] : [];
			}
		};
	} else {
		Expr.filter[ "ID" ] =  function( id ) {
			var attrId = id.replace( runescape, funescape );
			return function( elem ) {
				var node = typeof elem.getAttributeNode !== "undefined" &&
					elem.getAttributeNode( "id" );
				return node && node.value === attrId;
			};
		};

		// Support: IE 6 - 7 only
		// getElementById is not reliable as a find shortcut
		Expr.find[ "ID" ] = function( id, context ) {
			if ( typeof context.getElementById !== "undefined" && documentIsHTML ) {
				var node, i, elems,
					elem = context.getElementById( id );

				if ( elem ) {

					// Verify the id attribute
					node = elem.getAttributeNode( "id" );
					if ( node && node.value === id ) {
						return [ elem ];
					}

					// Fall back on getElementsByName
					elems = context.getElementsByName( id );
					i = 0;
					while ( ( elem = elems[ i++ ] ) ) {
						node = elem.getAttributeNode( "id" );
						if ( node && node.value === id ) {
							return [ elem ];
						}
					}
				}

				return [];
			}
		};
	}

	// Tag
	Expr.find[ "TAG" ] = support.getElementsByTagName ?
		function( tag, context ) {
			if ( typeof context.getElementsByTagName !== "undefined" ) {
				return context.getElementsByTagName( tag );

			// DocumentFragment nodes don't have gEBTN
			} else if ( support.qsa ) {
				return context.querySelectorAll( tag );
			}
		} :

		function( tag, context ) {
			var elem,
				tmp = [],
				i = 0,

				// By happy coincidence, a (broken) gEBTN appears on DocumentFragment nodes too
				results = context.getElementsByTagName( tag );

			// Filter out possible comments
			if ( tag === "*" ) {
				while ( ( elem = results[ i++ ] ) ) {
					if ( elem.nodeType === 1 ) {
						tmp.push( elem );
					}
				}

				return tmp;
			}
			return results;
		};

	// Class
	Expr.find[ "CLASS" ] = support.getElementsByClassName && function( className, context ) {
		if ( typeof context.getElementsByClassName !== "undefined" && documentIsHTML ) {
			return context.getElementsByClassName( className );
		}
	};

	/* QSA/matchesSelector
	---------------------------------------------------------------------- */

	// QSA and matchesSelector support

	// matchesSelector(:active) reports false when true (IE9/Opera 11.5)
	rbuggyMatches = [];

	// qSa(:focus) reports false when true (Chrome 21)
	// We allow this because of a bug in IE8/9 that throws an error
	// whenever `document.activeElement` is accessed on an iframe
	// So, we allow :focus to pass through QSA all the time to avoid the IE error
	// See https://bugs.jquery.com/ticket/13378
	rbuggyQSA = [];

	if ( ( support.qsa = rnative.test( document.querySelectorAll ) ) ) {

		// Build QSA regex
		// Regex strategy adopted from Diego Perini
		assert( function( el ) {

			var input;

			// Select is set to empty string on purpose
			// This is to test IE's treatment of not explicitly
			// setting a boolean content attribute,
			// since its presence should be enough
			// https://bugs.jquery.com/ticket/12359
			docElem.appendChild( el ).innerHTML = "<a id='" + expando + "'></a>" +
				"<select id='" + expando + "-\r\\' msallowcapture=''>" +
				"<option selected=''></option></select>";

			// Support: IE8, Opera 11-12.16
			// Nothing should be selected when empty strings follow ^= or $= or *=
			// The test attribute must be unknown in Opera but "safe" for WinRT
			// https://msdn.microsoft.com/en-us/library/ie/hh465388.aspx#attribute_section
			if ( el.querySelectorAll( "[msallowcapture^='']" ).length ) {
				rbuggyQSA.push( "[*^$]=" + whitespace + "*(?:''|\"\")" );
			}

			// Support: IE8
			// Boolean attributes and "value" are not treated correctly
			if ( !el.querySelectorAll( "[selected]" ).length ) {
				rbuggyQSA.push( "\\[" + whitespace + "*(?:value|" + booleans + ")" );
			}

			// Support: Chrome<29, Android<4.4, Safari<7.0+, iOS<7.0+, PhantomJS<1.9.8+
			if ( !el.querySelectorAll( "[id~=" + expando + "-]" ).length ) {
				rbuggyQSA.push( "~=" );
			}

			// Support: IE 11+, Edge 15 - 18+
			// IE 11/Edge don't find elements on a `[name='']` query in some cases.
			// Adding a temporary attribute to the document before the selection works
			// around the issue.
			// Interestingly, IE 10 & older don't seem to have the issue.
			input = document.createElement( "input" );
			input.setAttribute( "name", "" );
			el.appendChild( input );
			if ( !el.querySelectorAll( "[name='']" ).length ) {
				rbuggyQSA.push( "\\[" + whitespace + "*name" + whitespace + "*=" +
					whitespace + "*(?:''|\"\")" );
			}

			// Webkit/Opera - :checked should return selected option elements
			// http://www.w3.org/TR/2011/REC-css3-selectors-20110929/#checked
			// IE8 throws error here and will not see later tests
			if ( !el.querySelectorAll( ":checked" ).length ) {
				rbuggyQSA.push( ":checked" );
			}

			// Support: Safari 8+, iOS 8+
			// https://bugs.webkit.org/show_bug.cgi?id=136851
			// In-page `selector#id sibling-combinator selector` fails
			if ( !el.querySelectorAll( "a#" + expando + "+*" ).length ) {
				rbuggyQSA.push( ".#.+[+~]" );
			}

			// Support: Firefox <=3.6 - 5 only
			// Old Firefox doesn't throw on a badly-escaped identifier.
			el.querySelectorAll( "\\\f" );
			rbuggyQSA.push( "[\\r\\n\\f]" );
		} );

		assert( function( el ) {
			el.innerHTML = "<a href='' disabled='disabled'></a>" +
				"<select disabled='disabled'><option/></select>";

			// Support: Windows 8 Native Apps
			// The type and name attributes are restricted during .innerHTML assignment
			var input = document.createElement( "input" );
			input.setAttribute( "type", "hidden" );
			el.appendChild( input ).setAttribute( "name", "D" );

			// Support: IE8
			// Enforce case-sensitivity of name attribute
			if ( el.querySelectorAll( "[name=d]" ).length ) {
				rbuggyQSA.push( "name" + whitespace + "*[*^$|!~]?=" );
			}

			// FF 3.5 - :enabled/:disabled and hidden elements (hidden elements are still enabled)
			// IE8 throws error here and will not see later tests
			if ( el.querySelectorAll( ":enabled" ).length !== 2 ) {
				rbuggyQSA.push( ":enabled", ":disabled" );
			}

			// Support: IE9-11+
			// IE's :disabled selector does not pick up the children of disabled fieldsets
			docElem.appendChild( el ).disabled = true;
			if ( el.querySelectorAll( ":disabled" ).length !== 2 ) {
				rbuggyQSA.push( ":enabled", ":disabled" );
			}

			// Support: Opera 10 - 11 only
			// Opera 10-11 does not throw on post-comma invalid pseudos
			el.querySelectorAll( "*,:x" );
			rbuggyQSA.push( ",.*:" );
		} );
	}

	if ( ( support.matchesSelector = rnative.test( ( matches = docElem.matches ||
		docElem.webkitMatchesSelector ||
		docElem.mozMatchesSelector ||
		docElem.oMatchesSelector ||
		docElem.msMatchesSelector ) ) ) ) {

		assert( function( el ) {

			// Check to see if it's possible to do matchesSelector
			// on a disconnected node (IE 9)
			support.disconnectedMatch = matches.call( el, "*" );

			// This should fail with an exception
			// Gecko does not error, returns false instead
			matches.call( el, "[s!='']:x" );
			rbuggyMatches.push( "!=", pseudos );
		} );
	}

	rbuggyQSA = rbuggyQSA.length && new RegExp( rbuggyQSA.join( "|" ) );
	rbuggyMatches = rbuggyMatches.length && new RegExp( rbuggyMatches.join( "|" ) );

	/* Contains
	---------------------------------------------------------------------- */
	hasCompare = rnative.test( docElem.compareDocumentPosition );

	// Element contains another
	// Purposefully self-exclusive
	// As in, an element does not contain itself
	contains = hasCompare || rnative.test( docElem.contains ) ?
		function( a, b ) {
			var adown = a.nodeType === 9 ? a.documentElement : a,
				bup = b && b.parentNode;
			return a === bup || !!( bup && bup.nodeType === 1 && (
				adown.contains ?
					adown.contains( bup ) :
					a.compareDocumentPosition && a.compareDocumentPosition( bup ) & 16
			) );
		} :
		function( a, b ) {
			if ( b ) {
				while ( ( b = b.parentNode ) ) {
					if ( b === a ) {
						return true;
					}
				}
			}
			return false;
		};

	/* Sorting
	---------------------------------------------------------------------- */

	// Document order sorting
	sortOrder = hasCompare ?
	function( a, b ) {

		// Flag for duplicate removal
		if ( a === b ) {
			hasDuplicate = true;
			return 0;
		}

		// Sort on method existence if only one input has compareDocumentPosition
		var compare = !a.compareDocumentPosition - !b.compareDocumentPosition;
		if ( compare ) {
			return compare;
		}

		// Calculate position if both inputs belong to the same document
		// Support: IE 11+, Edge 17 - 18+
		// IE/Edge sometimes throw a "Permission denied" error when strict-comparing
		// two documents; shallow comparisons work.
		// eslint-disable-next-line eqeqeq
		compare = ( a.ownerDocument || a ) == ( b.ownerDocument || b ) ?
			a.compareDocumentPosition( b ) :

			// Otherwise we know they are disconnected
			1;

		// Disconnected nodes
		if ( compare & 1 ||
			( !support.sortDetached && b.compareDocumentPosition( a ) === compare ) ) {

			// Choose the first element that is related to our preferred document
			// Support: IE 11+, Edge 17 - 18+
			// IE/Edge sometimes throw a "Permission denied" error when strict-comparing
			// two documents; shallow comparisons work.
			// eslint-disable-next-line eqeqeq
			if ( a == document || a.ownerDocument == preferredDoc &&
				contains( preferredDoc, a ) ) {
				return -1;
			}

			// Support: IE 11+, Edge 17 - 18+
			// IE/Edge sometimes throw a "Permission denied" error when strict-comparing
			// two documents; shallow comparisons work.
			// eslint-disable-next-line eqeqeq
			if ( b == document || b.ownerDocument == preferredDoc &&
				contains( preferredDoc, b ) ) {
				return 1;
			}

			// Maintain original order
			return sortInput ?
				( indexOf( sortInput, a ) - indexOf( sortInput, b ) ) :
				0;
		}

		return compare & 4 ? -1 : 1;
	} :
	function( a, b ) {

		// Exit early if the nodes are identical
		if ( a === b ) {
			hasDuplicate = true;
			return 0;
		}

		var cur,
			i = 0,
			aup = a.parentNode,
			bup = b.parentNode,
			ap = [ a ],
			bp = [ b ];

		// Parentless nodes are either documents or disconnected
		if ( !aup || !bup ) {

			// Support: IE 11+, Edge 17 - 18+
			// IE/Edge sometimes throw a "Permission denied" error when strict-comparing
			// two documents; shallow comparisons work.
			/* eslint-disable eqeqeq */
			return a == document ? -1 :
				b == document ? 1 :
				/* eslint-enable eqeqeq */
				aup ? -1 :
				bup ? 1 :
				sortInput ?
				( indexOf( sortInput, a ) - indexOf( sortInput, b ) ) :
				0;

		// If the nodes are siblings, we can do a quick check
		} else if ( aup === bup ) {
			return siblingCheck( a, b );
		}

		// Otherwise we need full lists of their ancestors for comparison
		cur = a;
		while ( ( cur = cur.parentNode ) ) {
			ap.unshift( cur );
		}
		cur = b;
		while ( ( cur = cur.parentNode ) ) {
			bp.unshift( cur );
		}

		// Walk down the tree looking for a discrepancy
		while ( ap[ i ] === bp[ i ] ) {
			i++;
		}

		return i ?

			// Do a sibling check if the nodes have a common ancestor
			siblingCheck( ap[ i ], bp[ i ] ) :

			// Otherwise nodes in our document sort first
			// Support: IE 11+, Edge 17 - 18+
			// IE/Edge sometimes throw a "Permission denied" error when strict-comparing
			// two documents; shallow comparisons work.
			/* eslint-disable eqeqeq */
			ap[ i ] == preferredDoc ? -1 :
			bp[ i ] == preferredDoc ? 1 :
			/* eslint-enable eqeqeq */
			0;
	};

	return document;
};

Sizzle.matches = function( expr, elements ) {
	return Sizzle( expr, null, null, elements );
};

Sizzle.matchesSelector = function( elem, expr ) {
	setDocument( elem );

	if ( support.matchesSelector && documentIsHTML &&
		!nonnativeSelectorCache[ expr + " " ] &&
		( !rbuggyMatches || !rbuggyMatches.test( expr ) ) &&
		( !rbuggyQSA     || !rbuggyQSA.test( expr ) ) ) {

		try {
			var ret = matches.call( elem, expr );

			// IE 9's matchesSelector returns false on disconnected nodes
			if ( ret || support.disconnectedMatch ||

				// As well, disconnected nodes are said to be in a document
				// fragment in IE 9
				elem.document && elem.document.nodeType !== 11 ) {
				return ret;
			}
		} catch ( e ) {
			nonnativeSelectorCache( expr, true );
		}
	}

	return Sizzle( expr, document, null, [ elem ] ).length > 0;
};

Sizzle.contains = function( context, elem ) {

	// Set document vars if needed
	// Support: IE 11+, Edge 17 - 18+
	// IE/Edge sometimes throw a "Permission denied" error when strict-comparing
	// two documents; shallow comparisons work.
	// eslint-disable-next-line eqeqeq
	if ( ( context.ownerDocument || context ) != document ) {
		setDocument( context );
	}
	return contains( context, elem );
};

Sizzle.attr = function( elem, name ) {

	// Set document vars if needed
	// Support: IE 11+, Edge 17 - 18+
	// IE/Edge sometimes throw a "Permission denied" error when strict-comparing
	// two documents; shallow comparisons work.
	// eslint-disable-next-line eqeqeq
	if ( ( elem.ownerDocument || elem ) != document ) {
		setDocument( elem );
	}

	var fn = Expr.attrHandle[ name.toLowerCase() ],

		// Don't get fooled by Object.prototype properties (jQuery #13807)
		val = fn && hasOwn.call( Expr.attrHandle, name.toLowerCase() ) ?
			fn( elem, name, !documentIsHTML ) :
			undefined;

	return val !== undefined ?
		val :
		support.attributes || !documentIsHTML ?
			elem.getAttribute( name ) :
			( val = elem.getAttributeNode( name ) ) && val.specified ?
				val.value :
				null;
};

Sizzle.escape = function( sel ) {
	return ( sel + "" ).replace( rcssescape, fcssescape );
};

Sizzle.error = function( msg ) {
	throw new Error( "Syntax error, unrecognized expression: " + msg );
};

/**
 * Document sorting and removing duplicates
 * @param {ArrayLike} results
 */
Sizzle.uniqueSort = function( results ) {
	var elem,
		duplicates = [],
		j = 0,
		i = 0;

	// Unless we *know* we can detect duplicates, assume their presence
	hasDuplicate = !support.detectDuplicates;
	sortInput = !support.sortStable && results.slice( 0 );
	results.sort( sortOrder );

	if ( hasDuplicate ) {
		while ( ( elem = results[ i++ ] ) ) {
			if ( elem === results[ i ] ) {
				j = duplicates.push( i );
			}
		}
		while ( j-- ) {
			results.splice( duplicates[ j ], 1 );
		}
	}

	// Clear input after sorting to release objects
	// See https://github.com/jquery/sizzle/pull/225
	sortInput = null;

	return results;
};

/**
 * Utility function for retrieving the text value of an array of DOM nodes
 * @param {Array|Element} elem
 */
getText = Sizzle.getText = function( elem ) {
	var node,
		ret = "",
		i = 0,
		nodeType = elem.nodeType;

	if ( !nodeType ) {

		// If no nodeType, this is expected to be an array
		while ( ( node = elem[ i++ ] ) ) {

			// Do not traverse comment nodes
			ret += getText( node );
		}
	} else if ( nodeType === 1 || nodeType === 9 || nodeType === 11 ) {

		// Use textContent for elements
		// innerText usage removed for consistency of new lines (jQuery #11153)
		if ( typeof elem.textContent === "string" ) {
			return elem.textContent;
		} else {

			// Traverse its children
			for ( elem = elem.firstChild; elem; elem = elem.nextSibling ) {
				ret += getText( elem );
			}
		}
	} else if ( nodeType === 3 || nodeType === 4 ) {
		return elem.nodeValue;
	}

	// Do not include comment or processing instruction nodes

	return ret;
};

Expr = Sizzle.selectors = {

	// Can be adjusted by the user
	cacheLength: 50,

	createPseudo: markFunction,

	match: matchExpr,

	attrHandle: {},

	find: {},

	relative: {
		">": { dir: "parentNode", first: true },
		" ": { dir: "parentNode" },
		"+": { dir: "previousSibling", first: true },
		"~": { dir: "previousSibling" }
	},

	preFilter: {
		"ATTR": function( match ) {
			match[ 1 ] = match[ 1 ].replace( runescape, funescape );

			// Move the given value to match[3] whether quoted or unquoted
			match[ 3 ] = ( match[ 3 ] || match[ 4 ] ||
				match[ 5 ] || "" ).replace( runescape, funescape );

			if ( match[ 2 ] === "~=" ) {
				match[ 3 ] = " " + match[ 3 ] + " ";
			}

			return match.slice( 0, 4 );
		},

		"CHILD": function( match ) {

			/* matches from matchExpr["CHILD"]
				1 type (only|nth|...)
				2 what (child|of-type)
				3 argument (even|odd|\d*|\d*n([+-]\d+)?|...)
				4 xn-component of xn+y argument ([+-]?\d*n|)
				5 sign of xn-component
				6 x of xn-component
				7 sign of y-component
				8 y of y-component
			*/
			match[ 1 ] = match[ 1 ].toLowerCase();

			if ( match[ 1 ].slice( 0, 3 ) === "nth" ) {

				// nth-* requires argument
				if ( !match[ 3 ] ) {
					Sizzle.error( match[ 0 ] );
				}

				// numeric x and y parameters for Expr.filter.CHILD
				// remember that false/true cast respectively to 0/1
				match[ 4 ] = +( match[ 4 ] ?
					match[ 5 ] + ( match[ 6 ] || 1 ) :
					2 * ( match[ 3 ] === "even" || match[ 3 ] === "odd" ) );
				match[ 5 ] = +( ( match[ 7 ] + match[ 8 ] ) || match[ 3 ] === "odd" );

				// other types prohibit arguments
			} else if ( match[ 3 ] ) {
				Sizzle.error( match[ 0 ] );
			}

			return match;
		},

		"PSEUDO": function( match ) {
			var excess,
				unquoted = !match[ 6 ] && match[ 2 ];

			if ( matchExpr[ "CHILD" ].test( match[ 0 ] ) ) {
				return null;
			}

			// Accept quoted arguments as-is
			if ( match[ 3 ] ) {
				match[ 2 ] = match[ 4 ] || match[ 5 ] || "";

			// Strip excess characters from unquoted arguments
			} else if ( unquoted && rpseudo.test( unquoted ) &&

				// Get excess from tokenize (recursively)
				( excess = tokenize( unquoted, true ) ) &&

				// advance to the next closing parenthesis
				( excess = unquoted.indexOf( ")", unquoted.length - excess ) - unquoted.length ) ) {

				// excess is a negative index
				match[ 0 ] = match[ 0 ].slice( 0, excess );
				match[ 2 ] = unquoted.slice( 0, excess );
			}

			// Return only captures needed by the pseudo filter method (type and argument)
			return match.slice( 0, 3 );
		}
	},

	filter: {

		"TAG": function( nodeNameSelector ) {
			var nodeName = nodeNameSelector.replace( runescape, funescape ).toLowerCase();
			return nodeNameSelector === "*" ?
				function() {
					return true;
				} :
				function( elem ) {
					return elem.nodeName && elem.nodeName.toLowerCase() === nodeName;
				};
		},

		"CLASS": function( className ) {
			var pattern = classCache[ className + " " ];

			return pattern ||
				( pattern = new RegExp( "(^|" + whitespace +
					")" + className + "(" + whitespace + "|$)" ) ) && classCache(
						className, function( elem ) {
							return pattern.test(
								typeof elem.className === "string" && elem.className ||
								typeof elem.getAttribute !== "undefined" &&
									elem.getAttribute( "class" ) ||
								""
							);
				} );
		},

		"ATTR": function( name, operator, check ) {
			return function( elem ) {
				var result = Sizzle.attr( elem, name );

				if ( result == null ) {
					return operator === "!=";
				}
				if ( !operator ) {
					return true;
				}

				result += "";

				/* eslint-disable max-len */

				return operator === "=" ? result === check :
					operator === "!=" ? result !== check :
					operator === "^=" ? check && result.indexOf( check ) === 0 :
					operator === "*=" ? check && result.indexOf( check ) > -1 :
					operator === "$=" ? check && result.slice( -check.length ) === check :
					operator === "~=" ? ( " " + result.replace( rwhitespace, " " ) + " " ).indexOf( check ) > -1 :
					operator === "|=" ? result === check || result.slice( 0, check.length + 1 ) === check + "-" :
					false;
				/* eslint-enable max-len */

			};
		},

		"CHILD": function( type, what, _argument, first, last ) {
			var simple = type.slice( 0, 3 ) !== "nth",
				forward = type.slice( -4 ) !== "last",
				ofType = what === "of-type";

			return first === 1 && last === 0 ?

				// Shortcut for :nth-*(n)
				function( elem ) {
					return !!elem.parentNode;
				} :

				function( elem, _context, xml ) {
					var cache, uniqueCache, outerCache, node, nodeIndex, start,
						dir = simple !== forward ? "nextSibling" : "previousSibling",
						parent = elem.parentNode,
						name = ofType && elem.nodeName.toLowerCase(),
						useCache = !xml && !ofType,
						diff = false;

					if ( parent ) {

						// :(first|last|only)-(child|of-type)
						if ( simple ) {
							while ( dir ) {
								node = elem;
								while ( ( node = node[ dir ] ) ) {
									if ( ofType ?
										node.nodeName.toLowerCase() === name :
										node.nodeType === 1 ) {

										return false;
									}
								}

								// Reverse direction for :only-* (if we haven't yet done so)
								start = dir = type === "only" && !start && "nextSibling";
							}
							return true;
						}

						start = [ forward ? parent.firstChild : parent.lastChild ];

						// non-xml :nth-child(...) stores cache data on `parent`
						if ( forward && useCache ) {

							// Seek `elem` from a previously-cached index

							// ...in a gzip-friendly way
							node = parent;
							outerCache = node[ expando ] || ( node[ expando ] = {} );

							// Support: IE <9 only
							// Defend against cloned attroperties (jQuery gh-1709)
							uniqueCache = outerCache[ node.uniqueID ] ||
								( outerCache[ node.uniqueID ] = {} );

							cache = uniqueCache[ type ] || [];
							nodeIndex = cache[ 0 ] === dirruns && cache[ 1 ];
							diff = nodeIndex && cache[ 2 ];
							node = nodeIndex && parent.childNodes[ nodeIndex ];

							while ( ( node = ++nodeIndex && node && node[ dir ] ||

								// Fallback to seeking `elem` from the start
								( diff = nodeIndex = 0 ) || start.pop() ) ) {

								// When found, cache indexes on `parent` and break
								if ( node.nodeType === 1 && ++diff && node === elem ) {
									uniqueCache[ type ] = [ dirruns, nodeIndex, diff ];
									break;
								}
							}

						} else {

							// Use previously-cached element index if available
							if ( useCache ) {

								// ...in a gzip-friendly way
								node = elem;
								outerCache = node[ expando ] || ( node[ expando ] = {} );

								// Support: IE <9 only
								// Defend against cloned attroperties (jQuery gh-1709)
								uniqueCache = outerCache[ node.uniqueID ] ||
									( outerCache[ node.uniqueID ] = {} );

								cache = uniqueCache[ type ] || [];
								nodeIndex = cache[ 0 ] === dirruns && cache[ 1 ];
								diff = nodeIndex;
							}

							// xml :nth-child(...)
							// or :nth-last-child(...) or :nth(-last)?-of-type(...)
							if ( diff === false ) {

								// Use the same loop as above to seek `elem` from the start
								while ( ( node = ++nodeIndex && node && node[ dir ] ||
									( diff = nodeIndex = 0 ) || start.pop() ) ) {

									if ( ( ofType ?
										node.nodeName.toLowerCase() === name :
										node.nodeType === 1 ) &&
										++diff ) {

										// Cache the index of each encountered element
										if ( useCache ) {
											outerCache = node[ expando ] ||
												( node[ expando ] = {} );

											// Support: IE <9 only
											// Defend against cloned attroperties (jQuery gh-1709)
											uniqueCache = outerCache[ node.uniqueID ] ||
												( outerCache[ node.uniqueID ] = {} );

											uniqueCache[ type ] = [ dirruns, diff ];
										}

										if ( node === elem ) {
											break;
										}
									}
								}
							}
						}

						// Incorporate the offset, then check against cycle size
						diff -= last;
						return diff === first || ( diff % first === 0 && diff / first >= 0 );
					}
				};
		},

		"PSEUDO": function( pseudo, argument ) {

			// pseudo-class names are case-insensitive
			// http://www.w3.org/TR/selectors/#pseudo-classes
			// Prioritize by case sensitivity in case custom pseudos are added with uppercase letters
			// Remember that setFilters inherits from pseudos
			var args,
				fn = Expr.pseudos[ pseudo ] || Expr.setFilters[ pseudo.toLowerCase() ] ||
					Sizzle.error( "unsupported pseudo: " + pseudo );

			// The user may use createPseudo to indicate that
			// arguments are needed to create the filter function
			// just as Sizzle does
			if ( fn[ expando ] ) {
				return fn( argument );
			}

			// But maintain support for old signatures
			if ( fn.length > 1 ) {
				args = [ pseudo, pseudo, "", argument ];
				return Expr.setFilters.hasOwnProperty( pseudo.toLowerCase() ) ?
					markFunction( function( seed, matches ) {
						var idx,
							matched = fn( seed, argument ),
							i = matched.length;
						while ( i-- ) {
							idx = indexOf( seed, matched[ i ] );
							seed[ idx ] = !( matches[ idx ] = matched[ i ] );
						}
					} ) :
					function( elem ) {
						return fn( elem, 0, args );
					};
			}

			return fn;
		}
	},

	pseudos: {

		// Potentially complex pseudos
		"not": markFunction( function( selector ) {

			// Trim the selector passed to compile
			// to avoid treating leading and trailing
			// spaces as combinators
			var input = [],
				results = [],
				matcher = compile( selector.replace( rtrim, "$1" ) );

			return matcher[ expando ] ?
				markFunction( function( seed, matches, _context, xml ) {
					var elem,
						unmatched = matcher( seed, null, xml, [] ),
						i = seed.length;

					// Match elements unmatched by `matcher`
					while ( i-- ) {
						if ( ( elem = unmatched[ i ] ) ) {
							seed[ i ] = !( matches[ i ] = elem );
						}
					}
				} ) :
				function( elem, _context, xml ) {
					input[ 0 ] = elem;
					matcher( input, null, xml, results );

					// Don't keep the element (issue #299)
					input[ 0 ] = null;
					return !results.pop();
				};
		} ),

		"has": markFunction( function( selector ) {
			return function( elem ) {
				return Sizzle( selector, elem ).length > 0;
			};
		} ),

		"contains": markFunction( function( text ) {
			text = text.replace( runescape, funescape );
			return function( elem ) {
				return ( elem.textContent || getText( elem ) ).indexOf( text ) > -1;
			};
		} ),

		// "Whether an element is represented by a :lang() selector
		// is based solely on the element's language value
		// being equal to the identifier C,
		// or beginning with the identifier C immediately followed by "-".
		// The matching of C against the element's language value is performed case-insensitively.
		// The identifier C does not have to be a valid language name."
		// http://www.w3.org/TR/selectors/#lang-pseudo
		"lang": markFunction( function( lang ) {

			// lang value must be a valid identifier
			if ( !ridentifier.test( lang || "" ) ) {
				Sizzle.error( "unsupported lang: " + lang );
			}
			lang = lang.replace( runescape, funescape ).toLowerCase();
			return function( elem ) {
				var elemLang;
				do {
					if ( ( elemLang = documentIsHTML ?
						elem.lang :
						elem.getAttribute( "xml:lang" ) || elem.getAttribute( "lang" ) ) ) {

						elemLang = elemLang.toLowerCase();
						return elemLang === lang || elemLang.indexOf( lang + "-" ) === 0;
					}
				} while ( ( elem = elem.parentNode ) && elem.nodeType === 1 );
				return false;
			};
		} ),

		// Miscellaneous
		"target": function( elem ) {
			var hash = window.location && window.location.hash;
			return hash && hash.slice( 1 ) === elem.id;
		},

		"root": function( elem ) {
			return elem === docElem;
		},

		"focus": function( elem ) {
			return elem === document.activeElement &&
				( !document.hasFocus || document.hasFocus() ) &&
				!!( elem.type || elem.href || ~elem.tabIndex );
		},

		// Boolean properties
		"enabled": createDisabledPseudo( false ),
		"disabled": createDisabledPseudo( true ),

		"checked": function( elem ) {

			// In CSS3, :checked should return both checked and selected elements
			// http://www.w3.org/TR/2011/REC-css3-selectors-20110929/#checked
			var nodeName = elem.nodeName.toLowerCase();
			return ( nodeName === "input" && !!elem.checked ) ||
				( nodeName === "option" && !!elem.selected );
		},

		"selected": function( elem ) {

			// Accessing this property makes selected-by-default
			// options in Safari work properly
			if ( elem.parentNode ) {
				// eslint-disable-next-line no-unused-expressions
				elem.parentNode.selectedIndex;
			}

			return elem.selected === true;
		},

		// Contents
		"empty": function( elem ) {

			// http://www.w3.org/TR/selectors/#empty-pseudo
			// :empty is negated by element (1) or content nodes (text: 3; cdata: 4; entity ref: 5),
			//   but not by others (comment: 8; processing instruction: 7; etc.)
			// nodeType < 6 works because attributes (2) do not appear as children
			for ( elem = elem.firstChild; elem; elem = elem.nextSibling ) {
				if ( elem.nodeType < 6 ) {
					return false;
				}
			}
			return true;
		},

		"parent": function( elem ) {
			return !Expr.pseudos[ "empty" ]( elem );
		},

		// Element/input types
		"header": function( elem ) {
			return rheader.test( elem.nodeName );
		},

		"input": function( elem ) {
			return rinputs.test( elem.nodeName );
		},

		"button": function( elem ) {
			var name = elem.nodeName.toLowerCase();
			return name === "input" && elem.type === "button" || name === "button";
		},

		"text": function( elem ) {
			var attr;
			return elem.nodeName.toLowerCase() === "input" &&
				elem.type === "text" &&

				// Support: IE<8
				// New HTML5 attribute values (e.g., "search") appear with elem.type === "text"
				( ( attr = elem.getAttribute( "type" ) ) == null ||
					attr.toLowerCase() === "text" );
		},

		// Position-in-collection
		"first": createPositionalPseudo( function() {
			return [ 0 ];
		} ),

		"last": createPositionalPseudo( function( _matchIndexes, length ) {
			return [ length - 1 ];
		} ),

		"eq": createPositionalPseudo( function( _matchIndexes, length, argument ) {
			return [ argument < 0 ? argument + length : argument ];
		} ),

		"even": createPositionalPseudo( function( matchIndexes, length ) {
			var i = 0;
			for ( ; i < length; i += 2 ) {
				matchIndexes.push( i );
			}
			return matchIndexes;
		} ),

		"odd": createPositionalPseudo( function( matchIndexes, length ) {
			var i = 1;
			for ( ; i < length; i += 2 ) {
				matchIndexes.push( i );
			}
			return matchIndexes;
		} ),

		"lt": createPositionalPseudo( function( matchIndexes, length, argument ) {
			var i = argument < 0 ?
				argument + length :
				argument > length ?
					length :
					argument;
			for ( ; --i >= 0; ) {
				matchIndexes.push( i );
			}
			return matchIndexes;
		} ),

		"gt": createPositionalPseudo( function( matchIndexes, length, argument ) {
			var i = argument < 0 ? argument + length : argument;
			for ( ; ++i < length; ) {
				matchIndexes.push( i );
			}
			return matchIndexes;
		} )
	}
};

Expr.pseudos[ "nth" ] = Expr.pseudos[ "eq" ];

// Add button/input type pseudos
for ( i in { radio: true, checkbox: true, file: true, password: true, image: true } ) {
	Expr.pseudos[ i ] = createInputPseudo( i );
}
for ( i in { submit: true, reset: true } ) {
	Expr.pseudos[ i ] = createButtonPseudo( i );
}

// Easy API for creating new setFilters
function setFilters() {}
setFilters.prototype = Expr.filters = Expr.pseudos;
Expr.setFilters = new setFilters();

tokenize = Sizzle.tokenize = function( selector, parseOnly ) {
	var matched, match, tokens, type,
		soFar, groups, preFilters,
		cached = tokenCache[ selector + " " ];

	if ( cached ) {
		return parseOnly ? 0 : cached.slice( 0 );
	}

	soFar = selector;
	groups = [];
	preFilters = Expr.preFilter;

	while ( soFar ) {

		// Comma and first run
		if ( !matched || ( match = rcomma.exec( soFar ) ) ) {
			if ( match ) {

				// Don't consume trailing commas as valid
				soFar = soFar.slice( match[ 0 ].length ) || soFar;
			}
			groups.push( ( tokens = [] ) );
		}

		matched = false;

		// Combinators
		if ( ( match = rcombinators.exec( soFar ) ) ) {
			matched = match.shift();
			tokens.push( {
				value: matched,

				// Cast descendant combinators to space
				type: match[ 0 ].replace( rtrim, " " )
			} );
			soFar = soFar.slice( matched.length );
		}

		// Filters
		for ( type in Expr.filter ) {
			if ( ( match = matchExpr[ type ].exec( soFar ) ) && ( !preFilters[ type ] ||
				( match = preFilters[ type ]( match ) ) ) ) {
				matched = match.shift();
				tokens.push( {
					value: matched,
					type: type,
					matches: match
				} );
				soFar = soFar.slice( matched.length );
			}
		}

		if ( !matched ) {
			break;
		}
	}

	// Return the length of the invalid excess
	// if we're just parsing
	// Otherwise, throw an error or return tokens
	return parseOnly ?
		soFar.length :
		soFar ?
			Sizzle.error( selector ) :

			// Cache the tokens
			tokenCache( selector, groups ).slice( 0 );
};

function toSelector( tokens ) {
	var i = 0,
		len = tokens.length,
		selector = "";
	for ( ; i < len; i++ ) {
		selector += tokens[ i ].value;
	}
	return selector;
}

function addCombinator( matcher, combinator, base ) {
	var dir = combinator.dir,
		skip = combinator.next,
		key = skip || dir,
		checkNonElements = base && key === "parentNode",
		doneName = done++;

	return combinator.first ?

		// Check against closest ancestor/preceding element
		function( elem, context, xml ) {
			while ( ( elem = elem[ dir ] ) ) {
				if ( elem.nodeType === 1 || checkNonElements ) {
					return matcher( elem, context, xml );
				}
			}
			return false;
		} :

		// Check against all ancestor/preceding elements
		function( elem, context, xml ) {
			var oldCache, uniqueCache, outerCache,
				newCache = [ dirruns, doneName ];

			// We can't set arbitrary data on XML nodes, so they don't benefit from combinator caching
			if ( xml ) {
				while ( ( elem = elem[ dir ] ) ) {
					if ( elem.nodeType === 1 || checkNonElements ) {
						if ( matcher( elem, context, xml ) ) {
							return true;
						}
					}
				}
			} else {
				while ( ( elem = elem[ dir ] ) ) {
					if ( elem.nodeType === 1 || checkNonElements ) {
						outerCache = elem[ expando ] || ( elem[ expando ] = {} );

						// Support: IE <9 only
						// Defend against cloned attroperties (jQuery gh-1709)
						uniqueCache = outerCache[ elem.uniqueID ] ||
							( outerCache[ elem.uniqueID ] = {} );

						if ( skip && skip === elem.nodeName.toLowerCase() ) {
							elem = elem[ dir ] || elem;
						} else if ( ( oldCache = uniqueCache[ key ] ) &&
							oldCache[ 0 ] === dirruns && oldCache[ 1 ] === doneName ) {

							// Assign to newCache so results back-propagate to previous elements
							return ( newCache[ 2 ] = oldCache[ 2 ] );
						} else {

							// Reuse newcache so results back-propagate to previous elements
							uniqueCache[ key ] = newCache;

							// A match means we're done; a fail means we have to keep checking
							if ( ( newCache[ 2 ] = matcher( elem, context, xml ) ) ) {
								return true;
							}
						}
					}
				}
			}
			return false;
		};
}

function elementMatcher( matchers ) {
	return matchers.length > 1 ?
		function( elem, context, xml ) {
			var i = matchers.length;
			while ( i-- ) {
				if ( !matchers[ i ]( elem, context, xml ) ) {
					return false;
				}
			}
			return true;
		} :
		matchers[ 0 ];
}

function multipleContexts( selector, contexts, results ) {
	var i = 0,
		len = contexts.length;
	for ( ; i < len; i++ ) {
		Sizzle( selector, contexts[ i ], results );
	}
	return results;
}

function condense( unmatched, map, filter, context, xml ) {
	var elem,
		newUnmatched = [],
		i = 0,
		len = unmatched.length,
		mapped = map != null;

	for ( ; i < len; i++ ) {
		if ( ( elem = unmatched[ i ] ) ) {
			if ( !filter || filter( elem, context, xml ) ) {
				newUnmatched.push( elem );
				if ( mapped ) {
					map.push( i );
				}
			}
		}
	}

	return newUnmatched;
}

function setMatcher( preFilter, selector, matcher, postFilter, postFinder, postSelector ) {
	if ( postFilter && !postFilter[ expando ] ) {
		postFilter = setMatcher( postFilter );
	}
	if ( postFinder && !postFinder[ expando ] ) {
		postFinder = setMatcher( postFinder, postSelector );
	}
	return markFunction( function( seed, results, context, xml ) {
		var temp, i, elem,
			preMap = [],
			postMap = [],
			preexisting = results.length,

			// Get initial elements from seed or context
			elems = seed || multipleContexts(
				selector || "*",
				context.nodeType ? [ context ] : context,
				[]
			),

			// Prefilter to get matcher input, preserving a map for seed-results synchronization
			matcherIn = preFilter && ( seed || !selector ) ?
				condense( elems, preMap, preFilter, context, xml ) :
				elems,

			matcherOut = matcher ?

				// If we have a postFinder, or filtered seed, or non-seed postFilter or preexisting results,
				postFinder || ( seed ? preFilter : preexisting || postFilter ) ?

					// ...intermediate processing is necessary
					[] :

					// ...otherwise use results directly
					results :
				matcherIn;

		// Find primary matches
		if ( matcher ) {
			matcher( matcherIn, matcherOut, context, xml );
		}

		// Apply postFilter
		if ( postFilter ) {
			temp = condense( matcherOut, postMap );
			postFilter( temp, [], context, xml );

			// Un-match failing elements by moving them back to matcherIn
			i = temp.length;
			while ( i-- ) {
				if ( ( elem = temp[ i ] ) ) {
					matcherOut[ postMap[ i ] ] = !( matcherIn[ postMap[ i ] ] = elem );
				}
			}
		}

		if ( seed ) {
			if ( postFinder || preFilter ) {
				if ( postFinder ) {

					// Get the final matcherOut by condensing this intermediate into postFinder contexts
					temp = [];
					i = matcherOut.length;
					while ( i-- ) {
						if ( ( elem = matcherOut[ i ] ) ) {

							// Restore matcherIn since elem is not yet a final match
							temp.push( ( matcherIn[ i ] = elem ) );
						}
					}
					postFinder( null, ( matcherOut = [] ), temp, xml );
				}

				// Move matched elements from seed to results to keep them synchronized
				i = matcherOut.length;
				while ( i-- ) {
					if ( ( elem = matcherOut[ i ] ) &&
						( temp = postFinder ? indexOf( seed, elem ) : preMap[ i ] ) > -1 ) {

						seed[ temp ] = !( results[ temp ] = elem );
					}
				}
			}

		// Add elements to results, through postFinder if defined
		} else {
			matcherOut = condense(
				matcherOut === results ?
					matcherOut.splice( preexisting, matcherOut.length ) :
					matcherOut
			);
			if ( postFinder ) {
				postFinder( null, results, matcherOut, xml );
			} else {
				push.apply( results, matcherOut );
			}
		}
	} );
}

function matcherFromTokens( tokens ) {
	var checkContext, matcher, j,
		len = tokens.length,
		leadingRelative = Expr.relative[ tokens[ 0 ].type ],
		implicitRelative = leadingRelative || Expr.relative[ " " ],
		i = leadingRelative ? 1 : 0,

		// The foundational matcher ensures that elements are reachable from top-level context(s)
		matchContext = addCombinator( function( elem ) {
			return elem === checkContext;
		}, implicitRelative, true ),
		matchAnyContext = addCombinator( function( elem ) {
			return indexOf( checkContext, elem ) > -1;
		}, implicitRelative, true ),
		matchers = [ function( elem, context, xml ) {
			var ret = ( !leadingRelative && ( xml || context !== outermostContext ) ) || (
				( checkContext = context ).nodeType ?
					matchContext( elem, context, xml ) :
					matchAnyContext( elem, context, xml ) );

			// Avoid hanging onto element (issue #299)
			checkContext = null;
			return ret;
		} ];

	for ( ; i < len; i++ ) {
		if ( ( matcher = Expr.relative[ tokens[ i ].type ] ) ) {
			matchers = [ addCombinator( elementMatcher( matchers ), matcher ) ];
		} else {
			matcher = Expr.filter[ tokens[ i ].type ].apply( null, tokens[ i ].matches );

			// Return special upon seeing a positional matcher
			if ( matcher[ expando ] ) {

				// Find the next relative operator (if any) for proper handling
				j = ++i;
				for ( ; j < len; j++ ) {
					if ( Expr.relative[ tokens[ j ].type ] ) {
						break;
					}
				}
				return setMatcher(
					i > 1 && elementMatcher( matchers ),
					i > 1 && toSelector(

					// If the preceding token was a descendant combinator, insert an implicit any-element `*`
					tokens
						.slice( 0, i - 1 )
						.concat( { value: tokens[ i - 2 ].type === " " ? "*" : "" } )
					).replace( rtrim, "$1" ),
					matcher,
					i < j && matcherFromTokens( tokens.slice( i, j ) ),
					j < len && matcherFromTokens( ( tokens = tokens.slice( j ) ) ),
					j < len && toSelector( tokens )
				);
			}
			matchers.push( matcher );
		}
	}

	return elementMatcher( matchers );
}

function matcherFromGroupMatchers( elementMatchers, setMatchers ) {
	var bySet = setMatchers.length > 0,
		byElement = elementMatchers.length > 0,
		superMatcher = function( seed, context, xml, results, outermost ) {
			var elem, j, matcher,
				matchedCount = 0,
				i = "0",
				unmatched = seed && [],
				setMatched = [],
				contextBackup = outermostContext,

				// We must always have either seed elements or outermost context
				elems = seed || byElement && Expr.find[ "TAG" ]( "*", outermost ),

				// Use integer dirruns iff this is the outermost matcher
				dirrunsUnique = ( dirruns += contextBackup == null ? 1 : Math.random() || 0.1 ),
				len = elems.length;

			if ( outermost ) {

				// Support: IE 11+, Edge 17 - 18+
				// IE/Edge sometimes throw a "Permission denied" error when strict-comparing
				// two documents; shallow comparisons work.
				// eslint-disable-next-line eqeqeq
				outermostContext = context == document || context || outermost;
			}

			// Add elements passing elementMatchers directly to results
			// Support: IE<9, Safari
			// Tolerate NodeList properties (IE: "length"; Safari: <number>) matching elements by id
			for ( ; i !== len && ( elem = elems[ i ] ) != null; i++ ) {
				if ( byElement && elem ) {
					j = 0;

					// Support: IE 11+, Edge 17 - 18+
					// IE/Edge sometimes throw a "Permission denied" error when strict-comparing
					// two documents; shallow comparisons work.
					// eslint-disable-next-line eqeqeq
					if ( !context && elem.ownerDocument != document ) {
						setDocument( elem );
						xml = !documentIsHTML;
					}
					while ( ( matcher = elementMatchers[ j++ ] ) ) {
						if ( matcher( elem, context || document, xml ) ) {
							results.push( elem );
							break;
						}
					}
					if ( outermost ) {
						dirruns = dirrunsUnique;
					}
				}

				// Track unmatched elements for set filters
				if ( bySet ) {

					// They will have gone through all possible matchers
					if ( ( elem = !matcher && elem ) ) {
						matchedCount--;
					}

					// Lengthen the array for every element, matched or not
					if ( seed ) {
						unmatched.push( elem );
					}
				}
			}

			// `i` is now the count of elements visited above, and adding it to `matchedCount`
			// makes the latter nonnegative.
			matchedCount += i;

			// Apply set filters to unmatched elements
			// NOTE: This can be skipped if there are no unmatched elements (i.e., `matchedCount`
			// equals `i`), unless we didn't visit _any_ elements in the above loop because we have
			// no element matchers and no seed.
			// Incrementing an initially-string "0" `i` allows `i` to remain a string only in that
			// case, which will result in a "00" `matchedCount` that differs from `i` but is also
			// numerically zero.
			if ( bySet && i !== matchedCount ) {
				j = 0;
				while ( ( matcher = setMatchers[ j++ ] ) ) {
					matcher( unmatched, setMatched, context, xml );
				}

				if ( seed ) {

					// Reintegrate element matches to eliminate the need for sorting
					if ( matchedCount > 0 ) {
						while ( i-- ) {
							if ( !( unmatched[ i ] || setMatched[ i ] ) ) {
								setMatched[ i ] = pop.call( results );
							}
						}
					}

					// Discard index placeholder values to get only actual matches
					setMatched = condense( setMatched );
				}

				// Add matches to results
				push.apply( results, setMatched );

				// Seedless set matches succeeding multiple successful matchers stipulate sorting
				if ( outermost && !seed && setMatched.length > 0 &&
					( matchedCount + setMatchers.length ) > 1 ) {

					Sizzle.uniqueSort( results );
				}
			}

			// Override manipulation of globals by nested matchers
			if ( outermost ) {
				dirruns = dirrunsUnique;
				outermostContext = contextBackup;
			}

			return unmatched;
		};

	return bySet ?
		markFunction( superMatcher ) :
		superMatcher;
}

compile = Sizzle.compile = function( selector, match /* Internal Use Only */ ) {
	var i,
		setMatchers = [],
		elementMatchers = [],
		cached = compilerCache[ selector + " " ];

	if ( !cached ) {

		// Generate a function of recursive functions that can be used to check each element
		if ( !match ) {
			match = tokenize( selector );
		}
		i = match.length;
		while ( i-- ) {
			cached = matcherFromTokens( match[ i ] );
			if ( cached[ expando ] ) {
				setMatchers.push( cached );
			} else {
				elementMatchers.push( cached );
			}
		}

		// Cache the compiled function
		cached = compilerCache(
			selector,
			matcherFromGroupMatchers( elementMatchers, setMatchers )
		);

		// Save selector and tokenization
		cached.selector = selector;
	}
	return cached;
};

/**
 * A low-level selection function that works with Sizzle's compiled
 *  selector functions
 * @param {String|Function} selector A selector or a pre-compiled
 *  selector function built with Sizzle.compile
 * @param {Element} context
 * @param {Array} [results]
 * @param {Array} [seed] A set of elements to match against
 */
select = Sizzle.select = function( selector, context, results, seed ) {
	var i, tokens, token, type, find,
		compiled = typeof selector === "function" && selector,
		match = !seed && tokenize( ( selector = compiled.selector || selector ) );

	results = results || [];

	// Try to minimize operations if there is only one selector in the list and no seed
	// (the latter of which guarantees us context)
	if ( match.length === 1 ) {

		// Reduce context if the leading compound selector is an ID
		tokens = match[ 0 ] = match[ 0 ].slice( 0 );
		if ( tokens.length > 2 && ( token = tokens[ 0 ] ).type === "ID" &&
			context.nodeType === 9 && documentIsHTML && Expr.relative[ tokens[ 1 ].type ] ) {

			context = ( Expr.find[ "ID" ]( token.matches[ 0 ]
				.replace( runescape, funescape ), context ) || [] )[ 0 ];
			if ( !context ) {
				return results;

			// Precompiled matchers will still verify ancestry, so step up a level
			} else if ( compiled ) {
				context = context.parentNode;
			}

			selector = selector.slice( tokens.shift().value.length );
		}

		// Fetch a seed set for right-to-left matching
		i = matchExpr[ "needsContext" ].test( selector ) ? 0 : tokens.length;
		while ( i-- ) {
			token = tokens[ i ];

			// Abort if we hit a combinator
			if ( Expr.relative[ ( type = token.type ) ] ) {
				break;
			}
			if ( ( find = Expr.find[ type ] ) ) {

				// Search, expanding context for leading sibling combinators
				if ( ( seed = find(
					token.matches[ 0 ].replace( runescape, funescape ),
					rsibling.test( tokens[ 0 ].type ) && testContext( context.parentNode ) ||
						context
				) ) ) {

					// If seed is empty or no tokens remain, we can return early
					tokens.splice( i, 1 );
					selector = seed.length && toSelector( tokens );
					if ( !selector ) {
						push.apply( results, seed );
						return results;
					}

					break;
				}
			}
		}
	}

	// Compile and execute a filtering function if one is not provided
	// Provide `match` to avoid retokenization if we modified the selector above
	( compiled || compile( selector, match ) )(
		seed,
		context,
		!documentIsHTML,
		results,
		!context || rsibling.test( selector ) && testContext( context.parentNode ) || context
	);
	return results;
};

// One-time assignments

// Sort stability
support.sortStable = expando.split( "" ).sort( sortOrder ).join( "" ) === expando;

// Support: Chrome 14-35+
// Always assume duplicates if they aren't passed to the comparison function
support.detectDuplicates = !!hasDuplicate;

// Initialize against the default document
setDocument();

// Support: Webkit<537.32 - Safari 6.0.3/Chrome 25 (fixed in Chrome 27)
// Detached nodes confoundingly follow *each other*
support.sortDetached = assert( function( el ) {

	// Should return 1, but returns 4 (following)
	return el.compareDocumentPosition( document.createElement( "fieldset" ) ) & 1;
} );

// Support: IE<8
// Prevent attribute/property "interpolation"
// https://msdn.microsoft.com/en-us/library/ms536429%28VS.85%29.aspx
if ( !assert( function( el ) {
	el.innerHTML = "<a href='#'></a>";
	return el.firstChild.getAttribute( "href" ) === "#";
} ) ) {
	addHandle( "type|href|height|width", function( elem, name, isXML ) {
		if ( !isXML ) {
			return elem.getAttribute( name, name.toLowerCase() === "type" ? 1 : 2 );
		}
	} );
}

// Support: IE<9
// Use defaultValue in place of getAttribute("value")
if ( !support.attributes || !assert( function( el ) {
	el.innerHTML = "<input/>";
	el.firstChild.setAttribute( "value", "" );
	return el.firstChild.getAttribute( "value" ) === "";
} ) ) {
	addHandle( "value", function( elem, _name, isXML ) {
		if ( !isXML && elem.nodeName.toLowerCase() === "input" ) {
			return elem.defaultValue;
		}
	} );
}

// Support: IE<9
// Use getAttributeNode to fetch booleans when getAttribute lies
if ( !assert( function( el ) {
	return el.getAttribute( "disabled" ) == null;
} ) ) {
	addHandle( booleans, function( elem, name, isXML ) {
		var val;
		if ( !isXML ) {
			return elem[ name ] === true ? name.toLowerCase() :
				( val = elem.getAttributeNode( name ) ) && val.specified ?
					val.value :
					null;
		}
	} );
}

return Sizzle;

} )( window );



jQuery.find = Sizzle;
jQuery.expr = Sizzle.selectors;

// Deprecated
jQuery.expr[ ":" ] = jQuery.expr.pseudos;
jQuery.uniqueSort = jQuery.unique = Sizzle.uniqueSort;
jQuery.text = Sizzle.getText;
jQuery.isXMLDoc = Sizzle.isXML;
jQuery.contains = Sizzle.contains;
jQuery.escapeSelector = Sizzle.escape;




var dir = function( elem, dir, until ) {
	var matched = [],
		truncate = until !== undefined;

	while ( ( elem = elem[ dir ] ) && elem.nodeType !== 9 ) {
		if ( elem.nodeType === 1 ) {
			if ( truncate && jQuery( elem ).is( until ) ) {
				break;
			}
			matched.push( elem );
		}
	}
	return matched;
};


var siblings = function( n, elem ) {
	var matched = [];

	for ( ; n; n = n.nextSibling ) {
		if ( n.nodeType === 1 && n !== elem ) {
			matched.push( n );
		}
	}

	return matched;
};


var rneedsContext = jQuery.expr.match.needsContext;



function nodeName( elem, name ) {

  return elem.nodeName && elem.nodeName.toLowerCase() === name.toLowerCase();

};
var rsingleTag = ( /^<([a-z][^\/\0>:\x20\t\r\n\f]*)[\x20\t\r\n\f]*\/?>(?:<\/\1>|)$/i );



// Implement the identical functionality for filter and not
function winnow( elements, qualifier, not ) {
	if ( isFunction( qualifier ) ) {
		return jQuery.grep( elements, function( elem, i ) {
			return !!qualifier.call( elem, i, elem ) !== not;
		} );
	}

	// Single element
	if ( qualifier.nodeType ) {
		return jQuery.grep( elements, function( elem ) {
			return ( elem === qualifier ) !== not;
		} );
	}

	// Arraylike of elements (jQuery, arguments, Array)
	if ( typeof qualifier !== "string" ) {
		return jQuery.grep( elements, function( elem ) {
			return ( indexOf.call( qualifier, elem ) > -1 ) !== not;
		} );
	}

	// Filtered directly for both simple and complex selectors
	return jQuery.filter( qualifier, elements, not );
}

jQuery.filter = function( expr, elems, not ) {
	var elem = elems[ 0 ];

	if ( not ) {
		expr = ":not(" + expr + ")";
	}

	if ( elems.length === 1 && elem.nodeType === 1 ) {
		return jQuery.find.matchesSelector( elem, expr ) ? [ elem ] : [];
	}

	return jQuery.find.matches( expr, jQuery.grep( elems, function( elem ) {
		return elem.nodeType === 1;
	} ) );
};

jQuery.fn.extend( {
	find: function( selector ) {
		var i, ret,
			len = this.length,
			self = this;

		if ( typeof selector !== "string" ) {
			return this.pushStack( jQuery( selector ).filter( function() {
				for ( i = 0; i < len; i++ ) {
					if ( jQuery.contains( self[ i ], this ) ) {
						return true;
					}
				}
			} ) );
		}

		ret = this.pushStack( [] );

		for ( i = 0; i < len; i++ ) {
			jQuery.find( selector, self[ i ], ret );
		}

		return len > 1 ? jQuery.uniqueSort( ret ) : ret;
	},
	filter: function( selector ) {
		return this.pushStack( winnow( this, selector || [], false ) );
	},
	not: function( selector ) {
		return this.pushStack( winnow( this, selector || [], true ) );
	},
	is: function( selector ) {
		return !!winnow(
			this,

			// If this is a positional/relative selector, check membership in the returned set
			// so $("p:first").is("p:last") won't return true for a doc with two "p".
			typeof selector === "string" && rneedsContext.test( selector ) ?
				jQuery( selector ) :
				selector || [],
			false
		).length;
	}
} );


// Initialize a jQuery object


// A central reference to the root jQuery(document)
var rootjQuery,

	// A simple way to check for HTML strings
	// Prioritize #id over <tag> to avoid XSS via location.hash (#9521)
	// Strict HTML recognition (#11290: must start with <)
	// Shortcut simple #id case for speed
	rquickExpr = /^(?:\s*(<[\w\W]+>)[^>]*|#([\w-]+))$/,

	init = jQuery.fn.init = function( selector, context, root ) {
		var match, elem;

		// HANDLE: $(""), $(null), $(undefined), $(false)
		if ( !selector ) {
			return this;
		}

		// Method init() accepts an alternate rootjQuery
		// so migrate can support jQuery.sub (gh-2101)
		root = root || rootjQuery;

		// Handle HTML strings
		if ( typeof selector === "string" ) {
			if ( selector[ 0 ] === "<" &&
				selector[ selector.length - 1 ] === ">" &&
				selector.length >= 3 ) {

				// Assume that strings that start and end with <> are HTML and skip the regex check
				match = [ null, selector, null ];

			} else {
				match = rquickExpr.exec( selector );
			}

			// Match html or make sure no context is specified for #id
			if ( match && ( match[ 1 ] || !context ) ) {

				// HANDLE: $(html) -> $(array)
				if ( match[ 1 ] ) {
					context = context instanceof jQuery ? context[ 0 ] : context;

					// Option to run scripts is true for back-compat
					// Intentionally let the error be thrown if parseHTML is not present
					jQuery.merge( this, jQuery.parseHTML(
						match[ 1 ],
						context && context.nodeType ? context.ownerDocument || context : document,
						true
					) );

					// HANDLE: $(html, props)
					if ( rsingleTag.test( match[ 1 ] ) && jQuery.isPlainObject( context ) ) {
						for ( match in context ) {

							// Properties of context are called as methods if possible
							if ( isFunction( this[ match ] ) ) {
								this[ match ]( context[ match ] );

							// ...and otherwise set as attributes
							} else {
								this.attr( match, context[ match ] );
							}
						}
					}

					return this;

				// HANDLE: $(#id)
				} else {
					elem = document.getElementById( match[ 2 ] );

					if ( elem ) {

						// Inject the element directly into the jQuery object
						this[ 0 ] = elem;
						this.length = 1;
					}
					return this;
				}

			// HANDLE: $(expr, $(...))
			} else if ( !context || context.jquery ) {
				return ( context || root ).find( selector );

			// HANDLE: $(expr, context)
			// (which is just equivalent to: $(context).find(expr)
			} else {
				return this.constructor( context ).find( selector );
			}

		// HANDLE: $(DOMElement)
		} else if ( selector.nodeType ) {
			this[ 0 ] = selector;
			this.length = 1;
			return this;

		// HANDLE: $(function)
		// Shortcut for document ready
		} else if ( isFunction( selector ) ) {
			return root.ready !== undefined ?
				root.ready( selector ) :

				// Execute immediately if ready is not present
				selector( jQuery );
		}

		return jQuery.makeArray( selector, this );
	};

// Give the init function the jQuery prototype for later instantiation
init.prototype = jQuery.fn;

// Initialize central reference
rootjQuery = jQuery( document );


var rparentsprev = /^(?:parents|prev(?:Until|All))/,

	// Methods guaranteed to produce a unique set when starting from a unique set
	guaranteedUnique = {
		children: true,
		contents: true,
		next: true,
		prev: true
	};

jQuery.fn.extend( {
	has: function( target ) {
		var targets = jQuery( target, this ),
			l = targets.length;

		return this.filter( function() {
			var i = 0;
			for ( ; i < l; i++ ) {
				if ( jQuery.contains( this, targets[ i ] ) ) {
					return true;
				}
			}
		} );
	},

	closest: function( selectors, context ) {
		var cur,
			i = 0,
			l = this.length,
			matched = [],
			targets = typeof selectors !== "string" && jQuery( selectors );

		// Positional selectors never match, since there's no _selection_ context
		if ( !rneedsContext.test( selectors ) ) {
			for ( ; i < l; i++ ) {
				for ( cur = this[ i ]; cur && cur !== context; cur = cur.parentNode ) {

					// Always skip document fragments
					if ( cur.nodeType < 11 && ( targets ?
						targets.index( cur ) > -1 :

						// Don't pass non-elements to Sizzle
						cur.nodeType === 1 &&
							jQuery.find.matchesSelector( cur, selectors ) ) ) {

						matched.push( cur );
						break;
					}
				}
			}
		}

		return this.pushStack( matched.length > 1 ? jQuery.uniqueSort( matched ) : matched );
	},

	// Determine the position of an element within the set
	index: function( elem ) {

		// No argument, return index in parent
		if ( !elem ) {
			return ( this[ 0 ] && this[ 0 ].parentNode ) ? this.first().prevAll().length : -1;
		}

		// Index in selector
		if ( typeof elem === "string" ) {
			return indexOf.call( jQuery( elem ), this[ 0 ] );
		}

		// Locate the position of the desired element
		return indexOf.call( this,

			// If it receives a jQuery object, the first element is used
			elem.jquery ? elem[ 0 ] : elem
		);
	},

	add: function( selector, context ) {
		return this.pushStack(
			jQuery.uniqueSort(
				jQuery.merge( this.get(), jQuery( selector, context ) )
			)
		);
	},

	addBack: function( selector ) {
		return this.add( selector == null ?
			this.prevObject : this.prevObject.filter( selector )
		);
	}
} );

function sibling( cur, dir ) {
	while ( ( cur = cur[ dir ] ) && cur.nodeType !== 1 ) {}
	return cur;
}

jQuery.each( {
	parent: function( elem ) {
		var parent = elem.parentNode;
		return parent && parent.nodeType !== 11 ? parent : null;
	},
	parents: function( elem ) {
		return dir( elem, "parentNode" );
	},
	parentsUntil: function( elem, _i, until ) {
		return dir( elem, "parentNode", until );
	},
	next: function( elem ) {
		return sibling( elem, "nextSibling" );
	},
	prev: function( elem ) {
		return sibling( elem, "previousSibling" );
	},
	nextAll: function( elem ) {
		return dir( elem, "nextSibling" );
	},
	prevAll: function( elem ) {
		return dir( elem, "previousSibling" );
	},
	nextUntil: function( elem, _i, until ) {
		return dir( elem, "nextSibling", until );
	},
	prevUntil: function( elem, _i, until ) {
		return dir( elem, "previousSibling", until );
	},
	siblings: function( elem ) {
		return siblings( ( elem.parentNode || {} ).firstChild, elem );
	},
	children: function( elem ) {
		return siblings( elem.firstChild );
	},
	contents: function( elem ) {
		if ( elem.contentDocument != null &&

			// Support: IE 11+
			// <object> elements with no `data` attribute has an object
			// `contentDocument` with a `null` prototype.
			getProto( elem.contentDocument ) ) {

			return elem.contentDocument;
		}

		// Support: IE 9 - 11 only, iOS 7 only, Android Browser <=4.3 only
		// Treat the template element as a regular one in browsers that
		// don't support it.
		if ( nodeName( elem, "template" ) ) {
			elem = elem.content || elem;
		}

		return jQuery.merge( [], elem.childNodes );
	}
}, function( name, fn ) {
	jQuery.fn[ name ] = function( until, selector ) {
		var matched = jQuery.map( this, fn, until );

		if ( name.slice( -5 ) !== "Until" ) {
			selector = until;
		}

		if ( selector && typeof selector === "string" ) {
			matched = jQuery.filter( selector, matched );
		}

		if ( this.length > 1 ) {

			// Remove duplicates
			if ( !guaranteedUnique[ name ] ) {
				jQuery.uniqueSort( matched );
			}

			// Reverse order for parents* and prev-derivatives
			if ( rparentsprev.test( name ) ) {
				matched.reverse();
			}
		}

		return this.pushStack( matched );
	};
} );
var rnothtmlwhite = ( /[^\x20\t\r\n\f]+/g );



// Convert String-formatted options into Object-formatted ones
function createOptions( options ) {
	var object = {};
	jQuery.each( options.match( rnothtmlwhite ) || [], function( _, flag ) {
		object[ flag ] = true;
	} );
	return object;
}

/*
 * Create a callback list using the following parameters:
 *
 *	options: an optional list of space-separated options that will change how
 *			the callback list behaves or a more traditional option object
 *
 * By default a callback list will act like an event callback list and can be
 * "fired" multiple times.
 *
 * Possible options:
 *
 *	once:			will ensure the callback list can only be fired once (like a Deferred)
 *
 *	memory:			will keep track of previous values and will call any callback added
 *					after the list has been fired right away with the latest "memorized"
 *					values (like a Deferred)
 *
 *	unique:			will ensure a callback can only be added once (no duplicate in the list)
 *
 *	stopOnFalse:	interrupt callings when a callback returns false
 *
 */
jQuery.Callbacks = function( options ) {

	// Convert options from String-formatted to Object-formatted if needed
	// (we check in cache first)
	options = typeof options === "string" ?
		createOptions( options ) :
		jQuery.extend( {}, options );

	var // Flag to know if list is currently firing
		firing,

		// Last fire value for non-forgettable lists
		memory,

		// Flag to know if list was already fired
		fired,

		// Flag to prevent firing
		locked,

		// Actual callback list
		list = [],

		// Queue of execution data for repeatable lists
		queue = [],

		// Index of currently firing callback (modified by add/remove as needed)
		firingIndex = -1,

		// Fire callbacks
		fire = function() {

			// Enforce single-firing
			locked = locked || options.once;

			// Execute callbacks for all pending executions,
			// respecting firingIndex overrides and runtime changes
			fired = firing = true;
			for ( ; queue.length; firingIndex = -1 ) {
				memory = queue.shift();
				while ( ++firingIndex < list.length ) {

					// Run callback and check for early termination
					if ( list[ firingIndex ].apply( memory[ 0 ], memory[ 1 ] ) === false &&
						options.stopOnFalse ) {

						// Jump to end and forget the data so .add doesn't re-fire
						firingIndex = list.length;
						memory = false;
					}
				}
			}

			// Forget the data if we're done with it
			if ( !options.memory ) {
				memory = false;
			}

			firing = false;

			// Clean up if we're done firing for good
			if ( locked ) {

				// Keep an empty list if we have data for future add calls
				if ( memory ) {
					list = [];

				// Otherwise, this object is spent
				} else {
					list = "";
				}
			}
		},

		// Actual Callbacks object
		self = {

			// Add a callback or a collection of callbacks to the list
			add: function() {
				if ( list ) {

					// If we have memory from a past run, we should fire after adding
					if ( memory && !firing ) {
						firingIndex = list.length - 1;
						queue.push( memory );
					}

					( function add( args ) {
						jQuery.each( args, function( _, arg ) {
							if ( isFunction( arg ) ) {
								if ( !options.unique || !self.has( arg ) ) {
									list.push( arg );
								}
							} else if ( arg && arg.length && toType( arg ) !== "string" ) {

								// Inspect recursively
								add( arg );
							}
						} );
					} )( arguments );

					if ( memory && !firing ) {
						fire();
					}
				}
				return this;
			},

			// Remove a callback from the list
			remove: function() {
				jQuery.each( arguments, function( _, arg ) {
					var index;
					while ( ( index = jQuery.inArray( arg, list, index ) ) > -1 ) {
						list.splice( index, 1 );

						// Handle firing indexes
						if ( index <= firingIndex ) {
							firingIndex--;
						}
					}
				} );
				return this;
			},

			// Check if a given callback is in the list.
			// If no argument is given, return whether or not list has callbacks attached.
			has: function( fn ) {
				return fn ?
					jQuery.inArray( fn, list ) > -1 :
					list.length > 0;
			},

			// Remove all callbacks from the list
			empty: function() {
				if ( list ) {
					list = [];
				}
				return this;
			},

			// Disable .fire and .add
			// Abort any current/pending executions
			// Clear all callbacks and values
			disable: function() {
				locked = queue = [];
				list = memory = "";
				return this;
			},
			disabled: function() {
				return !list;
			},

			// Disable .fire
			// Also disable .add unless we have memory (since it would have no effect)
			// Abort any pending executions
			lock: function() {
				locked = queue = [];
				if ( !memory && !firing ) {
					list = memory = "";
				}
				return this;
			},
			locked: function() {
				return !!locked;
			},

			// Call all callbacks with the given context and arguments
			fireWith: function( context, args ) {
				if ( !locked ) {
					args = args || [];
					args = [ context, args.slice ? args.slice() : args ];
					queue.push( args );
					if ( !firing ) {
						fire();
					}
				}
				return this;
			},

			// Call all the callbacks with the given arguments
			fire: function() {
				self.fireWith( this, arguments );
				return this;
			},

			// To know if the callbacks have already been called at least once
			fired: function() {
				return !!fired;
			}
		};

	return self;
};


function Identity( v ) {
	return v;
}
function Thrower( ex ) {
	throw ex;
}

function adoptValue( value, resolve, reject, noValue ) {
	var method;

	try {

		// Check for promise aspect first to privilege synchronous behavior
		if ( value && isFunction( ( method = value.promise ) ) ) {
			method.call( value ).done( resolve ).fail( reject );

		// Other thenables
		} else if ( value && isFunction( ( method = value.then ) ) ) {
			method.call( value, resolve, reject );

		// Other non-thenables
		} else {

			// Control `resolve` arguments by letting Array#slice cast boolean `noValue` to integer:
			// * false: [ value ].slice( 0 ) => resolve( value )
			// * true: [ value ].slice( 1 ) => resolve()
			resolve.apply( undefined, [ value ].slice( noValue ) );
		}

	// For Promises/A+, convert exceptions into rejections
	// Since jQuery.when doesn't unwrap thenables, we can skip the extra checks appearing in
	// Deferred#then to conditionally suppress rejection.
	} catch ( value ) {

		// Support: Android 4.0 only
		// Strict mode functions invoked without .call/.apply get global-object context
		reject.apply( undefined, [ value ] );
	}
}

jQuery.extend( {

	Deferred: function( func ) {
		var tuples = [

				// action, add listener, callbacks,
				// ... .then handlers, argument index, [final state]
				[ "notify", "progress", jQuery.Callbacks( "memory" ),
					jQuery.Callbacks( "memory" ), 2 ],
				[ "resolve", "done", jQuery.Callbacks( "once memory" ),
					jQuery.Callbacks( "once memory" ), 0, "resolved" ],
				[ "reject", "fail", jQuery.Callbacks( "once memory" ),
					jQuery.Callbacks( "once memory" ), 1, "rejected" ]
			],
			state = "pending",
			promise = {
				state: function() {
					return state;
				},
				always: function() {
					deferred.done( arguments ).fail( arguments );
					return this;
				},
				"catch": function( fn ) {
					return promise.then( null, fn );
				},

				// Keep pipe for back-compat
				pipe: function( /* fnDone, fnFail, fnProgress */ ) {
					var fns = arguments;

					return jQuery.Deferred( function( newDefer ) {
						jQuery.each( tuples, function( _i, tuple ) {

							// Map tuples (progress, done, fail) to arguments (done, fail, progress)
							var fn = isFunction( fns[ tuple[ 4 ] ] ) && fns[ tuple[ 4 ] ];

							// deferred.progress(function() { bind to newDefer or newDefer.notify })
							// deferred.done(function() { bind to newDefer or newDefer.resolve })
							// deferred.fail(function() { bind to newDefer or newDefer.reject })
							deferred[ tuple[ 1 ] ]( function() {
								var returned = fn && fn.apply( this, arguments );
								if ( returned && isFunction( returned.promise ) ) {
									returned.promise()
										.progress( newDefer.notify )
										.done( newDefer.resolve )
										.fail( newDefer.reject );
								} else {
									newDefer[ tuple[ 0 ] + "With" ](
										this,
										fn ? [ returned ] : arguments
									);
								}
							} );
						} );
						fns = null;
					} ).promise();
				},
				then: function( onFulfilled, onRejected, onProgress ) {
					var maxDepth = 0;
					function resolve( depth, deferred, handler, special ) {
						return function() {
							var that = this,
								args = arguments,
								mightThrow = function() {
									var returned, then;

									// Support: Promises/A+ section 2.3.3.3.3
									// https://promisesaplus.com/#point-59
									// Ignore double-resolution attempts
									if ( depth < maxDepth ) {
										return;
									}

									returned = handler.apply( that, args );

									// Support: Promises/A+ section 2.3.1
									// https://promisesaplus.com/#point-48
									if ( returned === deferred.promise() ) {
										throw new TypeError( "Thenable self-resolution" );
									}

									// Support: Promises/A+ sections 2.3.3.1, 3.5
									// https://promisesaplus.com/#point-54
									// https://promisesaplus.com/#point-75
									// Retrieve `then` only once
									then = returned &&

										// Support: Promises/A+ section 2.3.4
										// https://promisesaplus.com/#point-64
										// Only check objects and functions for thenability
										( typeof returned === "object" ||
											typeof returned === "function" ) &&
										returned.then;

									// Handle a returned thenable
									if ( isFunction( then ) ) {

										// Special processors (notify) just wait for resolution
										if ( special ) {
											then.call(
												returned,
												resolve( maxDepth, deferred, Identity, special ),
												resolve( maxDepth, deferred, Thrower, special )
											);

										// Normal processors (resolve) also hook into progress
										} else {

											// ...and disregard older resolution values
											maxDepth++;

											then.call(
												returned,
												resolve( maxDepth, deferred, Identity, special ),
												resolve( maxDepth, deferred, Thrower, special ),
												resolve( maxDepth, deferred, Identity,
													deferred.notifyWith )
											);
										}

									// Handle all other returned values
									} else {

										// Only substitute handlers pass on context
										// and multiple values (non-spec behavior)
										if ( handler !== Identity ) {
											that = undefined;
											args = [ returned ];
										}

										// Process the value(s)
										// Default process is resolve
										( special || deferred.resolveWith )( that, args );
									}
								},

								// Only normal processors (resolve) catch and reject exceptions
								process = special ?
									mightThrow :
									function() {
										try {
											mightThrow();
										} catch ( e ) {

											if ( jQuery.Deferred.exceptionHook ) {
												jQuery.Deferred.exceptionHook( e,
													process.stackTrace );
											}

											// Support: Promises/A+ section 2.3.3.3.4.1
											// https://promisesaplus.com/#point-61
											// Ignore post-resolution exceptions
											if ( depth + 1 >= maxDepth ) {

												// Only substitute handlers pass on context
												// and multiple values (non-spec behavior)
												if ( handler !== Thrower ) {
													that = undefined;
													args = [ e ];
												}

												deferred.rejectWith( that, args );
											}
										}
									};

							// Support: Promises/A+ section 2.3.3.3.1
							// https://promisesaplus.com/#point-57
							// Re-resolve promises immediately to dodge false rejection from
							// subsequent errors
							if ( depth ) {
								process();
							} else {

								// Call an optional hook to record the stack, in case of exception
								// since it's otherwise lost when execution goes async
								if ( jQuery.Deferred.getStackHook ) {
									process.stackTrace = jQuery.Deferred.getStackHook();
								}
								window.setTimeout( process );
							}
						};
					}

					return jQuery.Deferred( function( newDefer ) {

						// progress_handlers.add( ... )
						tuples[ 0 ][ 3 ].add(
							resolve(
								0,
								newDefer,
								isFunction( onProgress ) ?
									onProgress :
									Identity,
								newDefer.notifyWith
							)
						);

						// fulfilled_handlers.add( ... )
						tuples[ 1 ][ 3 ].add(
							resolve(
								0,
								newDefer,
								isFunction( onFulfilled ) ?
									onFulfilled :
									Identity
							)
						);

						// rejected_handlers.add( ... )
						tuples[ 2 ][ 3 ].add(
							resolve(
								0,
								newDefer,
								isFunction( onRejected ) ?
									onRejected :
									Thrower
							)
						);
					} ).promise();
				},

				// Get a promise for this deferred
				// If obj is provided, the promise aspect is added to the object
				promise: function( obj ) {
					return obj != null ? jQuery.extend( obj, promise ) : promise;
				}
			},
			deferred = {};

		// Add list-specific methods
		jQuery.each( tuples, function( i, tuple ) {
			var list = tuple[ 2 ],
				stateString = tuple[ 5 ];

			// promise.progress = list.add
			// promise.done = list.add
			// promise.fail = list.add
			promise[ tuple[ 1 ] ] = list.add;

			// Handle state
			if ( stateString ) {
				list.add(
					function() {

						// state = "resolved" (i.e., fulfilled)
						// state = "rejected"
						state = stateString;
					},

					// rejected_callbacks.disable
					// fulfilled_callbacks.disable
					tuples[ 3 - i ][ 2 ].disable,

					// rejected_handlers.disable
					// fulfilled_handlers.disable
					tuples[ 3 - i ][ 3 ].disable,

					// progress_callbacks.lock
					tuples[ 0 ][ 2 ].lock,

					// progress_handlers.lock
					tuples[ 0 ][ 3 ].lock
				);
			}

			// progress_handlers.fire
			// fulfilled_handlers.fire
			// rejected_handlers.fire
			list.add( tuple[ 3 ].fire );

			// deferred.notify = function() { deferred.notifyWith(...) }
			// deferred.resolve = function() { deferred.resolveWith(...) }
			// deferred.reject = function() { deferred.rejectWith(...) }
			deferred[ tuple[ 0 ] ] = function() {
				deferred[ tuple[ 0 ] + "With" ]( this === deferred ? undefined : this, arguments );
				return this;
			};

			// deferred.notifyWith = list.fireWith
			// deferred.resolveWith = list.fireWith
			// deferred.rejectWith = list.fireWith
			deferred[ tuple[ 0 ] + "With" ] = list.fireWith;
		} );

		// Make the deferred a promise
		promise.promise( deferred );

		// Call given func if any
		if ( func ) {
			func.call( deferred, deferred );
		}

		// All done!
		return deferred;
	},

	// Deferred helper
	when: function( singleValue ) {
		var

			// count of uncompleted subordinates
			remaining = arguments.length,

			// count of unprocessed arguments
			i = remaining,

			// subordinate fulfillment data
			resolveContexts = Array( i ),
			resolveValues = slice.call( arguments ),

			// the master Deferred
			master = jQuery.Deferred(),

			// subordinate callback factory
			updateFunc = function( i ) {
				return function( value ) {
					resolveContexts[ i ] = this;
					resolveValues[ i ] = arguments.length > 1 ? slice.call( arguments ) : value;
					if ( !( --remaining ) ) {
						master.resolveWith( resolveContexts, resolveValues );
					}
				};
			};

		// Single- and empty arguments are adopted like Promise.resolve
		if ( remaining <= 1 ) {
			adoptValue( singleValue, master.done( updateFunc( i ) ).resolve, master.reject,
				!remaining );

			// Use .then() to unwrap secondary thenables (cf. gh-3000)
			if ( master.state() === "pending" ||
				isFunction( resolveValues[ i ] && resolveValues[ i ].then ) ) {

				return master.then();
			}
		}

		// Multiple arguments are aggregated like Promise.all array elements
		while ( i-- ) {
			adoptValue( resolveValues[ i ], updateFunc( i ), master.reject );
		}

		return master.promise();
	}
} );


// These usually indicate a programmer mistake during development,
// warn about them ASAP rather than swallowing them by default.
var rerrorNames = /^(Eval|Internal|Range|Reference|Syntax|Type|URI)Error$/;

jQuery.Deferred.exceptionHook = function( error, stack ) {

	// Support: IE 8 - 9 only
	// Console exists when dev tools are open, which can happen at any time
	if ( window.console && window.console.warn && error && rerrorNames.test( error.name ) ) {
		window.console.warn( "jQuery.Deferred exception: " + error.message, error.stack, stack );
	}
};




jQuery.readyException = function( error ) {
	window.setTimeout( function() {
		throw error;
	} );
};




// The deferred used on DOM ready
var readyList = jQuery.Deferred();

jQuery.fn.ready = function( fn ) {

	readyList
		.then( fn )

		// Wrap jQuery.readyException in a function so that the lookup
		// happens at the time of error handling instead of callback
		// registration.
		.catch( function( error ) {
			jQuery.readyException( error );
		} );

	return this;
};

jQuery.extend( {

	// Is the DOM ready to be used? Set to true once it occurs.
	isReady: false,

	// A counter to track how many items to wait for before
	// the ready event fires. See #6781
	readyWait: 1,

	// Handle when the DOM is ready
	ready: function( wait ) {

		// Abort if there are pending holds or we're already ready
		if ( wait === true ? --jQuery.readyWait : jQuery.isReady ) {
			return;
		}

		// Remember that the DOM is ready
		jQuery.isReady = true;

		// If a normal DOM Ready event fired, decrement, and wait if need be
		if ( wait !== true && --jQuery.readyWait > 0 ) {
			return;
		}

		// If there are functions bound, to execute
		readyList.resolveWith( document, [ jQuery ] );
	}
} );

jQuery.ready.then = readyList.then;

// The ready event handler and self cleanup method
function completed() {
	document.removeEventListener( "DOMContentLoaded", completed );
	window.removeEventListener( "load", completed );
	jQuery.ready();
}

// Catch cases where $(document).ready() is called
// after the browser event has already occurred.
// Support: IE <=9 - 10 only
// Older IE sometimes signals "interactive" too soon
if ( document.readyState === "complete" ||
	( document.readyState !== "loading" && !document.documentElement.doScroll ) ) {

	// Handle it asynchronously to allow scripts the opportunity to delay ready
	window.setTimeout( jQuery.ready );

} else {

	// Use the handy event callback
	document.addEventListener( "DOMContentLoaded", completed );

	// A fallback to window.onload, that will always work
	window.addEventListener( "load", completed );
}




// Multifunctional method to get and set values of a collection
// The value/s can optionally be executed if it's a function
var access = function( elems, fn, key, value, chainable, emptyGet, raw ) {
	var i = 0,
		len = elems.length,
		bulk = key == null;

	// Sets many values
	if ( toType( key ) === "object" ) {
		chainable = true;
		for ( i in key ) {
			access( elems, fn, i, key[ i ], true, emptyGet, raw );
		}

	// Sets one value
	} else if ( value !== undefined ) {
		chainable = true;

		if ( !isFunction( value ) ) {
			raw = true;
		}

		if ( bulk ) {

			// Bulk operations run against the entire set
			if ( raw ) {
				fn.call( elems, value );
				fn = null;

			// ...except when executing function values
			} else {
				bulk = fn;
				fn = function( elem, _key, value ) {
					return bulk.call( jQuery( elem ), value );
				};
			}
		}

		if ( fn ) {
			for ( ; i < len; i++ ) {
				fn(
					elems[ i ], key, raw ?
					value :
					value.call( elems[ i ], i, fn( elems[ i ], key ) )
				);
			}
		}
	}

	if ( chainable ) {
		return elems;
	}

	// Gets
	if ( bulk ) {
		return fn.call( elems );
	}

	return len ? fn( elems[ 0 ], key ) : emptyGet;
};


// Matches dashed string for camelizing
var rmsPrefix = /^-ms-/,
	rdashAlpha = /-([a-z])/g;

// Used by camelCase as callback to replace()
function fcamelCase( _all, letter ) {
	return letter.toUpperCase();
}

// Convert dashed to camelCase; used by the css and data modules
// Support: IE <=9 - 11, Edge 12 - 15
// Microsoft forgot to hump their vendor prefix (#9572)
function camelCase( string ) {
	return string.replace( rmsPrefix, "ms-" ).replace( rdashAlpha, fcamelCase );
}
var acceptData = function( owner ) {

	// Accepts only:
	//  - Node
	//    - Node.ELEMENT_NODE
	//    - Node.DOCUMENT_NODE
	//  - Object
	//    - Any
	return owner.nodeType === 1 || owner.nodeType === 9 || !( +owner.nodeType );
};




function Data() {
	this.expando = jQuery.expando + Data.uid++;
}

Data.uid = 1;

Data.prototype = {

	cache: function( owner ) {

		// Check if the owner object already has a cache
		var value = owner[ this.expando ];

		// If not, create one
		if ( !value ) {
			value = {};

			// We can accept data for non-element nodes in modern browsers,
			// but we should not, see #8335.
			// Always return an empty object.
			if ( acceptData( owner ) ) {

				// If it is a node unlikely to be stringify-ed or looped over
				// use plain assignment
				if ( owner.nodeType ) {
					owner[ this.expando ] = value;

				// Otherwise secure it in a non-enumerable property
				// configurable must be true to allow the property to be
				// deleted when data is removed
				} else {
					Object.defineProperty( owner, this.expando, {
						value: value,
						configurable: true
					} );
				}
			}
		}

		return value;
	},
	set: function( owner, data, value ) {
		var prop,
			cache = this.cache( owner );

		// Handle: [ owner, key, value ] args
		// Always use camelCase key (gh-2257)
		if ( typeof data === "string" ) {
			cache[ camelCase( data ) ] = value;

		// Handle: [ owner, { properties } ] args
		} else {

			// Copy the properties one-by-one to the cache object
			for ( prop in data ) {
				cache[ camelCase( prop ) ] = data[ prop ];
			}
		}
		return cache;
	},
	get: function( owner, key ) {
		return key === undefined ?
			this.cache( owner ) :

			// Always use camelCase key (gh-2257)
			owner[ this.expando ] && owner[ this.expando ][ camelCase( key ) ];
	},
	access: function( owner, key, value ) {

		// In cases where either:
		//
		//   1. No key was specified
		//   2. A string key was specified, but no value provided
		//
		// Take the "read" path and allow the get method to determine
		// which value to return, respectively either:
		//
		//   1. The entire cache object
		//   2. The data stored at the key
		//
		if ( key === undefined ||
				( ( key && typeof key === "string" ) && value === undefined ) ) {

			return this.get( owner, key );
		}

		// When the key is not a string, or both a key and value
		// are specified, set or extend (existing objects) with either:
		//
		//   1. An object of properties
		//   2. A key and value
		//
		this.set( owner, key, value );

		// Since the "set" path can have two possible entry points
		// return the expected data based on which path was taken[*]
		return value !== undefined ? value : key;
	},
	remove: function( owner, key ) {
		var i,
			cache = owner[ this.expando ];

		if ( cache === undefined ) {
			return;
		}

		if ( key !== undefined ) {

			// Support array or space separated string of keys
			if ( Array.isArray( key ) ) {

				// If key is an array of keys...
				// We always set camelCase keys, so remove that.
				key = key.map( camelCase );
			} else {
				key = camelCase( key );

				// If a key with the spaces exists, use it.
				// Otherwise, create an array by matching non-whitespace
				key = key in cache ?
					[ key ] :
					( key.match( rnothtmlwhite ) || [] );
			}

			i = key.length;

			while ( i-- ) {
				delete cache[ key[ i ] ];
			}
		}

		// Remove the expando if there's no more data
		if ( key === undefined || jQuery.isEmptyObject( cache ) ) {

			// Support: Chrome <=35 - 45
			// Webkit & Blink performance suffers when deleting properties
			// from DOM nodes, so set to undefined instead
			// https://bugs.chromium.org/p/chromium/issues/detail?id=378607 (bug restricted)
			if ( owner.nodeType ) {
				owner[ this.expando ] = undefined;
			} else {
				delete owner[ this.expando ];
			}
		}
	},
	hasData: function( owner ) {
		var cache = owner[ this.expando ];
		return cache !== undefined && !jQuery.isEmptyObject( cache );
	}
};
var dataPriv = new Data();

var dataUser = new Data();



//	Implementation Summary
//
//	1. Enforce API surface and semantic compatibility with 1.9.x branch
//	2. Improve the module's maintainability by reducing the storage
//		paths to a single mechanism.
//	3. Use the same single mechanism to support "private" and "user" data.
//	4. _Never_ expose "private" data to user code (TODO: Drop _data, _removeData)
//	5. Avoid exposing implementation details on user objects (eg. expando properties)
//	6. Provide a clear path for implementation upgrade to WeakMap in 2014

var rbrace = /^(?:\{[\w\W]*\}|\[[\w\W]*\])$/,
	rmultiDash = /[A-Z]/g;

function getData( data ) {
	if ( data === "true" ) {
		return true;
	}

	if ( data === "false" ) {
		return false;
	}

	if ( data === "null" ) {
		return null;
	}

	// Only convert to a number if it doesn't change the string
	if ( data === +data + "" ) {
		return +data;
	}

	if ( rbrace.test( data ) ) {
		return JSON.parse( data );
	}

	return data;
}

function dataAttr( elem, key, data ) {
	var name;

	// If nothing was found internally, try to fetch any
	// data from the HTML5 data-* attribute
	if ( data === undefined && elem.nodeType === 1 ) {
		name = "data-" + key.replace( rmultiDash, "-$&" ).toLowerCase();
		data = elem.getAttribute( name );

		if ( typeof data === "string" ) {
			try {
				data = getData( data );
			} catch ( e ) {}

			// Make sure we set the data so it isn't changed later
			dataUser.set( elem, key, data );
		} else {
			data = undefined;
		}
	}
	return data;
}

jQuery.extend( {
	hasData: function( elem ) {
		return dataUser.hasData( elem ) || dataPriv.hasData( elem );
	},

	data: function( elem, name, data ) {
		return dataUser.access( elem, name, data );
	},

	removeData: function( elem, name ) {
		dataUser.remove( elem, name );
	},

	// TODO: Now that all calls to _data and _removeData have been replaced
	// with direct calls to dataPriv methods, these can be deprecated.
	_data: function( elem, name, data ) {
		return dataPriv.access( elem, name, data );
	},

	_removeData: function( elem, name ) {
		dataPriv.remove( elem, name );
	}
} );

jQuery.fn.extend( {
	data: function( key, value ) {
		var i, name, data,
			elem = this[ 0 ],
			attrs = elem && elem.attributes;

		// Gets all values
		if ( key === undefined ) {
			if ( this.length ) {
				data = dataUser.get( elem );

				if ( elem.nodeType === 1 && !dataPriv.get( elem, "hasDataAttrs" ) ) {
					i = attrs.length;
					while ( i-- ) {

						// Support: IE 11 only
						// The attrs elements can be null (#14894)
						if ( attrs[ i ] ) {
							name = attrs[ i ].name;
							if ( name.indexOf( "data-" ) === 0 ) {
								name = camelCase( name.slice( 5 ) );
								dataAttr( elem, name, data[ name ] );
							}
						}
					}
					dataPriv.set( elem, "hasDataAttrs", true );
				}
			}

			return data;
		}

		// Sets multiple values
		if ( typeof key === "object" ) {
			return this.each( function() {
				dataUser.set( this, key );
			} );
		}

		return access( this, function( value ) {
			var data;

			// The calling jQuery object (element matches) is not empty
			// (and therefore has an element appears at this[ 0 ]) and the
			// `value` parameter was not undefined. An empty jQuery object
			// will result in `undefined` for elem = this[ 0 ] which will
			// throw an exception if an attempt to read a data cache is made.
			if ( elem && value === undefined ) {

				// Attempt to get data from the cache
				// The key will always be camelCased in Data
				data = dataUser.get( elem, key );
				if ( data !== undefined ) {
					return data;
				}

				// Attempt to "discover" the data in
				// HTML5 custom data-* attrs
				data = dataAttr( elem, key );
				if ( data !== undefined ) {
					return data;
				}

				// We tried really hard, but the data doesn't exist.
				return;
			}

			// Set the data...
			this.each( function() {

				// We always store the camelCased key
				dataUser.set( this, key, value );
			} );
		}, null, value, arguments.length > 1, null, true );
	},

	removeData: function( key ) {
		return this.each( function() {
			dataUser.remove( this, key );
		} );
	}
} );


jQuery.extend( {
	queue: function( elem, type, data ) {
		var queue;

		if ( elem ) {
			type = ( type || "fx" ) + "queue";
			queue = dataPriv.get( elem, type );

			// Speed up dequeue by getting out quickly if this is just a lookup
			if ( data ) {
				if ( !queue || Array.isArray( data ) ) {
					queue = dataPriv.access( elem, type, jQuery.makeArray( data ) );
				} else {
					queue.push( data );
				}
			}
			return queue || [];
		}
	},

	dequeue: function( elem, type ) {
		type = type || "fx";

		var queue = jQuery.queue( elem, type ),
			startLength = queue.length,
			fn = queue.shift(),
			hooks = jQuery._queueHooks( elem, type ),
			next = function() {
				jQuery.dequeue( elem, type );
			};

		// If the fx queue is dequeued, always remove the progress sentinel
		if ( fn === "inprogress" ) {
			fn = queue.shift();
			startLength--;
		}

		if ( fn ) {

			// Add a progress sentinel to prevent the fx queue from being
			// automatically dequeued
			if ( type === "fx" ) {
				queue.unshift( "inprogress" );
			}

			// Clear up the last queue stop function
			delete hooks.stop;
			fn.call( elem, next, hooks );
		}

		if ( !startLength && hooks ) {
			hooks.empty.fire();
		}
	},

	// Not public - generate a queueHooks object, or return the current one
	_queueHooks: function( elem, type ) {
		var key = type + "queueHooks";
		return dataPriv.get( elem, key ) || dataPriv.access( elem, key, {
			empty: jQuery.Callbacks( "once memory" ).add( function() {
				dataPriv.remove( elem, [ type + "queue", key ] );
			} )
		} );
	}
} );

jQuery.fn.extend( {
	queue: function( type, data ) {
		var setter = 2;

		if ( typeof type !== "string" ) {
			data = type;
			type = "fx";
			setter--;
		}

		if ( arguments.length < setter ) {
			return jQuery.queue( this[ 0 ], type );
		}

		return data === undefined ?
			this :
			this.each( function() {
				var queue = jQuery.queue( this, type, data );

				// Ensure a hooks for this queue
				jQuery._queueHooks( this, type );

				if ( type === "fx" && queue[ 0 ] !== "inprogress" ) {
					jQuery.dequeue( this, type );
				}
			} );
	},
	dequeue: function( type ) {
		return this.each( function() {
			jQuery.dequeue( this, type );
		} );
	},
	clearQueue: function( type ) {
		return this.queue( type || "fx", [] );
	},

	// Get a promise resolved when queues of a certain type
	// are emptied (fx is the type by default)
	promise: function( type, obj ) {
		var tmp,
			count = 1,
			defer = jQuery.Deferred(),
			elements = this,
			i = this.length,
			resolve = function() {
				if ( !( --count ) ) {
					defer.resolveWith( elements, [ elements ] );
				}
			};

		if ( typeof type !== "string" ) {
			obj = type;
			type = undefined;
		}
		type = type || "fx";

		while ( i-- ) {
			tmp = dataPriv.get( elements[ i ], type + "queueHooks" );
			if ( tmp && tmp.empty ) {
				count++;
				tmp.empty.add( resolve );
			}
		}
		resolve();
		return defer.promise( obj );
	}
} );
var pnum = ( /[+-]?(?:\d*\.|)\d+(?:[eE][+-]?\d+|)/ ).source;

var rcssNum = new RegExp( "^(?:([+-])=|)(" + pnum + ")([a-z%]*)$", "i" );


var cssExpand = [ "Top", "Right", "Bottom", "Left" ];

var documentElement = document.documentElement;



	var isAttached = function( elem ) {
			return jQuery.contains( elem.ownerDocument, elem );
		},
		composed = { composed: true };

	// Support: IE 9 - 11+, Edge 12 - 18+, iOS 10.0 - 10.2 only
	// Check attachment across shadow DOM boundaries when possible (gh-3504)
	// Support: iOS 10.0-10.2 only
	// Early iOS 10 versions support `attachShadow` but not `getRootNode`,
	// leading to errors. We need to check for `getRootNode`.
	if ( documentElement.getRootNode ) {
		isAttached = function( elem ) {
			return jQuery.contains( elem.ownerDocument, elem ) ||
				elem.getRootNode( composed ) === elem.ownerDocument;
		};
	}
var isHiddenWithinTree = function( elem, el ) {

		// isHiddenWithinTree might be called from jQuery#filter function;
		// in that case, element will be second argument
		elem = el || elem;

		// Inline style trumps all
		return elem.style.display === "none" ||
			elem.style.display === "" &&

			// Otherwise, check computed style
			// Support: Firefox <=43 - 45
			// Disconnected elements can have computed display: none, so first confirm that elem is
			// in the document.
			isAttached( elem ) &&

			jQuery.css( elem, "display" ) === "none";
	};



function adjustCSS( elem, prop, valueParts, tween ) {
	var adjusted, scale,
		maxIterations = 20,
		currentValue = tween ?
			function() {
				return tween.cur();
			} :
			function() {
				return jQuery.css( elem, prop, "" );
			},
		initial = currentValue(),
		unit = valueParts && valueParts[ 3 ] || ( jQuery.cssNumber[ prop ] ? "" : "px" ),

		// Starting value computation is required for potential unit mismatches
		initialInUnit = elem.nodeType &&
			( jQuery.cssNumber[ prop ] || unit !== "px" && +initial ) &&
			rcssNum.exec( jQuery.css( elem, prop ) );

	if ( initialInUnit && initialInUnit[ 3 ] !== unit ) {

		// Support: Firefox <=54
		// Halve the iteration target value to prevent interference from CSS upper bounds (gh-2144)
		initial = initial / 2;

		// Trust units reported by jQuery.css
		unit = unit || initialInUnit[ 3 ];

		// Iteratively approximate from a nonzero starting point
		initialInUnit = +initial || 1;

		while ( maxIterations-- ) {

			// Evaluate and update our best guess (doubling guesses that zero out).
			// Finish if the scale equals or crosses 1 (making the old*new product non-positive).
			jQuery.style( elem, prop, initialInUnit + unit );
			if ( ( 1 - scale ) * ( 1 - ( scale = currentValue() / initial || 0.5 ) ) <= 0 ) {
				maxIterations = 0;
			}
			initialInUnit = initialInUnit / scale;

		}

		initialInUnit = initialInUnit * 2;
		jQuery.style( elem, prop, initialInUnit + unit );

		// Make sure we update the tween properties later on
		valueParts = valueParts || [];
	}

	if ( valueParts ) {
		initialInUnit = +initialInUnit || +initial || 0;

		// Apply relative offset (+=/-=) if specified
		adjusted = valueParts[ 1 ] ?
			initialInUnit + ( valueParts[ 1 ] + 1 ) * valueParts[ 2 ] :
			+valueParts[ 2 ];
		if ( tween ) {
			tween.unit = unit;
			tween.start = initialInUnit;
			tween.end = adjusted;
		}
	}
	return adjusted;
}


var defaultDisplayMap = {};

function getDefaultDisplay( elem ) {
	var temp,
		doc = elem.ownerDocument,
		nodeName = elem.nodeName,
		display = defaultDisplayMap[ nodeName ];

	if ( display ) {
		return display;
	}

	temp = doc.body.appendChild( doc.createElement( nodeName ) );
	display = jQuery.css( temp, "display" );

	temp.parentNode.removeChild( temp );

	if ( display === "none" ) {
		display = "block";
	}
	defaultDisplayMap[ nodeName ] = display;

	return display;
}

function showHide( elements, show ) {
	var display, elem,
		values = [],
		index = 0,
		length = elements.length;

	// Determine new display value for elements that need to change
	for ( ; index < length; index++ ) {
		elem = elements[ index ];
		if ( !elem.style ) {
			continue;
		}

		display = elem.style.display;
		if ( show ) {

			// Since we force visibility upon cascade-hidden elements, an immediate (and slow)
			// check is required in this first loop unless we have a nonempty display value (either
			// inline or about-to-be-restored)
			if ( display === "none" ) {
				values[ index ] = dataPriv.get( elem, "display" ) || null;
				if ( !values[ index ] ) {
					elem.style.display = "";
				}
			}
			if ( elem.style.display === "" && isHiddenWithinTree( elem ) ) {
				values[ index ] = getDefaultDisplay( elem );
			}
		} else {
			if ( display !== "none" ) {
				values[ index ] = "none";

				// Remember what we're overwriting
				dataPriv.set( elem, "display", display );
			}
		}
	}

	// Set the display of the elements in a second loop to avoid constant reflow
	for ( index = 0; index < length; index++ ) {
		if ( values[ index ] != null ) {
			elements[ index ].style.display = values[ index ];
		}
	}

	return elements;
}

jQuery.fn.extend( {
	show: function() {
		return showHide( this, true );
	},
	hide: function() {
		return showHide( this );
	},
	toggle: function( state ) {
		if ( typeof state === "boolean" ) {
			return state ? this.show() : this.hide();
		}

		return this.each( function() {
			if ( isHiddenWithinTree( this ) ) {
				jQuery( this ).show();
			} else {
				jQuery( this ).hide();
			}
		} );
	}
} );
var rcheckableType = ( /^(?:checkbox|radio)$/i );

var rtagName = ( /<([a-z][^\/\0>\x20\t\r\n\f]*)/i );

var rscriptType = ( /^$|^module$|\/(?:java|ecma)script/i );



( function() {
	var fragment = document.createDocumentFragment(),
		div = fragment.appendChild( document.createElement( "div" ) ),
		input = document.createElement( "input" );

	// Support: Android 4.0 - 4.3 only
	// Check state lost if the name is set (#11217)
	// Support: Windows Web Apps (WWA)
	// `name` and `type` must use .setAttribute for WWA (#14901)
	input.setAttribute( "type", "radio" );
	input.setAttribute( "checked", "checked" );
	input.setAttribute( "name", "t" );

	div.appendChild( input );

	// Support: Android <=4.1 only
	// Older WebKit doesn't clone checked state correctly in fragments
	support.checkClone = div.cloneNode( true ).cloneNode( true ).lastChild.checked;

	// Support: IE <=11 only
	// Make sure textarea (and checkbox) defaultValue is properly cloned
	div.innerHTML = "<textarea>x</textarea>";
	support.noCloneChecked = !!div.cloneNode( true ).lastChild.defaultValue;

	// Support: IE <=9 only
	// IE <=9 replaces <option> tags with their contents when inserted outside of
	// the select element.
	div.innerHTML = "<option></option>";
	support.option = !!div.lastChild;
} )();


// We have to close these tags to support XHTML (#13200)
var wrapMap = {

	// XHTML parsers do not magically insert elements in the
	// same way that tag soup parsers do. So we cannot shorten
	// this by omitting <tbody> or other required elements.
	thead: [ 1, "<table>", "</table>" ],
	col: [ 2, "<table><colgroup>", "</colgroup></table>" ],
	tr: [ 2, "<table><tbody>", "</tbody></table>" ],
	td: [ 3, "<table><tbody><tr>", "</tr></tbody></table>" ],

	_default: [ 0, "", "" ]
};

wrapMap.tbody = wrapMap.tfoot = wrapMap.colgroup = wrapMap.caption = wrapMap.thead;
wrapMap.th = wrapMap.td;

// Support: IE <=9 only
if ( !support.option ) {
	wrapMap.optgroup = wrapMap.option = [ 1, "<select multiple='multiple'>", "</select>" ];
}


function getAll( context, tag ) {

	// Support: IE <=9 - 11 only
	// Use typeof to avoid zero-argument method invocation on host objects (#15151)
	var ret;

	if ( typeof context.getElementsByTagName !== "undefined" ) {
		ret = context.getElementsByTagName( tag || "*" );

	} else if ( typeof context.querySelectorAll !== "undefined" ) {
		ret = context.querySelectorAll( tag || "*" );

	} else {
		ret = [];
	}

	if ( tag === undefined || tag && nodeName( context, tag ) ) {
		return jQuery.merge( [ context ], ret );
	}

	return ret;
}


// Mark scripts as having already been evaluated
function setGlobalEval( elems, refElements ) {
	var i = 0,
		l = elems.length;

	for ( ; i < l; i++ ) {
		dataPriv.set(
			elems[ i ],
			"globalEval",
			!refElements || dataPriv.get( refElements[ i ], "globalEval" )
		);
	}
}


var rhtml = /<|&#?\w+;/;

function buildFragment( elems, context, scripts, selection, ignored ) {
	var elem, tmp, tag, wrap, attached, j,
		fragment = context.createDocumentFragment(),
		nodes = [],
		i = 0,
		l = elems.length;

	for ( ; i < l; i++ ) {
		elem = elems[ i ];

		if ( elem || elem === 0 ) {

			// Add nodes directly
			if ( toType( elem ) === "object" ) {

				// Support: Android <=4.0 only, PhantomJS 1 only
				// push.apply(_, arraylike) throws on ancient WebKit
				jQuery.merge( nodes, elem.nodeType ? [ elem ] : elem );

			// Convert non-html into a text node
			} else if ( !rhtml.test( elem ) ) {
				nodes.push( context.createTextNode( elem ) );

			// Convert html into DOM nodes
			} else {
				tmp = tmp || fragment.appendChild( context.createElement( "div" ) );

				// Deserialize a standard representation
				tag = ( rtagName.exec( elem ) || [ "", "" ] )[ 1 ].toLowerCase();
				wrap = wrapMap[ tag ] || wrapMap._default;
				tmp.innerHTML = wrap[ 1 ] + jQuery.htmlPrefilter( elem ) + wrap[ 2 ];

				// Descend through wrappers to the right content
				j = wrap[ 0 ];
				while ( j-- ) {
					tmp = tmp.lastChild;
				}

				// Support: Android <=4.0 only, PhantomJS 1 only
				// push.apply(_, arraylike) throws on ancient WebKit
				jQuery.merge( nodes, tmp.childNodes );

				// Remember the top-level container
				tmp = fragment.firstChild;

				// Ensure the created nodes are orphaned (#12392)
				tmp.textContent = "";
			}
		}
	}

	// Remove wrapper from fragment
	fragment.textContent = "";

	i = 0;
	while ( ( elem = nodes[ i++ ] ) ) {

		// Skip elements already in the context collection (trac-4087)
		if ( selection && jQuery.inArray( elem, selection ) > -1 ) {
			if ( ignored ) {
				ignored.push( elem );
			}
			continue;
		}

		attached = isAttached( elem );

		// Append to fragment
		tmp = getAll( fragment.appendChild( elem ), "script" );

		// Preserve script evaluation history
		if ( attached ) {
			setGlobalEval( tmp );
		}

		// Capture executables
		if ( scripts ) {
			j = 0;
			while ( ( elem = tmp[ j++ ] ) ) {
				if ( rscriptType.test( elem.type || "" ) ) {
					scripts.push( elem );
				}
			}
		}
	}

	return fragment;
}


var
	rkeyEvent = /^key/,
	rmouseEvent = /^(?:mouse|pointer|contextmenu|drag|drop)|click/,
	rtypenamespace = /^([^.]*)(?:\.(.+)|)/;

function returnTrue() {
	return true;
}

function returnFalse() {
	return false;
}

// Support: IE <=9 - 11+
// focus() and blur() are asynchronous, except when they are no-op.
// So expect focus to be synchronous when the element is already active,
// and blur to be synchronous when the element is not already active.
// (focus and blur are always synchronous in other supported browsers,
// this just defines when we can count on it).
function expectSync( elem, type ) {
	return ( elem === safeActiveElement() ) === ( type === "focus" );
}

// Support: IE <=9 only
// Accessing document.activeElement can throw unexpectedly
// https://bugs.jquery.com/ticket/13393
function safeActiveElement() {
	try {
		return document.activeElement;
	} catch ( err ) { }
}

function on( elem, types, selector, data, fn, one ) {
	var origFn, type;

	// Types can be a map of types/handlers
	if ( typeof types === "object" ) {

		// ( types-Object, selector, data )
		if ( typeof selector !== "string" ) {

			// ( types-Object, data )
			data = data || selector;
			selector = undefined;
		}
		for ( type in types ) {
			on( elem, type, selector, data, types[ type ], one );
		}
		return elem;
	}

	if ( data == null && fn == null ) {

		// ( types, fn )
		fn = selector;
		data = selector = undefined;
	} else if ( fn == null ) {
		if ( typeof selector === "string" ) {

			// ( types, selector, fn )
			fn = data;
			data = undefined;
		} else {

			// ( types, data, fn )
			fn = data;
			data = selector;
			selector = undefined;
		}
	}
	if ( fn === false ) {
		fn = returnFalse;
	} else if ( !fn ) {
		return elem;
	}

	if ( one === 1 ) {
		origFn = fn;
		fn = function( event ) {

			// Can use an empty set, since event contains the info
			jQuery().off( event );
			return origFn.apply( this, arguments );
		};

		// Use same guid so caller can remove using origFn
		fn.guid = origFn.guid || ( origFn.guid = jQuery.guid++ );
	}
	return elem.each( function() {
		jQuery.event.add( this, types, fn, data, selector );
	} );
}

/*
 * Helper functions for managing events -- not part of the public interface.
 * Props to Dean Edwards' addEvent library for many of the ideas.
 */
jQuery.event = {

	global: {},

	add: function( elem, types, handler, data, selector ) {

		var handleObjIn, eventHandle, tmp,
			events, t, handleObj,
			special, handlers, type, namespaces, origType,
			elemData = dataPriv.get( elem );

		// Only attach events to objects that accept data
		if ( !acceptData( elem ) ) {
			return;
		}

		// Caller can pass in an object of custom data in lieu of the handler
		if ( handler.handler ) {
			handleObjIn = handler;
			handler = handleObjIn.handler;
			selector = handleObjIn.selector;
		}

		// Ensure that invalid selectors throw exceptions at attach time
		// Evaluate against documentElement in case elem is a non-element node (e.g., document)
		if ( selector ) {
			jQuery.find.matchesSelector( documentElement, selector );
		}

		// Make sure that the handler has a unique ID, used to find/remove it later
		if ( !handler.guid ) {
			handler.guid = jQuery.guid++;
		}

		// Init the element's event structure and main handler, if this is the first
		if ( !( events = elemData.events ) ) {
			events = elemData.events = Object.create( null );
		}
		if ( !( eventHandle = elemData.handle ) ) {
			eventHandle = elemData.handle = function( e ) {

				// Discard the second event of a jQuery.event.trigger() and
				// when an event is called after a page has unloaded
				return typeof jQuery !== "undefined" && jQuery.event.triggered !== e.type ?
					jQuery.event.dispatch.apply( elem, arguments ) : undefined;
			};
		}

		// Handle multiple events separated by a space
		types = ( types || "" ).match( rnothtmlwhite ) || [ "" ];
		t = types.length;
		while ( t-- ) {
			tmp = rtypenamespace.exec( types[ t ] ) || [];
			type = origType = tmp[ 1 ];
			namespaces = ( tmp[ 2 ] || "" ).split( "." ).sort();

			// There *must* be a type, no attaching namespace-only handlers
			if ( !type ) {
				continue;
			}

			// If event changes its type, use the special event handlers for the changed type
			special = jQuery.event.special[ type ] || {};

			// If selector defined, determine special event api type, otherwise given type
			type = ( selector ? special.delegateType : special.bindType ) || type;

			// Update special based on newly reset type
			special = jQuery.event.special[ type ] || {};

			// handleObj is passed to all event handlers
			handleObj = jQuery.extend( {
				type: type,
				origType: origType,
				data: data,
				handler: handler,
				guid: handler.guid,
				selector: selector,
				needsContext: selector && jQuery.expr.match.needsContext.test( selector ),
				namespace: namespaces.join( "." )
			}, handleObjIn );

			// Init the event handler queue if we're the first
			if ( !( handlers = events[ type ] ) ) {
				handlers = events[ type ] = [];
				handlers.delegateCount = 0;

				// Only use addEventListener if the special events handler returns false
				if ( !special.setup ||
					special.setup.call( elem, data, namespaces, eventHandle ) === false ) {

					if ( elem.addEventListener ) {
						elem.addEventListener( type, eventHandle );
					}
				}
			}

			if ( special.add ) {
				special.add.call( elem, handleObj );

				if ( !handleObj.handler.guid ) {
					handleObj.handler.guid = handler.guid;
				}
			}

			// Add to the element's handler list, delegates in front
			if ( selector ) {
				handlers.splice( handlers.delegateCount++, 0, handleObj );
			} else {
				handlers.push( handleObj );
			}

			// Keep track of which events have ever been used, for event optimization
			jQuery.event.global[ type ] = true;
		}

	},

	// Detach an event or set of events from an element
	remove: function( elem, types, handler, selector, mappedTypes ) {

		var j, origCount, tmp,
			events, t, handleObj,
			special, handlers, type, namespaces, origType,
			elemData = dataPriv.hasData( elem ) && dataPriv.get( elem );

		if ( !elemData || !( events = elemData.events ) ) {
			return;
		}

		// Once for each type.namespace in types; type may be omitted
		types = ( types || "" ).match( rnothtmlwhite ) || [ "" ];
		t = types.length;
		while ( t-- ) {
			tmp = rtypenamespace.exec( types[ t ] ) || [];
			type = origType = tmp[ 1 ];
			namespaces = ( tmp[ 2 ] || "" ).split( "." ).sort();

			// Unbind all events (on this namespace, if provided) for the element
			if ( !type ) {
				for ( type in events ) {
					jQuery.event.remove( elem, type + types[ t ], handler, selector, true );
				}
				continue;
			}

			special = jQuery.event.special[ type ] || {};
			type = ( selector ? special.delegateType : special.bindType ) || type;
			handlers = events[ type ] || [];
			tmp = tmp[ 2 ] &&
				new RegExp( "(^|\\.)" + namespaces.join( "\\.(?:.*\\.|)" ) + "(\\.|$)" );

			// Remove matching events
			origCount = j = handlers.length;
			while ( j-- ) {
				handleObj = handlers[ j ];

				if ( ( mappedTypes || origType === handleObj.origType ) &&
					( !handler || handler.guid === handleObj.guid ) &&
					( !tmp || tmp.test( handleObj.namespace ) ) &&
					( !selector || selector === handleObj.selector ||
						selector === "**" && handleObj.selector ) ) {
					handlers.splice( j, 1 );

					if ( handleObj.selector ) {
						handlers.delegateCount--;
					}
					if ( special.remove ) {
						special.remove.call( elem, handleObj );
					}
				}
			}

			// Remove generic event handler if we removed something and no more handlers exist
			// (avoids potential for endless recursion during removal of special event handlers)
			if ( origCount && !handlers.length ) {
				if ( !special.teardown ||
					special.teardown.call( elem, namespaces, elemData.handle ) === false ) {

					jQuery.removeEvent( elem, type, elemData.handle );
				}

				delete events[ type ];
			}
		}

		// Remove data and the expando if it's no longer used
		if ( jQuery.isEmptyObject( events ) ) {
			dataPriv.remove( elem, "handle events" );
		}
	},

	dispatch: function( nativeEvent ) {

		var i, j, ret, matched, handleObj, handlerQueue,
			args = new Array( arguments.length ),

			// Make a writable jQuery.Event from the native event object
			event = jQuery.event.fix( nativeEvent ),

			handlers = (
					dataPriv.get( this, "events" ) || Object.create( null )
				)[ event.type ] || [],
			special = jQuery.event.special[ event.type ] || {};

		// Use the fix-ed jQuery.Event rather than the (read-only) native event
		args[ 0 ] = event;

		for ( i = 1; i < arguments.length; i++ ) {
			args[ i ] = arguments[ i ];
		}

		event.delegateTarget = this;

		// Call the preDispatch hook for the mapped type, and let it bail if desired
		if ( special.preDispatch && special.preDispatch.call( this, event ) === false ) {
			return;
		}

		// Determine handlers
		handlerQueue = jQuery.event.handlers.call( this, event, handlers );

		// Run delegates first; they may want to stop propagation beneath us
		i = 0;
		while ( ( matched = handlerQueue[ i++ ] ) && !event.isPropagationStopped() ) {
			event.currentTarget = matched.elem;

			j = 0;
			while ( ( handleObj = matched.handlers[ j++ ] ) &&
				!event.isImmediatePropagationStopped() ) {

				// If the event is namespaced, then each handler is only invoked if it is
				// specially universal or its namespaces are a superset of the event's.
				if ( !event.rnamespace || handleObj.namespace === false ||
					event.rnamespace.test( handleObj.namespace ) ) {

					event.handleObj = handleObj;
					event.data = handleObj.data;

					ret = ( ( jQuery.event.special[ handleObj.origType ] || {} ).handle ||
						handleObj.handler ).apply( matched.elem, args );

					if ( ret !== undefined ) {
						if ( ( event.result = ret ) === false ) {
							event.preventDefault();
							event.stopPropagation();
						}
					}
				}
			}
		}

		// Call the postDispatch hook for the mapped type
		if ( special.postDispatch ) {
			special.postDispatch.call( this, event );
		}

		return event.result;
	},

	handlers: function( event, handlers ) {
		var i, handleObj, sel, matchedHandlers, matchedSelectors,
			handlerQueue = [],
			delegateCount = handlers.delegateCount,
			cur = event.target;

		// Find delegate handlers
		if ( delegateCount &&

			// Support: IE <=9
			// Black-hole SVG <use> instance trees (trac-13180)
			cur.nodeType &&

			// Support: Firefox <=42
			// Suppress spec-violating clicks indicating a non-primary pointer button (trac-3861)
			// https://www.w3.org/TR/DOM-Level-3-Events/#event-type-click
			// Support: IE 11 only
			// ...but not arrow key "clicks" of radio inputs, which can have `button` -1 (gh-2343)
			!( event.type === "click" && event.button >= 1 ) ) {

			for ( ; cur !== this; cur = cur.parentNode || this ) {

				// Don't check non-elements (#13208)
				// Don't process clicks on disabled elements (#6911, #8165, #11382, #11764)
				if ( cur.nodeType === 1 && !( event.type === "click" && cur.disabled === true ) ) {
					matchedHandlers = [];
					matchedSelectors = {};
					for ( i = 0; i < delegateCount; i++ ) {
						handleObj = handlers[ i ];

						// Don't conflict with Object.prototype properties (#13203)
						sel = handleObj.selector + " ";

						if ( matchedSelectors[ sel ] === undefined ) {
							matchedSelectors[ sel ] = handleObj.needsContext ?
								jQuery( sel, this ).index( cur ) > -1 :
								jQuery.find( sel, this, null, [ cur ] ).length;
						}
						if ( matchedSelectors[ sel ] ) {
							matchedHandlers.push( handleObj );
						}
					}
					if ( matchedHandlers.length ) {
						handlerQueue.push( { elem: cur, handlers: matchedHandlers } );
					}
				}
			}
		}

		// Add the remaining (directly-bound) handlers
		cur = this;
		if ( delegateCount < handlers.length ) {
			handlerQueue.push( { elem: cur, handlers: handlers.slice( delegateCount ) } );
		}

		return handlerQueue;
	},

	addProp: function( name, hook ) {
		Object.defineProperty( jQuery.Event.prototype, name, {
			enumerable: true,
			configurable: true,

			get: isFunction( hook ) ?
				function() {
					if ( this.originalEvent ) {
							return hook( this.originalEvent );
					}
				} :
				function() {
					if ( this.originalEvent ) {
							return this.originalEvent[ name ];
					}
				},

			set: function( value ) {
				Object.defineProperty( this, name, {
					enumerable: true,
					configurable: true,
					writable: true,
					value: value
				} );
			}
		} );
	},

	fix: function( originalEvent ) {
		return originalEvent[ jQuery.expando ] ?
			originalEvent :
			new jQuery.Event( originalEvent );
	},

	special: {
		load: {

			// Prevent triggered image.load events from bubbling to window.load
			noBubble: true
		},
		click: {

			// Utilize native event to ensure correct state for checkable inputs
			setup: function( data ) {

				// For mutual compressibility with _default, replace `this` access with a local var.
				// `|| data` is dead code meant only to preserve the variable through minification.
				var el = this || data;

				// Claim the first handler
				if ( rcheckableType.test( el.type ) &&
					el.click && nodeName( el, "input" ) ) {

					// dataPriv.set( el, "click", ... )
					leverageNative( el, "click", returnTrue );
				}

				// Return false to allow normal processing in the caller
				return false;
			},
			trigger: function( data ) {

				// For mutual compressibility with _default, replace `this` access with a local var.
				// `|| data` is dead code meant only to preserve the variable through minification.
				var el = this || data;

				// Force setup before triggering a click
				if ( rcheckableType.test( el.type ) &&
					el.click && nodeName( el, "input" ) ) {

					leverageNative( el, "click" );
				}

				// Return non-false to allow normal event-path propagation
				return true;
			},

			// For cross-browser consistency, suppress native .click() on links
			// Also prevent it if we're currently inside a leveraged native-event stack
			_default: function( event ) {
				var target = event.target;
				return rcheckableType.test( target.type ) &&
					target.click && nodeName( target, "input" ) &&
					dataPriv.get( target, "click" ) ||
					nodeName( target, "a" );
			}
		},

		beforeunload: {
			postDispatch: function( event ) {

				// Support: Firefox 20+
				// Firefox doesn't alert if the returnValue field is not set.
				if ( event.result !== undefined && event.originalEvent ) {
					event.originalEvent.returnValue = event.result;
				}
			}
		}
	}
};

// Ensure the presence of an event listener that handles manually-triggered
// synthetic events by interrupting progress until reinvoked in response to
// *native* events that it fires directly, ensuring that state changes have
// already occurred before other listeners are invoked.
function leverageNative( el, type, expectSync ) {

	// Missing expectSync indicates a trigger call, which must force setup through jQuery.event.add
	if ( !expectSync ) {
		if ( dataPriv.get( el, type ) === undefined ) {
			jQuery.event.add( el, type, returnTrue );
		}
		return;
	}

	// Register the controller as a special universal handler for all event namespaces
	dataPriv.set( el, type, false );
	jQuery.event.add( el, type, {
		namespace: false,
		handler: function( event ) {
			var notAsync, result,
				saved = dataPriv.get( this, type );

			if ( ( event.isTrigger & 1 ) && this[ type ] ) {

				// Interrupt processing of the outer synthetic .trigger()ed event
				// Saved data should be false in such cases, but might be a leftover capture object
				// from an async native handler (gh-4350)
				if ( !saved.length ) {

					// Store arguments for use when handling the inner native event
					// There will always be at least one argument (an event object), so this array
					// will not be confused with a leftover capture object.
					saved = slice.call( arguments );
					dataPriv.set( this, type, saved );

					// Trigger the native event and capture its result
					// Support: IE <=9 - 11+
					// focus() and blur() are asynchronous
					notAsync = expectSync( this, type );
					this[ type ]();
					result = dataPriv.get( this, type );
					if ( saved !== result || notAsync ) {
						dataPriv.set( this, type, false );
					} else {
						result = {};
					}
					if ( saved !== result ) {

						// Cancel the outer synthetic event
						event.stopImmediatePropagation();
						event.preventDefault();
						return result.value;
					}

				// If this is an inner synthetic event for an event with a bubbling surrogate
				// (focus or blur), assume that the surrogate already propagated from triggering the
				// native event and prevent that from happening again here.
				// This technically gets the ordering wrong w.r.t. to `.trigger()` (in which the
				// bubbling surrogate propagates *after* the non-bubbling base), but that seems
				// less bad than duplication.
				} else if ( ( jQuery.event.special[ type ] || {} ).delegateType ) {
					event.stopPropagation();
				}

			// If this is a native event triggered above, everything is now in order
			// Fire an inner synthetic event with the original arguments
			} else if ( saved.length ) {

				// ...and capture the result
				dataPriv.set( this, type, {
					value: jQuery.event.trigger(

						// Support: IE <=9 - 11+
						// Extend with the prototype to reset the above stopImmediatePropagation()
						jQuery.extend( saved[ 0 ], jQuery.Event.prototype ),
						saved.slice( 1 ),
						this
					)
				} );

				// Abort handling of the native event
				event.stopImmediatePropagation();
			}
		}
	} );
}

jQuery.removeEvent = function( elem, type, handle ) {

	// This "if" is needed for plain objects
	if ( elem.removeEventListener ) {
		elem.removeEventListener( type, handle );
	}
};

jQuery.Event = function( src, props ) {

	// Allow instantiation without the 'new' keyword
	if ( !( this instanceof jQuery.Event ) ) {
		return new jQuery.Event( src, props );
	}

	// Event object
	if ( src && src.type ) {
		this.originalEvent = src;
		this.type = src.type;

		// Events bubbling up the document may have been marked as prevented
		// by a handler lower down the tree; reflect the correct value.
		this.isDefaultPrevented = src.defaultPrevented ||
				src.defaultPrevented === undefined &&

				// Support: Android <=2.3 only
				src.returnValue === false ?
			returnTrue :
			returnFalse;

		// Create target properties
		// Support: Safari <=6 - 7 only
		// Target should not be a text node (#504, #13143)
		this.target = ( src.target && src.target.nodeType === 3 ) ?
			src.target.parentNode :
			src.target;

		this.currentTarget = src.currentTarget;
		this.relatedTarget = src.relatedTarget;

	// Event type
	} else {
		this.type = src;
	}

	// Put explicitly provided properties onto the event object
	if ( props ) {
		jQuery.extend( this, props );
	}

	// Create a timestamp if incoming event doesn't have one
	this.timeStamp = src && src.timeStamp || Date.now();

	// Mark it as fixed
	this[ jQuery.expando ] = true;
};

// jQuery.Event is based on DOM3 Events as specified by the ECMAScript Language Binding
// https://www.w3.org/TR/2003/WD-DOM-Level-3-Events-20030331/ecma-script-binding.html
jQuery.Event.prototype = {
	constructor: jQuery.Event,
	isDefaultPrevented: returnFalse,
	isPropagationStopped: returnFalse,
	isImmediatePropagationStopped: returnFalse,
	isSimulated: false,

	preventDefault: function() {
		var e = this.originalEvent;

		this.isDefaultPrevented = returnTrue;

		if ( e && !this.isSimulated ) {
			e.preventDefault();
		}
	},
	stopPropagation: function() {
		var e = this.originalEvent;

		this.isPropagationStopped = returnTrue;

		if ( e && !this.isSimulated ) {
			e.stopPropagation();
		}
	},
	stopImmediatePropagation: function() {
		var e = this.originalEvent;

		this.isImmediatePropagationStopped = returnTrue;

		if ( e && !this.isSimulated ) {
			e.stopImmediatePropagation();
		}

		this.stopPropagation();
	}
};

// Includes all common event props including KeyEvent and MouseEvent specific props
jQuery.each( {
	altKey: true,
	bubbles: true,
	cancelable: true,
	changedTouches: true,
	ctrlKey: true,
	detail: true,
	eventPhase: true,
	metaKey: true,
	pageX: true,
	pageY: true,
	shiftKey: true,
	view: true,
	"char": true,
	code: true,
	charCode: true,
	key: true,
	keyCode: true,
	button: true,
	buttons: true,
	clientX: true,
	clientY: true,
	offsetX: true,
	offsetY: true,
	pointerId: true,
	pointerType: true,
	screenX: true,
	screenY: true,
	targetTouches: true,
	toElement: true,
	touches: true,

	which: function( event ) {
		var button = event.button;

		// Add which for key events
		if ( event.which == null && rkeyEvent.test( event.type ) ) {
			return event.charCode != null ? event.charCode : event.keyCode;
		}

		// Add which for click: 1 === left; 2 === middle; 3 === right
		if ( !event.which && button !== undefined && rmouseEvent.test( event.type ) ) {
			if ( button & 1 ) {
				return 1;
			}

			if ( button & 2 ) {
				return 3;
			}

			if ( button & 4 ) {
				return 2;
			}

			return 0;
		}

		return event.which;
	}
}, jQuery.event.addProp );

jQuery.each( { focus: "focusin", blur: "focusout" }, function( type, delegateType ) {
	jQuery.event.special[ type ] = {

		// Utilize native event if possible so blur/focus sequence is correct
		setup: function() {

			// Claim the first handler
			// dataPriv.set( this, "focus", ... )
			// dataPriv.set( this, "blur", ... )
			leverageNative( this, type, expectSync );

			// Return false to allow normal processing in the caller
			return false;
		},
		trigger: function() {

			// Force setup before trigger
			leverageNative( this, type );

			// Return non-false to allow normal event-path propagation
			return true;
		},

		delegateType: delegateType
	};
} );

// Create mouseenter/leave events using mouseover/out and event-time checks
// so that event delegation works in jQuery.
// Do the same for pointerenter/pointerleave and pointerover/pointerout
//
// Support: Safari 7 only
// Safari sends mouseenter too often; see:
// https://bugs.chromium.org/p/chromium/issues/detail?id=470258
// for the description of the bug (it existed in older Chrome versions as well).
jQuery.each( {
	mouseenter: "mouseover",
	mouseleave: "mouseout",
	pointerenter: "pointerover",
	pointerleave: "pointerout"
}, function( orig, fix ) {
	jQuery.event.special[ orig ] = {
		delegateType: fix,
		bindType: fix,

		handle: function( event ) {
			var ret,
				target = this,
				related = event.relatedTarget,
				handleObj = event.handleObj;

			// For mouseenter/leave call the handler if related is outside the target.
			// NB: No relatedTarget if the mouse left/entered the browser window
			if ( !related || ( related !== target && !jQuery.contains( target, related ) ) ) {
				event.type = handleObj.origType;
				ret = handleObj.handler.apply( this, arguments );
				event.type = fix;
			}
			return ret;
		}
	};
} );

jQuery.fn.extend( {

	on: function( types, selector, data, fn ) {
		return on( this, types, selector, data, fn );
	},
	one: function( types, selector, data, fn ) {
		return on( this, types, selector, data, fn, 1 );
	},
	off: function( types, selector, fn ) {
		var handleObj, type;
		if ( types && types.preventDefault && types.handleObj ) {

			// ( event )  dispatched jQuery.Event
			handleObj = types.handleObj;
			jQuery( types.delegateTarget ).off(
				handleObj.namespace ?
					handleObj.origType + "." + handleObj.namespace :
					handleObj.origType,
				handleObj.selector,
				handleObj.handler
			);
			return this;
		}
		if ( typeof types === "object" ) {

			// ( types-object [, selector] )
			for ( type in types ) {
				this.off( type, selector, types[ type ] );
			}
			return this;
		}
		if ( selector === false || typeof selector === "function" ) {

			// ( types [, fn] )
			fn = selector;
			selector = undefined;
		}
		if ( fn === false ) {
			fn = returnFalse;
		}
		return this.each( function() {
			jQuery.event.remove( this, types, fn, selector );
		} );
	}
} );


var

	// Support: IE <=10 - 11, Edge 12 - 13 only
	// In IE/Edge using regex groups here causes severe slowdowns.
	// See https://connect.microsoft.com/IE/feedback/details/1736512/
	rnoInnerhtml = /<script|<style|<link/i,

	// checked="checked" or checked
	rchecked = /checked\s*(?:[^=]|=\s*.checked.)/i,
	rcleanScript = /^\s*<!(?:\[CDATA\[|--)|(?:\]\]|--)>\s*$/g;

// Prefer a tbody over its parent table for containing new rows
function manipulationTarget( elem, content ) {
	if ( nodeName( elem, "table" ) &&
		nodeName( content.nodeType !== 11 ? content : content.firstChild, "tr" ) ) {

		return jQuery( elem ).children( "tbody" )[ 0 ] || elem;
	}

	return elem;
}

// Replace/restore the type attribute of script elements for safe DOM manipulation
function disableScript( elem ) {
	elem.type = ( elem.getAttribute( "type" ) !== null ) + "/" + elem.type;
	return elem;
}
function restoreScript( elem ) {
	if ( ( elem.type || "" ).slice( 0, 5 ) === "true/" ) {
		elem.type = elem.type.slice( 5 );
	} else {
		elem.removeAttribute( "type" );
	}

	return elem;
}

function cloneCopyEvent( src, dest ) {
	var i, l, type, pdataOld, udataOld, udataCur, events;

	if ( dest.nodeType !== 1 ) {
		return;
	}

	// 1. Copy private data: events, handlers, etc.
	if ( dataPriv.hasData( src ) ) {
		pdataOld = dataPriv.get( src );
		events = pdataOld.events;

		if ( events ) {
			dataPriv.remove( dest, "handle events" );

			for ( type in events ) {
				for ( i = 0, l = events[ type ].length; i < l; i++ ) {
					jQuery.event.add( dest, type, events[ type ][ i ] );
				}
			}
		}
	}

	// 2. Copy user data
	if ( dataUser.hasData( src ) ) {
		udataOld = dataUser.access( src );
		udataCur = jQuery.extend( {}, udataOld );

		dataUser.set( dest, udataCur );
	}
}

// Fix IE bugs, see support tests
function fixInput( src, dest ) {
	var nodeName = dest.nodeName.toLowerCase();

	// Fails to persist the checked state of a cloned checkbox or radio button.
	if ( nodeName === "input" && rcheckableType.test( src.type ) ) {
		dest.checked = src.checked;

	// Fails to return the selected option to the default selected state when cloning options
	} else if ( nodeName === "input" || nodeName === "textarea" ) {
		dest.defaultValue = src.defaultValue;
	}
}

function domManip( collection, args, callback, ignored ) {

	// Flatten any nested arrays
	args = flat( args );

	var fragment, first, scripts, hasScripts, node, doc,
		i = 0,
		l = collection.length,
		iNoClone = l - 1,
		value = args[ 0 ],
		valueIsFunction = isFunction( value );

	// We can't cloneNode fragments that contain checked, in WebKit
	if ( valueIsFunction ||
			( l > 1 && typeof value === "string" &&
				!support.checkClone && rchecked.test( value ) ) ) {
		return collection.each( function( index ) {
			var self = collection.eq( index );
			if ( valueIsFunction ) {
				args[ 0 ] = value.call( this, index, self.html() );
			}
			domManip( self, args, callback, ignored );
		} );
	}

	if ( l ) {
		fragment = buildFragment( args, collection[ 0 ].ownerDocument, false, collection, ignored );
		first = fragment.firstChild;

		if ( fragment.childNodes.length === 1 ) {
			fragment = first;
		}

		// Require either new content or an interest in ignored elements to invoke the callback
		if ( first || ignored ) {
			scripts = jQuery.map( getAll( fragment, "script" ), disableScript );
			hasScripts = scripts.length;

			// Use the original fragment for the last item
			// instead of the first because it can end up
			// being emptied incorrectly in certain situations (#8070).
			for ( ; i < l; i++ ) {
				node = fragment;

				if ( i !== iNoClone ) {
					node = jQuery.clone( node, true, true );

					// Keep references to cloned scripts for later restoration
					if ( hasScripts ) {

						// Support: Android <=4.0 only, PhantomJS 1 only
						// push.apply(_, arraylike) throws on ancient WebKit
						jQuery.merge( scripts, getAll( node, "script" ) );
					}
				}

				callback.call( collection[ i ], node, i );
			}

			if ( hasScripts ) {
				doc = scripts[ scripts.length - 1 ].ownerDocument;

				// Reenable scripts
				jQuery.map( scripts, restoreScript );

				// Evaluate executable scripts on first document insertion
				for ( i = 0; i < hasScripts; i++ ) {
					node = scripts[ i ];
					if ( rscriptType.test( node.type || "" ) &&
						!dataPriv.access( node, "globalEval" ) &&
						jQuery.contains( doc, node ) ) {

						if ( node.src && ( node.type || "" ).toLowerCase()  !== "module" ) {

							// Optional AJAX dependency, but won't run scripts if not present
							if ( jQuery._evalUrl && !node.noModule ) {
								jQuery._evalUrl( node.src, {
									nonce: node.nonce || node.getAttribute( "nonce" )
								}, doc );
							}
						} else {
							DOMEval( node.textContent.replace( rcleanScript, "" ), node, doc );
						}
					}
				}
			}
		}
	}

	return collection;
}

function remove( elem, selector, keepData ) {
	var node,
		nodes = selector ? jQuery.filter( selector, elem ) : elem,
		i = 0;

	for ( ; ( node = nodes[ i ] ) != null; i++ ) {
		if ( !keepData && node.nodeType === 1 ) {
			jQuery.cleanData( getAll( node ) );
		}

		if ( node.parentNode ) {
			if ( keepData && isAttached( node ) ) {
				setGlobalEval( getAll( node, "script" ) );
			}
			node.parentNode.removeChild( node );
		}
	}

	return elem;
}

jQuery.extend( {
	htmlPrefilter: function( html ) {
		return html;
	},

	clone: function( elem, dataAndEvents, deepDataAndEvents ) {
		var i, l, srcElements, destElements,
			clone = elem.cloneNode( true ),
			inPage = isAttached( elem );

		// Fix IE cloning issues
		if ( !support.noCloneChecked && ( elem.nodeType === 1 || elem.nodeType === 11 ) &&
				!jQuery.isXMLDoc( elem ) ) {

			// We eschew Sizzle here for performance reasons: https://jsperf.com/getall-vs-sizzle/2
			destElements = getAll( clone );
			srcElements = getAll( elem );

			for ( i = 0, l = srcElements.length; i < l; i++ ) {
				fixInput( srcElements[ i ], destElements[ i ] );
			}
		}

		// Copy the events from the original to the clone
		if ( dataAndEvents ) {
			if ( deepDataAndEvents ) {
				srcElements = srcElements || getAll( elem );
				destElements = destElements || getAll( clone );

				for ( i = 0, l = srcElements.length; i < l; i++ ) {
					cloneCopyEvent( srcElements[ i ], destElements[ i ] );
				}
			} else {
				cloneCopyEvent( elem, clone );
			}
		}

		// Preserve script evaluation history
		destElements = getAll( clone, "script" );
		if ( destElements.length > 0 ) {
			setGlobalEval( destElements, !inPage && getAll( elem, "script" ) );
		}

		// Return the cloned set
		return clone;
	},

	cleanData: function( elems ) {
		var data, elem, type,
			special = jQuery.event.special,
			i = 0;

		for ( ; ( elem = elems[ i ] ) !== undefined; i++ ) {
			if ( acceptData( elem ) ) {
				if ( ( data = elem[ dataPriv.expando ] ) ) {
					if ( data.events ) {
						for ( type in data.events ) {
							if ( special[ type ] ) {
								jQuery.event.remove( elem, type );

							// This is a shortcut to avoid jQuery.event.remove's overhead
							} else {
								jQuery.removeEvent( elem, type, data.handle );
							}
						}
					}

					// Support: Chrome <=35 - 45+
					// Assign undefined instead of using delete, see Data#remove
					elem[ dataPriv.expando ] = undefined;
				}
				if ( elem[ dataUser.expando ] ) {

					// Support: Chrome <=35 - 45+
					// Assign undefined instead of using delete, see Data#remove
					elem[ dataUser.expando ] = undefined;
				}
			}
		}
	}
} );

jQuery.fn.extend( {
	detach: function( selector ) {
		return remove( this, selector, true );
	},

	remove: function( selector ) {
		return remove( this, selector );
	},

	text: function( value ) {
		return access( this, function( value ) {
			return value === undefined ?
				jQuery.text( this ) :
				this.empty().each( function() {
					if ( this.nodeType === 1 || this.nodeType === 11 || this.nodeType === 9 ) {
						this.textContent = value;
					}
				} );
		}, null, value, arguments.length );
	},

	append: function() {
		return domManip( this, arguments, function( elem ) {
			if ( this.nodeType === 1 || this.nodeType === 11 || this.nodeType === 9 ) {
				var target = manipulationTarget( this, elem );
				target.appendChild( elem );
			}
		} );
	},

	prepend: function() {
		return domManip( this, arguments, function( elem ) {
			if ( this.nodeType === 1 || this.nodeType === 11 || this.nodeType === 9 ) {
				var target = manipulationTarget( this, elem );
				target.insertBefore( elem, target.firstChild );
			}
		} );
	},

	before: function() {
		return domManip( this, arguments, function( elem ) {
			if ( this.parentNode ) {
				this.parentNode.insertBefore( elem, this );
			}
		} );
	},

	after: function() {
		return domManip( this, arguments, function( elem ) {
			if ( this.parentNode ) {
				this.parentNode.insertBefore( elem, this.nextSibling );
			}
		} );
	},

	empty: function() {
		var elem,
			i = 0;

		for ( ; ( elem = this[ i ] ) != null; i++ ) {
			if ( elem.nodeType === 1 ) {

				// Prevent memory leaks
				jQuery.cleanData( getAll( elem, false ) );

				// Remove any remaining nodes
				elem.textContent = "";
			}
		}

		return this;
	},

	clone: function( dataAndEvents, deepDataAndEvents ) {
		dataAndEvents = dataAndEvents == null ? false : dataAndEvents;
		deepDataAndEvents = deepDataAndEvents == null ? dataAndEvents : deepDataAndEvents;

		return this.map( function() {
			return jQuery.clone( this, dataAndEvents, deepDataAndEvents );
		} );
	},

	html: function( value ) {
		return access( this, function( value ) {
			var elem = this[ 0 ] || {},
				i = 0,
				l = this.length;

			if ( value === undefined && elem.nodeType === 1 ) {
				return elem.innerHTML;
			}

			// See if we can take a shortcut and just use innerHTML
			if ( typeof value === "string" && !rnoInnerhtml.test( value ) &&
				!wrapMap[ ( rtagName.exec( value ) || [ "", "" ] )[ 1 ].toLowerCase() ] ) {

				value = jQuery.htmlPrefilter( value );

				try {
					for ( ; i < l; i++ ) {
						elem = this[ i ] || {};

						// Remove element nodes and prevent memory leaks
						if ( elem.nodeType === 1 ) {
							jQuery.cleanData( getAll( elem, false ) );
							elem.innerHTML = value;
						}
					}

					elem = 0;

				// If using innerHTML throws an exception, use the fallback method
				} catch ( e ) {}
			}

			if ( elem ) {
				this.empty().append( value );
			}
		}, null, value, arguments.length );
	},

	replaceWith: function() {
		var ignored = [];

		// Make the changes, replacing each non-ignored context element with the new content
		return domManip( this, arguments, function( elem ) {
			var parent = this.parentNode;

			if ( jQuery.inArray( this, ignored ) < 0 ) {
				jQuery.cleanData( getAll( this ) );
				if ( parent ) {
					parent.replaceChild( elem, this );
				}
			}

		// Force callback invocation
		}, ignored );
	}
} );

jQuery.each( {
	appendTo: "append",
	prependTo: "prepend",
	insertBefore: "before",
	insertAfter: "after",
	replaceAll: "replaceWith"
}, function( name, original ) {
	jQuery.fn[ name ] = function( selector ) {
		var elems,
			ret = [],
			insert = jQuery( selector ),
			last = insert.length - 1,
			i = 0;

		for ( ; i <= last; i++ ) {
			elems = i === last ? this : this.clone( true );
			jQuery( insert[ i ] )[ original ]( elems );

			// Support: Android <=4.0 only, PhantomJS 1 only
			// .get() because push.apply(_, arraylike) throws on ancient WebKit
			push.apply( ret, elems.get() );
		}

		return this.pushStack( ret );
	};
} );
var rnumnonpx = new RegExp( "^(" + pnum + ")(?!px)[a-z%]+$", "i" );

var getStyles = function( elem ) {

		// Support: IE <=11 only, Firefox <=30 (#15098, #14150)
		// IE throws on elements created in popups
		// FF meanwhile throws on frame elements through "defaultView.getComputedStyle"
		var view = elem.ownerDocument.defaultView;

		if ( !view || !view.opener ) {
			view = window;
		}

		return view.getComputedStyle( elem );
	};

var swap = function( elem, options, callback ) {
	var ret, name,
		old = {};

	// Remember the old values, and insert the new ones
	for ( name in options ) {
		old[ name ] = elem.style[ name ];
		elem.style[ name ] = options[ name ];
	}

	ret = callback.call( elem );

	// Revert the old values
	for ( name in options ) {
		elem.style[ name ] = old[ name ];
	}

	return ret;
};


var rboxStyle = new RegExp( cssExpand.join( "|" ), "i" );



( function() {

	// Executing both pixelPosition & boxSizingReliable tests require only one layout
	// so they're executed at the same time to save the second computation.
	function computeStyleTests() {

		// This is a singleton, we need to execute it only once
		if ( !div ) {
			return;
		}

		container.style.cssText = "position:absolute;left:-11111px;width:60px;" +
			"margin-top:1px;padding:0;border:0";
		div.style.cssText =
			"position:relative;display:block;box-sizing:border-box;overflow:scroll;" +
			"margin:auto;border:1px;padding:1px;" +
			"width:60%;top:1%";
		documentElement.appendChild( container ).appendChild( div );

		var divStyle = window.getComputedStyle( div );
		pixelPositionVal = divStyle.top !== "1%";

		// Support: Android 4.0 - 4.3 only, Firefox <=3 - 44
		reliableMarginLeftVal = roundPixelMeasures( divStyle.marginLeft ) === 12;

		// Support: Android 4.0 - 4.3 only, Safari <=9.1 - 10.1, iOS <=7.0 - 9.3
		// Some styles come back with percentage values, even though they shouldn't
		div.style.right = "60%";
		pixelBoxStylesVal = roundPixelMeasures( divStyle.right ) === 36;

		// Support: IE 9 - 11 only
		// Detect misreporting of content dimensions for box-sizing:border-box elements
		boxSizingReliableVal = roundPixelMeasures( divStyle.width ) === 36;

		// Support: IE 9 only
		// Detect overflow:scroll screwiness (gh-3699)
		// Support: Chrome <=64
		// Don't get tricked when zoom affects offsetWidth (gh-4029)
		div.style.position = "absolute";
		scrollboxSizeVal = roundPixelMeasures( div.offsetWidth / 3 ) === 12;

		documentElement.removeChild( container );

		// Nullify the div so it wouldn't be stored in the memory and
		// it will also be a sign that checks already performed
		div = null;
	}

	function roundPixelMeasures( measure ) {
		return Math.round( parseFloat( measure ) );
	}

	var pixelPositionVal, boxSizingReliableVal, scrollboxSizeVal, pixelBoxStylesVal,
		reliableTrDimensionsVal, reliableMarginLeftVal,
		container = document.createElement( "div" ),
		div = document.createElement( "div" );

	// Finish early in limited (non-browser) environments
	if ( !div.style ) {
		return;
	}

	// Support: IE <=9 - 11 only
	// Style of cloned element affects source element cloned (#8908)
	div.style.backgroundClip = "content-box";
	div.cloneNode( true ).style.backgroundClip = "";
	support.clearCloneStyle = div.style.backgroundClip === "content-box";

	jQuery.extend( support, {
		boxSizingReliable: function() {
			computeStyleTests();
			return boxSizingReliableVal;
		},
		pixelBoxStyles: function() {
			computeStyleTests();
			return pixelBoxStylesVal;
		},
		pixelPosition: function() {
			computeStyleTests();
			return pixelPositionVal;
		},
		reliableMarginLeft: function() {
			computeStyleTests();
			return reliableMarginLeftVal;
		},
		scrollboxSize: function() {
			computeStyleTests();
			return scrollboxSizeVal;
		},

		// Support: IE 9 - 11+, Edge 15 - 18+
		// IE/Edge misreport `getComputedStyle` of table rows with width/height
		// set in CSS while `offset*` properties report correct values.
		// Behavior in IE 9 is more subtle than in newer versions & it passes
		// some versions of this test; make sure not to make it pass there!
		reliableTrDimensions: function() {
			var table, tr, trChild, trStyle;
			if ( reliableTrDimensionsVal == null ) {
				table = document.createElement( "table" );
				tr = document.createElement( "tr" );
				trChild = document.createElement( "div" );

				table.style.cssText = "position:absolute;left:-11111px";
				tr.style.height = "1px";
				trChild.style.height = "9px";

				documentElement
					.appendChild( table )
					.appendChild( tr )
					.appendChild( trChild );

				trStyle = window.getComputedStyle( tr );
				reliableTrDimensionsVal = parseInt( trStyle.height ) > 3;

				documentElement.removeChild( table );
			}
			return reliableTrDimensionsVal;
		}
	} );
} )();


function curCSS( elem, name, computed ) {
	var width, minWidth, maxWidth, ret,

		// Support: Firefox 51+
		// Retrieving style before computed somehow
		// fixes an issue with getting wrong values
		// on detached elements
		style = elem.style;

	computed = computed || getStyles( elem );

	// getPropertyValue is needed for:
	//   .css('filter') (IE 9 only, #12537)
	//   .css('--customProperty) (#3144)
	if ( computed ) {
		ret = computed.getPropertyValue( name ) || computed[ name ];

		if ( ret === "" && !isAttached( elem ) ) {
			ret = jQuery.style( elem, name );
		}

		// A tribute to the "awesome hack by Dean Edwards"
		// Android Browser returns percentage for some values,
		// but width seems to be reliably pixels.
		// This is against the CSSOM draft spec:
		// https://drafts.csswg.org/cssom/#resolved-values
		if ( !support.pixelBoxStyles() && rnumnonpx.test( ret ) && rboxStyle.test( name ) ) {

			// Remember the original values
			width = style.width;
			minWidth = style.minWidth;
			maxWidth = style.maxWidth;

			// Put in the new values to get a computed value out
			style.minWidth = style.maxWidth = style.width = ret;
			ret = computed.width;

			// Revert the changed values
			style.width = width;
			style.minWidth = minWidth;
			style.maxWidth = maxWidth;
		}
	}

	return ret !== undefined ?

		// Support: IE <=9 - 11 only
		// IE returns zIndex value as an integer.
		ret + "" :
		ret;
}


function addGetHookIf( conditionFn, hookFn ) {

	// Define the hook, we'll check on the first run if it's really needed.
	return {
		get: function() {
			if ( conditionFn() ) {

				// Hook not needed (or it's not possible to use it due
				// to missing dependency), remove it.
				delete this.get;
				return;
			}

			// Hook needed; redefine it so that the support test is not executed again.
			return ( this.get = hookFn ).apply( this, arguments );
		}
	};
}


var cssPrefixes = [ "Webkit", "Moz", "ms" ],
	emptyStyle = document.createElement( "div" ).style,
	vendorProps = {};

// Return a vendor-prefixed property or undefined
function vendorPropName( name ) {

	// Check for vendor prefixed names
	var capName = name[ 0 ].toUpperCase() + name.slice( 1 ),
		i = cssPrefixes.length;

	while ( i-- ) {
		name = cssPrefixes[ i ] + capName;
		if ( name in emptyStyle ) {
			return name;
		}
	}
}

// Return a potentially-mapped jQuery.cssProps or vendor prefixed property
function finalPropName( name ) {
	var final = jQuery.cssProps[ name ] || vendorProps[ name ];

	if ( final ) {
		return final;
	}
	if ( name in emptyStyle ) {
		return name;
	}
	return vendorProps[ name ] = vendorPropName( name ) || name;
}


var

	// Swappable if display is none or starts with table
	// except "table", "table-cell", or "table-caption"
	// See here for display values: https://developer.mozilla.org/en-US/docs/CSS/display
	rdisplayswap = /^(none|table(?!-c[ea]).+)/,
	rcustomProp = /^--/,
	cssShow = { position: "absolute", visibility: "hidden", display: "block" },
	cssNormalTransform = {
		letterSpacing: "0",
		fontWeight: "400"
	};

function setPositiveNumber( _elem, value, subtract ) {

	// Any relative (+/-) values have already been
	// normalized at this point
	var matches = rcssNum.exec( value );
	return matches ?

		// Guard against undefined "subtract", e.g., when used as in cssHooks
		Math.max( 0, matches[ 2 ] - ( subtract || 0 ) ) + ( matches[ 3 ] || "px" ) :
		value;
}

function boxModelAdjustment( elem, dimension, box, isBorderBox, styles, computedVal ) {
	var i = dimension === "width" ? 1 : 0,
		extra = 0,
		delta = 0;

	// Adjustment may not be necessary
	if ( box === ( isBorderBox ? "border" : "content" ) ) {
		return 0;
	}

	for ( ; i < 4; i += 2 ) {

		// Both box models exclude margin
		if ( box === "margin" ) {
			delta += jQuery.css( elem, box + cssExpand[ i ], true, styles );
		}

		// If we get here with a content-box, we're seeking "padding" or "border" or "margin"
		if ( !isBorderBox ) {

			// Add padding
			delta += jQuery.css( elem, "padding" + cssExpand[ i ], true, styles );

			// For "border" or "margin", add border
			if ( box !== "padding" ) {
				delta += jQuery.css( elem, "border" + cssExpand[ i ] + "Width", true, styles );

			// But still keep track of it otherwise
			} else {
				extra += jQuery.css( elem, "border" + cssExpand[ i ] + "Width", true, styles );
			}

		// If we get here with a border-box (content + padding + border), we're seeking "content" or
		// "padding" or "margin"
		} else {

			// For "content", subtract padding
			if ( box === "content" ) {
				delta -= jQuery.css( elem, "padding" + cssExpand[ i ], true, styles );
			}

			// For "content" or "padding", subtract border
			if ( box !== "margin" ) {
				delta -= jQuery.css( elem, "border" + cssExpand[ i ] + "Width", true, styles );
			}
		}
	}

	// Account for positive content-box scroll gutter when requested by providing computedVal
	if ( !isBorderBox && computedVal >= 0 ) {

		// offsetWidth/offsetHeight is a rounded sum of content, padding, scroll gutter, and border
		// Assuming integer scroll gutter, subtract the rest and round down
		delta += Math.max( 0, Math.ceil(
			elem[ "offset" + dimension[ 0 ].toUpperCase() + dimension.slice( 1 ) ] -
			computedVal -
			delta -
			extra -
			0.5

		// If offsetWidth/offsetHeight is unknown, then we can't determine content-box scroll gutter
		// Use an explicit zero to avoid NaN (gh-3964)
		) ) || 0;
	}

	return delta;
}

function getWidthOrHeight( elem, dimension, extra ) {

	// Start with computed style
	var styles = getStyles( elem ),

		// To avoid forcing a reflow, only fetch boxSizing if we need it (gh-4322).
		// Fake content-box until we know it's needed to know the true value.
		boxSizingNeeded = !support.boxSizingReliable() || extra,
		isBorderBox = boxSizingNeeded &&
			jQuery.css( elem, "boxSizing", false, styles ) === "border-box",
		valueIsBorderBox = isBorderBox,

		val = curCSS( elem, dimension, styles ),
		offsetProp = "offset" + dimension[ 0 ].toUpperCase() + dimension.slice( 1 );

	// Support: Firefox <=54
	// Return a confounding non-pixel value or feign ignorance, as appropriate.
	if ( rnumnonpx.test( val ) ) {
		if ( !extra ) {
			return val;
		}
		val = "auto";
	}


	// Support: IE 9 - 11 only
	// Use offsetWidth/offsetHeight for when box sizing is unreliable.
	// In those cases, the computed value can be trusted to be border-box.
	if ( ( !support.boxSizingReliable() && isBorderBox ||

		// Support: IE 10 - 11+, Edge 15 - 18+
		// IE/Edge misreport `getComputedStyle` of table rows with width/height
		// set in CSS while `offset*` properties report correct values.
		// Interestingly, in some cases IE 9 doesn't suffer from this issue.
		!support.reliableTrDimensions() && nodeName( elem, "tr" ) ||

		// Fall back to offsetWidth/offsetHeight when value is "auto"
		// This happens for inline elements with no explicit setting (gh-3571)
		val === "auto" ||

		// Support: Android <=4.1 - 4.3 only
		// Also use offsetWidth/offsetHeight for misreported inline dimensions (gh-3602)
		!parseFloat( val ) && jQuery.css( elem, "display", false, styles ) === "inline" ) &&

		// Make sure the element is visible & connected
		elem.getClientRects().length ) {

		isBorderBox = jQuery.css( elem, "boxSizing", false, styles ) === "border-box";

		// Where available, offsetWidth/offsetHeight approximate border box dimensions.
		// Where not available (e.g., SVG), assume unreliable box-sizing and interpret the
		// retrieved value as a content box dimension.
		valueIsBorderBox = offsetProp in elem;
		if ( valueIsBorderBox ) {
			val = elem[ offsetProp ];
		}
	}

	// Normalize "" and auto
	val = parseFloat( val ) || 0;

	// Adjust for the element's box model
	return ( val +
		boxModelAdjustment(
			elem,
			dimension,
			extra || ( isBorderBox ? "border" : "content" ),
			valueIsBorderBox,
			styles,

			// Provide the current computed size to request scroll gutter calculation (gh-3589)
			val
		)
	) + "px";
}

jQuery.extend( {

	// Add in style property hooks for overriding the default
	// behavior of getting and setting a style property
	cssHooks: {
		opacity: {
			get: function( elem, computed ) {
				if ( computed ) {

					// We should always get a number back from opacity
					var ret = curCSS( elem, "opacity" );
					return ret === "" ? "1" : ret;
				}
			}
		}
	},

	// Don't automatically add "px" to these possibly-unitless properties
	cssNumber: {
		"animationIterationCount": true,
		"columnCount": true,
		"fillOpacity": true,
		"flexGrow": true,
		"flexShrink": true,
		"fontWeight": true,
		"gridArea": true,
		"gridColumn": true,
		"gridColumnEnd": true,
		"gridColumnStart": true,
		"gridRow": true,
		"gridRowEnd": true,
		"gridRowStart": true,
		"lineHeight": true,
		"opacity": true,
		"order": true,
		"orphans": true,
		"widows": true,
		"zIndex": true,
		"zoom": true
	},

	// Add in properties whose names you wish to fix before
	// setting or getting the value
	cssProps: {},

	// Get and set the style property on a DOM Node
	style: function( elem, name, value, extra ) {

		// Don't set styles on text and comment nodes
		if ( !elem || elem.nodeType === 3 || elem.nodeType === 8 || !elem.style ) {
			return;
		}

		// Make sure that we're working with the right name
		var ret, type, hooks,
			origName = camelCase( name ),
			isCustomProp = rcustomProp.test( name ),
			style = elem.style;

		// Make sure that we're working with the right name. We don't
		// want to query the value if it is a CSS custom property
		// since they are user-defined.
		if ( !isCustomProp ) {
			name = finalPropName( origName );
		}

		// Gets hook for the prefixed version, then unprefixed version
		hooks = jQuery.cssHooks[ name ] || jQuery.cssHooks[ origName ];

		// Check if we're setting a value
		if ( value !== undefined ) {
			type = typeof value;

			// Convert "+=" or "-=" to relative numbers (#7345)
			if ( type === "string" && ( ret = rcssNum.exec( value ) ) && ret[ 1 ] ) {
				value = adjustCSS( elem, name, ret );

				// Fixes bug #9237
				type = "number";
			}

			// Make sure that null and NaN values aren't set (#7116)
			if ( value == null || value !== value ) {
				return;
			}

			// If a number was passed in, add the unit (except for certain CSS properties)
			// The isCustomProp check can be removed in jQuery 4.0 when we only auto-append
			// "px" to a few hardcoded values.
			if ( type === "number" && !isCustomProp ) {
				value += ret && ret[ 3 ] || ( jQuery.cssNumber[ origName ] ? "" : "px" );
			}

			// background-* props affect original clone's values
			if ( !support.clearCloneStyle && value === "" && name.indexOf( "background" ) === 0 ) {
				style[ name ] = "inherit";
			}

			// If a hook was provided, use that value, otherwise just set the specified value
			if ( !hooks || !( "set" in hooks ) ||
				( value = hooks.set( elem, value, extra ) ) !== undefined ) {

				if ( isCustomProp ) {
					style.setProperty( name, value );
				} else {
					style[ name ] = value;
				}
			}

		} else {

			// If a hook was provided get the non-computed value from there
			if ( hooks && "get" in hooks &&
				( ret = hooks.get( elem, false, extra ) ) !== undefined ) {

				return ret;
			}

			// Otherwise just get the value from the style object
			return style[ name ];
		}
	},

	css: function( elem, name, extra, styles ) {
		var val, num, hooks,
			origName = camelCase( name ),
			isCustomProp = rcustomProp.test( name );

		// Make sure that we're working with the right name. We don't
		// want to modify the value if it is a CSS custom property
		// since they are user-defined.
		if ( !isCustomProp ) {
			name = finalPropName( origName );
		}

		// Try prefixed name followed by the unprefixed name
		hooks = jQuery.cssHooks[ name ] || jQuery.cssHooks[ origName ];

		// If a hook was provided get the computed value from there
		if ( hooks && "get" in hooks ) {
			val = hooks.get( elem, true, extra );
		}

		// Otherwise, if a way to get the computed value exists, use that
		if ( val === undefined ) {
			val = curCSS( elem, name, styles );
		}

		// Convert "normal" to computed value
		if ( val === "normal" && name in cssNormalTransform ) {
			val = cssNormalTransform[ name ];
		}

		// Make numeric if forced or a qualifier was provided and val looks numeric
		if ( extra === "" || extra ) {
			num = parseFloat( val );
			return extra === true || isFinite( num ) ? num || 0 : val;
		}

		return val;
	}
} );

jQuery.each( [ "height", "width" ], function( _i, dimension ) {
	jQuery.cssHooks[ dimension ] = {
		get: function( elem, computed, extra ) {
			if ( computed ) {

				// Certain elements can have dimension info if we invisibly show them
				// but it must have a current display style that would benefit
				return rdisplayswap.test( jQuery.css( elem, "display" ) ) &&

					// Support: Safari 8+
					// Table columns in Safari have non-zero offsetWidth & zero
					// getBoundingClientRect().width unless display is changed.
					// Support: IE <=11 only
					// Running getBoundingClientRect on a disconnected node
					// in IE throws an error.
					( !elem.getClientRects().length || !elem.getBoundingClientRect().width ) ?
						swap( elem, cssShow, function() {
							return getWidthOrHeight( elem, dimension, extra );
						} ) :
						getWidthOrHeight( elem, dimension, extra );
			}
		},

		set: function( elem, value, extra ) {
			var matches,
				styles = getStyles( elem ),

				// Only read styles.position if the test has a chance to fail
				// to avoid forcing a reflow.
				scrollboxSizeBuggy = !support.scrollboxSize() &&
					styles.position === "absolute",

				// To avoid forcing a reflow, only fetch boxSizing if we need it (gh-3991)
				boxSizingNeeded = scrollboxSizeBuggy || extra,
				isBorderBox = boxSizingNeeded &&
					jQuery.css( elem, "boxSizing", false, styles ) === "border-box",
				subtract = extra ?
					boxModelAdjustment(
						elem,
						dimension,
						extra,
						isBorderBox,
						styles
					) :
					0;

			// Account for unreliable border-box dimensions by comparing offset* to computed and
			// faking a content-box to get border and padding (gh-3699)
			if ( isBorderBox && scrollboxSizeBuggy ) {
				subtract -= Math.ceil(
					elem[ "offset" + dimension[ 0 ].toUpperCase() + dimension.slice( 1 ) ] -
					parseFloat( styles[ dimension ] ) -
					boxModelAdjustment( elem, dimension, "border", false, styles ) -
					0.5
				);
			}

			// Convert to pixels if value adjustment is needed
			if ( subtract && ( matches = rcssNum.exec( value ) ) &&
				( matches[ 3 ] || "px" ) !== "px" ) {

				elem.style[ dimension ] = value;
				value = jQuery.css( elem, dimension );
			}

			return setPositiveNumber( elem, value, subtract );
		}
	};
} );

jQuery.cssHooks.marginLeft = addGetHookIf( support.reliableMarginLeft,
	function( elem, computed ) {
		if ( computed ) {
			return ( parseFloat( curCSS( elem, "marginLeft" ) ) ||
				elem.getBoundingClientRect().left -
					swap( elem, { marginLeft: 0 }, function() {
						return elem.getBoundingClientRect().left;
					} )
				) + "px";
		}
	}
);

// These hooks are used by animate to expand properties
jQuery.each( {
	margin: "",
	padding: "",
	border: "Width"
}, function( prefix, suffix ) {
	jQuery.cssHooks[ prefix + suffix ] = {
		expand: function( value ) {
			var i = 0,
				expanded = {},

				// Assumes a single number if not a string
				parts = typeof value === "string" ? value.split( " " ) : [ value ];

			for ( ; i < 4; i++ ) {
				expanded[ prefix + cssExpand[ i ] + suffix ] =
					parts[ i ] || parts[ i - 2 ] || parts[ 0 ];
			}

			return expanded;
		}
	};

	if ( prefix !== "margin" ) {
		jQuery.cssHooks[ prefix + suffix ].set = setPositiveNumber;
	}
} );

jQuery.fn.extend( {
	css: function( name, value ) {
		return access( this, function( elem, name, value ) {
			var styles, len,
				map = {},
				i = 0;

			if ( Array.isArray( name ) ) {
				styles = getStyles( elem );
				len = name.length;

				for ( ; i < len; i++ ) {
					map[ name[ i ] ] = jQuery.css( elem, name[ i ], false, styles );
				}

				return map;
			}

			return value !== undefined ?
				jQuery.style( elem, name, value ) :
				jQuery.css( elem, name );
		}, name, value, arguments.length > 1 );
	}
} );


function Tween( elem, options, prop, end, easing ) {
	return new Tween.prototype.init( elem, options, prop, end, easing );
}
jQuery.Tween = Tween;

Tween.prototype = {
	constructor: Tween,
	init: function( elem, options, prop, end, easing, unit ) {
		this.elem = elem;
		this.prop = prop;
		this.easing = easing || jQuery.easing._default;
		this.options = options;
		this.start = this.now = this.cur();
		this.end = end;
		this.unit = unit || ( jQuery.cssNumber[ prop ] ? "" : "px" );
	},
	cur: function() {
		var hooks = Tween.propHooks[ this.prop ];

		return hooks && hooks.get ?
			hooks.get( this ) :
			Tween.propHooks._default.get( this );
	},
	run: function( percent ) {
		var eased,
			hooks = Tween.propHooks[ this.prop ];

		if ( this.options.duration ) {
			this.pos = eased = jQuery.easing[ this.easing ](
				percent, this.options.duration * percent, 0, 1, this.options.duration
			);
		} else {
			this.pos = eased = percent;
		}
		this.now = ( this.end - this.start ) * eased + this.start;

		if ( this.options.step ) {
			this.options.step.call( this.elem, this.now, this );
		}

		if ( hooks && hooks.set ) {
			hooks.set( this );
		} else {
			Tween.propHooks._default.set( this );
		}
		return this;
	}
};

Tween.prototype.init.prototype = Tween.prototype;

Tween.propHooks = {
	_default: {
		get: function( tween ) {
			var result;

			// Use a property on the element directly when it is not a DOM element,
			// or when there is no matching style property that exists.
			if ( tween.elem.nodeType !== 1 ||
				tween.elem[ tween.prop ] != null && tween.elem.style[ tween.prop ] == null ) {
				return tween.elem[ tween.prop ];
			}

			// Passing an empty string as a 3rd parameter to .css will automatically
			// attempt a parseFloat and fallback to a string if the parse fails.
			// Simple values such as "10px" are parsed to Float;
			// complex values such as "rotate(1rad)" are returned as-is.
			result = jQuery.css( tween.elem, tween.prop, "" );

			// Empty strings, null, undefined and "auto" are converted to 0.
			return !result || result === "auto" ? 0 : result;
		},
		set: function( tween ) {

			// Use step hook for back compat.
			// Use cssHook if its there.
			// Use .style if available and use plain properties where available.
			if ( jQuery.fx.step[ tween.prop ] ) {
				jQuery.fx.step[ tween.prop ]( tween );
			} else if ( tween.elem.nodeType === 1 && (
					jQuery.cssHooks[ tween.prop ] ||
					tween.elem.style[ finalPropName( tween.prop ) ] != null ) ) {
				jQuery.style( tween.elem, tween.prop, tween.now + tween.unit );
			} else {
				tween.elem[ tween.prop ] = tween.now;
			}
		}
	}
};

// Support: IE <=9 only
// Panic based approach to setting things on disconnected nodes
Tween.propHooks.scrollTop = Tween.propHooks.scrollLeft = {
	set: function( tween ) {
		if ( tween.elem.nodeType && tween.elem.parentNode ) {
			tween.elem[ tween.prop ] = tween.now;
		}
	}
};

jQuery.easing = {
	linear: function( p ) {
		return p;
	},
	swing: function( p ) {
		return 0.5 - Math.cos( p * Math.PI ) / 2;
	},
	_default: "swing"
};

jQuery.fx = Tween.prototype.init;

// Back compat <1.8 extension point
jQuery.fx.step = {};




var
	fxNow, inProgress,
	rfxtypes = /^(?:toggle|show|hide)$/,
	rrun = /queueHooks$/;

function schedule() {
	if ( inProgress ) {
		if ( document.hidden === false && window.requestAnimationFrame ) {
			window.requestAnimationFrame( schedule );
		} else {
			window.setTimeout( schedule, jQuery.fx.interval );
		}

		jQuery.fx.tick();
	}
}

// Animations created synchronously will run synchronously
function createFxNow() {
	window.setTimeout( function() {
		fxNow = undefined;
	} );
	return ( fxNow = Date.now() );
}

// Generate parameters to create a standard animation
function genFx( type, includeWidth ) {
	var which,
		i = 0,
		attrs = { height: type };

	// If we include width, step value is 1 to do all cssExpand values,
	// otherwise step value is 2 to skip over Left and Right
	includeWidth = includeWidth ? 1 : 0;
	for ( ; i < 4; i += 2 - includeWidth ) {
		which = cssExpand[ i ];
		attrs[ "margin" + which ] = attrs[ "padding" + which ] = type;
	}

	if ( includeWidth ) {
		attrs.opacity = attrs.width = type;
	}

	return attrs;
}

function createTween( value, prop, animation ) {
	var tween,
		collection = ( Animation.tweeners[ prop ] || [] ).concat( Animation.tweeners[ "*" ] ),
		index = 0,
		length = collection.length;
	for ( ; index < length; index++ ) {
		if ( ( tween = collection[ index ].call( animation, prop, value ) ) ) {

			// We're done with this property
			return tween;
		}
	}
}

function defaultPrefilter( elem, props, opts ) {
	var prop, value, toggle, hooks, oldfire, propTween, restoreDisplay, display,
		isBox = "width" in props || "height" in props,
		anim = this,
		orig = {},
		style = elem.style,
		hidden = elem.nodeType && isHiddenWithinTree( elem ),
		dataShow = dataPriv.get( elem, "fxshow" );

	// Queue-skipping animations hijack the fx hooks
	if ( !opts.queue ) {
		hooks = jQuery._queueHooks( elem, "fx" );
		if ( hooks.unqueued == null ) {
			hooks.unqueued = 0;
			oldfire = hooks.empty.fire;
			hooks.empty.fire = function() {
				if ( !hooks.unqueued ) {
					oldfire();
				}
			};
		}
		hooks.unqueued++;

		anim.always( function() {

			// Ensure the complete handler is called before this completes
			anim.always( function() {
				hooks.unqueued--;
				if ( !jQuery.queue( elem, "fx" ).length ) {
					hooks.empty.fire();
				}
			} );
		} );
	}

	// Detect show/hide animations
	for ( prop in props ) {
		value = props[ prop ];
		if ( rfxtypes.test( value ) ) {
			delete props[ prop ];
			toggle = toggle || value === "toggle";
			if ( value === ( hidden ? "hide" : "show" ) ) {

				// Pretend to be hidden if this is a "show" and
				// there is still data from a stopped show/hide
				if ( value === "show" && dataShow && dataShow[ prop ] !== undefined ) {
					hidden = true;

				// Ignore all other no-op show/hide data
				} else {
					continue;
				}
			}
			orig[ prop ] = dataShow && dataShow[ prop ] || jQuery.style( elem, prop );
		}
	}

	// Bail out if this is a no-op like .hide().hide()
	propTween = !jQuery.isEmptyObject( props );
	if ( !propTween && jQuery.isEmptyObject( orig ) ) {
		return;
	}

	// Restrict "overflow" and "display" styles during box animations
	if ( isBox && elem.nodeType === 1 ) {

		// Support: IE <=9 - 11, Edge 12 - 15
		// Record all 3 overflow attributes because IE does not infer the shorthand
		// from identically-valued overflowX and overflowY and Edge just mirrors
		// the overflowX value there.
		opts.overflow = [ style.overflow, style.overflowX, style.overflowY ];

		// Identify a display type, preferring old show/hide data over the CSS cascade
		restoreDisplay = dataShow && dataShow.display;
		if ( restoreDisplay == null ) {
			restoreDisplay = dataPriv.get( elem, "display" );
		}
		display = jQuery.css( elem, "display" );
		if ( display === "none" ) {
			if ( restoreDisplay ) {
				display = restoreDisplay;
			} else {

				// Get nonempty value(s) by temporarily forcing visibility
				showHide( [ elem ], true );
				restoreDisplay = elem.style.display || restoreDisplay;
				display = jQuery.css( elem, "display" );
				showHide( [ elem ] );
			}
		}

		// Animate inline elements as inline-block
		if ( display === "inline" || display === "inline-block" && restoreDisplay != null ) {
			if ( jQuery.css( elem, "float" ) === "none" ) {

				// Restore the original display value at the end of pure show/hide animations
				if ( !propTween ) {
					anim.done( function() {
						style.display = restoreDisplay;
					} );
					if ( restoreDisplay == null ) {
						display = style.display;
						restoreDisplay = display === "none" ? "" : display;
					}
				}
				style.display = "inline-block";
			}
		}
	}

	if ( opts.overflow ) {
		style.overflow = "hidden";
		anim.always( function() {
			style.overflow = opts.overflow[ 0 ];
			style.overflowX = opts.overflow[ 1 ];
			style.overflowY = opts.overflow[ 2 ];
		} );
	}

	// Implement show/hide animations
	propTween = false;
	for ( prop in orig ) {

		// General show/hide setup for this element animation
		if ( !propTween ) {
			if ( dataShow ) {
				if ( "hidden" in dataShow ) {
					hidden = dataShow.hidden;
				}
			} else {
				dataShow = dataPriv.access( elem, "fxshow", { display: restoreDisplay } );
			}

			// Store hidden/visible for toggle so `.stop().toggle()` "reverses"
			if ( toggle ) {
				dataShow.hidden = !hidden;
			}

			// Show elements before animating them
			if ( hidden ) {
				showHide( [ elem ], true );
			}

			/* eslint-disable no-loop-func */

			anim.done( function() {

			/* eslint-enable no-loop-func */

				// The final step of a "hide" animation is actually hiding the element
				if ( !hidden ) {
					showHide( [ elem ] );
				}
				dataPriv.remove( elem, "fxshow" );
				for ( prop in orig ) {
					jQuery.style( elem, prop, orig[ prop ] );
				}
			} );
		}

		// Per-property setup
		propTween = createTween( hidden ? dataShow[ prop ] : 0, prop, anim );
		if ( !( prop in dataShow ) ) {
			dataShow[ prop ] = propTween.start;
			if ( hidden ) {
				propTween.end = propTween.start;
				propTween.start = 0;
			}
		}
	}
}

function propFilter( props, specialEasing ) {
	var index, name, easing, value, hooks;

	// camelCase, specialEasing and expand cssHook pass
	for ( index in props ) {
		name = camelCase( index );
		easing = specialEasing[ name ];
		value = props[ index ];
		if ( Array.isArray( value ) ) {
			easing = value[ 1 ];
			value = props[ index ] = value[ 0 ];
		}

		if ( index !== name ) {
			props[ name ] = value;
			delete props[ index ];
		}

		hooks = jQuery.cssHooks[ name ];
		if ( hooks && "expand" in hooks ) {
			value = hooks.expand( value );
			delete props[ name ];

			// Not quite $.extend, this won't overwrite existing keys.
			// Reusing 'index' because we have the correct "name"
			for ( index in value ) {
				if ( !( index in props ) ) {
					props[ index ] = value[ index ];
					specialEasing[ index ] = easing;
				}
			}
		} else {
			specialEasing[ name ] = easing;
		}
	}
}

function Animation( elem, properties, options ) {
	var result,
		stopped,
		index = 0,
		length = Animation.prefilters.length,
		deferred = jQuery.Deferred().always( function() {

			// Don't match elem in the :animated selector
			delete tick.elem;
		} ),
		tick = function() {
			if ( stopped ) {
				return false;
			}
			var currentTime = fxNow || createFxNow(),
				remaining = Math.max( 0, animation.startTime + animation.duration - currentTime ),

				// Support: Android 2.3 only
				// Archaic crash bug won't allow us to use `1 - ( 0.5 || 0 )` (#12497)
				temp = remaining / animation.duration || 0,
				percent = 1 - temp,
				index = 0,
				length = animation.tweens.length;

			for ( ; index < length; index++ ) {
				animation.tweens[ index ].run( percent );
			}

			deferred.notifyWith( elem, [ animation, percent, remaining ] );

			// If there's more to do, yield
			if ( percent < 1 && length ) {
				return remaining;
			}

			// If this was an empty animation, synthesize a final progress notification
			if ( !length ) {
				deferred.notifyWith( elem, [ animation, 1, 0 ] );
			}

			// Resolve the animation and report its conclusion
			deferred.resolveWith( elem, [ animation ] );
			return false;
		},
		animation = deferred.promise( {
			elem: elem,
			props: jQuery.extend( {}, properties ),
			opts: jQuery.extend( true, {
				specialEasing: {},
				easing: jQuery.easing._default
			}, options ),
			originalProperties: properties,
			originalOptions: options,
			startTime: fxNow || createFxNow(),
			duration: options.duration,
			tweens: [],
			createTween: function( prop, end ) {
				var tween = jQuery.Tween( elem, animation.opts, prop, end,
						animation.opts.specialEasing[ prop ] || animation.opts.easing );
				animation.tweens.push( tween );
				return tween;
			},
			stop: function( gotoEnd ) {
				var index = 0,

					// If we are going to the end, we want to run all the tweens
					// otherwise we skip this part
					length = gotoEnd ? animation.tweens.length : 0;
				if ( stopped ) {
					return this;
				}
				stopped = true;
				for ( ; index < length; index++ ) {
					animation.tweens[ index ].run( 1 );
				}

				// Resolve when we played the last frame; otherwise, reject
				if ( gotoEnd ) {
					deferred.notifyWith( elem, [ animation, 1, 0 ] );
					deferred.resolveWith( elem, [ animation, gotoEnd ] );
				} else {
					deferred.rejectWith( elem, [ animation, gotoEnd ] );
				}
				return this;
			}
		} ),
		props = animation.props;

	propFilter( props, animation.opts.specialEasing );

	for ( ; index < length; index++ ) {
		result = Animation.prefilters[ index ].call( animation, elem, props, animation.opts );
		if ( result ) {
			if ( isFunction( result.stop ) ) {
				jQuery._queueHooks( animation.elem, animation.opts.queue ).stop =
					result.stop.bind( result );
			}
			return result;
		}
	}

	jQuery.map( props, createTween, animation );

	if ( isFunction( animation.opts.start ) ) {
		animation.opts.start.call( elem, animation );
	}

	// Attach callbacks from options
	animation
		.progress( animation.opts.progress )
		.done( animation.opts.done, animation.opts.complete )
		.fail( animation.opts.fail )
		.always( animation.opts.always );

	jQuery.fx.timer(
		jQuery.extend( tick, {
			elem: elem,
			anim: animation,
			queue: animation.opts.queue
		} )
	);

	return animation;
}

jQuery.Animation = jQuery.extend( Animation, {

	tweeners: {
		"*": [ function( prop, value ) {
			var tween = this.createTween( prop, value );
			adjustCSS( tween.elem, prop, rcssNum.exec( value ), tween );
			return tween;
		} ]
	},

	tweener: function( props, callback ) {
		if ( isFunction( props ) ) {
			callback = props;
			props = [ "*" ];
		} else {
			props = props.match( rnothtmlwhite );
		}

		var prop,
			index = 0,
			length = props.length;

		for ( ; index < length; index++ ) {
			prop = props[ index ];
			Animation.tweeners[ prop ] = Animation.tweeners[ prop ] || [];
			Animation.tweeners[ prop ].unshift( callback );
		}
	},

	prefilters: [ defaultPrefilter ],

	prefilter: function( callback, prepend ) {
		if ( prepend ) {
			Animation.prefilters.unshift( callback );
		} else {
			Animation.prefilters.push( callback );
		}
	}
} );

jQuery.speed = function( speed, easing, fn ) {
	var opt = speed && typeof speed === "object" ? jQuery.extend( {}, speed ) : {
		complete: fn || !fn && easing ||
			isFunction( speed ) && speed,
		duration: speed,
		easing: fn && easing || easing && !isFunction( easing ) && easing
	};

	// Go to the end state if fx are off
	if ( jQuery.fx.off ) {
		opt.duration = 0;

	} else {
		if ( typeof opt.duration !== "number" ) {
			if ( opt.duration in jQuery.fx.speeds ) {
				opt.duration = jQuery.fx.speeds[ opt.duration ];

			} else {
				opt.duration = jQuery.fx.speeds._default;
			}
		}
	}

	// Normalize opt.queue - true/undefined/null -> "fx"
	if ( opt.queue == null || opt.queue === true ) {
		opt.queue = "fx";
	}

	// Queueing
	opt.old = opt.complete;

	opt.complete = function() {
		if ( isFunction( opt.old ) ) {
			opt.old.call( this );
		}

		if ( opt.queue ) {
			jQuery.dequeue( this, opt.queue );
		}
	};

	return opt;
};

jQuery.fn.extend( {
	fadeTo: function( speed, to, easing, callback ) {

		// Show any hidden elements after setting opacity to 0
		return this.filter( isHiddenWithinTree ).css( "opacity", 0 ).show()

			// Animate to the value specified
			.end().animate( { opacity: to }, speed, easing, callback );
	},
	animate: function( prop, speed, easing, callback ) {
		var empty = jQuery.isEmptyObject( prop ),
			optall = jQuery.speed( speed, easing, callback ),
			doAnimation = function() {

				// Operate on a copy of prop so per-property easing won't be lost
				var anim = Animation( this, jQuery.extend( {}, prop ), optall );

				// Empty animations, or finishing resolves immediately
				if ( empty || dataPriv.get( this, "finish" ) ) {
					anim.stop( true );
				}
			};
			doAnimation.finish = doAnimation;

		return empty || optall.queue === false ?
			this.each( doAnimation ) :
			this.queue( optall.queue, doAnimation );
	},
	stop: function( type, clearQueue, gotoEnd ) {
		var stopQueue = function( hooks ) {
			var stop = hooks.stop;
			delete hooks.stop;
			stop( gotoEnd );
		};

		if ( typeof type !== "string" ) {
			gotoEnd = clearQueue;
			clearQueue = type;
			type = undefined;
		}
		if ( clearQueue ) {
			this.queue( type || "fx", [] );
		}

		return this.each( function() {
			var dequeue = true,
				index = type != null && type + "queueHooks",
				timers = jQuery.timers,
				data = dataPriv.get( this );

			if ( index ) {
				if ( data[ index ] && data[ index ].stop ) {
					stopQueue( data[ index ] );
				}
			} else {
				for ( index in data ) {
					if ( data[ index ] && data[ index ].stop && rrun.test( index ) ) {
						stopQueue( data[ index ] );
					}
				}
			}

			for ( index = timers.length; index--; ) {
				if ( timers[ index ].elem === this &&
					( type == null || timers[ index ].queue === type ) ) {

					timers[ index ].anim.stop( gotoEnd );
					dequeue = false;
					timers.splice( index, 1 );
				}
			}

			// Start the next in the queue if the last step wasn't forced.
			// Timers currently will call their complete callbacks, which
			// will dequeue but only if they were gotoEnd.
			if ( dequeue || !gotoEnd ) {
				jQuery.dequeue( this, type );
			}
		} );
	},
	finish: function( type ) {
		if ( type !== false ) {
			type = type || "fx";
		}
		return this.each( function() {
			var index,
				data = dataPriv.get( this ),
				queue = data[ type + "queue" ],
				hooks = data[ type + "queueHooks" ],
				timers = jQuery.timers,
				length = queue ? queue.length : 0;

			// Enable finishing flag on private data
			data.finish = true;

			// Empty the queue first
			jQuery.queue( this, type, [] );

			if ( hooks && hooks.stop ) {
				hooks.stop.call( this, true );
			}

			// Look for any active animations, and finish them
			for ( index = timers.length; index--; ) {
				if ( timers[ index ].elem === this && timers[ index ].queue === type ) {
					timers[ index ].anim.stop( true );
					timers.splice( index, 1 );
				}
			}

			// Look for any animations in the old queue and finish them
			for ( index = 0; index < length; index++ ) {
				if ( queue[ index ] && queue[ index ].finish ) {
					queue[ index ].finish.call( this );
				}
			}

			// Turn off finishing flag
			delete data.finish;
		} );
	}
} );

jQuery.each( [ "toggle", "show", "hide" ], function( _i, name ) {
	var cssFn = jQuery.fn[ name ];
	jQuery.fn[ name ] = function( speed, easing, callback ) {
		return speed == null || typeof speed === "boolean" ?
			cssFn.apply( this, arguments ) :
			this.animate( genFx( name, true ), speed, easing, callback );
	};
} );

// Generate shortcuts for custom animations
jQuery.each( {
	slideDown: genFx( "show" ),
	slideUp: genFx( "hide" ),
	slideToggle: genFx( "toggle" ),
	fadeIn: { opacity: "show" },
	fadeOut: { opacity: "hide" },
	fadeToggle: { opacity: "toggle" }
}, function( name, props ) {
	jQuery.fn[ name ] = function( speed, easing, callback ) {
		return this.animate( props, speed, easing, callback );
	};
} );

jQuery.timers = [];
jQuery.fx.tick = function() {
	var timer,
		i = 0,
		timers = jQuery.timers;

	fxNow = Date.now();

	for ( ; i < timers.length; i++ ) {
		timer = timers[ i ];

		// Run the timer and safely remove it when done (allowing for external removal)
		if ( !timer() && timers[ i ] === timer ) {
			timers.splice( i--, 1 );
		}
	}

	if ( !timers.length ) {
		jQuery.fx.stop();
	}
	fxNow = undefined;
};

jQuery.fx.timer = function( timer ) {
	jQuery.timers.push( timer );
	jQuery.fx.start();
};

jQuery.fx.interval = 13;
jQuery.fx.start = function() {
	if ( inProgress ) {
		return;
	}

	inProgress = true;
	schedule();
};

jQuery.fx.stop = function() {
	inProgress = null;
};

jQuery.fx.speeds = {
	slow: 600,
	fast: 200,

	// Default speed
	_default: 400
};


// Based off of the plugin by Clint Helfers, with permission.
// https://web.archive.org/web/20100324014747/http://blindsignals.com/index.php/2009/07/jquery-delay/
jQuery.fn.delay = function( time, type ) {
	time = jQuery.fx ? jQuery.fx.speeds[ time ] || time : time;
	type = type || "fx";

	return this.queue( type, function( next, hooks ) {
		var timeout = window.setTimeout( next, time );
		hooks.stop = function() {
			window.clearTimeout( timeout );
		};
	} );
};


( function() {
	var input = document.createElement( "input" ),
		select = document.createElement( "select" ),
		opt = select.appendChild( document.createElement( "option" ) );

	input.type = "checkbox";

	// Support: Android <=4.3 only
	// Default value for a checkbox should be "on"
	support.checkOn = input.value !== "";

	// Support: IE <=11 only
	// Must access selectedIndex to make default options select
	support.optSelected = opt.selected;

	// Support: IE <=11 only
	// An input loses its value after becoming a radio
	input = document.createElement( "input" );
	input.value = "t";
	input.type = "radio";
	support.radioValue = input.value === "t";
} )();


var boolHook,
	attrHandle = jQuery.expr.attrHandle;

jQuery.fn.extend( {
	attr: function( name, value ) {
		return access( this, jQuery.attr, name, value, arguments.length > 1 );
	},

	removeAttr: function( name ) {
		return this.each( function() {
			jQuery.removeAttr( this, name );
		} );
	}
} );

jQuery.extend( {
	attr: function( elem, name, value ) {
		var ret, hooks,
			nType = elem.nodeType;

		// Don't get/set attributes on text, comment and attribute nodes
		if ( nType === 3 || nType === 8 || nType === 2 ) {
			return;
		}

		// Fallback to prop when attributes are not supported
		if ( typeof elem.getAttribute === "undefined" ) {
			return jQuery.prop( elem, name, value );
		}

		// Attribute hooks are determined by the lowercase version
		// Grab necessary hook if one is defined
		if ( nType !== 1 || !jQuery.isXMLDoc( elem ) ) {
			hooks = jQuery.attrHooks[ name.toLowerCase() ] ||
				( jQuery.expr.match.bool.test( name ) ? boolHook : undefined );
		}

		if ( value !== undefined ) {
			if ( value === null ) {
				jQuery.removeAttr( elem, name );
				return;
			}

			if ( hooks && "set" in hooks &&
				( ret = hooks.set( elem, value, name ) ) !== undefined ) {
				return ret;
			}

			elem.setAttribute( name, value + "" );
			return value;
		}

		if ( hooks && "get" in hooks && ( ret = hooks.get( elem, name ) ) !== null ) {
			return ret;
		}

		ret = jQuery.find.attr( elem, name );

		// Non-existent attributes return null, we normalize to undefined
		return ret == null ? undefined : ret;
	},

	attrHooks: {
		type: {
			set: function( elem, value ) {
				if ( !support.radioValue && value === "radio" &&
					nodeName( elem, "input" ) ) {
					var val = elem.value;
					elem.setAttribute( "type", value );
					if ( val ) {
						elem.value = val;
					}
					return value;
				}
			}
		}
	},

	removeAttr: function( elem, value ) {
		var name,
			i = 0,

			// Attribute names can contain non-HTML whitespace characters
			// https://html.spec.whatwg.org/multipage/syntax.html#attributes-2
			attrNames = value && value.match( rnothtmlwhite );

		if ( attrNames && elem.nodeType === 1 ) {
			while ( ( name = attrNames[ i++ ] ) ) {
				elem.removeAttribute( name );
			}
		}
	}
} );

// Hooks for boolean attributes
boolHook = {
	set: function( elem, value, name ) {
		if ( value === false ) {

			// Remove boolean attributes when set to false
			jQuery.removeAttr( elem, name );
		} else {
			elem.setAttribute( name, name );
		}
		return name;
	}
};

jQuery.each( jQuery.expr.match.bool.source.match( /\w+/g ), function( _i, name ) {
	var getter = attrHandle[ name ] || jQuery.find.attr;

	attrHandle[ name ] = function( elem, name, isXML ) {
		var ret, handle,
			lowercaseName = name.toLowerCase();

		if ( !isXML ) {

			// Avoid an infinite loop by temporarily removing this function from the getter
			handle = attrHandle[ lowercaseName ];
			attrHandle[ lowercaseName ] = ret;
			ret = getter( elem, name, isXML ) != null ?
				lowercaseName :
				null;
			attrHandle[ lowercaseName ] = handle;
		}
		return ret;
	};
} );




var rfocusable = /^(?:input|select|textarea|button)$/i,
	rclickable = /^(?:a|area)$/i;

jQuery.fn.extend( {
	prop: function( name, value ) {
		return access( this, jQuery.prop, name, value, arguments.length > 1 );
	},

	removeProp: function( name ) {
		return this.each( function() {
			delete this[ jQuery.propFix[ name ] || name ];
		} );
	}
} );

jQuery.extend( {
	prop: function( elem, name, value ) {
		var ret, hooks,
			nType = elem.nodeType;

		// Don't get/set properties on text, comment and attribute nodes
		if ( nType === 3 || nType === 8 || nType === 2 ) {
			return;
		}

		if ( nType !== 1 || !jQuery.isXMLDoc( elem ) ) {

			// Fix name and attach hooks
			name = jQuery.propFix[ name ] || name;
			hooks = jQuery.propHooks[ name ];
		}

		if ( value !== undefined ) {
			if ( hooks && "set" in hooks &&
				( ret = hooks.set( elem, value, name ) ) !== undefined ) {
				return ret;
			}

			return ( elem[ name ] = value );
		}

		if ( hooks && "get" in hooks && ( ret = hooks.get( elem, name ) ) !== null ) {
			return ret;
		}

		return elem[ name ];
	},

	propHooks: {
		tabIndex: {
			get: function( elem ) {

				// Support: IE <=9 - 11 only
				// elem.tabIndex doesn't always return the
				// correct value when it hasn't been explicitly set
				// https://web.archive.org/web/20141116233347/http://fluidproject.org/blog/2008/01/09/getting-setting-and-removing-tabindex-values-with-javascript/
				// Use proper attribute retrieval(#12072)
				var tabindex = jQuery.find.attr( elem, "tabindex" );

				if ( tabindex ) {
					return parseInt( tabindex, 10 );
				}

				if (
					rfocusable.test( elem.nodeName ) ||
					rclickable.test( elem.nodeName ) &&
					elem.href
				) {
					return 0;
				}

				return -1;
			}
		}
	},

	propFix: {
		"for": "htmlFor",
		"class": "className"
	}
} );

// Support: IE <=11 only
// Accessing the selectedIndex property
// forces the browser to respect setting selected
// on the option
// The getter ensures a default option is selected
// when in an optgroup
// eslint rule "no-unused-expressions" is disabled for this code
// since it considers such accessions noop
if ( !support.optSelected ) {
	jQuery.propHooks.selected = {
		get: function( elem ) {

			/* eslint no-unused-expressions: "off" */

			var parent = elem.parentNode;
			if ( parent && parent.parentNode ) {
				parent.parentNode.selectedIndex;
			}
			return null;
		},
		set: function( elem ) {

			/* eslint no-unused-expressions: "off" */

			var parent = elem.parentNode;
			if ( parent ) {
				parent.selectedIndex;

				if ( parent.parentNode ) {
					parent.parentNode.selectedIndex;
				}
			}
		}
	};
}

jQuery.each( [
	"tabIndex",
	"readOnly",
	"maxLength",
	"cellSpacing",
	"cellPadding",
	"rowSpan",
	"colSpan",
	"useMap",
	"frameBorder",
	"contentEditable"
], function() {
	jQuery.propFix[ this.toLowerCase() ] = this;
} );




	// Strip and collapse whitespace according to HTML spec
	// https://infra.spec.whatwg.org/#strip-and-collapse-ascii-whitespace
	function stripAndCollapse( value ) {
		var tokens = value.match( rnothtmlwhite ) || [];
		return tokens.join( " " );
	}


function getClass( elem ) {
	return elem.getAttribute && elem.getAttribute( "class" ) || "";
}

function classesToArray( value ) {
	if ( Array.isArray( value ) ) {
		return value;
	}
	if ( typeof value === "string" ) {
		return value.match( rnothtmlwhite ) || [];
	}
	return [];
}

jQuery.fn.extend( {
	addClass: function( value ) {
		var classes, elem, cur, curValue, clazz, j, finalValue,
			i = 0;

		if ( isFunction( value ) ) {
			return this.each( function( j ) {
				jQuery( this ).addClass( value.call( this, j, getClass( this ) ) );
			} );
		}

		classes = classesToArray( value );

		if ( classes.length ) {
			while ( ( elem = this[ i++ ] ) ) {
				curValue = getClass( elem );
				cur = elem.nodeType === 1 && ( " " + stripAndCollapse( curValue ) + " " );

				if ( cur ) {
					j = 0;
					while ( ( clazz = classes[ j++ ] ) ) {
						if ( cur.indexOf( " " + clazz + " " ) < 0 ) {
							cur += clazz + " ";
						}
					}

					// Only assign if different to avoid unneeded rendering.
					finalValue = stripAndCollapse( cur );
					if ( curValue !== finalValue ) {
						elem.setAttribute( "class", finalValue );
					}
				}
			}
		}

		return this;
	},

	removeClass: function( value ) {
		var classes, elem, cur, curValue, clazz, j, finalValue,
			i = 0;

		if ( isFunction( value ) ) {
			return this.each( function( j ) {
				jQuery( this ).removeClass( value.call( this, j, getClass( this ) ) );
			} );
		}

		if ( !arguments.length ) {
			return this.attr( "class", "" );
		}

		classes = classesToArray( value );

		if ( classes.length ) {
			while ( ( elem = this[ i++ ] ) ) {
				curValue = getClass( elem );

				// This expression is here for better compressibility (see addClass)
				cur = elem.nodeType === 1 && ( " " + stripAndCollapse( curValue ) + " " );

				if ( cur ) {
					j = 0;
					while ( ( clazz = classes[ j++ ] ) ) {

						// Remove *all* instances
						while ( cur.indexOf( " " + clazz + " " ) > -1 ) {
							cur = cur.replace( " " + clazz + " ", " " );
						}
					}

					// Only assign if different to avoid unneeded rendering.
					finalValue = stripAndCollapse( cur );
					if ( curValue !== finalValue ) {
						elem.setAttribute( "class", finalValue );
					}
				}
			}
		}

		return this;
	},

	toggleClass: function( value, stateVal ) {
		var type = typeof value,
			isValidValue = type === "string" || Array.isArray( value );

		if ( typeof stateVal === "boolean" && isValidValue ) {
			return stateVal ? this.addClass( value ) : this.removeClass( value );
		}

		if ( isFunction( value ) ) {
			return this.each( function( i ) {
				jQuery( this ).toggleClass(
					value.call( this, i, getClass( this ), stateVal ),
					stateVal
				);
			} );
		}

		return this.each( function() {
			var className, i, self, classNames;

			if ( isValidValue ) {

				// Toggle individual class names
				i = 0;
				self = jQuery( this );
				classNames = classesToArray( value );

				while ( ( className = classNames[ i++ ] ) ) {

					// Check each className given, space separated list
					if ( self.hasClass( className ) ) {
						self.removeClass( className );
					} else {
						self.addClass( className );
					}
				}

			// Toggle whole class name
			} else if ( value === undefined || type === "boolean" ) {
				className = getClass( this );
				if ( className ) {

					// Store className if set
					dataPriv.set( this, "__className__", className );
				}

				// If the element has a class name or if we're passed `false`,
				// then remove the whole classname (if there was one, the above saved it).
				// Otherwise bring back whatever was previously saved (if anything),
				// falling back to the empty string if nothing was stored.
				if ( this.setAttribute ) {
					this.setAttribute( "class",
						className || value === false ?
						"" :
						dataPriv.get( this, "__className__" ) || ""
					);
				}
			}
		} );
	},

	hasClass: function( selector ) {
		var className, elem,
			i = 0;

		className = " " + selector + " ";
		while ( ( elem = this[ i++ ] ) ) {
			if ( elem.nodeType === 1 &&
				( " " + stripAndCollapse( getClass( elem ) ) + " " ).indexOf( className ) > -1 ) {
					return true;
			}
		}

		return false;
	}
} );




var rreturn = /\r/g;

jQuery.fn.extend( {
	val: function( value ) {
		var hooks, ret, valueIsFunction,
			elem = this[ 0 ];

		if ( !arguments.length ) {
			if ( elem ) {
				hooks = jQuery.valHooks[ elem.type ] ||
					jQuery.valHooks[ elem.nodeName.toLowerCase() ];

				if ( hooks &&
					"get" in hooks &&
					( ret = hooks.get( elem, "value" ) ) !== undefined
				) {
					return ret;
				}

				ret = elem.value;

				// Handle most common string cases
				if ( typeof ret === "string" ) {
					return ret.replace( rreturn, "" );
				}

				// Handle cases where value is null/undef or number
				return ret == null ? "" : ret;
			}

			return;
		}

		valueIsFunction = isFunction( value );

		return this.each( function( i ) {
			var val;

			if ( this.nodeType !== 1 ) {
				return;
			}

			if ( valueIsFunction ) {
				val = value.call( this, i, jQuery( this ).val() );
			} else {
				val = value;
			}

			// Treat null/undefined as ""; convert numbers to string
			if ( val == null ) {
				val = "";

			} else if ( typeof val === "number" ) {
				val += "";

			} else if ( Array.isArray( val ) ) {
				val = jQuery.map( val, function( value ) {
					return value == null ? "" : value + "";
				} );
			}

			hooks = jQuery.valHooks[ this.type ] || jQuery.valHooks[ this.nodeName.toLowerCase() ];

			// If set returns undefined, fall back to normal setting
			if ( !hooks || !( "set" in hooks ) || hooks.set( this, val, "value" ) === undefined ) {
				this.value = val;
			}
		} );
	}
} );

jQuery.extend( {
	valHooks: {
		option: {
			get: function( elem ) {

				var val = jQuery.find.attr( elem, "value" );
				return val != null ?
					val :

					// Support: IE <=10 - 11 only
					// option.text throws exceptions (#14686, #14858)
					// Strip and collapse whitespace
					// https://html.spec.whatwg.org/#strip-and-collapse-whitespace
					stripAndCollapse( jQuery.text( elem ) );
			}
		},
		select: {
			get: function( elem ) {
				var value, option, i,
					options = elem.options,
					index = elem.selectedIndex,
					one = elem.type === "select-one",
					values = one ? null : [],
					max = one ? index + 1 : options.length;

				if ( index < 0 ) {
					i = max;

				} else {
					i = one ? index : 0;
				}

				// Loop through all the selected options
				for ( ; i < max; i++ ) {
					option = options[ i ];

					// Support: IE <=9 only
					// IE8-9 doesn't update selected after form reset (#2551)
					if ( ( option.selected || i === index ) &&

							// Don't return options that are disabled or in a disabled optgroup
							!option.disabled &&
							( !option.parentNode.disabled ||
								!nodeName( option.parentNode, "optgroup" ) ) ) {

						// Get the specific value for the option
						value = jQuery( option ).val();

						// We don't need an array for one selects
						if ( one ) {
							return value;
						}

						// Multi-Selects return an array
						values.push( value );
					}
				}

				return values;
			},

			set: function( elem, value ) {
				var optionSet, option,
					options = elem.options,
					values = jQuery.makeArray( value ),
					i = options.length;

				while ( i-- ) {
					option = options[ i ];

					/* eslint-disable no-cond-assign */

					if ( option.selected =
						jQuery.inArray( jQuery.valHooks.option.get( option ), values ) > -1
					) {
						optionSet = true;
					}

					/* eslint-enable no-cond-assign */
				}

				// Force browsers to behave consistently when non-matching value is set
				if ( !optionSet ) {
					elem.selectedIndex = -1;
				}
				return values;
			}
		}
	}
} );

// Radios and checkboxes getter/setter
jQuery.each( [ "radio", "checkbox" ], function() {
	jQuery.valHooks[ this ] = {
		set: function( elem, value ) {
			if ( Array.isArray( value ) ) {
				return ( elem.checked = jQuery.inArray( jQuery( elem ).val(), value ) > -1 );
			}
		}
	};
	if ( !support.checkOn ) {
		jQuery.valHooks[ this ].get = function( elem ) {
			return elem.getAttribute( "value" ) === null ? "on" : elem.value;
		};
	}
} );




// Return jQuery for attributes-only inclusion


support.focusin = "onfocusin" in window;


var rfocusMorph = /^(?:focusinfocus|focusoutblur)$/,
	stopPropagationCallback = function( e ) {
		e.stopPropagation();
	};

jQuery.extend( jQuery.event, {

	trigger: function( event, data, elem, onlyHandlers ) {

		var i, cur, tmp, bubbleType, ontype, handle, special, lastElement,
			eventPath = [ elem || document ],
			type = hasOwn.call( event, "type" ) ? event.type : event,
			namespaces = hasOwn.call( event, "namespace" ) ? event.namespace.split( "." ) : [];

		cur = lastElement = tmp = elem = elem || document;

		// Don't do events on text and comment nodes
		if ( elem.nodeType === 3 || elem.nodeType === 8 ) {
			return;
		}

		// focus/blur morphs to focusin/out; ensure we're not firing them right now
		if ( rfocusMorph.test( type + jQuery.event.triggered ) ) {
			return;
		}

		if ( type.indexOf( "." ) > -1 ) {

			// Namespaced trigger; create a regexp to match event type in handle()
			namespaces = type.split( "." );
			type = namespaces.shift();
			namespaces.sort();
		}
		ontype = type.indexOf( ":" ) < 0 && "on" + type;

		// Caller can pass in a jQuery.Event object, Object, or just an event type string
		event = event[ jQuery.expando ] ?
			event :
			new jQuery.Event( type, typeof event === "object" && event );

		// Trigger bitmask: & 1 for native handlers; & 2 for jQuery (always true)
		event.isTrigger = onlyHandlers ? 2 : 3;
		event.namespace = namespaces.join( "." );
		event.rnamespace = event.namespace ?
			new RegExp( "(^|\\.)" + namespaces.join( "\\.(?:.*\\.|)" ) + "(\\.|$)" ) :
			null;

		// Clean up the event in case it is being reused
		event.result = undefined;
		if ( !event.target ) {
			event.target = elem;
		}

		// Clone any incoming data and prepend the event, creating the handler arg list
		data = data == null ?
			[ event ] :
			jQuery.makeArray( data, [ event ] );

		// Allow special events to draw outside the lines
		special = jQuery.event.special[ type ] || {};
		if ( !onlyHandlers && special.trigger && special.trigger.apply( elem, data ) === false ) {
			return;
		}

		// Determine event propagation path in advance, per W3C events spec (#9951)
		// Bubble up to document, then to window; watch for a global ownerDocument var (#9724)
		if ( !onlyHandlers && !special.noBubble && !isWindow( elem ) ) {

			bubbleType = special.delegateType || type;
			if ( !rfocusMorph.test( bubbleType + type ) ) {
				cur = cur.parentNode;
			}
			for ( ; cur; cur = cur.parentNode ) {
				eventPath.push( cur );
				tmp = cur;
			}

			// Only add window if we got to document (e.g., not plain obj or detached DOM)
			if ( tmp === ( elem.ownerDocument || document ) ) {
				eventPath.push( tmp.defaultView || tmp.parentWindow || window );
			}
		}

		// Fire handlers on the event path
		i = 0;
		while ( ( cur = eventPath[ i++ ] ) && !event.isPropagationStopped() ) {
			lastElement = cur;
			event.type = i > 1 ?
				bubbleType :
				special.bindType || type;

			// jQuery handler
			handle = (
					dataPriv.get( cur, "events" ) || Object.create( null )
				)[ event.type ] &&
				dataPriv.get( cur, "handle" );
			if ( handle ) {
				handle.apply( cur, data );
			}

			// Native handler
			handle = ontype && cur[ ontype ];
			if ( handle && handle.apply && acceptData( cur ) ) {
				event.result = handle.apply( cur, data );
				if ( event.result === false ) {
					event.preventDefault();
				}
			}
		}
		event.type = type;

		// If nobody prevented the default action, do it now
		if ( !onlyHandlers && !event.isDefaultPrevented() ) {

			if ( ( !special._default ||
				special._default.apply( eventPath.pop(), data ) === false ) &&
				acceptData( elem ) ) {

				// Call a native DOM method on the target with the same name as the event.
				// Don't do default actions on window, that's where global variables be (#6170)
				if ( ontype && isFunction( elem[ type ] ) && !isWindow( elem ) ) {

					// Don't re-trigger an onFOO event when we call its FOO() method
					tmp = elem[ ontype ];

					if ( tmp ) {
						elem[ ontype ] = null;
					}

					// Prevent re-triggering of the same event, since we already bubbled it above
					jQuery.event.triggered = type;

					if ( event.isPropagationStopped() ) {
						lastElement.addEventListener( type, stopPropagationCallback );
					}

					elem[ type ]();

					if ( event.isPropagationStopped() ) {
						lastElement.removeEventListener( type, stopPropagationCallback );
					}

					jQuery.event.triggered = undefined;

					if ( tmp ) {
						elem[ ontype ] = tmp;
					}
				}
			}
		}

		return event.result;
	},

	// Piggyback on a donor event to simulate a different one
	// Used only for `focus(in | out)` events
	simulate: function( type, elem, event ) {
		var e = jQuery.extend(
			new jQuery.Event(),
			event,
			{
				type: type,
				isSimulated: true
			}
		);

		jQuery.event.trigger( e, null, elem );
	}

} );

jQuery.fn.extend( {

	trigger: function( type, data ) {
		return this.each( function() {
			jQuery.event.trigger( type, data, this );
		} );
	},
	triggerHandler: function( type, data ) {
		var elem = this[ 0 ];
		if ( elem ) {
			return jQuery.event.trigger( type, data, elem, true );
		}
	}
} );


// Support: Firefox <=44
// Firefox doesn't have focus(in | out) events
// Related ticket - https://bugzilla.mozilla.org/show_bug.cgi?id=687787
//
// Support: Chrome <=48 - 49, Safari <=9.0 - 9.1
// focus(in | out) events fire after focus & blur events,
// which is spec violation - http://www.w3.org/TR/DOM-Level-3-Events/#events-focusevent-event-order
// Related ticket - https://bugs.chromium.org/p/chromium/issues/detail?id=449857
if ( !support.focusin ) {
	jQuery.each( { focus: "focusin", blur: "focusout" }, function( orig, fix ) {

		// Attach a single capturing handler on the document while someone wants focusin/focusout
		var handler = function( event ) {
			jQuery.event.simulate( fix, event.target, jQuery.event.fix( event ) );
		};

		jQuery.event.special[ fix ] = {
			setup: function() {

				// Handle: regular nodes (via `this.ownerDocument`), window
				// (via `this.document`) & document (via `this`).
				var doc = this.ownerDocument || this.document || this,
					attaches = dataPriv.access( doc, fix );

				if ( !attaches ) {
					doc.addEventListener( orig, handler, true );
				}
				dataPriv.access( doc, fix, ( attaches || 0 ) + 1 );
			},
			teardown: function() {
				var doc = this.ownerDocument || this.document || this,
					attaches = dataPriv.access( doc, fix ) - 1;

				if ( !attaches ) {
					doc.removeEventListener( orig, handler, true );
					dataPriv.remove( doc, fix );

				} else {
					dataPriv.access( doc, fix, attaches );
				}
			}
		};
	} );
}
var location = window.location;

var nonce = { guid: Date.now() };

var rquery = ( /\?/ );



// Cross-browser xml parsing
jQuery.parseXML = function( data ) {
	var xml;
	if ( !data || typeof data !== "string" ) {
		return null;
	}

	// Support: IE 9 - 11 only
	// IE throws on parseFromString with invalid input.
	try {
		xml = ( new window.DOMParser() ).parseFromString( data, "text/xml" );
	} catch ( e ) {
		xml = undefined;
	}

	if ( !xml || xml.getElementsByTagName( "parsererror" ).length ) {
		jQuery.error( "Invalid XML: " + data );
	}
	return xml;
};


var
	rbracket = /\[\]$/,
	rCRLF = /\r?\n/g,
	rsubmitterTypes = /^(?:submit|button|image|reset|file)$/i,
	rsubmittable = /^(?:input|select|textarea|keygen)/i;

function buildParams( prefix, obj, traditional, add ) {
	var name;

	if ( Array.isArray( obj ) ) {

		// Serialize array item.
		jQuery.each( obj, function( i, v ) {
			if ( traditional || rbracket.test( prefix ) ) {

				// Treat each array item as a scalar.
				add( prefix, v );

			} else {

				// Item is non-scalar (array or object), encode its numeric index.
				buildParams(
					prefix + "[" + ( typeof v === "object" && v != null ? i : "" ) + "]",
					v,
					traditional,
					add
				);
			}
		} );

	} else if ( !traditional && toType( obj ) === "object" ) {

		// Serialize object item.
		for ( name in obj ) {
			buildParams( prefix + "[" + name + "]", obj[ name ], traditional, add );
		}

	} else {

		// Serialize scalar item.
		add( prefix, obj );
	}
}

// Serialize an array of form elements or a set of
// key/values into a query string
jQuery.param = function( a, traditional ) {
	var prefix,
		s = [],
		add = function( key, valueOrFunction ) {

			// If value is a function, invoke it and use its return value
			var value = isFunction( valueOrFunction ) ?
				valueOrFunction() :
				valueOrFunction;

			s[ s.length ] = encodeURIComponent( key ) + "=" +
				encodeURIComponent( value == null ? "" : value );
		};

	if ( a == null ) {
		return "";
	}

	// If an array was passed in, assume that it is an array of form elements.
	if ( Array.isArray( a ) || ( a.jquery && !jQuery.isPlainObject( a ) ) ) {

		// Serialize the form elements
		jQuery.each( a, function() {
			add( this.name, this.value );
		} );

	} else {

		// If traditional, encode the "old" way (the way 1.3.2 or older
		// did it), otherwise encode params recursively.
		for ( prefix in a ) {
			buildParams( prefix, a[ prefix ], traditional, add );
		}
	}

	// Return the resulting serialization
	return s.join( "&" );
};

jQuery.fn.extend( {
	serialize: function() {
		return jQuery.param( this.serializeArray() );
	},
	serializeArray: function() {
		return this.map( function() {

			// Can add propHook for "elements" to filter or add form elements
			var elements = jQuery.prop( this, "elements" );
			return elements ? jQuery.makeArray( elements ) : this;
		} )
		.filter( function() {
			var type = this.type;

			// Use .is( ":disabled" ) so that fieldset[disabled] works
			return this.name && !jQuery( this ).is( ":disabled" ) &&
				rsubmittable.test( this.nodeName ) && !rsubmitterTypes.test( type ) &&
				( this.checked || !rcheckableType.test( type ) );
		} )
		.map( function( _i, elem ) {
			var val = jQuery( this ).val();

			if ( val == null ) {
				return null;
			}

			if ( Array.isArray( val ) ) {
				return jQuery.map( val, function( val ) {
					return { name: elem.name, value: val.replace( rCRLF, "\r\n" ) };
				} );
			}

			return { name: elem.name, value: val.replace( rCRLF, "\r\n" ) };
		} ).get();
	}
} );


var
	r20 = /%20/g,
	rhash = /#.*$/,
	rantiCache = /([?&])_=[^&]*/,
	rheaders = /^(.*?):[ \t]*([^\r\n]*)$/mg,

	// #7653, #8125, #8152: local protocol detection
	rlocalProtocol = /^(?:about|app|app-storage|.+-extension|file|res|widget):$/,
	rnoContent = /^(?:GET|HEAD)$/,
	rprotocol = /^\/\//,

	/* Prefilters
	 * 1) They are useful to introduce custom dataTypes (see ajax/jsonp.js for an example)
	 * 2) These are called:
	 *    - BEFORE asking for a transport
	 *    - AFTER param serialization (s.data is a string if s.processData is true)
	 * 3) key is the dataType
	 * 4) the catchall symbol "*" can be used
	 * 5) execution will start with transport dataType and THEN continue down to "*" if needed
	 */
	prefilters = {},

	/* Transports bindings
	 * 1) key is the dataType
	 * 2) the catchall symbol "*" can be used
	 * 3) selection will start with transport dataType and THEN go to "*" if needed
	 */
	transports = {},

	// Avoid comment-prolog char sequence (#10098); must appease lint and evade compression
	allTypes = "*/".concat( "*" ),

	// Anchor tag for parsing the document origin
	originAnchor = document.createElement( "a" );
	originAnchor.href = location.href;

// Base "constructor" for jQuery.ajaxPrefilter and jQuery.ajaxTransport
function addToPrefiltersOrTransports( structure ) {

	// dataTypeExpression is optional and defaults to "*"
	return function( dataTypeExpression, func ) {

		if ( typeof dataTypeExpression !== "string" ) {
			func = dataTypeExpression;
			dataTypeExpression = "*";
		}

		var dataType,
			i = 0,
			dataTypes = dataTypeExpression.toLowerCase().match( rnothtmlwhite ) || [];

		if ( isFunction( func ) ) {

			// For each dataType in the dataTypeExpression
			while ( ( dataType = dataTypes[ i++ ] ) ) {

				// Prepend if requested
				if ( dataType[ 0 ] === "+" ) {
					dataType = dataType.slice( 1 ) || "*";
					( structure[ dataType ] = structure[ dataType ] || [] ).unshift( func );

				// Otherwise append
				} else {
					( structure[ dataType ] = structure[ dataType ] || [] ).push( func );
				}
			}
		}
	};
}

// Base inspection function for prefilters and transports
function inspectPrefiltersOrTransports( structure, options, originalOptions, jqXHR ) {

	var inspected = {},
		seekingTransport = ( structure === transports );

	function inspect( dataType ) {
		var selected;
		inspected[ dataType ] = true;
		jQuery.each( structure[ dataType ] || [], function( _, prefilterOrFactory ) {
			var dataTypeOrTransport = prefilterOrFactory( options, originalOptions, jqXHR );
			if ( typeof dataTypeOrTransport === "string" &&
				!seekingTransport && !inspected[ dataTypeOrTransport ] ) {

				options.dataTypes.unshift( dataTypeOrTransport );
				inspect( dataTypeOrTransport );
				return false;
			} else if ( seekingTransport ) {
				return !( selected = dataTypeOrTransport );
			}
		} );
		return selected;
	}

	return inspect( options.dataTypes[ 0 ] ) || !inspected[ "*" ] && inspect( "*" );
}

// A special extend for ajax options
// that takes "flat" options (not to be deep extended)
// Fixes #9887
function ajaxExtend( target, src ) {
	var key, deep,
		flatOptions = jQuery.ajaxSettings.flatOptions || {};

	for ( key in src ) {
		if ( src[ key ] !== undefined ) {
			( flatOptions[ key ] ? target : ( deep || ( deep = {} ) ) )[ key ] = src[ key ];
		}
	}
	if ( deep ) {
		jQuery.extend( true, target, deep );
	}

	return target;
}

/* Handles responses to an ajax request:
 * - finds the right dataType (mediates between content-type and expected dataType)
 * - returns the corresponding response
 */
function ajaxHandleResponses( s, jqXHR, responses ) {

	var ct, type, finalDataType, firstDataType,
		contents = s.contents,
		dataTypes = s.dataTypes;

	// Remove auto dataType and get content-type in the process
	while ( dataTypes[ 0 ] === "*" ) {
		dataTypes.shift();
		if ( ct === undefined ) {
			ct = s.mimeType || jqXHR.getResponseHeader( "Content-Type" );
		}
	}

	// Check if we're dealing with a known content-type
	if ( ct ) {
		for ( type in contents ) {
			if ( contents[ type ] && contents[ type ].test( ct ) ) {
				dataTypes.unshift( type );
				break;
			}
		}
	}

	// Check to see if we have a response for the expected dataType
	if ( dataTypes[ 0 ] in responses ) {
		finalDataType = dataTypes[ 0 ];
	} else {

		// Try convertible dataTypes
		for ( type in responses ) {
			if ( !dataTypes[ 0 ] || s.converters[ type + " " + dataTypes[ 0 ] ] ) {
				finalDataType = type;
				break;
			}
			if ( !firstDataType ) {
				firstDataType = type;
			}
		}

		// Or just use first one
		finalDataType = finalDataType || firstDataType;
	}

	// If we found a dataType
	// We add the dataType to the list if needed
	// and return the corresponding response
	if ( finalDataType ) {
		if ( finalDataType !== dataTypes[ 0 ] ) {
			dataTypes.unshift( finalDataType );
		}
		return responses[ finalDataType ];
	}
}

/* Chain conversions given the request and the original response
 * Also sets the responseXXX fields on the jqXHR instance
 */
function ajaxConvert( s, response, jqXHR, isSuccess ) {
	var conv2, current, conv, tmp, prev,
		converters = {},

		// Work with a copy of dataTypes in case we need to modify it for conversion
		dataTypes = s.dataTypes.slice();

	// Create converters map with lowercased keys
	if ( dataTypes[ 1 ] ) {
		for ( conv in s.converters ) {
			converters[ conv.toLowerCase() ] = s.converters[ conv ];
		}
	}

	current = dataTypes.shift();

	// Convert to each sequential dataType
	while ( current ) {

		if ( s.responseFields[ current ] ) {
			jqXHR[ s.responseFields[ current ] ] = response;
		}

		// Apply the dataFilter if provided
		if ( !prev && isSuccess && s.dataFilter ) {
			response = s.dataFilter( response, s.dataType );
		}

		prev = current;
		current = dataTypes.shift();

		if ( current ) {

			// There's only work to do if current dataType is non-auto
			if ( current === "*" ) {

				current = prev;

			// Convert response if prev dataType is non-auto and differs from current
			} else if ( prev !== "*" && prev !== current ) {

				// Seek a direct converter
				conv = converters[ prev + " " + current ] || converters[ "* " + current ];

				// If none found, seek a pair
				if ( !conv ) {
					for ( conv2 in converters ) {

						// If conv2 outputs current
						tmp = conv2.split( " " );
						if ( tmp[ 1 ] === current ) {

							// If prev can be converted to accepted input
							conv = converters[ prev + " " + tmp[ 0 ] ] ||
								converters[ "* " + tmp[ 0 ] ];
							if ( conv ) {

								// Condense equivalence converters
								if ( conv === true ) {
									conv = converters[ conv2 ];

								// Otherwise, insert the intermediate dataType
								} else if ( converters[ conv2 ] !== true ) {
									current = tmp[ 0 ];
									dataTypes.unshift( tmp[ 1 ] );
								}
								break;
							}
						}
					}
				}

				// Apply converter (if not an equivalence)
				if ( conv !== true ) {

					// Unless errors are allowed to bubble, catch and return them
					if ( conv && s.throws ) {
						response = conv( response );
					} else {
						try {
							response = conv( response );
						} catch ( e ) {
							return {
								state: "parsererror",
								error: conv ? e : "No conversion from " + prev + " to " + current
							};
						}
					}
				}
			}
		}
	}

	return { state: "success", data: response };
}

jQuery.extend( {

	// Counter for holding the number of active queries
	active: 0,

	// Last-Modified header cache for next request
	lastModified: {},
	etag: {},

	ajaxSettings: {
		url: location.href,
		type: "GET",
		isLocal: rlocalProtocol.test( location.protocol ),
		global: true,
		processData: true,
		async: true,
		contentType: "application/x-www-form-urlencoded; charset=UTF-8",

		/*
		timeout: 0,
		data: null,
		dataType: null,
		username: null,
		password: null,
		cache: null,
		throws: false,
		traditional: false,
		headers: {},
		*/

		accepts: {
			"*": allTypes,
			text: "text/plain",
			html: "text/html",
			xml: "application/xml, text/xml",
			json: "application/json, text/javascript"
		},

		contents: {
			xml: /\bxml\b/,
			html: /\bhtml/,
			json: /\bjson\b/
		},

		responseFields: {
			xml: "responseXML",
			text: "responseText",
			json: "responseJSON"
		},

		// Data converters
		// Keys separate source (or catchall "*") and destination types with a single space
		converters: {

			// Convert anything to text
			"* text": String,

			// Text to html (true = no transformation)
			"text html": true,

			// Evaluate text as a json expression
			"text json": JSON.parse,

			// Parse text as xml
			"text xml": jQuery.parseXML
		},

		// For options that shouldn't be deep extended:
		// you can add your own custom options here if
		// and when you create one that shouldn't be
		// deep extended (see ajaxExtend)
		flatOptions: {
			url: true,
			context: true
		}
	},

	// Creates a full fledged settings object into target
	// with both ajaxSettings and settings fields.
	// If target is omitted, writes into ajaxSettings.
	ajaxSetup: function( target, settings ) {
		return settings ?

			// Building a settings object
			ajaxExtend( ajaxExtend( target, jQuery.ajaxSettings ), settings ) :

			// Extending ajaxSettings
			ajaxExtend( jQuery.ajaxSettings, target );
	},

	ajaxPrefilter: addToPrefiltersOrTransports( prefilters ),
	ajaxTransport: addToPrefiltersOrTransports( transports ),

	// Main method
	ajax: function( url, options ) {

		// If url is an object, simulate pre-1.5 signature
		if ( typeof url === "object" ) {
			options = url;
			url = undefined;
		}

		// Force options to be an object
		options = options || {};

		var transport,

			// URL without anti-cache param
			cacheURL,

			// Response headers
			responseHeadersString,
			responseHeaders,

			// timeout handle
			timeoutTimer,

			// Url cleanup var
			urlAnchor,

			// Request state (becomes false upon send and true upon completion)
			completed,

			// To know if global events are to be dispatched
			fireGlobals,

			// Loop variable
			i,

			// uncached part of the url
			uncached,

			// Create the final options object
			s = jQuery.ajaxSetup( {}, options ),

			// Callbacks context
			callbackContext = s.context || s,

			// Context for global events is callbackContext if it is a DOM node or jQuery collection
			globalEventContext = s.context &&
				( callbackContext.nodeType || callbackContext.jquery ) ?
					jQuery( callbackContext ) :
					jQuery.event,

			// Deferreds
			deferred = jQuery.Deferred(),
			completeDeferred = jQuery.Callbacks( "once memory" ),

			// Status-dependent callbacks
			statusCode = s.statusCode || {},

			// Headers (they are sent all at once)
			requestHeaders = {},
			requestHeadersNames = {},

			// Default abort message
			strAbort = "canceled",

			// Fake xhr
			jqXHR = {
				readyState: 0,

				// Builds headers hashtable if needed
				getResponseHeader: function( key ) {
					var match;
					if ( completed ) {
						if ( !responseHeaders ) {
							responseHeaders = {};
							while ( ( match = rheaders.exec( responseHeadersString ) ) ) {
								responseHeaders[ match[ 1 ].toLowerCase() + " " ] =
									( responseHeaders[ match[ 1 ].toLowerCase() + " " ] || [] )
										.concat( match[ 2 ] );
							}
						}
						match = responseHeaders[ key.toLowerCase() + " " ];
					}
					return match == null ? null : match.join( ", " );
				},

				// Raw string
				getAllResponseHeaders: function() {
					return completed ? responseHeadersString : null;
				},

				// Caches the header
				setRequestHeader: function( name, value ) {
					if ( completed == null ) {
						name = requestHeadersNames[ name.toLowerCase() ] =
							requestHeadersNames[ name.toLowerCase() ] || name;
						requestHeaders[ name ] = value;
					}
					return this;
				},

				// Overrides response content-type header
				overrideMimeType: function( type ) {
					if ( completed == null ) {
						s.mimeType = type;
					}
					return this;
				},

				// Status-dependent callbacks
				statusCode: function( map ) {
					var code;
					if ( map ) {
						if ( completed ) {

							// Execute the appropriate callbacks
							jqXHR.always( map[ jqXHR.status ] );
						} else {

							// Lazy-add the new callbacks in a way that preserves old ones
							for ( code in map ) {
								statusCode[ code ] = [ statusCode[ code ], map[ code ] ];
							}
						}
					}
					return this;
				},

				// Cancel the request
				abort: function( statusText ) {
					var finalText = statusText || strAbort;
					if ( transport ) {
						transport.abort( finalText );
					}
					done( 0, finalText );
					return this;
				}
			};

		// Attach deferreds
		deferred.promise( jqXHR );

		// Add protocol if not provided (prefilters might expect it)
		// Handle falsy url in the settings object (#10093: consistency with old signature)
		// We also use the url parameter if available
		s.url = ( ( url || s.url || location.href ) + "" )
			.replace( rprotocol, location.protocol + "//" );

		// Alias method option to type as per ticket #12004
		s.type = options.method || options.type || s.method || s.type;

		// Extract dataTypes list
		s.dataTypes = ( s.dataType || "*" ).toLowerCase().match( rnothtmlwhite ) || [ "" ];

		// A cross-domain request is in order when the origin doesn't match the current origin.
		if ( s.crossDomain == null ) {
			urlAnchor = document.createElement( "a" );

			// Support: IE <=8 - 11, Edge 12 - 15
			// IE throws exception on accessing the href property if url is malformed,
			// e.g. http://example.com:80x/
			try {
				urlAnchor.href = s.url;

				// Support: IE <=8 - 11 only
				// Anchor's host property isn't correctly set when s.url is relative
				urlAnchor.href = urlAnchor.href;
				s.crossDomain = originAnchor.protocol + "//" + originAnchor.host !==
					urlAnchor.protocol + "//" + urlAnchor.host;
			} catch ( e ) {

				// If there is an error parsing the URL, assume it is crossDomain,
				// it can be rejected by the transport if it is invalid
				s.crossDomain = true;
			}
		}

		// Convert data if not already a string
		if ( s.data && s.processData && typeof s.data !== "string" ) {
			s.data = jQuery.param( s.data, s.traditional );
		}

		// Apply prefilters
		inspectPrefiltersOrTransports( prefilters, s, options, jqXHR );

		// If request was aborted inside a prefilter, stop there
		if ( completed ) {
			return jqXHR;
		}

		// We can fire global events as of now if asked to
		// Don't fire events if jQuery.event is undefined in an AMD-usage scenario (#15118)
		fireGlobals = jQuery.event && s.global;

		// Watch for a new set of requests
		if ( fireGlobals && jQuery.active++ === 0 ) {
			jQuery.event.trigger( "ajaxStart" );
		}

		// Uppercase the type
		s.type = s.type.toUpperCase();

		// Determine if request has content
		s.hasContent = !rnoContent.test( s.type );

		// Save the URL in case we're toying with the If-Modified-Since
		// and/or If-None-Match header later on
		// Remove hash to simplify url manipulation
		cacheURL = s.url.replace( rhash, "" );

		// More options handling for requests with no content
		if ( !s.hasContent ) {

			// Remember the hash so we can put it back
			uncached = s.url.slice( cacheURL.length );

			// If data is available and should be processed, append data to url
			if ( s.data && ( s.processData || typeof s.data === "string" ) ) {
				cacheURL += ( rquery.test( cacheURL ) ? "&" : "?" ) + s.data;

				// #9682: remove data so that it's not used in an eventual retry
				delete s.data;
			}

			// Add or update anti-cache param if needed
			if ( s.cache === false ) {
				cacheURL = cacheURL.replace( rantiCache, "$1" );
				uncached = ( rquery.test( cacheURL ) ? "&" : "?" ) + "_=" + ( nonce.guid++ ) +
					uncached;
			}

			// Put hash and anti-cache on the URL that will be requested (gh-1732)
			s.url = cacheURL + uncached;

		// Change '%20' to '+' if this is encoded form body content (gh-2658)
		} else if ( s.data && s.processData &&
			( s.contentType || "" ).indexOf( "application/x-www-form-urlencoded" ) === 0 ) {
			s.data = s.data.replace( r20, "+" );
		}

		// Set the If-Modified-Since and/or If-None-Match header, if in ifModified mode.
		if ( s.ifModified ) {
			if ( jQuery.lastModified[ cacheURL ] ) {
				jqXHR.setRequestHeader( "If-Modified-Since", jQuery.lastModified[ cacheURL ] );
			}
			if ( jQuery.etag[ cacheURL ] ) {
				jqXHR.setRequestHeader( "If-None-Match", jQuery.etag[ cacheURL ] );
			}
		}

		// Set the correct header, if data is being sent
		if ( s.data && s.hasContent && s.contentType !== false || options.contentType ) {
			jqXHR.setRequestHeader( "Content-Type", s.contentType );
		}

		// Set the Accepts header for the server, depending on the dataType
		jqXHR.setRequestHeader(
			"Accept",
			s.dataTypes[ 0 ] && s.accepts[ s.dataTypes[ 0 ] ] ?
				s.accepts[ s.dataTypes[ 0 ] ] +
					( s.dataTypes[ 0 ] !== "*" ? ", " + allTypes + "; q=0.01" : "" ) :
				s.accepts[ "*" ]
		);

		// Check for headers option
		for ( i in s.headers ) {
			jqXHR.setRequestHeader( i, s.headers[ i ] );
		}

		// Allow custom headers/mimetypes and early abort
		if ( s.beforeSend &&
			( s.beforeSend.call( callbackContext, jqXHR, s ) === false || completed ) ) {

			// Abort if not done already and return
			return jqXHR.abort();
		}

		// Aborting is no longer a cancellation
		strAbort = "abort";

		// Install callbacks on deferreds
		completeDeferred.add( s.complete );
		jqXHR.done( s.success );
		jqXHR.fail( s.error );

		// Get transport
		transport = inspectPrefiltersOrTransports( transports, s, options, jqXHR );

		// If no transport, we auto-abort
		if ( !transport ) {
			done( -1, "No Transport" );
		} else {
			jqXHR.readyState = 1;

			// Send global event
			if ( fireGlobals ) {
				globalEventContext.trigger( "ajaxSend", [ jqXHR, s ] );
			}

			// If request was aborted inside ajaxSend, stop there
			if ( completed ) {
				return jqXHR;
			}

			// Timeout
			if ( s.async && s.timeout > 0 ) {
				timeoutTimer = window.setTimeout( function() {
					jqXHR.abort( "timeout" );
				}, s.timeout );
			}

			try {
				completed = false;
				transport.send( requestHeaders, done );
			} catch ( e ) {

				// Rethrow post-completion exceptions
				if ( completed ) {
					throw e;
				}

				// Propagate others as results
				done( -1, e );
			}
		}

		// Callback for when everything is done
		function done( status, nativeStatusText, responses, headers ) {
			var isSuccess, success, error, response, modified,
				statusText = nativeStatusText;

			// Ignore repeat invocations
			if ( completed ) {
				return;
			}

			completed = true;

			// Clear timeout if it exists
			if ( timeoutTimer ) {
				window.clearTimeout( timeoutTimer );
			}

			// Dereference transport for early garbage collection
			// (no matter how long the jqXHR object will be used)
			transport = undefined;

			// Cache response headers
			responseHeadersString = headers || "";

			// Set readyState
			jqXHR.readyState = status > 0 ? 4 : 0;

			// Determine if successful
			isSuccess = status >= 200 && status < 300 || status === 304;

			// Get response data
			if ( responses ) {
				response = ajaxHandleResponses( s, jqXHR, responses );
			}

			// Use a noop converter for missing script
			if ( !isSuccess && jQuery.inArray( "script", s.dataTypes ) > -1 ) {
				s.converters[ "text script" ] = function() {};
			}

			// Convert no matter what (that way responseXXX fields are always set)
			response = ajaxConvert( s, response, jqXHR, isSuccess );

			// If successful, handle type chaining
			if ( isSuccess ) {

				// Set the If-Modified-Since and/or If-None-Match header, if in ifModified mode.
				if ( s.ifModified ) {
					modified = jqXHR.getResponseHeader( "Last-Modified" );
					if ( modified ) {
						jQuery.lastModified[ cacheURL ] = modified;
					}
					modified = jqXHR.getResponseHeader( "etag" );
					if ( modified ) {
						jQuery.etag[ cacheURL ] = modified;
					}
				}

				// if no content
				if ( status === 204 || s.type === "HEAD" ) {
					statusText = "nocontent";

				// if not modified
				} else if ( status === 304 ) {
					statusText = "notmodified";

				// If we have data, let's convert it
				} else {
					statusText = response.state;
					success = response.data;
					error = response.error;
					isSuccess = !error;
				}
			} else {

				// Extract error from statusText and normalize for non-aborts
				error = statusText;
				if ( status || !statusText ) {
					statusText = "error";
					if ( status < 0 ) {
						status = 0;
					}
				}
			}

			// Set data for the fake xhr object
			jqXHR.status = status;
			jqXHR.statusText = ( nativeStatusText || statusText ) + "";

			// Success/Error
			if ( isSuccess ) {
				deferred.resolveWith( callbackContext, [ success, statusText, jqXHR ] );
			} else {
				deferred.rejectWith( callbackContext, [ jqXHR, statusText, error ] );
			}

			// Status-dependent callbacks
			jqXHR.statusCode( statusCode );
			statusCode = undefined;

			if ( fireGlobals ) {
				globalEventContext.trigger( isSuccess ? "ajaxSuccess" : "ajaxError",
					[ jqXHR, s, isSuccess ? success : error ] );
			}

			// Complete
			completeDeferred.fireWith( callbackContext, [ jqXHR, statusText ] );

			if ( fireGlobals ) {
				globalEventContext.trigger( "ajaxComplete", [ jqXHR, s ] );

				// Handle the global AJAX counter
				if ( !( --jQuery.active ) ) {
					jQuery.event.trigger( "ajaxStop" );
				}
			}
		}

		return jqXHR;
	},

	getJSON: function( url, data, callback ) {
		return jQuery.get( url, data, callback, "json" );
	},

	getScript: function( url, callback ) {
		return jQuery.get( url, undefined, callback, "script" );
	}
} );

jQuery.each( [ "get", "post" ], function( _i, method ) {
	jQuery[ method ] = function( url, data, callback, type ) {

		// Shift arguments if data argument was omitted
		if ( isFunction( data ) ) {
			type = type || callback;
			callback = data;
			data = undefined;
		}

		// The url can be an options object (which then must have .url)
		return jQuery.ajax( jQuery.extend( {
			url: url,
			type: method,
			dataType: type,
			data: data,
			success: callback
		}, jQuery.isPlainObject( url ) && url ) );
	};
} );

jQuery.ajaxPrefilter( function( s ) {
	var i;
	for ( i in s.headers ) {
		if ( i.toLowerCase() === "content-type" ) {
			s.contentType = s.headers[ i ] || "";
		}
	}
} );


jQuery._evalUrl = function( url, options, doc ) {
	return jQuery.ajax( {
		url: url,

		// Make this explicit, since user can override this through ajaxSetup (#11264)
		type: "GET",
		dataType: "script",
		cache: true,
		async: false,
		global: false,

		// Only evaluate the response if it is successful (gh-4126)
		// dataFilter is not invoked for failure responses, so using it instead
		// of the default converter is kludgy but it works.
		converters: {
			"text script": function() {}
		},
		dataFilter: function( response ) {
			jQuery.globalEval( response, options, doc );
		}
	} );
};


jQuery.fn.extend( {
	wrapAll: function( html ) {
		var wrap;

		if ( this[ 0 ] ) {
			if ( isFunction( html ) ) {
				html = html.call( this[ 0 ] );
			}

			// The elements to wrap the target around
			wrap = jQuery( html, this[ 0 ].ownerDocument ).eq( 0 ).clone( true );

			if ( this[ 0 ].parentNode ) {
				wrap.insertBefore( this[ 0 ] );
			}

			wrap.map( function() {
				var elem = this;

				while ( elem.firstElementChild ) {
					elem = elem.firstElementChild;
				}

				return elem;
			} ).append( this );
		}

		return this;
	},

	wrapInner: function( html ) {
		if ( isFunction( html ) ) {
			return this.each( function( i ) {
				jQuery( this ).wrapInner( html.call( this, i ) );
			} );
		}

		return this.each( function() {
			var self = jQuery( this ),
				contents = self.contents();

			if ( contents.length ) {
				contents.wrapAll( html );

			} else {
				self.append( html );
			}
		} );
	},

	wrap: function( html ) {
		var htmlIsFunction = isFunction( html );

		return this.each( function( i ) {
			jQuery( this ).wrapAll( htmlIsFunction ? html.call( this, i ) : html );
		} );
	},

	unwrap: function( selector ) {
		this.parent( selector ).not( "body" ).each( function() {
			jQuery( this ).replaceWith( this.childNodes );
		} );
		return this;
	}
} );


jQuery.expr.pseudos.hidden = function( elem ) {
	return !jQuery.expr.pseudos.visible( elem );
};
jQuery.expr.pseudos.visible = function( elem ) {
	return !!( elem.offsetWidth || elem.offsetHeight || elem.getClientRects().length );
};




jQuery.ajaxSettings.xhr = function() {
	try {
		return new window.XMLHttpRequest();
	} catch ( e ) {}
};

var xhrSuccessStatus = {

		// File protocol always yields status code 0, assume 200
		0: 200,

		// Support: IE <=9 only
		// #1450: sometimes IE returns 1223 when it should be 204
		1223: 204
	},
	xhrSupported = jQuery.ajaxSettings.xhr();

support.cors = !!xhrSupported && ( "withCredentials" in xhrSupported );
support.ajax = xhrSupported = !!xhrSupported;

jQuery.ajaxTransport( function( options ) {
	var callback, errorCallback;

	// Cross domain only allowed if supported through XMLHttpRequest
	if ( support.cors || xhrSupported && !options.crossDomain ) {
		return {
			send: function( headers, complete ) {
				var i,
					xhr = options.xhr();

				xhr.open(
					options.type,
					options.url,
					options.async,
					options.username,
					options.password
				);

				// Apply custom fields if provided
				if ( options.xhrFields ) {
					for ( i in options.xhrFields ) {
						xhr[ i ] = options.xhrFields[ i ];
					}
				}

				// Override mime type if needed
				if ( options.mimeType && xhr.overrideMimeType ) {
					xhr.overrideMimeType( options.mimeType );
				}

				// X-Requested-With header
				// For cross-domain requests, seeing as conditions for a preflight are
				// akin to a jigsaw puzzle, we simply never set it to be sure.
				// (it can always be set on a per-request basis or even using ajaxSetup)
				// For same-domain requests, won't change header if already provided.
				if ( !options.crossDomain && !headers[ "X-Requested-With" ] ) {
					headers[ "X-Requested-With" ] = "XMLHttpRequest";
				}

				// Set headers
				for ( i in headers ) {
					xhr.setRequestHeader( i, headers[ i ] );
				}

				// Callback
				callback = function( type ) {
					return function() {
						if ( callback ) {
							callback = errorCallback = xhr.onload =
								xhr.onerror = xhr.onabort = xhr.ontimeout =
									xhr.onreadystatechange = null;

							if ( type === "abort" ) {
								xhr.abort();
							} else if ( type === "error" ) {

								// Support: IE <=9 only
								// On a manual native abort, IE9 throws
								// errors on any property access that is not readyState
								if ( typeof xhr.status !== "number" ) {
									complete( 0, "error" );
								} else {
									complete(

										// File: protocol always yields status 0; see #8605, #14207
										xhr.status,
										xhr.statusText
									);
								}
							} else {
								complete(
									xhrSuccessStatus[ xhr.status ] || xhr.status,
									xhr.statusText,

									// Support: IE <=9 only
									// IE9 has no XHR2 but throws on binary (trac-11426)
									// For XHR2 non-text, let the caller handle it (gh-2498)
									( xhr.responseType || "text" ) !== "text"  ||
									typeof xhr.responseText !== "string" ?
										{ binary: xhr.response } :
										{ text: xhr.responseText },
									xhr.getAllResponseHeaders()
								);
							}
						}
					};
				};

				// Listen to events
				xhr.onload = callback();
				errorCallback = xhr.onerror = xhr.ontimeout = callback( "error" );

				// Support: IE 9 only
				// Use onreadystatechange to replace onabort
				// to handle uncaught aborts
				if ( xhr.onabort !== undefined ) {
					xhr.onabort = errorCallback;
				} else {
					xhr.onreadystatechange = function() {

						// Check readyState before timeout as it changes
						if ( xhr.readyState === 4 ) {

							// Allow onerror to be called first,
							// but that will not handle a native abort
							// Also, save errorCallback to a variable
							// as xhr.onerror cannot be accessed
							window.setTimeout( function() {
								if ( callback ) {
									errorCallback();
								}
							} );
						}
					};
				}

				// Create the abort callback
				callback = callback( "abort" );

				try {

					// Do send the request (this may raise an exception)
					xhr.send( options.hasContent && options.data || null );
				} catch ( e ) {

					// #14683: Only rethrow if this hasn't been notified as an error yet
					if ( callback ) {
						throw e;
					}
				}
			},

			abort: function() {
				if ( callback ) {
					callback();
				}
			}
		};
	}
} );




// Prevent auto-execution of scripts when no explicit dataType was provided (See gh-2432)
jQuery.ajaxPrefilter( function( s ) {
	if ( s.crossDomain ) {
		s.contents.script = false;
	}
} );

// Install script dataType
jQuery.ajaxSetup( {
	accepts: {
		script: "text/javascript, application/javascript, " +
			"application/ecmascript, application/x-ecmascript"
	},
	contents: {
		script: /\b(?:java|ecma)script\b/
	},
	converters: {
		"text script": function( text ) {
			jQuery.globalEval( text );
			return text;
		}
	}
} );

// Handle cache's special case and crossDomain
jQuery.ajaxPrefilter( "script", function( s ) {
	if ( s.cache === undefined ) {
		s.cache = false;
	}
	if ( s.crossDomain ) {
		s.type = "GET";
	}
} );

// Bind script tag hack transport
jQuery.ajaxTransport( "script", function( s ) {

	// This transport only deals with cross domain or forced-by-attrs requests
	if ( s.crossDomain || s.scriptAttrs ) {
		var script, callback;
		return {
			send: function( _, complete ) {
				script = jQuery( "<script>" )
					.attr( s.scriptAttrs || {} )
					.prop( { charset: s.scriptCharset, src: s.url } )
					.on( "load error", callback = function( evt ) {
						script.remove();
						callback = null;
						if ( evt ) {
							complete( evt.type === "error" ? 404 : 200, evt.type );
						}
					} );

				// Use native DOM manipulation to avoid our domManip AJAX trickery
				document.head.appendChild( script[ 0 ] );
			},
			abort: function() {
				if ( callback ) {
					callback();
				}
			}
		};
	}
} );




var oldCallbacks = [],
	rjsonp = /(=)\?(?=&|$)|\?\?/;

// Default jsonp settings
jQuery.ajaxSetup( {
	jsonp: "callback",
	jsonpCallback: function() {
		var callback = oldCallbacks.pop() || ( jQuery.expando + "_" + ( nonce.guid++ ) );
		this[ callback ] = true;
		return callback;
	}
} );

// Detect, normalize options and install callbacks for jsonp requests
jQuery.ajaxPrefilter( "json jsonp", function( s, originalSettings, jqXHR ) {

	var callbackName, overwritten, responseContainer,
		jsonProp = s.jsonp !== false && ( rjsonp.test( s.url ) ?
			"url" :
			typeof s.data === "string" &&
				( s.contentType || "" )
					.indexOf( "application/x-www-form-urlencoded" ) === 0 &&
				rjsonp.test( s.data ) && "data"
		);

	// Handle iff the expected data type is "jsonp" or we have a parameter to set
	if ( jsonProp || s.dataTypes[ 0 ] === "jsonp" ) {

		// Get callback name, remembering preexisting value associated with it
		callbackName = s.jsonpCallback = isFunction( s.jsonpCallback ) ?
			s.jsonpCallback() :
			s.jsonpCallback;

		// Insert callback into url or form data
		if ( jsonProp ) {
			s[ jsonProp ] = s[ jsonProp ].replace( rjsonp, "$1" + callbackName );
		} else if ( s.jsonp !== false ) {
			s.url += ( rquery.test( s.url ) ? "&" : "?" ) + s.jsonp + "=" + callbackName;
		}

		// Use data converter to retrieve json after script execution
		s.converters[ "script json" ] = function() {
			if ( !responseContainer ) {
				jQuery.error( callbackName + " was not called" );
			}
			return responseContainer[ 0 ];
		};

		// Force json dataType
		s.dataTypes[ 0 ] = "json";

		// Install callback
		overwritten = window[ callbackName ];
		window[ callbackName ] = function() {
			responseContainer = arguments;
		};

		// Clean-up function (fires after converters)
		jqXHR.always( function() {

			// If previous value didn't exist - remove it
			if ( overwritten === undefined ) {
				jQuery( window ).removeProp( callbackName );

			// Otherwise restore preexisting value
			} else {
				window[ callbackName ] = overwritten;
			}

			// Save back as free
			if ( s[ callbackName ] ) {

				// Make sure that re-using the options doesn't screw things around
				s.jsonpCallback = originalSettings.jsonpCallback;

				// Save the callback name for future use
				oldCallbacks.push( callbackName );
			}

			// Call if it was a function and we have a response
			if ( responseContainer && isFunction( overwritten ) ) {
				overwritten( responseContainer[ 0 ] );
			}

			responseContainer = overwritten = undefined;
		} );

		// Delegate to script
		return "script";
	}
} );




// Support: Safari 8 only
// In Safari 8 documents created via document.implementation.createHTMLDocument
// collapse sibling forms: the second one becomes a child of the first one.
// Because of that, this security measure has to be disabled in Safari 8.
// https://bugs.webkit.org/show_bug.cgi?id=137337
support.createHTMLDocument = ( function() {
	var body = document.implementation.createHTMLDocument( "" ).body;
	body.innerHTML = "<form></form><form></form>";
	return body.childNodes.length === 2;
} )();


// Argument "data" should be string of html
// context (optional): If specified, the fragment will be created in this context,
// defaults to document
// keepScripts (optional): If true, will include scripts passed in the html string
jQuery.parseHTML = function( data, context, keepScripts ) {
	if ( typeof data !== "string" ) {
		return [];
	}
	if ( typeof context === "boolean" ) {
		keepScripts = context;
		context = false;
	}

	var base, parsed, scripts;

	if ( !context ) {

		// Stop scripts or inline event handlers from being executed immediately
		// by using document.implementation
		if ( support.createHTMLDocument ) {
			context = document.implementation.createHTMLDocument( "" );

			// Set the base href for the created document
			// so any parsed elements with URLs
			// are based on the document's URL (gh-2965)
			base = context.createElement( "base" );
			base.href = document.location.href;
			context.head.appendChild( base );
		} else {
			context = document;
		}
	}

	parsed = rsingleTag.exec( data );
	scripts = !keepScripts && [];

	// Single tag
	if ( parsed ) {
		return [ context.createElement( parsed[ 1 ] ) ];
	}

	parsed = buildFragment( [ data ], context, scripts );

	if ( scripts && scripts.length ) {
		jQuery( scripts ).remove();
	}

	return jQuery.merge( [], parsed.childNodes );
};


/**
 * Load a url into a page
 */
jQuery.fn.load = function( url, params, callback ) {
	var selector, type, response,
		self = this,
		off = url.indexOf( " " );

	if ( off > -1 ) {
		selector = stripAndCollapse( url.slice( off ) );
		url = url.slice( 0, off );
	}

	// If it's a function
	if ( isFunction( params ) ) {

		// We assume that it's the callback
		callback = params;
		params = undefined;

	// Otherwise, build a param string
	} else if ( params && typeof params === "object" ) {
		type = "POST";
	}

	// If we have elements to modify, make the request
	if ( self.length > 0 ) {
		jQuery.ajax( {
			url: url,

			// If "type" variable is undefined, then "GET" method will be used.
			// Make value of this field explicit since
			// user can override it through ajaxSetup method
			type: type || "GET",
			dataType: "html",
			data: params
		} ).done( function( responseText ) {

			// Save response for use in complete callback
			response = arguments;

			self.html( selector ?

				// If a selector was specified, locate the right elements in a dummy div
				// Exclude scripts to avoid IE 'Permission Denied' errors
				jQuery( "<div>" ).append( jQuery.parseHTML( responseText ) ).find( selector ) :

				// Otherwise use the full result
				responseText );

		// If the request succeeds, this function gets "data", "status", "jqXHR"
		// but they are ignored because response was set above.
		// If it fails, this function gets "jqXHR", "status", "error"
		} ).always( callback && function( jqXHR, status ) {
			self.each( function() {
				callback.apply( this, response || [ jqXHR.responseText, status, jqXHR ] );
			} );
		} );
	}

	return this;
};




jQuery.expr.pseudos.animated = function( elem ) {
	return jQuery.grep( jQuery.timers, function( fn ) {
		return elem === fn.elem;
	} ).length;
};




jQuery.offset = {
	setOffset: function( elem, options, i ) {
		var curPosition, curLeft, curCSSTop, curTop, curOffset, curCSSLeft, calculatePosition,
			position = jQuery.css( elem, "position" ),
			curElem = jQuery( elem ),
			props = {};

		// Set position first, in-case top/left are set even on static elem
		if ( position === "static" ) {
			elem.style.position = "relative";
		}

		curOffset = curElem.offset();
		curCSSTop = jQuery.css( elem, "top" );
		curCSSLeft = jQuery.css( elem, "left" );
		calculatePosition = ( position === "absolute" || position === "fixed" ) &&
			( curCSSTop + curCSSLeft ).indexOf( "auto" ) > -1;

		// Need to be able to calculate position if either
		// top or left is auto and position is either absolute or fixed
		if ( calculatePosition ) {
			curPosition = curElem.position();
			curTop = curPosition.top;
			curLeft = curPosition.left;

		} else {
			curTop = parseFloat( curCSSTop ) || 0;
			curLeft = parseFloat( curCSSLeft ) || 0;
		}

		if ( isFunction( options ) ) {

			// Use jQuery.extend here to allow modification of coordinates argument (gh-1848)
			options = options.call( elem, i, jQuery.extend( {}, curOffset ) );
		}

		if ( options.top != null ) {
			props.top = ( options.top - curOffset.top ) + curTop;
		}
		if ( options.left != null ) {
			props.left = ( options.left - curOffset.left ) + curLeft;
		}

		if ( "using" in options ) {
			options.using.call( elem, props );

		} else {
			if ( typeof props.top === "number" ) {
				props.top += "px";
			}
			if ( typeof props.left === "number" ) {
				props.left += "px";
			}
			curElem.css( props );
		}
	}
};

jQuery.fn.extend( {

	// offset() relates an element's border box to the document origin
	offset: function( options ) {

		// Preserve chaining for setter
		if ( arguments.length ) {
			return options === undefined ?
				this :
				this.each( function( i ) {
					jQuery.offset.setOffset( this, options, i );
				} );
		}

		var rect, win,
			elem = this[ 0 ];

		if ( !elem ) {
			return;
		}

		// Return zeros for disconnected and hidden (display: none) elements (gh-2310)
		// Support: IE <=11 only
		// Running getBoundingClientRect on a
		// disconnected node in IE throws an error
		if ( !elem.getClientRects().length ) {
			return { top: 0, left: 0 };
		}

		// Get document-relative position by adding viewport scroll to viewport-relative gBCR
		rect = elem.getBoundingClientRect();
		win = elem.ownerDocument.defaultView;
		return {
			top: rect.top + win.pageYOffset,
			left: rect.left + win.pageXOffset
		};
	},

	// position() relates an element's margin box to its offset parent's padding box
	// This corresponds to the behavior of CSS absolute positioning
	position: function() {
		if ( !this[ 0 ] ) {
			return;
		}

		var offsetParent, offset, doc,
			elem = this[ 0 ],
			parentOffset = { top: 0, left: 0 };

		// position:fixed elements are offset from the viewport, which itself always has zero offset
		if ( jQuery.css( elem, "position" ) === "fixed" ) {

			// Assume position:fixed implies availability of getBoundingClientRect
			offset = elem.getBoundingClientRect();

		} else {
			offset = this.offset();

			// Account for the *real* offset parent, which can be the document or its root element
			// when a statically positioned element is identified
			doc = elem.ownerDocument;
			offsetParent = elem.offsetParent || doc.documentElement;
			while ( offsetParent &&
				( offsetParent === doc.body || offsetParent === doc.documentElement ) &&
				jQuery.css( offsetParent, "position" ) === "static" ) {

				offsetParent = offsetParent.parentNode;
			}
			if ( offsetParent && offsetParent !== elem && offsetParent.nodeType === 1 ) {

				// Incorporate borders into its offset, since they are outside its content origin
				parentOffset = jQuery( offsetParent ).offset();
				parentOffset.top += jQuery.css( offsetParent, "borderTopWidth", true );
				parentOffset.left += jQuery.css( offsetParent, "borderLeftWidth", true );
			}
		}

		// Subtract parent offsets and element margins
		return {
			top: offset.top - parentOffset.top - jQuery.css( elem, "marginTop", true ),
			left: offset.left - parentOffset.left - jQuery.css( elem, "marginLeft", true )
		};
	},

	// This method will return documentElement in the following cases:
	// 1) For the element inside the iframe without offsetParent, this method will return
	//    documentElement of the parent window
	// 2) For the hidden or detached element
	// 3) For body or html element, i.e. in case of the html node - it will return itself
	//
	// but those exceptions were never presented as a real life use-cases
	// and might be considered as more preferable results.
	//
	// This logic, however, is not guaranteed and can change at any point in the future
	offsetParent: function() {
		return this.map( function() {
			var offsetParent = this.offsetParent;

			while ( offsetParent && jQuery.css( offsetParent, "position" ) === "static" ) {
				offsetParent = offsetParent.offsetParent;
			}

			return offsetParent || documentElement;
		} );
	}
} );

// Create scrollLeft and scrollTop methods
jQuery.each( { scrollLeft: "pageXOffset", scrollTop: "pageYOffset" }, function( method, prop ) {
	var top = "pageYOffset" === prop;

	jQuery.fn[ method ] = function( val ) {
		return access( this, function( elem, method, val ) {

			// Coalesce documents and windows
			var win;
			if ( isWindow( elem ) ) {
				win = elem;
			} else if ( elem.nodeType === 9 ) {
				win = elem.defaultView;
			}

			if ( val === undefined ) {
				return win ? win[ prop ] : elem[ method ];
			}

			if ( win ) {
				win.scrollTo(
					!top ? val : win.pageXOffset,
					top ? val : win.pageYOffset
				);

			} else {
				elem[ method ] = val;
			}
		}, method, val, arguments.length );
	};
} );

// Support: Safari <=7 - 9.1, Chrome <=37 - 49
// Add the top/left cssHooks using jQuery.fn.position
// Webkit bug: https://bugs.webkit.org/show_bug.cgi?id=29084
// Blink bug: https://bugs.chromium.org/p/chromium/issues/detail?id=589347
// getComputedStyle returns percent when specified for top/left/bottom/right;
// rather than make the css module depend on the offset module, just check for it here
jQuery.each( [ "top", "left" ], function( _i, prop ) {
	jQuery.cssHooks[ prop ] = addGetHookIf( support.pixelPosition,
		function( elem, computed ) {
			if ( computed ) {
				computed = curCSS( elem, prop );

				// If curCSS returns percentage, fallback to offset
				return rnumnonpx.test( computed ) ?
					jQuery( elem ).position()[ prop ] + "px" :
					computed;
			}
		}
	);
} );


// Create innerHeight, innerWidth, height, width, outerHeight and outerWidth methods
jQuery.each( { Height: "height", Width: "width" }, function( name, type ) {
	jQuery.each( { padding: "inner" + name, content: type, "": "outer" + name },
		function( defaultExtra, funcName ) {

		// Margin is only for outerHeight, outerWidth
		jQuery.fn[ funcName ] = function( margin, value ) {
			var chainable = arguments.length && ( defaultExtra || typeof margin !== "boolean" ),
				extra = defaultExtra || ( margin === true || value === true ? "margin" : "border" );

			return access( this, function( elem, type, value ) {
				var doc;

				if ( isWindow( elem ) ) {

					// $( window ).outerWidth/Height return w/h including scrollbars (gh-1729)
					return funcName.indexOf( "outer" ) === 0 ?
						elem[ "inner" + name ] :
						elem.document.documentElement[ "client" + name ];
				}

				// Get document width or height
				if ( elem.nodeType === 9 ) {
					doc = elem.documentElement;

					// Either scroll[Width/Height] or offset[Width/Height] or client[Width/Height],
					// whichever is greatest
					return Math.max(
						elem.body[ "scroll" + name ], doc[ "scroll" + name ],
						elem.body[ "offset" + name ], doc[ "offset" + name ],
						doc[ "client" + name ]
					);
				}

				return value === undefined ?

					// Get width or height on the element, requesting but not forcing parseFloat
					jQuery.css( elem, type, extra ) :

					// Set width or height on the element
					jQuery.style( elem, type, value, extra );
			}, type, chainable ? margin : undefined, chainable );
		};
	} );
} );


jQuery.each( [
	"ajaxStart",
	"ajaxStop",
	"ajaxComplete",
	"ajaxError",
	"ajaxSuccess",
	"ajaxSend"
], function( _i, type ) {
	jQuery.fn[ type ] = function( fn ) {
		return this.on( type, fn );
	};
} );




jQuery.fn.extend( {

	bind: function( types, data, fn ) {
		return this.on( types, null, data, fn );
	},
	unbind: function( types, fn ) {
		return this.off( types, null, fn );
	},

	delegate: function( selector, types, data, fn ) {
		return this.on( types, selector, data, fn );
	},
	undelegate: function( selector, types, fn ) {

		// ( namespace ) or ( selector, types [, fn] )
		return arguments.length === 1 ?
			this.off( selector, "**" ) :
			this.off( types, selector || "**", fn );
	},

	hover: function( fnOver, fnOut ) {
		return this.mouseenter( fnOver ).mouseleave( fnOut || fnOver );
	}
} );

jQuery.each( ( "blur focus focusin focusout resize scroll click dblclick " +
	"mousedown mouseup mousemove mouseover mouseout mouseenter mouseleave " +
	"change select submit keydown keypress keyup contextmenu" ).split( " " ),
	function( _i, name ) {

		// Handle event binding
		jQuery.fn[ name ] = function( data, fn ) {
			return arguments.length > 0 ?
				this.on( name, null, data, fn ) :
				this.trigger( name );
		};
	} );




// Support: Android <=4.0 only
// Make sure we trim BOM and NBSP
var rtrim = /^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g;

// Bind a function to a context, optionally partially applying any
// arguments.
// jQuery.proxy is deprecated to promote standards (specifically Function#bind)
// However, it is not slated for removal any time soon
jQuery.proxy = function( fn, context ) {
	var tmp, args, proxy;

	if ( typeof context === "string" ) {
		tmp = fn[ context ];
		context = fn;
		fn = tmp;
	}

	// Quick check to determine if target is callable, in the spec
	// this throws a TypeError, but we will just return undefined.
	if ( !isFunction( fn ) ) {
		return undefined;
	}

	// Simulated bind
	args = slice.call( arguments, 2 );
	proxy = function() {
		return fn.apply( context || this, args.concat( slice.call( arguments ) ) );
	};

	// Set the guid of unique handler to the same of original handler, so it can be removed
	proxy.guid = fn.guid = fn.guid || jQuery.guid++;

	return proxy;
};

jQuery.holdReady = function( hold ) {
	if ( hold ) {
		jQuery.readyWait++;
	} else {
		jQuery.ready( true );
	}
};
jQuery.isArray = Array.isArray;
jQuery.parseJSON = JSON.parse;
jQuery.nodeName = nodeName;
jQuery.isFunction = isFunction;
jQuery.isWindow = isWindow;
jQuery.camelCase = camelCase;
jQuery.type = toType;

jQuery.now = Date.now;

jQuery.isNumeric = function( obj ) {

	// As of jQuery 3.0, isNumeric is limited to
	// strings and numbers (primitives or objects)
	// that can be coerced to finite numbers (gh-2662)
	var type = jQuery.type( obj );
	return ( type === "number" || type === "string" ) &&

		// parseFloat NaNs numeric-cast false positives ("")
		// ...but misinterprets leading-number strings, particularly hex literals ("0x...")
		// subtraction forces infinities to NaN
		!isNaN( obj - parseFloat( obj ) );
};

jQuery.trim = function( text ) {
	return text == null ?
		"" :
		( text + "" ).replace( rtrim, "" );
};



// Register as a named AMD module, since jQuery can be concatenated with other
// files that may use define, but not via a proper concatenation script that
// understands anonymous AMD modules. A named AMD is safest and most robust
// way to register. Lowercase jquery is used because AMD module names are
// derived from file names, and jQuery is normally delivered in a lowercase
// file name. Do this after creating the global so that if an AMD module wants
// to call noConflict to hide this version of jQuery, it will work.

// Note that for maximum portability, libraries that are not jQuery should
// declare themselves as anonymous modules, and avoid setting a global if an
// AMD loader is present. jQuery is a special case. For more information, see
// https://github.com/jrburke/requirejs/wiki/Updating-existing-libraries#wiki-anon

if ( true ) {
	!(__WEBPACK_AMD_DEFINE_ARRAY__ = [], __WEBPACK_AMD_DEFINE_RESULT__ = (function() {
		return jQuery;
	}).apply(exports, __WEBPACK_AMD_DEFINE_ARRAY__),
				__WEBPACK_AMD_DEFINE_RESULT__ !== undefined && (module.exports = __WEBPACK_AMD_DEFINE_RESULT__));
}




var

	// Map over jQuery in case of overwrite
	_jQuery = window.jQuery,

	// Map over the $ in case of overwrite
	_$ = window.$;

jQuery.noConflict = function( deep ) {
	if ( window.$ === jQuery ) {
		window.$ = _$;
	}

	if ( deep && window.jQuery === jQuery ) {
		window.jQuery = _jQuery;
	}

	return jQuery;
};

// Expose jQuery and $ identifiers, even in AMD
// (#7102#comment:10, https://github.com/jquery/jquery/pull/557)
// and CommonJS for browser emulators (#13566)
if ( typeof noGlobal === "undefined" ) {
	window.jQuery = window.$ = jQuery;
}




return jQuery;
} );


/***/ }),

/***/ "./resources/js/embed-search.js":
/*!**************************************!*\
  !*** ./resources/js/embed-search.js ***!
  \**************************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var algoliasearch_lite__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! algoliasearch/lite */ "./node_modules/algoliasearch/dist/algoliasearch-lite.umd.js");
/* harmony import */ var algoliasearch_lite__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(algoliasearch_lite__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var instantsearch_js_dist_instantsearch_production_min__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! instantsearch.js/dist/instantsearch.production.min */ "./node_modules/instantsearch.js/dist/instantsearch.production.min.js");
/* harmony import */ var instantsearch_js_dist_instantsearch_production_min__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(instantsearch_js_dist_instantsearch_production_min__WEBPACK_IMPORTED_MODULE_1__);
__webpack_require__(/*! bootstrap/js/src/tab */ "./node_modules/bootstrap/js/src/tab.js");



var searchModalId = '#neulyEmbedSearchModal';

(function ($) {
  $.fn.neulyEmbedSearch = function (code) {
    var searchButton = $(this); //TODO make domain dynamic

    var mainDomain = 'https://staging.neuly.com';
    $.get(mainDomain + '/js/external/embedSearch/template/' + code, function (template) {
      $('body').append(template);
      var searchModal = $(searchModalId);
      searchButton.on('click', function (e) {
        e.preventDefault();
        searchModal.fadeIn();
        $('body').css('overflow', 'hidden');
      });
      searchModal.find('.nes-btn-close').on('click', function (e) {
        e.preventDefault();
        searchModal.fadeOut();
        $('body').css('overflow', 'visible');
      });
      var searchClient = algoliasearch_lite__WEBPACK_IMPORTED_MODULE_0___default()('2WZKZJIBUG', '686437b222f70e8cdbbba3899ea1f93d');
      var searchIndexes = {
        companies: 'companies',
        people: 'people',
        investors: 'investors',
        research: 'research',
        clinicaltrials: 'clinicaltrials',
        events: 'events',
        jobs: 'jobs',
        newsArticles: 'news_articles'
      };
      var sectionSelectors = {
        main: '.nes-section-main',
        companies: '.nes-section-companies',
        people: '.nes-section-people',
        investors: '.nes-section-investors',
        research: '.nes-section-research',
        clinicaltrials: '.nes-section-clinical-trials',
        events: '.nes-section-events',
        jobs: '.nes-section-jobs',
        newsArticles: '.nes-section-news-articles'
      };
      var filterSelectors = {
        hasEvents: '.nes-filter-has-events',
        hasJobs: '.nes-filter-has-jobs',
        type: '.nes-filter-type',
        countries: '.nes-filter-countries',
        locations: '.nes-filter-locations',
        focus: '.nes-filter-focus',
        people: '.nes-filter-people',
        companies: '.nes-filter-companies',
        status: '.nes-filter-status',
        reset: '.nes-filter-reset',
        filterItem: '.nes-filter-item'
      };
      var widgetSelectors = {
        stats: '.nes-stats',
        hits: '.nes-hits',
        sort: '.nes-sort-by',
        pagination: '.nes-pagination'
      };
      var searchInstances = [];

      function makeSelectorFromArray(selectors) {
        return selectors.join(' ');
      }

      function getElementBySelectorsArray(selectors) {
        return document.querySelector(makeSelectorFromArray(selectors));
      }

      function createStatsWidget(sectionSelector) {
        return function (renderOptions, isFirstRender) {
          var nbHits = renderOptions.nbHits;
          var selector = makeSelectorFromArray([sectionSelector, widgetSelectors.stats]);
          document.querySelector(selector).innerHTML = nbHits;
        };
      }
      /**
       * Company search
       */


      if (document.querySelector(sectionSelectors.companies) !== null) {
        var companiesFilterItemsSelector = makeSelectorFromArray([sectionSelectors.companies, filterSelectors.filterItem]);
        var companiesFilterItems = document.querySelectorAll(companiesFilterItemsSelector);
        var companiesPrefilters = [];
        companiesFilterItems.forEach(function (filterItem) {
          if (typeof filterItem.dataset.name !== 'undefined' && typeof filterItem.dataset.prefilter !== 'undefined') {
            var name = filterItem.dataset.name;
            var prefilters = JSON.parse(filterItem.dataset.prefilter);

            for (var key in prefilters) {
              companiesPrefilters.push(name + ':' + prefilters[key]);
            }
          }
        });
        var companySearch = instantsearch_js_dist_instantsearch_production_min__WEBPACK_IMPORTED_MODULE_1___default()({
          indexName: searchIndexes.companies,
          searchClient: searchClient
        });
        var renderCompaniesStats = instantsearch_js_dist_instantsearch_production_min__WEBPACK_IMPORTED_MODULE_1___default.a.connectors.connectStats(createStatsWidget(sectionSelectors.companies));
        companySearch.addWidgets([renderCompaniesStats(), instantsearch_js_dist_instantsearch_production_min__WEBPACK_IMPORTED_MODULE_1___default.a.widgets.configure({
          hitsPerPage: 6,
          facetFilters: [companiesPrefilters]
        }), instantsearch_js_dist_instantsearch_production_min__WEBPACK_IMPORTED_MODULE_1___default.a.widgets.clearRefinements({
          container: getElementBySelectorsArray([sectionSelectors.companies, filterSelectors.reset])
        }), instantsearch_js_dist_instantsearch_production_min__WEBPACK_IMPORTED_MODULE_1___default.a.widgets.hits({
          container: getElementBySelectorsArray([sectionSelectors.companies, widgetSelectors.hits]),
          cssClasses: {
            list: ['d-flex', 'flex-wrap'],
            item: ['col-12', 'col-md-6', 'col-xl-4', 'mb-5']
          },
          templates: {
            item: "\n                <div class=\"card shadow-sm\">\n                    <div class=\"pt-4 text-center\">\n                        <a href=\"" + mainDomain + "/organization/{{ slug }}\" class=\"text-decoration-none\">\n                            <div class=\"logo-is-contained\" style=\"background-image: url('{{ logo }}')\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"\" data-original-title=\"{{ name }}\"></div>\n                        </a>\n                        <p class=\"my-3 lead\">\n                            <a href=\"" + mainDomain + "/organization/{{ slug }}\" class=\"text-decoration-none\">{{ name }}</a>\n                        </p>\n\n                    </div>\n                </div>\n                "
          }
        }), instantsearch_js_dist_instantsearch_production_min__WEBPACK_IMPORTED_MODULE_1___default.a.widgets.pagination({
          container: getElementBySelectorsArray([sectionSelectors.companies, widgetSelectors.pagination]),
          cssClasses: {
            list: ['pagination'],
            item: ['page-item'],
            selectedItem: ['active'],
            disabledItem: ['disabled'],
            link: ['page-link']
          }
        }), instantsearch_js_dist_instantsearch_production_min__WEBPACK_IMPORTED_MODULE_1___default.a.widgets.refinementList({
          container: getElementBySelectorsArray([sectionSelectors.companies, filterSelectors.focus]),
          attribute: 'focus'
        }) // instantsearch.widgets.refinementList({
        //     container: getElementBySelectorsArray([
        //         sectionSelectors.companies,
        //         filterSelectors.type
        //     ]),
        //     attribute: 'ownership'
        // }),
        // instantsearch.widgets.refinementList({
        //     container: getElementBySelectorsArray([
        //         sectionSelectors.companies,
        //         filterSelectors.countries
        //     ]),
        //     attribute: 'locations.country',
        //     showMore: false,
        //     searchable: true,
        //     searchablePlaceholder: 'e.g. United States',
        // }),
        // instantsearch.widgets.refinementList({
        //     container: getElementBySelectorsArray([
        //         sectionSelectors.companies,
        //         filterSelectors.locations
        //     ]),
        //     attribute: 'locations.name',
        //     showMore: false,
        //     searchable: true,
        //     searchablePlaceholder: 'e.g. New York',
        // }),
        // instantsearch.widgets.toggleRefinement({
        //     container: getElementBySelectorsArray([
        //         sectionSelectors.companies,
        //         filterSelectors.hasEvents
        //     ]),
        //     attribute: 'events',
        //     templates: {
        //         labelText: 'Upcoming Events',
        //     },
        // }),
        // instantsearch.widgets.toggleRefinement({
        //     container: getElementBySelectorsArray([
        //         sectionSelectors.companies,
        //         filterSelectors.hasJobs
        //     ]),
        //     attribute: 'jobs',
        //     templates: {
        //         labelText: 'Now Hiring',
        //     },
        // }),
        ]);
        companySearch.start();
        searchInstances.push(companySearch);
      }
      /**
       * People search
       */


      if (document.querySelector(sectionSelectors.people) !== null) {
        var peopleFilterItemsSelector = makeSelectorFromArray([sectionSelectors.people, filterSelectors.filterItem]);
        var peopleFilterItems = document.querySelectorAll(peopleFilterItemsSelector);
        var peoplePrefilters = [];
        peopleFilterItems.forEach(function (filterItem) {
          if (typeof filterItem.dataset.name !== 'undefined' && typeof filterItem.dataset.prefilter !== 'undefined') {
            var name = filterItem.dataset.name;
            var prefilters = JSON.parse(filterItem.dataset.prefilter);

            for (var key in prefilters) {
              peoplePrefilters.push(name + ':' + prefilters[key]);
            }
          }
        });
        var peopleSearch = instantsearch_js_dist_instantsearch_production_min__WEBPACK_IMPORTED_MODULE_1___default()({
          indexName: searchIndexes.people,
          searchClient: searchClient
        });
        var renderPeopleStats = instantsearch_js_dist_instantsearch_production_min__WEBPACK_IMPORTED_MODULE_1___default.a.connectors.connectStats(createStatsWidget(sectionSelectors.people));
        peopleSearch.addWidgets([renderPeopleStats(), instantsearch_js_dist_instantsearch_production_min__WEBPACK_IMPORTED_MODULE_1___default.a.widgets.configure({
          hitsPerPage: 6,
          facetFilters: [peoplePrefilters]
        }), instantsearch_js_dist_instantsearch_production_min__WEBPACK_IMPORTED_MODULE_1___default.a.widgets.clearRefinements({
          container: getElementBySelectorsArray([sectionSelectors.people, filterSelectors.reset])
        }), instantsearch_js_dist_instantsearch_production_min__WEBPACK_IMPORTED_MODULE_1___default.a.widgets.hits({
          container: getElementBySelectorsArray([sectionSelectors.people, widgetSelectors.hits]),
          cssClasses: {
            list: ['d-flex', 'flex-wrap'],
            item: ['col-12', 'col-md-6', 'col-xl-4', 'mb-5']
          },
          templates: {
            item: "\n                <div class=\"card shadow-sm\">\n                    <div class=\"pt-4 text-center\">\n                        <a href=\"" + mainDomain + "/person/{{ slug }}\" class=\"text-decoration-none\">\n                            <div class=\"person-photo-small shadow-sm\" style=\"background-image: url('{{ photo }}')\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"\" data-original-title=\"{{ name }}\"></div>\n                        </a>\n                        <p class=\"my-3 lead\">\n                            <a href=\"" + mainDomain + "/person/{{ slug }}\" class=\"text-decoration-none\">{{ name }}</a>\n                        </p>\n\n                    </div>\n                </div>\n                "
          }
        }), instantsearch_js_dist_instantsearch_production_min__WEBPACK_IMPORTED_MODULE_1___default.a.widgets.pagination({
          container: getElementBySelectorsArray([sectionSelectors.people, widgetSelectors.pagination]),
          cssClasses: {
            list: ['pagination'],
            item: ['page-item'],
            selectedItem: ['active'],
            disabledItem: ['disabled'],
            link: ['page-link']
          }
        }), instantsearch_js_dist_instantsearch_production_min__WEBPACK_IMPORTED_MODULE_1___default.a.widgets.refinementList({
          container: getElementBySelectorsArray([sectionSelectors.people, filterSelectors.focus]),
          attribute: 'focus'
        }) // instantsearch.widgets.refinementList({
        //     container: getElementBySelectorsArray([
        //         sectionSelectors.people,
        //         filterSelectors.countries,
        //     ]),
        //     attribute: 'locations.country',
        //     showMore: false,
        //     searchable: true,
        //     searchablePlaceholder: 'e.g. United States',
        // }),
        ]);
        peopleSearch.start();
        searchInstances.push(peopleSearch);
      }
      /**
       * Investor search
       */


      if (document.querySelector(sectionSelectors.investors) !== null) {
        var investorSearch = instantsearch_js_dist_instantsearch_production_min__WEBPACK_IMPORTED_MODULE_1___default()({
          indexName: searchIndexes.investors,
          searchClient: searchClient
        });
        var renderInvestorsStats = instantsearch_js_dist_instantsearch_production_min__WEBPACK_IMPORTED_MODULE_1___default.a.connectors.connectStats(createStatsWidget(sectionSelectors.investors));
        investorSearch.addWidgets([renderInvestorsStats(), instantsearch_js_dist_instantsearch_production_min__WEBPACK_IMPORTED_MODULE_1___default.a.widgets.configure({
          hitsPerPage: 6
        }), instantsearch_js_dist_instantsearch_production_min__WEBPACK_IMPORTED_MODULE_1___default.a.widgets.clearRefinements({
          container: getElementBySelectorsArray([sectionSelectors.investors, filterSelectors.reset])
        }), instantsearch_js_dist_instantsearch_production_min__WEBPACK_IMPORTED_MODULE_1___default.a.widgets.hits({
          container: getElementBySelectorsArray([sectionSelectors.investors, widgetSelectors.hits]),
          cssClasses: {
            list: ['d-flex', 'flex-wrap'],
            item: ['col-12', 'col-md-6', 'col-xl-4', 'mb-5']
          },
          templates: {
            item: "\n                    <div class=\"card shadow-sm\">\n                        <div class=\"pt-4 text-center\">\n                            <a href=\"" + mainDomain + "/investor/{{ slug }}\" class=\"text-decoration-none\">\n                                <div class=\"logo-is-contained\" style=\"background-image: url('{{ logo }}')\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"\" data-original-title=\"{{ name }}\"></div>\n                            </a>\n                            <p class=\"my-3 lead\">\n                                <a href=\"" + mainDomain + "/investor/{{ slug }}\" class=\"text-decoration-none\">{{ name }}</a>\n                            </p>\n                        </div>\n                    </div>\n                    "
          }
        }), instantsearch_js_dist_instantsearch_production_min__WEBPACK_IMPORTED_MODULE_1___default.a.widgets.refinementList({
          container: getElementBySelectorsArray([sectionSelectors.investors, filterSelectors.countries]),
          attribute: 'locations.country',
          showMore: false,
          searchable: true,
          searchablePlaceholder: 'e.g. United States'
        }), instantsearch_js_dist_instantsearch_production_min__WEBPACK_IMPORTED_MODULE_1___default.a.widgets.refinementList({
          container: getElementBySelectorsArray([sectionSelectors.investors, filterSelectors.type]),
          attribute: 'type'
        }), instantsearch_js_dist_instantsearch_production_min__WEBPACK_IMPORTED_MODULE_1___default.a.widgets.pagination({
          container: getElementBySelectorsArray([sectionSelectors.investors, widgetSelectors.pagination]),
          cssClasses: {
            list: ['pagination'],
            item: ['page-item'],
            selectedItem: ['active'],
            disabledItem: ['disabled'],
            link: ['page-link']
          }
        }), instantsearch_js_dist_instantsearch_production_min__WEBPACK_IMPORTED_MODULE_1___default.a.widgets.toggleRefinement({
          container: getElementBySelectorsArray([sectionSelectors.investors, filterSelectors.hasJobs]),
          attribute: 'jobs',
          templates: {
            labelText: 'Now Hiring'
          }
        })]);
        investorSearch.start();
        searchInstances.push(investorSearch);
      }
      /**
       * Research search
       */


      if (document.querySelector(sectionSelectors.research) !== null) {
        var researchSearch = instantsearch_js_dist_instantsearch_production_min__WEBPACK_IMPORTED_MODULE_1___default()({
          indexName: searchIndexes.research,
          searchClient: searchClient
        });
        var renderResearchStats = instantsearch_js_dist_instantsearch_production_min__WEBPACK_IMPORTED_MODULE_1___default.a.connectors.connectStats(createStatsWidget(sectionSelectors.research));
        researchSearch.addWidgets([renderResearchStats(), instantsearch_js_dist_instantsearch_production_min__WEBPACK_IMPORTED_MODULE_1___default.a.widgets.configure({
          hitsPerPage: 4
        }), instantsearch_js_dist_instantsearch_production_min__WEBPACK_IMPORTED_MODULE_1___default.a.widgets.clearRefinements({
          container: getElementBySelectorsArray([sectionSelectors.research, filterSelectors.reset])
        }), instantsearch_js_dist_instantsearch_production_min__WEBPACK_IMPORTED_MODULE_1___default.a.widgets.hits({
          container: getElementBySelectorsArray([sectionSelectors.research, widgetSelectors.hits]),
          cssClasses: {
            list: ['d-flex', 'flex-wrap'],
            item: ['col-12', 'mb-5']
          },
          templates: {
            item: "\n                    <div class=\"card shadow-sm\">\n                        <div class=\"p-3\">\n                            <p class=\"lead\">\n                                <a href=\"" + mainDomain + "/research/{{ slug }}\" class=\"text-decoration-none\">{{ name }}</a>\n                            </p>\n                        </div>\n                    </div>\n                    "
          }
        }), instantsearch_js_dist_instantsearch_production_min__WEBPACK_IMPORTED_MODULE_1___default.a.widgets.refinementList({
          container: getElementBySelectorsArray([sectionSelectors.research, filterSelectors.people]),
          attribute: 'people',
          showMore: false,
          searchable: true
        }), instantsearch_js_dist_instantsearch_production_min__WEBPACK_IMPORTED_MODULE_1___default.a.widgets.refinementList({
          container: getElementBySelectorsArray([sectionSelectors.research, filterSelectors.focus]),
          attribute: 'focus',
          showMore: true
        }), instantsearch_js_dist_instantsearch_production_min__WEBPACK_IMPORTED_MODULE_1___default.a.widgets.refinementList({
          container: getElementBySelectorsArray([sectionSelectors.research, filterSelectors.companies]),
          attribute: 'companies',
          showMore: true
        }), instantsearch_js_dist_instantsearch_production_min__WEBPACK_IMPORTED_MODULE_1___default.a.widgets.pagination({
          container: getElementBySelectorsArray([sectionSelectors.research, widgetSelectors.pagination]),
          cssClasses: {
            list: ['pagination'],
            item: ['page-item'],
            selectedItem: ['active'],
            disabledItem: ['disabled'],
            link: ['page-link']
          }
        })]);
        researchSearch.start();
        searchInstances.push(researchSearch);
      }
      /**
       * Clinical Trial search
       */


      console.log(document.querySelector(sectionSelectors.clinicaltrials));

      if (document.querySelector(sectionSelectors.clinicaltrials) !== null) {
        var clinicalTrialsSearch = instantsearch_js_dist_instantsearch_production_min__WEBPACK_IMPORTED_MODULE_1___default()({
          indexName: searchIndexes.clinicaltrials,
          searchClient: searchClient
        });
        var renderClinicalTrialStats = instantsearch_js_dist_instantsearch_production_min__WEBPACK_IMPORTED_MODULE_1___default.a.connectors.connectStats(createStatsWidget(sectionSelectors.clinicaltrials));
        clinicalTrialsSearch.addWidgets([renderClinicalTrialStats(), instantsearch_js_dist_instantsearch_production_min__WEBPACK_IMPORTED_MODULE_1___default.a.widgets.configure({
          hitsPerPage: 4
        }), instantsearch_js_dist_instantsearch_production_min__WEBPACK_IMPORTED_MODULE_1___default.a.widgets.clearRefinements({
          container: getElementBySelectorsArray([sectionSelectors.clinicaltrials, filterSelectors.reset])
        }), instantsearch_js_dist_instantsearch_production_min__WEBPACK_IMPORTED_MODULE_1___default.a.widgets.hits({
          container: getElementBySelectorsArray([sectionSelectors.clinicaltrials, widgetSelectors.hits]),
          cssClasses: {
            list: ['d-flex', 'flex-wrap'],
            item: ['col-12', 'mb-5']
          },
          templates: {
            item: "\n                    <div class=\"card shadow-sm\">\n                        <div class=\"p-3\">\n                            <p class=\"lead\">\n                                <a href=\"" + mainDomain + "/research/{{ slug }}\" class=\"text-decoration-none\">{{ name }}</a>\n                            </p>\n                        </div>\n                    </div>\n                    "
          }
        }), instantsearch_js_dist_instantsearch_production_min__WEBPACK_IMPORTED_MODULE_1___default.a.widgets.refinementList({
          container: getElementBySelectorsArray([sectionSelectors.clinicaltrials, filterSelectors.focus]),
          attribute: 'focus',
          showMore: true
        }), instantsearch_js_dist_instantsearch_production_min__WEBPACK_IMPORTED_MODULE_1___default.a.widgets.refinementList({
          container: getElementBySelectorsArray([sectionSelectors.clinicaltrials, filterSelectors.companies]),
          attribute: 'companies',
          showMore: true
        }), instantsearch_js_dist_instantsearch_production_min__WEBPACK_IMPORTED_MODULE_1___default.a.widgets.refinementList({
          container: getElementBySelectorsArray([sectionSelectors.clinicaltrials, filterSelectors.status]),
          attribute: 'status',
          showMore: true
        }), instantsearch_js_dist_instantsearch_production_min__WEBPACK_IMPORTED_MODULE_1___default.a.widgets.refinementList({
          container: getElementBySelectorsArray([sectionSelectors.clinicaltrials, filterSelectors.people]),
          attribute: 'people',
          showMore: false,
          searchable: true
        }), instantsearch_js_dist_instantsearch_production_min__WEBPACK_IMPORTED_MODULE_1___default.a.widgets.pagination({
          container: getElementBySelectorsArray([sectionSelectors.clinicaltrials, widgetSelectors.pagination]),
          cssClasses: {
            list: ['pagination'],
            item: ['page-item'],
            selectedItem: ['active'],
            disabledItem: ['disabled'],
            link: ['page-link']
          }
        })]);
        clinicalTrialsSearch.start();
        searchInstances.push(clinicalTrialsSearch);
      }
      /**
       * Event search
       */


      if (document.querySelector(sectionSelectors.events) !== null) {
        var eventsSearch = instantsearch_js_dist_instantsearch_production_min__WEBPACK_IMPORTED_MODULE_1___default()({
          indexName: searchIndexes.events,
          searchClient: searchClient
        });
        var renderEventsStats = instantsearch_js_dist_instantsearch_production_min__WEBPACK_IMPORTED_MODULE_1___default.a.connectors.connectStats(createStatsWidget(sectionSelectors.events));
        eventsSearch.addWidgets([renderEventsStats(), instantsearch_js_dist_instantsearch_production_min__WEBPACK_IMPORTED_MODULE_1___default.a.widgets.configure({
          hitsPerPage: 4
        }), instantsearch_js_dist_instantsearch_production_min__WEBPACK_IMPORTED_MODULE_1___default.a.widgets.clearRefinements({
          container: getElementBySelectorsArray([sectionSelectors.events, filterSelectors.reset])
        }), instantsearch_js_dist_instantsearch_production_min__WEBPACK_IMPORTED_MODULE_1___default.a.widgets.hits({
          container: getElementBySelectorsArray([sectionSelectors.events, widgetSelectors.hits]),
          cssClasses: {
            list: ['d-flex', 'flex-wrap'],
            item: ['col-12', 'mb-5']
          },
          templates: {
            item: "\n                    <div class=\"card shadow-sm\">\n                        <div class=\"p-3\">\n                            <p class=\"lead\">\n                                <a href=\"" + mainDomain + "/event/{{ slug }}\" class=\"text-decoration-none\">{{ name }}</a>\n                            </p>\n                        </div>\n                    </div>\n                    "
          }
        }), instantsearch_js_dist_instantsearch_production_min__WEBPACK_IMPORTED_MODULE_1___default.a.widgets.refinementList({
          container: getElementBySelectorsArray([sectionSelectors.events, filterSelectors.focus]),
          attribute: 'focus',
          showMore: true
        }), instantsearch_js_dist_instantsearch_production_min__WEBPACK_IMPORTED_MODULE_1___default.a.widgets.refinementList({
          container: getElementBySelectorsArray([sectionSelectors.events, filterSelectors.companies]),
          attribute: 'companies',
          showMore: true
        }), instantsearch_js_dist_instantsearch_production_min__WEBPACK_IMPORTED_MODULE_1___default.a.widgets.refinementList({
          container: getElementBySelectorsArray([sectionSelectors.events, filterSelectors.type]),
          attribute: 'eventTypes',
          showMore: true
        }), instantsearch_js_dist_instantsearch_production_min__WEBPACK_IMPORTED_MODULE_1___default.a.widgets.refinementList({
          container: getElementBySelectorsArray([sectionSelectors.events, filterSelectors.countries]),
          attribute: 'locations.country',
          showMore: false,
          searchable: true,
          searchablePlaceholder: 'e.g. United States'
        }), instantsearch_js_dist_instantsearch_production_min__WEBPACK_IMPORTED_MODULE_1___default.a.widgets.pagination({
          container: getElementBySelectorsArray([sectionSelectors.events, widgetSelectors.pagination]),
          cssClasses: {
            list: ['pagination'],
            item: ['page-item'],
            selectedItem: ['active'],
            disabledItem: ['disabled'],
            link: ['page-link']
          }
        })]);
        eventsSearch.start();
        searchInstances.push(eventsSearch);
      }
      /**
       * Jobs search
       */


      if (document.querySelector(sectionSelectors.jobs) !== null) {
        var jobsSearch = instantsearch_js_dist_instantsearch_production_min__WEBPACK_IMPORTED_MODULE_1___default()({
          indexName: searchIndexes.jobs,
          searchClient: searchClient
        });
        var renderJobsStats = instantsearch_js_dist_instantsearch_production_min__WEBPACK_IMPORTED_MODULE_1___default.a.connectors.connectStats(createStatsWidget(sectionSelectors.jobs));
        jobsSearch.addWidgets([renderJobsStats(), instantsearch_js_dist_instantsearch_production_min__WEBPACK_IMPORTED_MODULE_1___default.a.widgets.configure({
          hitsPerPage: 4
        }), instantsearch_js_dist_instantsearch_production_min__WEBPACK_IMPORTED_MODULE_1___default.a.widgets.clearRefinements({
          container: getElementBySelectorsArray([sectionSelectors.jobs, filterSelectors.reset])
        }), instantsearch_js_dist_instantsearch_production_min__WEBPACK_IMPORTED_MODULE_1___default.a.widgets.hits({
          container: getElementBySelectorsArray([sectionSelectors.jobs, widgetSelectors.hits]),
          cssClasses: {
            list: ['d-flex', 'flex-wrap'],
            item: ['col-12', 'mb-5']
          },
          templates: {
            item: "\n                    <div class=\"card shadow-sm\">\n                        <div class=\"p-3\">\n                            <p class=\"lead\">\n                                <a href=\"" + mainDomain + "/jobs/{{ slug }}\" class=\"text-decoration-none\">{{ name }}</a>\n                            </p>\n                        </div>\n                    </div>\n                    "
          }
        }), instantsearch_js_dist_instantsearch_production_min__WEBPACK_IMPORTED_MODULE_1___default.a.widgets.refinementList({
          container: getElementBySelectorsArray([sectionSelectors.jobs, filterSelectors.countries]),
          attribute: 'locations.country',
          showMore: false,
          searchable: true,
          searchablePlaceholder: 'e.g. United States'
        }), instantsearch_js_dist_instantsearch_production_min__WEBPACK_IMPORTED_MODULE_1___default.a.widgets.refinementList({
          container: getElementBySelectorsArray([sectionSelectors.jobs, filterSelectors.type]),
          attribute: 'employment_type',
          showMore: true
        }), instantsearch_js_dist_instantsearch_production_min__WEBPACK_IMPORTED_MODULE_1___default.a.widgets.refinementList({
          container: getElementBySelectorsArray([sectionSelectors.jobs, filterSelectors.companies]),
          attribute: 'owner',
          showMore: true
        }), instantsearch_js_dist_instantsearch_production_min__WEBPACK_IMPORTED_MODULE_1___default.a.widgets.pagination({
          container: getElementBySelectorsArray([sectionSelectors.jobs, widgetSelectors.pagination]),
          cssClasses: {
            list: ['pagination'],
            item: ['page-item'],
            selectedItem: ['active'],
            disabledItem: ['disabled'],
            link: ['page-link']
          }
        })]);
        jobsSearch.start();
        searchInstances.push(jobsSearch);
      }

      if (document.querySelector(sectionSelectors.newsArticles) !== null) {
        var newsArticlesSearch = instantsearch_js_dist_instantsearch_production_min__WEBPACK_IMPORTED_MODULE_1___default()({
          indexName: searchIndexes.newsArticles,
          searchClient: searchClient
        });
        var renderNewsArticlesStats = instantsearch_js_dist_instantsearch_production_min__WEBPACK_IMPORTED_MODULE_1___default.a.connectors.connectStats(createStatsWidget(sectionSelectors.newsArticles));
        newsArticlesSearch.addWidgets([renderNewsArticlesStats(), instantsearch_js_dist_instantsearch_production_min__WEBPACK_IMPORTED_MODULE_1___default.a.widgets.configure({
          hitsPerPage: 4
        }), instantsearch_js_dist_instantsearch_production_min__WEBPACK_IMPORTED_MODULE_1___default.a.widgets.hits({
          container: getElementBySelectorsArray([sectionSelectors.newsArticles, widgetSelectors.hits]),
          cssClasses: {
            list: ['d-flex', 'flex-wrap'],
            item: ['col-12', 'mb-5']
          },
          templates: {
            item: "\n                    <div class=\"card shadow-sm\">\n                        <div class=\"p-3\">\n                            <p class=\"lead\">\n                                <a href=\"{{ url }}\" class=\"text-decoration-none\">{{ name }}</a>\n                            </p>\n                        </div>\n                    </div>\n                    "
          }
        }), instantsearch_js_dist_instantsearch_production_min__WEBPACK_IMPORTED_MODULE_1___default.a.widgets.pagination({
          container: getElementBySelectorsArray([sectionSelectors.newsArticles, widgetSelectors.pagination]),
          cssClasses: {
            list: ['pagination'],
            item: ['page-item'],
            selectedItem: ['active'],
            disabledItem: ['disabled'],
            link: ['page-link']
          }
        })]);
        newsArticlesSearch.start();
        searchInstances.push(newsArticlesSearch);
      }

      $('.nes-submit-button').on('click', function (e) {
        var query = $('.nes-main-input').val().trim();
        searchInstances.forEach(function (instance) {
          instance.helper.setQuery(query).search();
        });
      });
    });
  };
})(jQuery);

/***/ }),

/***/ 4:
/*!********************************************!*\
  !*** multi ./resources/js/embed-search.js ***!
  \********************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /var/www/neuly/resources/js/embed-search.js */"./resources/js/embed-search.js");


/***/ })

/******/ });
