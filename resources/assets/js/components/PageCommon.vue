<script>
export default {
  beforeRouteLeave(to, from, next) {
    this.$root.$refs.revealer.reveal().then(() => next())
  },
  methods: {
    setNavTheme(isDarkTheme) {
      this.$root.$emit('setNavTheme', isDarkTheme)
    },
  },
}
</script>
