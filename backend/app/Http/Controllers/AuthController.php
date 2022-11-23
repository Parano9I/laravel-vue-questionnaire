<?php

namespace App\Http\Controllers;

use App\Contracts\IAuthService;
use App\Http\Requests\LoginAuthRequest;
use App\Http\Resources\UserResource;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;

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
        } catch (AuthenticationException $error) {
            return response()->json([
                'status' => 'error',
                'message' => $error->getMessage()
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

    public function logout(Request $request)
    {
        $user = $request->user();
        $this->authService->revokeAccessToken($user);

        return response()->json([
            'status' => 'access',
            'message' => 'Access token is revoke'
        ], 200);
    }
}
