<template>
    <div v-if="areasLoaded && !error">
        <label>Services</label>
        <div class="grid-container">
            <div class="grid-x">
                <fieldset v-for="area in areas" class="medium-4 cell">
                    <legend>{{ area.name }}</legend>
                    <div v-for="service in area.services">
                        <input type="checkbox"
                               :name="`service-${service.name}`"
                               :id="`service-${service.name}`"
                               :value="service.id"
                               @change="checkboxesUpdated"
                               v-model="selectedServices"
                        />
                        <label :for="`service-${service.name}`">{{service.name}}</label>
                    </div>
                </fieldset>
            </div>
        </div>
    </div>
</template>

<script>
    import apiManiak from '../../utils/api'

    export default {
        props: {
            value: {
                type: Array,
            },
        },
        data() {
            return {
                areas: [],
                areasLoaded: false,
                error: false,
                selectedServices: [],
                services: [],
            }
        },
        mounted() {
            this.fetchAreas()
        },
        methods: {
            fetchAreas() {
                apiManiak.getAreas()
                    .then(this.updateAreas)
                    .catch(() => {
                        this.error = true
                    })
            },
            updateAreas(response) {
                this.areas = response.data
                this.services = response.data.reduce((services, area) => {
                    area.services.forEach(service => services.push(service))
                    return services
                }, [])
                this.areasLoaded = true
                this.error = false
            },
            checkboxesUpdated() {
              this.$emit('input', this.services.filter(service => this.selectedServices.includes(service.id)))
            },
        },
        watch: {
            value() {
                this.selectedServices = this.value.map(service => service.id)
            }
        },
    }
</script>

<style scoped>

</style>