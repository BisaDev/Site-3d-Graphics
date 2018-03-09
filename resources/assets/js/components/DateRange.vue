<template>
    <p>{{ dateRange }}</p>
</template>

<script>
    export default {
        props: {
            from: {
                type: String,
                required: true,
            },
            to: {
                type: String,
                required: true,
            },
        },
        data() {
            const fromDate = (new Date(this.from)).getFullYear();
            const toDate = (new Date(this.to)).getFullYear();
            return {
                dateRange: fromDate !== toDate ? `${fromDate} – ${toDate}` : `${fromDate}`
            }
        },
    }
</script>