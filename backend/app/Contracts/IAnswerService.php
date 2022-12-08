<?php

namespace App\Contracts;

use App\Models\Questionnaire;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

interface IAnswerService
{
    public function createAll(Questionnaire $questionnaire, User $user, array $data):void;

    public function getResult(Questionnaire $questionnaire, User $user):Collection;
}
