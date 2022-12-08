import { createRouter, createWebHistory, RouteRecordRaw } from "vue-router";
import HomeView from "../views/HomeView.vue";
import RegisterView from "../views/RegisterView.vue";
import LoginView from "../views/LoginView.vue";
import QuestionnaireView from "../views/QuestionnaireView.vue";
import QuestionnaireResultView from "@/views/QuestionnaireResultView.vue";

const routes: Array<RouteRecordRaw> = [
  {
    path: "/",
    name: "home",
    component: HomeView,
  },
  {
    path: "/register",
    name: "register",
    component: RegisterView,
  },
  {
    path: "/login",
    name: "login",
    component: LoginView,
  },
  {
    path: "/questionnaire/:id",
    name: "questionnaire",
    component: QuestionnaireView,
  },
  {
    path: "/questionnaire/:id/result",
    name: "questionnaire.result",
    component: QuestionnaireResultView,
  },
];

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes,
});

export default router;
