<template>
  <div id="home">
    <home-header/>
    <home-info/>
    <!--<photo-swipe :images="['../../img/featured/brightfox.png', '../../img/featured/plateiq.png']"/>-->

    <section class="home-featured no-margin padding">
      <div class="container">
        <div class="home-featured-title">
          <h3>Some of the projects<br>we are most proud of.</h3>
          <button class="button">See all projects</button>
        </div>
        <div class="grid home-featured-list">
          <!-- <router-link :key="project.id" :to="`/project/${project.id}`" class="project-preview dark reveal"
                       v-for="project in projects">
            <div class="project-preview-title">
              <h5>{{project.name}}</h5>
              <h6>{{project.description}}</h6>

              <div class="project-preview-title-description">
                <p>Read more.</p>
              </div>
            </div>
          </router-link> -->
            <a href class="preview reveal dark" :style="{backgroundColor: '#005EFF', backgroundImage: 'url(../../img/featured/plateiq.png)'}">
              <div class="preview-title">
                <h5>Plate IQ</h5>
                <h6>Restaurant Management</h6>
                <div class="preview-title-cta">
                  <p>Read more.</p>
                </div>
              </div>
            </a>
            <a href class="preview reveal" :style="{backgroundImage: 'url(../../img/featured/volkswagen.png)'}">
              <div class="preview-title">
                <h5>Volkswagen 4DX</h5>
                <h6>VR Driving Simulator</h6>
                <div class="preview-title-cta">
                  <p>Read more.</p>
                </div>
              </div>
            </a>
            <a href class="preview reveal dark" :style="{backgroundColor: '#DA0037', backgroundImage: 'url(../../img/featured/wolverine.png)'}">
              <div class="preview-title">
                <h5>Wolverine</h5>
                <h6>Online Configurator</h6>
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
import photoSwipe from '../components/PhotoSwipe'
import homeInfo from '../components/home/Info'

import apiManiak from '../utils/api'

export default {
  beforeRouteLeave(to, from, next) {
    this.$root.$refs.revealer.reveal().then(() => next())
  },
  props: {
    reveal: {
      default: false,
      type: Boolean,
    },
  },

  components: {
    homeHeader,
    photoSwipe,
    homeInfo,
  },

  data() {
    return {
      projects: [],
    }
  },

  mounted() {
    apiManiak.getProjects().then(this.updateData)
  },

  methods: {
    updateData(response) {
      this.projects = response.data
      this.$root.$refs.revealer.close()
    },
  },
}
</script>
