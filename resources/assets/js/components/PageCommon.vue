<script>
export default {
  beforeRouteLeave(to, from, next) {
    this.$emit('view-leave', next)
  },
  methods: {
    setNavTheme(isDarkTheme) {
      this.$emit('set-nav-theme', isDarkTheme)
    },
  },
}
</script>
