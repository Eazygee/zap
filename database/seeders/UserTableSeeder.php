<?php

namespace Database\Seeders;

use App\Models\User;
use App\Services\Auth\RegisterationService;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'first_name' => 'Zap',
                'last_name' => 'Coy',
                'email' => 'zap@test.com',
                'password' => 'password',
            ]
        ];

        foreach ($users as $key => $user) {
            RegisterationService::createUser($user);
        }
    }
}
