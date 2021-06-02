<template>
    <div class="input__container" v-bind:class="{ error: typeof error === 'object' }">
        <input
            v-bind="$attrs"
            v-bind:value="value"
            v-bind:type="type"
            v-on="inputListeners"
            required
        />
        <label>
            <span>{{ !error ? label : error[0] }}</span>
        </label>
    </div>
</template>

<script>
export default {
    inheritAttrs: false,
    props: { label: String, value: String, type: String, error: Array | null },
    computed: {
        inputListeners() {
            let vm = this;
            return Object.assign({}, this.$listeners, {
                input: function(event) {
                    vm.$emit("input", event.target.value);
                }
            });
        }
    }
};
</script>

<style scoped>
.input__container {
    height: 45px;
    min-width: 320px;
    position: relative;
    overflow: hidden;
    margin: .6rem 2rem;
}

.input__container > input {
    width: 100%;
    height: 100%;
    padding-top: 20px;
    padding-left: 10px;
    padding-bottom: 2px;
    border: none;
    color: #1c1c1c;
    outline: none;
    background-color: transparent;
    font-size: 1.05rem;
}

.input__container > label {
    position: absolute;
    bottom: 0;
    left: 0%;
    width: 100%;
    height: 100%;
    pointer-events: none;
    border-bottom: 0.13rem solid #1c1c1c;
}

.input__container > label > span {
    color: #1c1c1c;
    position: absolute;
    bottom: 0px;
    left: 6px;
    transition: all 0.3s ease;
    font-weight: 600;
    font-size: 1.1rem;
}

.input__container > label::after {
    content: "";
    position: absolute;
    height: 100%;
    width: 100%;
    left: 0;
    bottom: -0.13rem;
    border-bottom: 0.13rem solid #2d9176;
    transform: translateX(-100%);
    transition: all 0.6s ease;
}

.input__container > input:hover + label::after,
.input__container > input:focus + label::after,
.input__container > input:valid + label::after {
    transform: translateX(0%);
}

.input__container > input:hover + label > span,
.input__container > input:focus + label > span,
.input__container > input:valid + label > span {
    transform: translateY(-100%);
    font-size: 1rem;
    color: #2d9176;
}

.input__container.error > input + label::after {
    border-bottom-color: #ce0202 !important;
}

.input__container.error > input + label > span {
    transform: translateY(-100%);
    font-size: 1rem;
    color: #ce0202 !important;
}
</style>
