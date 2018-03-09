<template>
    <div class="container">
        <div class="grid">
            <div class="project-copy-sticky">
                <h4 v-html="title" v-if="title"></h4>
                <p v-html="body"></p>
            </div>
            <div class="project-screenshot-long">
                <img :src="image" />
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
      image: {
          type: String,
          required: true,
      },
      title: {
          type: String,
          default: '',
      },
  },
}
</script>
