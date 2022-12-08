import router from "@/router";

const useGetQuestionnaireId = (callback: (id: number) => void): void => {
  const urlParamId = router.currentRoute.value.params.id;
  let questionnaireId;

  if (urlParamId && !Array.isArray(urlParamId)) {
    const questionnaireId = parseInt(urlParamId);
    return callback(questionnaireId);
  }

  if (questionnaireId === -1) router.push({ name: "home" });
};

export default useGetQuestionnaireId;
