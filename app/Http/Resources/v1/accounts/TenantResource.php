<?php

namespace App\Http\Resources\v1\accounts;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TenantResource extends JsonResource
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
            'userID' => $this->user_id,
            'unitNumber'=> $this->unit_number,
            'rentAmount'=> $this->rent_amount,
            'leaseStart'=> $this->lease_start,
            'leaseEnd'=> $this->lease_end,
            'nextOfKinName'=> $this->next_of_kin_name,
            'nextOfKinPhone'=> $this->next_of_kin_phone,
            'isActive'=> $this->is_active,
        ];
    }
}
