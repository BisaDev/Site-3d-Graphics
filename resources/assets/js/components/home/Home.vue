<template>
    <div>
        <home-header />
        <home-info />

        <section id="featured" class="section-dark component">
            <div class="container">
                <div class="row">
                    <div class="col-4 col-no-padding" v-for="project in projects">
                        <a href="#" @click.prevent="showProject(project)" class="featured featured-wolverine reveal" data-color="#FCFCFD">
                            <div class="featured-title">
                                <h5>{{project.name}}</h5>
                                <h6>{{project.description}}</h6>

                                <div class="featured-title-description">
                                    <p>Read more.</p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <home-footer />
    </div>
</template>


<script>
    import homeHeader from './Header';
    import homeInfo from './Info';
    import homeFooter from './Footer';

    import Menu from '../../utils/menu';
    import apiManiak from '../../utils/api';

    export default {
        components: {homeHeader, homeInfo, homeFooter},

        data() {
            return {
                projects: []
            }
        },

        mounted() {
            apiManiak.getProjects().then(this.updateData);
            Menu.run();
        },

        methods: {
            showProject(project) {
                const overlay = new Revealer();
                overlay.reveal(project.preloader);

                this.$router.push({
                    name: "project",
                    params: {
                        id: project.id,
                        animation: true
                    }
                });
            },

            updateData(response) {
                this.projects = response.data;
            }
        }
    }
</script>
