webpackJsonp([2],{

/***/ 1358:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(1359);


/***/ }),

/***/ 1359:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0_vue__ = __webpack_require__(12);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0_vue___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_0_vue__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1_vee_validate__ = __webpack_require__(24);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__vue_store_store__ = __webpack_require__(9);
window.axios = __webpack_require__(23);
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
window.axios.defaults.headers.common['X-CSRF-TOKEN'] = document.head.querySelector('meta[name="csrf-token"]').content;




__webpack_require__(45);

__WEBPACK_IMPORTED_MODULE_0_vue___default.a.use(__WEBPACK_IMPORTED_MODULE_1_vee_validate__["default"]);

__WEBPACK_IMPORTED_MODULE_0_vue___default.a.component('page-meta', __webpack_require__(1360));
__WEBPACK_IMPORTED_MODULE_0_vue___default.a.component('genre-select', __webpack_require__(30));

window.Vue = new __WEBPACK_IMPORTED_MODULE_0_vue___default.a({
    store: __WEBPACK_IMPORTED_MODULE_2__vue_store_store__["a" /* default */],
    el: '#admin'
});

/***/ }),

/***/ 1360:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(1361)
}
var normalizeComponent = __webpack_require__(2)
/* script */
var __vue_script__ = __webpack_require__(1363)
/* template */
var __vue_template__ = null
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = "data-v-62768153"
/* moduleIdentifier (server only) */
var __vue_module_identifier__ = null
var Component = normalizeComponent(
  __vue_script__,
  __vue_template__,
  __vue_template_functional__,
  __vue_styles__,
  __vue_scopeId__,
  __vue_module_identifier__
)
Component.options.__file = "resources/assets/js/vue/components/admin/meta.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-62768153", Component.options)
  } else {
    hotAPI.reload("data-v-62768153", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 1361:
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(1362);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(1)("0f8c731c", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../../node_modules/css-loader/index.js?sourceMap!../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-62768153\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../node_modules/sass-loader/lib/loader.js!../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./meta.vue", function() {
     var newContent = require("!!../../../../../../node_modules/css-loader/index.js?sourceMap!../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-62768153\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../node_modules/sass-loader/lib/loader.js!../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./meta.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ 1362:
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(0)(true);
// imports


// module
exports.push([module.i, "", "", {"version":3,"sources":[],"names":[],"mappings":"","file":"meta.vue","sourceRoot":""}]);

// exports


/***/ }),

/***/ 1363:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });

var id = 0;
/* harmony default export */ __webpack_exports__["default"] = ({
    data: function data() {
        return {
            metaSelectionMode: false,
            image: { 'uploaded': null, 'input': null },
            content: null,
            repeater: {
                slider: [],
                text: [],
                dropdown: []
            }
        };
    },


    mounted: function mounted() {
        var _this = this;

        axios.get('/admin/meta/get/' + $('#page_id').val()).then(function (response) {
            if (response.data) {
                _this.repeater = response.data.repeater;
                _this.image = response.data.image;
                _this.content = response.data.content;

                console.log(_this.image);
            } else {
                reject();
            }
        });
    },

    methods: {
        addMeta: function addMeta() {
            this.metaSelectionMode = true;
        },
        selectMetaType: function selectMetaType(event) {
            this.metaSelectionMode = false;

            if (event.target.value == 'slider') {
                this.repeater.slider.push({
                    id: this.repeater.slider.length,
                    name: '',
                    uploaded: [],
                    inputs: []
                });
            } else if (event.target.value == 'text') {
                this.repeater.text.push({
                    id: this.repeater.text.length,
                    name: '',
                    inputs: []
                });
            } else if (event.target.value == 'dropdown') {
                this.repeater.dropdown.push({
                    id: this.repeater.dropdown.length,
                    name: '',
                    inputs: []
                });
            }
        },
        addToRepeater: function addToRepeater(idx, type) {
            if (type == 'text') {
                this.repeater[type][idx].inputs.push({ value: '' });
            } else if (type == 'dropdown') {
                this.repeater[type][idx].inputs.push({ key: '', value: '' });
            } else if (type == 'slider') {
                this.repeater[type][idx].inputs.push({ input: null, uploaded: null });
            }
        },
        removeFromARepeater: function removeFromARepeater(idx, type, fieldIdx) {
            this.repeater[type][idx].inputs.splice(fieldIdx, 1);
        },
        removeRepeaterBlock: function removeRepeaterBlock(type, repeaterIdx) {
            this.repeater[type].splice(repeaterIdx, 1);
        }
    },
    created: function created() {}
});

/***/ }),

/***/ 30:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(67)
}
var normalizeComponent = __webpack_require__(2)
/* script */
var __vue_script__ = __webpack_require__(69)
/* template */
var __vue_template__ = __webpack_require__(70)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = "data-v-5266f739"
/* moduleIdentifier (server only) */
var __vue_module_identifier__ = null
var Component = normalizeComponent(
  __vue_script__,
  __vue_template__,
  __vue_template_functional__,
  __vue_styles__,
  __vue_scopeId__,
  __vue_module_identifier__
)
Component.options.__file = "resources/assets/js/vue/components/modals/upload/genre-select.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-5266f739", Component.options)
  } else {
    hotAPI.reload("data-v-5266f739", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 36:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0_js_cookie__ = __webpack_require__(31);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0_js_cookie___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_0_js_cookie__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1_store__ = __webpack_require__(9);




function CartManager() {
    var _this = this;

    /**
     * Check the server and the cookie to see if there is any cart data.
     *
     * @returns {Promise<any>}
     */
    this.load = function () {
        return new Promise(function (resolve, reject) {
            // Try first to load from server
            _this.loadFromServer().then(function (data) {
                resolve(data);
            })
            // Empty data received from server, check cookie
            .catch(function () {
                _this.loadFromCookie().then(function (data) {
                    resolve(data);
                }).catch(function () {
                    reject();
                });
            });
        });
    };

    /**
     * Set the phase_cart cookie to store
     */
    this.saveCookie = function () {
        setTimeout(function () {
            var storeItems = __WEBPACK_IMPORTED_MODULE_1_store__["a" /* default */].state.cart.items;
            var toSave = [];
            for (var i = 0; i < storeItems.length; i++) {
                toSave.push({
                    id: storeItems[i].id,
                    type: storeItems[i].type,
                    format: storeItems[i].format ? storeItems[i].format : 'mp3'
                });
            }
            __WEBPACK_IMPORTED_MODULE_0_js_cookie___default.a.set('phase_cart', toSave);
        }, 0);
    };

    /**
     * Add an item to a logged in users cart.
     *
     * @param item
     */
    this.saveItemToServer = function (item) {
        axios.post('/api/cart/item/add', {
            type: item.type,
            id: item.id,
            format: item.format
        });
    };

    /**
     * Check the server for logged in users cart information
     *
     * @returns {Promise<any>}
     */
    this.loadFromServer = function () {
        return new Promise(function (resolve, reject) {
            axios.get('/api/cart/item/list').then(function (response) {
                if (response.data) {
                    resolve(_this.setFormatProperly(response.data));
                } else {
                    reject();
                }
            });
        });
    };

    /**
     * Check the cookie for cart data and query the server to get item information
     *
     * @returns {Promise<any>}
     */
    this.loadFromCookie = function () {
        var cart = __WEBPACK_IMPORTED_MODULE_0_js_cookie___default.a.getJSON('phase_cart');
        return new Promise(function (resolve, reject) {
            if (cart) {
                axios.post('/api/cart/guest/details', { items: cart }).then(function (response) {
                    // Loop through the cookie data and response data and set the format correctly on the server data
                    // according the the cookie
                    for (var i = 0; i < response.data.length; i++) {
                        for (var x = 0; x < cart.length; x++) {
                            if (response.data[i].id === cart[x].id && response.data[i].type === cart[x].type) {
                                response.data[i].format = cart[x].format;
                            }
                        }
                    }
                    resolve(response.data);
                });
            } else {
                reject();
            }
        });
    };

    /**
     * Update the saved format of an item in the cart (mp3/wav)
     *
     * @param item
     * @param format
     */
    this.changeItemFormat = function (item, format) {
        // Update item on server
        axios.post('/api/cart/item/change', {
            id: item.id,
            type: item.type,
            format: format
        });
        // Update item in cookie
        _this.saveCookie();
    };

    /**
     * Data from the server returns the format as a sub-property of a 'pivot' property. Move it to the correct place in the
     * object
     * @param data
     * @returns {*}
     */
    this.setFormatProperly = function (data) {
        for (var i = 0; i < data.length; i++) {
            if (data[i].pivot) {
                data[i].format = data[i].pivot.download_format;
                data[i].pivot = undefined;
            }
        }
        return data;
    };

    /**
     * Remove the cart cookie
     */
    this.reset = function () {
        __WEBPACK_IMPORTED_MODULE_0_js_cookie___default.a.remove('phase_cart');
    };
}
/* harmony default export */ __webpack_exports__["a"] = (new CartManager());

/***/ }),

