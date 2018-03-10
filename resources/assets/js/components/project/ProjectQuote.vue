<template>
    <div class="project-quote">
        <div class="container">
                <div class="project-quote-statement">
                    <h3 v-html="body"></h3>
                </div>
                <div class="project-quote-author">
                    <h5 v-html="author"></h5>
                    <h6 v-html="title" v-if="title"></h6>
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
            author: {
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
