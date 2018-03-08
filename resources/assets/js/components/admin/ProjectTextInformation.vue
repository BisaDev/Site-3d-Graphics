<template>
    <div class="cell">
        <input type="hidden" name="section[][section_id]" v-model="section.model.id">

        <div class="small-12 cell">
            <label>Title
                <textarea maxlength="255" name="section[][title]" cols="30" rows="5" v-model="section.model.title"></textarea>
            </label>
        </div>
        <div class="small-12 cell">
            <label>Body
                <textarea name="section[][body]" cols="30" rows="10" v-model="section.model.body"></textarea>
            </label>
        </div>
        <div class="small-12">
            <!-- <img v-for="image in model.images" :key="image.id" :src="image.image" :alt="image.image"> -->
        </div>
    </div>
</template>

<script>
export default {
  data() {
    return {}
  },

  props: {
    section: {
      type: Object,
      required: true,
    },
  }
}
</script>
