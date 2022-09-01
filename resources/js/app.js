require('./bootstrap');

import { createApp } from 'vue'
import { createRouter, createWebHistory } from 'vue-router'

import LandingPage from './components/LandingPage'
import CoursesIndex from './components/courses/CoursesIndex'

const routes = [
    { path: '/', component: LandingPage},
    { path: '/courses', component: CoursesIndex}
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

const app = createApp({})
app.use(router)
app.mount('#app')