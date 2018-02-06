<template>
  <section class="home-header no-padding fullscreen no-margin">
    <div class="home-header-background"></div>
    <div class="home-header-visual">
    <svg xmlns="http://www.w3.org/2000/svg" version="1.1">
      <defs>
        <filter id="goo">
          <feGaussianBlur in="SourceGraphic" stdDeviation="12" result="blur" />
          <feColorMatrix in="blur" mode="matrix" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 19 -9" result="goo" />
          <feComposite in="SourceGraphic" in2="goo" operator="atop"/>
        </filter>
      </defs>
      <g class="blob" filter="url(#goo)">
        <circle cx="50%" cy="50%" r="19%" fill="#1581F9" />
        <circle cx="55%" cy="55%" r="22%" fill="#1581F9" />
        <circle cx="52%" cy="42%" r="21%" fill="#1581F9" />
      </g>
      <g class="blob" filter="url(#goo)">
        <circle cx="53%" cy="52%" r="20%" fill="#586170" />
        <circle cx="53%" cy="56%" r="20%" fill="#586170" />
        <circle cx="56%" cy="43%" r="19%" fill="#586170" />
      </g>
      <g class="blob" filter="url(#goo)">
        <circle cx="55%" cy="49%" r="20%" fill="#D2003E" />
        <circle cx="50%" cy="54%" r="18%" fill="#D2003E" />
        <circle cx="46%" cy="41%" r="22%" fill="#D2003E" />
      </g>
    </g>
    </svg>
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
export default {}
</script>
