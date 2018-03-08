<template>
    <div class="work">
        <section class="work-header">
            <div class="container work-header-title-container">
                <div class="appear-after-reveal">
                    <h1>
                        <b>Maniak builds cool stuff.</b><br>Lorem ipsum dolor sit.
                    </h1>
                </div>
            </div>
        </section>
        <section class="work-portfolio">
            <project-filters :projects="projects" :areas="areas"></project-filters>
        </section>
    </div>
</template>


<script>
    import PageCommon from '../components/PageCommon'
    import ProjectFilters from '../components/ProjectFilters'
    import apiManiak from '../utils/api'


    export default {
        extends: {...PageCommon},

        components: { ProjectFilters },

        data() {
            return {
                areas: [],
                projects: [],
                projectsLoaded: false,
                areasLoaded: false,
            }
        },

        mounted() {
            apiManiak.getAreas()
                .then(this.updateAreas)
                .catch(() => { this.$emit('not-found') })
            apiManiak.getProjects()
                .then(this.updateProjects)
                .catch(() => { this.$emit('not-found') })
        },

        methods: {
            updateAreas(response) {
                this.setNavTheme(false)
                this.areas = response.data
                this.areasLoaded = true
                if(this.projectsLoaded){
                    this.$emit('view-loaded')
                }
            },
            updateProjects(response) {
                this.setNavTheme(false)
                this.projects = response.data
                this.projectsLoaded = true
                if(this.areasLoaded){
                    this.$emit('view-loaded')
                }
            },
        },
    }
</script>
