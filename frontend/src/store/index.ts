import { createStore } from "vuex";
import userModuleStore from "./modules/user";

export default createStore({ modules: { userStore: userModuleStore } });
