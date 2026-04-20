<?php

namespace App\Http\Resources\v1\property;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GalleryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'imageUrl' => $this->image_url,
            'propertyID' => $this->property_id,
            'title' => $this->title,
            'description' => $this->description,
            'isHighlight' => $this->is_highlight,
            'businessID' => $this->business_id,
        ];
    }
}
