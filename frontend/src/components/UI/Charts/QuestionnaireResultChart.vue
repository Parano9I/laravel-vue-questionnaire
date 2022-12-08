<template>
  <Bar
    :chart-options="chartOptions"
    :chart-data="chartData"
    :chart-id="chartId"
    :dataset-id-key="datasetIdKey"
    :width="width"
    :height="height"
  />
</template>

<script lang="ts">
import { defineComponent } from "vue";

import { Bar } from "vue-chartjs";
import {
  Chart as ChartJS,
  Title,
  Tooltip,
  Legend,
  BarElement,
  CategoryScale,
  LinearScale,
} from "chart.js";
import useGenerateRandomColor from "@/hooks/generateRandomColorHook";

ChartJS.register(
  Title,
  Tooltip,
  Legend,
  BarElement,
  CategoryScale,
  LinearScale
);

interface AnswerInterface {
  question: {
    id: number;
    title: string;
    answers_avg_point: number;
  };
  answer: {
    id: number;
    body: string;
    point: number;
  };
}

export default defineComponent({
  name: "QuestionnaireResultChart",
  components: { Bar },
  data() {
    return {
      chartOptions: {
        responsive: true,
      },
    };
  },
  props: {
    chartId: {
      type: String,
      default: "bar-chart",
    },
    datasetIdKey: {
      type: String,
      default: "label",
    },
    width: {
      type: Number,
      default: 200,
    },
    height: {
      type: Number,
      default: 200,
    },
    data: {
      type: Array,
      required: true,
    },
  },
  computed: {
    chartData(): object {
      return {
        labels: this.chartLabels,
        datasets: [{ data: this.chartValues }],
      };
    },
    chartLabels(): number[] {
      return (this.data as AnswerInterface[]).map(
        (item: AnswerInterface) => item.question.id
      );
    },
    chartValues(): object {
      return (this.data as AnswerInterface[]).map((item: AnswerInterface) => ({
        data: item.question.answers_avg_point,
        backgroundColor: useGenerateRandomColor(),
      }));
    },
  },
});
</script>

<style scoped></style>
