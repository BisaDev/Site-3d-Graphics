<template>
    <div class="container">
        <div class="grid">
            <div class="project-copy-text" v-html="body">

            </div>
        </div>
    </div>
</template>

<script>
export default {
  props: {
    body: {
      type: String,
      required: true,
    },
  },
}
</script>
