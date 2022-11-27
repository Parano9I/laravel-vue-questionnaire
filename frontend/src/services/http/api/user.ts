import httpClient from "@/services/http";
import {
  CreateUserParams,
  LoginParams,
} from "@/services/http/models/userModel";

const create = (params: CreateUserParams) => {
  return httpClient.post("/users", params);
};

const login = (params: LoginParams) => {
  return httpClient.post("/auth/login", params);
};

const logout = () => {
  return httpClient.get("/auth/logout");
};

export { create, login, logout };
