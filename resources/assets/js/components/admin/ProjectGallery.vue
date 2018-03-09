<template>
    <div class="cell">
        <input type="hidden" name="section[][section_id]" v-model="section.model.id">

        <h3>Gallery Images</h3>

        <div class="small-12 cell">
            <button @click.prevent="addImage">Add Gallery Image</button>
        </div>

        <GalleryImage
            v-for="(image, index) in section.model.images"
            :key="index"
            :image="section.model.images[index]"
        >
        </GalleryImage>

    </div>
</template>

<script>
import GalleryImage from '../admin/GalleryImage'

export default {
    beforeMount() {
      if (!this.section.model.images) {
          this.section.model.images = []
      }
  },
  data() {
    return {}
  },
  components: {
    GalleryImage,
  },
  props: {
    section: {
      type: Object,
      required: true,
    }
  },
  methods: {
    addImage() {
      this.section.model.images.push({
        width: 0,
        height: 0,
        image: null,
        background_size: null,
      })
    },
  }
}
</script>
