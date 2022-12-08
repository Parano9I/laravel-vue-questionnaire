import { Module } from "vuex";
import { AnswerInterface } from "@/interfaces/answers";
import * as questionnaireApi from "@/services/http/api/questionnaire";

interface AnswersState {
  questionnaireId: number | null;
  answers: AnswerInterface[];
}

const answersModuleStore: Module<AnswersState, any> = {
  state: {
    questionnaireId: null,
    answers: [],
  },
  getters: {
    getAnswers(state: AnswersState): AnswerInterface[] {
      return state.answers;
    },
    getAnswersCount(state: AnswersState): number {
      return state.answers.length;
    },
    getAnswerById(state: AnswersState): (id: number) => AnswerInterface | null {
      return (id: number): AnswerInterface | null => {
        const answer = state.answers.find((answer) => answer.questionId === id);
        return answer || null;
      };
    },
    getQuestionnaireId(state: AnswersState): number | null {
      return state.questionnaireId;
    },
  },
  mutations: {
    addAnswer(state: AnswersState, payload: AnswerInterface) {
      state.answers = [...state.answers, payload];
    },
    updateAnswer(state: AnswersState, payload: AnswerInterface) {
      state.answers = state.answers.map((answer) => {
        if (answer.questionId === payload.questionId) {
          return { ...answer, answer: payload.answer };
        }
        return answer;
      });
    },
    setQuestionnaireId(state: AnswersState, payload: number) {
      state.questionnaireId = payload;
    },
    resetQuestionnaireId(state: AnswersState) {
      state.questionnaireId = null;
    },
    resetAnswers(state: AnswersState) {
      state.answers = [];
    },
  },
  actions: {
    setQuestionnaireId({ commit, state }, payload: number) {
      if (!state.questionnaireId) {
        commit("setQuestionnaireId", payload);
      } else if (state.questionnaireId !== payload) {
        commit("resetAnswers");
        commit("setQuestionnaireId", payload);
      }
    },
    addAnswer({ commit, getters }, payload: AnswerInterface) {
      if (getters.getAnswerById(payload.questionId)) {
        commit("updateAnswer", payload);
      } else {
        commit("addAnswer", payload);
      }
    },
    async potsAnswers({ commit, getters }) {
      try {
        const params = { answers: getters.getAnswers };
        const questionnaireId = getters.getQuestionnaireId;
        const res = questionnaireApi.postAnswers(params, questionnaireId);
        commit("resetAnswers");
      } catch (error) {
        console.log(error);
      }
    },
  },
};

export default answersModuleStore;
