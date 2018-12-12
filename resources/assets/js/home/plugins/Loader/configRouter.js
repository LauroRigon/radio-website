const configRouter = (router, store) => {
    router.beforeEach((to, from, next) => {
        store.commit('setLoaderState', true)
        next()
    })
}

export default configRouter