<template>
  <section :style="{backgroundColor: isThemed ? color : 'transparent'}" :class="{ dark: isThemed && isDark }">
    <slot></slot>
  </section>
</template>

<script>
export default {
  props: {
    isDark: {
      type: Boolean,
      default: false,
    },
    color: {
      type: String,
      default: 'transparent',
    },
    isThemed: {
      type: Boolean,
      default: false,
    },
  },
}
</script>

<style>

</style>
