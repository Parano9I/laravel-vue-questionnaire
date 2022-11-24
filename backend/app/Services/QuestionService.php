<?php

namespace App\Services;

use App\Contracts\IQuestionService;
use App\Models\Question;
use App\Models\Questionnaire;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class QuestionService implements IQuestionService
{

    public function getAll(Questionnaire $questionnaire):LengthAwarePaginator
    {
        $questions = $questionnaire->questions()->paginate(5);

        return $questions;
    }

    public function getById(int $id): Question
    {
        return Question::query()->findOrFail($id)->first();
    }

    public function create(array $data): void
    {
        // TODO: Implement create() method.
    }
}
