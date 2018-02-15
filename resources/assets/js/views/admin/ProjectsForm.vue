<template>
    <div class="project-form">
        <div class="row">
            <h2>Project: </h2>
        </div>
        <form class="form-project" v-on:submit.prevent="submitForm" action="">
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
                        <label>Hero Image
                            <input  name="hero_image" type="file">
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
    }
  },

  created() {
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
      apiManiak.sendProjectData(this.$data.project)
    },

    fetchProject(id) {
      return apiManiak.fetchProject(id)
    },
  },
}
</script>
