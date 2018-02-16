<template>
    <div></div>
</template>


<script>
import apiManiak from '../../utils/api'
import cookies from '../../utils/cookies'

export default {
  mounted() {
    this.logout()
  },

  methods: {
    logout(e) {
      if (cookies.hasItem('credentials')) {
        axios
          .get('auth/logout', {
            headers: {
              Accept: 'application/json',
              Authorization: 'Bearer ' + JSON.parse(cookies.getItem('credentials')).access_token,
            },
            //credentials: 'include',
          })
          .then(response => {
            this.$root.credentials = undefined
            this.$root.isLoggedIn = false
            cookies.removeItem('credentials')
            this.$router.push({ name: 'login' })
          })
      } else {
        this.$router.push({ name: 'login' })
      }
    },
  },
}
</script>
