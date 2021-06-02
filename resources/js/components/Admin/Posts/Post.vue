<template>
    <section>
        <div class="post-admin" v-if="!editing">
            <div>
                <h1 class="header">{{ post.title }}</h1>
                <span>{{ post.created_at }}</span>
            </div>
            <p>{{ contentResume }}</p>
            <div class="btn-container">
                <v-button @click="editPost" class="edit">Edit Content</v-button>
                <v-button @click="changeStatus(1)" v-if="post.status.id !== 1"
                    >Publish</v-button
                >
                <v-button
                    @click="changeStatus(3)"
                    v-if="post.status.id !== 3"
                    class="draft"
                    >Send to Drafts</v-button
                >
                <v-button
                    @click="changeStatus(2)"
                    v-if="post.status.id !== 2"
                    class="store"
                    >Store</v-button
                >
                <v-button class="delete" @click="deletePost">Delete</v-button>
            </div>
        </div>
        <edit-post
            v-if="editing"
            :id="post.id"
            :status="post.status.id"
            @updated="editing = false"
        ></edit-post>
    </section>
</template>

<script>
import Button from "../../Button/Button.vue";
import EditPostVue from "./EditPost.vue";
const MAX_LENGTH = 320;

export default {
    props: {
        post: Object
    },
    data() {
        return {
            editing: false
        };
    },
    computed: {
        contentResume() {
            return this.post.content.length > MAX_LENGTH
                ? `${this.post.content.substr(0, MAX_LENGTH)}...`
                : this.post.content;
        }
    },
    methods: {
        editPost() {
            this.editing = true;
        },
        changeStatus(newStatus) {
            this.$store
                .dispatch("userPosts/updateStatus", {
                    id: this.post.id,
                    old_status: this.post.status.id,
                    status_id: newStatus
                })
                .then(() => {
                })
                .catch(err => console.log(err));
        },
        deletePost() {
            this.$store
                .dispatch("userPosts/deletePost", {
                    id: this.post.id,
                    status_id: this.post.status.id
                })
                .then(() => {
                })
                .catch(err => console.log(err));
        }
    },
    components: {
        "v-button": Button,
        "edit-post": EditPostVue
    }
};
</script>

<style>
.post-admin {
    background-color: #f8f8f8;
    border-radius: 2px;
    border: 1px solid #ddd;
    padding: 1.2rem 1.7rem;
    margin: 1rem 0;
    box-shadow: none;
    display: flex;
    width: 100%;
    flex-direction: column;
}

.post-admin > div {
    display: flex;
    flex-direction: column;
    width: 100%;
    justify-content: space-between;
    align-items: center;
}

.header {
    font-size: 2rem;
    font-weight: 700;
    color: #22705c;
    justify-self: center;
}

.post-admin > div > div {
    display: flex;
    width: 100%;
    justify-content: center;
    align-items: center;
    position: relative;
}

.post-admin > div > div > span {
    position: absolute;
    top: 0;
    right: 0;
    margin: 0;
}

.post-admin > div.btn-container {
    flex-direction: row;
}

.btn-container > button {
    margin: 0.5rem;
    padding: 0.5rem;
    width: 150px;
    align-self: stretch;
}
</style>
