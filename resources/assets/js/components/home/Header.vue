<template>
  <section class="home-header no-padding fullscreen no-margin" :class="{dark}">
    <div class="home-header-background"></div>
    <div class="home-header-explosion" :class="{ show: showExplosion }"></div>
    <div class="home-header-visual" :class="{ hidden: hideVisual }" @click="explode">
      <div class="home-header-visual-svg-wrap">
        <svg xmlns="http://www.w3.org/2000/svg" version="1.1">
          <defs>
            <filter id="goo">
              <feGaussianBlur in="SourceGraphic" stdDeviation="9" result="blur"/>
              <feColorMatrix in="blur" mode="matrix" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 19 -9" result="goo"/>
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
    <div class="container dark">
      <h1>
        Let us blow your mind.
      </h1>
      <button class="button button-scroll">
        <span>Scroll down</span><span>Scroll down</span>
      </button>
    </div>
  </section>
</template>

<script>
export default {
  data() {
    return {
      dark: false,
      hideVisual: false,
      showExplosion: false,
      showVisualTimeout: 2000,
    }
  },
  methods: {
    explode() {
      this.$emit('explode', !this.dark)
      this.hideVisual = true
      this.showExplosion = true
      this.dark = !this.dark
      setTimeout(() => {
        this.hideVisual = false
        this.showExplosion = false
      }, this.showVisualTimeout)
    },
  },
}
</script>
