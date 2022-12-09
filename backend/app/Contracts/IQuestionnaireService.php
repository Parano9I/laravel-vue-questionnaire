<?php

namespace App\Contracts;

use App\Models\Questionnaire;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as SupportCollection;

interface IQuestionnaireService
{
    public function getAll():Collection;

    public function getAllByUser($userId):SupportCollection;

    public function getById(int $id):Questionnaire;

    public function create(array $data):void;
}
