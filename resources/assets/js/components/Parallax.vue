<template>
  <section class="parallax">
    <div :style="{
      transform: `translate(${backgroundPositionOffsetX}vw,${backgroundPositionOffsetY}px)`,
      backgroundImage: image
     }" class="parallax-image" ref="parallaxImage"></div>
    <slot></slot>
  </section>
</template>

<script>
import Scroller from './Scroller'

export default {
  extends: { ...Scroller },
  props: {
    speed: {
      type: Number,
      default: -4,
    },
    horizontal: {
      type: Boolean,
      default: false,
    },
    image: {
      type: String,
      required: true,
    },
  },
  data() {
    const scrollerFunction = this.handleParallax
    return {
      backgroundPositionOffsetY: 0,
      backgroundPositionOffsetX: 0,
      scrollerFunction,
    }
  },
  methods: {
    handleParallax() {
      const elPosition = this.$el.getBoundingClientRect()
      this.backgroundPositionOffsetY = elPosition.top / this.speed
      if (this.horizontal == true) {
        const offsetX = elPosition.bottom / (window.innerHeight + elPosition.height)
        const factorX =
          this.$refs.parallaxImage.getBoundingClientRect().width / window.innerWidth * 50
        this.backgroundPositionOffsetX = -offsetX * factorX * 0.5
      }
      this.ticking = false
    },
  },
  created() {
    this.$on('_scroll', this.handleParallax)
  },
}
</script>
