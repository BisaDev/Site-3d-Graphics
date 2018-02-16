import router from './adminRouter'
import navbar from './views/admin/Navbar'
import cookies from './utils/cookies'
import './bootstrap'

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const adminApp = new Vue({
  el: '#app',
  router,

  data() {
    return {
      user: {},
      credentials: false,
      isLoggedIn: false,
      ready: true,
    }
  },

  components: {
    navbar,
  },

  created() {
    this.user = JSON.parse(cookies.getItem('user'))
    this.credentials = this.getCredentials()
    this.isLoggedIn = Boolean(this.credentials)
  },

  methods: {
    getCredentials() {
      return cookies.getItem('credentials')
    },
    notFound() {
      this.$router.push({ name: 'admin' })
    },
  },
})
