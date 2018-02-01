<template>
  <div>
    <h1>CONTACT</h1>
  </div>
</template>


<script>
import homeHeader from '../components/home/Header'
import homeInfo from '../components/home/Info'

import Menu from '../utils/menu'
import apiManiak from '../utils/api'

export default {
  beforeRouteLeave(to, from, next) {
    this.$root.$refs.revealer.reveal().then(() => next())
  },

  mounted() {
    this.updateData()
    Menu.run()
  },

  methods: {
    updateData() {
      this.$root.$refs.revealer.close()
    },
  },
}
</script>
