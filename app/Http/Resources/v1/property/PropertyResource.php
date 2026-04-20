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
            'units' => UnitResource::collection($this->units),
            'gallery' => GalleryResource::collection($this->gallery),
            'amenities' => AmenityResource::collection($this->amenities),
            // 'amenities' => PropertyAmenityResource::collection(
            //     $this->whenLoaded('amenities')
            // ),

            // 'units' => UnitResource::collection(
            //     $this->whenLoaded('units')
            // ),

            // 'gallery' => GalleryResource::collection(
            //     $this->whenLoaded('gallery')
            // ),
        ];
    }
}
