<template>
    <form @submit.prevent>
        <v-input label="Title" type="" v-model="post.title"></v-input>
        <v-textarea label="Content" v-model="post.content"></v-textarea>
        <div>
            <v-button
                :isSubmitting="submitting"
                type="submit"
                @click="storePost(false)"
                >Save</v-button
            >
        </div>
        <span v-if="error" class="error">
            <span v-on:click="closeError">X</span>
            {{ error }}
        </span>
        <slot></slot>
    </form>
</template>

<script>
import Input from "../../Input/Input";
import TextArea from "../../Input/TextArea.vue";
import Button from "../../Button/Button";

export default {
    props: {
        id: Number,
        status: Number
    },
    data() {
        return {
            post: {
                title: "",
                content: ""
            },
            submitting: false,
            error: null
        };
    },
    methods: {
        updatePost() {
            this.submitting = true;

            this.$store
                .dispatch("userPosts/updateContent", {
                    post: this.post,
                    id: id,
                    status_id: this.status
                })
                .then(() => {
                    this.submitting = false;
                    this.$emit("updated");
                })
                .catch(err => (this.error = err.message));
        }
    },
    mounted() {
        this.post.title = postEdit.title;
        this.post.content = postEdit.content;
    },
    computed: {
        postEdit: {
            get() {
                return this.$store.state.userPosts.getters.getPostById({
                    type: this.status,
                    id: this.id
                });
            }
        }
    },
    components: {
        "v-input": Input,
        "v-textarea": TextArea,
        "v-button": Button
    }
};
</script>

<style scoped>
form {
    display: flex;
    flex-direction: column;
    padding: 1rem 5rem;
}

form > div {
    display: flex;
    justify-content: center;
}

form > div > button:last-of-type {
    width: 190px;
    background-color: #ddd;
    color: black;
}

form > div > button:last-of-type:hover {
    background-color: #c0c0c0;
    outline: none;
    cursor: pointer;
    transition: all 0.6s ease;
}

form > div > button:last-of-type:disabled {
    background-color: #acacac;
    outline: none;
    cursor: not-allowed;
    transition: all 0.6s ease;
}

.error {
    margin-bottom: 1rem;
    padding: 0.75rem;
    border-radius: 2px;
    background-color: #ba3535;
    color: #e6e6e6;
    box-shadow: 0px 0px 12px 1px rgba(0, 0, 0, 0.2);
    display: flex;
    flex-direction: column;
}
.error > span {
    align-self: flex-end;
    margin-bottom: 0.2rem;
    cursor: pointer;
}

.container > form > span > a {
    text-decoration: none;
}
</style>
