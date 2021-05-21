/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
var __webpack_exports__ = {};
// This entry need to be wrapped in an IIFE because it uses a non-standard name for the exports (exports).
(() => {
var exports = __webpack_exports__;
/*!***********************************!*\
  !*** ./resources/js/component.ts ***!
  \***********************************/


function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }

Object.defineProperty(exports, "__esModule", ({
  value: true
}));
exports.Component = void 0;

var Component = /*#__PURE__*/function () {
  function Component(state) {
    _classCallCheck(this, Component);

    this.state = state;
    var refObj = {};
    var component = this;
    this.proxy = new Proxy(refObj, {
      get: function get(object, property) {
        if (Object.keys(component.state).includes(property)) {
          return component.state[property];
        }

        return function () {
          for (var _len = arguments.length, args = new Array(_len), _key = 0; _key < _len; _key++) {
            args[_key] = arguments[_key];
          }

          return component.call.apply(component, [property].concat(args));
        }; // if state has it, return it
        // otherwise it's a method
      },
      set: function set(obj, prop, value) {
        component.update(prop, value);
        return true;
      }
    });
  }

  _createClass(Component, [{
    key: "update",
    value: function update(property, value) {// update locally
      // set loading
      // send request
    }
  }, {
    key: "call",
    value: function call(method) {
      var _this = this;

      for (var _len2 = arguments.length, args = new Array(_len2 > 1 ? _len2 - 1 : 0), _key2 = 1; _key2 < _len2; _key2++) {
        args[_key2 - 1] = arguments[_key2];
      }

      // todo custom route
      return fetch('/components/filter/abc', {
        method: 'POST',
        body: JSON.stringify({
          state: this.state,
          changes: [],
          calls: _defineProperty({}, method, args)
        })
      }).then(function (response) {
        return response.json().then(function (json) {
          var _a;

          _this.state = json.data;
          return (_a = json.metadata.calls[method]) !== null && _a !== void 0 ? _a : null;
        });
      });
    }
  }]);

  return Component;
}();

exports.Component = Component; // export function component(alias: string, initialState: any) {
//     // todo use alias here....
//     return new Component(initialState).proxy;
// }
})();

/******/ })()
;