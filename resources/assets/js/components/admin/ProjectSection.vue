<template>
    <div class="grid-x grid-padding-x" style="border: 2px solid #CCC; margin-top: 1rem;" v-if="visible">
        <div class="small-12 cell">
            <h2>{{section.component}}</h2>
            <button v-on:click.prevent="remove">Remove</button>
        </div>
        <input type="hidden" name="section[][section_parent_id]" v-model="section.id">
        <!-- <input type="hidden" name="section[][section_id]" v-model="section.model.id"> -->

        <div class="small-6 cell">
            <input type="checkbox" name="section[][is_dark]" v-model="section.is_dark"><label>Is Dark?</label>
        </div>
        <div class="small-6 cell">
            <input type="checkbox" name="section[][is_parallax]" v-model="section.is_parallax"><label>Is Parallax?</label>
        </div>
        <div class="small-6 cell">
            <label>Color
                <input type="text" name="section[][color]" placeholder="HEX Color: #FFFFFF" v-model="section.color">
            </label>
        </div>
        <div class="small-6 cell">
            <label>Order
                <input type="number" name="section[][color]" placeholder="Order" v-model="section.order">
            </label>
        </div>

        <div class="medium-6 cell">
            <label for="">Background Image</label>
            <div v-if="!section.background_image">
                <input accept="image/*" name="background_image" type="file" @change="onFileChange">
            </div>
            <div v-else>
                <img :src="section.background_image" style="width:100%; height: auto;" />
                <button @click.prevent="removeImage('background_image')">Remove image</button>
            </div>
        </div>

        <component :is="section.component" v-model="section" :section="section"/>

        <div class="small-12">
            <!-- <img v-for="image in model.images" :key="image.id" :src="image.image" :alt="image.image"> -->
        </div>
    </div>
</template>

<script>
import ProjectTextInformation from '../../components/admin/ProjectTextInformation'
import ProjectGallery from '../../components/admin/ProjectGallery'
import ProjectStickySection from '../../components/admin/ProjectStickySection'
import ProjectQuote from '../../components/admin/ProjectQuote'

export default {
  data() {
    return {
        visible: true
    }
  },

  components: {
    ProjectTextInformation,
    ProjectGallery,
    ProjectStickySection,
    ProjectQuote,
  },

  props: {
    section: {
      type: Object,
      required: true,
    },
  },

  methods: {
      remove() {
          this.section.visible = false
          this.visible = false
          console.log('remove!');
      },
      onFileChange(e) {
          var files = e.target.files || e.dataTransfer.files;

          if (!files.length) {
              return;
          }

          console.log();

          this.createImage(files[0], e.target.name)
      },

      createImage(file, field) {
          var image = new Image();
          var reader = new FileReader();
          var vm = this;

          reader.onload = (e) => {
              vm.section[field] = e.target.result;
          };

          reader.readAsDataURL(file);
      },

      removeImage(field) {
          this.section[field] = null
      },
  }
}
</script>
