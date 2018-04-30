<template>
    <div class="thanks">
        <!-- Hero -->
        <themed-section
            :color="'#FFF'"
            :image="null"
            :isDark="true"
            :class="['thanks-header', 'align-center', 'no-padding']"
        >
            <div class="thanks-header-title-container container">
                <div class="appear-after-reveal">
                    <div class="thanks-header-emoji">
                        <p>🙃</p>
                    </div>
                    <h1 class="thanks-header-title">Awesome!</h1>
                    <h2 class="thanks-header-subtitle">We'll be in touch soon, very soon.</h2>
                </div>
            </div>
        </themed-section>

        <div class="grid-container thanks-gif">
            <div class="grid-x align-center">
                <div class="cell small-12 medium-8 large-5 large-centered small-centered">
                    <img :src="gif" class="thanks-gif-image" />
                </div>
            </div>
        </div>

        <div class="grid-container">
            <div class="grid-x align-center">
                <div class="cell small-12 medium-8 large-5 large-centered small-centered">
                    <button class="thanks-homepage-button button">
                        <router-link :to="{ name: 'home' }">Maniak's Homepage</router-link>
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import apiManiak from '../utils/api.js'
    import ThemedSection from '../components/ThemedSection'
    import pageCommon from '../components/PageCommon'
    import ScrollButton from '../components/ScrollButton'

    export default {
        extends: {...pageCommon},

        props: {
            reveal: {
                default: false,
                type: Boolean,
            },
            loaded: {
                default: false,
                type: Boolean,
            },
        },

        components: {
            ThemedSection,
            ScrollButton,
        },

        data() {
            return {
                gif: null,
            }
        },

        created() {
            if (!this.loaded) {
                this.$emit('not-found')
            }
        },

        mounted() {
            this.setNavTheme(false)
            this.$emit('view-loaded')
            this.getGif()
        },

        computed: {},

        methods: {
            getGif() {
                apiManiak
                    .getThanksGif()
                    .then(response => {
                        if (response.data.success) {
                            this.gif = response.data.gif
                        } else {
                            this.$emit('not-found')
                        }
                    })
                    .catch(error => {
                        this.$emit('not-found')
                    })
            },
        },
    }
</script>