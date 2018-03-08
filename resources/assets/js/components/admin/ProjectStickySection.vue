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

        <div class="medium-12 cell">
            <label for="">Image</label>
            <div v-if="!section.model.image">
                <input accept="image/*" name="image" type="file" @change="onFileChange">
            </div>
            <div v-else>
                <img :src="section.model.image" style="width:100%; height: auto;" />
                <button @click.prevent="removeImage('image')">Remove image</button>
            </div>
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
            }
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
                    vm.section.model[field] = e.target.result;
                };

                reader.readAsDataURL(file);
            },

            removeImage(field) {
                this.section.model[field] = null
            },
        }
    }
</script>
