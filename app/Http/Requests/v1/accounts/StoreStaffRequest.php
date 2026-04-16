<?php

namespace App\Http\Requests\v1\accounts;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreStaffRequest extends FormRequest
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
            'user_id' => 'required|exists:users,id',
            'position' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'salary' => 'required|numeric|min:0|max:100000000',
            'hire_date' => 'required|date|before_or_equal:today',
            'employment_type' => 'required|in:full_time,part_time,contract,intern,temporary',
            // Add User Details
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'user_id' => $this->userID,
            'hire_date' => $this->hireDate,
            'employment_type' => $this->employmentType,
        ]);
    }
}
