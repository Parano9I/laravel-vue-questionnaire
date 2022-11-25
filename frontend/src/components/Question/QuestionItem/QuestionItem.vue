<template>
  <li class="list-group-item d-flex flex-column align-items-start">
    <P class="w-100 text-start"><slot></slot></P>
    <textarea-component :name="questionId" label="Your answer" />
  </li>
</template>

<script>
import { defineComponent } from "vue";
import TextareaComponent from "../../UI/Textarea/TextareaComponent";

export default defineComponent({
  name: "QuestionItem",
  components: { TextareaComponent },
  props: {
    questionId: {
      type: Number,
      required: true,
    },
  },
});
</script>

<style scoped></style>