/***/ 45:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0_vee_validate__ = __webpack_require__(24);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__vee_validate_min_dimensions__ = __webpack_require__(46);
var _slicedToArray = function () { function sliceIterator(arr, i) { var _arr = []; var _n = true; var _d = false; var _e = undefined; try { for (var _i = arr[Symbol.iterator](), _s; !(_n = (_s = _i.next()).done); _n = true) { _arr.push(_s.value); if (i && _arr.length === i) break; } } catch (err) { _d = true; _e = err; } finally { try { if (!_n && _i["return"]) _i["return"](); } finally { if (_d) throw _e; } } return _arr; } return function (arr, i) { if (Array.isArray(arr)) { return arr; } else if (Symbol.iterator in Object(arr)) { return sliceIterator(arr, i); } else { throw new TypeError("Invalid attempt to destructure non-iterable instance"); } }; }();




var dictionary = {
    messages: {
        'min-dimensions': function minDimensions(field, _ref) {
            var _ref2 = _slicedToArray(_ref, 2),
                width = _ref2[0],
                height = _ref2[1];

            return 'The image must be at least ' + width + 'px x' + height + 'px.';
        }
    }
};

__WEBPACK_IMPORTED_MODULE_0_vee_validate__["Validator"].extend('min-dimensions', __WEBPACK_IMPORTED_MODULE_1__vee_validate_min_dimensions__["a" /* default */]);
__WEBPACK_IMPORTED_MODULE_0_vee_validate__["Validator"].extend('username', {
    getMessage: function getMessage(field) {
        return 'The ' + field + ' contains invalid characters.';
    },
    validate: function validate(value) {
        var ex = /[^a-zA-Z0-9.\-_]/g;
        if (ex.exec(value)) {
            return false;
        }

        return true;
    }
});
__WEBPACK_IMPORTED_MODULE_0_vee_validate__["Validator"].localize('en', dictionary);

/***/ }),

/***/ 46:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* unused harmony export validate */
var _slicedToArray = function () { function sliceIterator(arr, i) { var _arr = []; var _n = true; var _d = false; var _e = undefined; try { for (var _i = arr[Symbol.iterator](), _s; !(_n = (_s = _i.next()).done); _n = true) { _arr.push(_s.value); if (i && _arr.length === i) break; } } catch (err) { _d = true; _e = err; } finally { try { if (!_n && _i["return"]) _i["return"](); } finally { if (_d) throw _e; } } return _arr; } return function (arr, i) { if (Array.isArray(arr)) { return arr; } else if (Symbol.iterator in Object(arr)) { return sliceIterator(arr, i); } else { throw new TypeError("Invalid attempt to destructure non-iterable instance"); } }; }();

/**
 * Custom VeeValidate validation rule to validate minimum dimensions for an image (instead of exact dimensions, which is
 * how the default validator checks)
 *
 * @param file
 * @param width
 * @param height
 * @returns {Promise<any>}
 */
var validateImage = function validateImage(file, width, height) {
    var URL = window.URL || window.webkitURL;
    return new Promise(function (resolve) {
        var image = new Image();
        image.onerror = function () {
            return resolve({ valid: false });
        };
        image.onload = function () {
            return resolve({
                valid: image.width >= Number(width) && image.height >= Number(height)
            });
        };

        image.src = URL.createObjectURL(file);
    });
};

var validate = function validate(files, _ref) {
    var _ref2 = _slicedToArray(_ref, 2),
        width = _ref2[0],
        height = _ref2[1];

    var list = [];
    for (var i = 0; i < files.length; i++) {
        // if file is not an image, reject.
        if (!/\.(jpg|svg|jpeg|png|bmp|gif)$/i.test(files[i].name)) {
            return false;
        }

        list.push(files[i]);
    }

    return Promise.all(list.map(function (file) {
        return validateImage(file, width, height);
    }));
};



/* harmony default export */ __webpack_exports__["a"] = ({
    validate: validate
});

/***/ }),

/***/ 49:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0_axios__ = __webpack_require__(23);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0_axios___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_0_axios__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__User__ = __webpack_require__(50);
function _toConsumableArray(arr) { if (Array.isArray(arr)) { for (var i = 0, arr2 = Array(arr.length); i < arr.length; i++) { arr2[i] = arr[i]; } return arr2; } else { return Array.from(arr); } }

// App Store




