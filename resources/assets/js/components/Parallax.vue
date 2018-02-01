<template>

  <section :style="{backgroundPosition: `50% ${backgroundPositionOffset}px` }" class="parallax" ref="parallax">
    <slot></slot>
  </section>

</template>

<script>
export default {
  props: {
    speed: {
      type: Number,
      default: -4,
    },
  },
  data() {
    return {
      backgroundPositionOffset: 0,
    }
  },
  methods: {
    handleParallax() {
      this.backgroundPositionOffset = -this.$refs.parallax.getBoundingClientRect().top / this.speed
      console.log(this.$refs.parallax.getBoundingClientRect().top)
    },
  },

  created() {
    window.addEventListener('scroll', () => this.handleParallax())
  },
  destroyed() {
    window.removeEventListener('scroll', () => this.handleParallax())
  },
}
</script>
