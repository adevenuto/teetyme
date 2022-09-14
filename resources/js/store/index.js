import { createStore } from 'vuex'
import router from '../router'

const store = createStore({
    state() {
    },
    getters: {
    },
    mutations: {
        async setLogOut(state) {
            const logout = await axios.post('/logout')
            if(logout.status === 200) {
                localStorage.removeItem('loggedIn')
                router.push({path: '/login'})
            }
        }
    }
})

export default store