<template>
<nav class="nav-dark menu-white" id="sticky">
  <div class="container-fluid">
    <router-link class="logo pull-left" to="/">
      <img :src="logo" id="logomaniak" alt="MANIAK">
    </router-link>
    <ul class="menu pull-right">
      <li><router-link to="/work">Work</router-link></li>
      <li><router-link to="/studio">Studio</router-link></li>
      <li><router-link to="/contact">Contact</router-link></li>
    </ul>
  </div>
</nav>
</template>

<script>
export default {
  data() {
    return {
      logo: require('../../img/logos/maniak/logo-maniak-white.svg'),
    }
  },
}
</script>
