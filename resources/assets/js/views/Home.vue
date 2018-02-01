<template>
  <div>
    <home-header/>
    <home-info/>

    <section id="featured" class="section-dark component">
      <div class="container">
        <div class="row">
          <div class="col-4 col-no-padding" v-for="project in projects">
            <router-link :to="`/project/${project.id}`" class="featured featured-wolverine reveal" data-color="#FCFCFD">
              <div class="featured-title">
                <h5>{{project.name}}</h5>
                <h6>{{project.description}}</h6>

                <div class="featured-title-description">
                  <p>Read more.</p>
                </div>
              </div>
            </router-link>
          </div>
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
