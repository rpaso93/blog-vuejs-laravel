<template>
    <button v-bind:disabled="isSubmitting" v-bind:type="type" v-on="buttonListener">
        <spinner v-if="isSubmitting" :size="15"></spinner>
        <slot></slot>
    </button>
</template>

<script>
import Spinner from "../Spinner.vue";
export default {
    props: {
        isSubmitting: Boolean,
        type: String,
    },
    computed: {
        buttonListener(){
            let vm = this;
            return Object.assign({}, this.$listeners,{
                click: function(event){
                    vm.$emit("click", event);
                }
            })
        }
    },
    components: {
        spinner: Spinner
    }
};
</script>

<style scoped>
button {
    display: flex;
    align-items: center;
    justify-content: space-around;
    width: 160px;
    margin: 2rem;
    padding: 0.75rem 2rem;
    background-color: transparent;
    border-radius: 2px;
    font-family: "Nunito", sans-serif;
    background-color: #2d9176;
    color: #e6e6e6;
    border: none;
    font-size: 1.1rem;
    font-weight: 700;
    transition: all 0.6s ease;
}

button:hover,
button:active {
    background-color: #206b57;
    outline: none;
    cursor: pointer;
    transition: all 0.6s ease;
}

button:disabled {
    background-color: #103c30;
    outline: none;
    cursor: not-allowed;
    transition: all 0.6s ease;
}
</style>
