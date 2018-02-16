<template>
    <div calss="tabs">
        <div class="container work-header-filters-container">
            <ul class="work-header-filters-list">
                <li><a class="active" href="">All<span class="filter-count">12</span></a></li>
            </ul>
        </div>
        <section class="work-portfolio">
            <div class="container">
                <div class="grid">
                    <router-link v-for="project in projects" :to="" class="preview reveal"
                       :style="{backgroundColor: '#e7e9f0', backgroundImage: 'project.'}">
                        <div class="preview-title">
                            <h5>Wolverine</h5>
                            <h6>Online Configurator</h6>
                            <div class="preview-title-cta">
                                <p>Read more.</p>
                            </div>
                        </div>
                    </router-link>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
    export default {
        props: {
            content: {
                type: Object,
                required: true,
            }
        },
        data() {
          return {
              tabs: Object.keys(this.content),
              projects: Object.values(this.content),
          }
        },
    }
</script>

<style scoped>

</style>