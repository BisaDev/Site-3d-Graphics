<script>
    import isEqual from 'lodash.isequal';
    export default {
        beforeRouteLeave(to, from, next) {
            this.onRouteLeave(to, from, next)
        },
        beforeRouteUpdate(to, from, next) {
            if (!isEqual(to.params, from.params) || to.path !== from.path) {
                this.onRouteLeave(to, from, next)
            } else {
                next()
            }
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
