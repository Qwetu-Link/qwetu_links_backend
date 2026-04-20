<?php

namespace App\Http\Resources\v1\accounts;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            // 'businessID' => $this->business_id,
            'name' => $this->name,
            'email' => $this->email,
            // 'password' => $this->password,
            'role' => $this->role,
            // 'phone' => $this->phone,
            // 'emergencyContactName' => $this->emergency_contact_name,
            // 'emergencyContactPhone' => $this->emergency_contact_phone,
            // 'emergencyContactRelationship' => $this->emergency_contact_relationship,
            // 'idNumber' => $this->id_number,
            // 'address' => $this->address,
            // 'avatar' => $this->avatar,
            'isActive' => $this->is_active,
            'staff' => new StaffResource($this->whenLoaded('staff')),
            'tenant' => new TenantResource($this->whenLoaded('tenant')),
        ];
    }
}
