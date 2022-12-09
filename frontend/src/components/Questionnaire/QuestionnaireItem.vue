<template>
  <div class="d-flex align-items-center justify-content-between">
    <router-link
      :to="isVerified ? questionnaireResultLink : questionnaireLink"
      class="h3 m-0 text-decoration-none"
    >
      <slot></slot>
    </router-link>
    <div v-if="totalScore">
      <span v-if="isVerified">Total score: {{ totalScore }}</span>
      <span v-else>Status: Іs processed</span>
    </div>
    <span v-else>Status: Not passed</span>
  </div>
</template>

<script lang="ts">
import { defineComponent } from "vue";

export default defineComponent({
  name: "QuestionnaireItem",
  props: {
    id: {
      type: Number,
      required: true,
    },
    isVerified: {
      type: Boolean,
      default: false,
    },
    totalScore: {
      type: Number,
      default: 0.0,
    },
  },
  computed: {
    questionnaireLink(): string {
      return `/questionnaire/${this.id}`;
    },
    questionnaireResultLink(): string {
      return `/questionnaire/${this.id}/result`;
    },
  },
});
</script>

<style scoped></style>
