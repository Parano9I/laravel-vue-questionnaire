<template>
  <div class="alert alert-danger text-start" role="alert">
    <template v-if="errorIsString">
      <h3 class="">{{ error }}</h3>
    </template>
    <template v-else>
      <ul class="">
        <template v-for="[name, errors] in Object.entries(error)" :key="name">
          <h3>{{ name }}</h3>
          <ul>
            <template v-for="error in errors" :key="error">
              <li>{{ error }}</li>
            </template>
          </ul>
        </template>
      </ul>
    </template>
  </div>
</template>

<script lang="ts">
import { defineComponent } from "vue";

export default defineComponent({
  name: "FormErrorComponent",
  props: {
    error: {
      type: [String, Object],
      required: true,
    },
  },
  computed: {
    errorIsString(): boolean {
      return typeof this.error === "string";
    },
  },
});
</script>

<style scoped></style>
