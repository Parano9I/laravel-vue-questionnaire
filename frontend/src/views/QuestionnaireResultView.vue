<template>
  <container-component>
    <questionnaire-result-chart :data="answers" height="400px" />
  </container-component>
</template>

<script lang="ts">
import { defineComponent } from "vue";
import ContainerComponent from "@/components/Container/ContainerComponent.vue";
import useGetQuestionnaireId from "@/hooks/getQuestionnaireIdHook";
import * as questionnaireApi from "@/services/http/api/questionnaire";
import QuestionnaireResultChart from "@/components/UI/Charts/QuestionnaireResultChart.vue";

export default defineComponent({
  name: "QuestionnaireResultView",
  components: {
    QuestionnaireResultChart,
    ContainerComponent,
  },
  data() {
    return {
      questionnaireId: -1,
      answers: [],
    };
  },
  async mounted() {
    useGetQuestionnaireId((id) => {
      this.questionnaireId = id;
    });
    await this.getResult();
  },
  methods: {
    async getResult() {
      try {
        const res = await questionnaireApi.getResult(this.questionnaireId);
        const data = res.data.data;
        this.answers = data.answers;
      } catch (error) {
        console.log(error);
      }
    },
  },
});
</script>

<style scoped></style>
