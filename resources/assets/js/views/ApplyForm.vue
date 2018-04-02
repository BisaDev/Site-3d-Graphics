<template>
    <div class="apply" v-if="apply !== null">
        <!-- Hero -->
        <themed-section
            :color="'#FFF'"
            :image="null"
            :isDark="true"
            :class="['apply-header', 'align-center', 'no-padding']"
        >
            <div class="apply-header-title-container container">
                <div class="appear-after-reveal">
                    <div class="apply-header-emoji">
                        <p>😱</p>
                    </div>
                    <h1 class="apply-header-title">
                        You're one step closer!
                    </h1>
                    <h2> Let us Know you better.</h2>
                </div>
            </div>
        </themed-section>

        <!-- Apply Form -->
        <section id="apply-form" class="apply-form">
            <div class="apply-form-msg" v-if="messages">
                {{messages}}
            </div>
            <form v-on:submit.prevent="sendForm">
                <div class="grid-container">
                    <div class="grid-x grid-margin-x">
                        <div class="cell small-12 large-4 large-offset-4">
                            <label>Name *
                                <input type="text" placeholder="Need it." v-model="form.name">
                            </label>
                        </div>
                        <div class="cell small-12 large-4  large-offset-4">
                            <label>Email *
                                <input type="text" placeholder="Yup, we need it too." v-model="form.email">
                            </label>
                        </div>
                        <div class="cell small-12 large-4  large-offset-4">
                            <label>
                                Add a cover letter or anything you want to share
                                <span :class="['apply-textbox-counter', {'limit-reach' : maxReached}]">
                                    {{wordCount}}/{{maxChars}}
                                </span>
                                <textarea placeholder="Be creative." v-model="form.message" v-bind:maxlength="maxChars"></textarea>
                            </label>
                        </div>
                        <div class="cell small-12 large-4  large-offset-4">
                            <label>Do you have a Github or Bitbucket profile?
                                <input type="text" placeholder="Drop it here." v-model="form.profile">
                            </label>
                        </div>
                        <div class="cell small-12 large-4  large-offset-4">
                            <div class="recruitment-apply-now-container">
                                <button class="recruitment-apply-now-button">
                                    <router-link :to="{name: 'apply', params: { phrases: ['Are you ready to make a difference?']}}">Submit</router-link>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </section>
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
        },

        components: {
            ThemedSection,
            ScrollButton,
        },

        data() {
            return {
                apply: null,
                form: {
                    name: '',
                    email: '',
                    profile: '',
                    message: '',
                },
                maxChars: 500,
                messages: '',
            }
        },

        mounted() {
            this.fetchData()
        },

        computed: {
            wordCount: function () {
                return this.form.message.length
            },
            maxReached: function () {
                return this.wordCount === this.maxChars
            }
        },

        methods: {
            fetchData() {
                apiManiak
                    .getRecruitmentData()
                    .then(response => {
                        this.fillData(response)
                    })
                    .catch(() => {
                        this.$emit('not-found')
                    })
            },
            fillData(response) {
                this.apply = response.data
                this.setNavTheme(false)
                this.$emit('view-loaded')
            },
            sendForm() {
                apiManiak
                    .sendApplyForm()
                    .then(response => {

                    })
                    .catch(() => {

                    })
            }
        },
    }
</script>