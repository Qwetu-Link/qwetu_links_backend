<?php

namespace App\Http\Requests\v1\accounts;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class UpdateBusinessRequest extends FormRequest
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
    public function rules()
    {
        $method = $this->method();

        if ($method == 'PUT') {
            return [
                'name' => 'required|string|max:255',
                'slug' => 'required|string|max:255|unique:businesses,slug',
                'email' => 'required|email|max:255',
                'phone' => 'required|regex:/^\+254[71]\d{8}$/',
                'website' => 'nullable|url|max:255',
                'country' => 'nullable|string|max:100',
                'city' => 'required|string|max:100',
                'address' => 'nullable|string|max:255',
                'logo_url' => 'nullable|url|max:255',
                // 'logoUrl' => 'nullable|image|mimes:jpeg,png,jpg,svg,webp|max:2048',
                'bank_name' => 'nullable|string|max:255',
                'bank_account_number' => 'nullable|string|max:50',
                'mpesa_paybill' => 'nullable|string|max:20',
                'mpesa_account_number' => 'nullable|string|max:50',
                'mpesa_till_no' => 'nullable|string|max:20',
                'industry' => 'required|string|max:255',
                'description' => 'nullable|string',
                'is_active' => 'nullable|boolean',

                // User Details
                'username' => 'required|string|max:255',
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255|unique:users,email',
                'phone' => [
                    'required',
                    'regex:/^(07\d{8}|01\d{8}|7\d{8}|1\d{8}|\+254[71]\d{8}|254[71]\d{8})$/',
                ],
                'address' => 'nullable|string|max:500',
                'avatar' => 'nullable|url|max:255',
            ];
        } else {
            return [
                'name' => 'sometimes|required|string|max:255',
                'slug' => 'sometimes|required|string|max:255',
                'email' => 'sometimes|required|email|max:255',
                'phone' => 'sometimes|required|regex:/^\+254[71]\d{8}$/',
                'website' => 'sometimes|nullable|url|max:255',
                'country' => 'sometimes|nullable|string|max:100',
                'city' => 'sometimes|required|string|max:100',
                'address' => 'sometimes|nullable|string|max:255',
                'logo_url' => 'sometimes|nullable|url|max:255',
                // 'logoUrl' => 'sometimes|nullable|image|mimes:jpeg,png,jpg,svg,webp|max:2048',
                'bank_name' => 'sometimes|nullable|string|max:255',
                'bank_account_number' => 'sometimes|nullable|string|max:50',
                'mpesa_paybill' => 'sometimes|nullable|string|max:20',
                'mpesa_account_number' => 'sometimes|nullable|string|max:50',
                'mpesa_till_no' => 'sometimes|nullable|string|max:20',
                'industry' => 'sometimes|required|string|max:255',
                'description' => 'sometimes|nullable|string',

                // User Details
                'username' => 'sometimes|required|string|max:255',
                'name' => 'sometimes|required|string|max:255',
                'email' => 'sometimes|required|email|max:255|unique:users,email',
                'phone' => [
                    'sometimes',
                    'required',
                    'regex:/^(07\d{8}|01\d{8}|7\d{8}|1\d{8}|\+254[71]\d{8}|254[71]\d{8})$/',
                ],
                'address' => 'sometimes|nullable|string|max:500',
                'avatar' => 'sometimes|nullable|url|max:255',
            ];
        }
    }

    protected function prepareForValidation()
    {
        $data = [];

        if ($this->exists('logoUrl')) {
            $data['logo_url'] = $this->logoUrl;
        }

        if ($this->exists('bankName')) {
            $data['bank_name'] = $this->bankName;
        }

        if ($this->exists('bankAccountNumber')) {
            $data['bank_account_number'] = $this->bankAccountNumber;
        }

        if ($this->exists('mpesaPaybill')) {
            $data['mpesa_paybill'] = $this->mpesaPaybill;
        }

        if ($this->exists('mpesaAccountNumber')) {
            $data['mpesa_account_number'] = $this->mpesaAccountNumber;
        }

        if ($this->exists('mpesaTillNo')) {
            $data['mpesa_till_no'] = $this->mpesaTillNo;
        }

        if ($this->exists('isActive')) {
            $data['is_active'] = $this->isActive;
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

        if ($this->exists('website')) {

            if ($this->filled('website')) {
                $website = trim($this->website);

                if (! str_starts_with(strtolower($website), 'http')) {
                    $website = 'https://'.$website;
                }

                $this->merge([
                    'website' => $website,
                ]);
            } else {
                // explicitly allow null ONLY if user sends empty
                $this->merge([
                    'website' => null,
                ]);
            }
        }
    }
}