/* harmony default export */ __webpack_exports__["a"] = ({
    namespaced: true,
    state: {
        navigation: {},
        user: new __WEBPACK_IMPORTED_MODULE_1__User__["a" /* default */](),
        tempUser: null,
        settings: [],
        genres: [],
        releases: [],
        classes: [],
        keys: [],
        page: {},
        feed: [],
        plans: [],
        pricePerFeaturedSlot: ""
    },
    mutations: {
        setNavigation: function setNavigation(state, data) {
            state.navigation = data;
        },
        setUser: function setUser(state, user) {
            state.user.set(user);
        },
        unsetUser: function unsetUser(state) {
            state.user.unset();
        },
        setTempUser: function setTempUser(state, user) {
            state.tempUser = user;
        },
        unsetTempUser: function unsetTempUser(state) {
            state.tempUser = null;
        },
        setUserAvatar: function setUserAvatar(state, avatar) {
            state.user.avatar = avatar;
        },
        setUserBanner: function setUserBanner(state, banner) {
            state.user.banner = banner;
        },
        setUserReleases: function setUserReleases(state, releases) {
            var _state$user$releases$;

            (_state$user$releases$ = state.user.releases.data).push.apply(_state$user$releases$, _toConsumableArray(releases.data));
            state.user.releases.current_page = releases.current_page;
            state.user.releases.next_page_url = releases.next_page_url;
            state.user.releases.prev_page_url = releases.prev_page_url;
            state.user.releases.last_page = releases.last_page;
            state.user.releases.from = releases.from;
            state.user.releases.to = releases.to;
        },
        setUserEvents: function setUserEvents(state, events) {
            state.user.events = events;
        },
        setSettings: function setSettings(state, settings) {
            state.settings = settings;
        },
        setGenres: function setGenres(state, genres) {
            state.genres = genres;
        },
        setReleases: function setReleases(state, releases) {
            state.releases = releases;
        },
        setReleaseClasses: function setReleaseClasses(state, releaseClasses) {
            var keys = Object.keys(releaseClasses);
            for (var i = 0; i < keys.length; i++) {
                state.classes.push({
                    val: keys[i],
                    name: releaseClasses[keys[i]]
                });
            }
        },
        setMusicKeys: function setMusicKeys(state, musicKeys) {
            var keys = Object.keys(musicKeys);
            for (var i = 0; i < keys.length; i++) {
                state.keys.push({
                    val: keys[i],
                    name: musicKeys[keys[i]]
                });
            }
        },
        setPageData: function setPageData(state, data) {
            state.page = data;
        },
        setFeed: function setFeed(state, feed) {
            state.feed = feed;
        },
        setPlans: function setPlans(state, plans) {
            state.plans = plans;
        },
        setPrice: function setPrice(state, price) {
            state.pricePerFeaturedSlot = price;
        },
        removeUserReleaseFromState: function removeUserReleaseFromState(state, release) {
            state.user.removeRelease(release);
        },
        updateStatus: function updateStatus(state, data) {
            state.user.updateStatus(data);
        },
        incrementTrackCount: function incrementTrackCount(state) {
            state.user.incrementTrackCount();
        }
    },

    actions: {
        fetchNavigation: function fetchNavigation(_ref) {
            var commit = _ref.commit,
                state = _ref.state;

            var data = {
                main_menu: [{
                    title: "My Feed",
                    to: "/",
                    only: { authenticated: true, guest: false }
                }, {
                    title: "New Music",
                    to: "/new"
                }, {
                    title: "Charts",
                    to: "/charts"
                }, {
                    title: "Genres",
                    to: "/genres"
                }, {
                    title: "Discover",
                    to: "/discover"
                }],

                slideout_menu: [{
                    action: "modal",
                    title: "Login",
                    modal: "modal-auth-login",
                    only: { guest: true }
                }, {
                    action: "modal",
                    title: "Register",
                    modal: "modal-auth-register",
                    only: { guest: true }
                }, {
                    title: "My Account",
                    to: "/account",
                    only: { authenticated: true, guest: false }
                }, {
                    title: "My Profile",
                    to: "/account/profile",
                    only: { authenticated: true, guest: false }
                }, {
                    title: "My Music",
                    to: "/account/mymusic",
                    only: { authenticated: true, guest: false }
                }, {
                    title: "Private Messages",
                    to: "/user/messages",
                    only: { authenticated: true, guest: false }
                }, {
                    action: "modal",
                    title: "Cart",
                    only: { authenticated: true, guest: false },
                    modal: "modal-cart"
                }, {
                    title: "News",
                    to: "/news"
                }, {
                    title: "Help & Support",
                    to: "/help"
                }],
                footer_one: [{
                    title: "Charts",
                    to: "/charts"
                }, {
                    title: "Genres",
                    to: "/genres"
                }, {
                    title: "Discover",
                    to: "/discover"
                }, {
                    title: "News",
                    to: "/news"
                }],
                footer_two: [
                    // {
                    //     title: "Sample Packs",
                    //     to: "/samples"
                    // },
                    // {
                    //     title: "News",
                    //     to: "/news"
                    // }
                ],
                footer_three: [
                // {
                //     title: "About",
                //     to: "/about"
                // },
                {
                    title: "Help & Support",
                    to: "/help"
                }, {
                    action: 'modal',
                    title: 'Join Mailing List',
                    modal: 'modal-mailing-list'
                }],
                footer_four: [{
                    action: "modal",
                    title: "Login",
                    modal: "modal-auth-login",
                    only: { guest: true }
                }, {
                    action: "modal",
                    title: "Register",
                    modal: "modal-auth-register",
                    only: { guest: true }
                }],
                footer_five: [
                    // {
                    //     action: 'modal',
                    //     title: 'Join Mailing List',
                    //     modal: 'modal-mailing-list',
                    // },
                ],
                footer_lower: [{
                    title: "Terms of Service",
                    to: "/terms"
                }, {
                    title: "Privacy",
                    to: "/privacy"
                }]
            };

            commit("setNavigation", data);
        },
        fetchGenres: function fetchGenres(_ref2) {
            var commit = _ref2.commit,
                state = _ref2.state;

            if (state.genres.length) return; // Don't re-fetch if data is already set.
            return new Promise(function (resolve, reject) {
                __WEBPACK_IMPORTED_MODULE_0_axios___default.a.get("/api/genres").then(function (response) {
                    commit("setGenres", response.data.data);
                    resolve();
                }).catch(function (error) {
                    console.log(error);
                    reject();
                });
            });
        },
        fetchReleases: function fetchReleases(_ref3) {
            var commit = _ref3.commit,
                state = _ref3.state;

            if (state.releases.length) return; // Don't re-fetch if data is already set.
            return new Promise(function (resolve, reject) {
                __WEBPACK_IMPORTED_MODULE_0_axios___default.a.get("/api/releases/latest").then(function (response) {
                    commit("setReleases", response.data.data);
                    resolve();
                }).catch(function (error) {
                    console.log(error);
                    reject();
                });
            });
        },
        fetchPageData: function fetchPageData(_ref4, page) {
            var commit = _ref4.commit;

            return new Promise(function (resolve, reject) {
                __WEBPACK_IMPORTED_MODULE_0_axios___default.a.post("/api/page", { path: page }).then(function (response) {
                    commit("setPageData", response.data);
                    resolve();
                }).catch(function (error) {
                    console.error(error);
                    reject();
                });
            });
        },
        fetchFeed: function fetchFeed(_ref5) {
            var commit = _ref5.commit,
                state = _ref5.state;

            // TODO - how does this result get cleared?
            if (state.feed.length) return; // Don't re-fetch if data is already set.
            return new Promise(function (resolve, reject) {
                __WEBPACK_IMPORTED_MODULE_0_axios___default.a.get("/api/feed").then(function (response) {
                    // console.log(response.data);
                    commit("setFeed", response.data.data);
                    resolve();
                }).catch(function (error) {
                    // !! IDEA - catch and handle 422 errors.
                    reject();
                });
            });
        },
        fetchPlans: function fetchPlans(_ref6) {
            var commit = _ref6.commit,
                state = _ref6.state;

            return new Promise(function (resolve, reject) {
                __WEBPACK_IMPORTED_MODULE_0_axios___default.a.get("api/plans").then(function (response) {
                    commit("setPlans", response.data);
                    resolve();
                }).catch(function (error) {
                    reject();
                });
            });
        },
        fetchPricePerFeaturedSlot: function fetchPricePerFeaturedSlot(_ref7) {
            var commit = _ref7.commit,
                state = _ref7.state;

            __WEBPACK_IMPORTED_MODULE_0_axios___default.a.get("/api/price-per-featured-slot").then(function (response) {
                commit("setPrice", response.data);
            }).catch(function (e) {
                return;
            });
        },
        fetchUsersReleases: function fetchUsersReleases(_ref8) {
            var commit = _ref8.commit,
                state = _ref8.state,
                getters = _ref8.getters;

            if (!getters.releasesHasAnotherPage) return;

            return new Promise(function (resolve, reject) {
                __WEBPACK_IMPORTED_MODULE_0_axios___default.a.get("/api/account/releases/mine/?page=" + (state.user.releases.current_page + 1)).then(function (response) {
                    commit("setUserReleases", response.data);
                    resolve();
                }).catch(function (error) {
                    reject();
                });
            });
        },
        fetchUsersEvents: function fetchUsersEvents(_ref9) {
            var commit = _ref9.commit,
                state = _ref9.state;

            __WEBPACK_IMPORTED_MODULE_0_axios___default.a.get("/api/event/" + state.user.id + "/list").then(function (response) {
                commit("setUserEvents", response.data);
            });
        },
        removeUserRelease: function removeUserRelease(_ref10, release) {
            var commit = _ref10.commit;

            __WEBPACK_IMPORTED_MODULE_0_axios___default.a.delete("/api/account/releases/mine/delete/" + release.id).then(function (response) {
                commit("removeUserReleaseFromState", release);
            });
        },
        updateUserRelease: function updateUserRelease(_ref11, data) {
            var commit = _ref11.commit;

            __WEBPACK_IMPORTED_MODULE_0_axios___default.a.patch("/api/account/releases/mine/" + data.release.id, {
                status: data.status
            }).then(function (response) {
                commit("updateStatus", data);
            });
        }
    },
    getters: {
        getClassByKey: function getClassByKey(state) {
            return function (key) {
                for (var i = 0; i < state.classes.length; i++) {
                    if (state.classes[i].val === key) {
                        return state.classes[i];
                    }
                }
            };
        },
        getKeyByKey: function getKeyByKey(state) {
            return function (key) {
                for (var i = 0; i < state.keys.length; i++) {
                    if (state.keys[i].val === key) {
                        return state.keys[i];
                    }
                }
            };
        },
        getNavigation: function getNavigation(state) {
            return state.navigation;
        },
        getPageData: function getPageData(state) {
            return state.page;
        },
        getFeed: function getFeed(state) {
            return state.feed;
        },
        getPlans: function getPlans(state) {
            return state.plans;
        },
        getFeaturedSlotPrice: function getFeaturedSlotPrice(state) {
            return state.pricePerFeaturedSlot;
        },
        getUsersReleases: function getUsersReleases(state) {
            return state.user.releases;
        },
        getUsersEvents: function getUsersEvents(state) {
            return state.user.events;
        },
        releasesHasAnotherPage: function releasesHasAnotherPage(state) {
            if (state.user.releases.last_page === 1) return true;
            return state.user.releases.current_page < state.user.releases.last_page;
        },
        getUser: function getUser(state) {
            return state.user;
        },
        getUserLoggedIn: function getUserLoggedIn(state) {
            return state.user.loggedin;
        },
        getTempUser: function getTempUser(state) {
            return state.tempUser;
        }
    }
});

