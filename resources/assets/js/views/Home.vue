<template>
  <div id="home">
    <home-header />
    <home-info />

        <section >
            <div class="container">
                <div class="grid grid-space-between grid-align-bottom margin-bottom--80">
          <h3>Some of the projects<br>we are most proud of.</h3>
                    <button class="button">See all projects</button>
        </div>
        <div class="grid">
            <router-link :to="`/project/${project.id}`" class="project-preview dark reveal" v-for="project in projects">
                <div class="project-preview-title">
                    <h5>{{project.name}}</h5>
                    <h6>{{project.description}}</h6>

                    <div class="project-preview-title-description">
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
import homeInfo from '../components/home/Info'

import Menu from '../utils/menu'
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
    homeInfo,
  },

  data() {
    return {
      projects: [],
    }
  },

  mounted() {
    apiManiak.getProjects().then(this.updateData)
    Menu.run()
  },

  methods: {
    updateData(response) {
      this.projects = response.data
      this.$root.$refs.revealer.close()
    },
  },
}
</script>
