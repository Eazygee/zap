<?php

namespace App\Services\Auth;

use App\Models\User;
use App\Services\Media\FileService;
use App\Services\Notifications\AppMailerService;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class UserService
{
    public User $user;

    public static function init(): self
    {
        return app()->make(self::class);
    }

    public static function validate(array $data, $id = null): array
    {
        $validator = Validator::make($data, [
            "first_name" => "nullable|string|" . Rule::requiredIf(empty($id)),
            "last_name" => "nullable|string|" . Rule::requiredIf(empty($id)),
            "phone" => "nullable|string|unique:users,phone,$id|" . Rule::requiredIf(empty($id)),
            "email" => "nullable|email|unique:users,email,$id|" . Rule::requiredIf(empty($id)),
            'old_password' => [
                'nullable', function ($attribute, $value, $fail) {
                    if (!Hash::check($value, auth()->user()->password)) {
                        $fail('Old Password didn\'t match');
                    }
                },
            ],

            'password' => [
                'nullable', 'different:old_password'
            ]

        ]);

        $validator->sometimes('password', 'required|confirmed', function ($input) {
            return (strlen($input->old_password) > 0);
        });

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        return $validator->validated();
    }

    /**
     *  Update the user
     */

    public static function store(array $data)
    {
        $data = self::validate($data);
        $user = RegisterationService::createUser($data);
        return $user;
    }
    public static function update(array $data, $id)
    {
        $data = self::validate($data, $id);

        $user = User::find($id);

        if (empty($data["old_password"])) {
            unset($data["old_password"]);
            unset($data["password"]);

        } else if (!empty($data["old_password"]) && empty($data["password"])) {
            unset($data["old_password"]);
            unset($data["password"]);

        } else if (!empty($data['password'] && $data["old_password"])) {
            $data["password"] = Hash::make($data['password'] ?? null);
            unset($data["old_password"]);
        }

        $user->update($data);
        return $user;
    }
}
