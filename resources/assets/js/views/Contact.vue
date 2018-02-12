<template>
  <div class="contact">
    <section class="align-center contact-header no-margin no-padding fullscreen">
      <div class="container">
        <h1 class="text-center">
          If you’d like to partner on a project or simply  chat about what we could do together, just say <a class="contact-email" href="">hello@maniak.co</a>.
        </h1>
      </div>
    </section>
  </div>
</template>


<script>
import homeHeader from '../components/home/Header'
import homeInfo from '../components/home/Info'
import PageCommon from '../components/PageCommon.vue'

import apiManiak from '../utils/api'

export default {
  extends: { ...PageCommon },

  mounted() {
    this.updateData()
  },

  methods: {
    updateData() {
      this.$root.$refs.revealer.close()
    },
  },
}
</script>
