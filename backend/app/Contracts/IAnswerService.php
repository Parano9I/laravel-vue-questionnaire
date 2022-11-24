<?php

namespace App\Contracts;

use App\Models\Questionnaire;
use App\Models\User;

interface IAnswerService
{
    public function createAll(Questionnaire $questionnaire, User $user, array $data):void;
}
