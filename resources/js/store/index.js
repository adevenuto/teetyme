import { createStore } from 'vuex'
import router from '../router'

import VuexPersistence from 'vuex-persist'
const vuexLocal = new VuexPersistence({
    storage: window.localStorage,
    key: 'round_data'
})

const store = createStore({
    state: {
        round_data: null
    },
    getters: {
        get_round_data(state) {
            return state.round_data
        }
    },
    mutations: {
        async setLogOut(state) {
            const logout = await axios.post('/logout')
            if(logout.status === 200) {
                localStorage.removeItem('loggedIn')
                router.push({path: '/login'})
            }
        },
        setRoundData(state, data) {
            state.round_data = data
        }
    },
    plugins: [vuexLocal.plugin]
})

export default store