/***/ }),

/***/ 50:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony export (immutable) */ __webpack_exports__["a"] = User;
/**
 * Retrieve, store and manipulate data relating to the currently
 * logged in user.
 *
 * @constructor
 */
function User() {
    var _this = this;

    // From JSON API
    // Remembering to update these variables when the user schema or relationships changes is tricky!
    this.bio = '';
    this.loggedin = false;
    this.id = -1;
    this.avatar_id = -1;
    this.banner_id = -1;
    this.path = '';
    this.name = '';
    this.last_name = '';
    this.first_name = '';
    this.email = '';
    this.payment_method = '';
    this.paypal_linked = false;
    this.social_web = '';
    this.social_youtube = '';
    this.social_twitter = '';
    this.social_facebook = '';
    this.deleted_at = '';
    this.created_at = '';
    this.updated_at = '';
    this.account_type = '';
    this.avatar = {};
    this.banner = {};
    this.followed = {};
    this.releases = {
        current_page: 0,
        data: [],
        last_page: 1
    };
    this.all_permissions = [], this.interests = [], this.tracks_count_this_month = 0, this.account_verified = false, this.plays = [], this.events = null,

    /**
     * Set (login) user data
     * @param data
     */
    this.set = function (data) {
        for (var key in data) {
            _this[key] = data[key];
        }
        _this.loggedin = true;
    };

    /**
     * Unset (logout) user data
     */
    this.unset = function () {
        for (var key in _this) {
            if (typeof _this[key] !== 'function') {
                _this[key] = null;
            }
        }
        _this.loggedin = false;
    };

    /**
     * Get user favourites for a certain favouritable type
     *
     * @param favouritable e.g. 'track'
     */
    this.favourites = function (favouritable) {
        // ...
    };

    this.getFollowed = function () {
        window.axios.get('/api/user/followed').then(function (response) {
            _this.followed = response.data;
        });
    };

    /**
     * Get user messages
     */
    this.messages = function () {
        // ...
    };

    this.removeRelease = function (release) {
        _this.releases.data.splice(_this.releases.data.indexOf(release), 1);
    };

    this.updateStatus = function (data) {
        var index = _this.releases.data.indexOf(data.release);
        _this.releases.data[index].status = data.status;
    };

    this.incrementTrackCount = function () {
        _this.tracks_count_this_month++;
    };
}

/***/ }),

/***/ 51:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0_vue__ = __webpack_require__(12);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0_vue___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_0_vue__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1_store__ = __webpack_require__(9);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__CartManager__ = __webpack_require__(36);





