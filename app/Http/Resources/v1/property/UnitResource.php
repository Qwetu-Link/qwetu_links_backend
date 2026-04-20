<?php

namespace App\Http\Resources\v1\property;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UnitResource extends JsonResource
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
            'unitNumber' => $this->unit_number,
            'unitFloor' => $this->unit_floor,
            'status' => $this->status,
            'rentAmount' => $this->rent_amount,
            'depositAmount' => $this->deposit_amount,
            'propertyID' => $this->property_id,
            'businessID' => $this->business_id,
        ];
    }
}
