<?php

namespace App\Services;

use App\Contracts\IQuestionnaireService;
use App\Exceptions\NotFoundQuestionnaireException;
use App\Models\Questionnaire;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class QuestionnaireService implements IQuestionnaireService
{
    public function getAll(): Collection
    {
        return Questionnaire::all();
    }

    public function create(array $data): void
    {
    }

    public function getById(int $id): Questionnaire
    {
        try{
            return Questionnaire::query()->findOrFail($id)->first();
        } catch (ModelNotFoundException $e){
            throw new NotFoundQuestionnaireException($id);
        }
    }
}