// Cart Store
/* harmony default export */ __webpack_exports__["a"] = ({
    namespaced: true,
    state: {
        items: [],
        loading: true
    },
    mutations: {
        reset: function reset(state) {
            state.items = [];
        },
        loaded: function loaded(state, value) {
            state.loading = value;
        },
        addItem: function addItem(state, item) {
            if (typeof item.format === 'undefined') {
                item.format = 'mp3';
            }

            var exists = !!state.items.find(function (i) {
                return i.id === item.id;
            });
            if (!exists) {
                state.items.push(item);
            }
        },
        removeItem: function removeItem(state, index) {
            state.items.splice(index, 1);
        },
        changeItemFormat: function changeItemFormat(state, _ref) {
            var item = _ref.item,
                format = _ref.format;

            for (var i = 0; i < state.items.length; i++) {
                if (state.items[i] === item) {
                    state.items[i].format = format;
                    __WEBPACK_IMPORTED_MODULE_0_vue___default.a.set(state.items, i, state.items[i]);
                }
            }
        }
    },
    actions: {
        addItem: function addItem(_ref2, item) {
            var state = _ref2.state,
                commit = _ref2.commit;
            var format = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : 'mp3';

            item.format = format;
            var already = _.find(state.items, function (iterable) {
                return iterable.id === item.id && iterable.type === item.type;
            });
            if (!already) {
                commit('addItem', item);
                __WEBPACK_IMPORTED_MODULE_2__CartManager__["a" /* default */].saveCookie();
                __WEBPACK_IMPORTED_MODULE_2__CartManager__["a" /* default */].saveItemToServer(item);
            }
        },
        removeItem: function removeItem(_ref3, item) {
            var state = _ref3.state,
                commit = _ref3.commit;

            for (var i = 0; i < state.items.length; i++) {
                if (state.items[i].id === item.id && state.items[i].type === item.type) {
                    // Inform the server of the removal
                    axios.post('/api/cart/item/remove', {
                        type: item.type,
                        id: item.id
                    });

                    // Remove from the local store
                    commit('removeItem', i);
                    __WEBPACK_IMPORTED_MODULE_2__CartManager__["a" /* default */].saveCookie(state.items);
                }
            }
        },
        changeItemFormat: function changeItemFormat(_ref4, _ref5) {
            var state = _ref4.state,
                commit = _ref4.commit;
            var item = _ref5.item,
                format = _ref5.format;

            __WEBPACK_IMPORTED_MODULE_2__CartManager__["a" /* default */].changeItemFormat(item, format);
            commit('changeItemFormat', { item: item, format: format });
        },
        load: function load(_ref6) {
            var commit = _ref6.commit;

            return new Promise(function (resolve, reject) {
                commit('reset');
                __WEBPACK_IMPORTED_MODULE_2__CartManager__["a" /* default */].load().then(function (data) {
                    for (var i = 0; i < data.length; i++) {
                        commit('addItem', data[i]);
                    }
                }).catch(function () {
                    reject();
                    // No server / cookie items set
                }).finally(function () {
                    resolve();
                });
            });
        },
        reset: function reset(_ref7) {
            var commit = _ref7.commit;

            commit('reset');
            __WEBPACK_IMPORTED_MODULE_2__CartManager__["a" /* default */].reset();
        },
        setLoading: function setLoading(_ref8, value) {
            var commit = _ref8.commit;

            commit('loaded', value);
        }
    },
    getters: {
        isInCart: function isInCart(state) {
            return function (item) {
                return Boolean(state.items.find(function (iterable) {
                    return iterable.id === item.id && iterable.type === item.type;
                }));
            };
        },
        getItemPrice: function getItemPrice(state) {
            return function (item) {
                for (var i = 0; i < state.items.length; i++) {
                    if (state.items[i] === item) {
                        var price = state.items[i].price;
                        if (state.items[i].format === 'wav') {
                            if (state.items[i].type === 'release') {
                                price += parseInt(__WEBPACK_IMPORTED_MODULE_1_store__["a" /* default */].state.app.settings[2].wav_fee) * state.items[i].tracks.length;
                            } else {
                                price += parseInt(__WEBPACK_IMPORTED_MODULE_1_store__["a" /* default */].state.app.settings[2].wav_fee);
                            }
                        }
                        return price;
                    }
                }
            };
        },
        getTotal: function getTotal(state, getters) {
            var total = 0;
            for (var i = 0; i < state.items.length; i++) {
                total += getters.getItemPrice(state.items[i]);
            }
            return (total / 100).toFixed(2);
        },
        getTax: function getTax(state, getters) {
            return getters.getTotal;
        }
    }
});

/***/ }),

/***/ 52:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
function _toConsumableArray(arr) { if (Array.isArray(arr)) { for (var i = 0, arr2 = Array(arr.length); i < arr.length; i++) { arr2[i] = arr[i]; } return arr2; } else { return Array.from(arr); } }

// News Store
/* harmony default export */ __webpack_exports__["a"] = ({
    namespaced: true,
    state: {
        nextPage: 1,
        totalPages: 0,
        categoryPath: null,
        articles: [],
        categories: []
    },
    mutations: {
        setArticles: function setArticles(state, payload) {
            var _state$articles;

            state.nextPage = payload.currentPageNumber + 1;
            state.totalPages = payload.totalPagesNumber;

            (_state$articles = state.articles).push.apply(_state$articles, _toConsumableArray(payload.articles));
        },
        setCategories: function setCategories(state, categories) {
            state.categories = categories;
        },

        /**
         * Update the user's like boolean for an article
         * Does not POST to server because that is handled by the like button
         */
        likeArticle: function likeArticle(state, articleid) {
            for (var i = 0; i < state.articles.length; i++) {
                if (state.articles[i].id === articleid) {
                    state.articles[i].like_count += 1;
                    state.articles[i].is_liked = true;
                }
            }
        },
        unlikeArticle: function unlikeArticle(state, articleid) {
            for (var i = 0; i < state.articles.length; i++) {
                if (state.articles[i].id === articleid) {
                    state.articles[i].like_count -= 1;
                    state.articles[i].is_liked = false;
                }
            }
        },
        shareArticle: function shareArticle(state, articleid) {
            for (var i = 0; i < state.articles.length; i++) {
                if (state.articles[i].id === articleid) {
                    state.articles[i].share_count += 1;
                    state.articles[i].is_shared = true;
                }
            }
        }
    },
    actions: {
        requireArticles: function requireArticles(_ref, categoryPath) {
            var state = _ref.state,
                dispatch = _ref.dispatch;

            if (!state.articles.length || categoryPath !== state.categoryPath) {
                dispatch('fetchArticles', categoryPath);
            }
        },
        fetchArticles: function fetchArticles(_ref2, categoryPath) {
            var commit = _ref2.commit,
                state = _ref2.state,
                getters = _ref2.getters;

            if (categoryPath !== state.categoryPath) {
                // We are now requesting data on a different category, discard existing data
                state.nextPage = 1;
                state.totalPages = 0;
                state.articles = [];
            }
            state.categoryPath = categoryPath;

            if (!getters.hasAnotherPage) return; // Don't fetch a page that doesn't exist!

            var apiPath = '/api/news?page=';
            if (state.categoryPath) {
                apiPath = '/api/news/category/' + state.categoryPath + '/?page=';
            }

            return new Promise(function (resolve, reject) {
                axios.get(apiPath + state.nextPage).then(function (response) {
                    commit('setArticles', {
                        currentPageNumber: response.data.current_page,
                        totalPagesNumber: response.data.last_page,
                        articles: response.data.data
                    });
                    resolve();
                }).catch(function (error) {
                    console.log(error);
                    reject();
                });
            });
        },
        fetchCategories: function fetchCategories(_ref3) {
            var commit = _ref3.commit,
                state = _ref3.state;

            if (state.categories.length) return; // Don't fetch categories if we already have them!
            return new Promise(function (resolve, reject) {
                axios.get('/api/categories').then(function (response) {
                    commit('setCategories', response.data.data);
                    resolve();
                }).catch(function (error) {
                    console.log(error);
                    reject();
                });
            });
        }
    },
    getters: {
        hasAnotherPage: function hasAnotherPage(state) {
            if (state.totalPages === 0) return true;
            return state.nextPage <= state.totalPages;
        }
    }
});

