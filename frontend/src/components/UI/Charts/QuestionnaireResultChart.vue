<template>
  <Bar
    :chart-options="chartOptions"
    :chart-data="chartData"
    :chart-id="chartId"
    :dataset-id-key="datasetIdKey"
    :style="style"
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
import { types } from "sass";
import Color = types.Color;

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
    answers_avg_point: string;
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
        maintainAspectRatio: false,
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
      type: String,
      default: "",
    },
    height: {
      type: String,
      default: "",
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
        datasets: [this.chartValues],
      };
    },
    chartLabels(): number[] {
      return (this.data as AnswerInterface[]).map(
        (item: AnswerInterface) => item.question.id
      );
    },
    chartValues(): object {
      return {
        label: "Average point by each answer",
        backgroundColor: "#9c0730",
        data: (this.data as AnswerInterface[]).map((item: AnswerInterface) =>
          this.formattedValue(item.question.answers_avg_point)
        ),
      };
    },
    style(): object {
      return {
        height: this.height,
        width: this.width,
        position: "relative",
      };
    },
  },
  methods: {
    formattedValue(value: string): number {
      return parseFloat(parseFloat(value).toFixed(2));
    },
  },
});
</script>

<style scoped></style>
