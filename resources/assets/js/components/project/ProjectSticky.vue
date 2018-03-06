<template>
    <div class="container">
        <div class="grid">
            <div class="project-copy-sticky" v-html="content"></div>
            <div class="project-screenshot-long">
                <img :src="image" />
            </div>
        </div>
    </div>
</template>
<script>

export default {
  props: {
      content: {
          type: String,
          required: true,
      },
      image: {
          type: String,
          required: true,
      },
  },
}
</script>
