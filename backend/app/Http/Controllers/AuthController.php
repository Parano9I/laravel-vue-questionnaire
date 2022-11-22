<?php

namespace App\Http\Controllers;

use App\Contracts\IAuthService;
use App\Http\Requests\LoginAuthRequest;
use App\Http\Resources\UserResource;
use PhpParser\Error;

class AuthController extends Controller
{

    public function __construct(
        private IAuthService $authService
    ) {
    }

    public function login(LoginAuthRequest $request)
    {
        try {
            $credentials = $request->only(['email', 'password']);
            $user = $this->authService->login($credentials);
            $token = $this->authService->createToken($user);
        } catch (Error $error) {
            return response()->json([
                'status' => 'error',
                'message' => $error
            ], 401);
        }

        return response()->json([
            'status' => 'success',
            'data' => [
                'user' => new UserResource($user),
                'tokens' => [
                    'type' => 'Bearer',
                    'access_token' => $token
                ]
            ]
        ], 200);
    }
}
