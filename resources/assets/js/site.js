import router from './siteRouter'
import reveal from './components/Reveal'
import navbar from './components/Navbar'
import './bootstrap'

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const siteApp = new Vue({
  el: '#app',
  router,
  components: { navbar, reveal },
  data() {
    return {
      navTheme: 'light',
    }
  },
  methods: {
    setNavTheme(isDarkTheme) {
      this.navTheme = isDarkTheme ? 'dark' : 'light'
    },
    closeReveal() {
      this.$refs.reveal.close()
    },
    openReveal(callback) {
      this.$refs.reveal.reveal().then(() => callback())
    },
  },
})
