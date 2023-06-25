<?php

namespace App\Http\Resources\Order;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderItemsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "product_name" => $this->product_name,
            "unit_price" => $this->unit_price,
            "discount" => $this->discount,
            "quantity" => $this->unit_price,
            "total" => $this->total,
            "unit_price" => $this->unit_price,
        ];
    }
}
