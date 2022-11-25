<template>
  <div class="container-lg"><slot></slot></div>
</template>

<script lang="ts">
import { defineComponent } from "vue";

export default defineComponent({
  name: "ContainerComponent",
});
</script>

<style scoped></style>
