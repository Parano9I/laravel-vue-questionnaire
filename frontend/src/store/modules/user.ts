import * as userApi from "@/services/http/api/user";
import {
  CreateUserParams,
  LoginParams,
  UserResponseModel,
} from "@/services/http/models/userModel";
import { Module } from "vuex";
import { AxiosResponse } from "axios";
import router from "@/router";

interface UserState {
  user: {
    id: number | null;
    name: string | null;
    email: string | null;
    token: string | null;
  };
  errors: string | null | object;
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
    setError(state: UserState, payload: AxiosResponse) {
      const errorCode = payload.status;
      const errorData = payload.data;

      switch (errorCode) {
        case 401:
          state.errors = errorData.message;
          break;
        case 422:
          state.errors = errorData.errors;
          break;
      }
    },
    resetErrors(state: UserState): void {
      state.errors = null;
    },
    resetUser(state: UserState): void {
      state.user = {
        id: null,
        name: null,
        email: null,
        token: null,
      };
    },
  },
  actions: {
    async userCreate({ commit }, payload: CreateUserParams) {
      try {
        const res = await userApi.create(payload);
        const data: UserResponseModel = res.data;
        const { user, tokens } = data.data;
        const token = tokens.access_token;

        commit("setUser", { ...user, token });
        commit("resetErrors");

        await router.push({ name: "home" });
      } catch (error: any) {
        const errorResp: AxiosResponse = error.response;
        commit("setError", errorResp);
      }
    },
    async login({ commit }, payload: LoginParams) {
      try {
        const res = await userApi.login(payload);
        const data: UserResponseModel = res.data;
        const { user, tokens } = data.data;
        const token = tokens.access_token;

        commit("setUser", { ...user, token });
        commit("resetErrors");

        await router.push({ name: "home" });
      } catch (error: any) {
        const errorResp: AxiosResponse = error.response;
        commit("setError", errorResp);
      }
    },
    async logout({ commit }) {
      try {
        const res = await userApi.logout();

        commit("resetErrors");
        commit("resetUser");
      } catch (e) {
        console.log(e);
      }
    },
  },
};

export default UserModuleStore;
