<template>
  <li class="list-group-item d-flex flex-column align-items-start">
    <P class="w-100 text-start">{{ questionText }}</P>
    <textarea-component v-model="answerText" :name="name" label="Your answer" />
  </li>
</template>

<script lang="ts">
import { defineComponent } from "vue";
import TextareaComponent from "../../UI/Textarea/TextareaComponent.vue";
import { useStore } from "vuex";
import { AnswerInterface } from "@/interfaces/answers";

export default defineComponent({
  name: "QuestionItem",
  components: { TextareaComponent },
  data() {
    return {
      store: useStore(),
      answerText: "",
    };
  },
  props: {
    questionId: {
      type: Number,
      required: true,
    },
    questionText: {
      type: String,
      required: true,
    },
  },
  mounted() {
    this.answerText = this.getAnswer();
  },
  computed: {
    answerBody(): string {
      const answer: AnswerInterface = this.store.getters.getAnswerById(
        this.questionId
      );
      return answer ? answer.answer : "";
    },
    name(): string {
      return this.questionId.toString();
    },
  },
  methods: {
    addAnswer(text: string) {
      this.store.dispatch("addAnswer", {
        questionId: this.questionId,
        answer: text,
      });
    },
    getAnswer(): string {
      const answer = this.store.getters.getAnswerById(this.questionId);
      return answer ? answer.answer : "";
    },
  },
  watch: {
    answerText(newAnswerBody, oldAnswerBody) {
      this.addAnswer(newAnswerBody);
    },
  },
});
</script>

<style scoped></style>
