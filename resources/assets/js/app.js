import router from './router'
import reveal from './components/Reveal/Reveal.vue'
import navbar from './components/Navbar.vue'
import './bootstrap'

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

new Vue({
  el: '#app',
  router,
  components: { navbar, reveal },
})
