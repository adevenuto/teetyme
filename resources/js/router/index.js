
import { createRouter, createWebHistory } from 'vue-router'
import store from '../store'

import LandingPage from '../components/LandingPage'
import Login from '../components/auth/Login'
import Register from '../components/auth/Register'
import CoursesIndex from '../components/course/CoursesIndex'
import CourseShowEdit from '../components/course/CourseShowEdit'

export const routes = [
    { 
        path: '/', 
        component: LandingPage,
        name: 'Home'
    },
    { 
        path: '/Login', 
        component: Login,
        name: 'Login'
    },
    { 
        path: '/Register', 
        component: Register,
        name: 'Register'
    },
    { 
        path: '/courses', 
        component: CoursesIndex,
        name: 'Courses',
        meta: { requiresAuth: true }
    },
    { 
        path: '/course/:id', 
        component: CourseShowEdit, 
        name: 'CoursesShowEdit',
        meta: { requiresAuth: true }
    },
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth)) {
      // this route requires auth, check if logged in
      // if not, redirect to login page.
      if (sessionStorage.getItem('loggedIn') == null) {
        next({ name: 'Login' })
      } else {
        next() // go to wherever I'm going
      }
      // If loggedIn and trying to access 'login' or 'register' redirect...
    } else if ((to.name == 'Login' || to.name == 'Register') && sessionStorage.getItem('loggedIn') !== null) {
        next({ name: 'Courses' })
    } else {
        // does not require auth, make sure to always call next()!
        next()
    }
})

export default router