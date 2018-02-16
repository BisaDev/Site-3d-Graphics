<template>
    <div class="project-form grid-container">
        <div class="row">
            <h2>Project Id: {{id}}</h2>
        </div>

        <!-- Messages -->
        <div class="form-messages grid-x grid-padding-x" v-if="form.messages">
           {{form.messages}}
        </div>

        <!-- Errors -->
        <div class="form-errors grid-x grid-padding-x" v-if="form.errors">
            <ul class="form-errors-list medium-6 cell">
                <li v-for="field in form.errors">
                    <ul class="form-errors-items">
                        <li v-for="item in field">
                            {{ item }}
                        </li>
                    </ul>
                </li>
            </ul>
        </div>

        <form class="form-project" v-on:submit.prevent="submitForm" action="">
            <input v-model="project.id" name="id" type="hidden">

            <div class="grid-container">
                <div class="grid-x grid-padding-x">
                    <div class="medium-6 cell">
                        <label>Name
                            <input v-model="project.name" name="name" type="text" placeholder="Name">
                        </label>
                    </div>
                    <div class="medium-6 cell">
                        <label>Description
                            <input v-model="project.description" name="description" type="text" placeholder="Description">
                        </label>
                    </div>
                    <div class="medium-6 cell">
                        <label>Preloader text
                            <input v-model="project.preloader" name="preloader" type="text" placeholder="Preloader text">
                        </label>
                    </div>
                    <div class="medium-6 cell">
                        <label>Hero Color
                            <input v-model="project.hero_color" name="hero_color" type="text" placeholder="HEX Color: #FFFFFF">
                        </label>
                    </div>
                    <div class="medium-6 cell">
                        <label>Hero Image
                            <input name="hero_image" type="file">
                        </label>
                    </div>
                    <div class="medium-6 cell">
                        <label>Hero Image Preview
                            <input name="hero_image_preview" type="file">
                        </label>
                    </div>
                    <div class="medium-6 cell">
                        <label>Info Subtitle
                            <input v-model="project.info_subtitle" name="info_subtitle" type="text" placeholder="Info Subtitle">
                        </label>
                    </div>
                    <div class="medium-6 cell">
                        <label>Info Description
                            <input v-model="project.info_description" name="info_description" type="text" placeholder="Info Description">
                        </label>
                    </div>
                    <div class="medium-6 cell">
                        <label>Start Date
                            <input v-model="project.start_date" name="start_date" type="text" placeholder="Info Description">
                        </label>
                    </div>
                    <div class="medium-6 cell">
                        <label>End Date
                            <input v-model="project.end_date" name="end_date" type="text" placeholder="Info Description">
                        </label>
                    </div>
                    <div class="medium-6 cell">
                        <label>Country
                            <select v-model="project.country_id" name="country_id">
                                <option value="1">Mexico</option>
                                <option value="2">United States</option>
                                <option value="3">Colombia</option>
                                <option value="4">Brazil</option>
                            </select>
                        </label>
                    </div>
                    <div class="medium-6 cell">
                        <label>Client * (input new Client name)
                            <input v-model="project.client_name" name="client_name" type="text" placeholder="Info Description">
                        </label>
                    </div>
                    <div class="medium-6 cell">
                        <label>Clients
                            <select v-model="project.client_id" name="client_id">
                                <option value="1">Mexico</option>
                                <option value="2">United States</option>
                                <option value="3">Colombia</option>
                                <option value="4">Brazil</option>
                            </select>
                        </label>
                    </div>
                    <div class="medium-6 cell">
                        <input v-model="project.is_featured" name="is_featured" type="checkbox"><label>Is featured Project?</label>
                    </div>
                    <div class="medium-6 cell">
                        <input v-model="project.is_dark" name="is_featured" type="checkbox"><label>Is Dark (theme)?</label>
                    </div>
                    <div class="medium-12 cell">
                        <input type="submit" class="button" value="Submit">
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>


<script>
import apiManiak from '../../utils/api'

export default {
  props: ['id'],

  data() {
    return {
      project: {
        id: null,
        name: '',
        description: '',
        preloader: '',
        hero_color: '',
        hero_image: '',
        hero_image_preview: '',
        info_subtitle: '',
        info_description: '',
        start_date: '',
        end_date: '',
        country_id: null,
        client_name: '',
        client_id: null,
        is_featured: false,
        is_dark: false,
      },
      form: {
          errors: false,
          messages: false,
      },
    }
  },


  created() {
      console.log('created')
    if (Number.isInteger(parseInt(this.$props.id, 10))) {
      this.fetchProject(this.$props.id)
        .then(response => {
          this.project = response.data
        })
        .catch(error => {
          this.$emit('not-found')
          console.log(error)
        })
    }
  },

  methods: {
    submitForm() {
        console.log(this.$data.project.id)
        let request = (this.$data.project.id)
            ? apiManiak.editProject(this.$data.project)
            : apiManiak.createProject(this.$data.project) ;

        this.handleRequest(request)
    },

    handleRequest(request) {
        request.then(response => {
            this.$data.form.errors = false
            this.$data.form.messages = response.data.message
            this.$router.push({name: 'edit-project', params: { id: response.data.projectId } })
            console.log(response)
        }).catch(error => {
        if (error.response.data.message) {
            this.$data.form.errors = error.response.data.errors
            console.log(this.$data.form);
        }
        });
    },

    fetchProject(id) {
      return apiManiak.fetchProject(id)
    },
  },
    
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
  },
}
</script>
