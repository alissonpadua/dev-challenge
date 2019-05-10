import Vue from 'vue'
import Router from 'vue-router'
import DefaultContainer from './../views/DefaultContainer'
import Dashboard from './../components/Dashboard'
import Product from './../components/product/Product';
import ProductList from './../components/product/List';
import ProductCreate from './../components/product/Create';
import ProductEdit from './../components/product/Edit';
import Seller from './../components/seller/Seller';
import SellerList from './../components/seller/List';
import SellerCreate from './../components/seller/Create';
import SellerEdit from './../components/seller/Edit';

Vue.use(Router)

export default new Router({
  mode: 'history',
  routes: [
    {
      path: '/seller',
      name: 'Vendedor',
      component: DefaultContainer,
      redirect: { path: '/seller/dashboard' },
      children: [
        {
          path: 'dashboard',
          name: 'Dashboard',
          component: Dashboard
        },
        {
          path: 'product',
          name: 'Produtos',
          component: Product,
          redirect: { path: '/seller/product/list' },
          children: [
            {
              path: 'list',
              name: 'Listagem',
              component: ProductList
            },
            {
              path: 'create',
              name: 'Novo Produto',
              component: ProductCreate
            },
            {
              path: 'edit/:id',
              name: 'Editar Produto',
              component: ProductEdit
            }
          ]
        },
        {
          path: 'user',
          name: 'Usuários',
          component: Seller,
          redirect: { path: '/seller/user/list' },
          children: [
            {
              path: 'list',
              name: 'Listagem',
              component: SellerList
            },
            {
              path: 'create',
              name: 'Novo Vendedor',
              component: SellerCreate
            },
            {
              path: 'edit/:id',
              name: 'Editar Vendedor',
              component: SellerEdit
            }
          ]
        }
      ]
    },
    { path: '*', component: { template: '<h1>Rota não encontrada</h1>' } }
  ]
})
