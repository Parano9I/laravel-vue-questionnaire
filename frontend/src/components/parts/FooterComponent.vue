<template>
  <container-component>
    <div class="flex-row justify-content-start border-1 border-top py-2">
      <router-link to="/" class="h2 text-decoration-none">
        Questionnaire
      </router-link>
    </div>
  </container-component>
</template>

<script lang="ts">
import { defineComponent } from "vue";
import ContainerComponent from "@/components/Container/ContainerComponent.vue";

export default defineComponent({
  name: "FooterComponent",
  components: { ContainerComponent },
});
</script>

<style scoped></style>
