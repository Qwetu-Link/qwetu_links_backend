<?php

namespace App\Http\Requests\v1\property;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreUnitsRequest extends FormRequest
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
            'unit_floor' => 'required|string|max:50',
            'status' => 'required|string|max:50',
            'deposit_amount' => 'required|numeric|min:0',
            'property_id' => 'required|string|exists:properties,id',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'unit_number' => $this->unitNumber,
            'unit_floor' => $this->unitFloor,
            'rent_amount' => $this->rentAmount,
            'deposit_amount' => $this->depositAmount,
            'property_id' => $this->propertyID,
        ]);
    }
}
