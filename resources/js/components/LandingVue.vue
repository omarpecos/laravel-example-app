<template>
    <div v-if="loading" class="loader-container">
        <div class="loader"></div>
    </div>
    <template v-else>
        <h1>This is {{ view }}</h1>

        <UsersList :users="users" />
        <Form />
    </template>
</template>

<script>
import { ref } from "@vue/reactivity";

const view = "Landing app with Vue + Vite (laravel 9 mounted)";
// por que está así cargado en bootstrap.js!
const $axios = window.axios;

export default {
    setup() {
        const loading = ref(false);
        const users = ref([]);

        return { view, loading, users };
    },
    methods: {
        async fetchData() {
            try {
                this.loading = true;
                // wait fake 300ms
                await new Promise((resolve) => setTimeout(resolve, 300));
                const { data } = await $axios.get(
                    "http://localhost:8000/api/users/all"
                );
                this.users = data;
                this.loading = false;
            } catch (error) {
                this.loading = false;
                console.log("error", error);
            }
        },
    },
    async mounted() {
        console.log("Landing app with Vue + Vite (laravel 9 mounted)");
        await this.fetchData();
    },
};
</script>

<style>
body {
    margin: 0;
}
h1,
h2 {
    text-align: center;
    padding: 10px;
}
.loader-container {
    min-width: 100vw;
    min-height: 100vh;
    background: black;
    position: relative;
}

.loader-container .loader {
    position: absolute;
    background: white;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 100px;
    height: 20px;
    animation: loader 1s ease-in-out 0s infinite;
}
/* Con rotateY en vez de el Z queda guapo también jaja */
@keyframes loader {
    0% {
        transform: rotateZ(0deg) scale(1);
    }
    50% {
        transform: rotateZ(180deg) scale(0.5);
    }
    100% {
        transform: rotateZ(360deg) scale(1);
    }
}
</style>
