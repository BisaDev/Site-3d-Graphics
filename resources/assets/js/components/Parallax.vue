<template>

  <section class="parallax" ref="parallax">
    <slot></slot>
  </section>

</template>

<script>
  export default {
    props: {
      speed: {
        type: Number,
        default: -4,
      }
    },
    mounted() {
      const parallax = this.$refs.parallax
      window.onscroll = () => {
        const scrollTop = window.scrollY
        parallax.style.backgroundPosition = "50%" + window.scrollY / this.speed + "px";
      };
    },
  }
</script>
