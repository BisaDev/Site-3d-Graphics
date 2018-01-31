<template>
<nav class="nav-dark menu-white" id="sticky">
  <div class="container-fluid">
    <a class="logo pull-left" href="/">
      <img :src="logo" id="logomaniak" alt="MANIAK">
    </a>
    <ul class="menu pull-right">
      <li><a href="">Work</a></li>
      <li><a href="">Studio</a></li>
      <li><a href="">Contact</a></li>
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
