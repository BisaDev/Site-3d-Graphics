<template>
  <div>
    <h1>WORK</h1>
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
    console.log('mounted')
    Menu.run()
  },

  methods: {
    updateData() {
      console.log('mounted')
      this.$root.$refs.revealer.close()
    },
  },
}
</script>
