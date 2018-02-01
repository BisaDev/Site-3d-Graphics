<template>
  <div id="project" v-if="project !== null">
    <!-- Hero Information -->
    <section class="project-header dark align-center no-padding">
      <!-- <div id="myNav" class="overlay">
      <a href="#" class="closebtn" @click.prevent="close">&times;</a>
    </div>-->
    <div class="container">
        <h1 class="project-header-title">{{project.name}}</h1>
        <h1 class="project-header-subtitle">{{project.description}}.</h1>
        <button class="button button-scroll"><span>Read more</span><span>Read more</span></button>
    </div>
  </section>

  <!-- Main Information -->
  <section>
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
            <p>{{project.info_country}}</p>
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
</section>

<project-quote></project-quote>

<section class="project-copy">
  <div class="container">
    <div class="grid">
      <div class="project-copy-text">
        <h4>Maniak teamed up with PlateIQ to help them scale their development team.</h4>
        <p>Plate IQ is an innovative SAAS platform that empowers restaurants to have a birds eye view of everything that its going on with their business, from variations in cost of ingredients to projections of how item price changes could affect their revenue.</p>
      </div>
    </div>
  </div>
</section>
<section class="project-gallery no-padding">
  <div class="container">
    <div class="grid">
      <a class="project-gallery-image" href="">
        <img src="../../img/featured/plateiq.png" alt="Image description" />
      </a>
      <a class="project-gallery-image" href="">
        <img src="../../img/featured/plateiq.png" alt="Image description" />
      </a>
      <a class="project-gallery-image" href="">
        <img src="../../img/featured/plateiq.png" alt="Image description" />
      </a>
      <a class="project-gallery-image" href="">
        <img src="../../img/featured/plateiq.png" alt="Image description" />
      </a>
    </div>
  </div>
</section>
<section class="project-copy">
  <div class="container">
    <div class="grid">
      <div class="project-copy-sticky">
        <h4>Maniak teamed up with PlateIQ to help them scale their development team.</h4>
        <p>Plate IQ is an innovative SAAS platform that empowers restaurants to have a birds eye view of everything that its going on with their business, from variations in cost of ingredients to projections of how item price changes could affect their revenue.</p>
      </div>
      <div class="project-screenshot-long">
        <img src="../../img/projectimages/screenshot-long.png" alt="Image description" />
      </div>
    </div>
  </div>
</section>

<project-image-full></project-image-full>

<section class="project-copy">
  <div class="container">
    <div class="grid">
      <div class="project-copy-text">
        <h4>Maniak teamed up with PlateIQ to help them scale their development team.</h4>
        <p>Plate IQ is an innovative SAAS platform that empowers restaurants to have a birds eye view of everything that its going on with their business, from variations in cost of ingredients to projections of how item price changes could affect their revenue.</p>
      </div>
    </div>
  </div>
</section>

<section class="project-gallery no-padding">
  <div class="container">
    <div class="grid">
      <a class="project-gallery-image" href="">
        <img src="../../img/featured/plateiq.png" alt="Image description" />
      </a>
      <a class="project-gallery-image" href="">
        <img src="../../img/featured/plateiq.png" alt="Image description" />
      </a>
    </div>
  </div>
</section>

<section class="project-next no-padding dark text-center">
  <div class="container project-next-cta">
    <h3 class="no-margin">Next.</h3>
  </div>
  <div class="container project-next-subtitle">
    <h4 class="no-margin">The power of design and technology<br>to create and start change</h4>
  </div>
</section>
<!--
Loop through project sections and inject the needed components.
Don't forget to define your components on the Vue instance, see below.
-->
<component v-for="section in project.sections"
:key="section.id"
:is="section.component"
:model="section.model"/>
</div>
</template>

<script>
import apiManiak from '../utils/api.js';
import PhotoSwipe from 'photoswipe';
import PhotoSwipeUI_Default from 'photoswipe';
import ProjectQuote from '../components/project/ProjectQuote';
import ProjectImageFull from '../components/project/ProjectImageFull';

export default {
  beforeRouteLeave(to, from, next) {
    this.$root.$refs.revealer.reveal().then(() => next())
  },

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
      ProjectQuote,
      ProjectImageFull
  },

  data() {
    return {
      project: null,
    }
  },

  mounted() {
    apiManiak.getProject(this.$props.id).then(this.updateData)
  },

  methods: {
    updateData(response) {
      this.project = response.data
      const revealer = this.$root.$refs.revealer
      revealer.close()
    },

    close() {
      const revealer = this.$root.$refs.revealer
      revealer.reveal(this.project.preloader).then(() => {
        this.$router.push({
          name: 'home',
          params: {
            reveal: true,
          },
        })
      })
    },
  },
}
</script>

<style scoped>
.overlay .closebtn {
  position: absolute;
  top: 100px;
  right: 45px;
  font-size: 60px;
  color: #fff;
  text-decoration: none;
}
</style>
