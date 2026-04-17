<?php

namespace App\Http\Requests\v1\accounts;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateTenantRequest extends FormRequest
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
                'next_of_kin_name' => 'required|string|max:255',
                'next_of_kin_phone' => ['required', 'regex:/^(07\d{8}|01\d{8}|254\d{9}|\+254\d{9})$/'],
                'is_active' => 'nullable|boolean',

                // User Details
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
            ];
        } else {
            return [
                'next_of_kin_name' => 'sometimes|required|string|max:255',
                'next_of_kin_phone' => [
                    'sometimes',
                    'required',
                    'regex:/^(07\d{8}|01\d{8}|254\d{9}|\+254\d{9})$/',
                ],
                'is_active' => 'sometimes|nullable|boolean',

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
            ];
        }
    }

    protected function prepareForValidation()
    {
        $data = [];

        if ($this->exists('userID')) {
            $data['user_id'] = $this->userID;
        }

        if ($this->exists('next_of_kin_name')) {
            $data['next_of_kin_name'] = $this->nextOfKinName;
        }

        if ($this->exists('nextOfKinPhone')) {
            $data['next_of_kin_phone'] = $this->nextOfKinPhone;
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

        if ($this->exists('isActive')) {
            $data['is_active'] = $this->isActive;
        }

        $this->merge($data);
    }
}
