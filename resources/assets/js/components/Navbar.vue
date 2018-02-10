<template>
  <nav :class="['navbar', theme, stateClass]" ref="nav">
    <div class="container">
      <router-link class="navbar-logo" to="/">
        <svg class="logo-maniak" width="100px" height="14px" viewBox="0 0 100 14" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
          <g id="logo-maniak" fill="currentColor">
            <polygon id="XMLID_212_-path"
                     points="42.3728814 13.4728468 42.3728814 0.847457627 44.2723553 0.847457627 52.0601987 11.3974403 52.0601987 0.847457627 53.3898305 0.847457627 53.3898305 13.4728468 51.965225 13.4728468 43.7025132 2.40401245 43.7025132 13.559322 42.3728814 13.559322"></polygon>
            <polygon id="XMLID_212_-path"
                     points="99.9028447 0.847457627 98.1133196 0.847457627 92.7447445 6.79864548 96.7947222 11.5763597 98.1133196 13.0851115 99.8086591 13.0851115 94.3458985 6.79864548"></polygon>
            <polygon id="XMLID_212_-path" points="82.2901508 12.079277 82.7610785 13.1689311 84.2680469 13.1689311 78.4285442 0.847457627 77.1099468 0.847457627"></polygon>
            <polygon id="XMLID_212_-path" points="64.5832715 13.0851115 64.5832715 0.847457627 65.9960544 0.847457627 65.9960544 13.0851115"></polygon>
            <polygon id="XMLID_212_" points="30.9050303 12.2175013 31.3761435 13.3558007 32.883706 13.3558007 26.9476788 0.484261501 25.6285617 0.484261501"></polygon>
            <polygon id="XMLID_212_-path"
                     points="0 13.2682392 0 0.484261501 2.16712103 0.484261501 7.16092165 11.4294479 12.1547223 0.484261501 14.3218433 0.484261501 14.3218433 13.2682392 12.9085035 13.2682392 12.9085035 1.88524536 7.72625757 13.2682392 6.59558573 13.2682392 1.4133398 1.88524536 1.4133398 13.2682392"></polygon>
          </g>
        </svg>
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
  props: {
    theme: {
      type: String,
      default: 'light',
    },
  },
  data() {
    return {
      lastKnownScrollPosition: window.scrollY,
      ticking: false,
      stateClass: 'nav-at-top',
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
