import httpClient from "@/services/http";
import { AnswerInterface } from "@/interfaces/answers";
import { PostAnswersParams } from "@/services/http/models/questionnaireModel";

const url = "/questionnaires";

const getAll = () => {
  return httpClient.get(url);
};

const getQuestionnaireQuests = (id: number, page: number) => {
  return httpClient.get(`${url}/${id}/questions`, { params: { page } });
};

const postAnswers = (params: PostAnswersParams, questionnaireId: number) => {
  return httpClient.post(`${url}/${questionnaireId}/answer`, params);
};

const getResult = (questionnaireId: number) => {
  return httpClient.get(`${url}/${questionnaireId}/result`);
};

export { getAll, getQuestionnaireQuests, postAnswers, getResult };
