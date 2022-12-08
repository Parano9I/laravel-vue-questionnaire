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
        <button-component v-if="isShowFinishButton" v-on:click="handleSubmit"
          >Finish</button-component
        >
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
import { useStore } from "vuex";
import useGetQuestionnaireId from "@/hooks/getQuestionnaireIdHook";

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
      questionsTotal: 0,
    };
  },
  async mounted() {
    useGetQuestionnaireId((id) => {
      this.questionnaireId = id;
      this.store.dispatch("setQuestionnaireId", this.questionnaireId);
    });
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
    isShowFinishButton(): boolean {
      return this.page === this.maxPage;
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
    async getQuests() {
      if (this.questionnaireId) {
        const res = await questionnaireApi.getQuestionnaireQuests(
          this.questionnaireId,
          this.page
        );
        const { questionnaire, questions, pagination } = res.data.data;

        this.maxPage = pagination.lastPage;
        this.questionsTotal = pagination.total;
        this.questions = questions;
      }
    },
    async handleSubmit() {
      if (this.store.getters.getAnswersCount < this.questionsTotal) {
        alert("Error count answers < total");
      } else {
        await this.store.dispatch("potsAnswers");
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
