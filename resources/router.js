import { createRouter, createWebHistory } from 'vue-router'
import Register from './js/components/Register.vue'
import Login from './js/components/Login.vue'
import Dashboard from './js/components/Dashboard.vue'

const routes = [
  { path: '/register', component: Register },
  { path: '/login', component: Login },
  { path: '/', redirect: '/register' } ,
  { path: '/dashboard', component: Dashboard, meta: { requiresAuth: true } }
]

const router = createRouter({
  history: createWebHistory(),
  routes
})



export default router