<script>
export default {
  data() {
    return {
      ticking: false,
    }
  },
  created() {
    window.addEventListener('scroll', this.trackScroll)
  },

  destroyed() {
    this.removeScrollEvent()
  },
  methods: {
    trackScroll() {
      if (!this.ticking) {
        window.requestAnimationFrame(() => this.$emit('_scroll'))
      }
      this.ticking = true
    },
    removeScrollEvent() {
      window.removeEventListener('scroll', this.trackScroll)
    },
  },
}
</script>
