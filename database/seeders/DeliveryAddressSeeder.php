<?php

namespace Database\Seeders;

use App\Models\DeliveryAddress;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DeliveryAddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            "user_id" => User::first()->id,
            "name" => "James Peters",
            "email" => "testJames@gmail.com",
            "apartment_no" => "3b",
            "address" => "17A Akowonjo Lagos state Nigeria",
            "zip_code" => "100234",
            "city" => "Egbeda",
            "state" => "Lagos state",
            "country" => "Nigeria",
            "phone" => "0999999444",
            "is_default" => 1
        ];
        DeliveryAddress::create($data);
    }
}
