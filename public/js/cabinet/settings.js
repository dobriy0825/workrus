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
/******/ 	return __webpack_require__(__webpack_require__.s = 2);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./node_modules/@babel/runtime/regenerator/index.js":
/*!**********************************************************!*\
  !*** ./node_modules/@babel/runtime/regenerator/index.js ***!
  \**********************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! regenerator-runtime */ "./node_modules/regenerator-runtime/runtime.js");


/***/ }),

/***/ "./node_modules/regenerator-runtime/runtime.js":
/*!*****************************************************!*\
  !*** ./node_modules/regenerator-runtime/runtime.js ***!
  \*****************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

/**
 * Copyright (c) 2014-present, Facebook, Inc.
 *
 * This source code is licensed under the MIT license found in the
 * LICENSE file in the root directory of this source tree.
 */

var runtime = (function (exports) {
  "use strict";

  var Op = Object.prototype;
  var hasOwn = Op.hasOwnProperty;
  var undefined; // More compressible than void 0.
  var $Symbol = typeof Symbol === "function" ? Symbol : {};
  var iteratorSymbol = $Symbol.iterator || "@@iterator";
  var asyncIteratorSymbol = $Symbol.asyncIterator || "@@asyncIterator";
  var toStringTagSymbol = $Symbol.toStringTag || "@@toStringTag";

  function wrap(innerFn, outerFn, self, tryLocsList) {
    // If outerFn provided and outerFn.prototype is a Generator, then outerFn.prototype instanceof Generator.
    var protoGenerator = outerFn && outerFn.prototype instanceof Generator ? outerFn : Generator;
    var generator = Object.create(protoGenerator.prototype);
    var context = new Context(tryLocsList || []);

    // The ._invoke method unifies the implementations of the .next,
    // .throw, and .return methods.
    generator._invoke = makeInvokeMethod(innerFn, self, context);

    return generator;
  }
  exports.wrap = wrap;

  // Try/catch helper to minimize deoptimizations. Returns a completion
  // record like context.tryEntries[i].completion. This interface could
  // have been (and was previously) designed to take a closure to be
  // invoked without arguments, but in all the cases we care about we
  // already have an existing method we want to call, so there's no need
  // to create a new function object. We can even get away with assuming
  // the method takes exactly one argument, since that happens to be true
  // in every case, so we don't have to touch the arguments object. The
  // only additional allocation required is the completion record, which
  // has a stable shape and so hopefully should be cheap to allocate.
  function tryCatch(fn, obj, arg) {
    try {
      return { type: "normal", arg: fn.call(obj, arg) };
    } catch (err) {
      return { type: "throw", arg: err };
    }
  }

  var GenStateSuspendedStart = "suspendedStart";
  var GenStateSuspendedYield = "suspendedYield";
  var GenStateExecuting = "executing";
  var GenStateCompleted = "completed";

  // Returning this object from the innerFn has the same effect as
  // breaking out of the dispatch switch statement.
  var ContinueSentinel = {};

  // Dummy constructor functions that we use as the .constructor and
  // .constructor.prototype properties for functions that return Generator
  // objects. For full spec compliance, you may wish to configure your
  // minifier not to mangle the names of these two functions.
  function Generator() {}
  function GeneratorFunction() {}
  function GeneratorFunctionPrototype() {}

  // This is a polyfill for %IteratorPrototype% for environments that
  // don't natively support it.
  var IteratorPrototype = {};
  IteratorPrototype[iteratorSymbol] = function () {
    return this;
  };

  var getProto = Object.getPrototypeOf;
  var NativeIteratorPrototype = getProto && getProto(getProto(values([])));
  if (NativeIteratorPrototype &&
      NativeIteratorPrototype !== Op &&
      hasOwn.call(NativeIteratorPrototype, iteratorSymbol)) {
    // This environment has a native %IteratorPrototype%; use it instead
    // of the polyfill.
    IteratorPrototype = NativeIteratorPrototype;
  }

  var Gp = GeneratorFunctionPrototype.prototype =
    Generator.prototype = Object.create(IteratorPrototype);
  GeneratorFunction.prototype = Gp.constructor = GeneratorFunctionPrototype;
  GeneratorFunctionPrototype.constructor = GeneratorFunction;
  GeneratorFunctionPrototype[toStringTagSymbol] =
    GeneratorFunction.displayName = "GeneratorFunction";

  // Helper for defining the .next, .throw, and .return methods of the
  // Iterator interface in terms of a single ._invoke method.
  function defineIteratorMethods(prototype) {
    ["next", "throw", "return"].forEach(function(method) {
      prototype[method] = function(arg) {
        return this._invoke(method, arg);
      };
    });
  }

  exports.isGeneratorFunction = function(genFun) {
    var ctor = typeof genFun === "function" && genFun.constructor;
    return ctor
      ? ctor === GeneratorFunction ||
        // For the native GeneratorFunction constructor, the best we can
        // do is to check its .name property.
        (ctor.displayName || ctor.name) === "GeneratorFunction"
      : false;
  };

  exports.mark = function(genFun) {
    if (Object.setPrototypeOf) {
      Object.setPrototypeOf(genFun, GeneratorFunctionPrototype);
    } else {
      genFun.__proto__ = GeneratorFunctionPrototype;
      if (!(toStringTagSymbol in genFun)) {
        genFun[toStringTagSymbol] = "GeneratorFunction";
      }
    }
    genFun.prototype = Object.create(Gp);
    return genFun;
  };

  // Within the body of any async function, `await x` is transformed to
  // `yield regeneratorRuntime.awrap(x)`, so that the runtime can test
  // `hasOwn.call(value, "__await")` to determine if the yielded value is
  // meant to be awaited.
  exports.awrap = function(arg) {
    return { __await: arg };
  };

  function AsyncIterator(generator) {
    function invoke(method, arg, resolve, reject) {
      var record = tryCatch(generator[method], generator, arg);
      if (record.type === "throw") {
        reject(record.arg);
      } else {
        var result = record.arg;
        var value = result.value;
        if (value &&
            typeof value === "object" &&
            hasOwn.call(value, "__await")) {
          return Promise.resolve(value.__await).then(function(value) {
            invoke("next", value, resolve, reject);
          }, function(err) {
            invoke("throw", err, resolve, reject);
          });
        }

        return Promise.resolve(value).then(function(unwrapped) {
          // When a yielded Promise is resolved, its final value becomes
          // the .value of the Promise<{value,done}> result for the
          // current iteration.
          result.value = unwrapped;
          resolve(result);
        }, function(error) {
          // If a rejected Promise was yielded, throw the rejection back
          // into the async generator function so it can be handled there.
          return invoke("throw", error, resolve, reject);
        });
      }
    }

    var previousPromise;

    function enqueue(method, arg) {
      function callInvokeWithMethodAndArg() {
        return new Promise(function(resolve, reject) {
          invoke(method, arg, resolve, reject);
        });
      }

      return previousPromise =
        // If enqueue has been called before, then we want to wait until
        // all previous Promises have been resolved before calling invoke,
        // so that results are always delivered in the correct order. If
        // enqueue has not been called before, then it is important to
        // call invoke immediately, without waiting on a callback to fire,
        // so that the async generator function has the opportunity to do
        // any necessary setup in a predictable way. This predictability
        // is why the Promise constructor synchronously invokes its
        // executor callback, and why async functions synchronously
        // execute code before the first await. Since we implement simple
        // async functions in terms of async generators, it is especially
        // important to get this right, even though it requires care.
        previousPromise ? previousPromise.then(
          callInvokeWithMethodAndArg,
          // Avoid propagating failures to Promises returned by later
          // invocations of the iterator.
          callInvokeWithMethodAndArg
        ) : callInvokeWithMethodAndArg();
    }

    // Define the unified helper method that is used to implement .next,
    // .throw, and .return (see defineIteratorMethods).
    this._invoke = enqueue;
  }

  defineIteratorMethods(AsyncIterator.prototype);
  AsyncIterator.prototype[asyncIteratorSymbol] = function () {
    return this;
  };
  exports.AsyncIterator = AsyncIterator;

  // Note that simple async functions are implemented on top of
  // AsyncIterator objects; they just return a Promise for the value of
  // the final result produced by the iterator.
  exports.async = function(innerFn, outerFn, self, tryLocsList) {
    var iter = new AsyncIterator(
      wrap(innerFn, outerFn, self, tryLocsList)
    );

    return exports.isGeneratorFunction(outerFn)
      ? iter // If outerFn is a generator, return the full iterator.
      : iter.next().then(function(result) {
          return result.done ? result.value : iter.next();
        });
  };

  function makeInvokeMethod(innerFn, self, context) {
    var state = GenStateSuspendedStart;

    return function invoke(method, arg) {
      if (state === GenStateExecuting) {
        throw new Error("Generator is already running");
      }

      if (state === GenStateCompleted) {
        if (method === "throw") {
          throw arg;
        }

        // Be forgiving, per 25.3.3.3.3 of the spec:
        // https://people.mozilla.org/~jorendorff/es6-draft.html#sec-generatorresume
        return doneResult();
      }

      context.method = method;
      context.arg = arg;

      while (true) {
        var delegate = context.delegate;
        if (delegate) {
          var delegateResult = maybeInvokeDelegate(delegate, context);
          if (delegateResult) {
            if (delegateResult === ContinueSentinel) continue;
            return delegateResult;
          }
        }

        if (context.method === "next") {
          // Setting context._sent for legacy support of Babel's
          // function.sent implementation.
          context.sent = context._sent = context.arg;

        } else if (context.method === "throw") {
          if (state === GenStateSuspendedStart) {
            state = GenStateCompleted;
            throw context.arg;
          }

          context.dispatchException(context.arg);

        } else if (context.method === "return") {
          context.abrupt("return", context.arg);
        }

        state = GenStateExecuting;

        var record = tryCatch(innerFn, self, context);
        if (record.type === "normal") {
          // If an exception is thrown from innerFn, we leave state ===
          // GenStateExecuting and loop back for another invocation.
          state = context.done
            ? GenStateCompleted
            : GenStateSuspendedYield;

          if (record.arg === ContinueSentinel) {
            continue;
          }

          return {
            value: record.arg,
            done: context.done
          };

        } else if (record.type === "throw") {
          state = GenStateCompleted;
          // Dispatch the exception by looping back around to the
          // context.dispatchException(context.arg) call above.
          context.method = "throw";
          context.arg = record.arg;
        }
      }
    };
  }

  // Call delegate.iterator[context.method](context.arg) and handle the
  // result, either by returning a { value, done } result from the
  // delegate iterator, or by modifying context.method and context.arg,
  // setting context.delegate to null, and returning the ContinueSentinel.
  function maybeInvokeDelegate(delegate, context) {
    var method = delegate.iterator[context.method];
    if (method === undefined) {
      // A .throw or .return when the delegate iterator has no .throw
      // method always terminates the yield* loop.
      context.delegate = null;

      if (context.method === "throw") {
        // Note: ["return"] must be used for ES3 parsing compatibility.
        if (delegate.iterator["return"]) {
          // If the delegate iterator has a return method, give it a
          // chance to clean up.
          context.method = "return";
          context.arg = undefined;
          maybeInvokeDelegate(delegate, context);

          if (context.method === "throw") {
            // If maybeInvokeDelegate(context) changed context.method from
            // "return" to "throw", let that override the TypeError below.
            return ContinueSentinel;
          }
        }

        context.method = "throw";
        context.arg = new TypeError(
          "The iterator does not provide a 'throw' method");
      }

      return ContinueSentinel;
    }

    var record = tryCatch(method, delegate.iterator, context.arg);

    if (record.type === "throw") {
      context.method = "throw";
      context.arg = record.arg;
      context.delegate = null;
      return ContinueSentinel;
    }

    var info = record.arg;

    if (! info) {
      context.method = "throw";
      context.arg = new TypeError("iterator result is not an object");
      context.delegate = null;
      return ContinueSentinel;
    }

    if (info.done) {
      // Assign the result of the finished delegate to the temporary
      // variable specified by delegate.resultName (see delegateYield).
      context[delegate.resultName] = info.value;

      // Resume execution at the desired location (see delegateYield).
      context.next = delegate.nextLoc;

      // If context.method was "throw" but the delegate handled the
      // exception, let the outer generator proceed normally. If
      // context.method was "next", forget context.arg since it has been
      // "consumed" by the delegate iterator. If context.method was
      // "return", allow the original .return call to continue in the
      // outer generator.
      if (context.method !== "return") {
        context.method = "next";
        context.arg = undefined;
      }

    } else {
      // Re-yield the result returned by the delegate method.
      return info;
    }

    // The delegate iterator is finished, so forget it and continue with
    // the outer generator.
    context.delegate = null;
    return ContinueSentinel;
  }

  // Define Generator.prototype.{next,throw,return} in terms of the
  // unified ._invoke helper method.
  defineIteratorMethods(Gp);

  Gp[toStringTagSymbol] = "Generator";

  // A Generator should always return itself as the iterator object when the
  // @@iterator function is called on it. Some browsers' implementations of the
  // iterator prototype chain incorrectly implement this, causing the Generator
  // object to not be returned from this call. This ensures that doesn't happen.
  // See https://github.com/facebook/regenerator/issues/274 for more details.
  Gp[iteratorSymbol] = function() {
    return this;
  };

  Gp.toString = function() {
    return "[object Generator]";
  };

  function pushTryEntry(locs) {
    var entry = { tryLoc: locs[0] };

    if (1 in locs) {
      entry.catchLoc = locs[1];
    }

    if (2 in locs) {
      entry.finallyLoc = locs[2];
      entry.afterLoc = locs[3];
    }

    this.tryEntries.push(entry);
  }

  function resetTryEntry(entry) {
    var record = entry.completion || {};
    record.type = "normal";
    delete record.arg;
    entry.completion = record;
  }

  function Context(tryLocsList) {
    // The root entry object (effectively a try statement without a catch
    // or a finally block) gives us a place to store values thrown from
    // locations where there is no enclosing try statement.
    this.tryEntries = [{ tryLoc: "root" }];
    tryLocsList.forEach(pushTryEntry, this);
    this.reset(true);
  }

  exports.keys = function(object) {
    var keys = [];
    for (var key in object) {
      keys.push(key);
    }
    keys.reverse();

    // Rather than returning an object with a next method, we keep
    // things simple and return the next function itself.
    return function next() {
      while (keys.length) {
        var key = keys.pop();
        if (key in object) {
          next.value = key;
          next.done = false;
          return next;
        }
      }

      // To avoid creating an additional object, we just hang the .value
      // and .done properties off the next function object itself. This
      // also ensures that the minifier will not anonymize the function.
      next.done = true;
      return next;
    };
  };

  function values(iterable) {
    if (iterable) {
      var iteratorMethod = iterable[iteratorSymbol];
      if (iteratorMethod) {
        return iteratorMethod.call(iterable);
      }

      if (typeof iterable.next === "function") {
        return iterable;
      }

      if (!isNaN(iterable.length)) {
        var i = -1, next = function next() {
          while (++i < iterable.length) {
            if (hasOwn.call(iterable, i)) {
              next.value = iterable[i];
              next.done = false;
              return next;
            }
          }

          next.value = undefined;
          next.done = true;

          return next;
        };

        return next.next = next;
      }
    }

    // Return an iterator with no values.
    return { next: doneResult };
  }
  exports.values = values;

  function doneResult() {
    return { value: undefined, done: true };
  }

  Context.prototype = {
    constructor: Context,

    reset: function(skipTempReset) {
      this.prev = 0;
      this.next = 0;
      // Resetting context._sent for legacy support of Babel's
      // function.sent implementation.
      this.sent = this._sent = undefined;
      this.done = false;
      this.delegate = null;

      this.method = "next";
      this.arg = undefined;

      this.tryEntries.forEach(resetTryEntry);

      if (!skipTempReset) {
        for (var name in this) {
          // Not sure about the optimal order of these conditions:
          if (name.charAt(0) === "t" &&
              hasOwn.call(this, name) &&
              !isNaN(+name.slice(1))) {
            this[name] = undefined;
          }
        }
      }
    },

    stop: function() {
      this.done = true;

      var rootEntry = this.tryEntries[0];
      var rootRecord = rootEntry.completion;
      if (rootRecord.type === "throw") {
        throw rootRecord.arg;
      }

      return this.rval;
    },

    dispatchException: function(exception) {
      if (this.done) {
        throw exception;
      }

      var context = this;
      function handle(loc, caught) {
        record.type = "throw";
        record.arg = exception;
        context.next = loc;

        if (caught) {
          // If the dispatched exception was caught by a catch block,
          // then let that catch block handle the exception normally.
          context.method = "next";
          context.arg = undefined;
        }

        return !! caught;
      }

      for (var i = this.tryEntries.length - 1; i >= 0; --i) {
        var entry = this.tryEntries[i];
        var record = entry.completion;

        if (entry.tryLoc === "root") {
          // Exception thrown outside of any try block that could handle
          // it, so set the completion value of the entire function to
          // throw the exception.
          return handle("end");
        }

        if (entry.tryLoc <= this.prev) {
          var hasCatch = hasOwn.call(entry, "catchLoc");
          var hasFinally = hasOwn.call(entry, "finallyLoc");

          if (hasCatch && hasFinally) {
            if (this.prev < entry.catchLoc) {
              return handle(entry.catchLoc, true);
            } else if (this.prev < entry.finallyLoc) {
              return handle(entry.finallyLoc);
            }

          } else if (hasCatch) {
            if (this.prev < entry.catchLoc) {
              return handle(entry.catchLoc, true);
            }

          } else if (hasFinally) {
            if (this.prev < entry.finallyLoc) {
              return handle(entry.finallyLoc);
            }

          } else {
            throw new Error("try statement without catch or finally");
          }
        }
      }
    },

    abrupt: function(type, arg) {
      for (var i = this.tryEntries.length - 1; i >= 0; --i) {
        var entry = this.tryEntries[i];
        if (entry.tryLoc <= this.prev &&
            hasOwn.call(entry, "finallyLoc") &&
            this.prev < entry.finallyLoc) {
          var finallyEntry = entry;
          break;
        }
      }

      if (finallyEntry &&
          (type === "break" ||
           type === "continue") &&
          finallyEntry.tryLoc <= arg &&
          arg <= finallyEntry.finallyLoc) {
        // Ignore the finally entry if control is not jumping to a
        // location outside the try/catch block.
        finallyEntry = null;
      }

      var record = finallyEntry ? finallyEntry.completion : {};
      record.type = type;
      record.arg = arg;

      if (finallyEntry) {
        this.method = "next";
        this.next = finallyEntry.finallyLoc;
        return ContinueSentinel;
      }

      return this.complete(record);
    },

    complete: function(record, afterLoc) {
      if (record.type === "throw") {
        throw record.arg;
      }

      if (record.type === "break" ||
          record.type === "continue") {
        this.next = record.arg;
      } else if (record.type === "return") {
        this.rval = this.arg = record.arg;
        this.method = "return";
        this.next = "end";
      } else if (record.type === "normal" && afterLoc) {
        this.next = afterLoc;
      }

      return ContinueSentinel;
    },

    finish: function(finallyLoc) {
      for (var i = this.tryEntries.length - 1; i >= 0; --i) {
        var entry = this.tryEntries[i];
        if (entry.finallyLoc === finallyLoc) {
          this.complete(entry.completion, entry.afterLoc);
          resetTryEntry(entry);
          return ContinueSentinel;
        }
      }
    },

    "catch": function(tryLoc) {
      for (var i = this.tryEntries.length - 1; i >= 0; --i) {
        var entry = this.tryEntries[i];
        if (entry.tryLoc === tryLoc) {
          var record = entry.completion;
          if (record.type === "throw") {
            var thrown = record.arg;
            resetTryEntry(entry);
          }
          return thrown;
        }
      }

      // The context.catch method must only be called with a location
      // argument that corresponds to a known catch block.
      throw new Error("illegal catch attempt");
    },

    delegateYield: function(iterable, resultName, nextLoc) {
      this.delegate = {
        iterator: values(iterable),
        resultName: resultName,
        nextLoc: nextLoc
      };

      if (this.method === "next") {
        // Deliberately forget the last sent value so that we don't
        // accidentally pass it on to the delegate.
        this.arg = undefined;
      }

      return ContinueSentinel;
    }
  };

  // Regardless of whether this script is executing as a CommonJS module
  // or not, return the runtime object so that we can declare the variable
  // regeneratorRuntime in the outer scope, which allows this module to be
  // injected easily by `bin/regenerator --include-runtime script.js`.
  return exports;

}(
  // If this script is executing as a CommonJS module, use module.exports
  // as the regeneratorRuntime namespace. Otherwise create a new empty
  // object. Either way, the resulting object will be used to initialize
  // the regeneratorRuntime variable at the top of this file.
   true ? module.exports : undefined
));

