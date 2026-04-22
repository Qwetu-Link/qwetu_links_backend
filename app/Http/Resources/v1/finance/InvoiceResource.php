<?php

namespace App\Http\Resources\v1\finance;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InvoiceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'leaseID' => $this->lease_id,
            'tenantID' => $this->tenant_id,
            'invoiceNumber' => $this->invoice_number,
            'amount' => $this->amount,
            'paidAmount' => $this->paid_amount,
            'balance' => $this->balance,
            'issueDate' => $this->issue_date,
            'dueDate' => $this->due_date,
            'status' => $this->status,
            'notes' => $this->notes,
            'businessID' => $this->business_id,
        ];
    }
}
