<template>
  <div class="home">
    <home-header @explode="setNavTheme" ></home-header>
    <home-info></home-info>
    <section class="home-featured no-margin padding">
      <div class="container">
        <div class="grid">
          <div class="home-featured-title">
            <h3>Some of the projects<br>we are most proud of.</h3>
          </div>
          <div class="home-featured-button">
            <button class="button"><router-link to="/work">See all projects</router-link></button>
          </div>
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
            <a href class="preview reveal dark" :style="{backgroundImage: 'url(../../img/featured/plateiq.png)'}">
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
            <a href class="preview reveal dark" :style="{backgroundImage: 'url(../../img/featured/wolverine.png)'}">
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
import pageCommon from '../components/PageCommon'

import apiManiak from '../utils/api'

export default {
  extends: { ...pageCommon },

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
    apiManiak.getProjects()
        .then(this.updateData)
        .catch(() => { this.$emit('not-found') })
  },

  methods: {
    updateData(response) {
      this.setNavTheme(false)
      this.projects = response.data
      this.$emit('view-loaded')
    },
  },
}
</script>
