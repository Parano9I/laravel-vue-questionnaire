<template>
  <container-component>
    <h1>Geography</h1>
    <ul class="w-100 list-group d-flex flex-column align-items-stretch">
      <template v-for="question in questions" :key="question.id">
        <question-item
          :question-id="question.id"
          :question-text="question.body"
        />
      </template>
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
import * as questionnaireApi from "@/services/http/api/questionnaire";
import router from "@/router";
import { useStore } from "vuex";
import { AnswerInterface } from "@/interfaces/answers";

export default defineComponent({
  name: "QuestionnaireView",
  components: { QuestionItem, ButtonComponent, ContainerComponent },
  data() {
    return {
      store: useStore(),
      questions: [],
      questionnaireId: -1,
      page: 1,
      maxPage: 1,
    };
  },
  async mounted() {
    this.setQuestionnaireId();
    this.page = this.setCurrentPage();
    await this.getQuests();
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
    setCurrentPage(): number {
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
    setQuestionnaireId(): void {
      const urlParamId = this.$route.params.id;

      if (urlParamId && !Array.isArray(urlParamId)) {
        this.questionnaireId = parseInt(urlParamId);
        this.store.dispatch("setQuestionnaireId", this.questionnaireId);
      }

      if (this.questionnaireId === -1) router.push({ name: "home" });
    },
    async getQuests() {
      if (this.questionnaireId) {
        const res = await questionnaireApi.getQuestionnaireQuests(
          this.questionnaireId,
          this.page
        );
        const { questionnaire, questions, pagination } = res.data.data;

        this.maxPage = pagination.lastPage;
        this.questions = questions;
      }
    },
  },
  watch: {
    page(newPage, oldPage) {
      this.getQuests();
    },
  },
});
</script>

<style scoped></style>
