<template>
  <div class="site-container d-flex flex-column">
    <header-component />
    <main class="flex-grow-1">
      <router-view />
    </main>
  </div>
</template>

<style lang="scss">
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
}
.site-container {
  min-height: 100vh;
}
</style>
<script>
import HeaderComponent from "@/components/parts/HeaderComponent";
import { useStore } from "vuex";

export default {
  components: { HeaderComponent },
  beforeCreate() {
    const store = useStore();
    store.commit("loadStore");
  },
};
</script>
