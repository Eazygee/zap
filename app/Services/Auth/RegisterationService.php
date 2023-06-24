<?php

namespace App\Services\Auth;

use App\Constants\AppConstants;
use App\Constants\StatusConstants;
use App\Models\User;
use App\Notifications\Auth\SignupNotification;
use App\Services\Portfolio\PortfolioService;
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
