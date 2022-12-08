import { createStore } from "vuex";
import userModuleStore from "./modules/user";
import localStorageSevice from "@/services/localStorageSevice";
import answersModuleStore from "@/store/modules/answers";

export default createStore({
  modules: {
    user: userModuleStore,
    answers: answersModuleStore,
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
