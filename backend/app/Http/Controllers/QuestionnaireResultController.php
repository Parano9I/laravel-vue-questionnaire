<?php

namespace App\Http\Controllers;

use App\Contracts\IAnswerService;
use App\Contracts\IQuestionnaireService;
use App\Http\Resources\QuestionnaireResource;
use App\Http\Resources\QuestionWithAnswerResource;
use Illuminate\Http\Request;

class QuestionnaireResultController extends Controller
{

    public function __construct(
        private IQuestionnaireService $questionnaireService,
        private IAnswerService $answerService
    ) {
    }


    public function index(){

    }

    public function store(){

    }

    public function show(Request $request, $questionnaireId){
        $user = $request->user();
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
