<template>
    <div v-show="isActive"><slot></slot></div>
</template>

<script>
    export default {
        props: {
            name: { required: false },
            selected: { default: false },
            prefix: { default: '' },
            suffix: { default: '' },
        },

        data() {
            return {
                isActive: false
            };
        },

        computed: {
            href() {
                return '#' + this.name.toLowerCase().replace(/ /g, '-');
            },
            header() {
                return this.prefix + this.name + this.suffix;
            },
        },

        mounted() {
            this.isActive = this.selected;
        },
    }
</script>
