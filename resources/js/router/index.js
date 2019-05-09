import Vue from 'vue'
import Router from 'vue-router'
import Seller from './../components/Seller'
import Dashboard from './../components/Dashboard'

Vue.use(Router)

export default new Router({
  mode: 'history',
  routes: [
    {
      path: '/seller',
      name: 'input-application',
      component: Seller,
      redirect: { name: 'dashboard' },
      children: [
        {
          path: 'dashboard',
          name: 'dashboard',
          component: Dashboard
        },
      ]
    },
    { path: '*', component: { template: '<h1>Rota não encontrada</h1>' } }
  ]
})
