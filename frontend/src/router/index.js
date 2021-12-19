import Vue from 'vue'
import VueRouter from 'vue-router'
import Home from '../views/Home.vue'
import SignIn from '../views/SignIn.vue'
import SignUp from '../views/SignUp.vue'
import Reset from '../views/Reset-password.vue'
import Profil from '../views/dashboard/Profil.vue'
import Orders from '../views/dashboard/Orders.vue'
import Settings from '../views/dashboard/Settings.vue'

Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    name: 'Home',
    component: Home
  },
  {
    path: '/signIn',
    name: 'SignIn',
    component: SignIn
  },
  {
    path: '/signUp',
    name: 'SignUp',
    component: SignUp
  },
  {
    path: '/profil',
    name: 'Profil',
    component: Profil,
    meta:{requireAuth:true}
  },
  {
    path: '/orders',
    name: 'Orders',
    component: Orders,
    meta:{requireAuth:true}
  },
  {
    path: '/settings',
    name: 'Settings',
    component: Settings,
    meta:{requireAuth:true}
  },
  {
    path: '/reset-password/:token',
    name: 'Reset',
    component: Reset
  },
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})
router.beforeEach((to,from,next)  => {
  let token = localStorage.getItem('token')

  if(to.meta.requireAuth && token === null) {
    next({name:"SignIn"})
  }
  next()
})

export default router
