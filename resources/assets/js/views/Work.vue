<template>
    <div class="work">
        <section class="work-header">
            <div class="container work-header-title-container">
                <h1>
                    <b>Maniak builds cool stuff.</b><br>Lorem ipsum dolor sit.
                </h1>
            </div>
            <div class="container work-header-filters-container">

                <link-tabs :projects="projects" key-to-group="hero_color"></link-tabs>

            </div>
        </section>
        <section class="work-portfolio">
            <div class="container">
                <div class="grid">
                    <router-link key="project.id" v-for="project in projects" :to="`/project/${project.id}`" class="preview reveal"
                                 :class="{'featured': project.is_featured}"
                                 :style="{backgroundColor: `${project.hero_color}`, backgroundImage: `${project.hero_image}`}">
                        <div class="preview-title">
                            <h5>{{project.name}}</h5>
                            <h6>{{project.preloader}}</h6>
                            <div class="preview-title-cta">
                                <p>Read more.</p>
                            </div>
                        </div>
                    </router-link>

                </div>
            </div>
        </section>
    </div>
</template>


<script>
    import PageCommon from '../components/PageCommon'
    import LinkTabs from '../components/LinkTabs'
    import apiManiak from '../utils/api'

    export default {
        extends: {...PageCommon},

        components: { LinkTabs },

        data() {
            return {
                projects: [],
            }
        },

        mounted() {
            apiManiak.getProjects()
                .then(this.updateData)
                .catch(() => { this.$emit('not-found') })
        },

        methods: {
            updateData(response) {
                this.setNavTheme(false)
                this.projects = response.data
                this.$emit('view-loaded')
            },
        },
    }
</script>
