<template>
    <div class="project-form grid-container">
        <div class="row">
            <h2>
                <span v-if="id">Project Id: {{id}}</span>
                <span v-else>New Project</span>
            </h2>
        </div>

        <!-- Messages -->
        <div class="form-messages grid-x grid-padding-x" v-if="messages">
            <div class="small-12 large-3 small-centered cell">
                {{messages}}
            </div>
        </div>

        <!-- Errors -->
        <div class="form-errors grid-x grid-padding-x" v-if="errors">
            <ul class="form-errors-list medium-6 large-3 small-centered cell">
                <li v-for="field in errors">
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
                        <label for="">Hero image</label>
                        <div v-if="!project.hero_image">
                            <input accept="image/*" name="hero_image" type="file" @change="onFileChange">
                        </div>
                        <div v-else>
                            <img :src="project.hero_image" style="width:100%; height: auto;" />
                            <button @click.prevent="removeImage('hero_image')">Remove image</button>
                        </div>
                    </div>
                    <div class="medium-6 cell">
                        <label for="">Hero Image Preview</label>
                        <div v-if="!project.hero_image_preview">
                            <input accept="image/*" name="hero_image_preview" type="file" @change="onFileChange">
                        </div>
                        <div v-else>
                            <img :src="project.hero_image_preview" style="width:100%; height: auto;" />
                            <button @click.prevent="removeImage('hero_image_preview')">Remove image</button>
                        </div>
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
                                <option v-for="country in form.countries" v-bind:value="country.id">
                                    {{ country.name }}
                                </option>
                            </select>
                        </label>
                    </div>
                    <!--
                    <div class="medium-6 cell">
                        <label>Client * (input new Client name)
                            <input v-model="project.client_name" name="client_name" type="text" placeholder="Info Description">
                        </label>
                    </div>
                    -->
                    <div class="medium-6 cell">
                        <label>Clients
                            <select v-model="project.client_id" name="client_id">
                                <option disabled value="">Please select one</option>
                                <option v-for="client in form.clients" v-bind:value="client.id">
                                    {{ client.name }}
                                </option>
                            </select>
                        </label>
                    </div>
                    <div class="medium-6 cell">
                        <input v-model="project.is_featured" name="is_featured" type="checkbox"><label>Is featured Project?</label>
                    </div>
                    <div class="medium-6 cell">
                        <input v-model="project.is_dark" name="is_featured" type="checkbox"><label>Is Dark (theme)?</label>
                    </div>
                    <div class="small-12 cell">
                        <label for="">Section Type</label>
                        <select name="sections" v-model="form.currentSection">
                            <option disabled value="">Please select one</option>
                            <option v-for="(section, index) in form.sections" v-bind:value="index">
                                {{ index }}
                            </option>
                        </select>
                        <button @click.prevent="addSection">Add Project Section</button>
                    </div>
                </div>


                <ProjectSection
                    v-for="(section, index) in project.sections"
                    :key="index"
                    :section="project.sections[index]"
                >
                </ProjectSection>

                <div class="medium-12 cell">
                    <input type="submit" class="button" value="Submit">
                </div>

            </div>
        </form>
    </div>
</template>


<script>
import apiManiak from '../../utils/api'
import ProjectSection from '../../components/admin/ProjectSection'

export default {
  props: ['id'],

    components: {
        ProjectSection,
    },

  data() {
    return {
      sections: [],
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
        sections: [],
      },
      errors: false,
      messages: false,
      form: {
        clients: [],
        countries: [],
        sections:[],
        currentSection: '',
      },
    }
  },

  created() {
    console.log('created')

    if (Number.isInteger(parseInt(this.$props.id, 10))) {
      this.fetchProject(this.$props.id)
        .then(response => {
          this.project = response.data.project
          this.sections = response.data.sections
          this.form = {
              clients: response.data.clients,
              countries: response.data.countries,
              sections: response.data.sections
          }
        })
        .catch(error => {
          this.$emit('not-found')
          console.log(error)
        })
    } else {
        this.setOptions().then(response => {
            this.form = {
                clients: response.data.clients,
                countries: response.data.countries,
                sections: response.data.sections
            }
        })
            .catch(error => {
                this.$emit('not-found')
                console.log(error)
            })
    }
  },

  watch: {
    // call again the method if the route changes
    '$route': 'resetForm'
  },

  methods: {
    setOptions() {
      return apiManiak.getConfigModels()
    },

    addSection() {
      if (!this.form.currentSection) {
        this.messages = 'Please Select a Section'
        this.scrollTop()

        return
      }

      let model = Object.assign({}, this.form.sections[this.form.currentSection])

      this.project.sections.push({
        background_image: null,
        color: null,
        component: this.form.currentSection,
        id: null,
        is_dark: 0,
        is_parallax: 0,
        model: model
      })
    },

    resetForm() {
        if(!this.$props.id) {
            this.sections = false
            //this.form.sections = false
            this.errors = false
            this.messages = false
            this.project = {
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
                sections: [],
            }
      }
    },

    submitForm() {
      let project = Object.assign({}, this.$data.project),
          dataImageRegExp = /^data\:image\//,
          images = ['hero_image', 'hero_image_preview']

      //This omits images already set
      images.forEach(image => {
        project[image] = dataImageRegExp.test(project[image]) ? project[image] : '';
      })

      let request = (this.$data.project.id)
        ? apiManiak.editProject(project)
        : apiManiak.createProject(project) ;

      this.handleRequest(request)
    },

    handleRequest(request) {
      this.$data.messages = false

        request.then(response => {
            this.$data.errors = false
            this.$data.messages = response.data.message
            //this.$data.project.id = response.data.projectId
            this.$data.project = response.data.project
            this.$router.push({name: 'project-edit', params: { id: response.data.projectId } })
            console.log(response)
        }).catch(error => {
          if (error.response.data.message) {
            this.$data.errors = error.response.data.errors || { Server: [error.response.data.message] }
            console.log('error:', this.$data.form);
          }
        }).finally(() => {
            this.scrollTop()
        });
    },

    fetchProject(id) {
      return apiManiak.fetchProject(id)
    },

    onFileChange(e) {
      var files = e.target.files || e.dataTransfer.files;

      if (!files.length) {
        return;
      }

      console.log();

      this.createImage(files[0], e.target.name)
    },

    createImage(file, field) {
      var image = new Image();
      var reader = new FileReader();
      var vm = this;

      reader.onload = (e) => {
        vm.project[field] = e.target.result;
      };

      reader.readAsDataURL(file);
    },

    removeImage(field) {
      this.project[field] = null
    },

    scrollTop() {
      return window.scrollTo({
        'behavior': 'smooth',
        'left': 0,
        'top': 0
      })
    },
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
  },
    */
}
</script>