try {
  regeneratorRuntime = runtime;
} catch (accidentalStrictMode) {
  // This module should not be running in strict mode, so the above
  // assignment should always work unless something is misconfigured. Just
  // in case runtime.js accidentally runs in strict mode, we can escape
  // strict mode using a global Function call. This could conceivably fail
  // if a Content Security Policy forbids using Function, but in that case
  // the proper solution is to fix the accidental strict mode problem. If
  // you've misconfigured your bundler to force strict mode and applied a
  // CSP to forbid Function, and you're not willing to fix either of those
  // problems, please detail your unique predicament in a GitHub issue.
  Function("r", "regeneratorRuntime = r")(runtime);
}


/***/ }),

/***/ "./resources/js/cabinet/settings/add_email/add_email.js":
/*!**************************************************************!*\
  !*** ./resources/js/cabinet/settings/add_email/add_email.js ***!
  \**************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "default", function() { return editEmail; });
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/regenerator */ "./node_modules/@babel/runtime/regenerator/index.js");
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _common_ajaxPOST__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../../common/ajaxPOST */ "./resources/js/common/ajaxPOST.js");
/* harmony import */ var _common_errors_show_errors__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../common/errors/show_errors */ "./resources/js/common/errors/show_errors.js");
/* harmony import */ var _hide_edit_input__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../hide_edit_input */ "./resources/js/cabinet/settings/hide_edit_input.js");




