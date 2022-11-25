<template>
  <header class="container-lg p-2 mx-auto">
    <div
      class="d-flex flex-row align-items-center justify-content-between border-1 border-bottom"
    >
      <router-link to="/" class="h2 text-decoration-none">
        Questionnaire
      </router-link>
      <nav class="">
        <router-link to="/register" class="me-2"> SignUp </router-link>
        <router-link to="/login"> SignIn </router-link>
      </nav>
    </div>
  </header>
</template>
<script>
import { defineComponent } from "vue";

export default defineComponent({
  name: "HeaderComponent",
});
</script>

<style scoped></style>
