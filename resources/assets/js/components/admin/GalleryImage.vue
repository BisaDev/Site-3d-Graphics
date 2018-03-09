<template>
    <div class="small-6 column" v-if="visible">
        <input type="hidden" name="" v-model="image.id">
        <input type="hidden" name="" v-model="image.width">
        <input type="hidden" name="" v-model="image.height">

        <div class="small-12 cell">
            <button @click.prevent="remove">Remove Gallery Image</button>
        </div>

        <div class="medium-6 cell">
            <label>Hero Color
                <input v-model="image.color" name="" type="text" placeholder="HEX Color: #FFFFFF">
            </label>
        </div>

        <div class="small-12 cell">
            <label for="">Background Size</label>
            <select name="sections" v-model="image.background_size">
                <option disabled value="">Please select one</option>
                <option value="cover">Cover</option>
                <option value="contain">Contain</option>
            </select>
        </div>

        <div class="medium-12 cell">
            <label for="">Image</label>
            <div v-if="!image.image">
                <input accept="image/*" name="image" type="file" @change="onFileChange">
            </div>
            <div v-else>
                <a class="thumbnail" :style="{backgroundImage : `url(${image.image})`}" :href="image.image" target="_blank">
                </a>

                <!--<img :src="image.image" style="max-width:200px; width:100%; height: auto;" />-->
                <button @click.prevent="removeImage('image')">Remove image</button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
  data() {
    return {
      visible: true,
    }
  },
  props: {
    image: {
      type: Object,
      required: true,
    }
  },
  methods: {
    remove() {
      this.image.visible = false
      this.visible = false
      console.log('remove!');
    },
    onFileChange(e) {
      var files = e.target.files || e.dataTransfer.files;
      if (!files.length) {
        return;
      }

      this.createImage(files[0], e.target.name)
    },

    createImage(file, field) {
      var image = new Image();
      var reader = new FileReader();
      var vm = this;

      reader.onload = (e) => {
        vm.image[field] = e.target.result;
        image.src =e.target.result
      }

      image.onload = function() {
        vm.image.height = this.naturalHeight
        vm.image.width = this.naturalWidth
      }

      reader.readAsDataURL(file);
    },

    removeImage(field) {
      this.image[field] = null
    },
  }
}
</script>
