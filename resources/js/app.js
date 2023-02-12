import "./bootstrap";

import { createApp } from "vue";
import LandingVue from "./components/LandingVue.vue";
import UsersList from "./components/UsersList.vue";
import Form from "./components/Form.vue";

const app = createApp(LandingVue);

app.component("UsersList", UsersList);
app.component("Form", Form);

app.mount("#app-vue");
