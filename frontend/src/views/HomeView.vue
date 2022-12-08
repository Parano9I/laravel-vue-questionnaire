<template>
  <container-component>
    <div class="d-flex flex-column align-items-start">
      <h1 class="">Questionnaires</h1>
      <ul class="w-100 list-group d-flex flex-column align-items-stretch">
        <li
          v-for="questionnaire in questionnaires"
          :key="questionnaire.id"
          class="list-group-item d-flex align-items-start"
        >
          <router-link
            :to="questionnaireLink(questionnaire.id)"
            class="h3 m-0 text-decoration-none"
          >
            {{ questionnaire.title }}
          </router-link>
        </li>
      </ul>
    </div>
  </container-component>
</template>

<script lang="ts">
import { defineComponent } from "vue";
import ContainerComponent from "@/components/Container/ContainerComponent.vue";
import * as questionnaireApi from "@/services/http/api/questionnaire";

export default defineComponent({
  name: "HomeView",
  components: { ContainerComponent },
  data: function () {
    return {
      questionnaires: [],
    };
  },
  async mounted() {
    await this.getQuestionnaires();
  },
  methods: {
    async getQuestionnaires() {
      const res = await questionnaireApi.getAll();
      this.questionnaires = res.data.data;
    },
    questionnaireLink(id: string): string {
      return `/questionnaire/${id}`;
    },
  },
  computed: {},
});
</script>
