<template>
    <footer>
      <div class="footer-top">
        <div class="container">
          <div class="grid">
          <div class="footer-contact">
            <router-link class="footer-logo" to="/">
              <logo></logo>
            </router-link>
            <h4 class="footer-contact-copy">
              If you’d like to partner on a project or simply chat about what we could do together, just say <a class="contact-email" href="mailto: hello@maniak.co">hello@maniak.co</a>.
            </h4>
          </div>
          <ul class="footer-links">
            <li><router-link to="/">Home</router-link></li>
            <li><router-link to="/work">Work</router-link></li>
            <li><router-link to="/studio">Studio</router-link></li>
            <li><router-link to="/contact">Contact</router-link></li>
            <li><router-link to="/news">News</router-link></li>
          </ul>
          <ul class="footer-links">
            <li><a href="https://www.facebook.com/themaniaks/" target="_blank" rel="noopener noreferrer">Facebook</a></li>
            <li><a href="https://www.instagram.com/themaniaks/" target="_blank" rel="noopener noreferrer">Instagram</a></li>
            <li><a href="https://www.linkedin.com/company/maniak" target="_blank" rel="noopener noreferrer">LinkedIn</a></li>
            <li><a href="https://twitter.com/maniakbtl" target="_blank" rel="noopener noreferrer">Twitter</a></li>
          </ul>
          </div>
        </div>
      </div>
      <div class="footer-bottom">
        <div class="container footer-bottom-container">
            <a href="https://www.mnk.rocks" rel="noopener noreferrer" class="footer-mnk-logo">
              <img src="/img/logos/mnk/logo-mnk-black.svg" alt="mnk">
            </a>
            <p class="footer-mnk-description">We are part of the mnk studio collective. <a href="https://www.mnk.rocks" rel="noopener noreferrer">Learn more</a></p>
        </div>
      </div>
    </footer>
</template>
<script>
import Logo from './Logo'

export default {
    components: {
        Logo,
    },
}
</script>
