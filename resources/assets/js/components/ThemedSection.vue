<template>
    <parallax v-bind="$props" :style="{backgroundColor: color}" :image="bgImage" :class="{ dark: isDark }" v-if="parallax">
        <slot></slot>
    </parallax>
    <section v-else :style="{backgroundColor: color, backgroundImage: bgImage}" :class="{ dark: isDark }">
        <slot></slot>
    </section>
</template>

<script>
    import Parallax from './Parallax'

    export default {
        components: {
            Parallax,
        },
        props: {
            isDark: {
                type: Boolean,
                default: false,
            },
            color: {
                type: String,
                default: 'transparent',
            },
            parallax: {
                type: Boolean,
                default: false,
            },
            image: {
                type: String,
                default: '',
            },
        },
        data() {
            const bgImage = this.image ? `url(${this.image})` : 'none'
            return {
                bgImage
            }
        }
    }
</script>
