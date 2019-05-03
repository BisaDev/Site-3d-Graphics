<template>
  <nav :class="['navbar', currentTheme, stateClass, {'navbar-mobile-show': mobileClass}]" ref="nav">
    <div class="container">
      <router-link class="navbar-logo" to="/">
        <logo></logo>
      </router-link>
      <ul class="navbar-menu">
        <li>
          <router-link to="/">Home</router-link>
        </li>
        <li>
          <router-link to="/work">Work</router-link>
        </li>
        <li>
          <router-link to="/studio">Studio</router-link>
        </li>
        <li>
          <router-link to="/contact">Contact</router-link>
        </li>
        <li>
          <router-link to="/news">News</router-link>
        </li>
      </ul>
      <div  class="hamburger" :class="{'is-opened-navi': this.hamburgerClass}" role="button" @click="toggleMobileNav">
        <div class="hamburger-line hamburger-line-01">
          <div class="hamburger-line-in hamburger-line-in-01"></div>
        </div>
        <div class="hamburger-line hamburger-line-02">
          <div class="hamburger-line-in hamburger-line-in-02"></div>
        </div>
        <div class="hamburger-line hamburger-line-03">
          <div class="hamburger-line-in hamburger-line-in-03"></div>
        </div>
        <div class="hamburger-line hamburger-line-cross01">
          <div class="hamburger-line-in hamburger-line-in-cross01"></div>
        </div>
        <div class="hamburger-line hamburger-line-cross02">
          <div class="hamburger-line-in hamburger-line-in-cross02"></div>
        </div>
      </div>
    </div>
  </nav>
</template>

<style>
.nav-show {
  transform: translateY(0%);
  top: 0;
}

.nav-hide {
  transform: translateY(-100%);
  top: 0;
}

.nav-at-top {
  transform: translateY(0%);
  top: 1.5rem;
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
      mobileClass: false,
      offset: 5, //px
      hamburgerClass: false,
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

    toggleMobileNav() {
        this.mobileClass = !this.mobileClass
        this.hamburgerClass = !this.hamburgerClass
    },

    closeMobileNav() {
        this.mobileClass = false
        this.hamburgerClass = false
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
        this.scrollPosition >= this.savedScrollPosition + this.offset &&
        !this.mobileClass
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
