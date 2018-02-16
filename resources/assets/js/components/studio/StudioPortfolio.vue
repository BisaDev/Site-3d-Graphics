<template>

  <section class="studio-portfolio dark padding text-center" ref="section">
    <div class="container">
      <h4>We use the power of design and<br>technology to create and start change.</h4>
    </div>
    <div class="studio-portfolio-visual">
      <div class="studio-portfolio-blob" ref="blobs">
        <span></span>
        <span></span>
        <span></span>
      </div>
      <div class="studio-portfolio-circles" ref="circles">
        <span><label>Software</label></span>
        <span><label>Design</label></span>
        <span><label>3D &amp; VR</label></span>
      </div>
      <div class="studio-portfolio-circles-bg">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>
    <svg xmlns="http://www.w3.org/2000/svg" version="1.1" class="blob-svg">
      <defs>
        <filter id="goo">
          <feGaussianBlur in="SourceGraphic" stdDeviation="15" result="blur" />
          <feColorMatrix in="blur" mode="matrix" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 19 -9" result="goo" />
          <feComposite in="SourceGraphic" in2="goo" operator="atop"/>
        </filter>
      </defs>
    </svg>

  </section>

</template>

<script>
export default {
  methods: {
    calcOffset(mouseX, position, factor) {
      const deltaPercent = mouseX / window.innerWidth - position / window.innerWidth
      const offset = 0
      if (deltaPercent > 0) {
        return deltaPercent * deltaPercent * factor
      } else {
        return deltaPercent * deltaPercent * -factor
      }
    },
    handleMouseMove(event) {
      if (!this.ticking) {
        requestAnimationFrame(this.moveBlob(event))
      }
      this.ticking = true
    },
    moveBlob(event) {
      this.ticking = false
      this.blobs.forEach(el => {
        let centerX = el.getBoundingClientRect().left + el.offsetWidth / 2
        el.style.transform = 'translateX(' + this.calcOffset(event.pageX, centerX, 400) + 'px)'
      })
      this.circles.forEach(el => {
        let centerX = el.getBoundingClientRect().left + el.offsetWidth / 2
        el.style.transform = 'translateX(' + this.calcOffset(event.pageX, centerX, 200) + 'px)'
      })
    },
  },
  mounted() {
   // this.blobs = this.$refs.blobs.querySelectorAll('span')
   // this.circles = this.$refs.circles.querySelectorAll('span')
  //  this.$refs.section.addEventListener('mousemove', e => this.handleMouseMove(e))
  },
  created() {
    //this.$refs.section.addEventListener('click', () => this.handleMouseMove())
  },
  destroyed() {
  //  this.$refs.section.removeEventListener('mousemove', () => this.handleMouseMove(e))
  },
}
</script>
