import { createApp } from "vue";
import "bootstrap/dist/css/bootstrap.min.css";
import "bootstrap";
import App from "./App.vue";
import router from "./router";
import store from "./store";
import localStorageSevice from "@/services/localStorageSevice";

store.subscribe((mutation, state) => {
  localStorageSevice.setItem("store", state);
});

createApp(App).use(store).use(router).mount("#app");
