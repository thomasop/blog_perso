(self["webpackChunk"] = self["webpackChunk"] || []).push([["app"],{

/***/ "./assets/controllers sync recursive ./node_modules/@symfony/stimulus-bridge/lazy-controller-loader.js! \\.(j%7Ct)sx?$":
/*!*******************************************************************************************************************!*\
  !*** ./assets/controllers/ sync ./node_modules/@symfony/stimulus-bridge/lazy-controller-loader.js! \.(j%7Ct)sx?$ ***!
  \*******************************************************************************************************************/
/***/ ((module, __unused_webpack_exports, __webpack_require__) => {

var map = {
	"./hello_controller.js": "./node_modules/@symfony/stimulus-bridge/lazy-controller-loader.js!./assets/controllers/hello_controller.js"
};


function webpackContext(req) {
	var id = webpackContextResolve(req);
	return __webpack_require__(id);
}
function webpackContextResolve(req) {
	if(!__webpack_require__.o(map, req)) {
		var e = new Error("Cannot find module '" + req + "'");
		e.code = 'MODULE_NOT_FOUND';
		throw e;
	}
	return map[req];
}
webpackContext.keys = function webpackContextKeys() {
	return Object.keys(map);
};
webpackContext.resolve = webpackContextResolve;
module.exports = webpackContext;
webpackContext.id = "./assets/controllers sync recursive ./node_modules/@symfony/stimulus-bridge/lazy-controller-loader.js! \\.(j%7Ct)sx?$";

/***/ }),

/***/ "./assets/controllers sync recursive ./node_modules/@symfony/stimulus-bridge/lazy-controller-loader.js! \\.[jt]sx?$":
/*!****************************************************************************************************************!*\
  !*** ./assets/controllers/ sync ./node_modules/@symfony/stimulus-bridge/lazy-controller-loader.js! \.[jt]sx?$ ***!
  \****************************************************************************************************************/
/***/ ((module, __unused_webpack_exports, __webpack_require__) => {

var map = {
	"./hello_controller.js": "./node_modules/@symfony/stimulus-bridge/lazy-controller-loader.js!./assets/controllers/hello_controller.js"
};


function webpackContext(req) {
	var id = webpackContextResolve(req);
	return __webpack_require__(id);
}
function webpackContextResolve(req) {
	if(!__webpack_require__.o(map, req)) {
		var e = new Error("Cannot find module '" + req + "'");
		e.code = 'MODULE_NOT_FOUND';
		throw e;
	}
	return map[req];
}
webpackContext.keys = function webpackContextKeys() {
	return Object.keys(map);
};
webpackContext.resolve = webpackContextResolve;
module.exports = webpackContext;
webpackContext.id = "./assets/controllers sync recursive ./node_modules/@symfony/stimulus-bridge/lazy-controller-loader.js! \\.[jt]sx?$";

/***/ }),

/***/ "./node_modules/@symfony/stimulus-bridge/dist/webpack/loader.js!./assets/controllers.json":
/*!************************************************************************************************!*\
  !*** ./node_modules/@symfony/stimulus-bridge/dist/webpack/loader.js!./assets/controllers.json ***!
  \************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
});

/***/ }),

/***/ "./node_modules/@symfony/stimulus-bridge/lazy-controller-loader.js!./assets/controllers/hello_controller.js":
/*!******************************************************************************************************************!*\
  !*** ./node_modules/@symfony/stimulus-bridge/lazy-controller-loader.js!./assets/controllers/hello_controller.js ***!
  \******************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* binding */ _default)
/* harmony export */ });
/* harmony import */ var core_js_modules_es_object_set_prototype_of_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! core-js/modules/es.object.set-prototype-of.js */ "./node_modules/core-js/modules/es.object.set-prototype-of.js");
/* harmony import */ var core_js_modules_es_object_set_prototype_of_js__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_object_set_prototype_of_js__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var core_js_modules_es_object_get_prototype_of_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! core-js/modules/es.object.get-prototype-of.js */ "./node_modules/core-js/modules/es.object.get-prototype-of.js");
/* harmony import */ var core_js_modules_es_object_get_prototype_of_js__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_object_get_prototype_of_js__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var core_js_modules_es_object_to_string_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! core-js/modules/es.object.to-string.js */ "./node_modules/core-js/modules/es.object.to-string.js");
/* harmony import */ var core_js_modules_es_object_to_string_js__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_object_to_string_js__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var core_js_modules_es_reflect_construct_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! core-js/modules/es.reflect.construct.js */ "./node_modules/core-js/modules/es.reflect.construct.js");
/* harmony import */ var core_js_modules_es_reflect_construct_js__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_reflect_construct_js__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var core_js_modules_es_object_create_js__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! core-js/modules/es.object.create.js */ "./node_modules/core-js/modules/es.object.create.js");
/* harmony import */ var core_js_modules_es_object_create_js__WEBPACK_IMPORTED_MODULE_4___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_object_create_js__WEBPACK_IMPORTED_MODULE_4__);
/* harmony import */ var core_js_modules_es_object_define_property_js__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! core-js/modules/es.object.define-property.js */ "./node_modules/core-js/modules/es.object.define-property.js");
/* harmony import */ var core_js_modules_es_object_define_property_js__WEBPACK_IMPORTED_MODULE_5___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_object_define_property_js__WEBPACK_IMPORTED_MODULE_5__);
/* harmony import */ var core_js_modules_es_symbol_js__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! core-js/modules/es.symbol.js */ "./node_modules/core-js/modules/es.symbol.js");
/* harmony import */ var core_js_modules_es_symbol_js__WEBPACK_IMPORTED_MODULE_6___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_symbol_js__WEBPACK_IMPORTED_MODULE_6__);
/* harmony import */ var core_js_modules_es_symbol_description_js__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! core-js/modules/es.symbol.description.js */ "./node_modules/core-js/modules/es.symbol.description.js");
/* harmony import */ var core_js_modules_es_symbol_description_js__WEBPACK_IMPORTED_MODULE_7___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_symbol_description_js__WEBPACK_IMPORTED_MODULE_7__);
/* harmony import */ var core_js_modules_es_symbol_iterator_js__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! core-js/modules/es.symbol.iterator.js */ "./node_modules/core-js/modules/es.symbol.iterator.js");
/* harmony import */ var core_js_modules_es_symbol_iterator_js__WEBPACK_IMPORTED_MODULE_8___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_symbol_iterator_js__WEBPACK_IMPORTED_MODULE_8__);
/* harmony import */ var core_js_modules_es_array_iterator_js__WEBPACK_IMPORTED_MODULE_9__ = __webpack_require__(/*! core-js/modules/es.array.iterator.js */ "./node_modules/core-js/modules/es.array.iterator.js");
/* harmony import */ var core_js_modules_es_array_iterator_js__WEBPACK_IMPORTED_MODULE_9___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_array_iterator_js__WEBPACK_IMPORTED_MODULE_9__);
/* harmony import */ var core_js_modules_es_string_iterator_js__WEBPACK_IMPORTED_MODULE_10__ = __webpack_require__(/*! core-js/modules/es.string.iterator.js */ "./node_modules/core-js/modules/es.string.iterator.js");
/* harmony import */ var core_js_modules_es_string_iterator_js__WEBPACK_IMPORTED_MODULE_10___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_string_iterator_js__WEBPACK_IMPORTED_MODULE_10__);
/* harmony import */ var core_js_modules_web_dom_collections_iterator_js__WEBPACK_IMPORTED_MODULE_11__ = __webpack_require__(/*! core-js/modules/web.dom-collections.iterator.js */ "./node_modules/core-js/modules/web.dom-collections.iterator.js");
/* harmony import */ var core_js_modules_web_dom_collections_iterator_js__WEBPACK_IMPORTED_MODULE_11___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_web_dom_collections_iterator_js__WEBPACK_IMPORTED_MODULE_11__);
/* harmony import */ var _hotwired_stimulus__WEBPACK_IMPORTED_MODULE_12__ = __webpack_require__(/*! @hotwired/stimulus */ "./node_modules/@hotwired/stimulus/dist/stimulus.js");
function _typeof(obj) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (obj) { return typeof obj; } : function (obj) { return obj && "function" == typeof Symbol && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }, _typeof(obj); }