var errorsEditInput = document.querySelector('.edit_input_popup .edit_input_errors');
function editEmail() {
  var result, response;
  return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.async(function editEmail$(_context) {
    while (1) {
      switch (_context.prev = _context.next) {
        case 0:
          _context.next = 2;
          return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.awrap(Object(_common_ajaxPOST__WEBPACK_IMPORTED_MODULE_1__["default"])('/cabinet/settings/add_email', document.forms.edit_input));

        case 2:
          result = _context.sent;
          response = JSON.parse(result);

          if (response.valid) {
            Object(_common_errors_show_errors__WEBPACK_IMPORTED_MODULE_2__["default"])(response.valid, errorsEditInput);
          }

          if (response.id) {
            Object(_hide_edit_input__WEBPACK_IMPORTED_MODULE_3__["default"])();
            document.querySelector('.about_check_email').style.display = 'flex';
          }

        case 6:
        case "end":
          return _context.stop();
      }
    }
  });
}

/***/ }),

/***/ "./resources/js/cabinet/settings/deleting_classes.js":
/*!***********************************************************!*\
  !*** ./resources/js/cabinet/settings/deleting_classes.js ***!
  \***********************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony default export */ __webpack_exports__["default"] = (function (array, element) {
  array.forEach(function (item) {
    if (element.classList.contains(item)) {
      element.classList.remove(item);
    }
  });
});

