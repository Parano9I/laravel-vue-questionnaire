<?php

namespace App\Http\Controllers;

use App\Contracts\IAuthService;
use App\Contracts\IUserService;
use App\Http\Requests\StoreUserRequest;
use App\Http\Resources\UserResource;

class UserController extends Controller
{

    public function __construct(
        private IUserService $userService,
        private IAuthService $authService
    ) {
    }

    public function store(StoreUserRequest $request)
    {
        $data = $request->toArray();
        $user = $this->userService->create($data);
        $token = $this->authService->createToken($user);

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
