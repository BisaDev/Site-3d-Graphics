<template>
    <div>
        <!-- Hero Information -->
        <section id="whoweare" class="no-padding section-dark align-center component">
            <div id="myNav" class="overlay">
                <!-- Button to close the overlay navigation -->
                <a href="#" class="closebtn" @click.prevent="close">&times;</a>
            </div>
            <div class="container">
                <div class="row">
                    <h1>{{project.name}}</h1>
                    <h3 class="col-8 col-offset-2 text-center">{{project.description}}.</h3>
                </div>
            </div>
        </section>

        <!-- Main Information -->
        <div class="bg-white text-black py-8">
            <div class="container flex">
                <div class="flex-1">
                    <strong>{{ project.info_title }}</strong>
                    <p>{{ project.info_description }}</p>
                </div>
                <div class="flex-1">
                    Services
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import apiManiak from '../../utils/api.js';

    export default {

        props: {
            id: {
                required: true,
            },

            reveal: {
                default: false,
                type: Boolean
            }
        },

        data() {
            return {
                project: {}
            }
        },

        mounted() {
            apiManiak.getProject(this.$props.id).then(this.updateData);
        },

        methods: {
            updateData(response) {
                this.project = response.data;

                if (this.$props.reveal) {
                    const revealer = new Revealer();
                    revealer.animateLayersOut();
                }
            },

            close() {
                const revealer = new Revealer();
                revealer.reveal(this.project.preloader).then(() => {
                    this.$router.push({
                        name: 'home',
                        params: {
                            reveal: true
                        }
                    });
                });
            }
        }
    }
</script>

<style scoped>
    .overlay .closebtn {
        position: absolute;
        top: 100px;
        right: 45px;
        font-size: 60px;
        color: #FFF;
        text-decoration: none;
    }
</style>
