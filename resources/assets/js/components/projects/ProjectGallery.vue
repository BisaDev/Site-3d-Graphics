<template>
    <div class="bg-white text-black p-8">
        <img v-for="image in model.images" :key="image.id" :src="image.image" :alt="image.image">
    </div>
</template>

<script>
    export default {
        props: {
            model: {
                type: Object,
                required: true,
            },
        },
    };
</script>