import axios from "axios";

const httpClient = axios.create({
  baseURL: "http://localhost:8080",
  headers: {
    Accept: "application/json",
    "Content-Type": "application/json",
  },
});

httpClient.interceptors.request.use((config) => {
  NProgress.start();
  return config;
});

httpClient.interceptors.response.use((response) => {
  NProgress.done();
  return response;
});

export default httpClient;
