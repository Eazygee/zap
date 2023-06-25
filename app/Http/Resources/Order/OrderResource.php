<?php

namespace App\Http\Resources\Order;

use App\Http\Resources\Delivery\DeliveryAddressResource;
use App\Http\Resources\User\UserResource;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            "customer" => UserResource::make($this->user),
            "items" => OrderItemsResource::collection($this->items),
            "delivery_address" => DeliveryAddressResource::make($this->deliveryAddress),
            "reference" => $this->reference,
            "status" => $this->status,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
        ];
    }
}
