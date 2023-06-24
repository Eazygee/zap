<?php

namespace App\Services\Auth;

use App\Constants\AppConstants;
use App\Exceptions\PinException;
use App\Exceptions\UserException;
use App\Models\Pin;
use App\Models\User;
use App\Services\Notifications\AppMailerService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AuthService
{
    public static function validate(array $data)
    {
        $validator = Validator::make($data, [
            'password' => 'required|min:6',
            'email' => 'required|email|exists:users,email',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
        return $validator->validated();
    }

    public static function action($data)
    {
        $data = self::validate($data);
        $user = User::where('email', $data["email"])->first();
        if (empty($user)) {
            throw new UserException("Email Address Cannot be found");
        }
        if (!Hash::check($data["password"], $user->password)) {
            throw new UserException("Invalid Credentials");
        }
        return $user;
    }

}
