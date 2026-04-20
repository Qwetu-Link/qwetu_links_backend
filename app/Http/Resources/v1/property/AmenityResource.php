<?php

namespace App\Http\Resources\v1\property;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AmenityResource extends JsonResource
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
            'icon' => $this->icon,
            'category' => $this->category,
            'description' => $this->description,
            'businessID' => $this->business_id,
        ];
    }
}
