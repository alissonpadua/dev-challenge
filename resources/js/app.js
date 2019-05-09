import Vue from 'vue'
import BootstrapVue from 'bootstrap-vue'
import App from './views/App'
import router from './router'
import 'core-js/es6/promise'
import 'core-js/es6/string'
import 'core-js/es7/array'

Vue.use(BootstrapVue)

new Vue({
  el: '#app',
  router,
  components: { App },
  template: '<App />'
})