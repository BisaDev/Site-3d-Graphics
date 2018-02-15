<template>
  <nav :class="['navbar', currentTheme, stateClass]" ref="nav">
    <div class="container">

      <router-link class="navbar-logo" to="/">
        <logo></logo>
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
import Scroller from './Scroller'
import Logo from './Logo'

export default {
  extends: { ...Scroller },

  components: {
    Logo,
  },

  props: {
    theme: {
      type: String,
      default: 'light',
    },
    stickyTheme: {
      type: String,
      default: 'light',
    },
  },

  data() {
    return {
      scrollPosition: window.scrollY,
      savedScrollPosition: window.scrollY,
      stateClass: window.scrollY > 5 ? 'nav-hide' : 'nav-at-top',
      ticking: false,
      offset: 5, //px
    }
  },

  created() {
    this.$on('_scroll', this.updateScrollPosition)
  },

  methods: {
    updateScrollPosition() {
      this.scrollPosition = window.pageYOffset || document.documentElement.scrollTop
      this.ticking = false
    },

    setStateClass() {
      if (this.scrollPosition === 0) {
        return 'nav-at-top'
      }

      if (
        this.scrollPosition < 50 ||
        (this.stateClass === 'nav-hide' &&
          this.scrollPosition <= this.savedScrollPosition - this.offset)
      ) {
        return 'nav-show'
      }

      if (
        this.stateClass !== 'nav-hide' &&
        this.scrollPosition >= this.savedScrollPosition + this.offset
      ) {
        return 'nav-hide'
      }

      return this.stateClass
    },

    setSavedScrollPosition() {
      if (this.scrollPosition < 5) {
        return this.scrollPosition
      }

      if (this.scrollPosition > this.savedScrollPosition && this.stateClass !== 'nav-show') {
        return this.scrollPosition
      }

      if (this.scrollPosition < this.savedScrollPosition && this.stateClass !== 'nav-hide') {
        return this.scrollPosition
      }

      return this.savedScrollPosition
    },
  },

  computed: {
    currentTheme() {
      return this.stateClass === 'nav-at-top' ? this.theme : this.stickyThemes
    },
  },

  watch: {
    scrollPosition() {
      this.stateClass = this.setStateClass()
      this.savedScrollPosition = this.setSavedScrollPosition()
    },
  },
}
</script>
