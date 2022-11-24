<?php

namespace App\Contracts;

use App\Models\Questionnaire;
use Illuminate\Database\Eloquent\Collection;

interface IQuestionnaireService
{
    public function getAll():Collection;

    public function getById(int $id):Questionnaire;

    public function create(array $data):void;
}