/***/ }),

/***/ "./resources/js/cabinet/settings/edit_email.js":
/*!*****************************************************!*\
  !*** ./resources/js/cabinet/settings/edit_email.js ***!
  \*****************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "default", function() { return _callee; });
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/regenerator */ "./node_modules/@babel/runtime/regenerator/index.js");
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _common_ajaxPOST__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../common/ajaxPOST */ "./resources/js/common/ajaxPOST.js");
/* harmony import */ var _common_errors_show_errors__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../common/errors/show_errors */ "./resources/js/common/errors/show_errors.js");
/* harmony import */ var _hide_edit_input__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./hide_edit_input */ "./resources/js/cabinet/settings/hide_edit_input.js");




var errorsEditInput = document.querySelector('.edit_input_popup .edit_input_errors');
function _callee() {
  var result, response;
  return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.async(function _callee$(_context) {
    while (1) {
      switch (_context.prev = _context.next) {
        case 0:
          _context.next = 2;
          return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.awrap(Object(_common_ajaxPOST__WEBPACK_IMPORTED_MODULE_1__["default"])('/cabinet/settings/edit_email', document.forms.edit_input));

        case 2:
          result = _context.sent;
          response = JSON.parse(result);

          if (response.valid) {
            Object(_common_errors_show_errors__WEBPACK_IMPORTED_MODULE_2__["default"])(response.valid, errorsEditInput);
          }

          if (response.id) {
            Object(_hide_edit_input__WEBPACK_IMPORTED_MODULE_3__["default"])();
            document.querySelector('.about_check_email').style.display = 'flex';
          }

        case 6:
        case "end":
          return _context.stop();
      }
    }
  });
}

/***/ }),

/***/ "./resources/js/cabinet/settings/edit_password.js":
/*!********************************************************!*\
  !*** ./resources/js/cabinet/settings/edit_password.js ***!
  \********************************************************/
/*! exports provided: showEditPassword, hideEditPassword, changePassword */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "showEditPassword", function() { return showEditPassword; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "hideEditPassword", function() { return hideEditPassword; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "changePassword", function() { return changePassword; });
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/regenerator */ "./node_modules/@babel/runtime/regenerator/index.js");
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _common_ajaxPOST__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../common/ajaxPOST */ "./resources/js/common/ajaxPOST.js");
/* harmony import */ var _common_errors_show_errors__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../common/errors/show_errors */ "./resources/js/common/errors/show_errors.js");
/* harmony import */ var _common_errors_hide_errors__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../common/errors/hide_errors */ "./resources/js/common/errors/hide_errors.js");




