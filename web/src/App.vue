<script setup>
import "bootstrap/dist/js/bootstrap";
import { watch } from "vue";
import { RouterLink, RouterView } from "vue-router";
import "./assets/App.css";
</script>

<template>
  <div class="body h-100 text-center text-bg-dark">
    <div class="h-100 bc-opacity">
      <div
        class="cover-container d-flex align-items-center justify-content-between w-100 h-100 p-3 mx-auto flex-column"
      >
        <nav
          class="navbar nav-masthead bg-transparent"
          style="background-color: transparent !important; width: 100%"
          data-bs-theme="dark"
        >
          <div class="container">
            <RouterLink class="navbar-brand fw-bold py-1 px-0" to="/">
              <h3 class="float-md-start mb-0">Personal Library</h3>
            </RouterLink>

            <div class="d-flex">
              <RouterLink
                to="/"
                class="nav-link fw-bold py-1 px-0"
                :class="{ active: labelActive == 1 }"
                :onclick="() => (this.labelActive = 1)"
                aria-current="page"
                href="#"
                >Home
              </RouterLink>

              <RouterLink
                to="/your_library"
                class="nav-link fw-bold py-1 px-0"
                :class="{ active: labelActive == 2 }"
                :onclick="() => (this.labelActive = 2)"
                href="#"
              >
                Your Library
              </RouterLink>

              <RouterLink
                to="/explore"
                class="nav-link fw-bold py-1 px-0"
                :class="{ active: labelActive == 3 }"
                :onclick="() => (this.labelActive = 3)"
                href="#"
              >
                Explore
              </RouterLink>
            </div>
          </div>
        </nav>

        <RouterView />

        <footer class="text-white-50">
          <p>
            Created by
            <a
              href="https://github.com/lucas-devFull/personal-library"
              class="text-white"
              >Lucas Conceição</a
            >.
          </p>
        </footer>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      labelActive: 1,
    };
  },
  watch: {
    $route(to, from) {
      let arrayViews = ["home", "your_library", "explore"];
      this.labelActive = arrayViews.indexOf(to.name) + 1;
    },
  },
  mounted() {},
};
</script>
