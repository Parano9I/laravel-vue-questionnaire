<template>
  <header class="container-lg p-2 mx-auto">
    <div
      class="d-flex flex-row align-items-center justify-content-between border-1 border-bottom"
    >
      <router-link to="/" class="h2 text-decoration-none">
        Questionnaire
      </router-link>
      <div v-if="isAuth">
        <router-link to="#" @click.prevent="handleLogout" class="me-2">
          Logout
        </router-link>
      </div>
      <nav v-else class="">
        <router-link to="/register" class="me-2"> SignUp </router-link>
        <router-link to="/login"> SignIn </router-link>
      </nav>
    </div>
  </header>
</template>
<script lang="ts">
import { defineComponent } from "vue";
import { useStore } from "vuex";

export default defineComponent({
  name: "HeaderComponent",

  data() {
    return {
      store: useStore(),
    };
  },
  computed: {
    isAuth(): boolean {
      return !!this.store.getters.getUser.id;
    },
  },
  methods: {
    handleLogout(): void {
      this.store.dispatch("logout");
    },
  },
});
</script>

<style scoped></style>
