import Vue from "vue";
import VueRouter from "vue-router";
import Navbar from "./components/Navbar";
import LoginForm from "./components/LoginForm.vue";
import RegisterForm from "./components/RegisterForm.vue";
import PostList from './components/PostList.vue';
import AdminUi from "./components/Admin";
import store from "./store";

Vue.use(VueRouter);

const app = new Vue({
    el: "#app",
    store,
    components: {
        navbar: Navbar,
        login: LoginForm,
        register: RegisterForm,
        admin: AdminUi,
        'post-list': PostList
    }
});
