<template>
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
</template>

<script>
    import apiManiak from '../../utils/api.js';

    export default {

        props: ["animation", "id"],

        data() {
            return {
                project: []
            }
        },

        mounted() {
            apiManiak.getProject(this.$route.params.id).then(this.updateData);
        },

        methods: {
            updateData(response) {
                this.project = response.data;
                if (this.$props.animation) {
                    const overlay = new Revealer();
                    overlay.loadNewContents();
                }
            },

            close() {
                const overlay = new Revealer();
                overlay.reveal(this.project.preloader);
                overlay.loadNewContents();
                this.$router.push('/');
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
