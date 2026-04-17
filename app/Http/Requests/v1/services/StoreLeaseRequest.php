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
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'unit_number' => 'required|string|max:50',
            'rent_amount' => 'required|numeric|min:0',
            'lease_start' => 'required|date',
            'lease_end' => 'required|date|after_or_equal:lease_start',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            // 'user_id' => $this->userID,
            'unit_number' => $this->unitNumber,
            'rent_amount' => $this->rentAmount,
            'lease_start' => $this->leaseStart,
            'lease_end' => $this->leaseEnd,
        ]);
    }
}
