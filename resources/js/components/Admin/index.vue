<template>
    <div class="container">
        <div class="tab-container">
            <span
                v-for="tab in tabs"
                v-bind:key="tab"
                v-bind:class="['tab-button', { active: currentTab === tab }]"
                v-on:click="currentTab = tab"
            >
                {{ tab }}
            </span>
        </div>
        <component v-bind:is="currentTabComponent" class="tab"></component>
    </div>
</template>

<script>
import Posts from "./Posts";

export default {
    data() {
        return {
            currentTab: "Posts",
            tabs: ["Posts"]
        };
    },
    computed: {
        currentTabComponent: function() {
            return "tab-" + this.currentTab.toLowerCase();
        }
    },
    components: {
        "tab-posts": Posts
    }
};
</script>
