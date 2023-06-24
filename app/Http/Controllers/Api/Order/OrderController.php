<?php

namespace App\Http\Controllers\Api\Order;

use App\Constants\General\ApiConstants;
use App\Exceptions\OrderException;
use App\Helpers\ApiHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\Order\OrderResource;
use App\Models\Order;
use App\Services\Order\OrderService;
use Exception;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function list(){
        try {
            $orders = Order::with("items")->where("user_id", auth()->id())->get();
            $data = OrderResource::collection($orders);
            return ApiHelper::validResponse("Orders retreived successfully", $data);
        } catch (Exception $e) {
            $message = 'Something went wrong while processing your request.';
            return ApiHelper::problemResponse($message, ApiConstants::BAD_REQ_ERR_CODE, null, $e);
        }
    }
    public function create(Request $request){
        try {
            $data = $request->all();
            $data["user_id"] = auth()->id();
            $order = OrderService::create($data);
            $data = OrderResource::make($order);
            return ApiHelper::validResponse("Order created successfully", $data);
        } catch (OrderException $e) {
            return ApiHelper::problemResponse($e->getMessage(), ApiConstants::BAD_REQ_ERR_CODE, null, $e);
        }catch (Exception $e) {
            $message = 'Something went wrong while processing your request.';
            return ApiHelper::problemResponse($message, ApiConstants::BAD_REQ_ERR_CODE, null, $e);
        }
    }

    public function single($id){
        try {
            $order = OrderService::getById($id);
            $data = OrderResource::make($order);
            return ApiHelper::validResponse("Order retreived successfully", $data);
        } catch (OrderException $e) {
            return ApiHelper::problemResponse($e->getMessage(), ApiConstants::BAD_REQ_ERR_CODE, null, $e);
        }catch (Exception $e) {
            $message = 'Something went wrong while processing your request.';
            return ApiHelper::problemResponse($message, ApiConstants::BAD_REQ_ERR_CODE, null, $e);
        }
    }
}
