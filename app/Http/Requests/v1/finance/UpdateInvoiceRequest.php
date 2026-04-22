<?php

namespace App\Http\Requests\v1\finance;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateInvoiceRequest extends FormRequest
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
                'invoice_number' => 'required', 'string', 'max:50', 'unique:invoices,invoice_number',
                'amount' => 'required', 'numeric', 'min:0',
                'paid_amount' => 'nullable', 'numeric', 'min:0',
                'balance' => 'required', 'numeric', 'min:0',
                'issue_date' => 'required', 'date',
                'due_date' => 'required', 'date', 'after_or_equal:issue_date',
                'status' => 'required', 'in:pending,paid,partial,overdue',
                'notes' => 'nullable', 'string',
            ];
        } else {
            return [
                'invoice_number' => 'sometimes|required', 'string', 'max:50', 'unique:invoices,invoice_number',
                'amount' => 'sometimes|required', 'numeric', 'min:0',
                'paid_amount' => 'sometimes|nullable', 'numeric', 'min:0',
                'balance' => 'sometimes|required', 'numeric', 'min:0',
                'issue_date' => 'sometimes|required', 'date',
                'due_date' => 'sometimes|required', 'date', 'after_or_equal:issue_date',
                'status' => 'sometimes|required', 'in:pending,paid,partial,overdue',
                'notes' => 'sometimes|nullable', 'string',
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

        if ($this->has('businessID')) {
            $data['business_id'] = $this->businessID;
        }

        $this->merge($data);
    }
}
