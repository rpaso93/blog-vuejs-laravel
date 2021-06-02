<template>
    <div class="container">
        <h1>Register</h1>
        <form @submit.prevent="submitForm">
            <v-input
                label="Enter your name"
                type="text"
                v-model="form.name"
                v-bind:error="errors ? errors['name'] : null"
            ></v-input>
            <v-input
                label="Enter your e-mail"
                type="email"
                v-model="form.email"
                v-bind:error="errors ? errors['email'] : null"
            ></v-input>
            <v-input
                label="Enter a password"
                type="password"
                v-model="form.password"
                v-bind:error="errors ? errors['password'] : null"
            ></v-input>
            <v-input
                label="Confirm the password"
                type="password"
                v-model="form.password_confirmation"
                v-bind:error="errors ? errors['password_confirmation'] : null"
            ></v-input>
            <v-button :isSubmitting="submitting" type="submit"
                >Sign Up</v-button
            >
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
            form: {
                name: "",
                email: "",
                password: "",
                password_confirmation: ""
            },
            submitting: false,
            errors: []
        };
    },
    methods: {
        submitForm() {
            this.submitting = true;
            axios
                .post("/api/register", this.form)
                .then(() => {
                    window.location.replace("/login");
                })
                .catch(error => {
                    this.errors = error.response.data.errors;
                    this.submitting = false;
                });
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

.container > span > a {
    text-decoration: none;
}
</style>
