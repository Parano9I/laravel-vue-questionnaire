<template>
  <div class="d-flex flex-column justify-content-start">
    <label :for="name" class="form-label text-start">{{ label }}</label>
    <input
      :type="fieldType"
      :name="name"
      :id="name"
      :value="modelValue"
      @input="$emit('update:modelValue', $event.target.value)"
      :placeholder="placeholder"
      class="form-control"
    />
  </div>
</template>

<script lang="ts">
import { defineComponent } from "vue";

export default defineComponent({
  name: "InputComponent",
  props: {
    fieldType: {
      type: String,
      enum: ["email", "password", "number"],
      default: "text",
    },
    name: {
      type: String,
      required: true,
    },
    label: {
      type: String,
      required: true,
    },
    placeholder: {
      type: String,
      required: false,
    },
    modelValue: {
      type: [String, Number],
    },
  },
});
</script>

<style type="scss"></style>
