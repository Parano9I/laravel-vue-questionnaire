import httpClient from "@/services/http";
import {
  CreateUserParams,
  LoginParams,
} from "@/services/http/models/userModel";

const createUserApi = (params: CreateUserParams) => {
  return httpClient.post("/users", params);
};

const loginApi = (params: LoginParams) => {
  return httpClient.post("/auth/login", params);
};

export { createUserApi, loginApi };
