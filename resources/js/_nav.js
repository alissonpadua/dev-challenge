export default {
  items: [
    {
      name: 'Dashboard',
      url: '/seller/dashboard',
      icon: 'icon-speedometer',
      badge: {
        variant: 'primary',
        text: 'NEW'
      }
    },
    {
      title: true,
      name: 'CADASTROS',
      class: '',
      wrapper: {
        element: '',
        attributes: {}
      }
    },
    {
      name: 'Categorias',
      url: '/seller/category',
      icon: 'icon-tag'
    },
    {
      name: 'Produtos',
      url: '/seller/product/list',
      icon: 'icon-handbag'
    }
  ]
}
