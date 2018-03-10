<template>
  <div class="home">
    <home-header @explode="setNavTheme" ></home-header>
    <home-info></home-info>
    <section class="home-featured">
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
            <router-link :key="project.id" :to="{name: 'project', params: { id: project.id,  phrases: [project.preloader] }}" class="preview dark reveal"
                         v-for="project in firstThreeProjects" :style="{ backgroundColor: project.hero_color || 'transparent', backgroundImage: `url(${project.hero_image_preview})`}">
              <div class="preview-title">
                <h5>{{project.name}}</h5>
                <h6>{{project.description}}</h6>

                <div class="preview-title-cta">
                  <p>Read more.</p>
                </div>
              </div>
            </router-link>
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

  computed: {
    firstThreeProjects: function() {
      return this.projects.slice(0, 3)
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
    apiManiak
      .getProjects()
      .then(this.updateData)
      .catch(() => {
        this.$emit('not-found')
      })
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
