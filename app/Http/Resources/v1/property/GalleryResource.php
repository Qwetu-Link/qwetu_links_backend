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
            'image_url' => $this->image_url,
            'property_id' => $this->property_id,
            'title' => $this->title,
            'description' => $this->description,
            'is_highlight' => $this->is_highlight,
        ];
    }
}
