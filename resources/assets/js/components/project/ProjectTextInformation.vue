<template>
    <div class="bg-white text-black p-8">
        <strong>{{model.title}}</strong>
        <p>{{model.body}}</p>
    </div>
</template>

<script>
    export default {
        props: {
            model: {
                type: Object,
                required: true,
            }
        },
    }
</script>