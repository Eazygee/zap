<?php

namespace App\Http\Resources\Delivery;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DeliveryAddressResource extends JsonResource
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
            "name" => $this->name,
            "email" => $this->email,
            "apartment_no" => $this->apartment_no,
            "address" => $this->address,
            "zip_code" => $this->zip_code,
            "city" => $this->city,
            "state" => $this->state,
            "country" => $this->country,
            "phone" => $this->phone,
        ];
    }
}
