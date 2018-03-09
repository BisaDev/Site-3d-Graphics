<template>
    <tabs :tabs-list-classes="['work-header-filters-list']" :tabs-container-classes="['container', 'work-header-filters-container']" >
        <tab name="All" :suffix="buildSuffix(projects.length)" :selected="true">
            <div class="container">
                <div class="grid">
                    <router-link v-for="(project, index) in projects" :to="{name: 'project', params: { id: project.id,  phrases: [project.preloader] }}" :key="`all-${index}`"
                                 class="preview reveal" :class="[{featured: project.is_featured, dark: project.is_dark}]"
                                 :style="{backgroundColor: project.hero_color, backgroundImage: `url(${project.hero_image})`}">
                        <div class="preview-title">
                            <h5>{{ project.name }}</h5>
                            <h6>{{  project.description  }}</h6>
                            <div class="preview-title-cta">
                                <p>Read more.</p>
                            </div>
                        </div>
                    </router-link>
                </div>
            </div>
        </tab>
        <tab v-for="area in areas" :key="area.id" :name="area.name" :suffix="buildSuffix(area.projects.length)" >
            <div class="container">
                <div class="grid">
                    <router-link v-for="(project, index) in area.projects" :to="{name: 'project', params: { id: project.id,  phrases: [project.preloader] }}" :key="`${area.name}-${index}`"
                                 class="preview reveal" :class="[{featured: project.is_featured, dark: project.is_dark}]"
                                 :style="{backgroundColor: project.hero_color, backgroundImage: `url(${project.hero_image})`}">
                        <div class="preview-title">
                            <h5>{{ project.name }}</h5>
                            <h6>{{  project.description  }}</h6>
                            <div class="preview-title-cta">
                                <p>Read more.</p>
                            </div>
                        </div>
                    </router-link>
                </div>
            </div>
        </tab>
    </tabs>
</template>

<script>
    import Tabs from '../components/Tabs'
    import Tab from '../components/Tab'

    export default {

        props: {
            projects: {
                type: Array,
                required: true,
            },
            areas: {
                type: Array,
                required: true,
            },
        },

        components: { Tabs, Tab },

        methods: {
            buildSuffix(projectCount) {
                return `<span class="filter-count">${projectCount}</span>`
            }
        }
    }
</script>

<style scoped>

</style>