import axios, { AxiosRequestConfig } from "axios";
import store from "@/store";
import router from "@/router";

const httpClient = axios.create({
  baseURL: "http://localhost:8080/api",
  headers: {
    Accept: "application/json",
    "Content-Type": "application/json",
  },
});

httpClient.interceptors.request.use(
  (config): AxiosRequestConfig => {
    const token = store.getters.getToken;
    if (token) {
      config.headers!.Authorization = `Bearer ${token}`;
      return config;
    }
    return config;
  },
  (err) => {
    return Promise.reject(err);
  }
);

httpClient.interceptors.response.use(
  (response) => {
    return response;
  },
  (error) => {
    if (error.response) {
      const currentRoute = router.currentRoute.value;

      switch (error.response.status) {
        case 401:
          store.dispatch("logout");
          if (currentRoute.path !== "/auth/login") {
            router.push({ name: "login" });
          }
      }
    }
    return Promise.reject(error.response.data);
  }
);

export default httpClient;
