<template>
    <div class="recruitment" v-if="recruitment !== null">
        <!-- Hero -->
        <themed-section
            :color="recruitment.hero_color"
            :image="recruitment.hero_image"
            :isDark="Boolean(recruitment.is_dark)"
            :class="['recruitment-header', 'align-center', 'no-padding']"
        >
            <div class="recruitment-header-title-container container">
                <div class="appear-after-reveal">
                    <div class="recruitment-header-emojis"></div>
                    <h1 class="recruitment-header-title">
                        <strong>{{recruitment.position}}</strong>, {{recruitment.phrase}}
                    </h1>
                </div>
                <div class="appear-after-reveal appear-after-reveal-delay">
                    <button class="recruitment-header-apply-button">
                        <router-link :to="{name: 'apply', params: { phrases: ['Are you ready to make a difference?']}}">Apply Now</router-link>
                    </button>
                </div>
            </div>

            <div class="recruitment-header-button-container container">
                <scroll-button to="#recruitment-info" text="Read more"></scroll-button>
            </div>
        </themed-section>

        <!-- Offer Information -->
        <section id="recruitment-info" class="recruitment-info">
            <div class="container">
                <div class="grid">
                    <div class="section-content">
                        <h3>{{recruitment.subtitle}}</h3>
                        <div class="recruitment-abstract" v-html="recruitment.abstract"></div>
                    </div>
                    <div class="section-title">
                        <h2>About the job.</h2>
                        <h3 class="recruitment-salary">{{recruitment.salary}}</h3>

                        <div v-for="(detail, index) in recruitment.details" class="recruitment-details">
                            <div class="recruitment-detail">
                                <span class="recruitment-detail-topic">{{index}}</span>
                                <span class="recruitment-detail-description">{{detail}}</span>
                            </div>
                        </div>

                        <div class="recruitment-apply-now-container">
                            <button class="recruitment-apply-now-button">
                                <router-link :to="{name: 'apply', params: { phrases: ['Are you ready to make a difference?']}}">Apply Now</router-link>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Join MANIAK! -->
        <themed-section :parallax="true" :image="recruitment.bgImage" class="image-full recruitment-image-full">
            <div class="recruitment-quote">
                <div class="container">
                    <div class="recruitment-quote-statement">
                        <p>What are you waiting for?</p>
                        <p>Be a MANIAK!</p>
                        <p>🖖</p>
                    </div>
                </div>
            </div>
        </themed-section>

        <!-- What we are looking for -->
        <section id="recruitment-requirements" class="recruitment-requirements">
            <div class="container">
                <div class="grid recruitment-requirement" v-for="(requirement, topic) in recruitment.requirements">
                    <div class="section-title">
                        <h2 class="recruitment-requirement-topic">{{topic}}</h2>
                    </div>
                    <div class="grid section-content">
                        <div
                            v-for="(detail, index) in requirement.items"
                            :class="{'recruitment-requirement-detail-2-col': requirement.columns === 2,'recruitment-requirement-detail-1-col': requirement.columns === 1}"
                        >
                            <p class="recruitment-requirement-detail-description">{{detail}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- MANIAK Perks -->
        <section id="recruitment-perks" class="recruitment-perks">
            <div class="container">
                <div class="grid">
                    <div v-for="perk in recruitment.perks" class="recruitment-perk">
                        <p>{{perk.icon}}</p>
                        <p>{{perk.description}}</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Are you ready? -->
        <!-- :image="recruitment.bgImage" class="image-full recruitment-image-full" -->
        <themed-section :parallax="false" :image="null" :style="{marginBottom: 0, color: '#000'}" :color="'#eff0f5'">
            <div class="recruitment-quote recruitment-message">
                <div class="container">
                    <div class="recruitment-quote-statement">
                        <p>😎</p>
                        <p>Are you ready to make a difference?</p>
                        <p>
                            We don't discriminate by race, color, gender, weight, height or anything else.
                            Maniak is committed to a culture that embraces diversity and inclusion.
                        </p>

                        <div class="recruitment-apply-now-container">
                            <button class="recruitment-apply-now-button">
                                <router-link :to="{name: 'apply', params: { phrases: ['Are you ready to make a difference?']}}">Apply Now</router-link>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </themed-section>
    </div>
</template>

<script>
    import apiManiak from '../utils/api.js'
    import ThemedSection from '../components/ThemedSection'
    import pageCommon from '../components/PageCommon'
    import ScrollButton from '../components/ScrollButton'
    import Parallax from '../components/Parallax.vue'

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
            Parallax,
        },

        data() {
            return {
                recruitment: null,
            }
        },

        mounted() {
            this.fetchData()
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
                this.recruitment = response.data
                this.setNavTheme(Boolean(this.recruitment.is_dark))
                this.$emit('view-loaded')
            },
        },
    }
</script>

<style scoped>
    .overlay {
        position: absolute;
        top: 100px;
        right: 45px;
        font-size: 60px;
        color: #fff;
        text-decoration: none;
    }
</style>
