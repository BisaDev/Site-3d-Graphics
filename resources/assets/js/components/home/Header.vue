<template>
  <section class="align-center home-header no-padding fullscreen">

      <div class="blob-visual">
          <div class="blob-wrapper blob-left">
              <div class="blob-rotate">
                  <div class="blob">
                      <div></div>
                      <div></div>
                      <div></div>
                      <div></div>
                      <div></div>
                      <div></div>
                      <div></div>
                      <div></div>
                      <div></div>
                      <div></div>
                  </div>
              </div>
          </div>
          <div class="blob-wrapper blob-right">
              <div class="blob-rotate">
                  <div class="blob">
                      <div></div>
                      <div></div>
                      <div></div>
                      <div></div>
                      <div></div>
                      <div></div>
                      <div></div>
                      <div></div>
                      <div></div>
                      <div></div>
                  </div>
              </div>
          </div>
      </div>
      <svg xmlns="http://www.w3.org/2000/svg" version="1.1" class="blob-svg">
          <defs>
              <filter id="goo">
                  <feGaussianBlur in="SourceGraphic" stdDeviation="10" result="blur" />
                  <feColorMatrix in="blur" mode="matrix" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 19 -9" result="goo" />
                  <feComposite in="SourceGraphic" in2="goo" operator="atop"/>
              </filter>
          </defs>
      </svg>


      <div class="container">
          <h2 class="text-center">
            <b>Let us blow your mind.</b>
          </h2>
          <h2 class="text-center">Lorem ipsum dolor sit amet.</h2>
          <button class="button button-scroll">
            <span>Scroll down</span><span>Scroll down</span>
          </button>
      </div>
  </section>
</template>

<script>
export default {};
</script>