/***/ }),

/***/ 53:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
// Search Store
/* harmony default export */ __webpack_exports__["a"] = ({
    namespaced: true,
    state: {
        visible: false,
        searchTerm: ''
    },
    mutations: {
        toggleSearch: function toggleSearch(state) {
            var value = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : null;

            if (value === null) {
                state.visible = !state.visible;
            } else {
                state.visible = value;
            }
        },
        setSearchTerm: function setSearchTerm(state, newSearchTerm) {
            state.searchTerm = newSearchTerm;
        }
    },
    actions: {},
    getters: {
        getSearchTerm: function getSearchTerm(state) {
            return state.searchTerm;
        }
    }
});

/***/ }),

/***/ 54:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
// Message Store
/* harmony default export */ __webpack_exports__["a"] = ({
    namespaced: true,

    state: {
        threads: [],
        currentThread: [],
        unreadThreads: []
    },

    mutations: {
        removeReadThread: function removeReadThread(state, index) {
            state.unreadThreads.splice(index, 1);
        },
        setThreads: function setThreads(state, threads) {
            state.threads = threads;
        },
        setUnreadThreads: function setUnreadThreads(state, threads) {
            state.unreadThreads = [];
            threads.forEach(function (thread) {
                if (thread.read_at === null) {
                    state.unreadThreads.push(thread);
                }
            });
        },
        addThread: function addThread(state, thread) {
            state.threads.push(thread);
        },
        setCurrentThread: function setCurrentThread(state, thread) {
            state.currentThread = thread;
        },
        newMessageInThread: function newMessageInThread(state, payload) {
            // state.threads.forEach(item => {
            var thread = payload.thread,
                message = payload.message;


            if (state.currentThread.id == 1) {
                state.currentThread.messages.push(message);
            }
            // });
        }
    },

    actions: {
        fetchThreads: function fetchThreads(_ref) {
            var commit = _ref.commit;

            axios.get('/api/threads/mine').then(function (response) {
                commit('setThreads', response.data);
                commit('setUnreadThreads', response.data);
            }).catch(function (error) {
                return console.log(error);
            });
        },
        getCurrentThread: function getCurrentThread(_ref2, id) {
            var commit = _ref2.commit,
                dispatch = _ref2.dispatch;

            axios.get('/api/thread/' + id).then(function (response) {
                commit('setCurrentThread', response.data);
                dispatch('fetchThreads'); //to get latest unread messages for top dropdown
            }).catch(function (error) {
                return console.log(error);
            });
        },
        markread: function markread(_ref3, payload) {
            var commit = _ref3.commit;

            //send ajax call to mark thread as read for current user
            axios.get('/api/thread/markread/' + payload.id).then(function (response) {
                commit('removeReadThread', payload.index);
            }).catch(function (error) {
                return console.log(error);
            });
            //remove the message from unreadThreads array
            console.log(payload.id, payload.index);
        }
    }
});

/***/ }),

/***/ 55:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
// Player Store

/* harmony default export */ __webpack_exports__["a"] = ({
    namespaced: true,
    state: {
        track: {
            name: ''
        },
        status: {
            set: false,
            playing: false,
            dragging: false,
            muted: false,
            position: -1, // Percentage between 0 and 1
            time: {
                current: 0,
                max: -1 // Default
            }
        },
        repeat: false,
        shuffle: false
    },
    mutations: {
        setCurrentTime: function setCurrentTime(state, value) {
            state.status.time.current = value;
        },
        setMaxTime: function setMaxTime(state, value) {
            state.status.time.max = value;
        },
        setPosition: function setPosition(state, value) {
            state.status.position = value;
        },
        setPlaying: function setPlaying(state, value) {
            state.status.playing = value;
        },
        setMuted: function setMuted(state, value) {
            state.status.muted = value;
        },
        setRepeat: function setRepeat(state, value) {
            state.repeat = value;
        },
        setDragging: function setDragging(state, value) {
            state.status.dragging = value;
        },
        setTrack: function setTrack(state, value) {
            state.track = value;
            state.status.set = true;
        }
    },
    actions: {},
    getters: {
        getTrack: function getTrack(state) {
            return state.track;
        },

        getTrackByType: function getTrackByType(state) {
            return function (type) {
                return state.track[type];
            };
        }
    }
});

/***/ }),

/***/ 56:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0_axios__ = __webpack_require__(23);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0_axios___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_0_axios__);
function _toConsumableArray(arr) { if (Array.isArray(arr)) { for (var i = 0, arr2 = Array(arr.length); i < arr.length; i++) { arr2[i] = arr[i]; } return arr2; } else { return Array.from(arr); } }



/* harmony default export */ __webpack_exports__["a"] = ({
  namespaced: true,
  state: {
    nextPage: 1,
    totalPages: 0,
    items: []
  },
  mutations: {
    setMusic: function setMusic(state, data) {
      var _state$items;

      state.nextPage = data.currentPageNumber + 1;
      state.totalPages = data.totalPagesNumber;

      (_state$items = state.items).push.apply(_state$items, _toConsumableArray(data.items));
      // state.items = data
    }
  },
  actions: {
    fetchMusic: function fetchMusic(_ref) {
      var commit = _ref.commit,
          state = _ref.state,
          getters = _ref.getters;

      if (!getters.hasAnotherPage) return;
      return new Promise(function (resolve, reject) {
        __WEBPACK_IMPORTED_MODULE_0_axios___default.a.get('/api/new-music?page=' + state.nextPage).then(function (response) {
          commit('setMusic', {
            currentPageNumber: response.data.current_page,
            totalPagesNumber: response.data.last_page,
            items: response.data.data
          });
          resolve();
        }).catch(function (error) {
          console.log(error);
          reject();
        });
      });
    }
  },
  getters: {
    hasAnotherPage: function hasAnotherPage(state) {
      if (state.totalPages === 0) return true;
      return state.nextPage <= state.totalPages;
    }
  }
});

/***/ }),

/***/ 57:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
function _toConsumableArray(arr) { if (Array.isArray(arr)) { for (var i = 0, arr2 = Array(arr.length); i < arr.length; i++) { arr2[i] = arr[i]; } return arr2; } else { return Array.from(arr); } }

