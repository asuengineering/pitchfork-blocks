/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "@wordpress/compose":
/*!*********************************!*\
  !*** external ["wp","compose"] ***!
  \*********************************/
/***/ ((module) => {

module.exports = window["wp"]["compose"];

/***/ }),

/***/ "@wordpress/hooks":
/*!*******************************!*\
  !*** external ["wp","hooks"] ***!
  \*******************************/
/***/ ((module) => {

module.exports = window["wp"]["hooks"];

/***/ }),

/***/ "react":
/*!************************!*\
  !*** external "React" ***!
  \************************/
/***/ ((module) => {

module.exports = window["React"];

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/compat get default export */
/******/ 	(() => {
/******/ 		// getDefaultExport function for compatibility with non-harmony modules
/******/ 		__webpack_require__.n = (module) => {
/******/ 			var getter = module && module.__esModule ?
/******/ 				() => (module['default']) :
/******/ 				() => (module);
/******/ 			__webpack_require__.d(getter, { a: getter });
/******/ 			return getter;
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/define property getters */
/******/ 	(() => {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = (exports, definition) => {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/************************************************************************/
var __webpack_exports__ = {};
// This entry needs to be wrapped in an IIFE because it needs to be isolated against other modules in the chunk.
(() => {
/*!*******************************************!*\
  !*** ./src/scripts/card-block-filters.js ***!
  \*******************************************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _wordpress_hooks__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/hooks */ "@wordpress/hooks");
/* harmony import */ var _wordpress_hooks__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_hooks__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _wordpress_compose__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @wordpress/compose */ "@wordpress/compose");
/* harmony import */ var _wordpress_compose__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_wordpress_compose__WEBPACK_IMPORTED_MODULE_2__);




/**
 * Checks for acf/card-v2. Direct inner blocks of the basic card wrapper.
 * Adds missing classes to several inner blocks associated with the pattern.
 */
const udsCardInnerMarkup = (0,_wordpress_compose__WEBPACK_IMPORTED_MODULE_2__.createHigherOrderComponent)(BlockListBlock => {
  return props => {
    const {
      name,
      attributes
    } = props;
    const testBlocks = ['core/buttons', 'core/button', 'core/group', 'core/post-featured-image', 'core/post-terms'];
    let customClass = '';
    if (!testBlocks.includes(name)) {
      return (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(BlockListBlock, {
        ...props
      });
    }

    // Define an array of allowed parent block names
    const allowedParentBlocks = ['acf/card-v2'];

    // Get the ID of the immediate parent and grandparent block.
    const parentClientId = wp.data.select('core/block-editor').getBlockParents(props.clientId, true)[0];
    const grandParentClientId = wp.data.select('core/block-editor').getBlockParents(props.clientId, true)[1];
    if (parentClientId) {
      const parentBlock = wp.data.select('core/block-editor').getBlock(parentClientId);

      // Define the class map
      const classMap = {
        'core/group': 'card-body',
        'core/buttons': 'card-buttons',
        'core/post-featured-image': 'card-img-top',
        'core/post-terms': 'card-tags'
      };

      // Apply classMap classes according to the encountered block type.
      if (parentBlock && allowedParentBlocks.includes(parentBlock.name)) {
        if (classMap.hasOwnProperty(name)) {
          customClass = classMap[name];
        }
      }
      const grandParentBlock = wp.data.select('core/block-editor').getBlock(grandParentClientId);

      // Testing for core/button as a grandchild of acf/card-v2
      if (grandParentBlock && allowedParentBlocks.includes(grandParentBlock.name)) {
        if (name === 'core/button') {
          customClass = 'card-button';
        }
      }
    }

    // Add just custom class if it's set
    if (customClass) {
      return (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(BlockListBlock, {
        ...props,
        className: customClass
      });
    }

    // If there's no parent or the parent isn't in the allowed list, keep the original class
    return (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(BlockListBlock, {
      ...props
    });
  };
}, 'udsCardInnerMarkup');
(0,_wordpress_hooks__WEBPACK_IMPORTED_MODULE_1__.addFilter)('editor.BlockListBlock', 'pf-blocks/add-v2-card-classes', udsCardInnerMarkup);

/**
 * Checks for acf/card-v2-header.
 * Adds missing classes for core/heading, core/post-title and other inner blocks.
 */
const udsCardHeaderInnerMarkup = (0,_wordpress_compose__WEBPACK_IMPORTED_MODULE_2__.createHigherOrderComponent)(BlockListBlock => {
  return props => {
    const {
      name,
      attributes
    } = props;
    const testBlocks = ['core/heading', 'core/post-title'];
    let customClass = '';
    if (!testBlocks.includes(name)) {
      return (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(BlockListBlock, {
        ...props
      });
    }

    // Define an array of allowed parent block names
    const allowedParentBlocks = ['acf/card-v2-header'];

    // Get the ID of the immediate parent and grandparent block.
    const parentClientId = wp.data.select('core/block-editor').getBlockParents(props.clientId, true)[0];
    if (parentClientId) {
      const parentBlock = wp.data.select('core/block-editor').getBlock(parentClientId);
      // console.log(parentBlock);

      // Define the class map
      const classMap = {
        'core/heading': 'card-title',
        'core/post-title': 'card-title'
      };

      // Testing for core/group, core/buttons, core/heading
      if (parentBlock && allowedParentBlocks.includes(parentBlock.name)) {
        // Check if the name exists in the classMap
        if (classMap.hasOwnProperty(name)) {
          customClass = classMap[name];
        }
      }
    }

    // Add just custom class if it's set
    if (customClass) {
      return (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(BlockListBlock, {
        ...props,
        className: customClass
      });
    }

    // If there's no parent or the parent isn't in the allowed list, keep the original class
    return (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(BlockListBlock, {
      ...props
    });
  };
}, 'udsCardInnerMarkup');
(0,_wordpress_hooks__WEBPACK_IMPORTED_MODULE_1__.addFilter)('editor.BlockListBlock', 'pf-blocks/add-v2-card-header-classes', udsCardHeaderInnerMarkup);
})();

/******/ })()
;
//# sourceMappingURL=card-block-filters.js.map