<template>
  <container-component>
    <h1>Geography</h1>
    <ul class="w-100 list-group d-flex flex-column align-items-stretch">
      <question-item question-id="1"
        >What is the name of the tallest mountain in the world?</question-item
      >
    </ul>
    <div class="d-flex align-items-center justify-content-between py-2">
      <div class="">
        <button-component v-if="isShowPrevButton" v-on:click="prevPage">
          Prev
        </button-component>
      </div>
      <div>
        <button-component v-if="isShowNextButton">
          <router-link
            to="/"
            class="text-light text-decoration-none"
            v-on:click="nextPage"
          >
            Next
          </router-link>
        </button-component>
      </div>
    </div>
  </container-component>
</template>

<script lang="ts">
import { defineComponent } from "vue";
import ContainerComponent from "@/components/Container/ContainerComponent.vue";
import QuestionItem from "@/components/Question/QuestionItem/QuestionItem.vue";
import ButtonComponent from "@/components/UI/Button/ButtonComponent.vue";

export default defineComponent({
  name: "QuestionnaireView",
  components: { ButtonComponent, QuestionItem, ContainerComponent },
  data() {
    return {
      questionnaireId: this.$route.params.questionnaireId,
      page: 1,
      maxPage: 3,
    };
  },
  mounted() {
    this.page = this.getCurrentPage();
  },
  computed: {
    isShowNextButton(): boolean {
      return this.page < this.maxPage;
    },
    isShowPrevButton(): boolean {
      return this.page > 1;
    },
  },
  methods: {
    addParamsToLocation(queryKey: string, value: string): void {
      this.$router.push({ query: { [queryKey]: value } });
    },
    getCurrentPage(): number {
      const page = this.$route.query.page;
      return (this.page = page && !Array.isArray(page) ? parseInt(page) : 1);
    },
    nextPage(): void {
      this.page++;
      this.addParamsToLocation("page", this.page.toString());
    },
    prevPage(): void {
      this.page--;
      this.addParamsToLocation("page", this.page.toString());
    },
  },
});
</script>

<style scoped></style>
