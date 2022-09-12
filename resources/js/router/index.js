
import { createRouter, createWebHistory } from 'vue-router'

import LandingPage from '../components/LandingPage'
import Login from '../components/auth/Login'
import Register from '../components/auth/Register'
import CoursesIndex from '../components/course/CoursesIndex'
import CourseShowEdit from '../components/course/CourseShowEdit'

export const routes = [
    { path: '/', component: LandingPage},
    { path: '/Login', component: Login},
    { path: '/Register', component: Register},
    { path: '/courses', component: CoursesIndex},
    { path: '/course/:id', component: CourseShowEdit, name: 'CoursesShowEdit'},
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router