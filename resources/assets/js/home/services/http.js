import { defaults } from 'lodash'
import { authPersistence } from '../services'
import axios from 'axios'

export const http = {
  axiosInstance: axios.create(),


  get(url, successCb = null, errorCb = null) {
    return this.axiosInstance.get(url, successCb, errorCb)
  },

  post(url, data, successCb = null, errorCb = null) {
    return this.axiosInstance.post(url, data, successCb, errorCb)
  },

  put(url, data, successCb = null, errorCb = null) {
    return this.axiosInstance.put(url, data, successCb, errorCb)
  },

  delete(url, data = {}, successCb = null, errorCb = null) {
    return this.axiosInstance.delete(url, data, successCb, errorCb)
  },

  //start configs to axios
  init() {
    this.axiosInstance.defaults.baseURL = '/api'
    let token = document.head.querySelector('meta[name="csrf-token"]');

    this.axiosInstance.interceptors.response.use(response => {
        return response
      }, error => {
        console.log(error)
        // Also, if we receive a Bad Request / Unauthorized error
        if (error.response.status === 400 || error.response.status === 401) {
          // and we're not trying to login
            authPersistence.removeSession()
            Materialize.toast('Ocorreu um erro!', 3000, null, () => window.location.reload())

        }

        if(error.response.status === 403){
          Materialize.toast('Você não pode fazer isso!', 3000)
        }
  
        return Promise.reject(error)
      })
  }
}