<?php

namespace App\Services\Order;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;

class OrderItemsService
{
    public static function create(Order $order, $items_array)
    {
        $getTotal = 0;
        foreach ($items_array as $item) {
            $product = Product::find($item["product_id"]);
            $quantity = $item["quantity"];
            $item_unit_price = $product->price;
            $getTotal = $quantity * $item_unit_price;
            $order_item = OrderItem::create([
                "order_id" => $order->id,
                "user_id" => $order->user_id,
                "product_id" => $product->id,
                "product_name" => $product->name,
                "unit_price" => $item_unit_price,
                "discount" => $product->discount,
                "quantity" => $quantity,
                "total" => $getTotal,
            ]);
        }
        $items_total = OrderItem::where("order_id", $order->id)->pluck("total")->toArray();
        $sum = array_sum($items_total);
        $order->update(["amount" => $sum]);
    }

    public static function update(Order $order, $items_array)
    {
        $getTotal = 0;
        foreach ($items_array as $item) {
            $product = Product::find($item["product_id"]);
            $quantity = $item["quantity"];
            $item_unit_price = $product->price;
            $getTotal = $quantity * $item_unit_price;
            OrderItem::where("order_id", $order->id)->update([
                "product_id" => $product->id,
                "product_name" => $product->name,
                "unit_price" => $item_unit_price,
                "discount" => $product->discount,
                "quantity" => $quantity,
                "total" => $getTotal,
            ]);
        }
        $items_total = OrderItem::where("order_id", $order->id)->pluck("total")->toArray();
        $sum = array_sum($items_total);
        $order->update(["amount" => $sum]);
    }
}
