<template>
    <div class="project-form">
        <div class="row">
            <h2>Project</h2>
        </div>
        <form>
            <div class="grid-container">
                <div class="grid-x grid-padding-x">
                    <div class="medium-6 cell">
                        <label>Name
                            <input name="name" type="text" placeholder="Name">
                        </label>
                    </div>
                    <div class="medium-6 cell">
                        <label>Description
                            <input name="description" type="text" placeholder="Description">
                        </label>
                    </div>
                    <div class="medium-6 cell">
                        <label>Info Subtitle
                            <input type="text" placeholder="Info Subtitle">
                        </label>
                    </div>
                    <div class="medium-6 cell">
                        <label>Info Description
                            <input type="text" placeholder="Info Description">
                        </label>
                    </div>
                    <div class="medium-6 cell">
                        <input id="checkbox1" type="checkbox"><label for="checkbox1">Is feature Project?</label>
                    </div>
                    <div class="medium-6 cell">
                        <label>Country
                            <select>
                                <option value="1">Mexico</option>
                                <option value="2">United States</option>
                                <option value="3">Colombia</option>
                                <option value="4">Brazil</option>
                            </select>
                        </label>
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>


<script>
    //import apiManiak from '../utils/api'

    export default {
        /*
        beforeRouteLeave(to, from, next) {
            //this.$root.$refs.revealer.reveal().then(() => next())
        },

        */
        props: {
            reveal: {
                default: false,
                type: Boolean,
            },
        },

        components: {
            //navbar,
            //homeHeader,
            //photoSwipe,
            //homeInfo,
        },

        data() {
            return {
                projects: [],
            }
        },

        mounted() {
            //apiManiak.getProjects().then(this.updateData)
        },

        methods: {
            updateData(response) {
                this.projects = response.data
                //this.$root.$refs.revealer.close()
            },
        },
    }
</script>