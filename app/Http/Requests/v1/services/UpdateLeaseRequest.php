<?php

namespace App\Http\Requests\v1\services;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateLeaseRequest extends FormRequest
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
        $method = $this->method();

        if ($method == 'PUT') {
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
        } else {
            return [
                'tenant_id' => 'sometimes|required|string|exists:tenants,id',
                'unit_id' => 'sometimes|required|string|exists:units,id',
                'start_date' => 'sometimes|required|date',
                'end_date' => 'sometimes|nullable|date|after_or_equal:start_date',
                'rent_amount' => 'sometimes|required|numeric|min:0',
                'deposit_amount' => 'sometimes|nullable|numeric|min:0',
                'next_due_date' => 'sometimes|nullable|date|after_or_equal:start_date',
                'grace_period_days' => 'sometimes|nullable|integer|min:0',
                'late_fee' => 'sometimes|nullable|numeric|min:0',
                'notes' => 'sometimes|nullable|string',
                'status' => 'sometimes|required|in:active,terminated,expired',
            ];
        }
    }

    protected function prepareForValidation()
    {
        $data = [];

        if ($this->has('unitID')) {
            $data['unit_id'] = $this->unitID;
        }

        if ($this->has('tenantID')) {
            $data['tenant_id'] = $this->tenantID;
        }

        if ($this->has('startDate')) {
            $data['start_date'] = $this->startDate;
        }

        if ($this->has('endDate')) {
            $data['end_date'] = $this->endDate;
        }

        if ($this->has('rentAmount')) {
            $data['rent_amount'] = $this->rentAmount;
        }

        if ($this->has('depositAmount')) {
            $data['deposit_amount'] = $this->depositAmount;
        }

         if ($this->has('nextDueDate')) {
            $data['next_due_date'] = $this->nextDueDate;
        }

        if ($this->has('gracePeriodDays')) {
            $data['grace_period_days'] = $this->gracePeriodDays;
        }

        if ($this->has('lateFee')) {
            $data['late_fee'] = $this->lateFee;
        }

        $this->merge($data);
    }
}
