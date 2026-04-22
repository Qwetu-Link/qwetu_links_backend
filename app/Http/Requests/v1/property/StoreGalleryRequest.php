<?php

namespace App\Http\Requests\v1\property;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreGalleryRequest extends FormRequest
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
            'image_url' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'property_id' => 'required|string|exists:properties,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'is_highlight' => 'nullable|boolean',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'image_url' => $this->imageUrl,
            'property_id' => $this->propertyID,
            'is_highlight' => $this->isHighlight,
        ]);
    }
}
