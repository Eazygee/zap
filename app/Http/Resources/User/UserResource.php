<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => (int) $this->id,
            "first_name" => (string) $this->first_name,
            "last_name" => (string) $this->last_name,
            "email" => (string) $this->email,
            "phone" => (string) $this->phone,
        ];
    }
}
