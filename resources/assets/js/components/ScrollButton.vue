<template>
    <a :href="to" class="button button-scroll button-scroll-bottom" @click.prevent="scroll">
        <span v-for="twice in 2">{{ text }}</span>
    </a>
</template>

<script>
    import { scrollIt } from '../utils/scroll'
    export default {
        props: {
            to: {
                type: String,
                default: '#',
            },
            text: {
                type: String,
                default: 'Scroll Down',
            },
        },
        methods: {
            scroll() {
                scrollIt(document.querySelector(this.to), 1000, 'easeInOutCubic')
            }
        }
    }
</script>