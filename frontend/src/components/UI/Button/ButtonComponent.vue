<template>
  <button :type="buttonType" class="btn btn-primary btn-block">
    <slot></slot>
  </button>
</template>

<script>
import { defineComponent } from "vue";

export default defineComponent({
  name: "ButtonComponent",
  props: {
    buttonType: {
      type: String,
      enum: ["button", "submit", "reset"],
      default: "button",
    },
  },
});
</script>

<style scoped></style>
