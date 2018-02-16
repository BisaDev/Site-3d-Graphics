<template>
    <ul class="work-header-filters-list">
        <li :key="project.id" :to="`/project/${project.id}`" class=""
             v-for="(project, key) in tabs">
            <a href="">{{key}}<span class="filter-count">{{project.length}}</span></a>
        </li>
    </ul>
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
                let groupedItems = _.groupBy(this.projects, element => element[this.keyToGroup])
                return _.extend({All: this.projects}, groupedItems);
            }
        }

    }
</script>

<style scoped>

</style>