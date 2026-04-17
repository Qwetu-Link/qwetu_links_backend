<?php

namespace App\Http\Requests\v1\property;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUnitsRequest extends FormRequest
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
        $method = $this->method();

        if ($method == 'PUT') {
            return [
                'unit_number' => 'required|string|max:50',
                'rent_amount' => 'required|numeric|min:0',
                'unit_floor' => 'required|string|max:50',
                'status' => 'required|string|max:50',
                'deposit_amount' => 'required|numeric|min:0',
                'property_id' => 'required|string|exists:properties,id',
            ];
        } else {
            return [
                'unit_number' => 'sometimes|required|string|max:50',
                'rent_amount' => 'sometimes|required|numeric|min:0',
                'unit_floor' => 'sometimes|required|string|max:50',
                'status' => 'sometimes|required|string|max:50',
                'deposit_amount' => 'sometimes|required|numeric|min:0',
                'property_id' => 'sometimes|required|string|exists:properties,id',
            ];
        }
    }

    protected function prepareForValidation()
    {
        $data = [];

        if ($this->has('propertyID')) {
            $data['property_id'] = $this->propertyID;
        }

        if ($this->has('depositAmount')) {
            $data['deposit_amount'] = $this->depositAmount;
        }

        if ($this->has('unitFloor')) {
            $data['unit_floor'] = $this->unitFloor;
        }

        if ($this->has('rentAmount')) {
            $data['rent_amount'] = $this->rentAmount;
        }

        if ($this->has('unitNumber')) {
            $data['unit_number'] = $this->unitNumber;
        }

        $this->merge($data);
    }
}
