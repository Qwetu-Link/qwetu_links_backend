<?php

namespace App\Http\Resources\v1\finance;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PaymentResource extends JsonResource
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
            'businessID' => $this->business_id,
            'lease_id' => $this->lease_id,
            'amount' => $this->amount,
            'payment_date' => $this->payment_date,
            'payment_method' => $this->payment_method,
            'transaction_code' => $this->transaction_code,
            'type' => $this->type,
            'notes' => $this->notes,
        ];
    }
}
