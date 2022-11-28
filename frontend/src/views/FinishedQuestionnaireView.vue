<template>
  <container-component> </container-component>
</template>

<script lang="ts">
import { defineComponent } from "vue";
import ContainerComponent from "@/components/Container/ContainerComponent.vue";

export default defineComponent({
  name: "FinishedQuestionnaireView",
  components: { ContainerComponent },
});
</script>

<style scoped></style>
