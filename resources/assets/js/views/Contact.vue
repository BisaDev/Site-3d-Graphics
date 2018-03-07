<template>
  <div class="contact">
    <section class="contact-header">
      <div class="container">
        <div class="grid appear-after-reveal">
          <h1>
            If you’d like to partner on a project or simply chat about what we could do together, just say <a class="contact-email" href="">hello@maniak.co</a>.
          </h1>
        </div>
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
      this.setNavTheme(false)
      this.$emit('view-loaded')
    },
  },
}
</script>
