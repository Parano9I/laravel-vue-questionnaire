import axios from "axios";

const httpClient = axios.create({
  baseURL: "http://localhost:8080/api",
  headers: {
    Accept: "application/json",
    "Content-Type": "application/json",
  },
});

httpClient.interceptors.request.use((config) => {
  return config;
});

httpClient.interceptors.response.use((response) => {
  return response;
});

export default httpClient;
