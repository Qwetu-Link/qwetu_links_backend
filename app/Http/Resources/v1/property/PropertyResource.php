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
            'apartmentType' => $this->apartment_type,
            'bedrooms' => $this->bedrooms,
            'bathrooms' => $this->bathrooms,
            'squareMeters' => $this->square_meters,
            'businessID' => $this->business_id,
            'amenities' => new PropertyAmenityResource($this->whenLoaded('amenities')),
            'units' => new UnitResource($this->whenLoaded('units')),
            'gallery' => new GalleryResource($this->whenLoaded('gallery')),
        ];
    }
}