function showEditPassword() {
  document.querySelector('.edit_password_popup').style.display = 'flex';
}
var divErrors = document.querySelector('.edit_password_popup .edit_password_errors');
function hideEditPassword() {
  document.querySelector('.edit_password_popup').style.display = 'none';
  Object(_common_errors_hide_errors__WEBPACK_IMPORTED_MODULE_3__["default"])(divErrors);
}
function changePassword() {
  var result, response;
  return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.async(function changePassword$(_context) {
    while (1) {
      switch (_context.prev = _context.next) {
        case 0:
          _context.next = 2;
          return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.awrap(Object(_common_ajaxPOST__WEBPACK_IMPORTED_MODULE_1__["default"])('/cabinet/settings/change_password', document.forms.edit_password));

        case 2:
          result = _context.sent;
          response = JSON.parse(result);
          console.log(response);

          if (response.errors) {
            Object(_common_errors_show_errors__WEBPACK_IMPORTED_MODULE_2__["default"])(response.errors, divErrors);
          } else {
            hideEditPassword();
          }

        case 6:
        case "end":
          return _context.stop();
      }
    }
  });
}

/***/ }),

/***/ "./resources/js/cabinet/settings/edit_phone/cancel_change_phone.js":
/*!*************************************************************************!*\
  !*** ./resources/js/cabinet/settings/edit_phone/cancel_change_phone.js ***!
  \*************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "default", function() { return _callee; });
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/regenerator */ "./node_modules/@babel/runtime/regenerator/index.js");
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _common_ajaxPOST__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../../common/ajaxPOST */ "./resources/js/common/ajaxPOST.js");
/* harmony import */ var _common_hide_verify_phone__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../common/hide_verify_phone */ "./resources/js/common/hide_verify_phone.js");



function _callee() {
  var result;
  return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.async(function _callee$(_context) {
    while (1) {
      switch (_context.prev = _context.next) {
        case 0:
          _context.next = 2;
          return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.awrap(Object(_common_ajaxPOST__WEBPACK_IMPORTED_MODULE_1__["default"])('/cabinet/settings/do_not_change'));

        case 2:
          result = _context.sent;
          Object(_common_hide_verify_phone__WEBPACK_IMPORTED_MODULE_2__["default"])();

        case 4:
        case "end":
          return _context.stop();
      }
    }
  });
}

/***/ }),

/***/ "./resources/js/cabinet/settings/edit_phone/edit_phone.js":
/*!****************************************************************!*\
  !*** ./resources/js/cabinet/settings/edit_phone/edit_phone.js ***!
  \****************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "default", function() { return _callee; });
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/regenerator */ "./node_modules/@babel/runtime/regenerator/index.js");
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _common_ajaxPOST__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../../common/ajaxPOST */ "./resources/js/common/ajaxPOST.js");
/* harmony import */ var _common_errors_show_errors__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../common/errors/show_errors */ "./resources/js/common/errors/show_errors.js");
/* harmony import */ var _common_timer__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../../common/timer */ "./resources/js/common/timer.js");
/* harmony import */ var _common_show_verify_phone__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ../../../common/show_verify_phone */ "./resources/js/common/show_verify_phone.js");
/* harmony import */ var _hide_edit_input__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ../hide_edit_input */ "./resources/js/cabinet/settings/hide_edit_input.js");






var a = document.querySelector('.edit_phone_popup .edit_phone_popup');
var errorsEditInput = document.querySelector('.edit_input_popup .edit_input_errors');
function _callee() {
  var response, result, elem1, elem2, timer;
  return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.async(function _callee$(_context) {
    while (1) {
      switch (_context.prev = _context.next) {
        case 0:
          _context.next = 2;
          return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.awrap(Object(_common_ajaxPOST__WEBPACK_IMPORTED_MODULE_1__["default"])('/cabinet/settings/edit_phone', document.forms.edit_input));

        case 2:
          response = _context.sent;
          result = JSON.parse(response);
          console.log(result, 3);

          if (result.time) {
            Object(_hide_edit_input__WEBPACK_IMPORTED_MODULE_5__["default"])();
            elem1 = document.querySelector('.minutes');
            elem2 = document.querySelector('.seconds');
            timer = new _common_timer__WEBPACK_IMPORTED_MODULE_3__["default"](result.time, elem1, elem2);
            timer.start();
            Object(_common_show_verify_phone__WEBPACK_IMPORTED_MODULE_4__["default"])();
          } else {
            Object(_common_errors_show_errors__WEBPACK_IMPORTED_MODULE_2__["default"])(result.errors, errorsEditInput);
          }

        case 6:
        case "end":
          return _context.stop();
      }
    }
  });
}

function activateResendCode() {
  document.querySelector('.verify_phone_popup .resend_code_btn').removeAttribute('disabled');
  document.querySelector('.verify_phone_popup .resend_code_btn').style.color = '#006363';
}

/***/ }),

/***/ "./resources/js/cabinet/settings/hide_edit_input.js":
/*!**********************************************************!*\
  !*** ./resources/js/cabinet/settings/hide_edit_input.js ***!
  \**********************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _common_errors_hide_errors__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../common/errors/hide_errors */ "./resources/js/common/errors/hide_errors.js");
/* harmony import */ var _deleting_classes__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./deleting_classes */ "./resources/js/cabinet/settings/deleting_classes.js");


var classes = ['edit_phone_btn', 'add_email_btn', 'edit_email_btn'];
var element = document.querySelector('.edit_input_popup .edit_input_btn');
/* harmony default export */ __webpack_exports__["default"] = (function () {
  document.querySelector('.edit_input_popup .popup_title').innerHTML = '';
  document.querySelector('.edit_input_popup label').innerHTML = '';
  document.querySelector('.edit_input_popup .input').removeAttribute('name');
  document.querySelector('.edit_input_popup .input').value = '';
  document.querySelector('.edit_input_popup').style.display = 'none';
  Object(_common_errors_hide_errors__WEBPACK_IMPORTED_MODULE_0__["default"])(document.querySelector('.edit_input_popup .edit_input_errors'));
  Object(_deleting_classes__WEBPACK_IMPORTED_MODULE_1__["default"])(classes, element);
});
;

/***/ }),

/***/ "./resources/js/cabinet/settings/showEditInput.js":
/*!********************************************************!*\
  !*** ./resources/js/cabinet/settings/showEditInput.js ***!
  \********************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _deleting_classes__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./deleting_classes */ "./resources/js/cabinet/settings/deleting_classes.js");

var classes = ['edit_phone_btn', 'add_email_btn', 'edit_email_btn'];
var element = document.querySelector('.edit_input_popup .edit_input_btn');
/* harmony default export */ __webpack_exports__["default"] = (function (value, name, nameClass) {
  Object(_deleting_classes__WEBPACK_IMPORTED_MODULE_0__["default"])(classes, element);
  document.querySelector('.edit_input_popup .popup_title').innerHTML = 'Введите ' + value;
  document.querySelector('.edit_input_popup label').innerHTML = value;
  document.querySelector('.edit_input_popup .input').setAttribute('name', name);
  document.querySelector('.edit_input_popup .input').value = '';
  document.querySelector('.edit_input_popup').style.display = 'flex';
  document.querySelector('.edit_input_popup .edit_input_btn').classList.add(nameClass);
  inputFocus();
});

