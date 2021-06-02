<template> 
    <div>
      <user-post v-for='post in posts' v-bind:key='post.id' v-bind:post="post"></user-post>
    </div>
</template>

<script>
import Post from "./Post.vue";

export default {
    computed: {
        posts: {
            get() {
                return this.$store.state.userPosts.posts.inactive;
            }
        }
    },
    beforeMount() {
        this.$store.dispatch("userPosts/getPosts", 2);
    },
    components: {
        "user-post": Post
    }
};
</script>

<style></style>
