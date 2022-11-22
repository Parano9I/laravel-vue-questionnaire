<?php

namespace App\Contracts;

use App\Models\User;

interface IUserService
{
    public function create(array $data):User;
}
