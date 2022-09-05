require('./bootstrap');

import { createApp } from 'vue'
import { createRouter, createWebHistory } from 'vue-router'

// PrimeVue
import PrimeVue from 'primevue/config'
import InputText from 'primevue/inputtext'
import Button from 'primevue/button';
import Divider from 'primevue/divider';
import Card from 'primevue/card';
import TabView from 'primevue/tabview'
import TabPanel from 'primevue/tabpanel'
import AutoComplete from 'primevue/autocomplete'

import DialogService from 'primevue/dialogservice'
import DynamicDialog from 'primevue/dynamicdialog'
import Toast from 'primevue/toast'

// PrimeVue styles/icons
import 'primevue/resources/themes/saga-blue/theme.css'       //theme
import 'primevue/resources/primevue.min.css'                 //core css
import 'primeicons/primeicons.css'                           //icons

// Router
import LandingPage from './components/LandingPage'
import CoursesIndex from './components/courses/CoursesIndex'
import CourseShowEdit from './components/courses/CourseShowEdit'
const routes = [
    { path: '/', component: LandingPage},
    { path: '/courses', component: CoursesIndex},
    { path: '/course/:id', component: CourseShowEdit, name: 'CoursesShowEdit'},
]
const router = createRouter({
    history: createWebHistory(),
    routes
})


const app = createApp({})
app.use(router)
app.use(PrimeVue)
app.use(DialogService)
app.component('InputText', InputText)
app.component('Button', Button)
app.component('Card', Card)
app.component('Divider', Divider)
app.component('DynamicDialog', DynamicDialog)
app.component('Toast', Toast)
app.component('TabView', TabView)
app.component('TabPanel', TabPanel)
app.component('AutoComplete', AutoComplete)
app.mount('#app')