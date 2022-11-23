<?php

namespace App\Http\Controllers;

use App\Contracts\IAuthService;
use App\Contracts\IUserService;
use App\Http\Requests\StoreUserRequest;
use App\Http\Resources\UserResource;
use PhpParser\Error;

class UserController extends Controller
{

    public function __construct(
        private IUserService $userService,
        private IAuthService $authService
    ) {
    }

    public function store(StoreUserRequest $request)
    {
        try {
            $data = $request->toArray();
            $user = $this->userService->create($data);
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
