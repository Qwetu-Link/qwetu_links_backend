<?php

namespace App\Http\Requests\v1\property;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class UpdatePropertyRequest extends FormRequest
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

                'images' => 'required|array',
                'images.*' => 'image|mimes:jpg,jpeg,png|max:2048',

                'title' => 'nullable|array',
                'title.*' => 'nullable|string',

                'description' => 'nullable|array',
                'description.*' => 'nullable|string',

                'is_highlight' => 'nullable|array',

                'amenity_id' => 'nullable|array',
                'amenity_id.*' => 'required|string|exists:amenities,id',
            ];
        } else {
            return [
                'name' => 'sometimes|required|string|max:50',
                'slug' => 'sometimes|required|string|min:0',
                'address' => 'sometimes|required|string|max:50',
                'location' => 'sometimes|required|string|max:50',
                'apartment_type' => 'sometimes|required|string|min:0',
                'description' => 'sometimes|required|string|max:50',
                'bedrooms' => 'sometimes|required|string|min:0',
                'bathrooms' => 'sometimes|required|string|max:50',
                'square_meters' => 'sometimes|required|string|min:0',
                'business_id' => 'sometimes|required|string|exists:businesses,id',

                'images' => 'required|array',
                'images.*' => 'sometimes|image|mimes:jpg,jpeg,png|max:2048',

                'title' => 'nullable|array',
                'title.*' => 'sometimes|nullable|string',

                'description' => 'nullable|array',
                'description.*' => 'sometimes|nullable|string',

                'is_highlight' => 'sometimes|nullable|array',

                'amenity_id' => 'nullable|array',
                'amenity_id.*' => 'sometimes|required|string|exists:amenities,id',
            ];
        }
    }

    protected function prepareForValidation()
    {
        $data = [];

        if ($this->has('businessID')) {
            $data['business_id'] = $this->businessID;
        }

        if ($this->has('apartmentType')) {
            $data['apartment_type'] = $this->apartmentType;
        }

        if ($this->has('squareMeters')) {
            $data['square_meters'] = $this->squareMeters;
        }

        $this->merge($data);

        if ($this->filled('slug')) {
            return;
        }

        // If name is provided (PATCH or POST) → generate slug
        if ($this->filled('name')) {
            $this->merge([
                'slug' => Str::slug($this->name),
            ]);
        }

    }
}
