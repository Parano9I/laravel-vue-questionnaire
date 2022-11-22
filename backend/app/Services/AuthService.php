<?php

namespace App\Services;

use App\Contracts\IAuthService;
use App\Models\User;

class AuthService implements IAuthService
{

    public function login(array $credentials): string
    {
        // TODO: Implement login() method.
    }

    public function loginByUser(User $user): string
    {
        $token = $user->createToken($this->generateUniqueHex());

        return $token->plainTextToken;
    }

    private function generateUniqueHex():string{
        return bin2hex(random_bytes(30));
    }
}
