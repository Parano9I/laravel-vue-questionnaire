<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Collection;

interface IQuestionnaireService
{
    public function getAll():Collection;

    public function create(array $data):void;
}
