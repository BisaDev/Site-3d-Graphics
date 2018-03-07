<template>
    <div class="notFound">
        <section class="notFound-header">
            <div class="container">
                   <h5>404</h5>
                    <p>Oops.</p>
            </div>
        </section>
    </div>
</template>

<script>
import pageCommon from '../components/PageCommon'

export default {
  extends: { ...pageCommon },

  mounted() {
    this.$emit('view-loaded')
  },
}
</script>
