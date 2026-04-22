<?php

namespace App\Http\Requests\v1\finance;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreInvoiceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'lease_id' => 'required', 'exists:leases,id',
            'tenant_id' => 'required', 'exists:tenants,id',
            'invoice_number' => 'required', 'string', 'max:50', 'unique:invoices,invoice_number',
            'amount' => 'required', 'numeric', 'min:0',
            'paid_amount' => 'nullable', 'numeric', 'min:0',
            'balance' => 'required', 'numeric', 'min:0',
            'issue_date' => 'required', 'date',
            'due_date' => 'required', 'date', 'after_or_equal:issue_date',
            'status' => 'required', 'in:pending,paid,partial,overdue',
            'notes' => 'nullable', 'string',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'lease_id' => $this->leaseID,
            'tenant_id' => $this->tenantID,
            'invoice_number' => $this->invoiceNumber,
            'issue_date' => $this->issueDate,
            'due_date' => $this->dueDate,
        ]);
    }
}
