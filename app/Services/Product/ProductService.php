<?php

namespace App\Services\Product;

use App\Constants\General\StatusConstants;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class ProductService
{

    public static function validate(array $data, $id = null): array
    {
        $validator = Validator::make($data, [
            "status" => "required|string|" . Rule::in(StatusConstants::ACTIVE_OPTIONS),
            "user_id" => "required|exists:users,id",
            "name" => "required|string",
            "description" => "required|string",
            "price" => "required|numeric|gt:0",
            "discount" => "nullable|numeric|gt:-1",
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        return $validator->validated();
    }
    public static function create(array $data): Product
    {
        $data = self::validate($data);
        $data["reference"] = self::generateReference();
        $product = Product::create($data);
        return $product;
    }

    public static function update(array $data, $id): Product
    {
        $data = self::validate($data, $id);
        $product = Product::find($id);
        $product->update($data);
        return $product->refresh();
    }

    public static function generateReference(){
        $code = strtoupper(getRandomToken(6));
        if(Product::where("reference" , $code)->count() > 0){
            return self::generateReference();
        }
        return $code;
    }
}
