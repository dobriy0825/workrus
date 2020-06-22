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
/******/ 	return __webpack_require__(__webpack_require__.s = 3);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/common/get_csrf.js":
/*!*****************************************!*\
  !*** ./resources/js/common/get_csrf.js ***!
  \*****************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony default export */ __webpack_exports__["default"] = (document.querySelector('meta[name=csrf-token]').getAttribute('content'));

/***/ }),

/***/ "./resources/js/entry_points/job/item_job.js":
/*!***************************************************!*\
  !*** ./resources/js/entry_points/job/item_job.js ***!
  \***************************************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _common_get_csrf__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../common/get_csrf */ "./resources/js/common/get_csrf.js");
 //
// document.querySelector('.proportion_btn').addEventListener('click', function (e) {
//     e.preventDefault();
//     let fdd =  new FormData();
//     fdd.append('id',document.querySelector('.uuu').value);
//     let result = fetch('/job/ooo', {
//         method: 'post',
//         headers: {
//             'X-CSRF-TOKEN': csrf
//         },
//         body: fdd
//     });
//     console.log(result);
// });

document.querySelector('body').style.position = 'relative';
var tabs = document.querySelectorAll('.name_section');
var parts = document.querySelectorAll('.tab');
tabs.forEach(function (item) {
  item.addEventListener('click', function () {
    if (!item.classList.contains('name_section__active')) {
      tabs.forEach(function (item) {
        item.classList.remove('name_section__active');
      });
    }

    item.classList.add('name_section__active');
    var nameClass = item.getAttribute('data-content');
    parts.forEach(function (part) {
      if (!part.classList.contains(nameClass)) {
        part.style.display = 'none';
      }
    });
    var content = document.querySelector('.' + nameClass);
    content.style.display = 'block';
  });
});
document.querySelector('.not_performed_btn').addEventListener('click', function (e) {
  e.preventDefault();
  document.querySelector('.popup_review_not_performed').style.display = 'flex';
});
document.querySelector('.performed_btn').addEventListener('click', function (e) {
  e.preventDefault();
  document.querySelector('.popup_review_performed').style.display = 'flex';
});

/***/ }),

/***/ 3:
/*!*********************************************************!*\
  !*** multi ./resources/js/entry_points/job/item_job.js ***!
  \*********************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\OSPanel\domains\work\resources\js\entry_points\job\item_job.js */"./resources/js/entry_points/job/item_job.js");


/***/ })

/******/ });