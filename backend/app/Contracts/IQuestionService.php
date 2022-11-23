<?php

namespace App\Contracts;

use App\Models\Questionnaire;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface IQuestionService
{
    public function getAll(Questionnaire $questionnaire):LengthAwarePaginator;

    public function create(array $data):void;
}
