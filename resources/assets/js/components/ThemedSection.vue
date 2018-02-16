<template>
  <parallax v-bind="$props" v-if="parallax">
    <slot></slot>
  </parallax>
  <section v-else :style="{backgroundColor: color, backgroundImage: image}" :class="{ dark: isDark }">
    <slot></slot>
  </section>
</template>

<script>
import Parallax from './Parallax'
export default {
  components: {
    Parallax,
  },
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
    parallax: {
      type: Boolean,
      default: false,
    },
    image: {
      type: String,
      default: 'none',
    },
  },
}
</script>

<style>

</style>
