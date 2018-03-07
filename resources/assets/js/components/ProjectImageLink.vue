<template>
    <router-link :to="`/project/${project.id}`" class="preview reveal" :class="{featured: project.is_featured}"
       :style="{backgroundColor: project.color, backgroundImage: `url(${project.hero_image})`}">
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