function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); Object.defineProperty(Constructor, "prototype", { writable: false }); return Constructor; }

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function"); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, writable: true, configurable: true } }); Object.defineProperty(subClass, "prototype", { writable: false }); if (superClass) _setPrototypeOf(subClass, superClass); }

function _setPrototypeOf(o, p) { _setPrototypeOf = Object.setPrototypeOf || function _setPrototypeOf(o, p) { o.__proto__ = p; return o; }; return _setPrototypeOf(o, p); }

function _createSuper(Derived) { var hasNativeReflectConstruct = _isNativeReflectConstruct(); return function _createSuperInternal() { var Super = _getPrototypeOf(Derived), result; if (hasNativeReflectConstruct) { var NewTarget = _getPrototypeOf(this).constructor; result = Reflect.construct(Super, arguments, NewTarget); } else { result = Super.apply(this, arguments); } return _possibleConstructorReturn(this, result); }; }

function _possibleConstructorReturn(self, call) { if (call && (_typeof(call) === "object" || typeof call === "function")) { return call; } else if (call !== void 0) { throw new TypeError("Derived constructors may only return object or undefined"); } return _assertThisInitialized(self); }

function _assertThisInitialized(self) { if (self === void 0) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return self; }

function _isNativeReflectConstruct() { if (typeof Reflect === "undefined" || !Reflect.construct) return false; if (Reflect.construct.sham) return false; if (typeof Proxy === "function") return true; try { Boolean.prototype.valueOf.call(Reflect.construct(Boolean, [], function () {})); return true; } catch (e) { return false; } }

function _getPrototypeOf(o) { _getPrototypeOf = Object.setPrototypeOf ? Object.getPrototypeOf : function _getPrototypeOf(o) { return o.__proto__ || Object.getPrototypeOf(o); }; return _getPrototypeOf(o); }


/*
 * This is an example Stimulus controller!
 *
 * Any element with a data-controller="hello" attribute will cause
 * this controller to be executed. The name "hello" comes from the filename:
 * hello_controller.js -> "hello"
 *
 * Delete this file or adapt it for your use!
 */

var _default = /*#__PURE__*/function (_Controller) {
  _inherits(_default, _Controller);

  var _super = _createSuper(_default);

  function _default() {
    _classCallCheck(this, _default);

    return _super.apply(this, arguments);
  }

  _createClass(_default, [{
    key: "connect",
    value: function connect() {
      this.element.textContent = 'Hello Stimulus! Edit me in assets/controllers/hello_controller.js';
    }
  }]);

  return _default;
}(_hotwired_stimulus__WEBPACK_IMPORTED_MODULE_12__.Controller);



/***/ }),

/***/ "./assets/app.js":
/*!***********************!*\
  !*** ./assets/app.js ***!
  \***********************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "app": () => (/* binding */ app)
/* harmony export */ });
/* harmony import */ var core_js_modules_es_array_slice_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! core-js/modules/es.array.slice.js */ "./node_modules/core-js/modules/es.array.slice.js");
/* harmony import */ var core_js_modules_es_array_slice_js__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_array_slice_js__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var core_js_modules_es_array_find_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! core-js/modules/es.array.find.js */ "./node_modules/core-js/modules/es.array.find.js");
/* harmony import */ var core_js_modules_es_array_find_js__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_array_find_js__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var core_js_modules_es_object_to_string_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! core-js/modules/es.object.to-string.js */ "./node_modules/core-js/modules/es.object.to-string.js");
/* harmony import */ var core_js_modules_es_object_to_string_js__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_object_to_string_js__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var core_js_modules_es_regexp_exec_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! core-js/modules/es.regexp.exec.js */ "./node_modules/core-js/modules/es.regexp.exec.js");
/* harmony import */ var core_js_modules_es_regexp_exec_js__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_regexp_exec_js__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var core_js_modules_es_string_replace_js__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! core-js/modules/es.string.replace.js */ "./node_modules/core-js/modules/es.string.replace.js");
/* harmony import */ var core_js_modules_es_string_replace_js__WEBPACK_IMPORTED_MODULE_4___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_string_replace_js__WEBPACK_IMPORTED_MODULE_4__);
/* harmony import */ var bootstrap__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! bootstrap */ "./node_modules/bootstrap/dist/js/bootstrap.esm.js");
/* harmony import */ var _styles_app_scss__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! ./styles/app.scss */ "./assets/styles/app.scss");
/* harmony import */ var _symfony_stimulus_bridge__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! @symfony/stimulus-bridge */ "./node_modules/@symfony/stimulus-bridge/dist/index.js");
/* harmony import */ var _images_flore_png__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! ./images/flore.png */ "./assets/images/flore.png");
/* harmony import */ var _bootstrap__WEBPACK_IMPORTED_MODULE_9__ = __webpack_require__(/*! ./bootstrap */ "./assets/bootstrap.js");






