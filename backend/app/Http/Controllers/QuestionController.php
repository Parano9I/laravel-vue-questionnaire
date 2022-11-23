<?php

namespace App\Http\Controllers;

use App\Contracts\IQuestionnaireService;
use App\Contracts\IQuestionService;
use App\Http\Resources\PaginationResource;
use App\Http\Resources\QuestionResource;
use App\Http\Resources\QuestioonnaireResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class QuestionController extends Controller
{

    public function __construct(
        private IQuestionService $questionService,
        private IQuestionnaireService $questionnaireService
    ) {
    }

    public function index(Request $request, $questionnaireId)
    {
        try {
            $questionnaire = $this->questionnaireService->getById($questionnaireId);
            $questions = $this->questionService->getAll($questionnaire);
        } catch (ModelNotFoundException $exception) {
        }

        return response()->json([
            'status' => 'access',
            'data' => [
                'questionnaire' => new QuestioonnaireResource($questionnaire),
                'questions' => QuestionResource::collection($questions),
                'pagination' => [
                    'currentPage' => $questions->currentPage(),
                    'total' => $questions->total(),
                    'lastPage' => $questions->lastPage()
                ]
            ]
        ]);
    }
}
