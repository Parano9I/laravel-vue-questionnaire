<template>
  <div class="form-floating w-100">
    <textarea
      class="form-control"
      :placeholder="label"
      :name="name"
      :value="modelValue"
      @input="$emit('update:modelValue', $event.target.value)"
      id="floatingTextarea2"
      style="min-height: 100px"
    ></textarea>
    <label for="floatingTextarea2">{{ label }}</label>
  </div>
</template>

<script>
import { defineComponent } from "vue";

export default defineComponent({
  name: "TextareaComponent",
  props: {
    name: {
      type: String,
      required: true,
    },
    label: {
      type: String,
      required: true,
    },
    modelValue: {
      type: [String],
    },
  },
});
</script>

<style lang="scss">
textarea {
  resize: none;
}
</style>
