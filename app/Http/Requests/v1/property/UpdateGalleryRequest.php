<?php

namespace App\Http\Requests\v1\property;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateGalleryRequest extends FormRequest
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
                'image_url' => 'required|image|mimes:jpg,jpeg,png|max:2048',
                'property_id' => 'required|string|exists:properties,id',
                'title' => 'required|string|max:255',
                'description' => 'nullable|string|max:255',
                'is_highlight' => 'nullable|boolean',
            ];
        } else {
            return [
                'image_url' => 'sometimes|required|image|mimes:jpg,jpeg,png|max:2048',
                'property_id' => 'sometimes|required|string|exists:properties,id',
                'title' => 'sometimes|required|string|max:255',
                'description' => 'sometimes|nullable|string|max:255',
                'is_highlight' => 'sometimes|nullable|boolean',
            ];
        }
    }

    protected function prepareForValidation()
    {
        $data = [];

        if ($this->has('propertyID')) {
            $data['property_id'] = $this->propertyID;
        }

        if ($this->has('imageUrl')) {
            $data['image_url'] = $this->imageUrl;
        }

        if ($this->has('isHighlight')) {
            $data['is_highlight'] = $this->isHighlight;
        }

        $this->merge($data);
    }
}
