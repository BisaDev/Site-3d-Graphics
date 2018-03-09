<script>
    export default {
        beforeRouteLeave(to, from, next) {
            this.onRouteLeave(to, from, next)
        },
        beforeRouteUpdate(to, from, next) {
            this.onRouteLeave(to, from, next)
        },
        methods: {
            setNavTheme(isDarkTheme) {
                this.$emit('set-nav-theme', isDarkTheme)
            },
            onRouteLeave(to, from, next) {
                this.$emit('view-leave', next, to.params.phrases || [])
            },
        },
    }
</script>