function inputFocus() {
  document.querySelector('.edit_input_popup .input').focus();
}

/***/ }),

/***/ "./resources/js/common/ajaxPOST.js":
/*!*****************************************!*\
  !*** ./resources/js/common/ajaxPOST.js ***!
  \*****************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "default", function() { return _callee; });
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/regenerator */ "./node_modules/@babel/runtime/regenerator/index.js");
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _get_csrf__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./get_csrf */ "./resources/js/common/get_csrf.js");


function _typeof(obj) { if (typeof Symbol === "function" && typeof Symbol.iterator === "symbol") { _typeof = function _typeof(obj) { return typeof obj; }; } else { _typeof = function _typeof(obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }; } return _typeof(obj); }


function _callee(url, form) {
  var options, proxy, formData, request, status;
  return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.async(function _callee$(_context) {
    while (1) {
      switch (_context.prev = _context.next) {
        case 0:
          options = {
            method: 'post',
            headers: {
              'X-CSRF-TOKEN': _get_csrf__WEBPACK_IMPORTED_MODULE_1__["default"]
            }
          };
          proxy = new Proxy(options, {
            get: function get(target, body) {
              return target[body];
            },
            set: function set(target, body, value) {
              target[body] = value;
              return true;
            }
          });

          if (_typeof(form) == 'object') {
            proxy.body = new FormData(form);
          } else {
            formData = new FormData();
            formData.append('id', form);
            proxy.body = formData;
          }

          _context.next = 5;
          return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.awrap(fetch(url, options));

        case 5:
          request = _context.sent;
          status = request.status;

          if (!(status !== 200)) {
            _context.next = 9;
            break;
          }

          throw new Error('no');

        case 9:
          _context.next = 11;
          return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.awrap(request.text());

        case 11:
          return _context.abrupt("return", _context.sent);

        case 12:
        case "end":
          return _context.stop();
      }
    }
  });
}

/***/ }),

/***/ "./resources/js/common/errors/hide_errors.js":
/*!***************************************************!*\
  !*** ./resources/js/common/errors/hide_errors.js ***!
  \***************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony default export */ __webpack_exports__["default"] = (function (divErrors) {
  divErrors.innerHTML = '';
  divErrors.style.display = 'none';
});

/***/ }),

/***/ "./resources/js/common/errors/show_errors.js":
/*!***************************************************!*\
  !*** ./resources/js/common/errors/show_errors.js ***!
  \***************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony default export */ __webpack_exports__["default"] = (function (response, errors) {
  errors.innerHTML = response;
  errors.style.display = 'flex';
});

/***/ }),

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

/***/ "./resources/js/common/hide_verify_phone.js":
/*!**************************************************!*\
  !*** ./resources/js/common/hide_verify_phone.js ***!
  \**************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _errors_hide_errors__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./errors/hide_errors */ "./resources/js/common/errors/hide_errors.js");

/* harmony default export */ __webpack_exports__["default"] = (function () {
  document.querySelector('.verify_phone_popup').style.display = 'none';
  disableResendCode();
  Object(_errors_hide_errors__WEBPACK_IMPORTED_MODULE_0__["default"])(document.querySelector('.verify_phone_popup .errors_popup'));
});

function disableResendCode() {
  var resendCodeBtn = document.querySelector('.verify_phone_popup .resend_code_btn');
  resendCodeBtn.setAttribute('disabled', '9');
  resendCodeBtn.style.color = '#b0afaf';
}

/***/ }),

/***/ "./resources/js/common/resend_verify_code.js":
/*!***************************************************!*\
  !*** ./resources/js/common/resend_verify_code.js ***!
  \***************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "default", function() { return _callee; });
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/regenerator */ "./node_modules/@babel/runtime/regenerator/index.js");
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _ajaxPOST__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./ajaxPOST */ "./resources/js/common/ajaxPOST.js");
/* harmony import */ var _timer__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./timer */ "./resources/js/common/timer.js");
/* harmony import */ var _errors_show_errors__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./errors/show_errors */ "./resources/js/common/errors/show_errors.js");




function _callee(url, form) {
  var resendCodeBtn, result, response, elem1, elem2, timer;
  return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.async(function _callee$(_context) {
    while (1) {
      switch (_context.prev = _context.next) {
        case 0:
          resendCodeBtn = document.querySelector('.verify_phone_popup .resend_code_btn');
          resendCodeBtn.setAttribute('disabled', '9');
          resendCodeBtn.style.color = '#b0afaf';
          _context.next = 5;
          return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.awrap(Object(_ajaxPOST__WEBPACK_IMPORTED_MODULE_1__["default"])(url, form));

        case 5:
          result = _context.sent;
          response = JSON.parse(result);

          if (response.time) {
            elem1 = document.querySelector('.minutes');
            elem2 = document.querySelector('.seconds');
            timer = new _timer__WEBPACK_IMPORTED_MODULE_2__["default"](response.time, elem1, elem2);
            timer.start();
          }

          if (response.errors) {
            Object(_errors_show_errors__WEBPACK_IMPORTED_MODULE_3__["default"])(response.errors, document.querySelector('.verify_phone_popup .errors_popup'));
          }

        case 9:
        case "end":
          return _context.stop();
      }
    }
  });
}

/***/ }),

/***/ "./resources/js/common/show_verify_phone.js":
/*!**************************************************!*\
  !*** ./resources/js/common/show_verify_phone.js ***!
  \**************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "default", function() { return showVerifyPhone; });
function showVerifyPhone() {
  disableResendCode();
  document.querySelector('.verify_phone_popup').style.display = 'flex';
  document.querySelector('.verify_phone_popup .popup__form_code').value = '';
  document.querySelector('.verify_phone_popup .popup__form_code').focus();
  validationConfirmationCode();
}

function validationConfirmationCode() {
  var inputVerifyCode = document.querySelector('.verify_phone_popup .popup__form_code');
  inputVerifyCode.addEventListener('input', function () {
    var str = inputVerifyCode.value.toString();
    var fieldLenght = str.length;

    if (fieldLenght == 5) {
      document.querySelector('.verify_phone_popup .verify_phone_btn').removeAttribute('disabled');
      document.querySelector('.verify_phone_popup .verify_phone_btn').style.backgroundColor = '#ff7400';
    } else {
      document.querySelector('.verify_phone_popup .verify_phone_btn').setAttribute('disabled', '0');
      document.querySelector('.verify_phone_popup .verify_phone_btn').style.backgroundColor = '#b0afaf';
    }
  });
}

function disableResendCode() {
  var resendCodeBtn = document.querySelector('.verify_phone_popup .resend_code_btn');
  resendCodeBtn.setAttribute('disabled', '9');
  resendCodeBtn.style.color = '#b0afaf';
}

/***/ }),

