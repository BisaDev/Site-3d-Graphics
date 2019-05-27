<template>
  <div class="blog-post">
    <section class="blog-post-header">
      <div class="blog-post-header-title-container container container--small">
        <div class="appear-after-reveal">
          <h1 class="blog-post-header-title title--large">How to Grow a Maniak.<br>
          </h1>
        </div>
        <div class="appear-after-reveal appear-after-reveal-delay">
          <h1 class="blog-post-header-subtitle title--large">Our New Improvement Policy.</h1>
        </div>
      </div>
    </section>
    <section class="blog-post-featured-image">
      <div class="container container--small">
        <img class="blog-post-featured-image-img" src="/img/maniak-time/maniak-time-featured.png" alt="Cactus in a plant pot">
      </div>
    </section>
    <section class="blog-post-content">
      <div class="container container--small">
        <div class="grid">
          <div class="blog-post-content-callout">
            <div class="blog-post-content-callout-sticky">
              <h2 class="blog-post-content-callout-title">Becoming a Maniak is not easy, it takes time.</h2>
              <div class="blog-post-content-callout-schedule">
                <div class="blog-post-content-callout-schedule-column">
                  <div class="blog-post-content-callout-subtitle">Mon – Thu</div>
                  <div class="blog-post-content-callout-subtitle-small">9am – 6pm (CST)</div>
                </div>
                <div class="blog-post-content-callout-schedule-column">
                  <div class="blog-post-content-callout-subtitle">Fri</div>
                  <div class="blog-post-content-callout-subtitle-small">9am – 12pm (CST)</div>
                </div>
              </div>
            </div>
          </div>
          <div class="blog-post-content-main">
            <p>
              In an industry as competitive as the software and design industry  we need to constantly change the way we do things. The way in which we experiment with new methods, new technologies and have the willingness to invest in a path we deem will bring the best out of our work, will increase our client satisfaction and value of what we deliver as a Company.
            </p>
            <p>
              However, it’s also a reality that trying to find the time to improve as individuals and as a company, is, to say the least, a struggle. Not because of a lack of motivation and discipline but because we live for our work. We are passionate and relentless in our efforts to achieve our goals and we always want to do better. This attitude sometimes takes the best out of us.
            </p>
            <p>
              That is why we have decided to institute a new company policy called “Maniak Time” that will allow us to keep perfecting our craft with activities targeted to increase our value and improve as professionals. The rules of the game are simple: We need time and that time will be taken out of every Friday.  This means that our consulting hours will be Monday to Thursday from 9 AM to 6 PM, and Fridays from 9 AM to 12 PM.
            </p>
          </div>
        </div>
      </div>
    </section>

    <image-full class="blog-post-image-full"></image-full>

    <section class="blog-post-content">
      <div class="blog-post-content-section container container--small">
        <div class="grid">
          <div class="blog-post-content-callout">
            <h2 class="blog-post-content-callout-title">To our amazing clients.</h2>
          </div>
          <div class="blog-post-content-main">
            <p>
              We take this change very seriously and we firmly believe that the outcome will reap an immediate positive change in the way we do business, how we handle projects and in the quality of our work. It will force us to be more effective and punctual in all of our actions.
            </p>
          </div>
        </div>
      </div>

    </section>
    <section class="blog-post-instagram">
      <div class="container container--small">
        <div class="blog-post-instagram-title">
          <h1>See what we're up to</h1>
          <h1 class="text-dark-50">#meanwhileatmaniak</h1>
        </div>
        <div id="blog-post-instagram-feed" class="grid">
        </div>
        <div class="blog-post-instagram-button-container">
          <button v-on:click="loadMore" ref="buttonLoadMore" class="button button-scroll">
            <span v-for="twice in 2">Load more</span>
          </button>
        </div>
      </div>
    </section>
  </div>
</template>

<script>
import PageCommon from '../components/PageCommon.vue'
import ImageFull from '../components/ImageFull'
import Instafeed from 'instafeed.js'

import apiManiak from '../utils/api'

export default {
    extends: { ...PageCommon },

    components: {
        ImageFull,
    },

    data() {
        return {
            feed: {},
        }
    },

    mounted() {
        const $this = this
        this.updateData()
        this.feed = new Instafeed({
            get: 'user',
            userId: 600016336, // The number before the first period in your access token
            accessToken: '600016336.d1a3afe.2708556f92a94c7486474935232060ba', // This token expires after a while. Regenerate if it stops working. See https://www.instagram.com/developer/authentication/
            resolution: 'standard_resolution', // Alternatives are "low_resolution" and "thumbnail"
            useHttp: 'true',
            limit: 10,
            template: `<div class="blog-post-instagram-image">
                  <a href="{{link}}" target="_blank" class="blog-post-instagram-image-inner">
                    <img src="{{image}}">
                    <div class="blog-post-instagram-image-overlay">
                      <p>{{caption}}</p>
                      <div class="blog-post-instagram-image-overlay-subtitle">
                        <p class="text-white-50">{{likes}} Likes</p>
                      </div>
                    </div>
                  </a>
                </div>`,
            target: 'blog-post-instagram-feed',
            after: function() {
                console.log('test')
                // disable button if no more results to load
                if (!this.hasNext()) {
                    $this.$refs.buttonLoadMore.style.display = 'none'
                }
            },
        })
        this.feed.run()
    },

    methods: {
        updateData() {
            this.setNavTheme(false)
            this.$emit('view-loaded')
        },
        loadMore: function() {
            this.feed.next()
        },
    },
}
</script>
