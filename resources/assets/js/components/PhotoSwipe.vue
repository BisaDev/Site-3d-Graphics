<template>
    <section class="ps-gallery">
        <div v-for="(image, index) in images" v-on:click="openPhotoSwipe(index)" class="gallery-image">
            <img :src="image" style="height: 100%; width: 100%;"/>
        </div>
    </section>
</template>


<style>
    .gallery-image { height: 300px; width: 500px; }
    .gallery-image img { height: 100%; width: 100%; }
</style>

<script>
    import PhotoSwipeUI_Default from 'photoswipe'
    import PhotoSwipe from 'photoswipe'

    export default {
        props: {
            images: {
                type: Array,
                default: () => [],
            },
        },
        data() {
            return {
                width: 1024,
                height: 683,
            }
        },
        methods: {
            openPhotoSwipe: function (index) {
                const pswpElement = this.$root.$refs.pswp;
                const options = {
                    showAnimationDuration: 0,
                    hideAnimationDuration: 0,
                    history: false,
                    focus: false,
                    index: index,
                };

                const gallery = new PhotoSwipe(pswpElement, PhotoSwipeUI_Default, this.images, options);
                gallery.init();
            }
        },
        mounted() {
            let vueInstance = this;

            this.images.map(function (el) {
                return {src: el, el: el, w: vueInstance.width, h: vueInstance.height}
            });
            this.openPhotoSwipe(0);
        }
    }
</script>
