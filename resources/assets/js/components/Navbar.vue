<template>
<nav class="navbar dark">
  <div class="container">
    <div class="grid">
    <router-link class="navbar-logo" to="/">
      <img :src="logo" class="logo-maniak" alt="MANIAK">
    </router-link>
    <ul class="navbar-menu">
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
      logo: require('../../img/logos/maniak/logo-maniak-dark.svg'),
    }
  },
}
</script>
