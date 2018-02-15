<template>
    <div class="home">
        <!--
        <home-header/>
        <home-info/>
        -->

    </div>
</template>


<script>
import navbar from '../admin/Navbar.vue'
//import photoSwipe from '../components/PhotoSwipe'
//import homeInfo from '../components/home/Info'

//import apiManiak from '../utils/api'

export default {
  beforeRouteLeave(to, from, next) {
    //this.$root.$refs.revealer.reveal().then(() => next())
  },
  props: {
    reveal: {
      default: false,
      type: Boolean,
    },
  },

  components: {
    navbar,
    //homeHeader,
    //photoSwipe,
    //homeInfo,
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
      //this.$emit('view-loaded')
    },
  },
}
</script>
