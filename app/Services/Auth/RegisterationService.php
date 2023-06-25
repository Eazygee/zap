<?php

namespace App\Services\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterationService
{
    public static function createUser($data): User
    {

        $data["password"] = Hash::make($data['password']);
        unset($data["password_confirmation"]);
        return User::create($data);
    }
}