/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */
 // any CSS you import will output into a single css file (app.css in this case)



var app = (0,_symfony_stimulus_bridge__WEBPACK_IMPORTED_MODULE_7__.startStimulusApp)(__webpack_require__("./assets/controllers sync recursive ./node_modules/@symfony/stimulus-bridge/lazy-controller-loader.js! \\.(j%7Ct)sx?$"));

 // start the Stimulus application

 //for modal bootstrap

var container = document.getElementById("exampleModal");
var modal = new bootstrap__WEBPACK_IMPORTED_MODULE_5__.Modal(container);
document.getElementById("myInput").addEventListener("click", function () {
  modal.show();
});
document.getElementById("close").addEventListener("click", function () {
  modal.hide();
});
document.getElementById("closeFooter").addEventListener("click", function () {
  modal.hide();
});

var $ = __webpack_require__(/*! jquery */ "./node_modules/jquery/dist/jquery.js"); //for less or more post in home


$(function () {
  $("div.posts").slice(4).hide();
  $("#loadLessPost").hide("slow");
  $("#loadMorePost").on('click', function (e) {
    e.preventDefault();
    $("div.posts:hidden").slice(0, 4).slideDown();

    if ($("div.posts:hidden").length === 0) {
      $("#loadMorePost").hide("slow");
      $("#loadLessPost").show("slow");
    }
  });
  $("#loadLessPost").on('click', function (e) {
    e.preventDefault();
    $("div.posts").slice(4, $("div.posts").length).hide();
    $("#loadLessPost").hide("slow");
    $("#loadMorePost").show("slow");
  });
}); //photo hide and show in comment/post.html.twig and user/show.html.twig template

$(function () {
  $("div.image").slice(3).hide();

  if ($("div.image").length < 4) {
    $("#loadMediaimage").hide();
    $("#hideMediaimage").hide();
  }

  $("#hideMediaimage").hide();
  $("#loadMediaimage").on('click', function (e) {
    e.preventDefault();
    $("div.image:hidden").slice(0, 3).slideDown();
    $("#hideMediaimage").show();

    if ($("div.image:hidden").length === 0) {
      $("#loadMediaimage").hide();
      $("#hideMediaimage").show();
    }
  });
  $("#hideMediaimage").on('click', function (e) {
    e.preventDefault();
    $("div.image").slice(3, $("div.image").length).hide();
    $("#hideMediaimage").hide();
    $("#loadMediaimage").show();
  });
});
$(function () {
  $("div.video").slice(3).hide();

  if ($("div.video").length < 4) {
    $("#loadMediavideo").hide();
    $("#hideMediavideo").hide();
  }

  $("#hideMediavideo").hide();
  $("#loadMediavideo").on('click', function (e) {
    e.preventDefault();
    $("div.video:hidden").slice(0, 3).slideDown();
    $("#hideMediavideo").show();

    if ($("div.video:hidden").length === 0) {
      $("#loadMediavideo").hide();
      $("#hideMediavideo").show();
    }
  });
  $("#hideMediavideo").on('click', function (e) {
    e.preventDefault();
    $("div.video").slice(3, $("div.video").length).hide();
    $("#hideMediavideo").hide();
    $("#loadMediavideo").show();
  });
});
var $collectionHolder; // setup an "add a tag" link

var $addTagButton = $('<button type="button" class="btn btn-outline-primary">Ajoutez une video</button>');
var $newLinkLi = $("<li></li>").append($addTagButton);
$(function () {
  // Get the ul that holds the collection of tags
  $collectionHolder = $("ul.videos");
  $collectionHolder.find("li").each(function () {
    addTagFormDeleteLink($(this));
  }); // add the "add a tag" anchor and li to the tags ul

  $collectionHolder.append($newLinkLi); // count the current form inputs we have (e.g. 2), use that as the new
  // index when inserting a new item (e.g. 2)

  $collectionHolder.data("index", $collectionHolder.find("input").length);
  $addTagButton.on("click", function (e) {
    // add a new tag form (see next code block)
    addTagForm($collectionHolder, $newLinkLi);
  });
  $removeTagButton.on("click", function (e) {
    // add a new tag form (see next code block)
    removeTagForm($collectionHolder, $removeLinkLi);
  });
});

function addTagForm($collectionHolder, $newLinkLi) {
  // Get the data-prototype explained earlier
  var prototype = $collectionHolder.data("prototype"); // get the new index

  var index = $collectionHolder.data("index");
  var newForm = prototype; // You need this only if you didn't set 'label' => false in your tags field in TaskType
  // Replace '__name__label__' in the prototype's HTML to
  // instead be a number based on how many items we have
  // newForm = newForm.replace(/__name__label__/g, index);
  // Replace '__name__' in the prototype's HTML to
  // instead be a number based on how many items we have

  newForm = newForm.replace(/__name__/g, index); // increase the index with one for the next item

  $collectionHolder.data("index", index + 1); // Display the form in the page in an li, before the "Add a tag" link li

  var $newFormLi = $("<li></li>").append(newForm);
  $newLinkLi.before($newFormLi);
  addTagFormDeleteLink($newFormLi);
}

function addTagFormDeleteLink($tagFormLi) {
  var $removeFormButton = $('<button type="button" class="btn btn-outline-primary my-2">Supprimez une video</button>');
  $tagFormLi.append($removeFormButton);
  $removeFormButton.on("click", function (e) {
    // remove the li for the tag form
    $tagFormLi.remove();
  });
}

/***/ }),

/***/ "./assets/bootstrap.js":
/*!*****************************!*\
  !*** ./assets/bootstrap.js ***!
  \*****************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "app": () => (/* binding */ app)
/* harmony export */ });
/* harmony import */ var _symfony_stimulus_bridge__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @symfony/stimulus-bridge */ "./node_modules/@symfony/stimulus-bridge/dist/index.js");
 // Registers Stimulus controllers from controllers.json and in the controllers/ directory

