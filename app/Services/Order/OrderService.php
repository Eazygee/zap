<?php

namespace App\Services\Order;

use App\Constants\General\StatusConstants;
use App\Exceptions\OrderException;
use App\Models\Order;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class OrderService
{
    public static function validate(array $data, $id = null)
    {
        $validator = Validator::make($data, [
            "user_id" => "required|exists:users,id",
            "reference" => "nullable|string",
            "status" => "nullable|string",
            "items" => "nullable|array",
            "amount" => "nullable|integer",
            "delivery_address_id" => "required|exists:delivery_addresses,id",
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        return $validator->validated();
    }

    public static function create($data): Order
    {
        DB::beginTransaction();
        try {
            $items = $data["items"];
            $data = self::validate($data);
            $data["reference"] = self::generateReference();
            $data["status"] = StatusConstants::PENDING;
            $data["amount"] = 0;
            unset($data["items"]);
            $order = Order::create($data);
            OrderItemsService::create($order, $items);

            DB::commit();
            return $order;
        } catch (Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public static function update($data, $id): Order
    {
        DB::beginTransaction();
        try {
            $items = $data["items"];
            $data = self::validate($data);
            $data["amount"] = 0;
            unset($data["items"]);
            $order = Order::find($id);
            $order->update($data);
            OrderItemsService::update($order, $items);

            DB::commit();
            return $order;
        } catch (Exception $e) {
            DB::rollback();
            throw $e;
        }
    }
    public static function generateReference()
    {
        $code = strtoupper(getRandomToken(6));
        if (Order::where("reference", $code)->count() > 0) {
            return self::generateReference();
        }
        return $code;
    }

    public static function getById($id): Order
    {
        $order = Order::find($id);
        if (empty($order)) {
            throw new OrderException("Order not found");
        }
        return $order;
    }

    public static function getByReference($reference): Order
    {
        return Order::where("reference", $reference)->first();
    }

}
