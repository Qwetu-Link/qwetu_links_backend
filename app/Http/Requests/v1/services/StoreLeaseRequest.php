<?php

namespace App\Http\Requests\v1\services;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreLeaseRequest extends FormRequest
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
            'tenant_id' => 'required|string|exists:tenants,id',
            'unit_id' => 'required|string|exists:units,id',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'rent_amount' => 'required|numeric|min:0',
            'deposit_amount' => 'nullable|numeric|min:0',
            'next_due_date' => 'nullable|date|after_or_equal:start_date',
            'grace_period_days' => 'nullable|integer|min:0',
            'late_fee' => 'nullable|numeric|min:0',
            'notes' => 'nullable|string',
            'status' => 'required|in:active,terminated,expired',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'tenant_id' => $this->tenantID,
            'unit_id' => $this->unitID,
            'start_date' => $this->startDate,
            'end_date' => $this->endDate,
            'rent_amount' => $this->rentAmount,
            'deposit_amount' => $this->depositAmount,
            'next_due_date' => $this->nextDueDate,
            'grace_period_days' => $this->gracePeriodDays,
            'late_fee' => $this->lateFee,
        ]);
    }
}
