<?php

namespace App\Services;

use App\Contracts\IQuestionnaireService;
use App\Models\Questionnaire;
use Illuminate\Database\Eloquent\Collection;

class QuestionnaireService implements IQuestionnaireService
{


    public function getAll(): Collection
    {
        return Questionnaire::all();
    }

    public function create(array $data): void
    {

    }
}
