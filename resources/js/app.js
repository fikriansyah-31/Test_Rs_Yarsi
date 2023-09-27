import { createApp } from "vue";
import router from "./src/router/router";
import App from "./src/App.vue";

const app = createApp(App); 

app.use(router)

app.mount('#app');