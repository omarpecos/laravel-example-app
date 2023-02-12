<template>
    <div class="other-component">
        <h2>Other component with validation</h2>
        <div class="form">
            <div class="input-container">
                <label for="name">Nombre</label>
                <input
                    type="text"
                    v-model="name"
                    name="name"
                    id="name"
                    :class="{ 'input-error': name && errorName }"
                    required
                    pattern="[a-zA-Z\s]+"
                />
                <span v-if="name && errorName" class="form-error">
                    {{ errorName }}
                </span>
            </div>
            <button :disabled="!validForm" class="submit" @click="submit">
                Enviar
            </button>
        </div>
    </div>
</template>

<script>
import { ref } from "vue";
const $axios = window.axios;

export default {
    setup() {
        const name = ref("");
        return { name };
    },
    computed: {
        errorName() {
            // https://www.w3schools.com/js/js_validation_api.asp
            // se puede sacar por cada tipo que saque el mensaje que tu quieras por cada tipo de error patternMismatch pues no cumple el formato, valueMissing: campo requerido etc...
            if (!this.name) return "valueMissing";
            // se puede hacer con una ref que es algo mas limpio que esto
            const name = document.querySelector("#name");
            if (name && !name.checkValidity()) {
                return name.validationMessage || "Campo no válido";
            } else return "";
        },
        validForm() {
            if (this.name && !this.errorName) return true;
            else return false;
        },
    },
    methods: {
        async submit() {
            try {
                // wait fake 1s
                await new Promise((resolve) => setTimeout(resolve, 1000));
                const body = { name: this.name };
                const { data } = await $axios.post(
                    "http://localhost:8000/api/form",
                    body
                );
                if (data.status) alert("Todo ok");
            } catch (error) {
                const { response } = error;
                console.log("error", response.data || error.message);
                // mejor a futuro con un sweetalert o algo de eso
                alert(
                    "Error: " +
                        JSON.stringify(
                            response.data && response.data.error
                                ? response.data.error
                                : error.message
                        )
                );
            }
        },
    },
};
</script>

<style>
.other-component {
    margin: 20px auto;
    width: 60%;
    border: 1px solid purple;
}
.other-component .form {
    width: 200px;
    margin: 10px auto;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
}
.other-component .form .input-container {
    position: relative;
    width: 100%;
}
.other-component .form .input-container label {
    position: absolute;
    top: -1.2rem;
    bottom: 0;
    left: 0;
    font-size: small;
}
.other-component .form .input-container input {
    position: relative;
    top: 0;
    left: 50%;
    transform: translateX(-50%);
    border-radius: 10px;
    width: 100%;
    padding: 2px 5px;
}
.other-component .form .input-container input:focus {
    outline: none;
}
.other-component .form .input-container .input-error {
    border: 1px solid red;
}
.other-component .form .input-container .form-error {
    margin: 5px;
    margin-bottom: 0;
    font-size: smaller;
    color: red;
    display: block;
}
.other-component .submit {
    margin-top: 20px;
    background: orange;
}
</style>
