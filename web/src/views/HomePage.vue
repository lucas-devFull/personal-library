<script setup>
import { RouterLink } from "vue-router";
import "../assets/HomePage/style.css";
</script>
<template>
  <main class="px-3" style="width: 35rem">
    <h1>Personal Library</h1>
    <p class="lead justify-text">
      Transforme sua paixão por livros em organização perfeita: cadastre,
      gerencie e explore sua biblioteca pessoal de forma simples e eficiente
      aqui!
    </p>
    <p class="mt-5 lead">
      <RouterLink
        class="btn btn-lg btn-light fw-bold border-white bg-white"
        to="/your_library"
      >
        Veja seus Livros !
      </RouterLink>
    </p>
  </main>
</template>
