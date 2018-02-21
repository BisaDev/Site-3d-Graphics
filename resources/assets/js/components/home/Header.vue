<template>
  <section class="home-header" :class="{dark}">
    <div class="home-header-background"></div>
    <div class="home-header-image" :class="{ show: showImage }"></div>
    <div class="home-header-explosion" :class="{ show: showExplosion }"></div>
    <div class="home-header-visual" :class="{ hidden: hideVisual }" @click="explode">
      <div class="home-header-visual-svg-wrap">
        <svg xmlns="http://www.w3.org/2000/svg" version="1.1">
          <defs>
            <filter id="goo">
              <feGaussianBlur in="SourceGraphic" stdDeviation="6" result="blur"/>
              <feColorMatrix in="blur" mode="matrix" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 16 -9" result="goo"/>
              <feComposite in="SourceGraphic" in2="goo" operator="atop"/>
            </filter>
          </defs>
          <g class="blob" filter="url(#goo)">
            <circle cx="47%" cy="52%" r="80" />
            <circle cx="55%" cy="49%" r="80" />
            <circle cx="47%" cy="52%" r="80" />
            <circle cx="55%" cy="49%" r="80" />
          </g>
        </svg>
      </div>
    </div>
    <div class="container home-header-title-container dark">
      <h1>
        Let us blow your mind.
      </h1>
    </div>
    <div class="container home-header-button-container">
      <scroll-button to="#home-info" text="Scroll down"></scroll-button>
    </div>
  </section>
</template>

<script>
import scrollButton from '../ScrollButton'
export default {
  data() {
    return {
      dark: false,
      hideVisual: false,
      showExplosion: false,
      showImage: false,
      showVisualTimeout: 1000,
    }
  },
  components: { scrollButton, },
  methods: {
    explode: function() {
      this.$emit('explode', !this.dark)
      this.dark = !this.dark
      if (this.hideVisual) {
        this.showImage = !this.showImage
        this.showExplosion = true
        setTimeout(() => {
          this.hideVisual = !this.hideVisual
          this.showExplosion = false
        }, this.showVisualTimeout)
      } else {
        this.hideVisual = !this.hideVisual
        this.showExplosion = true
        setTimeout(() => {
          this.showImage = !this.showImage
          this.showExplosion = false
        }, this.showVisualTimeout)
      }
    },
  },
}
</script>
