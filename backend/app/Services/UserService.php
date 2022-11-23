<?php

namespace App\Services;

use App\Contracts\IUserService;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService implements IUserService
{

    public function create(array $data): User
    {
        $user = new User();
        $roleUser = Role::where(['name' => 'ROLE_USER'])->firstOrFail();

        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);
        $user->role()->associate($roleUser);
        $user->save();

        return $user;
    }
}
