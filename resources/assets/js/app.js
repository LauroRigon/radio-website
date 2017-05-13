
//import UserTable from './components/user/UsersTable.vue';
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap.js');
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
window.Event = new Vue();	//Instância que é usada pra comunicação entre os componentes

window.toastr = require('toastr/build/toastr.min.js');

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

Vue.component('user-view-modal', require('./components/user/ViewModal.vue'));
Vue.component('user-create-modal', require('./components/user/CreateModal.vue'));

Vue.component('tab', require('./components/partials/Tab.vue'));
Vue.component('tabs', require('./components/partials/Tabs.vue'));

Vue.component('avatar-upload', require('./components/user/AvatarUpload.vue'));
Vue.component('category-create-modal', require('./components/category/CreateModal.vue'));
Vue.component('category-edit-modal', require('./components/category/EditModal.vue'));



const app = new Vue({
    el: '#app'    
});


