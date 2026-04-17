<?php

namespace App\Http\Resources\v1\property;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PropertyResource extends JsonResource
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
            'address' => $this->address,
            'description' => $this->description,
            'location' => $this->location,
            'apartment_type' => $this->apartment_type,
            'bedrooms' => $this->bedrooms,
            'bathrooms' => $this->bathrooms,
            'square_meters' => $this->square_meters,
            'business_id' => $this->business_id,
        ];
    }
}
