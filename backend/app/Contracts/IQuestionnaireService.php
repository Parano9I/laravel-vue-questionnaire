<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection as SupportCollection;

interface IQuestionnaireService
{
    public function getAll(): Collection;

    public function getAllByUser($userId): SupportCollection;

    public function getById(int $id): Model;

    public function create(array $data): void;
}
