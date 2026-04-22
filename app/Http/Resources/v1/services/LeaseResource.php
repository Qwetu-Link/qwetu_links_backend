<?php

namespace App\Http\Resources\v1\services;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LeaseResource extends JsonResource
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
            'tenantID' => $this->tenant_id,
            'unitID' => $this->unit_id,
            'startDate' => $this->start_date,
            'endDate' => $this->end_date,
            'rentDmount' => $this->rent_amount,
            'depositAmount' => $this->deposit_amount,
            'nextDueDate' => $this->next_due_date,
            'gracePeriodDays' => $this->grace_period_days,
            'lateFee' => $this->late_fee,
            'notes' => $this->notes,
            'status' => $this->status,
        ];
    }
}
