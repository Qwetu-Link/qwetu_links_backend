<?php

namespace App\Http\Requests\v1\property;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePropertyAmenitiesRequest extends FormRequest
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
                'amenity_id' => 'required|string|exists:amenities,id',
                'property_id' => 'required|string|exists:properties,id',
            ];
        } else {
            return [
                'amenity_id' => 'sometimes|required|string|exists:amenities,id',
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

        if ($this->has('amenityID')) {
            $data['amenity_id'] = $this->amenityID;
        }

        $this->merge($data);
    }
}
