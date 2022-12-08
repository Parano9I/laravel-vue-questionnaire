<?php

namespace App\Http\Controllers;

use App\Contracts\IQuestionnaireService;
use App\Http\Resources\QuestionnaireResource;
use Illuminate\Http\Request;

class QuestionnaireController extends Controller
{

    public function __construct(
        private IQuestionnaireService $questionnaireService
    ) {
    }

    public function index(Request $request)
    {
        $user = $request->user();

        $data = $this->questionnaireService->getAll();

        return response()->json([
            'status' => 'access',
            'data' => QuestionnaireResource::collection($data),
        ]);
    }
}
