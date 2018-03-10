<template>
    <router-link :to="{name: 'project', params: { slug: project.slug, phrases: [project.preloader]}}" class="preview reveal" :class="{featured: project.is_featured}"
       :style="{backgroundColor: project.color || 'transparent', backgroundImage: `url(${project.hero_image})`}">
        <div class="preview-title">
            <h5>{{ project.name }}</h5>
            <h6>{{ project.name }}</h6>
            <div class="preview-title-cta">
                <p>Read more.</p>
            </div>
        </div>
    </router-link>
</template>

<script>
    export default {
        props: {
            project: {
                type: object,
                required: true
            }
        }
    }
</script>

<style scoped>

</style>