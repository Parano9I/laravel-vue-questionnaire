import { createUserApi, loginApi } from "@/services/http/api/user";
import {
  CreateUserParams,
  LoginParams,
  UserResponseModel,
} from "@/services/http/models/userModel";
import { Module } from "vuex";
import { AxiosError, AxiosResponse } from "axios";

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
  },
  actions: {
    async userCreate({ commit }, payload: CreateUserParams) {
      try {
        const res = await createUserApi(payload);
        const data: UserResponseModel = res.data;
        const { user, tokens } = data.data;
        const token = tokens.access_token;

        commit("setUser", { ...user, token });
        commit("setError", null);
      } catch (error: any) {
        const errorResp: AxiosResponse = error.response;
        commit("setError", errorResp);
      }
    },
    async login({ commit }, payload: LoginParams) {
      try {
        const res = await loginApi(payload);
        const data: UserResponseModel = res.data;
        const { user, tokens } = data.data;
        const token = tokens.access_token;

        commit("setUser", { ...user, token });
        commit("setError", null);
      } catch (error: any) {
        const errorResp: AxiosResponse = error.response;
        commit("setError", errorResp);
      }
    },
  },
};

export default UserModuleStore;
