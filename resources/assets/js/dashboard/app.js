
//import UserTable from './components/user/UsersTable.vue';
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap.js');
require('bootstrap-timepicker/js/bootstrap-timepicker.min.js');
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
window.Event = new Vue();	//Instância que é usada pra comunicação entre os componentes

window.toastr = require('toastr/build/toastr.min.js');

window.Flickity = require('flickity/dist/flickity.pkgd.min.js')

require('flickity-as-nav-for');
import Chart from 'chart.js';

window.toastr.options = {
    positionClass: "toast-top-right",
    showDuration: "300",
    hideDuration: "1000",
    timeOut: "5000",
    extendedTimeOut: "1000",
    showEasing: "swing",
    hideEasing: "linear",
    showMethod: "fadeIn",
    hideMethod: "fadeOut",
    closeButton: true,
    progressBar: true
};

Vue.component('vue-table', require('./components/partials/VueTable.vue'));
//Vue.component('pagination', require('./components/partials/Pagination.vue'));

Vue.component('user-view-modal', require('./components/user/ViewModal.vue'));
Vue.component('user-create-modal', require('./components/user/CreateModal.vue'));

Vue.component('tab', require('./components/partials/Tab.vue'));
Vue.component('tabs', require('./components/partials/Tabs.vue'));

Vue.component('avatar-upload', require('./components/user/AvatarUpload.vue'));
Vue.component('category-create-modal', require('./components/category/CreateModal.vue'));
Vue.component('category-edit-modal', require('./components/category/EditModal.vue'));

Vue.component('poll-create', require('./components/poll/PollCreate.vue'));

Vue.component('vue-gallery', require('./components/partials/VueGallery.vue'));

Vue.component('post-authorizer', require('./components/post/PostAuthorizer.vue'));

Vue.component('notifications-tab', require('./components/partials/NotificationsTab.vue'));
Vue.component('notifications', require('./components/notification/Notifications.vue'));

Vue.component('music-orders', require('./components/music_order/MusicOrders.vue'));

const app = new Vue({
    el: '#app'
});


