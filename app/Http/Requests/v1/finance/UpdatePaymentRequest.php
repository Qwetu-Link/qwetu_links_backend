<?php

namespace App\Http\Requests\v1\finance;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePaymentRequest extends FormRequest
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
                'lease_id' => 'required|string|exists:leases,id',
                'invoice_id' => 'required|string|exists:invoices,id',
                'amount' => 'required|numeric|min:0',
                'payment_date' => 'required|date',
                'payment_method' => 'required|in:cash,mpesa,bank',
                'transaction_code' => 'nullable|string|max:100',
                'type' => 'required|in:rent,deposit,penalty',
                'notes' => 'nullable|string',
            ];
        } else {
            return [
                'lease_id' => 'sometimes|required|string|exists:leases,id',
                'invoice_id' => 'sometimes|required|string|exists:invoices,id',
                'amount' => 'sometimes|required|numeric|min:0',
                'payment_date' => 'sometimes|required|date',
                'payment_method' => 'sometimes|required|in:cash,mpesa,bank',
                'transaction_code' => 'sometimes|nullable|string|max:100',
                'type' => 'sometimes|required|in:rent,deposit,penalty',
                'notes' => 'sometimes|nullable|string',
            ];
        }
    }

    protected function prepareForValidation()
    {
        $data = [];

        if ($this->has('leaseID')) {
            $data['lease_id'] = $this->leaseID;
        }

        if ($this->has('invoiceID')) {
            $data['invoice_id'] = $this->invoiceID;
        }

        if ($this->has('paymentDate')) {
            $data['payment_date'] = $this->paymentDate;
        }

        if ($this->has('paymentMethod')) {
            $data['payment_method'] = $this->paymentMethod;
        }

        if ($this->has('transactionCode')) {
            $data['transaction_code'] = $this->transactionCode;
        }

        $this->merge($data);
    }
}
