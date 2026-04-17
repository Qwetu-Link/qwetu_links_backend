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
            'unit_number' => $this->unit_number,
            'unit_floor' => $this->unit_floor,
            'status' => $this->status,
            'rent_amount' => $this->rent_amount,
            'deposit_amount' => $this->deposit_amount,
            'property_id' => $this->property_id,
        ];
    }
}
