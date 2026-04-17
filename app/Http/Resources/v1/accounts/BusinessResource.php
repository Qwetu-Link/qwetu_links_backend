<?php

namespace App\Http\Resources\v1\accounts;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BusinessResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'email' => $this->email,
            'phone' => $this->phone,
            'country' => $this->country,
            'city' => $this->city,
            'address' => $this->address,
            'bankName' => $this->bank_name,
            'bankAccountNumber' => $this->bank_account_number,
            'mpesaPaybill' => $this->mpesa_paybill,
            'mpesaAccountNumber' => $this->mpesa_account_number,
            'mpesaTillNo' => $this->mpesa_till_no,
            'isActive' => $this->is_active,
            'users' => UserResource::collection($this->whenLoaded('users')),
        ];
    }
}
