import { createApp } from "vue";
import router from "./src/router/router";
import { createPinia } from "pinia";
import axios from "./src/plugins/axios";

import App from "./src/App.vue";

const app = createApp(App); 

const pinia = createPinia()

app.use(pinia )
app.use(router)
app.provide('axios',axios)

app.mount('#app');