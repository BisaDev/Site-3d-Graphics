<template>
    <div v-show="isActive">
        <slot></slot>
    </div>
</template>

<script>
    export default {
        props: {
            name: {required: false},
            selected: {default: false},
            prefix: {default: ''},
            suffix: {default: ''},
        },

        data() {
            return {
                isActive: false
            }
        },

        computed: {
            hash() {
                return '#' + this.name.toLowerCase()
                    .replace(/ /g, '-')
                    .replace(/\&/g, 'and')
                    .replace(/^([0-9])/g, 'n$1')
            },
            header() {
                return this.prefix + this.name + this.suffix
            },
        },
        mounted(){
            this.$parent.$emit('tab-mounted')
        }
    }
</script>