// Merch Store
/* harmony default export */ __webpack_exports__["a"] = ({
  namespaced: true,
  state: {
    nextPage: 1,
    totalPages: 0,
    items: []
  },
  mutations: {
    setMerch: function setMerch(state, payload) {
      var _state$items;

      state.nextPage = payload.currentPageNumber + 1;
      state.totalPages = payload.totalPagesNumber;

      (_state$items = state.items).push.apply(_state$items, _toConsumableArray(payload.merch));
    }
  },
  actions: {
    requireMerch: function requireMerch(_ref) {
      var state = _ref.state,
          dispatch = _ref.dispatch;

      if (!state.items.length) {
        dispatch('fetchMerch');
      }
    },
    fetchMerch: function fetchMerch(_ref2) {
      var commit = _ref2.commit,
          state = _ref2.state,
          getters = _ref2.getters;

      if (!getters.hasAnotherPage) return; // Don't fetch a page that doesn't exist!

      var apiPath = '/api/merch?page=';

      return new Promise(function (resolve, reject) {
        axios.get(apiPath + state.nextPage).then(function (response) {
          commit('setMerch', {
            currentPageNumber: response.data.current_page,
            totalPagesNumber: response.data.last_page,
            merch: response.data.data
          });
          resolve();
        }).catch(function (error) {
          console.log(error);
          reject();
        });
      });
    }
  },
  getters: {
    hasAnotherPage: function hasAnotherPage(state) {
      if (state.totalPages === 0) return true;
      return state.nextPage <= state.totalPages;
    }
  }
});

/***/ }),

/***/ 67:
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(68);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(1)("4614e30b", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../../../node_modules/css-loader/index.js?sourceMap!../../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-5266f739\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../../node_modules/sass-loader/lib/loader.js!../../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./genre-select.vue", function() {
     var newContent = require("!!../../../../../../../node_modules/css-loader/index.js?sourceMap!../../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-5266f739\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../../node_modules/sass-loader/lib/loader.js!../../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./genre-select.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ 68:
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(0)(true);
// imports


// module
exports.push([module.i, "/**\n *\n * FONTS\n *\n */\n/**\n *\n * COLORS\n *\n */\n[data-v-5266f739]:root {\n  --strong-blue: #3300ff;\n  --very-light-pink: #e6e6e6;\n  --light-aqua: #9eefe1;\n  --black: #000000;\n  --brown-grey: #848484;\n  --white: #ffffff;\n  --bright-sky-blue: #00ccff;\n  --cyan: #00ffff;\n  --primary-blue: #0000ff;\n  --cloudy-blue: #bcbec0;\n}\n\n/*\n * State Colors\n */\n.genre-select ul.search-results[data-v-5266f739] {\n  background: white;\n  border-left: 1px solid #a5a5a5;\n  border-right: 1px solid #a5a5a5;\n  border-bottom: 1px solid #a5a5a5;\n}\n.genre-select ul.search-results li[data-v-5266f739] {\n    padding: 5px;\n    cursor: pointer;\n}\n.genre-select ul.search-results li.highlighted[data-v-5266f739] {\n      background: #f2f2f2;\n}\n.genre-select p[data-v-5266f739] {\n  margin: 5px 0;\n  color: #a5a5a5;\n  font-size: 10px;\n}\n.genre-select ul.selected-genres[data-v-5266f739] {\n  margin: 5px 0;\n}\n.genre-select ul.selected-genres li[data-v-5266f739] {\n    display: inline-block;\n    padding: 5px;\n    margin-right: 5px;\n    cursor: pointer;\n    background: #d9d9d9;\n    border-radius: 5px;\n}\n.genre-select ul.selected-genres li[data-v-5266f739]:hover {\n      background: #cccccc;\n}\n.genre-select input[data-v-5266f739] {\n  -webkit-box-sizing: border-box;\n          box-sizing: border-box;\n  font-size: inherit;\n  border: 1px solid #a5a5a5;\n  padding: 5px;\n  border-radius: 2px;\n  width: 100%;\n}\n", "", {"version":3,"sources":["/var/www/html/resources/assets/js/vue/components/modals/upload/genre-select.vue"],"names":[],"mappings":"AAAA;;;;GAIG;AACH;;;;GAIG;AACH;EACE,uBAAuB;EACvB,2BAA2B;EAC3B,sBAAsB;EACtB,iBAAiB;EACjB,sBAAsB;EACtB,iBAAiB;EACjB,2BAA2B;EAC3B,gBAAgB;EAChB,wBAAwB;EACxB,uBAAuB;CAAE;;AAE3B;;GAEG;AACH;EACE,kBAAkB;EAClB,+BAA+B;EAC/B,gCAAgC;EAChC,iCAAiC;CAAE;AACnC;IACE,aAAa;IACb,gBAAgB;CAAE;AAClB;MACE,oBAAoB;CAAE;AAE5B;EACE,cAAc;EACd,eAAe;EACf,gBAAgB;CAAE;AAEpB;EACE,cAAc;CAAE;AAChB;IACE,sBAAsB;IACtB,aAAa;IACb,kBAAkB;IAClB,gBAAgB;IAChB,oBAAoB;IACpB,mBAAmB;CAAE;AACrB;MACE,oBAAoB;CAAE;AAE5B;EACE,+BAAuB;UAAvB,uBAAuB;EACvB,mBAAmB;EACnB,0BAA0B;EAC1B,aAAa;EACb,mBAAmB;EACnB,YAAY;CAAE","file":"genre-select.vue","sourcesContent":["/**\n *\n * FONTS\n *\n */\n/**\n *\n * COLORS\n *\n */\n:root {\n  --strong-blue: #3300ff;\n  --very-light-pink: #e6e6e6;\n  --light-aqua: #9eefe1;\n  --black: #000000;\n  --brown-grey: #848484;\n  --white: #ffffff;\n  --bright-sky-blue: #00ccff;\n  --cyan: #00ffff;\n  --primary-blue: #0000ff;\n  --cloudy-blue: #bcbec0; }\n\n/*\n * State Colors\n */\n.genre-select ul.search-results {\n  background: white;\n  border-left: 1px solid #a5a5a5;\n  border-right: 1px solid #a5a5a5;\n  border-bottom: 1px solid #a5a5a5; }\n  .genre-select ul.search-results li {\n    padding: 5px;\n    cursor: pointer; }\n    .genre-select ul.search-results li.highlighted {\n      background: #f2f2f2; }\n\n.genre-select p {\n  margin: 5px 0;\n  color: #a5a5a5;\n  font-size: 10px; }\n\n.genre-select ul.selected-genres {\n  margin: 5px 0; }\n  .genre-select ul.selected-genres li {\n    display: inline-block;\n    padding: 5px;\n    margin-right: 5px;\n    cursor: pointer;\n    background: #d9d9d9;\n    border-radius: 5px; }\n    .genre-select ul.selected-genres li:hover {\n      background: #cccccc; }\n\n.genre-select input {\n  box-sizing: border-box;\n  font-size: inherit;\n  border: 1px solid #a5a5a5;\n  padding: 5px;\n  border-radius: 2px;\n  width: 100%; }\n"],"sourceRoot":""}]);

// exports


/***/ }),

/***/ 69:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0_vuex__ = __webpack_require__(4);
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//


