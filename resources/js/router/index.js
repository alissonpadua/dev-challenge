import Vue from 'vue'
import Router from 'vue-router'
import DefaultContainer from './../views/DefaultContainer'
import Dashboard from './../components/Dashboard'

Vue.use(Router)

export default new Router({
  mode: 'history',
  routes: [
    {
      path: '/seller',
      name: 'Vendedor',
      component: DefaultContainer,
      redirect: { name: 'Dashboard' },
      children: [
        {
          path: 'dashboard',
          name: 'Dashboard',
          component: Dashboard
        },
      ]
    },
    { path: '*', component: { template: '<h1>Rota não encontrada</h1>' } }
  ]
})
