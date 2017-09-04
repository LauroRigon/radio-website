
window._ = require('lodash');

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

window.$ = window.jQuery = require('jquery');

/*
plugins
*/
require('bootstrap-timepicker/js/bootstrap-timepicker.min.js');
window.toastr = require('toastr/build/toastr.min.js');
window.Flickity = require('flickity/dist/flickity.pkgd.min.js');
require('flickity-as-nav-for');
window.jConfirm = require ("../dashboard/vendor/jConfirm/jConfirm.js").default;
require('../dashboard/plugins/dropzone/dist/dropzone');

require('bootstrap');

require('../dashboard/vendor/adminLTEapp.js');

window.moment = require('moment');

window.Vue = require('vue');

window.Event = new Vue();	//Instância que é usada pra comunicação entre os componentes

window.axios = require('axios');

window.axios.defaults.headers.common['X-CSRF-TOKEN'] = window.Laravel.csrfToken;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

