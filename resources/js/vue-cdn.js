let app = new Vue({
    el: "#vue-cdn",
    data: {
        loading: true,
        view: "VUE with CDN",
        users: [],
        name: "",
    },
    async mounted() {
        console.log("This is a vue app loaded by CDN", this.view);
        await this.fetchData();
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
        async fetchData() {
            try {
                this.loading = true;
                // wait fake 300ms
                await new Promise((resolve) => setTimeout(resolve, 300));
                const res = await fetch("http://localhost:8000/api/users/all");
                const json = await res.json();
                this.users = json;
                this.loading = false;
            } catch (error) {
                this.loading = false;
                console.log("error", error);
            }
        },
        async submit() {
            try {
                // wait fake 1s
                await new Promise((resolve) => setTimeout(resolve, 1000));
                const body = JSON.stringify({ name: this.name });
                const res = await fetch("http://localhost:8000/api/form", {
                    method: "POST",
                    body,
                });
                const json = await res.json();
                if (!json.status) {
                    alert("Error: " + JSON.stringify(json.error));
                } else alert("Todo ok");
            } catch (error) {
                console.log("error", error);
                // mejor a futuro con un sweetalert o algo de eso
                alert("Error: " + error.message);
            }
        },
    },
});
