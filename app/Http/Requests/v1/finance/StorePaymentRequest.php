<?php

namespace App\Http\Requests\v1\finance;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StorePaymentRequest extends FormRequest
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
            'lease_id' => 'required|string|exists:leases,id',
            'amount' => 'required|numeric|min:0',
            'payment_date' => 'required|date',
            'payment_method' => 'required|in:cash,mpesa,bank',
            'transaction_code' => 'nullable|string|max:100',
            'type' => 'required|in:rent,deposit,penalty',
            'notes' => 'nullable|string',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'lease_id' => $this->leaseID,
            'payment_date' => $this->paymentDate,
            'payment_method' => $this->paymentMethod,
            'transaction_code' => $this->transactionCode,
        ]);
    }
}
