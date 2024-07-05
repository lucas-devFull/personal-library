import { createRouter, createWebHistory } from "vue-router";
import Explore from "../views/Explore.vue";
import HomeView from "../views/HomePage.vue";
import Library from "../views/Library.vue";

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: "/",
      name: "home",
      component: HomeView,
    },
    {
      path: "/your_library",
      name: "your_library",
      component: Library,
    },
    {
      path: "/explore",
      name: "explore",
      component: Explore,
    },
  ],
});

export default router;
