<?php

namespace App\Http\Controllers\Api\Product;

use App\Constants\General\ApiConstants;
use App\Helpers\ApiHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\Product\ProductResource;
use App\Models\Product;
use Exception;

class ProductController extends Controller
{
    public function list(){
        try {
            $addresses = Product::get();
            $data = ProductResource::collection($addresses);
            return ApiHelper::validResponse("Product retreived successfully", $data);
        } catch (Exception $e) {
            $message = 'Something went wrong while processing your request.';
            return ApiHelper::problemResponse($message, ApiConstants::BAD_REQ_ERR_CODE, null, $e);
        }
    }
}
