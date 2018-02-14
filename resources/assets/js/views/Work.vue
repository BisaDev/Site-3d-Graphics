<template>
  <div class="work">
    <section class="work-header no-margin">
      <div class="container">
        <h1>
          <b>Maniak builds cool stuff.</b><br>Lorem ipsum dolor sit.
        </h1>
        <ul class="work-header-filters">
          <li class="active"><a href="">All<span class="filter-count">12</span></a></li>
          <li><a href="">Design<span class="filter-count">12</span></a></li>
          <li><a href="">Software<span class="filter-count">12</span></a></li>
          <li><a href="">3D &amp; VR<span class="filter-count">12</span></a></li>
        </ul>
      </div>
    </section>
    <section class="work-portfolio">
      <div class="container">
        <div class="grid">
          <a href class="preview reveal featured" :style="{backgroundColor: '#e7e9f0', backgroundImage: 'url(../../img/featured/plateiq.png)'}">
            <div class="preview-title">
              <h5>Plate IQ</h5>
              <h6>Restaurant Management</h6>
              <div class="preview-title-cta">
                <p>Read more.</p>
              </div>
            </div>
          </a>
          <a href class="preview reveal featured" :style="{backgroundColor: '#e7e9f0', backgroundImage: 'url(../../img/featured/volkswagen.png)'}">
            <div class="preview-title">
              <h5>Volkswagen 4DX</h5>
              <h6>VR Driving Simulator</h6>
              <div class="preview-title-cta">
                <p>Read more.</p>
              </div>
            </div>
          </a>
          <a href class="preview reveal featured" :style="{backgroundColor: '#e7e9f0', backgroundImage: 'url(../../img/featured/wolverine.png)'}">
            <div class="preview-title">
              <h5>Wolverine</h5>
              <h6>Online Configurator</h6>
              <div class="preview-title-cta">
                <p>Read more.</p>
              </div>
            </div>
          </a>
          <a href class="preview reveal" :style="{backgroundColor: '#e7e9f0', backgroundImage: 'url(../../img/featured/wolverine.png)'}">
            <div class="preview-title">
              <h5>Wolverine</h5>
              <h6>Online Configurator</h6>
              <div class="preview-title-cta">
                <p>Read more.</p>
              </div>
            </div>
          </a>
          <a href class="preview reveal" :style="{backgroundColor: '#e7e9f0', backgroundImage: 'url(../../img/featured/wolverine.png)'}">
            <div class="preview-title">
              <h5>Wolverine</h5>
              <h6>Online Configurator</h6>
              <div class="preview-title-cta">
                <p>Read more.</p>
              </div>
            </div>
          </a>
          <a href class="preview reveal" :style="{backgroundColor: '#e7e9f0', backgroundImage: 'url(../../img/featured/wolverine.png)'}">
            <div class="preview-title">
              <h5>Wolverine</h5>
              <h6>Online Configurator</h6>
              <div class="preview-title-cta">
                <p>Read more.</p>
              </div>
            </div>
          </a>
          <a href class="preview reveal" :style="{backgroundColor: '#e7e9f0', backgroundImage: 'url(../../img/featured/wolverine.png)'}">
            <div class="preview-title">
              <h5>Wolverine</h5>
              <h6>Online Configurator</h6>
              <div class="preview-title-cta">
                <p>Read more.</p>
              </div>
            </div>
          </a>

        </div>
      </div>
    </section>
  </div>
</template>


<script>
import apiManiak from '../utils/api'
import homeHeader from '../components/home/Header'
import homeInfo from '../components/home/Info'
import PageCommon from '../components/PageCommon.vue'

export default {
  extends: { ...PageCommon },

  mounted() {
    this.updateData()
  },

  methods: {
    updateData() {
      this.$root.$refs.revealer.close()
    },
  },
}
</script>
