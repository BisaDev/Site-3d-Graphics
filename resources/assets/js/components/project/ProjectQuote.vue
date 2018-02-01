<template>
  <parallax :speed="-4" class="project-quote dark text-center">
  <div class="container">
      <div class="project-quote-statement">
        <h3>The smartest way to<br>automate your restaurant's<br>accounts payable.</h3>
      </div>
      <div class="project-quote-author">
        <h5>John Doe</h5>
        <h6>CEO at lorem ipsum</h6>
      </div>
  </div>
</parallax>
</template>
<script>
import parallax from '../parallax'

export default {
  components: {
    parallax,
  },
}
</script>
