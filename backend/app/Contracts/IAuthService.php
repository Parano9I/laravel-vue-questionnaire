<?php

namespace App\Contracts;

use App\Models\User;

interface IAuthService
{
    public function login(array $credentials): User;

    public function createToken(User $user): string;

    public function revokeAccessToken(User $user):void;
}
