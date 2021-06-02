<template>
    <div>
        <ul class="side-menu">
            <li
                v-for="tab in tabs"
                v-bind:key="tab"
                v-bind:class="{ active: currentTab === tab }"
                v-on:click="currentTab = tab"
            >
                {{ tab }}
            </li>
        </ul>
        <div class="current-section">
            <component
                v-bind:is="currentTabComponent"
                v-bind:kind="currentKind"
            ></component>
        </div>
    </div>
</template>

<script>
import UserInactive from './UserInactive.vue';
import AddPost from "./AddPost";
import UserDraf from "./UserDraf.vue";
import UserPub from './UserPub.vue';

export default {
    data() {
        return {
            currentTab: "New Post",
            tabs: ["New Post", "Published", "Drafts", "Inactive"],
            currentKind: null
        };
    },
    computed: {
        currentTabComponent: function() {
            return "tab-" + this.currentTab.replace(/\s+/g, "-").toLowerCase();
        }
    },
    components: {
        "tab-new-post": AddPost,
        "tab-published": UserPub,
        "tab-drafts": UserDraf,
        "tab-inactive": UserInactive
    }
};
</script>
