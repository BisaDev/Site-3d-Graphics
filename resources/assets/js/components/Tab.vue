<template>
    <transition name="slide-fade">
        <div v-show="isActive">
            <slot></slot>
        </div>
    </transition>
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

<style>
    .slide-fade-enter {
        transform: translateY(10rem);
        opacity: 0;
    }
    .slide-fade-enter-to {

    }
    .slide-fade-enter-active {
        transition: all .5s cubic-bezier(0.215, 0.610, 0.355, 1.000);
    }
    .slide-fade-leave {

    }
    .slide-fade-leave-to {
        transform: translateY(10rem);
        opacity: 0;

    }
    .slide-fade-leave-active {
        transition: all .5s cubic-bezier(0.550, 0.055, 0.675, 0.190);
    }
</style>