export default {
    showLoader(context) {
        context.commit('setLoaderState', true)
    },

    hideLoader(context) {
        context.commit('setLoaderState', false)
    }
}