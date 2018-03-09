<template>
  <div class="project" v-if="project !== null">
    <!-- Hero Information -->
    <themed-section :color="project.hero_color" :image="project.hero_image" :isDark="Boolean(project.is_dark)" :class="['project-header', 'align-center', 'no-padding']">
      <div class="project-header-title-container container">
        <div class="appear-after-reveal">
          <h1 class="project-header-title">{{project.name}}</h1>
        </div>
        <div class="appear-after-reveal appear-after-reveal-delay">
          <h1 class="project-header-subtitle">{{project.description}}.</h1>
        </div>
      </div>
      <div class="project-header-button-container container">
        <button class="button button-scroll"><span>Read more</span><span>Read more</span></button>
      </div>
    </themed-section>


    <!-- Main Information -->
    <themed-section>
      <div class="container">
        <div class="grid">
          <div class="project-intro-description">
            <h4>{{project.info_title}}</h4>
            <p>{{project.info_description}}</p>
          </div>
          <div class="project-intro-facts">
            <div class="grid">
              <div class="project-intro-facts-left">
                <h5>Client</h5>
                <p>{{project.client.name}}</p>
                <h5>Year</h5>
                <p>{{project.info_year}}</p>
                <h5>Country</h5>
                <p>
                  <icon icon-class="icon-country-US" />
                </p>
              </div>
              <div class="project-intro-facts-right">
                <h5>Services</h5>
                <ul>
                  <li v-for="service in project.services">
                    {{service.name}}
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- <div class="flex">
      <div class="flex-1">
      <strong>{{project.info_title}}</strong>
      <p>{{project.info_description}}</p>
    </div>
    <div class="flex-1">
    <p>Client</p>
    <p>{{project.client.name}}</p>

    <p>Year</p>
    <p>{{project.info_year}}</p>

    <p>Country</p>
    <p>{{project.info_country}}</p>
  </div>
  <div class="flex-1">
  <p>Services</p>
  <div v-for="service in project.services">
  <img :src="service.icon" alt="Icon">
  {{service.name}}
  </div>
  </div>
  </div>-->
    </themed-section>

    <!-- todo: remove all this code before release -->
    <!--<themed-section class="project-quote dark text-center" :parallax="true" image="url(/img/patterns/pattern.png)">-->
      <!--<div class="container">-->
        <!--<div class="project-quote-statement">-->
          <!--<h3>The smartest way to<br>automate your restaurant's<br>accounts payable.</h3>-->
        <!--</div>-->
        <!--<div class="project-quote-author">-->
          <!--<h5>John Doe</h5>-->
          <!--<h6>CEO at lorem ipsum</h6>-->
        <!--</div>-->
      <!--</div>-->
    <!--</themed-section>-->

    <!--<themed-section class="project-copy">-->
      <!--<div class="container">-->
        <!--<div class="grid">-->
          <!--<div class="project-copy-text">-->
            <!--<h4>Maniak teamed up with PlateIQ to help them scale their development team.</h4>-->
            <!--<p>Plate IQ is an innovative SAAS platform that empowers restaurants to have a birds eye view of everything that its going on with their business, from variations in cost of ingredients to-->
              <!--projections of how item price changes could affect their revenue.</p>-->
          <!--</div>-->
        <!--</div>-->
      <!--</div>-->
    <!--</themed-section>-->

    <!--<themed-section class="project-gallery">-->
      <!--<photo-swipe :images="[-->
      <!--'../../img/featured/plateiq.png',-->
      <!--'../../img/featured/plateiq.png',-->
      <!--'../../img/featured/plateiq.png',-->
      <!--'../../img/featured/plateiq.png',-->
      <!--'../../img/featured/plateiq.png',-->
      <!--]"></photo-swipe>-->
    <!--</themed-section>-->

    <!--<themed-section class="project-copy">-->
      <!--<div class="container">-->
        <!--<div class="grid">-->
          <!--<div class="project-copy-sticky">-->
            <!--<h4>Maniak teamed up with PlateIQ to help them scale their development team.</h4>-->
            <!--<p>Plate IQ is an innovative SAAS platform that empowers restaurants to have a birds eye view of everything that its going on with their business, from variations in cost of ingredients to-->
              <!--projections of how item price changes could affect their revenue.</p>-->
          <!--</div>-->
          <!--<div class="project-screenshot-long">-->
            <!--<img src="../../img/projectimages/screenshot-long.png" alt="Image description"/>-->
          <!--</div>-->
        <!--</div>-->
      <!--</div>-->
    <!--</themed-section>-->

    <!--<image-full></image-full>-->

    <!--<themed-section class="project-copy">-->
      <!--<div class="container">-->
        <!--<div class="grid">-->
          <!--<div class="project-copy-text">-->
            <!--<h4>Maniak teamed up with PlateIQ to help them scale their development team.</h4>-->
            <!--<p>Plate IQ is an innovative SAAS platform that empowers restaurants to have a birds eye view of everything that its going on with their business, from variations in cost of ingredients to-->
              <!--projections of how item price changes could affect their revenue.</p>-->
          <!--</div>-->
        <!--</div>-->
      <!--</div>-->
    <!--</themed-section>-->

    <!--<themed-section class="project-gallery">-->
      <!--<div class="container">-->
        <!--<div class="grid">-->
          <!--<a class="project-gallery-image" href="">-->
            <!--<img src="../../img/featured/plateiq.png" alt="Image description"/>-->
          <!--</a>-->
          <!--<a class="project-gallery-image" href="">-->
            <!--<img src="../../img/featured/plateiq.png" alt="Image description"/>-->
          <!--</a>-->
        <!--</div>-->
      <!--</div>-->
    <!--</themed-section>-->

    <!--
    Loop through project sections and inject the needed components.
    Don't forget to define your components on the Vue instance, see below.
    -->
    <themed-section v-for="section in project.sections" :key="section.id"
                    :color="section.color || 'transparent'"
                    :is-dark="!!section.is_dark"
                    :parallax="!!section.is_parallax"
                    :image="section.background_image"
    >
      <component :is="section.component" v-bind="section.model"/>
    </themed-section>
    <!-- NEXT PROJECT -->
    <themed-section class="project-next no-padding no-margin text-center"
                    :is-dark="Boolean(nextProject.is_dark)"
                    :image="nextProject.hero_image"
                    :color="nextProject.hero_color || 'transparent'"
                    v-if="nextProject">
      <router-link :to="{name: 'project', params: { id: nextProject.id,  phrases: [nextProject.preloader] }}" class="project-next-link">
        <div class="container project-next-cta">
          <h3 class="no-margin">Next.</h3>
        </div>
        <div class="container project-next-subtitle">
          <h4 class="no-margin">{{ nextProject.preloader }}</h4>
        </div>
      </router-link>
    </themed-section>
  </div>
