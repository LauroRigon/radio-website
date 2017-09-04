
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap')

import Vue from 'vue'

import App from './App/App.vue'

import router from './router'

import store from './vuex'

import { http } from './services'

//Vue.component('vue-table', require('./components/VueTable.vue'))

const app = new Vue({
  store,
  router,
  mode: 'history',
  render: h => h(App),
  created() {
    http.init()
  }
}).$mount('#app')
