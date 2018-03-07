<template>
    <div class="container">
        <div class="grid">
            <div class="project-copy-text">
                <h4 v-html="title" v-if="title"></h4>
                <p v-html="body"></p>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            body: {
                type: String,
                required: true,
            },
            title: {
                type: String,
                default: '',
            },
        },
    }
</script>
