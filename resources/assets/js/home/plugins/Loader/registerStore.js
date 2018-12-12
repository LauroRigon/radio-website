import vuexModule from './vuex/' 

const registerStore = store => {
    store.registerModule('LOADER', vuexModule)
}

export default registerStore