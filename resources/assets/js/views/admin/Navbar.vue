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
            </label>
        </div>
        <input type="checkbox" id="nav-check">


        <div class="nav-links" v-if="isLogged">
            <router-link :to="{name: 'projects'}">Project List</router-link>
            <router-link :to="{name: 'create-project'}">Create New Project</router-link>
        </div>

        <div class="nav-profile" v-if="isLogged">
            <p>&lt; Logged as: <a href="javascript:void(0);" >{{this.$root.user ? this.$root.user.name : '' }}</a> &gt;</p>
        </div>
    </div>
</template>

<script>
export default {
  props: {
    user: {
      type: String,
      default: '',
    },
    isLogged: {
      type: Boolean,
      default: false,
    },
  },

  data() {
    return {
      logo: require('../../../img/logos/maniak/logo-maniak-white.svg'),
      projects: [],
    }
  },
}
</script>
