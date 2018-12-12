import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

import actions from './actions.js'
import mutations from './mutations.js'
import state from './state.js'
import getters from './getters.js'
import modules from './modules.js'

export default new Vuex.Store({ state, mutations, actions, getters, modules })