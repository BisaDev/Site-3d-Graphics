<template>
    <div class="project-list grid-container">
        <!-- Messages -->
        <div class="form-messages grid-x grid-padding-x" v-if="message">
            <div class="small-12 large-12 large-centered small-centered cell">
                {{message}}
            </div>
        </div>

        <div class="row">
            <h2>Projects</h2>
        </div>

        <!-- List -->
        <div class="form-errors grid-x grid-padding-x">
            <ul class="form-errors-list medium-6 cell">
                <li v-for="project in projects">
                    <ul class="form-errors-items">
                        <li>
                            Project {{ project.id}} :
                            <router-link :to="{ name: 'project-edit', params: { id: project.id }}">
                                {{ project.name }}
                            </router-link>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</template>


<script>
import apiManiak from '../../utils/api'

export default {

  data() {
    return {
      projects: [],
    }
  },


  created() {
      apiManiak.getProjects().then(response => {
          this.projects = response.data
      }).catch(error => {
        //this.$emit('not-found')
        console.log(error)
      });
  },

  methods: {},
  props: {
    message: ''
  },
    /*
  beforeRouteUpdate (to, from, next) {
      console.log('beforeRouteUpdate')

      this.$data.form.errors = false
      this.$data.form.messages = false

    let projectId = Number.isInteger(parseInt(this.$props.id, 10))
        ? this.$props.id
        : (this.$data.project ? this.$data.project.id : false)

      console.log(projectId)

    if (projectId) {
      this.fetchProject(this.$props.id).then(response => {
        this.project = response.data
      })
      .catch(error => {
        this.$emit('not-found')
        console.log(error)
      })
    }

    next()

  },*/
}
</script>
