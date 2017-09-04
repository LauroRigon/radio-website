import { authPersistence } from '../../../services'

export default {
    user: authPersistence.getStoredUser(),
    token: authPersistence.getStoredToken()
}