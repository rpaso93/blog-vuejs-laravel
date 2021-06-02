<template>
    <div class="container">
        <h1>Login</h1>
        <form @submit.prevent="login">
            <v-input
                label="E-mail"
                type="email"
                v-model="user.email"
            ></v-input>
            <v-input
                label="Password"
                type="password"
                v-model="user.password"
            ></v-input>
            <v-button :isSubmitting="submitting" type="submit"
                >Sign In</v-button
            >
            <span v-if="error" class="error">
                <span v-on:click="closeError">X</span>
                {{ error }}
            </span>
            <slot></slot>
        </form>
    </div>
</template>

<script>
import Button from "./Button/Button.vue";
import Input from "./Input/Input.vue";
import axios from "axios";

export default {
    data() {
        return {
            user: {
                email: "",
                password: ""
            },
            submitting: false,
            error: null
        };
    },
    methods: {
        login() {
            this.submitting = true;
            axios
                .post("/api/login", this.user)
                .then(response => {
                    window.location.replace("/admin");
                })
                .catch(error => {
                    this.error = error.response.data.errors["result"][0];
                    this.submitting = false;
                });
        },
        closeError() {
            this.error = null;
        }
    },
    components: {
        "v-input": Input,
        "v-button": Button
    }
};
</script>

<style scoped>
.container {
    align-self: center;
    margin: auto;
    background-color: #f8f8f8;
    padding: 2.5rem;
    display: flex;
    flex-direction: column;
    align-items: center;
    border-radius: 2px;
    box-shadow: 0px 6px 12px 0px rgba(0, 0, 0, 0.2);
}

.container > h1 {
    font-size: 1.9rem;
    color: #2d9176;
}

.container > form {
    display: flex;
    flex-direction: column;
    align-items: center;
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
