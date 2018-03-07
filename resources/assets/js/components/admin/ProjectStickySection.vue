<template>
    <div class="cell">
        <input type="hidden" name="section[][section_id]" v-model="section.model.id">

        <div class="small-12 cell">
            <label>Body
                <textarea name="section[][body]" id="" cols="30" rows="10" v-model="section.model.body"></textarea>
            </label>
        </div>

        <div class="medium-12 cell">
            <label for="">Image</label>
            <div v-if="!section.model.image">
                <input accept="image/*" name="background_image" type="file" @change="onFileChange">
            </div>
            <div v-else>
                <img :src="section.background_image" style="width:100%; height: auto;" />
                <button @click.prevent="removeImage('background_image')">Remove image</button>
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
