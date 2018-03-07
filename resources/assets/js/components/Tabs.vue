<template>
    <div>
        <div :class="tabsContainerClasses">
            <ul :class="tabsListClasses">
                <li v-for="(tab, key) in tabs"  :key="key" :class="{ 'active': tab.isActive }">
                    <a :href="tab.href" @click="selectTab(tab)" v-html="tab.header"></a>
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
            return { tabs: [] };
        },

        created() {
            this.tabs = this.$children;
        },

        methods: {
            selectTab(selectedTab) {
                this.tabs.forEach(tab => {
                    tab.isActive = (tab.href == selectedTab.href);
                });
            }
        }
    }
</script>