var app = (0,_symfony_stimulus_bridge__WEBPACK_IMPORTED_MODULE_0__.startStimulusApp)(__webpack_require__("./assets/controllers sync recursive ./node_modules/@symfony/stimulus-bridge/lazy-controller-loader.js! \\.[jt]sx?$")); // register any custom, 3rd party controllers here
// app.register('some_controller_name', SomeImportedController);

/***/ }),

/***/ "./assets/styles/app.scss":
/*!********************************!*\
  !*** ./assets/styles/app.scss ***!
  \********************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./assets/images/flore.png":
/*!*********************************!*\
  !*** ./assets/images/flore.png ***!
  \*********************************/
/***/ ((module, __unused_webpack_exports, __webpack_require__) => {

"use strict";
module.exports = __webpack_require__.p + "images/flore.02a8017e.png";

/***/ })

},
/******/ __webpack_require__ => { // webpackRuntimeModules
/******/ var __webpack_exec__ = (moduleId) => (__webpack_require__(__webpack_require__.s = moduleId))
/******/ __webpack_require__.O(0, ["vendors-node_modules_symfony_stimulus-bridge_dist_index_js-node_modules_bootstrap_dist_js_boo-99a480"], () => (__webpack_exec__("./assets/app.js")));
/******/ var __webpack_exports__ = __webpack_require__.O();
/******/ }
]);
//# sourceMappingURL=data:application/json;charset=utf-8;base64,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LENBQUNFLHlJQUFELENBQTVCLEVBTVA7QUFDQTs7Ozs7Ozs7Ozs7O0FDVkEiLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vIFxcLihqJTdDdClzeCIsIndlYnBhY2s6Ly8vIFxcLltqdF1zeCIsIndlYnBhY2s6Ly8vLi9hc3NldHMvY29udHJvbGxlcnMuanNvbiIsIndlYnBhY2s6Ly8vLi9hc3NldHMvY29udHJvbGxlcnMvaGVsbG9fY29udHJvbGxlci5qcyIsIndlYnBhY2s6Ly8vLi9hc3NldHMvYXBwLmpzIiwid2VicGFjazovLy8uL2Fzc2V0cy9ib290c3RyYXAuanMiLCJ3ZWJwYWNrOi8vLy4vYXNzZXRzL3N0eWxlcy9hcHAuc2NzcyJdLCJzb3VyY2VzQ29udGVudCI6WyJ2YXIgbWFwID0ge1xuXHRcIi4vaGVsbG9fY29udHJvbGxlci5qc1wiOiBcIi4vbm9kZV9tb2R1bGVzL0BzeW1mb255L3N0aW11bHVzLWJyaWRnZS9sYXp5LWNvbnRyb2xsZXItbG9hZGVyLmpzIS4vYXNzZXRzL2NvbnRyb2xsZXJzL2hlbGxvX2NvbnRyb2xsZXIuanNcIlxufTtcblxuXG5mdW5jdGlvbiB3ZWJwYWNrQ29udGV4dChyZXEpIHtcblx0dmFyIGlkID0gd2VicGFja0NvbnRleHRSZXNvbHZlKHJlcSk7XG5cdHJldHVybiBfX3dlYnBhY2tfcmVxdWlyZV9fKGlkKTtcbn1cbmZ1bmN0aW9uIHdlYnBhY2tDb250ZXh0UmVzb2x2ZShyZXEpIHtcblx0aWYoIV9fd2VicGFja19yZXF1aXJlX18ubyhtYXAsIHJlcSkpIHtcblx0XHR2YXIgZSA9IG5ldyBFcnJvcihcIkNhbm5vdCBmaW5kIG1vZHVsZSAnXCIgKyByZXEgKyBcIidcIik7XG5cdFx0ZS5jb2RlID0gJ01PRFVMRV9OT1RfRk9VTkQnO1xuXHRcdHRocm93IGU7XG5cdH1cblx0cmV0dXJuIG1hcFtyZXFdO1xufVxud2VicGFja0NvbnRleHQua2V5cyA9IGZ1bmN0aW9uIHdlYnBhY2tDb250ZXh0S2V5cygpIHtcblx0cmV0dXJuIE9iamVjdC5rZXlzKG1hcCk7XG59O1xud2VicGFja0NvbnRleHQucmVzb2x2ZSA9IHdlYnBhY2tDb250ZXh0UmVzb2x2ZTtcbm1vZHVsZS5leHBvcnRzID0gd2VicGFja0NvbnRleHQ7XG53ZWJwYWNrQ29udGV4dC5pZCA9IFwiLi9hc3NldHMvY29udHJvbGxlcnMgc3luYyByZWN1cnNpdmUgLi9ub2RlX21vZHVsZXMvQHN5bWZvbnkvc3RpbXVsdXMtYnJpZGdlL2xhenktY29udHJvbGxlci1sb2FkZXIuanMhIFxcXFwuKGolN0N0KXN4PyRcIjsiLCJ2YXIgbWFwID0ge1xuXHRcIi4vaGVsbG9fY29udHJvbGxlci5qc1wiOiBcIi4vbm9kZV9tb2R1bGVzL0BzeW1mb255L3N0aW11bHVzLWJyaWRnZS9sYXp5LWNvbnRyb2xsZXItbG9hZGVyLmpzIS4vYXNzZXRzL2NvbnRyb2xsZXJzL2hlbGxvX2NvbnRyb2xsZXIuanNcIlxufTtcblxuXG5mdW5jdGlvbiB3ZWJwYWNrQ29udGV4dChyZXEpIHtcblx0dmFyIGlkID0gd2VicGFja0NvbnRleHRSZXNvbHZlKHJlcSk7XG5cdHJldHVybiBfX3dlYnBhY2tfcmVxdWlyZV9fKGlkKTtcbn1cbmZ1bmN0aW9uIHdlYnBhY2tDb250ZXh0UmVzb2x2ZShyZXEpIHtcblx0aWYoIV9fd2VicGFja19yZXF1aXJlX18ubyhtYXAsIHJlcSkpIHtcblx0XHR2YXIgZSA9IG5ldyBFcnJvcihcIkNhbm5vdCBmaW5kIG1vZHVsZSAnXCIgKyByZXEgKyBcIidcIik7XG5cdFx0ZS5jb2RlID0gJ01PRFVMRV9OT1RfRk9VTkQnO1xuXHRcdHRocm93IGU7XG5cdH1cblx0cmV0dXJuIG1hcFtyZXFdO1xufVxud2VicGFja0NvbnRleHQua2V5cyA9IGZ1bmN0aW9uIHdlYnBhY2tDb250ZXh0S2V5cygpIHtcblx0cmV0dXJuIE9iamVjdC5rZXlzKG1hcCk7XG59O1xud2VicGFja0NvbnRleHQucmVzb2x2ZSA9IHdlYnBhY2tDb250ZXh0UmVzb2x2ZTtcbm1vZHVsZS5leHBvcnRzID0gd2VicGFja0NvbnRleHQ7XG53ZWJwYWNrQ29udGV4dC5pZCA9IFwiLi9hc3NldHMvY29udHJvbGxlcnMgc3luYyByZWN1cnNpdmUgLi9ub2RlX21vZHVsZXMvQHN5bWZvbnkvc3RpbXVsdXMtYnJpZGdlL2xhenktY29udHJvbGxlci1sb2FkZXIuanMhIFxcXFwuW2p0XXN4PyRcIjsiLCJleHBvcnQgZGVmYXVsdCB7XG59OyIsImltcG9ydCB7IENvbnRyb2xsZXIgfSBmcm9tICdAaG90d2lyZWQvc3RpbXVsdXMnO1xuXG4vKlxuICogVGhpcyBpcyBhbiBleGFtcGxlIFN0aW11bHVzIGNvbnRyb2xsZXIhXG4gKlxuICogQW55IGVsZW1lbnQgd2l0aCBhIGRhdGEtY29udHJvbGxlcj1cImhlbGxvXCIgYXR0cmlidXRlIHdpbGwgY2F1c2VcbiAqIHRoaXMgY29udHJvbGxlciB0byBiZSBleGVjdXRlZC4gVGhlIG5hbWUgXCJoZWxsb1wiIGNvbWVzIGZyb20gdGhlIGZpbGVuYW1lOlxuICogaGVsbG9fY29udHJvbGxlci5qcyAtPiBcImhlbGxvXCJcbiAqXG4gKiBEZWxldGUgdGhpcyBmaWxlIG9yIGFkYXB0IGl0IGZvciB5b3VyIHVzZSFcbiAqL1xuZXhwb3J0IGRlZmF1bHQgY2xhc3MgZXh0ZW5kcyBDb250cm9sbGVyIHtcbiAgICBjb25uZWN0KCkge1xuICAgICAgICB0aGlzLmVsZW1lbnQudGV4dENvbnRlbnQgPSAnSGVsbG8gU3RpbXVsdXMhIEVkaXQgbWUgaW4gYXNzZXRzL2NvbnRyb2xsZXJzL2hlbGxvX2NvbnRyb2xsZXIuanMnO1xuICAgIH1cbn1cbiIsIi8qXG4gKiBXZWxjb21lIHRvIHlvdXIgYXBwJ3MgbWFpbiBKYXZhU2NyaXB0IGZpbGUhXG4gKlxuICogV2UgcmVjb21tZW5kIGluY2x1ZGluZyB0aGUgYnVpbHQgdmVyc2lvbiBvZiB0aGlzIEphdmFTY3JpcHQgZmlsZVxuICogKGFuZCBpdHMgQ1NTIGZpbGUpIGluIHlvdXIgYmFzZSBsYXlvdXQgKGJhc2UuaHRtbC50d2lnKS5cbiAqL1xuaW1wb3J0ICogYXMgYm9vdHN0cmFwIGZyb20gJ2Jvb3RzdHJhcCc7XG4vLyBhbnkgQ1NTIHlvdSBpbXBvcnQgd2lsbCBvdXRwdXQgaW50byBhIHNpbmdsZSBjc3MgZmlsZSAoYXBwLmNzcyBpbiB0aGlzIGNhc2UpXG5pbXBvcnQgJy4vc3R5bGVzL2FwcC5zY3NzJztcbmltcG9ydCB7IHN0YXJ0U3RpbXVsdXNBcHAgfSBmcm9tICdAc3ltZm9ueS9zdGltdWx1cy1icmlkZ2UnO1xuXG5leHBvcnQgY29uc3QgYXBwID0gc3RhcnRTdGltdWx1c0FwcChyZXF1aXJlLmNvbnRleHQoXG4gICAgJ0BzeW1mb255L3N0aW11bHVzLWJyaWRnZS9sYXp5LWNvbnRyb2xsZXItbG9hZGVyIS4vY29udHJvbGxlcnMnLFxuICAgIHRydWUsXG4gICAgL1xcLihqfHQpc3g/JC9cbikpO1xuXG5pbXBvcnQgbG9nb1BhdGggZnJvbSAnLi9pbWFnZXMvZmxvcmUucG5nJztcblxuaW1wb3J0IHsgVG9vbHRpcCwgVG9hc3QsIFBvcG92ZXIgfSBmcm9tICdib290c3RyYXAnO1xuLy8gc3RhcnQgdGhlIFN0aW11bHVzIGFwcGxpY2F0aW9uXG5pbXBvcnQgJy4vYm9vdHN0cmFwJztcblxuLy9mb3IgbW9kYWwgYm9vdHN0cmFwXG5jb25zdCBjb250YWluZXIgPSBkb2N1bWVudC5nZXRFbGVtZW50QnlJZChcImV4YW1wbGVNb2RhbFwiKTtcbmNvbnN0IG1vZGFsID0gbmV3IGJvb3RzdHJhcC5Nb2RhbChjb250YWluZXIpO1xuXG5kb2N1bWVudC5nZXRFbGVtZW50QnlJZChcIm15SW5wdXRcIikuYWRkRXZlbnRMaXN0ZW5lcihcImNsaWNrXCIsIGZ1bmN0aW9uICgpIHtcbiAgICBtb2RhbC5zaG93KCk7XG59KTtcbmRvY3VtZW50LmdldEVsZW1lbnRCeUlkKFwiY2xvc2VcIikuYWRkRXZlbnRMaXN0ZW5lcihcImNsaWNrXCIsIGZ1bmN0aW9uICgpIHtcbiAgICBtb2RhbC5oaWRlKCk7XG59KTtcbmRvY3VtZW50LmdldEVsZW1lbnRCeUlkKFwiY2xvc2VGb290ZXJcIikuYWRkRXZlbnRMaXN0ZW5lcihcImNsaWNrXCIsIGZ1bmN0aW9uICgpIHtcbiAgICBtb2RhbC5oaWRlKCk7XG59KTtcblxuXG5jb25zdCAkID0gcmVxdWlyZSgnanF1ZXJ5Jyk7XG4vL2ZvciBsZXNzIG9yIG1vcmUgcG9zdCBpbiBob21lXG4kKGZ1bmN0aW9uICgpIHtcbiAgICAkKFwiZGl2LnBvc3RzXCIpLnNsaWNlKDQpLmhpZGUoKTtcbiAgICAkKFwiI2xvYWRMZXNzUG9zdFwiKS5oaWRlKFwic2xvd1wiKTtcbiAgICAkKFwiI2xvYWRNb3JlUG9zdFwiKS5vbignY2xpY2snLCBmdW5jdGlvbihlKXtcbiAgICAgICAgZS5wcmV2ZW50RGVmYXVsdCgpO1xuICAgICAgICAkKFwiZGl2LnBvc3RzOmhpZGRlblwiKS5zbGljZSgwLCA0KS5zbGlkZURvd24oKTtcbiAgICAgICAgaWYgKCQoXCJkaXYucG9zdHM6aGlkZGVuXCIpLmxlbmd0aCA9PT0gMCkge1xuICAgICAgICAgICAgJChcIiNsb2FkTW9yZVBvc3RcIikuaGlkZShcInNsb3dcIik7XG4gICAgICAgICAgICAkKFwiI2xvYWRMZXNzUG9zdFwiKS5zaG93KFwic2xvd1wiKTtcbiAgICAgICAgfVxuICAgIH0pO1xuICAgICQoXCIjbG9hZExlc3NQb3N0XCIpLm9uKCdjbGljaycsIGZ1bmN0aW9uKGUpe1xuICAgICAgICBlLnByZXZlbnREZWZhdWx0KCk7XG4gICAgICAgICQoXCJkaXYucG9zdHNcIikuc2xpY2UoNCwgJChcImRpdi5wb3N0c1wiKS5sZW5ndGgpLmhpZGUoKTtcbiAgICAgICAgJChcIiNsb2FkTGVzc1Bvc3RcIikuaGlkZShcInNsb3dcIik7XG4gICAgICAgICQoXCIjbG9hZE1vcmVQb3N0XCIpLnNob3coXCJzbG93XCIpO1xuXG4gICAgfSk7XG59KTtcblxuLy9waG90byBoaWRlIGFuZCBzaG93IGluIGNvbW1lbnQvcG9zdC5odG1sLnR3aWcgYW5kIHVzZXIvc2hvdy5odG1sLnR3aWcgdGVtcGxhdGVcbiQoZnVuY3Rpb24gKCl7XG4gICAgJChcImRpdi5pbWFnZVwiKS5zbGljZSgzKS5oaWRlKCk7XG4gICAgaWYgKCQoXCJkaXYuaW1hZ2VcIikubGVuZ3RoIDwgNCkge1xuICAgICAgICAkKFwiI2xvYWRNZWRpYWltYWdlXCIpLmhpZGUoKTtcbiAgICAgICAgJChcIiNoaWRlTWVkaWFpbWFnZVwiKS5oaWRlKCk7XG4gICAgfVxuICAgICQoXCIjaGlkZU1lZGlhaW1hZ2VcIikuaGlkZSgpO1xuICAgICQoXCIjbG9hZE1lZGlhaW1hZ2VcIikub24oJ2NsaWNrJywgZnVuY3Rpb24oZSl7XG4gICAgICAgIGUucHJldmVudERlZmF1bHQoKTtcbiAgICAgICAgJChcImRpdi5pbWFnZTpoaWRkZW5cIikuc2xpY2UoMCwgMykuc2xpZGVEb3duKCk7XG4gICAgICAgICQoXCIjaGlkZU1lZGlhaW1hZ2VcIikuc2hvdygpO1xuICAgICAgICBpZiAoJChcImRpdi5pbWFnZTpoaWRkZW5cIikubGVuZ3RoID09PSAwKSB7XG4gICAgICAgICAgICAkKFwiI2xvYWRNZWRpYWltYWdlXCIpLmhpZGUoKTtcbiAgICAgICAgICAgICQoXCIjaGlkZU1lZGlhaW1hZ2VcIikuc2hvdygpO1xuICAgICAgICB9XG4gICAgfSk7XG4gICAgJChcIiNoaWRlTWVkaWFpbWFnZVwiKS5vbignY2xpY2snLCBmdW5jdGlvbihlKXtcbiAgICAgICAgZS5wcmV2ZW50RGVmYXVsdCgpO1xuICAgICAgICAkKFwiZGl2LmltYWdlXCIpLnNsaWNlKDMsICQoXCJkaXYuaW1hZ2VcIikubGVuZ3RoKS5oaWRlKCk7XG4gICAgICAgICQoXCIjaGlkZU1lZGlhaW1hZ2VcIikuaGlkZSgpO1xuICAgICAgICAkKFwiI2xvYWRNZWRpYWltYWdlXCIpLnNob3coKTtcbiAgICB9KTtcbn0pO1xuXG4kKGZ1bmN0aW9uICgpe1xuICAgICQoXCJkaXYudmlkZW9cIikuc2xpY2UoMykuaGlkZSgpO1xuICAgIGlmICgkKFwiZGl2LnZpZGVvXCIpLmxlbmd0aCA8IDQpIHtcbiAgICAgICAgJChcIiNsb2FkTWVkaWF2aWRlb1wiKS5oaWRlKCk7XG4gICAgICAgICQoXCIjaGlkZU1lZGlhdmlkZW9cIikuaGlkZSgpO1xuICAgIH1cbiAgICAkKFwiI2hpZGVNZWRpYXZpZGVvXCIpLmhpZGUoKTtcbiAgICAkKFwiI2xvYWRNZWRpYXZpZGVvXCIpLm9uKCdjbGljaycsIGZ1bmN0aW9uKGUpe1xuICAgICAgICBlLnByZXZlbnREZWZhdWx0KCk7XG4gICAgICAgICQoXCJkaXYudmlkZW86aGlkZGVuXCIpLnNsaWNlKDAsIDMpLnNsaWRlRG93bigpO1xuICAgICAgICAkKFwiI2hpZGVNZWRpYXZpZGVvXCIpLnNob3coKTtcbiAgICAgICAgaWYgKCQoXCJkaXYudmlkZW86aGlkZGVuXCIpLmxlbmd0aCA9PT0gMCkge1xuICAgICAgICAgICAgJChcIiNsb2FkTWVkaWF2aWRlb1wiKS5oaWRlKCk7XG4gICAgICAgICAgICAkKFwiI2hpZGVNZWRpYXZpZGVvXCIpLnNob3coKTtcbiAgICAgICAgfVxuICAgIH0pO1xuICAgICQoXCIjaGlkZU1lZGlhdmlkZW9cIikub24oJ2NsaWNrJywgZnVuY3Rpb24oZSl7XG4gICAgICAgIGUucHJldmVudERlZmF1bHQoKTtcbiAgICAgICAgJChcImRpdi52aWRlb1wiKS5zbGljZSgzLCAkKFwiZGl2LnZpZGVvXCIpLmxlbmd0aCkuaGlkZSgpO1xuICAgICAgICAkKFwiI2hpZGVNZWRpYXZpZGVvXCIpLmhpZGUoKTtcbiAgICAgICAgJChcIiNsb2FkTWVkaWF2aWRlb1wiKS5zaG93KCk7XG4gICAgfSk7XG59KTtcblxudmFyICRjb2xsZWN0aW9uSG9sZGVyO1xuXG4vLyBzZXR1cCBhbiBcImFkZCBhIHRhZ1wiIGxpbmtcbnZhciAkYWRkVGFnQnV0dG9uID0gJCgnPGJ1dHRvbiB0eXBlPVwiYnV0dG9uXCIgY2xhc3M9XCJidG4gYnRuLW91dGxpbmUtcHJpbWFyeVwiPkFqb3V0ZXogdW5lIHZpZGVvPC9idXR0b24+Jyk7XG52YXIgJG5ld0xpbmtMaSA9ICQoXCI8bGk+PC9saT5cIikuYXBwZW5kKCRhZGRUYWdCdXR0b24pO1xuXG4kKGZ1bmN0aW9uKCkge1xuICAgIC8vIEdldCB0aGUgdWwgdGhhdCBob2xkcyB0aGUgY29sbGVjdGlvbiBvZiB0YWdzXG4gICAgJGNvbGxlY3Rpb25Ib2xkZXIgPSAkKFwidWwudmlkZW9zXCIpO1xuXG4gICAgJGNvbGxlY3Rpb25Ib2xkZXIuZmluZChcImxpXCIpLmVhY2goZnVuY3Rpb24oKSB7XG4gICAgICAgIGFkZFRhZ0Zvcm1EZWxldGVMaW5rKCQodGhpcykpO1xuICAgIH0pO1xuXG4gICAgLy8gYWRkIHRoZSBcImFkZCBhIHRhZ1wiIGFuY2hvciBhbmQgbGkgdG8gdGhlIHRhZ3MgdWxcbiAgICAkY29sbGVjdGlvbkhvbGRlci5hcHBlbmQoJG5ld0xpbmtMaSk7XG4gICAgIFxuXG4gICAgLy8gY291bnQgdGhlIGN1cnJlbnQgZm9ybSBpbnB1dHMgd2UgaGF2ZSAoZS5nLiAyKSwgdXNlIHRoYXQgYXMgdGhlIG5ld1xuICAgIC8vIGluZGV4IHdoZW4gaW5zZXJ0aW5nIGEgbmV3IGl0ZW0gKGUuZy4gMilcbiAgICAkY29sbGVjdGlvbkhvbGRlci5kYXRhKFwiaW5kZXhcIiwgJGNvbGxlY3Rpb25Ib2xkZXIuZmluZChcImlucHV0XCIpLmxlbmd0aCk7XG5cbiAgICAkYWRkVGFnQnV0dG9uLm9uKFwiY2xpY2tcIiwgZnVuY3Rpb24oZSkge1xuICAgICAgICAvLyBhZGQgYSBuZXcgdGFnIGZvcm0gKHNlZSBuZXh0IGNvZGUgYmxvY2spXG4gICAgICAgIGFkZFRhZ0Zvcm0oJGNvbGxlY3Rpb25Ib2xkZXIsICRuZXdMaW5rTGkpO1xuICAgIH0pO1xuXG4gICAgJHJlbW92ZVRhZ0J1dHRvbi5vbihcImNsaWNrXCIsIGZ1bmN0aW9uKGUpIHtcbiAgICAgICAgLy8gYWRkIGEgbmV3IHRhZyBmb3JtIChzZWUgbmV4dCBjb2RlIGJsb2NrKVxuICAgICAgICByZW1vdmVUYWdGb3JtKCRjb2xsZWN0aW9uSG9sZGVyLCAkcmVtb3ZlTGlua0xpKTtcbiAgICB9KTtcbn0pO1xuZnVuY3Rpb24gYWRkVGFnRm9ybSgkY29sbGVjdGlvbkhvbGRlciwgJG5ld0xpbmtMaSkge1xuICAgIC8vIEdldCB0aGUgZGF0YS1wcm90b3R5cGUgZXhwbGFpbmVkIGVhcmxpZXJcbiAgICB2YXIgcHJvdG90eXBlID0gJGNvbGxlY3Rpb25Ib2xkZXIuZGF0YShcInByb3RvdHlwZVwiKTtcblxuICAgIFxuICAgIC8vIGdldCB0aGUgbmV3IGluZGV4XG4gICAgdmFyIGluZGV4ID0gJGNvbGxlY3Rpb25Ib2xkZXIuZGF0YShcImluZGV4XCIpO1xuXG4gICAgdmFyIG5ld0Zvcm0gPSBwcm90b3R5cGU7XG4gICAgLy8gWW91IG5lZWQgdGhpcyBvbmx5IGlmIHlvdSBkaWRuJ3Qgc2V0ICdsYWJlbCcgPT4gZmFsc2UgaW4geW91ciB0YWdzIGZpZWxkIGluIFRhc2tUeXBlXG4gICAgLy8gUmVwbGFjZSAnX19uYW1lX19sYWJlbF9fJyBpbiB0aGUgcHJvdG90eXBlJ3MgSFRNTCB0b1xuICAgIC8vIGluc3RlYWQgYmUgYSBudW1iZXIgYmFzZWQgb24gaG93IG1hbnkgaXRlbXMgd2UgaGF2ZVxuICAgIC8vIG5ld0Zvcm0gPSBuZXdGb3JtLnJlcGxhY2UoL19fbmFtZV9fbGFiZWxfXy9nLCBpbmRleCk7XG5cbiAgICAvLyBSZXBsYWNlICdfX25hbWVfXycgaW4gdGhlIHByb3RvdHlwZSdzIEhUTUwgdG9cbiAgICAvLyBpbnN0ZWFkIGJlIGEgbnVtYmVyIGJhc2VkIG9uIGhvdyBtYW55IGl0ZW1zIHdlIGhhdmVcbiAgICBuZXdGb3JtID0gbmV3Rm9ybS5yZXBsYWNlKC9fX25hbWVfXy9nLCBpbmRleCk7XG5cbiAgICAvLyBpbmNyZWFzZSB0aGUgaW5kZXggd2l0aCBvbmUgZm9yIHRoZSBuZXh0IGl0ZW1cbiAgICAkY29sbGVjdGlvbkhvbGRlci5kYXRhKFwiaW5kZXhcIiwgaW5kZXggKyAxKTtcblxuICAgIC8vIERpc3BsYXkgdGhlIGZvcm0gaW4gdGhlIHBhZ2UgaW4gYW4gbGksIGJlZm9yZSB0aGUgXCJBZGQgYSB0YWdcIiBsaW5rIGxpXG4gICAgdmFyICRuZXdGb3JtTGkgPSAkKFwiPGxpPjwvbGk+XCIpLmFwcGVuZChuZXdGb3JtKTtcbiAgICAkbmV3TGlua0xpLmJlZm9yZSgkbmV3Rm9ybUxpKTtcbiAgICBhZGRUYWdGb3JtRGVsZXRlTGluaygkbmV3Rm9ybUxpKTtcbn1cblxuZnVuY3Rpb24gYWRkVGFnRm9ybURlbGV0ZUxpbmsoJHRhZ0Zvcm1MaSkge1xuICAgIHZhciAkcmVtb3ZlRm9ybUJ1dHRvbiA9ICQoJzxidXR0b24gdHlwZT1cImJ1dHRvblwiIGNsYXNzPVwiYnRuIGJ0bi1vdXRsaW5lLXByaW1hcnkgbXktMlwiPlN1cHByaW1leiB1bmUgdmlkZW88L2J1dHRvbj4nKTtcbiAgICAkdGFnRm9ybUxpLmFwcGVuZCgkcmVtb3ZlRm9ybUJ1dHRvbik7XG5cbiAgICAkcmVtb3ZlRm9ybUJ1dHRvbi5vbihcImNsaWNrXCIsIGZ1bmN0aW9uKGUpIHtcbiAgICAgICAgLy8gcmVtb3ZlIHRoZSBsaSBmb3IgdGhlIHRhZyBmb3JtXG4gICAgICAgICR0YWdGb3JtTGkucmVtb3ZlKCk7XG4gICAgfSk7XG59IiwiaW1wb3J0IHsgc3RhcnRTdGltdWx1c0FwcCB9IGZyb20gJ0BzeW1mb255L3N0aW11bHVzLWJyaWRnZSc7XG5cbi8vIFJlZ2lzdGVycyBTdGltdWx1cyBjb250cm9sbGVycyBmcm9tIGNvbnRyb2xsZXJzLmpzb24gYW5kIGluIHRoZSBjb250cm9sbGVycy8gZGlyZWN0b3J5XG5leHBvcnQgY29uc3QgYXBwID0gc3RhcnRTdGltdWx1c0FwcChyZXF1aXJlLmNvbnRleHQoXG4gICAgJ0BzeW1mb255L3N0aW11bHVzLWJyaWRnZS9sYXp5LWNvbnRyb2xsZXItbG9hZGVyIS4vY29udHJvbGxlcnMnLFxuICAgIHRydWUsXG4gICAgL1xcLltqdF1zeD8kL1xuKSk7XG5cbi8vIHJlZ2lzdGVyIGFueSBjdXN0b20sIDNyZCBwYXJ0eSBjb250cm9sbGVycyBoZXJlXG4vLyBhcHAucmVnaXN0ZXIoJ3NvbWVfY29udHJvbGxlcl9uYW1lJywgU29tZUltcG9ydGVkQ29udHJvbGxlcik7XG4iLCIvLyBleHRyYWN0ZWQgYnkgbWluaS1jc3MtZXh0cmFjdC1wbHVnaW5cbmV4cG9ydCB7fTsiXSwibmFtZXMiOlsiQ29udHJvbGxlciIsImVsZW1lbnQiLCJ0ZXh0Q29udGVudCIsImJvb3RzdHJhcCIsInN0YXJ0U3RpbXVsdXNBcHAiLCJhcHAiLCJyZXF1aXJlIiwiY29udGV4dCIsImxvZ29QYXRoIiwiVG9vbHRpcCIsIlRvYXN0IiwiUG9wb3ZlciIsImNvbnRhaW5lciIsImRvY3VtZW50IiwiZ2V0RWxlbWVudEJ5SWQiLCJtb2RhbCIsIk1vZGFsIiwiYWRkRXZlbnRMaXN0ZW5lciIsInNob3ciLCJoaWRlIiwiJCIsInNsaWNlIiwib24iLCJlIiwicHJldmVudERlZmF1bHQiLCJzbGlkZURvd24iLCJsZW5ndGgiLCIkY29sbGVjdGlvbkhvbGRlciIsIiRhZGRUYWdCdXR0b24iLCIkbmV3TGlua0xpIiwiYXBwZW5kIiwiZmluZCIsImVhY2giLCJhZGRUYWdGb3JtRGVsZXRlTGluayIsImRhdGEiLCJhZGRUYWdGb3JtIiwiJHJlbW92ZVRhZ0J1dHRvbiIsInJlbW92ZVRhZ0Zvcm0iLCIkcmVtb3ZlTGlua0xpIiwicHJvdG90eXBlIiwiaW5kZXgiLCJuZXdGb3JtIiwicmVwbGFjZSIsIiRuZXdGb3JtTGkiLCJiZWZvcmUiLCIkdGFnRm9ybUxpIiwiJHJlbW92ZUZvcm1CdXR0b24iLCJyZW1vdmUiXSwic291cmNlUm9vdCI6IiJ9