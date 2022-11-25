<template>
  <container-component>
    <div class="d-flex flex-column align-items-start">
      <h1 class="">Questionnaires</h1>
      <ul class="w-100 list-group d-flex flex-column align-items-stretch">
        <li class="list-group-item d-flex align-items-start">
          <router-link
            to="/questionnaire/1"
            class="h3 m-0 text-decoration-none"
          >
            Geography
          </router-link>
        </li>
      </ul>
    </div>
  </container-component>
</template>

<script lang="ts">
import { defineComponent } from "vue";
import ContainerComponent from "@/components/Container/ContainerComponent.vue";

export default defineComponent({
  name: "HomeView",
  components: { ContainerComponent },
});
</script>
