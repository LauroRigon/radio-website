import factory from './factory'
import registerStore from './registerStore'
import configRouter from './configRouter'
import Loader from './components/Loader'

const install = (Vue, configs) => {
    const store = configs.store
    const router = configs.router

    registerStore(store)
    configRouter(router, store)

    Vue.component('PageLoader', Loader)

    Object.defineProperty(Vue.prototype, '$loader', {
        get() {
            return factory(store)
        }
    })
}

export default { install }
