import { createStore } from "vuex";
import userModuleStore from "./modules/user";
import localStorageSevice from "@/services/localStorageSevice";

export default createStore({
  modules: {
    user: userModuleStore,
  },
  mutations: {
    loadStore() {
      if (localStorage.getItem("store")) {
        try {
          this.replaceState(localStorageSevice.getItem("store"));
        } catch (e) {
          console.log("Could not initialize store", e);
        }
      }
    },
  },
  plugins: [],
});