/***/ "./resources/js/common/timer.js":
/*!**************************************!*\
  !*** ./resources/js/common/timer.js ***!
  \**************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony default export */ __webpack_exports__["default"] = (function (time, elem1, elem2) {
  this.time = time;
  this.elem1 = elem1;
  this.elem2 = elem2;
  this.interval;
  this.minutes;
  this.seconds;

  this.activateResendCode = function () {
    var resendCodeBtn = document.querySelector('.verify_phone_popup .resend_code_btn');
    resendCodeBtn.removeAttribute('disabled');
    resendCodeBtn.style.color = '#006363';
  };

  this.disabledResendCode = function () {
    var resendCodeBtn = document.querySelector('.verify_phone_popup .resend_code_btn');
    resendCodeBtn.setAttribute('disabled', 0);
    resendCodeBtn.style.color = '#b0afaf';
  };

  this.tick = function () {
    this.time--;
    this.formatTime();
    this.render();

    if (this.time <= 0) {
      this.stop();
      this.activateResendCode();
    } else {
      this.disabledResendCode();
    }
  }; // this.a = function (elem, str) {
  //     elem = Math.floor(this.time   60);
  //     if (elem < 10){
  //         elem = '0' + elem;
  //     }
  // }


  this.formatTime = function () {
    this.minutes = Math.floor(this.time / 60);

    if (this.minutes < 10) {
      this.minutes = '0' + this.minutes;
    }

    this.seconds = Math.floor(this.time % 60);

    if (this.seconds < 10) {
      this.seconds = '0' + this.seconds;
    }
  };

  this.render = function () {
    if (document.querySelector('.verify_phone_popup').style.display === 'none') {
      this.stop();
    }

    this.elem1.innerHTML = this.minutes;
    this.elem2.innerHTML = this.seconds;
  };

  this.start = function () {
    this.interval = setInterval(this.tick.bind(this), 1000);
  };

  this.stop = function () {
    clearInterval(this.interval);
    this.time = 0;
    this.elem1.innerHTML = '00';
    this.elem2.innerHTML = '00';
  };
});

/***/ }),

/***/ "./resources/js/common/verify_phone.js":
/*!*********************************************!*\
  !*** ./resources/js/common/verify_phone.js ***!
  \*********************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "default", function() { return _callee; });
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/regenerator */ "./node_modules/@babel/runtime/regenerator/index.js");
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _ajaxPOST__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./ajaxPOST */ "./resources/js/common/ajaxPOST.js");
/* harmony import */ var _errors_show_errors__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./errors/show_errors */ "./resources/js/common/errors/show_errors.js");
/* harmony import */ var _common_hide_verify_phone__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../common/hide_verify_phone */ "./resources/js/common/hide_verify_phone.js");




var errorsVerifyPhone = document.querySelector('.verify_phone_popup .errors_popup');
function _callee(url, form) {
  var result, response;
  return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.async(function _callee$(_context) {
    while (1) {
      switch (_context.prev = _context.next) {
        case 0:
          _context.next = 2;
          return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.awrap(Object(_ajaxPOST__WEBPACK_IMPORTED_MODULE_1__["default"])(url, form));

        case 2:
          result = _context.sent;
          response = JSON.parse(result);

          if (response.view) {
            Object(_common_hide_verify_phone__WEBPACK_IMPORTED_MODULE_3__["default"])();
            document.querySelector('section').innerHTML = response.view;
          }

          if (response.phone) {
            Object(_common_hide_verify_phone__WEBPACK_IMPORTED_MODULE_3__["default"])();
            document.querySelector('.workerStyle__val_phone').innerHTML = response.phone;
          }

          if (response.valid) {
            Object(_errors_show_errors__WEBPACK_IMPORTED_MODULE_2__["default"])(response.valid, errorsVerifyPhone);
          }

          if (response.errors) {
            Object(_errors_show_errors__WEBPACK_IMPORTED_MODULE_2__["default"])(response.errors, errorsVerifyPhone);
          }

        case 8:
        case "end":
          return _context.stop();
      }
    }
  });
}

/***/ }),

/***/ "./resources/js/entry_points/cabinet/settings.js":
/*!*******************************************************!*\
  !*** ./resources/js/entry_points/cabinet/settings.js ***!
  \*******************************************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/regenerator */ "./node_modules/@babel/runtime/regenerator/index.js");
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _cabinet_settings_edit_phone_edit_phone__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../cabinet/settings/edit_phone/edit_phone */ "./resources/js/cabinet/settings/edit_phone/edit_phone.js");
/* harmony import */ var _cabinet_settings_showEditInput__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../cabinet/settings/showEditInput */ "./resources/js/cabinet/settings/showEditInput.js");
/* harmony import */ var _cabinet_settings_hide_edit_input__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../cabinet/settings/hide_edit_input */ "./resources/js/cabinet/settings/hide_edit_input.js");
/* harmony import */ var _common_verify_phone__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ../../common/verify_phone */ "./resources/js/common/verify_phone.js");
/* harmony import */ var _cabinet_settings_edit_phone_cancel_change_phone__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ../../cabinet/settings/edit_phone/cancel_change_phone */ "./resources/js/cabinet/settings/edit_phone/cancel_change_phone.js");
/* harmony import */ var _common_resend_verify_code__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! ../../common/resend_verify_code */ "./resources/js/common/resend_verify_code.js");
/* harmony import */ var _cabinet_settings_add_email_add_email__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! ../../cabinet/settings/add_email/add_email */ "./resources/js/cabinet/settings/add_email/add_email.js");
/* harmony import */ var _cabinet_settings_edit_email__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! ../../cabinet/settings/edit_email */ "./resources/js/cabinet/settings/edit_email.js");
/* harmony import */ var _cabinet_settings_edit_password__WEBPACK_IMPORTED_MODULE_9__ = __webpack_require__(/*! ../../cabinet/settings/edit_password */ "./resources/js/cabinet/settings/edit_password.js");
/* harmony import */ var _common_get_csrf__WEBPACK_IMPORTED_MODULE_10__ = __webpack_require__(/*! ../../common/get_csrf */ "./resources/js/common/get_csrf.js");








 // Показать модальное окно для изменения номера телефона

document.querySelector('.phone_edit_btn').addEventListener('click', function (e) {
  e.preventDefault();
  Object(_cabinet_settings_showEditInput__WEBPACK_IMPORTED_MODULE_2__["default"])('номер телефона', 'phone', 'edit_phone_btn');
}); // Скрыть модальные окна для изменения

