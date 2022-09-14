require('./bootstrap')

import { createApp } from 'vue'
import router from './router'
import store from './store'
import Logout from './components/auth/Logout'

// PrimeVue
import PrimeVue from 'primevue/config'
import InputText from 'primevue/inputtext'
import Button from 'primevue/button'
import Divider from 'primevue/divider'
import Card from 'primevue/card'
import TabView from 'primevue/tabview'
import TabPanel from 'primevue/tabpanel'
import AutoComplete from 'primevue/autocomplete'
import Dropdown from 'primevue/dropdown'

import DialogService from 'primevue/dialogservice'
import DynamicDialog from 'primevue/dynamicdialog'
import Toast from 'primevue/toast'

// PrimeVue styles/icons
import 'primevue/resources/themes/saga-blue/theme.css'       //theme
import 'primevue/resources/primevue.min.css'                 //core css
import 'primeicons/primeicons.css'                           //icons



const app = createApp({})
app.use(router)
app.use(store)
app.use(PrimeVue)
app.use(DialogService)
app.component('Logout', Logout)
app.component('InputText', InputText)
app.component('Button', Button)
app.component('Card', Card)
app.component('Divider', Divider)
app.component('DynamicDialog', DynamicDialog)
app.component('Toast', Toast)
app.component('TabView', TabView)
app.component('TabPanel', TabPanel)
app.component('AutoComplete', AutoComplete)
app.component('Dropdown', Dropdown)
app.mount('#app')

window.addEventListener('storage', function(e) {
    // if user clears localStorage or the loggedIn key
    if ((e.key === null) || (e.key === 'loggedIn' && e.currentValue !== 'true')) {
        store.commit('setLogOut')
    }
});