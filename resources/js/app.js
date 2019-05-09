import Vue from 'vue'
import BootstrapVue from 'bootstrap-vue'
import App from './views/App'
import router from './router'
import 'core-js/es6/promise'
import 'core-js/es6/string'
import 'core-js/es7/array'
import Snotify, { SnotifyPosition } from 'vue-snotify'

const options = {
  toast: {
    position: SnotifyPosition.rightTop
  }
}

Vue.use(BootstrapVue)
Vue.use(Snotify, options)

new Vue({
  el: '#app',
  router,
  components: { App },
  template: '<App />'
})