<?php

namespace App\Http\Requests\v1\property;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StorePropertyAmenitiesRequest extends FormRequest
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
            'amenity_id' => 'required|string|exists:amenities,id',
            'property_id' => 'required|string|exists:properties,id',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'amenity_id' => $this->amenityID,
            'property_id' => $this->propertyID,
        ]);
    }
}
