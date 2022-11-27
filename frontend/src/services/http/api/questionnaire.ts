import httpClient from "@/services/http";

const url = "/questionnaires";

const getAll = () => {
  return httpClient.get(url);
};

const getQuestionnaireQuests = (id: number, page: number) => {
  return httpClient.get(`${url}/${id}/questions`, { params: { page } });
};

export { getAll, getQuestionnaireQuests };
