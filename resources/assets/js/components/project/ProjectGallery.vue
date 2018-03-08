<template>
    <section class="project-gallery">
        <div class="container">
            <div class="grid">
                <div :style="{backgroundColor: image.color, backgroundImage: `url(${image.image})`}" ref="galleryImage" v-for="(image, index) in images" @click="openPhotoSwipe(index)"
                     class="project-gallery-image">
                </div>
            </div>
        </div>
    </section>
</template>


<style>
    .gallery-image {
        height: 300px;
        width: 500px;
    }

    .gallery-image img {
        height: 100%;
        width: 100%;
    }
</style>

<script>
    import PhotoSwipeUI_Default from 'photoswipe/dist/photoswipe-ui-default'
    import PhotoSwipe from 'photoswipe/dist/photoswipe'

    export default {
        props: {
            images: {
                type: Array,
                default: () => [],
            },
        },
        data() {
            return {
                images_obj: this.images.map(function (image) {
                    return {src: image.image, msrc: image.image, w: 1000, h: 1000}
                }),
            }
        },
        methods: {
            openPhotoSwipe(index = 0) {
                const pswpElement = this.$root.$refs.pswp
                const options = {
                    getThumbBoundsFn: this.getThumbBoundsFn,
                    history: false,
                    index: index,
                }

                const gallery = new PhotoSwipe(pswpElement, PhotoSwipeUI_Default, this.images_obj, options)
                gallery.init()
            },
            getThumbBoundsFn(index) {
                const thumbnail = this.$refs.galleryImage[index]
                const pageYScroll = window.pageYOffset || document.documentElement.scrollTop
                const rect = thumbnail.getBoundingClientRect()

                return {x: rect.left, y: rect.top + pageYScroll, w: rect.width}
            },
        },
    }
</script>
