
//import UserTable from './components/user/UsersTable.vue';
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap.js');

window.Flickity = require('flickity/dist/flickity.pkgd.min.js')

require('flickity-as-nav-for');

window.Cookies = require('js-cookie/src/js.cookie.js');
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
//var iCheck = require('icheck');

window.Event = new Vue();	//Instância que é usada pra comunicação entre os componentes

Vue.component('music-order', require('./components/music_order/MusicOrderComponent.vue'));

Vue.component('poll', require('./components/poll/Poll.vue'));

Vue.component('tab', require('./dashboard/components/partials/Tab.vue'));
Vue.component('tabs', require('./dashboard/components/partials/Tabs.vue'));

Vue.component('vue-gallery', require('./dashboard/components/partials/VueGallery.vue'));

const app = new Vue({
    el: '#app'
});


