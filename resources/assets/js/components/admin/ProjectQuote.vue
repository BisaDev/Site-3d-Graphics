<template>
    <div class="cell">
        <input type="hidden" name="section[][section_id]" v-model="section.model.id">

        <div class="small-12 cell">
            <label>Body
                <textarea name="section[][body]" cols="30" rows="10" v-model="section.model.body"></textarea>
            </label>
        </div>
        <div class="small-12 cell">
            <label>Author
                <input type="text" maxlength="191" name="section[][author]" v-model="section.model.author" />
            </label>
        </div>
        <div class="small-12 cell">
            <label>Title
                <input type="text" maxlength="191" name="section[][title]" v-model="section.model.title" />
            </label>
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
