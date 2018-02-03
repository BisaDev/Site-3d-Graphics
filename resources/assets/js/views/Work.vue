<template>
  <div class="work">
    <section class="work-header no-margin dark">
      <div class="container">
        <h1>
          <b>Maniak builds cool stuff.</b><br>Lorem ipsum dolor sit.
        </h1>
        <ul class="work-header-filters">
          <li class="active"><a href="">All<span class="filter-count">12</span></a></li>
          <li><a href="">Design<span class="filter-count">12</span></a></li>
          <li><a href="">Software<span class="filter-count">12</span></a></li>
          <li><a href="">3D &amp; VR<span class="filter-count">12</span></a></li>
        </ul>
      </div>
    </section>
    <section class="work-portfolio">
      <div class="container">
        <div class="grid">
          <a href class="preview reveal dark">
            <div class="preview-title">
              <h5>Plate IQ</h5>
              <h6>Restaurant Management</h6>
              <div class="preview-title-cta">
                <p>Read more.</p>
              </div>
            </div>
          </a>
          <a href class="preview reveal">
            <div class="preview-title">
              <h5>Plate IQ</h5>
              <h6>Restaurant Management</h6>
              <div class="preview-title-cta">
                <p>Read more.</p>
              </div>
            </div>
          </a>
          <a href class="preview reveal dark">
            <div class="preview-title">
              <h5>Plate IQ</h5>
              <h6>Restaurant Management</h6>
              <div class="preview-title-cta">
                <p>Read more.</p>
              </div>
            </div>
          </a>
        </div>
      </div>
    </section>
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
