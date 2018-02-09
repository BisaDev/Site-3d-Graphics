<template>
  <section class="home-header no-padding fullscreen no-margin" ref="section">
    <div class="home-header-background"></div>
    <div class="home-header-explosion" ref="explosion"></div>
    <div class="home-header-visual" ref="visual">
      <div class="home-header-visual-svg-wrap">
        <svg xmlns="http://www.w3.org/2000/svg" version="1.1">
          <defs>
            <filter id="goo">
              <feGaussianBlur in="SourceGraphic" stdDeviation="9" result="blur" />
              <feColorMatrix in="blur" mode="matrix" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 19 -9" result="goo" />
              <feComposite in="SourceGraphic" in2="goo" operator="atop"/>
            </filter>
          </defs>
          <g class="blob" filter="url(#goo)">
            <circle cx="47%" cy="52%" r="80" fill="#1581F9" />
            <circle cx="55%" cy="49%" r="80" fill="#1581F9" />
            <circle cx="47%" cy="52%" r="80" fill="#D2003E" />
            <circle cx="55%" cy="49%" r="80" fill="#D2003E" />
            <circle cx="47%" cy="52%" r="80" fill="#D2003E" />
          </g>
        </g>
      </svg>
    </div>
  </div>
  <div class="container text-center dark">
    <h1>
      Let us blow your mind.
    </h1>
    <button class="button button-scroll">
      <span>Scroll down</span><span>Scroll down</span>
    </button>
  </div>
</section>
</template>

<script>
export default {
  mounted() {
    const explosion = this.$refs.explosion
    const visual = this.$refs.visual
    const section = this.$refs.section

    visual.addEventListener('click', function() {
      visual.classList.add('hidden')
      explosion.classList.add('show')
      section.classList.toggle('dark')
      setTimeout(function() {
        visual.classList.remove('hidden')
        explosion.classList.remove('show')
      }, 2000)
    })
  },
}
</script>
