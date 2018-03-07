<template>

    <section class="parallax" ref="parallax">
        <div :style="{transform: `translate(${backgroundPositionOffsetX}vw,${backgroundPositionOffsetY}px)`, backgroundImage: image }"
             class="parallax-image" ref="parallaxImage"></div>
        <slot></slot>
    </section>

</template>

<script>
    export default {
        props: {
            speed: {
                type: Number,
                default: -4,
            },
            horizontal: {
                type: Boolean,
                default: false,
            },
            image: {
                type: String,
                required: true,
            }
        },
        data() {
            return {
                backgroundPositionOffsetY: 0,
                backgroundPositionOffsetX: 0,
            }
        },
        methods: {
            handleParallax() {
                this.backgroundPositionOffsetY = this.$refs.parallax.getBoundingClientRect().top / this.speed
                if (this.horizontal == true) {
                    const offsetX =
                        this.$refs.parallax.getBoundingClientRect().bottom /
                        (window.innerHeight + this.$refs.parallax.getBoundingClientRect().height)
                    const factorX =
                        this.$refs.parallaxImage.getBoundingClientRect().width / window.innerWidth * 50
                    this.backgroundPositionOffsetX = -offsetX * factorX * 0.5
                }
            },
        },

        created() {
            window.addEventListener('scroll', this.handleParallax)
        },
        destroyed() {
            window.removeEventListener('scroll', this.handleParallax)
        },
    }
</script>
