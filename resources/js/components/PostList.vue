<template>
    <div class="container">
        <slot></slot>
        <div v-for="post in posts" v-bind:key="post.id" class="post">
            <div>
                <h1>{{ post.title }}</h1>
                <span>{{ post.created_at }}</span>
            </div>
            <span>Posted by: {{ post.author.name }}</span>
            <p>{{ post.content }}</p>
        </div>
        <div><v-button v-if="!noMorePost" @click="loadMore">Load More</v-button></div>
    </div>
</template>

<script>
import axios from "axios";
import Button from "./Button/Button.vue";

export default {
    props: {
        date: Object | Date | String
    },
    data() {
        return {
            posts: [],
            latestDate: null,
            noMorePost: false
        };
    },
    methods: {
        loadMore() {
            const date = this.latestDate === null ? this.date : this.latestDate;
            axios
                .get(`/api/post/index/${date}`)
                .then(response => {
                    if (response.data.data.length > 1) {
                        this.posts.push(response.data.data[0]);
                        this.latestDate = response.data.data[0].created_at;
                    }else{
                        this.posts.push(response.data.data[0]);
                        this.noMorePost = true;
                    }
                })
                .catch(error => console.log(error));
        }
    },
    components: {
        "v-button": Button
    }
};
</script>

<style scoped>
.container > div {
    display: flex;
    justify-content: center;
    margin-bottom: 2rem;
}
</style>
