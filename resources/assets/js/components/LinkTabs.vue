<template>
    <div></div>
</template>

<script>
    import _ from 'lodash'
    export default {
        props: {
            projects: {
                type: Array,
                required: true,
            },
            keyToGroup: {
                type: String,
                required: true,
            },
        },

        computed: {
            tabs() {
                return _.groupBy(this.projects, element => element[this.keyToGroup])
            }
        },
        mounted() {
            console.log( _.groupBy(this.projects, element => element[this.keyToGroup]))
            console.log( this.projects )
        }

    }
</script>

<style scoped>

</style>