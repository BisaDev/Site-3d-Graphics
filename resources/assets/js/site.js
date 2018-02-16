import router from './siteRouter'
import reveal from './components/Reveal'
import navbar from './components/Navbar'
import deathScreen from './components/DeathScreen'
import footerComponent from './components/Footer'
import './bootstrap'

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
new Vue({
    el: '#app',
    router,
    components: {navbar, reveal, footerComponent, deathScreen},
    data() {
        return {
            navTheme: 'light',
            death: false,
            devtoolsOpen: false,
            wantsJob: false,
            enableDeath: process.env.NODE_ENV !== 'development',
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

        killIt() {
            if (!this.wantsJob && !window.foundYourSecret) {
                this.devtoolsOpen = false
                console.log(this.$refs.consoleChecker) // This only executes when devtools are open.

                this.death = this.devtoolsOpen

                if (this.death) {
                    console.clear()
                    console.log('%cHello there, so you like looking under the hood?', 'font-size:40px;color:#fff;text-shadow:0 1px 0 #ccc,0 2px 0 #c9c9c9,0 3px 0 #bbb,0 4px 0 #b9b9b9,0 5px 0 #aaa,0 6px 1px rgba(0,0,0,.1),0 0 5px rgba(0,0,0,.1),0 1px 3px rgba(0,0,0,.3),0 3px 5px rgba(0,0,0,.2),0 5px 10px rgba(0,0,0,.25),0 10px 10px rgba(0,0,0,.2),0 20px 20px rgba(0,0,0,.15)')
                    console.info('%cthere might be something else here', 'font-size:10px;color:#FF1141')
                }
            }
        },

        requestJob(email = null) {
            if (email) {
                this.wantsJob = true
                console.clear()
                console.log('%cNice! we will be in touch', 'font-size:40px;color:#fff;text-shadow:0 1px 0 #ccc,0 2px 0 #c9c9c9,0 3px 0 #bbb,0 4px 0 #b9b9b9,0 5px 0 #aaa,0 6px 1px rgba(0,0,0,.1),0 0 5px rgba(0,0,0,.1),0 1px 3px rgba(0,0,0,.3),0 3px 5px rgba(0,0,0,.2),0 5px 10px rgba(0,0,0,.25),0 10px 10px rgba(0,0,0,.2),0 20px 20px rgba(0,0,0,.15)')
            } else {
                console.log('maybe send me your email')
            }

        },
    },

    mounted() {
        // global variables for console
        window.foundYourSecret = false
        window.job = this.requestJob

        // this will only run when console is open
        this.$refs.consoleChecker.__defineGetter__("id", () => {
            this.devtoolsOpen = true
        })

        this.enableDeath && setInterval(this.killIt, 1000)
    }
})
