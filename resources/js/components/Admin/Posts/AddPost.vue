<template>
    <form @submit.prevent>
        <v-input label="Title" type="" v-model="post.title"></v-input>
        <v-textarea label="Content" v-model="post.content"></v-textarea>
        <div>
            <v-button
                :isSubmitting="submitting"
                type="submit"
                @click="storePost(false)"
                >Publish</v-button
            >
            <v-button :isSubmitting="saving" type="submit" @click="storePost(true)"
                >Save Draft</v-button
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
    data() {
        return {
            post: {
                title: "",
                content: "",
                status_id: null
            },
            submitting: false,
            saving: false,
            error: null
        };
    },
    methods: {
        storePost(isDraft) {
            if (isDraft) {
                this.post.status_id = 3;
                this.saving = true;
            } else {
                this.post.status_id = 1;
                this.submitting = true;
            }
            this.$store
                .dispatch("userPosts/store", this.post)
                .then(() => {
                    this.saving = false;
                    this.submitting = false;
                })
                .catch(err => console.log(err));
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
