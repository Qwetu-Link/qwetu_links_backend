<?php

namespace App\Http\Requests\v1\property;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class StorePropertyRequest extends FormRequest
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
            'name' => 'required|string|max:50',
            'address' => 'required|string|max:50',
            'location' => 'required|string|max:50',
            'apartment_type' => 'required|string|min:0',
            'description' => 'nullable|string|max:50',
            'bedrooms' => 'required|string|min:0',
            'bathrooms' => 'required|string|max:50',
            'square_meters' => 'nullable|string|min:0',

            // 'image_url' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'title' => 'nullable|array',
            'title.*' => 'nullable|string',

            'description' => 'nullable|array',
            'description.*' => 'nullable|string',

            'is_highlight' => 'nullable|array',

            'images' => 'required|array',
            'images.*' => 'image|mimes:jpg,jpeg,png|max:2048',

            'amenity_id' => 'nullable|array',
            'amenity_id.*' => 'required|string|exists:amenities,id',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'apartment_type' => $this->apartmentType,
            'square_meters' => $this->squareMeters,
            'business_id' => $this->businessID,

            'slug' => $this->slug
                ? Str::slug($this->slug)
                : Str::slug($this->name),
        ]);
    }
}