document.querySelector('.edit_input_popup .cancel_edit_input_btn').addEventListener('click', _cabinet_settings_hide_edit_input__WEBPACK_IMPORTED_MODULE_3__["default"]); //---------------------При нажатии на эту кнопку -------------------

document.querySelector('.edit_input_popup .edit_input_btn').addEventListener('click', function _callee(e) {
  return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.async(function _callee$(_context) {
    while (1) {
      switch (_context.prev = _context.next) {
        case 0:
          e.preventDefault(); // Изменяет телефон

          if (!e.target.classList.contains('edit_phone_btn')) {
            _context.next = 4;
            break;
          }

          _context.next = 4;
          return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.awrap(Object(_cabinet_settings_edit_phone_edit_phone__WEBPACK_IMPORTED_MODULE_1__["default"])());

        case 4:
          if (!e.target.classList.contains('add_email_btn')) {
            _context.next = 7;
            break;
          }

          _context.next = 7;
          return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.awrap(Object(_cabinet_settings_add_email_add_email__WEBPACK_IMPORTED_MODULE_7__["default"])());

        case 7:
          if (!e.target.classList.contains('edit_email_btn')) {
            _context.next = 10;
            break;
          }

          _context.next = 10;
          return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.awrap(Object(_cabinet_settings_edit_email__WEBPACK_IMPORTED_MODULE_8__["default"])());

        case 10:
        case "end":
          return _context.stop();
      }
    }
  });
}); // Отмена изменения номера телефона

document.querySelector('.verify_phone_popup .cancel_btn').addEventListener('click', _cabinet_settings_edit_phone_cancel_change_phone__WEBPACK_IMPORTED_MODULE_5__["default"]); // Подтверждение номера телефона

document.querySelector('.verify_phone_popup .verify_phone_btn').addEventListener('click', function _callee2(e) {
  return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.async(function _callee2$(_context2) {
    while (1) {
      switch (_context2.prev = _context2.next) {
        case 0:
          e.preventDefault();
          _context2.next = 3;
          return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.awrap(Object(_common_verify_phone__WEBPACK_IMPORTED_MODULE_4__["default"])('/cabinet/settings/verify_phone', document.forms.verify_phone));

        case 3:
        case "end":
          return _context2.stop();
      }
    }
  });
}); // Повторно отправить код подтверждения

document.querySelector('.verify_phone_popup .resend_code_btn').addEventListener('click', function _callee3(e) {
  return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.async(function _callee3$(_context3) {
    while (1) {
      switch (_context3.prev = _context3.next) {
        case 0:
          e.preventDefault();
          _context3.next = 3;
          return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.awrap(Object(_common_resend_verify_code__WEBPACK_IMPORTED_MODULE_6__["default"])('/cabinet/settings/resend_verify_code'));

        case 3:
        case "end":
          return _context3.stop();
      }
    }
  });
});

try {
  document.querySelector('.fa-plus-circle').addEventListener('click', function () {
    Object(_cabinet_settings_showEditInput__WEBPACK_IMPORTED_MODULE_2__["default"])('E-mail', 'email', 'add_email_btn');
  });
} catch (e) {} // document.querySelector('.edit_input_popup .cancel_edit_input_btn').addEventListener('click', hideEditInput);


document.querySelector('.edit_input_popup .edit_input_btn').addEventListener('click', function _callee4(e) {
  return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.async(function _callee4$(_context4) {
    while (1) {
      switch (_context4.prev = _context4.next) {
        case 0:
          e.preventDefault();

        case 1:
        case "end":
          return _context4.stop();
      }
    }
  });
});
document.querySelector('.email_edit_btn').addEventListener('click', function (e) {
  e.preventDefault();
  Object(_cabinet_settings_showEditInput__WEBPACK_IMPORTED_MODULE_2__["default"])('E-mail', 'email', 'edit_email_btn');
});


document.querySelector('.workerStyle__change_password').addEventListener('click', function (e) {
  Object(_cabinet_settings_edit_password__WEBPACK_IMPORTED_MODULE_9__["showEditPassword"])();
});
document.querySelector('.cancel_edit_password_btn').addEventListener('click', function (e) {
  Object(_cabinet_settings_edit_password__WEBPACK_IMPORTED_MODULE_9__["hideEditPassword"])();
});
document.querySelector('.edit_password_popup .edit_password_btn').addEventListener('click', function _callee5(e) {
  return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.async(function _callee5$(_context5) {
    while (1) {
      switch (_context5.prev = _context5.next) {
        case 0:
          e.preventDefault();
          _context5.next = 3;
          return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.awrap(Object(_cabinet_settings_edit_password__WEBPACK_IMPORTED_MODULE_9__["changePassword"])());

        case 3:
        case "end":
          return _context5.stop();
      }
    }
  });
});
document.querySelectorAll('.workerStyle__answer').forEach(function (item) {
  item.addEventListener('click', function _callee6() {
    var form, result, status, _result;

    return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.async(function _callee6$(_context6) {
      while (1) {
        switch (_context6.prev = _context6.next) {
          case 0:
            form = new FormData();

            if (!this.hasAttribute('checked')) {
              _context6.next = 15;
              break;
            }

            this.removeAttribute('checked');
            form.append(item.getAttribute('name'), 0);
            _context6.next = 6;
            return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.awrap(fetch('/cabinet/settings/toggle_check', {
              method: 'post',
              headers: {
                'X-CSRF-TOKEN': _common_get_csrf__WEBPACK_IMPORTED_MODULE_10__["default"]
              },
              body: form
            }));

          case 6:
            result = _context6.sent;
            status = result.status;

            if (!(status !== 200)) {
              _context6.next = 10;
              break;
            }

            throw new Error('no');

          case 10:
            _context6.next = 12;
            return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.awrap(result.text());

          case 12:
            return _context6.abrupt("return", _context6.sent);

          case 15:
            this.setAttribute('checked', '0');
            form.append(item.getAttribute('name'), 1);
            _context6.next = 19;
            return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.awrap(fetch('/cabinet/settings/toggle_check', {
              method: 'post',
              headers: {
                'X-CSRF-TOKEN': _common_get_csrf__WEBPACK_IMPORTED_MODULE_10__["default"]
              },
              body: form
            }));

          case 19:
            _result = _context6.sent;

          case 20:
          case "end":
            return _context6.stop();
        }
      }
    }, null, this);
  });
});

/***/ }),

/***/ 2:
/*!*************************************************************!*\
  !*** multi ./resources/js/entry_points/cabinet/settings.js ***!
  \*************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\OSPanel\domains\work\resources\js\entry_points\cabinet\settings.js */"./resources/js/entry_points/cabinet/settings.js");


/***/ })

/******/ });