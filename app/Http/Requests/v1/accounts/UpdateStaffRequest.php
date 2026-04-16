<?php

namespace App\Http\Requests\v1\accounts;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateStaffRequest extends FormRequest
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
        $method = $this->method();

        if ($method == 'PUT') {
            return [
                'position' => 'required|string|max:255',
                'department' => 'required|string|max:255',
                'salary' => 'required|numeric|min:0|max:100000000',
                'hire_date' => 'required|date|before_or_equal:today',
                'employment_type' => 'required|in:full_time,part_time,contract,intern,temporary',

                // Add User Details
                'username' => 'required|string|max:255',
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255|unique:users,email',
                'phone' => [
                    'required',
                    'regex:/^(07\d{8}|01\d{8}|7\d{8}|1\d{8}|\+254[71]\d{8}|254[71]\d{8})$/',
                ],
                'emergency_contact_name' => 'nullable|string|max:255',
                'emergency_contact_phone' => [
                    'nullable',
                    'regex:/^(07\d{8}|01\d{8}|7\d{8}|1\d{8}|\+254[71]\d{8}|254[71]\d{8})$/',
                ],
                'emergency_contact_relationship' => 'nullable|string|max:100',
                'id_number' => 'nullable|string|max:50|unique:users,id_number',
                'address' => 'nullable|string|max:500',
                'avatar' => 'nullable|url|max:255',
                // 'avatar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
                'is_active' => 'sometimes|boolean',
            ];
        } else {
            return [
                'position' => 'sometimes|required|string|max:255',
                'department' => 'sometimes|required|string|max:255',
                'salary' => 'sometimes|required|numeric|min:0|max:100000000',
                'hire_date' => 'sometimes|required|date|before_or_equal:today',
                'employment_type' => 'sometimes|required|in:full_time,part_time,contract,intern,temporary',

                // User Details
                'username' => 'sometimes|required|string|max:255',
                'name' => 'sometimes|required|string|max:255',
                'email' => 'sometimes|required|email|max:255|unique:users,email',
                'phone' => [
                    'sometimes',
                    'required',
                    'regex:/^(07\d{8}|01\d{8}|7\d{8}|1\d{8}|\+254[71]\d{8}|254[71]\d{8})$/',
                ],
                'emergency_contact_name' => 'sometimes|nullable|string|max:255',
                'emergency_contact_phone' => [
                    'sometimes',
                    'nullable',
                    'regex:/^(07\d{8}|01\d{8}|7\d{8}|1\d{8}|\+254[71]\d{8}|254[71]\d{8})$/',
                ],
                'emergency_contact_relationship' => 'sometimes|nullable|string|max:100',
                'id_number' => 'sometimes|nullable|string|max:50|unique:users,id_number',
                'address' => 'sometimes|nullable|string|max:500',
                'avatar' => 'sometimes|nullable|url|max:255',
                'is_active' => 'sometimes|boolean',
            ];
        }

    }

    protected function prepareForValidation()
    {
        $data = [];

        if ($this->exists('userID')) {
            $data['user_id'] = $this->userID;
        }

        if ($this->exists('hireDate')) {
            $data['hire_date'] = $this->hireDate;
        }

        if ($this->exists('employmentType')) {
            $data['employment_type'] = $this->employmentType;
        }

        if ($this->exists('emergencyContactName')) {
            $data['emergency_contact_name'] = $this->emergencyContactName;
        }

        if ($this->exists('emergencyContactPhone')) {
            $data['emergency_contact_phone'] = $this->emergencyContactPhone;
        }

        if ($this->exists('emergencyContactRelationship')) {
            $data['emergency_contact_relationship'] = $this->emergencyContactRelationship;
        }

        if ($this->exists('idNumber')) {
            $data['id_number'] = $this->idNumber;
        }

        $this->merge($data);
    }
}
