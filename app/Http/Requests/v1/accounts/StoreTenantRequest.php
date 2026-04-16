<?php

namespace App\Http\Requests\v1\accounts;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreTenantRequest extends FormRequest
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
            'unit_number' => 'required|string|max:50',
            'rent_amount' => 'required|numeric|min:0',
            'lease_start' => 'required|date',
            'lease_end' => 'required|date|after_or_equal:lease_start',
            'next_of_kin_name' => 'required|string|max:255',
            'next_of_kin_phone' => ['required', 'regex:/^(07\d{8}|01\d{8}|254\d{9}|\+254\d{9})$/'],
            'is_active' => 'nullable|boolean',

            //User Details
            'username' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|string|in:owner,tenant,staff',
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
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'user_id' => $this->userID,
            'unit_number' => $this->unitNumber,
            'rent_amount' => $this->rentAmount,
            'lease_start' => $this->leaseStart,
            'lease_end' => $this->leaseEnd,
            'next_of_kin_name' => $this->nextOfKinName,
            'next_of_kin_phone' => $this->nextOfKinPhone,
            'is_active' => $this->isActive,

            'password_confirmation' => $this->passwordConfirmation,
            'emergency_contact_name' => $this->emergencyContactName,
            'emergency_contact_phone' => $this->emergencyContactPhone,
            'emergency_contact_relationship' => $this->emergencyContactRelationship,
            'id_number' => $this->idNumber,
        ]);
    }
}
