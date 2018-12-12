import { http, authPersistence } from '../../../services'

export const attemptLogin = (context, payload) => {
    return http.post('login', payload)
        .then(({ data }) => {
            //set vuex states
            context.commit('setToken', data.token)
            context.commit('setUser', data.user)

            authPersistence.storeToken(data.token)
            authPersistence.storeUser(data.user)
        })
}

export const attemptLogout = (context) => {
    return http.delete('logout')
        .then( ({ data }) => {
            authPersistence.removeSession()
        })
}