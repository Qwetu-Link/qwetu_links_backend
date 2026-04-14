<?php

namespace App\Http\Resources\v1\accounts;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StaffResource extends JsonResource
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
            'position' => $this->position,
            'department' => $this->department,
            'salary' => $this->salary,
            'hireDate' => $this->hire_date,
            'employmentType' => $this->employment_type,
        ];
    }
}
