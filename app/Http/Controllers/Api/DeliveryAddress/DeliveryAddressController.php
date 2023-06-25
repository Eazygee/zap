<?php

namespace App\Http\Controllers\Api\DeliveryAddress;

use App\Constants\General\ApiConstants;
use App\Helpers\ApiHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\Delivery\DeliveryAddressResource;
use App\Models\DeliveryAddress;
use Exception;

class DeliveryAddressController extends Controller
{
    public function list(){
        try {
            $addresses = DeliveryAddress::get();
            $data = DeliveryAddressResource::collection($addresses);
            return ApiHelper::validResponse("My delivery addresses", $data);
        } catch (Exception $e) {
            $message = 'Something went wrong while processing your request.';
            return ApiHelper::problemResponse($message, ApiConstants::BAD_REQ_ERR_CODE, null, $e);
        }
    }
}
