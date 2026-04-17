<?php

namespace App\Http\Requests\v1\property;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StorePropertyRequest extends FormRequest
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
            'name' => 'required|string|max:50',
            'slug' => 'required|string|min:0',
            'address' => 'required|string|max:50',
            'location' => 'required|string|max:50',
            'apartment_type' => 'required|string|min:0',
            'description' => 'required|string|max:50',
            'bedrooms' => 'required|string|min:0',
            'bathrooms' => 'required|string|max:50',
            'square_meters' => 'required|string|min:0',
            'business_id' => 'required|string|exists:businesses,id',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'apartment_type' => $this->apartmentType,
            'square_meters' => $this->squareMeters,
            'business_id' => $this->businessID,
        ]);
    }
}
