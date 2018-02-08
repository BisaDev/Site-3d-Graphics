<template>
  <section :style="{backgroundColor: color}" :class="{ dark: color !== 'transparent' && dark }">
    <slot></slot>
  </section>
</template>

<script>
  export default {
    props: {
      dark: {
        type: Boolean,
        default: false,
      },
      color: {
        type: String,
        default: 'transparent'
      }
    }
  }
</script>

<style>

</style>