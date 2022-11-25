import { createUserApi } from "@/services/http/api/user";
import {
  CreateUserParams,
  UserResponseModel,
} from "@/services/http/models/userModel";
import { Module } from "vuex";
import { AxiosError } from "axios";
import { ErrorResponseModel } from "@/services/http/models/errorModel";

interface UserState {
  user: {
    id: number | null;
    name: string | null;
    email: string | null;
    token: string | null;
  };
  errors: any;
}

const UserModuleStore: Module<UserState, any> = {
  state: {
    user: {
      id: null,
      name: null,
      email: null,
      token: null,
    },
    errors: null,
  },
  getters: {
    getUser(state: UserState) {
      return state.user;
    },
    getError(state: UserState) {
      return state.errors;
    },
  },
  mutations: {
    setUser(state: UserState, payload) {
      state.user = payload;
    },
    setError(state: UserState, payload) {
      state.errors = payload;
    },
  },
  actions: {
    async login({ commit }, payload: CreateUserParams) {
      try {
        const res = await createUserApi(payload);
        const data: UserResponseModel = res.data;
        const { user, tokens } = data.data;

        commit("setUser", { ...user, tokens });
      } catch (error) {
        // commit("setError", error.response.data);
      }
    },
  },
};

export default UserModuleStore;
