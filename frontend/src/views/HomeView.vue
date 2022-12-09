<template>
  <container-component>
    <div class="d-flex flex-column align-items-start">
      <h1 class="">Questionnaires</h1>
      <ul class="w-100 list-group d-flex flex-column align-items-stretch">
        <li v-for="q in questionnaires" :key="q.id" class="list-group-item">
          <questionnaire-item
            :id="q.id"
            :is-verified="q.is_verified"
            :total-score="q.total_score"
            >{{ q.title }}</questionnaire-item
          >
        </li>
      </ul>
    </div>
  </container-component>
</template>

<script lang="ts">
import { defineComponent } from "vue";
import ContainerComponent from "@/components/Container/ContainerComponent.vue";
import * as questionnaireApi from "@/services/http/api/questionnaire";
import QuestionnaireItem from "@/components/Questionnaire/QuestionnaireItem.vue";

export default defineComponent({
  name: "HomeView",
  components: { QuestionnaireItem, ContainerComponent },
  data: function () {
    return {
      questionnaires: [],
    };
  },
  async mounted() {
    await this.getQuestionnaires();

    console.log(this.questionnaires);
  },
  methods: {
    async getQuestionnaires() {
      const res = await questionnaireApi.getAll();
      this.questionnaires = res.data.data;
    },
  },
});
</script>
