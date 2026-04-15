<?php

namespace App\Http\Requests\v1\accounts;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'businessID' => 'required|exists:businesses,id',
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,'.$this->route('user'),
            'password' => $this->isMethod('post')
                ? 'required|string|min:8'
                : 'nullable|string|min:8',
            'role' => 'required|string|in:owner,tenant,staff',
            'phone' => [
                'required',
                'regex:/^(07\d{8}|01\d{8}|7\d{8}|1\d{8}|\+254[71]\d{8}|254[71]\d{8})$/',
            ],
            'emergencyContactName' => 'nullable|string|max:255',
            'emergencyContactPhone' => [
                'nullable',
                'regex:/^(07\d{8}|01\d{8}|7\d{8}|1\d{8}|\+254[71]\d{8}|254[71]\d{8})$/',
            ],
            'emergencyContactRelationship' => 'nullable|string|max:100',
            'idNumber' => 'nullable|string|max:50|unique:users,id_number,'.$this->route('user'),
            'address' => 'nullable|string|max:500',
            'avatar' => 'nullable|url|max:255',
            // 'avatar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'isActive' => 'sometimes|boolean',
        ];
    }

    protected function prepareForValidation()
    {
        $data = [];

        if ($this->has('businessID')) {
            $data['business_id'] = $this->businessID;
        }

        if ($this->has('emergencyContactName')) {
            $data['emergency_contact_name'] = $this->emergencyContactName;
        }

        if ($this->has('emergencyContactPhone')) {
            $data['emergency_contact_phone'] = $this->emergencyContactPhone;
        }

        if ($this->has('emergencyContactRelationship')) {
            $data['emergency_contact_relationship'] = $this->emergencyContactRelationship;
        }

        if ($this->has('idNumber')) {
            $data['id_number'] = $this->idNumber;
        }

        if ($this->has('isActive')) {
            $data['is_active'] = $this->isActive;
        }

        $this->merge($data);
    }
}
