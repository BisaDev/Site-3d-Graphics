<template>
    <div class="home">
        <router-link to="admin/projects">Link</router-link>
    </div>
</template>


<script>
    //import apiManiak from '../utils/api'
    import cookie from '../../utils/cookies'

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
            /*
            axios.get('api/v1/user', {
                headers: {
                    'Accept': 'application/json',
                    'Authorization': 'Bearer ' + JSON.parse(cookie.getItem('credentials')).access_token,
                },
                //credentials: 'include',
            })
                .then(response => {
                    console.log(response)
                });
                */
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
