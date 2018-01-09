<template>
    <div class="bg-white text-black p-8">
        <h2>{{model.title}}</h2>
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