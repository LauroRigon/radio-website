import { isEmpty } from 'lodash'

export const isLogged = ({ token }) => !isEmpty(token)

export const getUserLogged = ({ user }) => user

export const getToken = ({ token }) => token