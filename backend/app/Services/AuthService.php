<?php

namespace App\Services;

use App\Contracts\IAuthService;
use App\Exceptions\UserNotFoundException;
use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Auth;

class AuthService implements IAuthService
{

    public function login(array $credentials): User
    {
        if(!Auth::attempt($credentials)){
            throw new UserNotFoundException('Incorrect email or password');
        }

        $user = User::where(['email' => $credentials['email']])->first();

        return $user;
    }

    public function createToken(User $user): string
    {
        $token = $user->createToken($this->generateUniqueHex());

        return $token->plainTextToken;
    }

    public function revokeAccessToken(User $user): void
    {
        $user->currentAccessToken()->delete();
    }

    private function generateUniqueHex():string{
        return bin2hex(random_bytes(30));
    }
}
