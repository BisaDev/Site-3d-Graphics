<template>
<nav class="nav-dark menu-white" id="sticky">
  <div class="container-fluid">
    <a class="logo pull-left" href="">
      <img :src="logo" id="logomaniak" alt="MANIAK">
    </a>
    <ul class="menu pull-right">
      <li><a href="">Work</a></li>
      <li><a href="">Studio</a></li>
      <li><a href="">Contact</a></li>
    </ul>
<!--
    <a href class="hamburger" role="button">
      <div class="hamburger-line hamburger-line--01">
        <div class="hamburger-line-in hamburger-line-in--01"></div>
      </div>
      <div class="hamburger-line hamburger-line--02">
        <div class="hamburger-line-in hamburger-line-in--02"></div>
      </div>
      <div class="hamburger-line hamburger-line--03">
        <div class="hamburger-line-in hamburger-line-in--03"></div>
      </div>
      <div class="hamburger-line hamburger-line--cross01">
        <div class="hamburger-line-in hamburger-line-in--cross01"></div>
      </div>
      <div class="hamburger-line hamburger-line--cross02">
        <div class="hamburger-line-in hamburger-line-in--cross02"></div>
      </div>
    </a> -->
  </div>
</nav>
</template>

<script>
  export default {
    data(){
      return {
        logo:require('../../img/logos/maniak/logo-maniak-white.svg')
      }

    }

  }

</script>
