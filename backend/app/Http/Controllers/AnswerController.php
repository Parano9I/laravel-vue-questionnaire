<?php

namespace App\Http\Controllers;

use App\Contracts\IAnswerService;
use App\Contracts\IQuestionnaireService;
use App\Http\Requests\StoreAllAnswerRequest;

class AnswerController extends Controller
{

    public function __construct(
        private IQuestionnaireService $questionnaireService,
        private IAnswerService $answerService
    ) {
    }

    public function storeAll(StoreAllAnswerRequest $request, $questionnaireId)
    {
        $user = $request->user();
        $data = $request->toArray();
        $questionnaire = $this->questionnaireService->getById($questionnaireId);
        $this->answerService->createAll($questionnaire, $user, $data);

        return response()->json([
            'status' => 'success'
        ]);
    }
}
