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
              <feGaussianBlur in="SourceGraphic" stdDeviation="8" result="blur" />
              <feColorMatrix in="blur" mode="matrix" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 16 -6" result="goo" />
              <feComposite in="SourceGraphic" in2="goo" operator="atop"/>
            </filter>
          </defs>
          <g filter="url(#goo)" class="blob">
            <circle cx="51%" cy="50%" r="148px" />
            <circle cx="50%" cy="51%" r="140px" />
            <circle cx="51%" cy="50%" r="144px" />
          </g>
        </svg>
      </div>
    </div>
    <div class="container home-header-title-container dark">
      <div class="appear-after-reveal">
        <h1>Let us blow your mind.</h1>
      </div>
    </div>
    <div class="container home-header-button-container">
      <scroll-button to="#home-info" text="Scroll down"></scroll-button>
    </div>
  </section>
</template>

<script>
import ScrollButton from '../ScrollButton'
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
  components: { ScrollButton, },
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
