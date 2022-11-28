<?php

namespace App\Http\Controllers;

use App\Contracts\IAnswerService;
use App\Contracts\IQuestionnaireService;
use App\Http\Requests\StoreAllAnswerRequest;
use App\Http\Resources\QuestionnaireResource;
use App\Http\Resources\QuestionWithAnswerResource;
use App\Models\User;
use Illuminate\Http\Request;

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

    public function indexResult(Request $request, $questionnaireId)
    {
//        $user = $request->user();
        $user = User::query()->findOrFail(9);
        $questionnaire = $this->questionnaireService->getById($questionnaireId);

        $data = $this->answerService->getResult($questionnaire, $user);

        return response()->json([
            'status' => 'success',
            'data' => [
                'questionnaire' => new QuestionnaireResource($questionnaire),
                'answers' => QuestionWithAnswerResource::collection($data),
            ]
        ]);
    }
}
