<template>
  <nav :class="['navbar ', theme, stateClass]" ref="nav">
    <div class="container">
      <router-link class="navbar-logo" to="/">
        <img :src="logo" class="logo-maniak" alt="MANIAK">
      </router-link>
      <ul class="navbar-menu">
        <li>
          <router-link to="/work">Work</router-link>
        </li>
        <li>
          <router-link to="/studio">Studio</router-link>
        </li>
        <li>
          <router-link to="/contact">Contact</router-link>
        </li>
      </ul>

    </div>
  </nav>
</template>

<style>
.navbar {
  transition: transform 0.5s ease;
}

.nav-at-top {
  position: absolute;
  top: 10px;
  left: 0;
  transform: translateY(0%);
}

.nav-show {
  transform: translateY(0%);
}

.nav-hide {
  transform: translateY(-100%);
}
</style>

<script>
export default {
  data() {
    return {
      logo: require('../../img/logos/maniak/logo-maniak-dark.svg'),
      lastKnownScrollPosition: window.scrollY,
      ticking: false,
      stateClass: 'nav-at-top',
      theme: 'light',
      offset: 5, //px
    }
  },

  created() {
    window.addEventListener('scroll', this.trackScroll)
  },

  destroyed() {
    window.removeEventListener('scroll', this.trackScroll)
  },
  methods: {
    trackScroll() {
      if (!this.ticking) {
        window.requestAnimationFrame(this.modifyNav)
      }

      this.ticking = true
    },

    modifyNav() {
      const pageYScroll = window.pageYOffset || document.documentElement.scrollTop
      if (pageYScroll < 10) {
        this.stateClass = 'nav-at-top'
      } else {
        this.stateClass = ''
        if (window.scrollY >= this.lastKnownScrollPosition + this.offset) {
          this.stateClass = 'nav-hide'
        } else if (window.scrollY <= this.lastKnownScrollPosition - this.offset) {
          this.stateClass = 'nav-show'
        }
      }

      this.lastKnownScrollPosition = window.scrollY

      this.ticking = false
    },
  },
}
</script>
