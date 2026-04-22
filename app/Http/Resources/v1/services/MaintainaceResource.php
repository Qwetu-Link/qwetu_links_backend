<?php

namespace App\Http\Resources\v1\services;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MaintainaceResource extends JsonResource
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
            'unitID' => $this->unit_id,
            'tenantID' => $this->tenant_id,
            'title' => $this->title,
            'issue' => $this->issue,
            'priority' => $this->priority,
            'status' => $this->status,
            'reportedDate' => $this->reported_date,
            'resolvedDate' => $this->resolved_date,
            'cost' => $this->cost,
            'notes' => $this->notes,
        ];
    }
}
