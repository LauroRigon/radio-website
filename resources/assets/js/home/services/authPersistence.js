import { isEmpty } from 'lodash'


export const authPersistence = {
        storeToken(token) {
            localStorage.setItem('access_token', token)
        },

        storeUser(user) {
            localStorage.setItem('user_logged', JSON.stringify(user))
        },

        getStoredToken() {
            return localStorage.getItem('access_token')
        },

        getStoredUser() {
            return JSON.parse(localStorage.getItem('user_logged'))
        },

        removeSession() {
            localStorage.removeItem('user_logged')
            localStorage.removeItem('access_token')
        }
}