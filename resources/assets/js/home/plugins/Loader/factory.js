const factory = (context) => {
    return {
        show() {
            context.dispatch('showLoader')
        },

        hide() {
            context.dispatch('hideLoader')
        }
    }
}

export default factory