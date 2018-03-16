<template>
    <div>
        <div :class="tabsContainerClasses">
            <ul :class="tabsListClasses">
                <li v-for="(tab, key) in tabs" :key="key" :class="{ 'active': tab.isActive }">
                    <a :href="tab.hash" @click="selectTab(tab.hash)" v-html="tab.header"></a>
                </li>
            </ul>
        </div>
        <div class="tabs-details">
            <slot></slot>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            tabsListClasses: {
                default: () => ['tabs-list'],
            },
            tabsContainerClasses: {
                default: () => ['tabs'],
            },
            tabsContentClasses: {
                default: () => ['tabs-details'],
            },
        },
        data() {
            return {
                tabs: [],
                activeTabHash: '',
            }
        },

        mounted() {
            this.tabs = this.$children
            this.$on('tab-mounted', this.selectIninitialTab)
        },

        methods: {
            findTab(hash) {
                return this.tabs.find(tab => tab.hash === hash)
            },

            selectTab(selectedTabHash) {
                const selectedTab = this.findTab(selectedTabHash)

                if (!selectedTab) {
                    return
                }

                this.tabs.forEach(tab => {
                    tab.isActive = false
                })

                setTimeout(() => this.tabs.forEach(tab => {
                    tab.isActive = (tab.hash === selectedTab.hash)
                }), 400)

                this.activeTabHash = selectedTab.hash
            },

            selectIninitialTab() {
                if (this.findTab(window.location.hash)) {
                    this.selectTab(window.location.hash)
                    return
                }

                if (this.tabs.length) {
                    this.selectTab(this.tabs[0].hash)
                }
            }
        }
    }
</script>