<template>
  <div>

    <headerhome></headerhome>
    <infomaniak></infomaniak>

    <section id="featured" class="section-dark component">
  <div class="container">
    <div class="row">
      <div class="col-4 col-no-padding" v-for="project in projects">
        <a
        @click="showProject(project)"
        class="featured featured-wolverine reveal"
        data-color="#FCFCFD">
        <div class="featured-title">
          <h5>{{project.name}}</h5>
          <h6>{{project.description}}</h6>
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

import ApiManiak from '../utils/api.js';

export default {

        components:{
          headerhome,
          infomaniak,
          footerhome
        },
        data(){
          return{
            projects:[]
          }
        },
          methods:{
            showProject(project){
              const overlay = new Revealer();
              overlay.reveal('example');
              this.$router.push('/project');

            },
            updateData(response){
              this.projects=response.data;
            }
          },
            mounted(){
              let maniak=new ApiManiak;
              maniak.getProjects().then(response => this.updateData(response));
            }

}

</script>
