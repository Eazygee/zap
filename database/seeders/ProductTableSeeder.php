<?php

namespace Database\Seeders;

use App\Constants\General\StatusConstants;
use App\Models\User;
use App\Services\Product\ProductService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                "user_id" => User::first()->id,
                "name" => "Gucci Bag",
                "description" => "A fashion and eye-catching piece of beauty",
                "price" => 2000,
                "discount" => 0,
                "status" => StatusConstants::ACTIVE
            ],
            [
                "user_id" => User::first()->id,
                "name" => "Zap branded Notebooks",
                "description" => "Note book depot",
                "price" => 5000,
                "discount" => 0,
                "status" => StatusConstants::ACTIVE
            ],
            [
                "user_id" => User::first()->id,
                "name" => "Zap branded Tshirts",
                "description" => "Test Tshirt description",
                "price" => 10000,
                "discount" => 0,
                "status" => StatusConstants::ACTIVE
            ]
        ];

        foreach($data as $product){
            ProductService::create($product);
        }
    }
}
