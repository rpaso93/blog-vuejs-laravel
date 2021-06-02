<template>
    <nav>
        <span id="logo">Logo</span>
        <bars v-if="showBars"></bars>
        <div v-if="!showBars">
            <slot></slot>
            <v-button v-if="user" v-on:click="logout">Logout</v-button>
        </div>
    </nav>
</template>

<script>
import Bars from "./Bars";
import Button from "../Button/Button";
import axios from 'axios';

export default {
    data: function() {
        return {
            showBars: false,
        };
    },
    props: {
        user: Boolean
    },
    components: {
        bars: Bars,
        "v-button": Button
    },
    methods: {
        logout() {
            axios.post("/api/logout").then(()=>{
                window.location.replace("/");
            });
        },
        onResize() {
            this.showBars = window.innerWidth < 760;
        }
    },
    mounted() {
        window.addEventListener("resize", this.onResize, { passive: true });
        this.onResize();
    },
    beforeDestroy() {
        window.removeEventListener("resize", this.onResize, { passive: true });
    }
};
</script>

<style scoped>
nav {
    position: sticky;
    top: 0;
    height: 65px;
    width: 100%;
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: #f8f8f8;
    box-shadow: 0px 0px 12px 1px rgba(0, 0, 0, 0.5);
    padding: 0.3rem calc((100vw - 1260px) / 2);
    z-index: 100;
    box-sizing: border-box;
}

nav > #logo {
    color: #2d9176;
    font-size: 1.6rem;
    font-weight: 700;
    text-transform: uppercase;
    margin-left: 1rem;
}

nav > div {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-right: 1rem;
}

nav > div > a {
    font-size: 1rem;
    font-weight: 600;
    color: black;
    margin: 1rem;
    text-decoration: none;
    text-transform: uppercase;
    cursor: pointer;
}

nav > div > a:visited {
    color: black;
}

nav > div > a.active,
nav > div > a:hover {
    color: rgb(45, 145, 118);
}

nav > div > button {
    display: flex;
    align-items: center;
    justify-content: space-around;
    width: 100px;
    margin: 2rem;
    padding: 0.75rem 1rem;
    background-color: transparent;
    border-radius: 2px;
    font-family: "Nunito", sans-serif;
    background-color: #2d9176;
    color: #e6e6e6;
    border: none;
    font-size: 1rem;
    font-weight: 700;
    transition: all 0.6s ease;
}

nav > div > button:hover,
nav > div > button:active {
    background-color: #206b57;
    outline: none;
    cursor: pointer;
    transition: all 0.6s ease;
}

nav > div > button:disabled {
    background-color: #103c30;
    outline: none;
    cursor: not-allowed;
    transition: all 0.6s ease;
}
</style>