//import Component from '../';
/* harmony default export */ __webpack_exports__["default"] = ({
    props: {
        min: {
            type: Number,
            default: 1
        },
        max: {
            type: Number,
            default: 3
        },
        disabled: {
            type: Boolean
        },
        populated: {
            type: Array,
            default: function _default() {
                return [];
            }
        }
    },
    data: function data() {
        return {
            searchTerm: "",
            searchResults: [],
            showList: false,
            selectedGenres: [],
            arrowCounter: -1
        };
    },
    created: function created() {
        this.selectedGenres = this.populated;
    },

    computed: Object(__WEBPACK_IMPORTED_MODULE_0_vuex__["mapState"])(["app"]),
    mounted: function mounted() {
        this.$store.dispatch("app/fetchGenres");
    },
    methods: {
        input: function input() {
            if (this.searchTerm.length > 0) {
                this.showList = true;
                this.search();
            } else {
                this.showList = false;
            }
        },
        search: function search() {
            var _this = this;

            this.searchResults = [];
            _.forEach(this.app.genres, function (genre) {
                if (genre.name.toLowerCase().includes(_this.searchTerm.toLowerCase())) {
                    // If genre name includes search term
                    if (!_.find(_this.selectedGenres, function (g) {
                        return g.id === genre.id;
                    })) {
                        // If genre is not already selected
                        _this.searchResults.push(genre);
                    }
                }
            });
        },
        selectGenre: function selectGenre(genre) {
            this.arrowCounter = -1;
            this.searchTerm = "";
            this.input();
            this.selectedGenres.push(genre);
            this.$emit("change", this.selectedGenres);
        },
        removeGenre: function removeGenre(genreToDelete) {
            this.selectedGenres = _.filter(this.selectedGenres, function (genre) {
                return genre.id !== genreToDelete.id;
            });
            this.input();
            this.$emit("change", this.selectedGenres);
        },
        onArrowDown: function onArrowDown() {
            if (this.arrowCounter + 1 < this.searchResults.length) {
                this.arrowCounter += 1;
            }
        },
        onArrowUp: function onArrowUp() {
            if (this.arrowCounter > 0) {
                this.arrowCounter -= 1;
            }
        },
        onEnter: function onEnter() {
            if (this.arrowCounter >= 0) {
                this.selectGenre(this.searchResults[this.arrowCounter]);
            }
        }
    },
    components: {}
});

/***/ }),

/***/ 70:
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", { staticClass: "genre-select" }, [
    _c("input", {
      directives: [
        {
          name: "model",
          rawName: "v-model",
          value: _vm.searchTerm,
          expression: "searchTerm"
        }
      ],
      attrs: {
        type: "text",
        placeholder:
          _vm.selectedGenres.length < _vm.max
            ? "Minimum of " + _vm.min + ", maximum of " + _vm.max + " genres"
            : "Maximum number of genres reached",
        disabled: _vm.selectedGenres.length >= _vm.max || _vm.disabled
      },
      domProps: { value: _vm.searchTerm },
      on: {
        input: [
          function($event) {
            if ($event.target.composing) {
              return
            }
            _vm.searchTerm = $event.target.value
          },
          _vm.input
        ],
        keyup: [
          function($event) {
            if (
              !$event.type.indexOf("key") &&
              _vm._k($event.keyCode, "down", 40, $event.key, [
                "Down",
                "ArrowDown"
              ])
            ) {
              return null
            }
            return _vm.onArrowDown($event)
          },
          function($event) {
            if (
              !$event.type.indexOf("key") &&
              _vm._k($event.keyCode, "up", 38, $event.key, ["Up", "ArrowUp"])
            ) {
              return null
            }
            return _vm.onArrowUp($event)
          },
          function($event) {
            if (
              !$event.type.indexOf("key") &&
              _vm._k($event.keyCode, "enter", 13, $event.key, "Enter")
            ) {
              return null
            }
            return _vm.onEnter($event)
          }
        ],
        keydown: function($event) {
          if (
            !$event.type.indexOf("key") &&
            _vm._k($event.keyCode, "enter", 13, $event.key, "Enter")
          ) {
            return null
          }
          $event.preventDefault()
        }
      }
    }),
    _vm._v(" "),
    _c(
      "ul",
      {
        directives: [
          {
            name: "show",
            rawName: "v-show",
            value: _vm.showList,
            expression: "showList"
          }
        ],
        staticClass: "search-results"
      },
      _vm._l(_vm.searchResults, function(genre, i) {
        return _c(
          "li",
          {
            key: i,
            class: { highlighted: i === _vm.arrowCounter },
            on: {
              click: function($event) {
                return _vm.selectGenre(genre)
              },
              mouseover: function($event) {
                _vm.arrowCounter = i
              }
            }
          },
          [_vm._v("\n            " + _vm._s(genre.name) + "\n        ")]
        )
      }),
      0
    ),
    _vm._v(" "),
    _vm.selectedGenres.length > 0
      ? _c("p", [_vm._v("\n        Click on a genre to remove it\n    ")])
      : _vm._e(),
    _vm._v(" "),
    _c(
      "ul",
      {
        directives: [
          {
            name: "show",
            rawName: "v-show",
            value: _vm.selectedGenres.length > 0,
            expression: "selectedGenres.length > 0"
          }
        ],
        staticClass: "selected-genres"
      },
      _vm._l(_vm.selectedGenres, function(genre, i) {
        return _c(
          "li",
          {
            key: i,
            on: {
              click: function($event) {
                return _vm.removeGenre(genre)
              }
            }
          },
          [_vm._v("\n            " + _vm._s(genre.name) + "\n        ")]
        )
      }),
      0
    )
  ])
}
var staticRenderFns = []
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-5266f739", module.exports)
  }
}

/***/ }),

/***/ 9:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0_vue__ = __webpack_require__(12);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0_vue___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_0_vue__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1_vuex__ = __webpack_require__(4);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__app__ = __webpack_require__(49);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_3__cart__ = __webpack_require__(51);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_4__news__ = __webpack_require__(52);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_5__search__ = __webpack_require__(53);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_6__messenger__ = __webpack_require__(54);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_7__player__ = __webpack_require__(55);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_8__music__ = __webpack_require__(56);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_9__merch__ = __webpack_require__(57);
// Vue + Vuex


__WEBPACK_IMPORTED_MODULE_0_vue___default.a.use(__WEBPACK_IMPORTED_MODULE_1_vuex__["default"]);

// Store Modules









/* harmony default export */ __webpack_exports__["a"] = (new __WEBPACK_IMPORTED_MODULE_1_vuex__["default"].Store({
    modules: {
        app: __WEBPACK_IMPORTED_MODULE_2__app__["a" /* default */],
        cart: __WEBPACK_IMPORTED_MODULE_3__cart__["a" /* default */],
        news: __WEBPACK_IMPORTED_MODULE_4__news__["a" /* default */],
        search: __WEBPACK_IMPORTED_MODULE_5__search__["a" /* default */],
        messenger: __WEBPACK_IMPORTED_MODULE_6__messenger__["a" /* default */],
        player: __WEBPACK_IMPORTED_MODULE_7__player__["a" /* default */],
        music: __WEBPACK_IMPORTED_MODULE_8__music__["a" /* default */],
        merch: __WEBPACK_IMPORTED_MODULE_9__merch__["a" /* default */]
    }
}));

/***/ })

},[1358]);
//# sourceMappingURL=admin.js.map