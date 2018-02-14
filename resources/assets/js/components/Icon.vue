<template>
  <span :class="['icon', iconClass]" v-if="iconClass" />
</template>

<script>
export default {
  props: {
    iconClass: {
      type: String,
    },
  },
}
</script>