</template>

<script>
import apiManiak from '../utils/api.js'
import ProjectStickySection from '../components/project/ProjectSticky'
import ProjectTextInformation from '../components/project/ProjectTextInformation'
import ProjectGallery from '../components/project/ProjectGallery'
import ThemedSection from '../components/ThemedSection'
import Icon from '../components/Icon'
import pageCommon from '../components/PageCommon'

export default {
    extends: { ...pageCommon },

    props: {
        id: {
            required: true,
        },

        reveal: {
            default: false,
            type: Boolean,
        },
    },

    components: {
        ProjectGallery,
        ProjectTextInformation,
        ProjectStickySection,
        ThemedSection,
        Icon,
    },

    data() {
        return {
            project: null,
            nextProject: null,
        }
    },

    mounted() {
        this.fetchData()
    },

    methods: {
        fetchData() {
            apiManiak
                .getProject(this.$props.id)
                .then(this.updateProject)
                .catch(() => {
                    this.$emit('not-found')
                })
            apiManiak
                .getProjectNext(this.$props.id)
                .then(this.updateNextProject)
                .catch(() => {
                    this.$emit('not-found')
                })
        },
        updateProject(response) {
            this.project = response.data
            this.setNavTheme(Boolean(this.project.is_dark))
            this.$emit('view-loaded')
        },
        updateNextProject(response) {
            // @TODO: change this once the API return a single object instead of a n object with a single object prop
            this.nextProject = Object.values(response.data)[0]
        },

    },

    watch: {
        id:  'fetchData'
    }
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
