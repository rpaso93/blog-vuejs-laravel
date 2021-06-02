<template>
    <div class="input__container">
        <textarea
            v-bind="$attrs"
            v-bind:value="value"
            v-on="inputListeners"
            required
        ></textarea>
        <label>
            <span>{{  label }}</span>
        </label>
    </div>
</template>

<script>
export default {
    inheritAttrs: false,
    props: { label: String, value: String },
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
    min-height: 480px;
    position: relative;
    overflow: hidden;
    margin: .6rem 2rem;
}

.input__container > textarea {
    width: 100%;
    height: 100%;
    padding-top: 23px;
    padding-left: 10px;
    padding-bottom: 2px;
    border: none;
    color: #1c1c1c;
    outline: none;
    background-color: transparent;
    font-size: 1.05rem;
    resize: none;
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
    top: 0px;
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

.input__container > textarea:hover + label::after,
.input__container > textarea:focus + label::after,
.input__container > textarea:valid + label::after {
    transform: translateX(0%);
}

.input__container > textarea:hover + label > span,
.input__container > textarea:focus + label > span,
.input__container > textarea:valid + label > span {
    font-size: 1rem;
    color: #2d9176;
    background-color: #f9f9f9;
    width: 100%;
}
</style>
