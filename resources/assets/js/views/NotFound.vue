<template>
    <div class="not-found">
        <section class="align-center work-header no-margin no-padding fullscreen">
            <div class="container">
                <div class="grid">
                    <h1>
                        <b>Ooops we got nothing here!</b>
                    </h1>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
    import pageCommon from '../components/PageCommon'

    export default {
        extends: { ...pageCommon },

        mounted(){
            this.$emit('view-loaded')
        }
    }
</script>