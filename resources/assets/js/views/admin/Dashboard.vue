<template>
    <div class="home">
        <router-link to="admin/projects">Go to Projects.</router-link>
    </div>
</template>


<script>
export default {
  props: {
    reveal: {
      default: false,
      type: Boolean,
    },
  },

  data() {
    return {
      projects: [],
    }
  },
}
</script>
