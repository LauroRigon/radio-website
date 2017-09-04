import Vue from 'vue'

import VueRouter from 'vue-router'

//rotes
import routes from '../App/routes.js'

//beforeEach function that verify wether user can access some route
import beforeEach from './beforeEach.js'

Vue.use(VueRouter)

const router = new VueRouter({
  routes,
  linkActiveClass: 'active'
})

//router.beforeEach(beforeEach)

export default router