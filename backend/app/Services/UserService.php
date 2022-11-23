<?php

namespace App\Services;

use App\Contracts\IUserService;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService implements IUserService
{

    public function create(array $data): User
    {
        $user = new User();

        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);
        $user->save();

        return $user;
    }
}
