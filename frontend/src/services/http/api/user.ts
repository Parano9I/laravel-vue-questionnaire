import httpClient from "@/services/http";
import { CreateUserParams } from "@/services/http/models/userModel";

const createUserApi = (params: CreateUserParams) => {
  return httpClient.post("/users", params);
};

export { createUserApi };
