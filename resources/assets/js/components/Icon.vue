<template>
  <span :class="['icon', iconClass]" v-if="iconClass">&nbsp;</span>
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
