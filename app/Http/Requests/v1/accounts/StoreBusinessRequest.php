<?php

namespace App\Http\Requests\v1\accounts;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class StoreBusinessRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|regex:/^\+254[71]\d{8}$/',
            'city' => 'required|string|max:100',
            'address' => 'nullable|string|max:255',
            'is_active' => 'nullable|boolean',
            'password' => 'required|string|min:8',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            // 'bank_name' => $this->bankName,
            // 'bank_account_number' => $this->bankAccountNumber,
            // 'mpesa_paybill' => $this->mpesaPaybill,
            // 'mpesa_account_number' => $this->mpesaAccountNumber,
            // 'mpesa_till_no' => $this->mpesaTillNo,
            // 'is_active' => $this->isActive,

            // Auto-generate slug if not provided
            'slug' => $this->slug
                ? Str::slug($this->slug)
                : Str::slug($this->name),
        ]);
    }

    // private function formatKenyanPhone($phone)
    // {
    //     // Remove spaces and non-numeric except +
    //     $phone = preg_replace('/[^0-9+]/', '', $phone);

    //     // Already correct format
    //     if (str_starts_with($phone, '+254')) {
    //         return $phone;
    //     }

    //     // Starts with 254 (missing +)
    //     if (str_starts_with($phone, '254')) {
    //         return '+'.$phone;
    //     }

    //     // Starts with 0
    //     if (str_starts_with($phone, '0')) {
    //         return '+254'.substr($phone, 1);
    //     }

    //     // Starts with 7 (no leading 0)
    //     if (str_starts_with($phone, '7')) {
    //         return '+254'.$phone;
    //     }

    //     // Starts with 1 (no leading 0)
    //     if (str_starts_with($phone, '1')) {
    //         return '+254'.$phone;
    //     }

    //     return $phone; // fallback
    // }
}
