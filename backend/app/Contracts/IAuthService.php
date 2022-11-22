<?php

namespace App\Contracts;

use App\Models\User;

interface IAuthService
{
    public function login(array $credentials):string;

    public function loginByUser(User $user):string;
}
