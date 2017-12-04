<template>
  <div>

    <headerhome></headerhome>
    <infomaniak></infomaniak>

    <section id="featured" class="section-dark">
      <div class="container">
        <div class="row row-align-bottom margin-bottom--60">
          <h4 class="col-3">Some of the projects we are most proud of.</h4>
          <div class="col-9 text-right">
            <button class="btn">See all</button>
          </div>
        </div>
        <div class="row">
          <div class="col-4 col-no-padding">
          <a @click="showProject()" class="featured featured-plateiq reveal" data-color="#FCFCFD" data-text="The first driving simulator of its kind.">
              <div class="featured-title">
                <h5>Plate IQ</h5>
                <h6>Restaurant Management</h6>
                <div class="featured-title-description">
                  <p>Read more.</p>
                </div>
              </div>
            </a>
          </div>
          <div class="col-4 col-no-padding">
            <a href="" class="featured featured-volkswagen text-dark reveal" data-color="#FCFCFD" data-text="The first driving simulator of its kind.">
              <div class="featured-title">
                <h5>Volkswagen 4DX</h5>
                <h6>VR Driving Simulator</h6>
                <div class="featured-title-description">
                  <p>Read more.</p>
                </div>
              </div>
            </a>
          </div>
          <div class="col-4 col-no-padding">
            <a href="" class="featured featured-wolverine reveal" data-color="#FCFCFD" data-text="The first driving simulator of its kind.">
              <div class="featured-title">
                <h5>Wolverine</h5>
                <h6>Mobile Configurator</h6>
                <div class="featured-title-description">
                  <p>Read more.</p>
                </div>
              </div>
            </a>
          </div>
        </div>
      </div>
    </section>

    <footerhome></footerhome>

</div>
</template>
<script>

import headerhome from '../components/Header';
import infomaniak from '../components/Info';
import footerhome from '../components/Footer';

export default {

        components:{
          headerhome,
          infomaniak,
          footerhome
        },
          methods:{
            showProject(project){
              const overlay = new Revealer();
              overlay.reveal('example');
              this.$router.push('/project');

            }
          }

}

</script>
