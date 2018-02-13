<template>
    <div class="nav">
        <div class="nav-header">
            <div class="nav-title">
                <img :src="logo" class="logo-maniak" alt="MANIAK">
            </div>
        </div>
        <div class="nav-btn">
            <label for="nav-check">
                <span></span>
                <span></span>
                <span></span>
            </label>
        </div>
        <input type="checkbox" id="nav-check">
        <div class="nav-links">
            <a href="#" target="_blank">Projects</a>
            <a href="#" target="_blank">Sections</a>
            <a href="#" target="_blank">Users</a>
        </div>

        <div class="nav-title">
            <p>Logged as: {user}</p>
        </div>

    </div>
</template>

<script>
//import homeHeader from '../components/home/Header'
//import photoSwipe from '../components/PhotoSwipe'
//import homeInfo from '../components/home/Info'

//import apiManiak from '../utils/api'

export default {
  beforeRouteLeave(to, from, next) {
    this.$root.$refs.revealer.reveal().then(() => next())
  },
  props: {
    reveal: {
      default: false,
      type: Boolean,
    },
    user: {
      username: String,
      default: false,
    },
  },

  components: {
    //homeHeader,
    //photoSwipe,
    //homeInfo,
  },

  data() {
    return {
      logo: require('../../../img/logos/maniak/logo-maniak-white.svg'),
      projects: [],
    }
  },

  mounted() {
    apiManiak.getProjects().then(this.updateData)
  },

  methods: {
    updateData(response) {
      this.projects = response.data
      //this.$root.$refs.revealer.close()
    },
  },
}
</script>
